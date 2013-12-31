<?php
require_once("model/UserModel.php");
$usermodel = new UserModel();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['forgotEmail'];
    $newpass = $usermodel->resetPassword($email);
    if($newpass != '')
        mail($email, 'Reset Password from Bitcoin Template', 'Your new pass: '.$newpass);
    $smarty->assign('inform', 'You password reseted, please check your email!');
}

$smarty->display('forgot_password.tpl');
