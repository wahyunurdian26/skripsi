<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$setting = new Main;
$setting->Setting();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
