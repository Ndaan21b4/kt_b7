<?php

require_once '../models/NganhHocModel.php';
require_once '../config/database.php';

$database = new Database();
$db = $database->connect();

$nganhHoc = new NganhHoc($db);

$result = $nganhHoc->read();

$num = $result->rowCount();

if($num > 0) {
    $nganhHoc_arr = array();
    $nganhHoc_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $nganhHoc_item = array(
            'MaNganh' => $MaNganh,
            'TenNganh' => $TenNganh
        );

        array_push($nganhHoc_arr['data'], $nganhHoc_item);
    }

    echo json_encode($nganhHoc_arr);
} else {
    echo json_encode(
        array('message' => 'No NganhHoc Found')
    );
}