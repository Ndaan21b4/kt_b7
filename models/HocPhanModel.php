<?php

class HocPhan {
    private $conn;
    private $table = 'HocPhan';

    public $MaHP;
    public $TenHP;
    public $SoTinChi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaHP = :MaHP LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaHP', $this->MaHP);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (MaHP, TenHP, SoTinChi) VALUES (:MaHP, :TenHP, :SoTinChi)';
        $stmt = $this->conn->prepare($query);

        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));
        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));

        $stmt->bindParam(':MaHP', $this->MaHP);
        $stmt->bindParam(':TenHP', $this->TenHP);
        $stmt->bindParam(':SoTinChi', $this->SoTinChi);

        return $stmt->execute();
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET TenHP = :TenHP, SoTinChi = :SoTinChi 
                  WHERE MaHP = :MaHP';
        $stmt = $this->conn->prepare($query);

        $this->TenHP = htmlspecialchars(strip_tags($this->TenHP));
        $this->SoTinChi = htmlspecialchars(strip_tags($this->SoTinChi));
        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));

        $stmt->bindParam(':TenHP', $this->TenHP);
        $stmt->bindParam(':SoTinChi', $this->SoTinChi);
        $stmt->bindParam(':MaHP', $this->MaHP);

        return $stmt->execute();
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE MaHP = :MaHP';
        $stmt = $this->conn->prepare($query);

        $this->MaHP = htmlspecialchars(strip_tags($this->MaHP));

        $stmt->bindParam(':MaHP', $this->MaHP);

        return $stmt->execute();
    }
}
?>
