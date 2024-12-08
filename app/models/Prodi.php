<?php

require_once 'app/core/Model.php';
require_once 'app/core/IModelData.php';

class Prodi extends Model implements IModelData
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    // Get all prodi
    public function getAll()
    {
        $query = $this->db->prepare("
        SELECT * FROM prodis 
        WHERE visible_prodis = 1
        ORDER BY nama ASC
    ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create prodi
    public function create($nama)
    {
        try {
            $query = $this->db->prepare("
            INSERT INTO prodis (nama)
            VALUES (:nama)
        ");
            $query->bindValue(":nama", $nama);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error creating prodi: " . $e->getMessage());
        }
    }

    // Update prodi
    public function update($id, $nama)
    {
        try {
            $query = $this->db->prepare("
            UPDATE prodis 
            SET nama = :nama
            WHERE id = :id
        ");
            $query->bindValue(":nama", $nama);
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating prodi: " . $e->getMessage());
        }
    }

    // Delete prodi (soft delete)
    public function delete($id)
    {
        try {
            $query = $this->db->prepare("
            UPDATE prodis 
            SET visible_prodis = 0
            WHERE id = :id
        ");
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting prodi: " . $e->getMessage());
        }
    }
}
