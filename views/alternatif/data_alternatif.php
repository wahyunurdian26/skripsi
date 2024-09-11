<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$dataalternatif = new Main;
$dataalternatif->DataAlternatif();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
