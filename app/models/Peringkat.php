<?php

require_once 'app/core/Model.php';
require_once 'app/core/IModelData.php';

class Peringkat extends Model implements IModelData
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    // Get all Peringkat
    public function getAll()
    {
        $query = $this->db->prepare("
            SELECT * FROM peringkats 
            WHERE visible_peringkats = 1
            ORDER BY id ASC
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get peringkat by id
    public function getById($id)
    {
        $query = $this->db->prepare("
            SELECT * FROM peringkats 
            WHERE id = :id
        ");
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Create peringkat
    public function create($nama, $multiple)
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO peringkats (nama, multiple)
                VALUES (:nama, :multiple)
            ");
            $query->bindValue(":nama", $nama);
            $query->bindValue(":multiple", $multiple);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error creating peringkat: " . $e->getMessage());
        }
    }

    // Update peringkat
    public function update($id, $nama, $multiple)
    {
        try {
            $query = $this->db->prepare("
                UPDATE peringkats 
                SET nama = :nama, multiple = :multiple
                WHERE id = :id
            ");
            $query->bindValue(":nama", $nama);
            $query->bindValue(":multiple", $multiple);
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating peringkat: " . $e->getMessage());
        }
    }

    // Delete peringkat (soft delete)
    public function delete($id)
    {
        try {
            $query = $this->db->prepare("
                UPDATE peringkats 
                SET visible_peringkats = 0
                WHERE id = :id
            ");
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting peringkat: " . $e->getMessage());
        }
    }
}