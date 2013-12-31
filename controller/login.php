<?php
require "model/UserModel.php";
$usermodel = new UserModel();

//Check if cookie saved before
if($_COOKIE['id_bitcoin'] != '') {
    $userhash = $_COOKIE['hash_bitcoin'];
    $userid = $_COOKIE['id_bitcoin'];

    $user = $usermodel->getUserSetting($userid);
    $email = $user['email'];
    $password = $user['password'];
    $new_hash = $email.$password;
    if($new_hash == $userhash) {
        $_SESSION['user_info'] = $user;
        $_SESSION['user_logged'] = true;
        header("Location: user_dashboard?page=profile");
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    $remember_me = $_POST['remember_me'];

    $response = $usermodel->loginUser($email, $password, $rememberme);
    if(is_array($response)) {
        $_SESSION['user_info'] = $response;
        $_SESSION['user_logged'] = true;
        header("Location: user_dashboard?page=profile");
    } else {
        $smarty->assign('site_error', $response, true);
        $smarty->display('login.tpl');
    }
} else {
    if($_SESSION['logout']) {
        $usermodel->logip($user['id'], 'logout');
        session_destroy();
        header("Location: login");
    }
    if(!empty($_SESSION['site_error']))
        $smarty->assign('site_error', $_SESSION['site_error']);
    $smarty->display('login.tpl');
}
