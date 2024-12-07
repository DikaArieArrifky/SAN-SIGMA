<?php

// require_once '../app/models/Admin.php';
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Dosen.php';



class MahasiswaController extends Controller
{
    private $mahasiswa;
    private $dosen;
    private $db;


    public function __construct()
    {
        
        $this->mahasiswa = new Mahasiswa(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->dosen = new Dosen(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
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
                "verifikasiPenghargaan" => $this->mahasiswa->getVerifikasiAndPenghargaanByNim($mahasiswaData['nim']),

                "tingkat" => $this->mahasiswa->getTingkatanLomba(),
                "peringkat" => $this->mahasiswa->getPeringkatLomba(),
                "dosenName" => $this->dosen->getAllDosen(),



            ];

            $this->view('mahasiswa/index', $data);
        } catch (Exception $e) {
            // Handle error appropriately
            //alert js exception
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
            exit();
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

                // cek tipe file
                $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($file['type'], $allowed)) {
                    throw new Exception("Invalid file type. Only JPG, JPEG & PNG files are allowed");
                }

                $uploadDir = dirname(__DIR__, 2) . '/assets/img/person/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }


                // Generate unique filename
                $filename = ($file['name']);
                $uploadFile = $uploadDir . $filename;

                // Delete old photo if exists
                $oldPhoto = $this->mahasiswa->getPhotoByNim($nim);
                if ($oldPhoto && file_exists($uploadDir . $oldPhoto)) {
                    unlink($uploadDir . $oldPhoto);
                }


                // Move uploaded file
                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception("Failed to upload file");
                }
                consoleLog('uploadFile', $uploadFile);
                consoleLog('moveFile', move_uploaded_file($file['tmp_name'], $uploadFile));
                // Update database
                $this->mahasiswa->updatePhoto($nim, $filename);

                // Redirect back to profile
                header('Location: screen?screen=profile');
                exit();
            } catch (Exception $e) {
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=profile"; }, 10);</script>';
                exit();
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

    // calculate score
    public function calculateScore()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                header('Content-Type: application/json');
                ob_clean();

                $tingkatId = filter_input(INPUT_POST, 'tingkat_id', FILTER_SANITIZE_NUMBER_INT);
                $peringkatId = filter_input(INPUT_POST, 'peringkat_id', FILTER_SANITIZE_NUMBER_INT);

                if (!$tingkatId || !$peringkatId) {
                    throw new Exception('Missing required parameters');
                }

                // Use $this->mahasiswa instead of direct DB query
                $score = $this->mahasiswa->calculateScore($tingkatId, $peringkatId);

                die(json_encode([
                    'success' => true,
                    'score' => floatval($score)
                ]));
            } catch (Exception $e) {
                http_response_code(500);
                die(json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]));
            }
        }
    }



    public function uploadPrestasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get mahasiswa data
                $mahasiswaData = $this->mahasiswa->getMahasiswaByUserId($_SESSION['user_id']);
                if (!$mahasiswaData) {
                    throw new Exception("Mahasiswa data not found");
                }

                // Validate files
                $files = ['sertifikat', 'poster', 'foto'];
                $uploadedFiles = [];

                foreach ($files as $fileType) {
                    if (!isset($_FILES[$fileType])) {
                        throw new Exception("File $fileType is required");
                    }

                    $file = $_FILES[$fileType];

                    // Validate file size (max 10MB)
                    if ($file['size'] > 10485760) {
                        throw new Exception("$fileType file is too large. Maximum size is 10MB");
                    }

                    // Validate file type
                    $allowedTypes = [
                        'sertifikat' => ['application/pdf', 'image/jpeg', 'image/png'],
                        'poster' => ['application/pdf', 'image/jpeg', 'image/png'],
                        'foto' => ['image/jpeg', 'image/png']
                    ];

                    if (!in_array($file['type'], $allowedTypes[$fileType])) {
                        throw new Exception("Invalid file type for $fileType");
                    }

                    // Create upload directories if they don't exist
                    $uploadDir = dirname(__DIR__, 2) . '/assets/img/file-prestasi/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Generate unique filename
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '_' . time() . '.' . $extension;
                    $uploadPath = $uploadDir . $filename;

                    // Move file
                    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        throw new Exception("Failed to upload $fileType file");
                    }

                    $uploadedFiles[$fileType] = $filename;
                }

                // Insert prestasi data
                $prestasiData = [
                    'mahasiswa_nim' => $mahasiswaData['nim'],
                    'judul' => $_POST['judul'],
                    'tempat' => $_POST['tempat'],
                    'url' => $_POST['url'],
                    'tanggal_mulai' => $_POST['tanggal_mulai'],
                    'tanggal_akhir' => $_POST['tanggal_akhir'],
                    'jumlah_instansi' => $_POST['jumlah_instansi'],
                    'jumlah_peserta' => $_POST['jumlah_peserta'],
                    'tingkat_id' => $_POST['tingkat'],
                    'peringkat_id' => $_POST['peringkat'],
                    'score' => $_POST['score'],
                    'file_sertifikat' => $uploadedFiles['sertifikat'],
                    'file_poster' => $uploadedFiles['poster'],
                    'file_photo_kegiatan' => $uploadedFiles['foto']
                ];

                // Insert into database
                $prestasiId = $this->mahasiswa->insertPrestasi($prestasiData);

                // Insert verifikasi data
                $dosenNip = explode(' ', $_POST['dosenPembimbing']);
                $dosenNip = end($dosenNip);

                $verifikasiData = [
                    'mahasiswa_nim' => $mahasiswaData['nim'],
                    'dosen_nip' => $dosenNip,
                    'penghargaan_id' => $prestasiId,
                    'verif_admin' => 'DiProses',
                    'verif_pembimbing' => 'DiProses'
                ];

                $this->mahasiswa->insertVerifikasi($verifikasiData);

                // Redirect with success message
                echo '<script>alert("Prestasi berhasil diinputkan");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=riwayat"; }, 10);</script>';
                exit();
            } catch (Exception $e) {
                // Delete uploaded files if any error occurs
                foreach ($uploadedFiles as $file) {
                    if (file_exists($uploadDir . $file)) {
                        unlink($uploadDir . $file);
                    }
                }

                // Redirect with error message and timeout
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=inputPrestasi"; }, 3000);</script>';
                exit();
            }
        }
    }
}
