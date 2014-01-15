<?php
include 'model/AdminUserModel.php';
include 'model/AdminPaymentModel.php';
$user = $_SESSION['admin_info'];

$admin_model = new AdminUserModel();
$fee_model = new AdminPaymentModel();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['updateUser']) {
        $username = $_POST['userName'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        $user_group = $_POST['user_group'];
        $userid = $_POST['userid'];

        $admin_model->updateUser($userid, $username, $password, $email, $phone, $status, $user_group);
        header("Location: admin_dashboard?page=main");
    } elseif ($_POST['add_user']) {
        $username = $_POST['registerUsername'];
        $password = $_POST['registerPassword'];
        $email = $_POST['registerEmail'];
        $phone = $_POST['registerPhoneNumber'];
        $status = $_POST['status'];
        $user_group = $_POST['user_group'];

        $admin_model->insertUser($username, $password, $email, $phone,$status, $user_group);
        header("Location: admin_dashboard?page=main");
    } elseif($_POST['updateFee']) {
        $fee = $_POST['fees'];
        $type = $_POST['fee_type'];
        $address = $_POST['fee_address'];

        $fee_model->updateFee($fee, $type, $address);
        header("Location: admin_dashboard?page=set_fee");
    }
}

if($page == 'main'){
    $users = $admin_model->getUsers();
    $smarty->assign('users', $users);
} elseif ($page == 'user_edit') {
    $user_id = $_GET['user'];
    $user = $admin_model->getUserById($user_id);
    $smarty->assign('user', $user);
} elseif ($page == 'ip_history') {
    $user_id = $_GET['user'];
    $history = $admin_model->getIpHiStory($user_id);
    $smarty->assign('history', $history);
} elseif($page == 'set_fee') {
    $fee = $fee_model->getFee();
    $smarty->assign('fee', $fee);
} elseif($page == 'receipt_history') {
    $user_id = $_GET['user'];
    $transasctions = $admin_model->getTransactionByUser($user_id);
    $smarty->assign('transactions', $transasctions);
    $smarty->assign('user_id', $user_id);
} elseif($page == 'receipt_detail') {
    $trans_id = $_GET['item'];
    $user_id = $_GET['user'];

    $user = $admin_model->getUserInfo($user_id);
    $trans = $admin_model->getTransactionById($trans_id);
    $url = 'http://tkb.edu.vn/bitcoin_template/receipt?c=' . $trans['short_code'];

    $smarty->assign('trans', $trans);
    $smarty->assign('user', $user);
    $smarty->assign('trans_id', $trans_id);
    $smarty->assign('short_code', $url);
}

$smarty->assign('page', $page);
$smarty->display('admin_dashboard.tpl');
