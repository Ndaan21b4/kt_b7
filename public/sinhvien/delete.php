<?php
require_once '../../config/database.php';
require_once '../../models/SinhVienModel.php';

$database = new Database();
$db = $database->connect();

$sinhVien = new SinhVien($db);

if (isset($_GET['MaSV'])) {
    $sinhVien->MaSV = $_GET['MaSV'];

    if ($sinhVien->delete()) {
        header("Location: index.php");
    } else {
        echo "Lỗi: Không thể xóa sinh viên.";
    }
}
?>