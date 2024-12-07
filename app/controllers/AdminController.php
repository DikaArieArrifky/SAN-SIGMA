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
                ]
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
}
