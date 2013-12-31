<?php
session_start();
$route = $_GET['route'];
require '../includes/Smarty/Smarty.class.php';
$smarty = new Smarty;
$page = $_GET['page'];

$smarty->assign('Title', 'Admin Panel');
$smarty->assign('route', $route);
switch($route){
    case ('home'):
        require_once('controller/login.php');
        break;
    case('admin_dashboard'):
        require_once('controller/admin_dashboard.php');
        break;
    case('logout'):
        session_destroy();
        header("Location: home");
        break;
    default:
        require_once('controller/login.php');
        break;
}
