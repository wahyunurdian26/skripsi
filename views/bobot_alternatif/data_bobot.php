<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$data_bobot = new Main;
$data_bobot->Penilaian();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
