<?php

require_once '../models/DangKy.php';
require_once '../config/database.php';

$database = new Database();
$db = $database->connect();

$dangKy = new DangKy($db);

$result = $dangKy->read();

$num = $result->rowCount();

if($num > 0) {
    $dangKy_arr = array();
    $dangKy_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dangKy_item = array(
            'MaDK' => $MaDK,
            'NgayDK' => $NgayDK,
            'MaSV' => $MaSV
        );

        array_push($dangKy_arr['data'], $dangKy_item);
    }

    echo json_encode($dangKy_arr);
} else {
    echo json_encode(
        array('message' => 'No DangKy Found')
    );
}