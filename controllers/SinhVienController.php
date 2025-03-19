<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../config/database.php';
require_once '../models/SinhVienModel.php';

$database = new Database();
$db = $database->connect();

$sinhVien = new SinhVien($db);

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        // Đọc dữ liệu
        if (isset($_GET['MaSV'])) {
            // Đọc một sinh viênx``
            $sinhVien->MaSV = $_GET['MaSV'];
            $stmt = $sinhVien->read_single();
            $num = $stmt->rowCount();

            if ($num > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($row);
            } else {
                echo json_encode(array('message' => 'SinhVien not found'));
            }
        } else {
            // Đọc tất cả sinh viên
            $stmt = $sinhVien->read();
            $num = $stmt->rowCount();

            if ($num > 0) {
                $sinhVien_arr = array();
                $sinhVien_arr['data'] = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $sinhVien_item = array(
                        'MaSV' => $MaSV,
                        'HoTen' => $HoTen,
                        'GioiTinh' => $GioiTinh,
                        'NgaySinh' => $NgaySinh,
                        'Hinh' => $Hinh,
                        'MaNganh' => $MaNganh
                    );
                    array_push($sinhVien_arr['data'], $sinhVien_item);
                }
                echo json_encode($sinhVien_arr);
            } else {
                echo json_encode(array('message' => 'No SinhVien found'));
            }
        }
        break;

    case 'POST':
        // Tạo mới sinh viên
        $data = json_decode(file_get_contents("php://input"));

        $sinhVien->HoTen = $data->HoTen;
        $sinhVien->GioiTinh = $data->GioiTinh;
        $sinhVien->NgaySinh = $data->NgaySinh;
        $sinhVien->Hinh = $data->Hinh;
        $sinhVien->MaNganh = $data->MaNganh;

        if ($sinhVien->create()) {
            echo json_encode(array('message' => 'SinhVien created'));
        } else {
            echo json_encode(array('message' => 'SinhVien not created'));
        }
        break;

    case 'PUT':
        // Cập nhật sinh viên
        $data = json_decode(file_get_contents("php://input"));

        $sinhVien->MaSV = $data->MaSV;
        $sinhVien->HoTen = $data->HoTen;
        $sinhVien->GioiTinh = $data->GioiTinh;
        $sinhVien->NgaySinh = $data->NgaySinh;
        $sinhVien->Hinh = $data->Hinh;
        $sinhVien->MaNganh = $data->MaNganh;

        if ($sinhVien->update()) {
            echo json_encode(array('message' => 'SinhVien updated'));
        } else {
            echo json_encode(array('message' => 'SinhVien not updated'));
        }
        break;

    case 'DELETE':
        // Xóa sinh viên
        $data = json_decode(file_get_contents("php://input"));

        $sinhVien->MaSV = $data->MaSV;

        if ($sinhVien->delete()) {
            echo json_encode(array('message' => 'SinhVien deleted'));
        } else {
            echo json_encode(array('message' => 'SinhVien not deleted'));
        }
        break;

    default:
        // Phương thức không được hỗ trợ
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(array('message' => 'Method not allowed'));
        break;
}