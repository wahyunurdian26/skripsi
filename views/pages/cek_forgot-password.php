<?php
require_once "../../config/database.php";
require_once "SendMail.php";
$SendEmail = new sendMail;
$SendEmail->SendForgotPassword();
