<?php

require_once 'app/core/Model.php';
require_once 'app/core/IUserApp.php';

class Mahasiswa extends Model implements IUserApp
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

    //update Section
    public function updatePhoto($nim, $photo)
    {
        $query = $this->db->prepare("UPDATE mahasiswas SET photo = :photo WHERE nim = :nim");
        $query->bindValue(":photo", $photo);
        $query->bindValue(":nim", $nim);
        $query->execute();
    }
    public function getPhotoByNim($nim)
    {
        try {
            $query = $this->db->prepare("
            SELECT photo 
            FROM mahasiswas 
            WHERE nim = :nim
        ");

            $query->bindValue(":nim", $nim);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['photo'] : null;
        } catch (PDOException $e) {
            error_log("Error fetching photo: " . $e->getMessage());
            return null;
        }
    }

    public function getPasswordByUserId($x)
    {
        $query = $this->db->prepare("SELECT password FROM users WHERE id = :id");
        $query->bindValue(":id", $x);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['password'];
    }

    public function changePasswordByUserId($userId, $verifPassword, $newPassword, $oldPassword)
    {
        // Validate inputs
        if (empty($newPassword) || empty($verifPassword)) {
            throw new Exception("Password tidak boleh kosong");
        }

        if ($newPassword === $oldPassword) {
            throw new Exception("Password baru tidak boleh sama dengan password lama");
        }

        if ($verifPassword !== $newPassword) {
            throw new Exception("Password verifikasi tidak sesuai");
        }


        // Update password
        $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $query->bindValue(":password", $newPassword);
        $query->bindValue(":id", $userId);
        $query->execute();
    }

    //show verifikasi and penghargaan
    public function getVerifikasiAndPenghargaanByNim($nim)
    {
        $query = $this->db->prepare("
            SELECT 
                v.*,
                p.*,
                t.nama as tingkatan_nama,
                d.name as dosen_name
            FROM verifikasis v
            LEFT JOIN penghargaans p ON v.penghargaan_id = p.id
            LEFT JOIN tingkatans t ON p.tingkat_id = t.id
            LEFT JOIN dosens d ON v.dosen_nip = d.nip
            WHERE v.mahasiswa_nim = :nim
            ORDER BY v.created_at DESC
        ");
        
        $query->bindValue(":nim", $nim);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //show getVerifikasiAndPenghargaanByIdVerifikasi
    public function getVerifikasiAndPenghargaanByIdVerifikasi($idVerifikasi)
    {
        $query = $this->db->prepare("
            SELECT 
                v.*,
                p.*,
                t.nama as tingkatan_nama,
                d.name as dosen_name,
                per.nama as peringkat_nama
            FROM verifikasis v
            LEFT JOIN penghargaans p ON v.penghargaan_id = p.id
            LEFT JOIN tingkatans t ON p.tingkat_id = t.id
            LEFT JOIN peringkats per ON p.peringkat_id = per.id
            LEFT JOIN dosens d ON v.dosen_nip = d.nip
            WHERE v.id = :id
        ");
        
        $query->bindValue(":id", $idVerifikasi);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTingkatanLomba()
    {
        $query = $this->db->prepare("SELECT id, nama FROM tingkatans WHERE visible_tingkatans = 1");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPeringkatLomba()
    {
        $query = $this->db->prepare("SELECT * FROM peringkats  WHERE visible_peringkats = 1");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateScore($tingkatId, $peringkatId)
    {
        $query = $this->db->prepare("SELECT multiple FROM peringkats WHERE id = :peringkat_id");
        $query->bindValue(":peringkat_id", $peringkatId);
        $query->execute();
        $peringkat = $query->fetch(PDO::FETCH_ASSOC);
        if (!$peringkat) {
            throw new Exception("Peringkat not found");
        }

        $query = $this->db->prepare("SELECT point FROM tingkatans WHERE id = :tingkat_id");
        $query->bindValue(":tingkat_id", $tingkatId);
        $query->execute();
        $tingkat = $query->fetch(PDO::FETCH_ASSOC);
        if (!$tingkat) {
            throw new Exception("Tingkat not found");
        }

        return $peringkat['multiple'] * $tingkat['point'];
    }
    
}

