<?php

require_once 'app/models/Login.php';
require_once 'app/models/Mahasiswa.php';
require_once 'app/models/Landing.php';

class LoginController extends Controller
{
    private $login;
    private $mahasiswa;
    private $landing;

    public function __construct()
    {
        $this->login = new Login(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->mahasiswa = new Mahasiswa(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->landing = new Landing(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }

    public function index()
    {
        try {
            // Fetch data
            $top10mahasiswas = $this->landing->getTop10mahasiswas();
            $top10dosen = $this->landing->getTop10dosen();
            $top10NewVerifikasi = $this->landing->getTop10NewVerifikasi(); // Fixed variable name

            // Pass data to view
            $this->view('landing/index', [
                'top10mahasiswas' => $top10mahasiswas,
                'top10dosen' => $top10dosen,
                'top10NewVerifikasi' => $top10NewVerifikasi  // Fixed array key
            ]);
        } catch (Exception $e) {
            $this->error(500, $e->getMessage());
        }
    }

    public function login()
    {
        $this->view('login/index', []);
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            Session::set('username', $username);
            Session::set('password', $password);
            $this->dologin();
        }
    }

    public function dologin()
    {
        $role = $this->login->getRole(Session::get('username'), Session::get('password'));
        Session::set('role', $role);

        $user = $this->login->getUser(Session::get('username'), Session::get('password'), $role);
        if (!$role) {
            $username = Session::get('username');
            $password = Session::get('password');
            Session::destroy();
            Session::start();
            $this->view('login/index', ['not_found' => true, 'username' => $username, 'password' => $password]);

            return;
        }
        switch ($role['role']) {
            case 'admin':
                require_once 'app/controllers/AdminController.php';
                header("Location: admin/index");
                break;
            case 'dosen':
                require_once 'app/controllers/DosenController.php';
                $dosen = new Dosen(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
                $user_id = $this->dosen->getUserId(Session::get('username'));
                Session::set('user_id', $user_id);
                header("Location: dosen/index");
                break;
            case 'mahasiswa':
                $mahasiswa = new Mahasiswa(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
                $user_id = $this->mahasiswa->getUserId(Session::get('username'));
                Session::set('user_id', $user_id);
                require_once 'app/controllers/MahasiswaController.php';
                header("Location: mahasiswa/index");
                break;
            default:
                echo "Username atau Password Salah";
                break;
        }
    }
}
