<?php
require_once 'app/core/Model.php';
require_once 'app/core/IUserApp.php';

class Admin extends Model implements IUserApp
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function getAdminByUserId($userId)
    {
        $query = $this->db->prepare("SELECT * FROM admins WHERE user_id = :user_id");
        $query->bindValue(":user_id", $userId);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserId($username)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE Username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['id'];
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
    
    public function getAllVerifikasiAndPenghargaan()
    {
        $query = $this->db->prepare("
            SELECT 
                v.*,
                p.*,
                t.nama as tingkatan_nama,
                d.name as dosen_name,
                m.name as mahasiswa_name

            FROM verifikasis v
            LEFT JOIN penghargaans p ON v.penghargaan_id = p.id
            LEFT JOIN tingkatans t ON p.tingkat_id = t.id
            LEFT JOIN dosens d ON v.dosen_nip = d.nip
            LEFT JOIN mahasiswas m ON v.mahasiswa_nim = m.nim
             where v.verif_admin ='DiProses' and v.visible_verifikasis = '1'
            ORDER BY v.created_at DESC
           
        ");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getVerifikasiAndPenghargaanByIdVerifikasi($idVerifikasi)
    {
        $query = $this->db->prepare("
            SELECT 
                v.*,
                p.*,
                t.nama as tingkatan_nama,
                d.name as dosen_name,
                d.nip as dosen_nip,
                per.nama as peringkat_nama,
                m.name as mahasiswa_name,
                m.nim as nim,
                m.college_year as angkatan,
                prod.nama as prodi
               
            FROM verifikasis v
            LEFT JOIN penghargaans p ON v.penghargaan_id = p.id
            LEFT JOIN tingkatans t ON p.tingkat_id = t.id
            LEFT JOIN peringkats per ON p.peringkat_id = per.id
            LEFT JOIN dosens d ON v.dosen_nip = d.nip
            LEFT JOIN mahasiswas m ON v.mahasiswa_nim = m.nim
            LEFT JOIN prodis prod ON m.prodi_id = prod.id
            WHERE v.id = :id
        ");
        
        $query->bindValue(":id", $idVerifikasi);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
