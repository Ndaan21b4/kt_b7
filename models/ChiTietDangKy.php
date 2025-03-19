<?php

class ChiTietDangKy {
    private $conn;
    private $table = 'ChiTietDangKy';

    public $MaDK;
    public $MaHP;

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