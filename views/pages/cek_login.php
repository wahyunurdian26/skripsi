<?php
require_once "../../controllers/login.php";
require_once "../../config/database.php";
$cekuser = new login;
$cekuser->DoLogin();
