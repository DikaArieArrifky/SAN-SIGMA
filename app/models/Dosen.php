<?php
require_once 'app/core/Model.php';

class Dosen extends Model {

    public function __construct($db)
    {
        parent::__construct($db);
    }
    
    public function getAllDosen()
    {
        $query = $this->db->prepare("SELECT * FROM dosens WHERE visible_dosens = 1 and status = 'Aktif' order by name asc");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
        
    public function getProdiDosen()
    {
        $sql = "SELECT d.name, p.nama AS jurusan, d.score 
                FROM dosens d
                INNER JOIN prodis p ON d.prodi_id = p.id
                ORDER BY d.score DESC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
