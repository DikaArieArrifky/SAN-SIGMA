<?php

// require_once '../app/models/Admin.php';
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Mahasiswa.php';
// require_once '../app/models/Dokumen.php';


class MahasiswaController extends Controller
{
    private $mahasiswa;
    private $haveScore;

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
                ]
            ];

            $this->view('mahasiswa/index', $data);

        } catch (Exception $e) {
            // Handle error appropriately
            $this->error(500, $e->getMessage());
        }
    }
    
    public function uploadPhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
            try {
                $file = $_FILES['photo'];
                $uploadDir = 'public/img/person/';
                
                // Create directory if it doesn't exist
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                // Generate unique filename
                $filename = uniqid() . '_' . basename($file['name']);
                $uploadFile = $uploadDir . $filename;
    
                // Validate image
                $check = getimagesize($file['tmp_name']);
                if ($check === false) {
                    throw new Exception("File is not an image");
                }
    
                // Move uploaded file
                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception("Failed to upload file");
                }
    
                // Update database
                $this->mahasiswa->updatePhoto($_SESSION['user_id'], $filename);
    
                // Redirect back to profile
                header('Location: ?screen=profile');
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
