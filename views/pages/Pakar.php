<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$halamanadmin = new Main;
$halamanadmin->HalamanUtamaPakar();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
