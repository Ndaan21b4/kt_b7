<?php

require_once '../models/HocPhanModel.php';
require_once '../config/database.php';

// Kết nối Database
$database = new Database();
$db = $database->connect();

// Khởi tạo model
$hocPhan = new HocPhan($db);

// Lấy phương thức từ request (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Xử lý request dựa trên method
switch ($method) {
    case 'GET':
        if (isset($_GET['MaHP'])) {
            // 🟠 Lấy một học phần theo MaHP
            $hocPhan->MaHP = $_GET['MaHP'];
            $data = $hocPhan->readOne();
            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode(["message" => "Học phần không tồn tại"]);
            }
        } else {
            // 🟢 Lấy danh sách tất cả học phần
            $result = $hocPhan->read();
            $num = $result->rowCount();

            if ($num > 0) {
                $hocPhan_arr = ["data" => []];
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $hocPhan_arr["data"][] = [
                        "MaHP" => $MaHP,
                        "TenHP" => $TenHP,
                        "SoTinChi" => $SoTinChi
                    ];
                }
                echo json_encode($hocPhan_arr);
            } else {
                echo json_encode(["message" => "Không có học phần nào"]);
            }
        }
        break;

    case 'POST':
        // 🔵 Thêm học phần mới
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->MaHP) && !empty($data->TenHP) && isset($data->SoTinChi)) {
            $hocPhan->MaHP = $data->MaHP;
            $hocPhan->TenHP = $data->TenHP;
            $hocPhan->SoTinChi = $data->SoTinChi;

            if ($hocPhan->create()) {
                echo json_encode(["message" => "Thêm học phần thành công"]);
            } else {
                echo json_encode(["message" => "Không thể thêm học phần"]);
            }
        } else {
            echo json_encode(["message" => "Dữ liệu không hợp lệ"]);
        }
        break;

    case 'PUT':
        // 🟣 Cập nhật học phần
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->MaHP) && !empty($data->TenHP) && isset($data->SoTinChi)) {
            $hocPhan->MaHP = $data->MaHP;
            $hocPhan->TenHP = $data->TenHP;
            $hocPhan->SoTinChi = $data->SoTinChi;

            if ($hocPhan->update()) {
                echo json_encode(["message" => "Cập nhật học phần thành công"]);
            } else {
                echo json_encode(["message" => "Không thể cập nhật học phần"]);
            }
        } else {
            echo json_encode(["message" => "Dữ liệu không hợp lệ"]);
        }
        break;

    case 'DELETE':
        // 🔴 Xóa học phần
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->MaHP)) {
            $hocPhan->MaHP = $data->MaHP;
            if ($hocPhan->delete()) {
                echo json_encode(["message" => "Xóa học phần thành công"]);
            } else {
                echo json_encode(["message" => "Không thể xóa học phần"]);
            }
        } else {
            echo json_encode(["message" => "Dữ liệu không hợp lệ"]);
        }
        break;

    default:
        echo json_encode(["message" => "Phương thức không được hỗ trợ"]);
        break;
}
?>
