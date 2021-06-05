<?php
include '../config/LinkedIn_config.php';
use UTSBPWL\LinkedIn_config;
$app_id = "78ze6r7wken2fa";
$app_secret = "zctXZCzaze5XKZ92";
$callback = "http://localhost/UTSBPWL_Boby_20TIA/vendor/linkedin_callback.php";
$scopes = "r_emailaddress r_basicprofile r_liteprofile";
$ssl = false;

$accessToken = $linkedin->getAccessToken($_GET['code']);
$profileObject = $linkedin->getPerson();
$emailObject = $linkedin->getEmail();
?>