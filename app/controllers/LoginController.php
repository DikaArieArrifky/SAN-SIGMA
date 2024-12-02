<?php

require_once 'app/models/Login.php';

class LoginController extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new Login(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }

    public function index()
    {
        $this->view('landing/index', []);
    }
    public function login()
    {
        $this->view('login/index', ['']);
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
        if ($role['role']=='admin') {
            $this->view('admin/index', ['user' => $user]);
        } else if ($role['role']=='dosen') {
            $this->view('dosen/index', ['user' => $user]);
        } else if ($role['role']=='mahasiswa') {
            $this->view('mahasiswa/index', ['user' => $user]);


        } else {

echo $role['role'];
            echo "Username atau Password Salah";
            // $username = Session::get('username');
            // $password = Session::get('password');
            // $level = Session::get('level');
            // Session::destroy();
            // Session::start();
            // $this->view('login/index', ['not_found' => true, 'username' => $username, 'password' => $password, 'level' => $level]);
        }
    }
}
