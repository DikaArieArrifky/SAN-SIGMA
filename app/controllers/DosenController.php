<?php

// require_once '../app/models/Admin.php';
require_once 'app/models/Dosen.php';
require_once 'app/models/Mahasiswa.php';

class DosenController extends Controller
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
            // Fetch dosen data
            $dosenData = $this->dosen->getdosenByUserId($_SESSION['user_id']);


            if (!$dosenData) {
                throw new Exception("dosen data not found");
            }

            // Add additional data
            $data = [
                "screen" => $screen,
                "title" => $this->processTitle($screen),
                "dosen" => [
                    "name" => $dosenData['name'],
                    "nip" => $dosenData['nip'],
                    "photo" => $dosenData['photo'],
                    "count" => $this->dosen->getDosenByNip($dosenData['nip']),
                    "rank" => $this->dosen->getRankNodosen($dosenData['nip']),
                    "score" => $dosenData['score'],
                    "prodi" => $this->dosen->getProdiNameBydosenProdiId($dosenData['prodi_id']),
                    "countTerverifikasi" => $this->dosen->getDosenTerverifikasiByNip($dosenData['nip']),

                    "status" => $dosenData['status'],
                    "alamat" => $dosenData['Alamat'],
                    "kota" => $dosenData['Kota'],
                    "score" => $dosenData['score'],
                    "prodi_id" => $dosenData['prodi_id'],
                    "provinsi" => $dosenData['Provinsi'],
                    "no_telepon" => $dosenData['phone_number'],
                    "agama" => $dosenData['agama']

                ],
                "haveScore" => [
                    "count" => $this->dosen->getdosenWhoHaveScore()
                ],
                "passwordLama" => [
                    "password" => $this->dosen->getPasswordByUserId($_SESSION['user_id'])
                ],
                "verifikasiPenghargaan" => $this->dosen->getVerifikasiAndPenghargaanByNip($dosenData['nip']),
                "verifikasiPenghargaanOv" => $this->dosen->getAllVerifikasiAndPenghargaanOv(),

                "dosenName" => $this->dosen->getAllDosen(),



            ];

            $this->view('dosen/index', $data);
        } catch (Exception $e) {
            // Handle error appropriately
            //alert js exception
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
            exit();
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
    public function getVerifikasiDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            try {
                $verifikasiId = $_POST['id'];
                $detail = $this->dosen->getVerifikasiAndPenghargaanByNip($verifikasiId);
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
                $nip = $_POST['nip'];

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
                $oldPhoto = $this->dosen->getPhotoByNip($nip);
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
                $this->dosen->updatePhoto($nip, $filename);

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

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $oldPassword = $_POST['password-lama'];
                $newPassword = $_POST['password-baru'];
                $verifPassword = $_POST['password-baru-verif'];

                // Get stored password
                $storedPassword = $this->dosen->getPasswordByUserId($_SESSION['user_id']);

                // Validate old password
                if ($oldPassword !== $storedPassword) {
                    throw new Exception("Password lama tidak sesuai");
                }

                $this->dosen->changePasswordByUserId(
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
}


