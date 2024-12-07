<?php

require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Login.php';
require_once 'app/models/Admin.php';

class AdminController extends Controller
{
    private $admin;
    private $mahasiswa;
    private $dokumen;


    public function __construct()
    {
        $this->admin = new Admin(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }

    public function index($screen = "dashboard")
    {
        $title = $screen;
        if (strpos($title, '/') !== false) {
            $title = explode('/', $title);
            $title = array_pop($title);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);
        }

        try {
            // Fetch admin data from database by user_id
            $dataAdmin = $this->admin->getAdminByUserId($_SESSION['user_id']);

            if (!$dataAdmin) {
                throw new Exception("Admin not found");
            }
            $data = [
                "screen" => $screen,
                "title" => $this->processTitle($screen),
                'dataAdmin' => $dataAdmin,
                "admin" => [
                    "name" => $dataAdmin['name'],
                    "id" => $dataAdmin['id'],
                    "photo" => $dataAdmin['photo']
                ],
                "verifikasiPenghargaan" => $this->admin->getAllVerifikasiAndPenghargaan(),
            ];
            $this->view('admin/index', $data);
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
                $detail = $this->admin->getVerifikasiAndPenghargaanByIdVerifikasi($verifikasiId);
                echo json_encode($detail);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }
    // tombol dari admin untuk verifikasi prestasi
    public function verifikasi_prestasi() 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $verifikasiId = $_POST['pengId']; 
            $status = $_POST['verification_status'] === 'accept' ? 'Terverifikasi' : 'DiTolak';
            $pesan = $_POST['pesan'];
            $id_admin = $_POST['id_admin'];


            // Update verification status
            $result = $this->admin->updateVerification($verifikasiId, $status, $pesan, $id_admin);

            // Show success message using SweetAlert2
            echo '<script>alert("Prestasi berhasil diinputkan");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=verifikasi_prestasi"; }, 10);</script>';

        } catch (Exception $e) {
            // Show error message using SweetAlert2
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=verifikasi_prestasi"; }, 3000);</script>';
        }
    }
}

}
