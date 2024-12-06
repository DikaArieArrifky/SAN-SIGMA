<?php

require_once 'app/core/Model.php';

class Dosen extends Model
{
    public function __construct($db)
    {
        parent::__construct($db);
    }
    public function getDosenByUserId($userId)
    {
        $query = $this->db->prepare("SELECT * FROM dosens WHERE user_id = :user_id");
        $query->bindValue(":user_id", $userId);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // public function getProdiNameBydosenProdiId($prodiId) 
    // {
    //     $query = $this->db->prepare("SELECT * FROM prodis WHERE id = :prodi_id");
    //     $query->bindValue(":prodi_id", $prodiId);
    //     $query->execute();
    //     $prodi = $query->fetch(PDO::FETCH_ASSOC);
    //     if (!$prodi) {
    //         throw new Exception("Prodi not found");
    //     }
    //     return $prodi['nama'];
    // }

    public function getUserId($username)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE Username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getDosenByNip($nip)
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE dosen_nip = :nip and (verif_admin = 'Diproses' or verif_pembimbing = 'Diproses')");
        $query->bindValue(":nip", $nip);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getdosenTerverifikasiByNip($nip)
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE dosen_nip = :nip and verif_admin = 'Terverifikasi' and verif_pembimbing = 'Terverifikasi'");
        $query->bindValue(":nip", $nip);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getRankNoDosen($nip)
    {
        $query = $this->db->prepare("SELECT * FROM (SELECT nip,score, dense_rank() OVER (ORDER BY score desc) as dense_rank FROM dosens) as rank WHERE nip = :nip and score > 0");
        $query->bindValue(":nip", $nip);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getDosenWhoHaveScore()
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM dosens WHERE score > 0");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    
   
}