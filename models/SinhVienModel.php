<?php

class SinhVien {
    private $conn;
    private $table = 'SinhVien';

    public $MaSV;
    public $HoTen;
    public $GioiTinh;
    public $NgaySinh;
    public $Hinh;
    public $MaNganh;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Phương thức đọc tất cả sinh viên
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Phương thức đọc một sinh viên theo MaSV
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE MaSV = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        return $stmt;
    }

    // Phương thức tạo mới sinh viên
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET MaSV = :MaSV, HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh';
        $stmt = $this->conn->prepare($query);
    
        // Làm sạch dữ liệu
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV)); // Thêm dòng này
        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
        $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
        $this->NgaySinh = htmlspecialchars(strip_tags($this->NgaySinh));
        $this->Hinh = htmlspecialchars(strip_tags($this->Hinh));
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
    
        // Bind dữ liệu
        $stmt->bindParam(':MaSV', $this->MaSV); // Thêm dòng này
        $stmt->bindParam(':HoTen', $this->HoTen);
        $stmt->bindParam(':GioiTinh', $this->GioiTinh);
        $stmt->bindParam(':NgaySinh', $this->NgaySinh);
        $stmt->bindParam(':Hinh', $this->Hinh);
        $stmt->bindParam(':MaNganh', $this->MaNganh);
    
        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }
    
        // In lỗi nếu có vấn đề
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Phương thức cập nhật sinh viên
    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh 
                  WHERE MaSV = :MaSV';
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
        $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
        $this->NgaySinh = htmlspecialchars(strip_tags($this->NgaySinh));
        $this->Hinh = htmlspecialchars(strip_tags($this->Hinh));
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));

        // Bind dữ liệu
        $stmt->bindParam(':HoTen', $this->HoTen);
        $stmt->bindParam(':GioiTinh', $this->GioiTinh);
        $stmt->bindParam(':NgaySinh', $this->NgaySinh);
        $stmt->bindParam(':Hinh', $this->Hinh);
        $stmt->bindParam(':MaNganh', $this->MaNganh);
        $stmt->bindParam(':MaSV', $this->MaSV);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }

        // In lỗi nếu có vấn đề
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Phương thức xóa sinh viên
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE MaSV = :MaSV';
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));

        // Bind dữ liệu
        $stmt->bindParam(':MaSV', $this->MaSV);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }

        // In lỗi nếu có vấn đề
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}