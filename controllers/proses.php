<?php
include '../models/database.php';
$db = new database();

if($_GET['aksi'] == "register_user"){
    if($_POST['password'] == $_POST['password_confirmation']) {
        $db->input_user($_POST['name'],$_POST['email'],$_POST['password']);
        $_SESSION['name'] = $_POST['name'];
        header("location:../views/home.php");
    }
    else {
        header("location:../views/register.php");
    }
} 
elseif($_GET['aksi'] == "tambah_user"){
    $db->input_user($_POST['name'],$_POST['email'],$_POST['password']);
    header("location:../views/users.php");
} 
elseif($_GET['aksi'] == "login") {
    $cek = $db->login_admin($_POST['name'],$_POST['email'],$_POST['password']);
    if ($cek != 0) {
        header("location:../views/main.php");
    }
    else {
        $cek = $db->login_user($_POST['name'],$_POST['email'],$_POST['password']);
        if ($cek != 0) {
            header("location:../views/home.php");
        } else {
            header("location:../views");
        }
    }
} 
elseif($_GET['aksi'] == "login_google_api") {
    require_once '../config/Google/Google_config.php';

    if(isset($_SESSION['access_token'])) {
        $google_client->setAccessToken($_SESSION['access_token']);
    }
    elseif(isset($_GET["code"])){
        $_SESSION['access_token']= $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    }

    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo_v2_me->get();

    if (!empty($data['name'])){
        $_SESSION['name'] = $data['name'];
    }
    if (!empty($data['email'])){
        $_SESSION['email'] = $data['email'];
    }
    if (!empty($data['password'])){
        $_SESSION['password'] = $data['password'];
    } else {
        $_SESSION['password'] = "";
    }

    $cek = $db->login_admin($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
    if ($cek != 0) {
        header("location:../views/main.php");
    }
    else {
        $cek = $db->login_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
        if ($cek != 0) {
            header("location:../views/home.php");
        } else {
            $db->input_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
            header("location:../views/home.php");
        }
    }
}
/*elseif($_GET['aksi'] == "login_facebook_api") {
    require_once '../config/config.php';
    
    if(isset($_SESSION) && isset($_SESSION['fb_token'])) {
        // Create new session from saved access_token
        $session = new FacebookSession($_SESSION['fb_token']);
        // Validate the access_token to make sure it's still valid
        try {
            if (!$session->validate()) {
                $session = null;
            }
        } catch(Exception $e) {
            // Catch any exceptions
            $session = null;
        }
    } else {
        // No session exists
        try {
            $session = $facebook_helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch(Exception $ex) {
            // When validation fails or other local issues
            echo $ex->message;
        }
    }
    
    // Check if a session exists
    if (isset($session)) {
        // Save the session
        $_SESSION['fb_token'] = $session->getToken();
        // Create session using saved token or the new one we generated at login
        $session = new FacebookSession($session->getToken());
    }

    $cek = $db->login_admin($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
    if ($cek != 0) {
        header("location:../views/main.php");
    }
    else {
        $cek = $db->login_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
        if ($cek != 0) {
            header("location:../views/home.php");
        } else {
            $db->input_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
            header("location:../views/home.php");
        }
    }
}
elseif($_GET['aksi'] == "login_linkedin_api") {
    require_once "../config/LinkedIn/init.php"; 

    $profile = $linkedin->getPerson();
    $_SESSION['name'] = $profile->localizedFirstName.' '.$profile->locallizedLastName;
    $_SESSION['email'] = $linkedin->getEmail();
    $_SESSION['password'] = "";

    $cek = $db->login_admin($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
    if ($cek != 0) {
        header("location:../views/main.php");
    }
    else {
        $cek = $db->login_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
        if ($cek != 0) {
            header("location:../views/home.php");
        } else {
            $db->input_user($_SESSION['name'],$_SESSION['email'],$_SESSION['password']);
            header("location:../views/home.php");
        }
    }
}*/
elseif($_GET['aksi'] == "logout") {
    include('../config/Google/Google_config.php');
    session_start();
    $google_client->revokeToken();
    session_destroy();
    header('location:../views');
} 
elseif($_GET['aksi'] == "delete_user"){
    $db->delete_user($_GET['id']);
    header("location:../views/users.php");
} 
elseif($_GET['aksi'] == "update_user"){
    $db->update_user($_POST['idUser'],$_POST['name'],$_POST['email'],$_POST['password']);
    header("location:../views/users.php");
} 
elseif($_GET['aksi'] == "tambah_order"){
    $db->input_order($_POST['customer_name'],$_POST['phone_number'],$_POST['amount']);
    header("location:../views/main.php");
} 
elseif($_GET['aksi'] == "delete_order"){
    $db->delete_order($_GET['id']);
    header("location:../views/main.php");
} 
elseif($_GET['aksi'] == "update_order"){
    $db->update_order($_POST['idOrder'],$_POST['customer_name'],$_POST['phone_number'],$_POST['amount']);
    header("location:../views/main.php");
} 
?>
