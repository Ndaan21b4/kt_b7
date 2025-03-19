<?php
require_once '../../config/database.php';
require_once '../../models/SinhVienModel.php';

$database = new Database();
$db = $database->connect();

$sinhVien = new SinhVien($db);
$stmt = $sinhVien->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách sinh viên</h1>
        <a href="../../public/index.php" class="btn btn-danger mb-3">Trở lại</a>
        <a href="create.php" class="btn btn-primary mb-3">Thêm sinh viên</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Hình ảnh</th>
                    <th>Mã ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['MaSV']; ?></td>
                        <td><?php echo $row['HoTen']; ?></td>
                        <td><?php echo $row['GioiTinh']; ?></td>
                        <td><?php echo $row['NgaySinh']; ?></td>
<td><img src="<?php echo $row['Hinh']; ?>" width="100" alt="Hình ảnh"></td>

                        <td><?php echo $row['MaNganh']; ?></td>
                        <td>
                            <a href="edit.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            <a href="detail.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-success" >Chi tiết</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>