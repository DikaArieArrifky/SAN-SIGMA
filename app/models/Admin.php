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
    public function getAllVerifikasiAndPenghargaanOv()
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
             where v.verif_admin !='DiProses' and v.visible_verifikasis = '1'
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

    // verifikasi section
    public function updateVerification($verifikasiId, $status, $pesan, $idAdmin)
    {
        try {
            $this->db->beginTransaction();
            // Update verification status
            $query = $this->db->prepare("
            UPDATE verifikasis 
            SET verif_admin = :status,
                pesan_admin = :pesan,
                admin_id = :id_admin
            WHERE id = :id
        ");

            $query->bindValue(":status", $status);
            $query->bindValue(":pesan", $pesan);
            $query->bindValue(":id", $verifikasiId);
            $query->bindValue(":id_admin", $idAdmin);
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

    public function getCountAllPenghargaan()
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count1 FROM penghargaans");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCountVerifiedPenghargaan()
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE verif_admin = 'Terverifikasi' and verif_pembimbing = 'Terverifikasi'");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCountNotVerifiedPenghargaan()
    {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM verifikasis WHERE verif_admin = 'DiProses'");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountNameTingkatanPenghargaanByVerifTerverifikasi()
    {
        $query = $this->db->prepare("
            SELECT 
                t.nama as nama,
                COUNT(*) AS count
            FROM verifikasis v 
            LEFT JOIN penghargaans p ON v.penghargaan_id = p.id
            LEFT JOIN tingkatans t ON p.tingkat_id = t.id
            WHERE v.verif_admin = 'Terverifikasi' 
            AND v.verif_pembimbing = 'Terverifikasi'
            GROUP BY t.nama 
            ORDER BY count DESC
        ");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Format data for chart
        $formatted = [
            'labels' => [],
            'counts' => []
        ];

        foreach ($results as $row) {
            $formatted['labels'][] = $row['nama'];
            $formatted['counts'][] = (int)$row['count'];
        }

        return $formatted;
    }


    public function getCountAngkatanMahasiswa()
    {
        $query = $this->db->prepare("
SELECT m.college_year, COUNT(*) AS count
 FROM verifikasis v 
 INNER JOIN mahasiswas m ON v.mahasiswa_nim = m.nim
 WHERE v.verif_admin = 'Terverifikasi' AND v.verif_pembimbing = 'Terverifikasi'
 GROUP BY m.college_year
        ");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Format data for chart
        $formatted = [
            'labels' => [],
            'counts' => []
        ];

        foreach ($results as $row) {
            $formatted['labels'][] = $row['college_year'];
            $formatted['counts'][] = (int)$row['count'];
        }

        return $formatted;
    }

    public function getCountTahunVerif()
    {
        $query = $this->db->prepare("SELECT YEAR(v.verifed_at) as year, COUNT(*) AS count
FROM verifikasis v
WHERE v.verif_admin = 'Terverifikasi' AND v.verif_pembimbing = 'Terverifikasi'
GROUP BY YEAR(v.verifed_at)
ORDER BY year ASC");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Format data for chart
        $formatted = [
            'labels' => [],
            'counts' => []
        ];

        foreach ($results as $row) {
            $formatted['labels'][] = $row['year'];
            $formatted['counts'][] = (int)$row['count'];
        }

        return $formatted;
    }
}
