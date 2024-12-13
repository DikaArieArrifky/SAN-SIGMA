<?php
require_once 'app/core/Model.php';
require_once 'app/core/IModelData.php';

class Tingkatan extends Model implements IModelData
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    // Get all tingkatan
    public function getAll()
    {
        $query = $this->db->prepare("
            SELECT * FROM tingkatans 
            WHERE visible_tingkatans = 1
            ORDER BY id ASC
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create tingkatan
    public function create($nama, $point)
    {
        try {
            $query = $this->db->prepare("
                INSERT INTO tingkatans (nama, point)
                VALUES (:nama, :point)
            ");
            $query->bindValue(":nama", $nama);
            $query->bindValue(":point", $point);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error creating tingkatan: " . $e->getMessage());
        }
    }

    // Update tingkatan
    public function update($id, $nama, $point)
    {
        try {
            $query = $this->db->prepare("
                UPDATE tingkatans 
                SET nama = :nama, point = :point
                WHERE id = :id
            ");
            $query->bindValue(":nama", $nama);
            $query->bindValue(":point", $point);
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating tingkatan: " . $e->getMessage());
        }
    }

    // Delete tingkatan (soft delete)
    public function delete($id)
    {
        try {
            $query = $this->db->prepare("
                UPDATE tingkatans 
                SET visible_tingkatans = 0
                WHERE id = :id
            ");
            $query->bindValue(":id", $id);
            return $query->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting tingkatan: " . $e->getMessage());
        }
    }
}