<?php
require "model/AdminUserModel.php";
$usermodel = new AdminUserModel();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $response = $usermodel->loginUser($email, $password);
    if($response) {
        $_SESSION['admin_info'] = $response;
        $_SESSION['admin_logged'] = true;
        header("Location: admin_dashboard?page=main");
    } else {
        $smarty->assign('site_error', 'Wrong Username or Password!', true);
        $smarty->display('login.tpl');
    }
} else {
$smarty->display('login.tpl');
}
