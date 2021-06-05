<?php
require_once '../vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setAuthConfig('../client_secret.json');
$google_client->setRedirectUri('http://localhost/UTSBPWL_Boby_20TIA/controllers/proses.php?aksi=login_google_api');
$google_client->addScope('email');
$google_client->addScope('profile');
$google_client->addScope('https://www.googleapis.com/auth/user.birthday.read');

if (!session_id())
{
    session_start();
}
?>
