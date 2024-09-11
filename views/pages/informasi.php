<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$informasi = new Main;
$informasi->InformasiProgram();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
