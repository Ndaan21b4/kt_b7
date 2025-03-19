<?php
require_once '../../config/database.php';
require_once '../../models/SinhVienModel.php';

$database = new Database();
$db = $database->connect();

$sinhVien = new SinhVien($db);

// Lấy MaSV từ URL
if (isset($_GET['MaSV'])) {
    $sinhVien->MaSV = $_GET['MaSV'];
    $stmt = $sinhVien->read_single();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Không tìm thấy sinh viên.");
    }
} else {
    die("Không có mã sinh viên được cung cấp.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="display-4">Thông tin chi tiết Sinh viên</h1>
            <p class="lead">Xem và quản lý thông tin cá nhân của sinh viên</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-circle me-2"></i>
                            Thông tin cá nhân
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="<?php echo $row['Hinh']; ?>" alt="Hình ảnh sinh viên" class="profile-img">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Mã Sinh viên:</strong> <?php echo $row['MaSV']; ?></p>
                                <p><strong>Họ tên:</strong> <?php echo $row['HoTen']; ?></p>
                                <p><strong>Giới tính:</strong> <?php echo $row['GioiTinh']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Ngày sinh:</strong> <?php echo date('d/m/Y', strtotime($row['NgaySinh'])); ?></p>
                                <p><strong>Mã ngành:</strong> <?php echo $row['MaNganh']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách học phần đã đăng ký -->
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-journal-check me-2"></i>
                            Học phần đã đăng ký
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Lấy danh sách học phần đã đăng ký
                        $query = "SELECT hp.TenHP, hp.SoTinChi 
                                  FROM ChiTietDangKy ctdk 
                                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP 
                                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK 
                                  WHERE dk.MaSV = :MaSV";
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':MaSV', $row['MaSV']);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            echo '<ul class="list-group">';
                            while ($hp = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                        ' . $hp['TenHP'] . '
                                        <span class="badge bg-primary rounded-pill">' . $hp['SoTinChi'] . ' tín chỉ</span>
                                      </li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p class="text-muted">Sinh viên chưa đăng ký học phần nào.</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Nút quay lại -->
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>