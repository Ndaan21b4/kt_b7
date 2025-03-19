<?php
require_once '../config/database.php';
require_once '../models/HocPhanModel.php';

$database = new Database();
$db = $database->connect();
$hocPhan = new HocPhan($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hocPhan->MaHP = $_POST['MaHP'];
    $hocPhan->TenHP = $_POST['TenHP'];
    $hocPhan->SoTinChi = $_POST['SoTinChi'];

    if ($hocPhan->create()) {
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Thêm học phần thất bại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Học Phần</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Mã Học Phần</label>
                <input type="text" name="MaHP" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên Học Phần</label>
                <input type="text" name="TenHP" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Số Tín Chỉ</label>
                <input type="number" name="SoTinChi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="index.php" class="btn btn-danger">Hủy</a>
        </form>
    </div>
</body>
</html>
