<?php



class LoginController extends Controller
{
    private $login;

    public function __construct()
    {
        // $this->login = new Login(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }


    public function index()
    {
        $this->view('landing/index', []);
    }

    
}
