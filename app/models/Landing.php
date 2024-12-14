<?php

require_once 'app/core/Model.php';

class Landing extends Model
{
    public function __construct($db)
    {
        parent::__construct($db);
    }



    public function getAllmahasiswas()
    {
        $query = $this->db->prepare("SELECT * FROM mahasiswas");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop10mahasiswas()
    {
        $query = $this->db->prepare("SELECT TOP 10 * FROM mahasiswas ORDER BY score DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //get top10dosen
    public function getTop10dosen()
    {
        $query = $this->db->prepare("SELECT TOP 10 * FROM dosens ORDER BY score DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //get top 10 new verifikasi with judu
    public function getTop10NewVerifikasi()
    {
        $query = $this->db->prepare("
            SELECT TOP 10 
                p.judul,
                m.name as mahasiswa_name,
                t.nama as tingkatan_name
            FROM verifikasis v
            JOIN penghargaans p ON v.penghargaan_id = p.id
            JOIN mahasiswas m ON p.mahasiswa_nim = m.nim
            JOIN tingkatans t ON p.tingkat_id = t.id
            WHERE v.verif_admin = 'Terverifikasi' 
            AND v.verif_pembimbing = 'Terverifikasi'
            ORDER BY v.verifed_at DESC
        ");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNewVerifikasi(){
        $query = $this->db->prepare("
            SELECT 
                p.judul,
                m.name as mahasiswa_name,
                t.nama as tingkatan_name
            FROM verifikasis v
            JOIN penghargaans p ON v.penghargaan_id = p.id
            JOIN mahasiswas m ON p.mahasiswa_nim = m.nim
            JOIN tingkatans t ON p.tingkat_id = t.id
            WHERE v.verif_admin = 'Terverifikasi' 
            AND v.verif_pembimbing = 'Terverifikasi'
            ORDER BY v.verifed_at DESC
        ");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop10MahasiswaByYear($year)
    {
        $query = $this->db->prepare("
            SELECT * FROM dbo.fn_GetTop10MahasiswaScoresByYear(:year)
        ");

        $query->execute([':year' => $year]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop10DosenByYear($year){
        $query = $this->db->prepare("
            SELECT * FROM dbo.fn_GetTop10DosenScoresByYear(:year)
        ");
        $query->execute([':year' => $year]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
