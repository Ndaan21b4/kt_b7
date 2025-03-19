<?php
require_once '../../config/database.php';
require_once '../../models/HocPhanModel.php';

$database = new Database();
$db = $database->connect();

$hocPhan = new HocPhan($db);
$stmt = $hocPhan->read();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh Sách Học Phần</h1>
        <a href="../../public/index.php" class="btn btn-danger mb-3">Trở lại</a>
        <a href="create.php" class="btn btn-primary mb-3">Thêm Học Phần</a>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['MaHP']); ?></td>
                        <td><?php echo htmlspecialchars($row['TenHP']); ?></td>
                        <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
                        <td>
                            <a href="edit.php?MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete.php?MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
