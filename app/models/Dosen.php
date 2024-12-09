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
    public function getDosenProsesVerifikasiByNIP($nip)
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
            
            WHERE v.verif_pembimbing = 'Diproses' and v.dosen_nip = :nip 
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

    public function updateVerification($verifikasiId, $status, $pesan)
    {
        try {
            $this->db->beginTransaction();
            // Update verification status
            $query = $this->db->prepare("
            UPDATE verifikasis 
            SET verif_pembimbing = :status,
                pesan_pembimbing = :pesan
            WHERE id = :id
        ");

            $query->bindValue(":status", $status);
            $query->bindValue(":pesan", $pesan);
            $query->bindValue(":id", $verifikasiId);
           
            $query->execute();

            // Get verification statuses
            $checkStatus = $this->db->prepare("
            SELECT verif_admin, verif_pembimbing 
            FROM verifikasis 
            WHERE id = :id
        ");
            $checkStatus->bindValue(":id", $verifikasiId);
            $checkStatus->execute();
            $result = $checkStatus->fetch(PDO::FETCH_ASSOC);

            // If both verified, update scores
            if (
                $result['verif_admin'] === 'Terverifikasi' &&
                $result['verif_pembimbing'] === 'Terverifikasi'
            ) {

                // Get prestasi details
                $prestasi = $this->getVerifikasiAndPenghargaanByIdVerifikasi($verifikasiId);

                $queryUpdateVerifiedat = $this->db->prepare("
                UPDATE verifikasis 
                SET verifed_at = CURRENT_TIMESTAMP
                WHERE id = :id
            ");
                $queryUpdateVerifiedat->bindValue(":id", $verifikasiId);
                $queryUpdateVerifiedat->execute();

                // Update mahasiswa score
                $queryMhs = $this->db->prepare("
                UPDATE mahasiswas 
                SET score = COALESCE(score, 0) + :score 
                WHERE nim = :nim
            ");
                $queryMhs->bindValue(":score", $prestasi['score']);
                $queryMhs->bindValue(":nim", $prestasi['mahasiswa_nim']);
                $queryMhs->execute();

                // Update dosen score
                $queryDosen = $this->db->prepare("
                UPDATE dosens 
                SET score = COALESCE(score, 0) + :score 
                WHERE nip = :nip
            ");
                $queryDosen->bindValue(":score", $prestasi['score']);
                $queryDosen->bindValue(":nip", $prestasi['dosen_nip']);
                $queryDosen->execute();
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getAll()
    {
        $query = $this->db->prepare("
            SELECT * FROM view_user_dosen
            ORDER BY nip ASC
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create user
    public function createUser($name, $username, $password, $role)
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO users (name, username, password, role)
                VALUES (:name, :username, :password, :role)
            ");
            $query->bindValue(":name", $name);
            $query->bindValue(":username", $username);
            $query->bindValue(":password", $password);
            $query->bindValue(":role", $role);
            $query->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Error creating user: " . $e->getMessage());
        }
    }

    // Create dosen
    public function createDosen($userId, $name, $nip, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $status)
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO dosens (user_id, name, nip, gender, phone_number, photo, alamat, kota, provinsi, agama, prodi_id, status)
                VALUES (:user_id, :name, :nip, :gender, :phone_number, :photo, :alamat, :kota, :provinsi, :agama, :prodi_id, :status)
            ");
            $query->bindValue(":user_id", $userId);
            $query->bindValue(":name", $name);
            $query->bindValue(":nip", $nip);
            $query->bindValue(":gender", $gender);
            $query->bindValue(":phone_number", $phone_number);
            $query->bindValue(":photo", $photo);
            $query->bindValue(":alamat", $alamat);
            $query->bindValue(":kota", $kota);
            $query->bindValue(":provinsi", $provinsi);
            $query->bindValue(":agama", $agama);
            $query->bindValue(":prodi_id", $prodi_id);
            $query->bindValue(":status", $status);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error creating dosen: " . $e->getMessage());
        }
    }

    // Update user
    public function updateUser($id, $username, $password)
    {
        try {
            $query = $this->db->prepare("
                UPDATE users 
                SET username = :username, password = :password
                WHERE id = :id
            ");
            $query->bindValue(":username", $username);
            $query->bindValue(":password", $password);
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating user: " . $e->getMessage());
        }
    }

    // Update dosen
    public function updateDosen($nip, $name, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $status)
    {
        try {
            $query = $this->db->prepare("
                UPDATE dosens 
                SET name = :name, gender = :gender, phone_number = :phone_number, photo = :photo, alamat = :alamat, kota = :kota, provinsi = :provinsi, agama = :agama, prodi_id = :prodi_id, status = :status
                WHERE nip = :nip
            ");
            $query->bindValue(":nip", $nip);
            $query->bindValue(":name", $name);
            $query->bindValue(":gender", $gender);
            $query->bindValue(":phone_number", $phone_number);
            $query->bindValue(":photo", $photo);
            $query->bindValue(":alamat", $alamat);
            $query->bindValue(":kota", $kota);
            $query->bindValue(":provinsi", $provinsi);
            $query->bindValue(":agama", $agama);
            $query->bindValue(":prodi_id", $prodi_id);
            $query->bindValue(":status", $status);

            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating dosen: " . $e->getMessage());
        }
    }

    // Delete dosen (soft delete)
    public function deleteDosen($nip)
    {
        try {
            $query = $this->db->prepare("
                UPDATE dosens 
                SET visible_dosens = 0
                WHERE nip = :nip
            ");
            $query->bindValue(":nip", $nip);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting dosen: " . $e->getMessage());
        }
    }

    // Delete user (soft delete)
    public function deleteUser($id)
    {
        try {
            $query = $this->db->prepare("
                UPDATE users 
                SET visible_users = 0
                WHERE id = :id
            ");
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting user: " . $e->getMessage());
        }
    }
}
