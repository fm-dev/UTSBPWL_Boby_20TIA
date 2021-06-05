<?php
require_once "LinkedIn.php";

$app_id = "78ze6r7wken2fa";
$app_secret = "zctXZCzaze5XKZ92";
$callback = "http://localhost/UTSBPWL_Boby_20TIA/controllers/proses.php?aksi=login_linkedin_api";
$scopes = "r_emailaddress r_basicprofile r_liteprofile";
$ssl = false; //TRUE FOR PRODUCTION ENV.

$linkedin = new LinkedIn($app_id, $app_secret, $callback, $scopes, $ssl);