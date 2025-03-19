<?php
require_once '../config/Database.php';

// Kết nối database
$database = new Database();
$db = $database->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý KT_B7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-card {
            transition: transform 0.2s;
            min-height: 150px;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">HỆ THỐNG QUẢN LÝ KT_B7</h1>
            <p class="lead">Quản lý thông tin giáo dục toàn diện</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- Thống kê nhanh -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 dashboard-card bg-primary text-white">
                    <div class="card-body">
                        <?php 
                        $result = $db->query("SELECT COUNT(*) FROM SinhVien");
                        $count = $result->fetchColumn();
                        ?>
                        <h5><i class="bi bi-people-fill"></i> Sinh viên</h5>
                        <h2 class="display-6"><?php echo $count; ?></h2>
                        <a href="sinhvien/index.php" class="stretched-link text-white text-decoration-none"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 dashboard-card bg-success text-white">
                    <div class="card-body">
                        <?php 
                        $result = $db->query("SELECT COUNT(*) FROM NganhHoc");
                        $count = $result->fetchColumn();
                        ?>
                        <h5><i class="bi bi-book-half"></i> Ngành học</h5>
                        <h2 class="display-6"><?php echo $count; ?></h2>
                        <a href="nganhhoc/index.php" class="stretched-link text-white text-decoration-none"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 dashboard-card bg-warning text-dark">
                    <div class="card-body">
                        <?php 
                        $result = $db->query("SELECT COUNT(*) FROM HocPhan");
                        $count = $result->fetchColumn();
                        ?>
                        <h5><i class="bi bi-journal-text"></i> Học phần</h5>
                        <h2 class="display-6"><?php echo $count; ?></h2>
                        <a href="hocphan/index.php" class="stretched-link text-dark text-decoration-none"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100 dashboard-card bg-info text-white">
                    <div class="card-body">
                        <?php 
                        $result = $db->query("SELECT COUNT(DISTINCT MaSV) FROM DangKy");
                        $count = $result->fetchColumn();
                        ?>
                        <h5><i class="bi bi-clipboard-check"></i> Đăng ký môn</h5>
                        <h2 class="display-6"><?php echo $count; ?></h2>
                        <a href="dangky/index.php" class="stretched-link text-white text-decoration-none"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu chức năng -->
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Quản lý chức năng</h5>
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <a href="sinhvien/index.php" class="btn btn-outline-primary w-100 py-3">
                                    <i class="bi bi-people-fill me-2"></i>
                                    Quản lý Sinh viên
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="nganhhoc/index.php" class="btn btn-outline-success w-100 py-3">
                                    <i class="bi bi-book-half me-2"></i>
                                    Quản lý Ngành học
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="hocphan/index.php" class="btn btn-outline-warning w-100 py-3">
                                    <i class="bi bi-journal-text me-2"></i>
                                    Quản lý Học phần
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="dangky/index.php" class="btn btn-outline-info w-100 py-3">
                                    <i class="bi bi-clipboard-check me-2"></i>
                                    Quản lý Đăng ký
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center text-muted">
            <hr>
            <p>Hệ thống quản lý KT_B7 © <?php echo date('Y'); ?></p>
        </footer>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>