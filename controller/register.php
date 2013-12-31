<?php
require "model/UserModel.php";
require_once('includes/class/recaptchalib.php');

$publickey = "6Le2WuwSAAAAALsK8RY6aryrTroXtvtfFBKlM5Z7";
$privatekey = "6Le2WuwSAAAAAAYLbukH6k48YqlnRng0s3pL4nUC";
$usermodel = new UserModel();
$key = recaptcha_get_html($publickey);
$smarty->assign('key', $key);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Captcha check
    $resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        $smarty->assign('site_error', "The reCAPTCHA wasn't entered correctly.Please try again.", true);
        $smarty->display('register.tpl');
    } else {
        // Your code here to handle a successful verification
        $username = $_POST['registerUsername'];
        $password = $_POST['registerPassword'];
        $email = $_POST['registerEmail'];
        $phone = $_POST['registerPhoneNumber'];

        $response = $usermodel->registerUser($username, $password, $email, $phone);
        if($response) {
            $_SESSION['registered'] = true;
            header("Location: user_dashboard");
        } else {
            $smarty->assign('site_error', 'Email existed!', true);
            $smarty->display('register.tpl');
        }
    }
}
else {
    $smarty->display('register.tpl');
}
