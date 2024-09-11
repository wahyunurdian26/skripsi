<?php
require_once "../../config/database.php";
require_once "sendMail.php";
$Reset_password = new sendMail;
$Reset_password->Reset_password();
