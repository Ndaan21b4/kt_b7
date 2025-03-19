<?php

class NganhHoc {
    private $conn;
    private $table = 'NganhHoc';

    public $MaNganh;
    public $TenNganh;

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