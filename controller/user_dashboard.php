<?php
require "model/UserModel.php";
require "model/WalletModel.php";
require "model/ReceiptModel.php";
$usermodel = new UserModel();
$walletmodel = new WalletModel();
$receiptmodel = new ReceiptModel();

if ($_SESSION['user_logged']) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['saveProfile'] != '') { //Update profile information
            $query = $_POST['saveProfile'];
            $name = $_POST['profileName'];
            $address = $_POST['profileAddress'];
            $city = $_POST['profileCity'];
            $state = $_POST['profileState'];
            $code = $_POST['profileZipCode'];
            $country = $_POST['profileCountry'];

            $response = $usermodel->updateUserInfo($query, $user['id'], $name, $address, $city, $state, $code, $country);
            if ($response)
                header("Location: user_dashboard?page=profile");
            exit;
        } else if ($_POST['saveSetting']) { //Update user settings
            $email = $_POST['settingEmail'];
            $password = $_POST['settingPassword'];
            $old_password = $_POST['settingOldPassword'];
            $phone = $_POST['settingPhone'];

            $response = $usermodel->updateUserSetting($user['id'], $email, $old_password, $password, $phone);
            header("Location: user_dashboard?page=settings");
            exit;
        } else if ($_POST['saveWallet']) { //Update Wallet
            $wallet_address = $_POST['walletAddress'];
            $wallet_password = $_POST['walletPassword'];
            $wallet_id = $_POST['walletID'];

            foreach ($wallet_id as $k => $id) {
                $address = $wallet_address[$k];
                $password = $wallet_password[$k];
                if ($id == 0)
                    $walletmodel->insertWallet($user['id'], $address, $password);
                else
                    $walletmodel->updateWallet($id, $address, $password);
            }
            header("Location: user_dashboard?page=wallet");
            exit;
        } else if ($_POST['deleteWallet']) { //Remove Wallet
            $wallet_id = $_POST['wallet_id'];

            $walletmodel->removeWallet($wallet_id);
            echo 'ok';
            exit;
        } else if ($_POST['saveReceipt']) { //Make transaction, sending bitcoin
            $send = $_POST['send_bitcoin'];
            $blockchain_root = "https://blockchain.info/";

            $sender = $_POST['sender'];
            $receiver = $_POST['receive'];
            $address = $receiver['Wallet'];
            $payment_reason = $_POST['payment_reason'];
            $order_number = $_POST['order_number'];
            $notes = $_POST['notes'];

            $amount = $_POST['amount'];
            $total = $amount * 100000000;
            $fee = $receiptmodel->calculateFee($total);
            $wallet = $walletmodel->getWalletById($sender['Wallet']);

            $guid = $wallet['address'];
            $main_password = $wallet['password'];
            $fee_obj = $receiptmodel->getFee();
            $fee_address = $fee_obj['fee_address'];

            //begin transaction
            $trans_uri = $blockchain_root . 'merchant/' . $guid . '/payment?password=' . $main_password . '&to=' . $address . '&amount=' . $total;

            $send_response = file_get_contents($trans_uri);
            $send_result = json_decode($send_response);
            $fee_uri = $blockchain_root . 'merchant/' . $guid . '/payment?password=' . $main_password . '&to=' . $fee_address . '&amount=' . $fee;
            if (isset($send_result->error)) {
                $_SESSION['site_error'] = $send_result->error;
                header("Location: user_dashboard?page=receipt");
            } else {
                $transaction_hash = $send_result->tx_hash;
                $message = $send_result->message;

                $fee_uri = $blockchain_root . 'merchant/' . $guid . '/payment?password=' . $main_password . '&to=' . $fee_address . '&amount=' . $fee;
                $fee_response = file_get_contents($trans_uri);

                $receiptmodel->add_transaction($user['id'], $guid, $transaction_hash, $amount, $payment_reason, $order_number,$notes, $message, $receiver);
                $usermodel->logip($user['id'], 'Create Receipt');
                header("Location: user_dashboard?page=receipt");
            }
        }
    }

    if (!empty($_SESSION['site_error']))
        $smarty->assign('site_error', $_SESSION['site_error']);
    switch ($page) {
        default:
            $userInfo = $usermodel->getUserInfo($user['id']);
            $smarty->assign('user', $userInfo);
            break;
        case ('wallet'):
            $wallet = $walletmodel->getWallets($user['id']);
            $smarty->assign('wallets', $wallet);
            break;
        case ('receipt'):
            $userInfo = $usermodel->getUserInfo($user['id']);
            $wallet = $walletmodel->getWallets($user['id']);
            $smarty->assign('wallets', $wallet);
            $smarty->assign('user', $userInfo);
            break;
        case('receipt_item'):
            $trans_id = $_GET['item'];
            $userInfo = $usermodel->getUserInfo($user['id']);
            $transactions = $receiptmodel->getTransactionById($trans_id);
            $url = $site_url.'receipt?c=' . $transactions['short_code'];

            $smarty->assign('trans', $transactions);
            $smarty->assign('user', $userInfo);
            $smarty->assign('trans_id', $trans_id);
            $smarty->assign('short_code', $url);
            break;
        case ('receipt_history'):
            $transactions = $receiptmodel->getTransactionByUser($user['id']);
            $smarty->assign('transactions', $transactions);
            break;
        case ('settings'):
            $usersetting = $usermodel->getUserSetting($user['id']);
            $smarty->assign('settings', $usersetting);
            break;
    }
    $smarty->assign('page', $page);
    $smarty->display('user_dashboard.tpl');
    unset($_SESSION['site_error']);
} else {
    if ($_SESSION['registered'])
        $_SESSION['site_error'] = 'Account successfully created. Please login now';
    else
        $_SESSION['site_error'] = 'Please login first!';
    header("Location: login");
}
