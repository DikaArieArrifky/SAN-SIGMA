<?php

require_once 'app/core/Model.php';

class Login extends Model
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function getUser($username, $password,$role)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE Username = :username AND Password = :password AND role = :role");
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
       if ($role['role'] == 'admin') {
            $query->bindValue(":role", 'admin');
        } else if ($role['role'] == 'dosen') {
            $query->bindValue(":role", 'dosen');
        } else if ($role['role'] == 'mahasiswa') {
            $query->bindValue(":role", 'mahasiswa');
        }
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getRole($username, $password)
    {
        $query = $this->db->prepare("SELECT role FROM dbo.users WHERE Username = :username AND Password = :password");
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
