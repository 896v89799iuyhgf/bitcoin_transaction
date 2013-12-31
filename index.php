<?php
session_start();
 /**
 * Example Application

 * @package Example-application
 */
/*if($_SESSION['user_logged']) {
    header("Location: user_dashboard");
}*/
require 'includes/Smarty/Smarty.class.php';
require 'includes/class/FrontController.php';

$smarty = new Smarty;
$front_controller = new FrontController();
$url = $front_controller->parseUri();

if($_SESSION['user_logged'])
    $user = $_SESSION['user_info'];
$page = $_GET['page'];

$smarty->assign('link', $url);
$smarty->assign('page', $page);
switch($url){
    case ('forgot_password'):
        require_once('controller/forgot_password.php');
        break;
    case ('callback'):
        require_once('controller/callback.php');
        break;
    case ('logout'):
        $_SESSION['logout'] = true;
        require_once('controller/login.php');
        break;
    case ('register'):
        require_once('controller/register.php');
        break;
    case ('user_dashboard'):
        require_once('controller/user_dashboard.php');
        break;
    default:
        if($_SESSION['user_logged']){
            $page = 'profile';
            require_once('controller/user_dashboard.php');
        }
        else
            require_once('controller/login.php');
        break;
}
