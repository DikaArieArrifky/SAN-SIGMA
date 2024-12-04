<?php

require_once 'app/core/Model.php';

class Mahasiswa extends Model
{
    public function __construct($db)
    {
        parent::__construct($db);
    }
    public function getMahasiswaByUserId($userId)
    {
        $query = $this->db->prepare("SELECT * FROM mahasiswas WHERE user_id = :user_id");
        $query->bindValue(":user_id", $userId);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProdiNameByMahasiswaProdiId($prodiId) 
    {
        $query = $this->db->prepare("SELECT * FROM prodis WHERE id = :prodi_id");
        $query->bindValue(":prodi_id", $prodiId);
        $query->execute();
        $prodi = $query->fetch(PDO::FETCH_ASSOC);
        if (!$prodi) {
            throw new Exception("Prodi not found");
        }
        return $prodi['nama'];
    }

    public function getUserId($username)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE Username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getMahasiswaByNim($nim)
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE mahasiswa_nim = :nim and (verif_admin = 'Diproses' or verif_pembimbing = 'Diproses')");
        $query->bindValue(":nim", $nim);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getMahasiswaTerverifikasiByNim($nim)
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE mahasiswa_nim = :nim and verif_admin = 'Terverifikasi' and verif_pembimbing = 'Terverifikasi'");
        $query->bindValue(":nim", $nim);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getRankNoMahasiswa($nim)
    {
        $query = $this->db->prepare("SELECT * FROM (SELECT nim,score, dense_rank() OVER (ORDER BY score desc) as dense_rank FROM mahasiswas) as rank WHERE nim = :nim and score > 0");
        $query->bindValue(":nim", $nim);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getMahasiswaWhoHaveScore()
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM mahasiswas WHERE score > 0");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    
   
}