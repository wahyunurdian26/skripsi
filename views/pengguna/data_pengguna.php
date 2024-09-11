<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$halamanadmin = new Main;
$halamanadmin->DataPengguna();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
