<?php
require_once __DIR__ . '/kt_b7/config/database.php';

class BaseController {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
?>
