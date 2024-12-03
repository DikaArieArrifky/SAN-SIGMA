<?php

require_once 'app/core/Model.php';

class Landing extends Model
{
    public function __construct($db)
    {
        parent::__construct($db);
    }


    public function getAllmahasiswas() {
        $query = $this->db->prepare("SELECT * FROM mahasiswas");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop10mahasiswas() {
        $query = $this->db->prepare("SELECT TOP 10 * FROM mahasiswas ORDER BY score DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //get top10dosen
    public function getTop10dosen() {
        $query = $this->db->prepare("SELECT TOP 10 * FROM dosens ORDER BY score DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
