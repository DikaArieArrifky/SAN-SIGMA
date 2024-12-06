<?php

// require_once '../app/models/Admin.php';
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Mahasiswa.php';
// require_once '../app/models/Dokumen.php';


class MahasiswaController extends Controller
{
    private $mahasiswa;



    public function __construct()
    {
        $db = Database::getInstance(getDatabaseConfig(), [$this, 'error']);
        $this->mahasiswa = new Mahasiswa(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }

    public function index($screen = "dashboard")
    {
        try {
            // Fetch mahasiswa data
            $mahasiswaData = $this->mahasiswa->getMahasiswaByUserId($_SESSION['user_id']);


            if (!$mahasiswaData) {
                throw new Exception("Mahasiswa data not found");
            }

            // Add additional data
            $data = [
                "screen" => $screen,
                "title" => $this->processTitle($screen),
                "mahasiswa" => [
                    "name" => $mahasiswaData['name'],
                    "nim" => $mahasiswaData['nim'],
                    "photo" => $mahasiswaData['photo'],
                    "prodi" => $this->mahasiswa->getProdiNameByMahasiswaProdiId($mahasiswaData['prodi_id']),
                    "count" => $this->mahasiswa->getMahasiswaByNim($mahasiswaData['nim']),
                    "countTerverifikasi" => $this->mahasiswa->getMahasiswaTerverifikasiByNim($mahasiswaData['nim']),
                    "rank" => $this->mahasiswa->getRankNoMahasiswa($mahasiswaData['nim']),
                    "score" => $mahasiswaData['score'],
                    "college_year" => $mahasiswaData['college_year'],
                    "status" => $mahasiswaData['status'],
                    "alamat" => $mahasiswaData['Alamat'],
                    "kota" => $mahasiswaData['Kota'],
                    "score" => $mahasiswaData['score'],
                    "prodi_id" => $mahasiswaData['prodi_id'],
                    "provinsi" => $mahasiswaData['Provinsi'],
                    "no_telepon" => $mahasiswaData['phone_number'],
                    "agama" => $mahasiswaData['agama']

                ],
                "haveScore" => [
                    "count" => $this->mahasiswa->getMahasiswaWhoHaveScore()
                ],
                "passwordLama" => [
                    "password" => $this->mahasiswa->getPasswordByUserId($_SESSION['user_id'])
                ],
                "verifikasiPenghargaan" => $this->mahasiswa->getVerifikasiAndPenghargaanByNim($mahasiswaData['nim'])


            ];

            $this->view('mahasiswa/index', $data);

        } catch (Exception $e) {
            // Handle error appropriately
            $this->error(500, $e->getMessage());
        }
    }

    // show riwayat mahasiswa
    public function getVerifikasiDetail()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        try {
            $verifikasiId = $_POST['id'];
            $detail = $this->mahasiswa->getVerifikasiAndPenghargaanByIdVerifikasi($verifikasiId);
            echo json_encode($detail);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

    public function uploadPhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
            try {
                $file = $_FILES['photo'];
                $nim = $_POST['nim'];

                // Validate image
                $check = getimagesize($file['tmp_name']);
                if ($check === false) {
                    throw new Exception("File is not an image");
                }

                // Validate file size (max 5MB)
                if ($file['size'] > 5242880) {
                    throw new Exception("File is too large. Maximum size is 5MB");
                }

                // Validate file type
                $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($file['type'], $allowed)) {
                    throw new Exception("Invalid file type. Only JPG, JPEG & PNG files are allowed");
                }

                $uploadDir = 'public/img/person/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate unique filename
                $filename = ($file['name']);
                $uploadFile = $filename;

                // Delete old photo if exists
                $oldPhoto = $this->mahasiswa->getPhotoByNim($nim);
                if ($oldPhoto && file_exists($uploadDir . $oldPhoto)) {
                    unlink($uploadDir . $oldPhoto);
                }

                // Move uploaded file
                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception("Failed to upload file");
                }

                // Update database
                $this->mahasiswa->updatePhoto($nim, $filename);

                // Redirect back to profile
                header('Location:screen?screen=profile');
                exit();
            } catch (Exception $e) {
                $this->error(500, $e->getMessage());
            }
        }
    }

    private function processTitle($screen)
    {
        $title = $screen;
        if (strpos($title, '/') !== false) {
            $title = explode('/', $title);
            $title = array_pop($title);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);
        }
        return $title;
    }

    public function screen()
    {
        if (isset($_GET['screen'])) {
            $screen = strtolower($_GET['screen']);
            $this->index($screen);
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $oldPassword = $_POST['password-lama'];
                $newPassword = $_POST['password-baru'];
                $verifPassword = $_POST['password-baru-verif'];

                // Get stored password
                $storedPassword = $this->mahasiswa->getPasswordByUserId($_SESSION['user_id']);

                // Validate old password
                if ($oldPassword !== $storedPassword) {
                    throw new Exception("Password lama tidak sesuai");
                }

                $this->mahasiswa->changePasswordByUserId(
                    $_SESSION['user_id'],
                    $verifPassword,
                    $newPassword,
                    $oldPassword
                );

                // Redirect with success message
                header('Location: screen?screen=profile&message=Password berhasil diubah');
                exit();
            } catch (Exception $e) {
                // Redirect with error message
                header('Location: screen?screen=profile&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
    }






    // public function count prestasis mahasiswa by nim


    // public function getDataPengumpulan()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $mahasiswaList = $this->mahasiswa->getAllMahasiswaInformation();

    //         $tingkatDokumen = $this->admin->adminApa;
    //         if ($tingkatDokumen === TipeAdmin::Super) {
    //             $tingkatDokumen = TingkatDokumen::from($_POST['super-tingkat']);
    //         } else {
    //             $tingkatDokumen = TingkatDokumen::from(ucwords($this->admin->adminApa->value));
    //         }
    //         $dokumenList = $this->dokumen->getDokumenList($tingkatDokumen);
    //         $everToSubmit = [];
    //         foreach ($this->dokumen->getDokumenListAllWithUpload($tingkatDokumen) as $dokumen) {
    //             $nim = $dokumen['nim'];
    //             unset($dokumen['nim']);
    //             $everToSubmit[$nim][] = $dokumen;
    //         }

    //         $data = [];
    //         foreach ($mahasiswaList as $mahasiswa) {
    //             $temp = [
    //                 'data_mahasiswa' => $mahasiswa,
    //             ];
    //             foreach ($dokumenList as $dokumen) {
    //                 $temp['data_detail'][] = [
    //                     'dokumen' => $dokumen['dokumen'],
    //                     'id' => $dokumen['id'],
    //                     'status' => ''
    //                 ];
    //             }
    //             if (isset($everToSubmit[$mahasiswa['nim']])) {
    //                 $dokumenMahasiswaNim = $everToSubmit[$mahasiswa['nim']];
    //                 foreach ($dokumenMahasiswaNim as $key => $value) {
    //                     $temp['data_detail'][$key] = $value;
    //                 }
    //             }
    //             $data[] = $temp;
    //         }
    //     }

    //     echo json_encode($data);
    // }

    // public function updateDataPengumpulan()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $this->dokumen->updateUploadDokumen(
    //             $_POST['id_dokumen'],
    //             $_POST['nim'],
    //             $this->admin->getPeopleId(),
    //             $_POST['acc'] === 'true' ? StatusDokumen::Diverifikasi : StatusDokumen::Ditolak,
    //             isset($_POST['komentar']) ? $_POST['komentar'] : ''
    //         );
    //     }
    // }
}
