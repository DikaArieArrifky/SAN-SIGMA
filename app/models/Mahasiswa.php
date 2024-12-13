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

    public function getProdiNameByMhsProdiId()
    {
        $sql = "SELECT d.name, p.nama AS jurusan, d.score 
                FROM mahasiswas d
                INNER JOIN prodis p ON d.prodi_id = p.id
                ORDER BY d.score DESC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMahasiswaByVerifiedYear($year)
    {
    $query = $this->db->prepare("
        SELECT 
            m.name, 
            m.nim, 
            v.verifed_at, 
            m.score 
        FROM mahasiswas m
        INNER JOIN verifikasis v ON m.nim = v.mahasiswa_nim
        WHERE YEAR(v.verifed_at) = :year
        ORDER BY v.verifed_at DESC");
    $query->bindValue(":year", $year, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableYears()
{
    $query = $this->db->query("
        SELECT DISTINCT YEAR(verifed_at) AS year 
        FROM verifikasis 
        ORDER BY year DESC
    ");
    return $query->fetchAll(PDO::FETCH_COLUMN);
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
public function insertPrestasi($data)
{
    $query = $this->db->prepare("
        INSERT INTO penghargaans (
            mahasiswa_nim, 
            judul, 
            tempat, 
            url, 
            tanggal_mulai, 
            tanggal_akhir, 
            jumlah_instansi, 
            jumlah_peserta,
            tingkat_id, 
            peringkat_id, 
            score,
            file_sertifikat, 
            file_poster, 
            file_photo_kegiatan
        ) VALUES (
            :mahasiswa_nim, 
            :judul, 
            :tempat, 
            :url,
            :tanggal_mulai, 
            :tanggal_akhir,
            :jumlah_instansi, 
            :jumlah_peserta,
            :tingkat_id, 
            :peringkat_id, 
            :score,
            :file_sertifikat, 
            :file_poster, 
            :file_photo_kegiatan
        )
    ");
    
    // Bind parameters explicitly
    $query->bindValue(':mahasiswa_nim', $data['mahasiswa_nim']);
    $query->bindValue(':judul', $data['judul']);
    $query->bindValue(':tempat', $data['tempat']);
    $query->bindValue(':url', $data['url']);
    $query->bindValue(':tanggal_mulai', $data['tanggal_mulai']);
    $query->bindValue(':tanggal_akhir', $data['tanggal_akhir']);
    $query->bindValue(':jumlah_instansi', $data['jumlah_instansi']);
    $query->bindValue(':jumlah_peserta', $data['jumlah_peserta']);
    $query->bindValue(':tingkat_id', $data['tingkat_id']);
    $query->bindValue(':peringkat_id', $data['peringkat_id']);
    $query->bindValue(':score', $data['score']);
    $query->bindValue(':file_sertifikat', $data['file_sertifikat']);
    $query->bindValue(':file_poster', $data['file_poster']);
    $query->bindValue(':file_photo_kegiatan', $data['file_photo_kegiatan']);
    
    $query->execute();
    return $this->db->lastInsertId();
}

public function insertVerifikasi($data)
{
    $query = $this->db->prepare("
        INSERT INTO verifikasis (
            mahasiswa_nim, dosen_nip, penghargaan_id,
            verif_admin, verif_pembimbing
        ) VALUES (
            :mahasiswa_nim, :dosen_nip, :penghargaan_id,
            :verif_admin, :verif_pembimbing
        )
    ");
    
    $query->execute($data);
    return $this->db->lastInsertId();
}
    
}

