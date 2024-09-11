<?php
require_once "../../controllers/main.php";
require_once "../../config/database.php";
$datasubkriteria = new Main;
$datasubkriteria->DataSubKriteria();
$akses = new database;
$akses->CekSesi();
// $akses->HakAkses();
