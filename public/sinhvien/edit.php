<?php
require_once '../../config/database.php';
require_once '../../models/SinhVienModel.php';

$database = new Database();
$db = $database->connect();

$sinhVien = new SinhVien($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sinhVien->MaSV = $_POST['MaSV'];
    $sinhVien->HoTen = $_POST['HoTen'];
    $sinhVien->GioiTinh = $_POST['GioiTinh'];
    $sinhVien->NgaySinh = $_POST['NgaySinh'];
    $sinhVien->Hinh = $_POST['Hinh'];
    $sinhVien->MaNganh = $_POST['MaNganh'];

    if ($sinhVien->update()) {
        header("Location: index.php");
    } else {
        echo "Lỗi: Không thể cập nhật sinh viên.";
    }
} else {
    $sinhVien->MaSV = $_GET['MaSV'];
    $stmt = $sinhVien->read_single();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sửa sinh viên</h1>
        <form method="POST" action="edit.php">
            <!-- Thêm trường nhập MSSV và vô hiệu hóa chỉnh sửa -->
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" value="<?php echo $row['MaSV']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $row['HoTen']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới tính</label>
                <select class="form-control" id="GioiTinh" name="GioiTinh" required>
                    <option value="Nam" <?php echo ($row['GioiTinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($row['GioiTinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?php echo $row['NgaySinh']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình ảnh</label>
                <input type="text" class="form-control" id="Hinh" name="Hinh" value="<?php echo $row['Hinh']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã ngành</label>
                <input type="text" class="form-control" id="MaNganh" name="MaNganh" value="<?php echo $row['MaNganh']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>