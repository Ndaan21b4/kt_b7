<?php

require_once '../models/ChiTietDangKy.php';
require_once '../config/database.php';

$database = new Database();
$db = $database->connect();

$chiTietDangKy = new ChiTietDangKy($db);

$result = $chiTietDangKy->read();

$num = $result->rowCount();

if($num > 0) {
    $chiTietDangKy_arr = array();
    $chiTietDangKy_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $chiTietDangKy_item = array(
            'MaDK' => $MaDK,
            'MaHP' => $MaHP
        );

        array_push($chiTietDangKy_arr['data'], $chiTietDangKy_item);
    }

    echo json_encode($chiTietDangKy_arr);
} else {
    echo json_encode(
        array('message' => 'No ChiTietDangKy Found')
    );
}