<?php

require_once 'app/core/Model.php';
require_once 'app/core/IUserApp.php';
class Dosen extends Model implements IUserApp
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

    public function getProdiNameBydosenProdiId($prodiId) 
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
    
    public function getAllDosen()
    {
        $query = $this->db->prepare("SELECT * FROM dosens WHERE visible_dosens = 1 and status = 'Aktif' order by name asc");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPasswordByUserId($x)
    {
        $query = $this->db->prepare("SELECT password FROM users WHERE id = :id");
        $query->bindValue(":id", $x);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['password'];
    }
    public function getVerifikasiAndPenghargaanByNip($nip)
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
        
        $query->bindValue(":nim", $nip);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPhotoByNip($nip)
    {
        try {
            $query = $this->db->prepare("
            SELECT photo 
            FROM dosens
            WHERE nip = :nip
        ");

            $query->bindValue(":nip", $nip);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['photo'] : null;
        } catch (PDOException $e) {
            error_log("Error fetching photo: " . $e->getMessage());
            return null;
        }
    }
    public function updatePhoto($nip, $photo)
    {
        $query = $this->db->prepare("UPDATE dosens SET photo = :photo WHERE nip = :nip");
        $query->bindValue(":photo", $photo);
        $query->bindValue(":nip", $nip);
        $query->execute();
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


    public function getDosenVerifikasiByNIP($nip)
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
            
            WHERE v.dosen_nip = :nip
            ORDER BY v.created_at DESC
        ");
        
        $query->bindValue(":nip", $nip);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getVerifikasiAndPenghargaanByIdVerifikasi($idVerifikasi)
    {
        $query = $this->db->prepare("
            SELECT 
                v.*,
                p.*,
                p.id as pengId,
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
