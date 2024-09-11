<?php
require_once "sendMail.php";
$confirm_OTP = new sendMail;
$confirm_OTP->confirmOTP();
