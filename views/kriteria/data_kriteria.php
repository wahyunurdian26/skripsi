<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$datakriteria = new Main;
$datakriteria->DataKriteria();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
