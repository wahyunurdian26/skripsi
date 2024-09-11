<?php
require_once "../../controllers/login.php";
require_once "../../config/database.php";
$logout = new login;
$logout->logout();
