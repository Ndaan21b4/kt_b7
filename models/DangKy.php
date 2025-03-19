<?php

class DangKy {
    private $conn;
    private $table = 'DangKy';

    public $MaDK;
    public $NgayDK;
    public $MaSV;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}