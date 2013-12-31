<?php
session_start();
require '../includes/Smarty/Smarty.class.php';
require '../includes/database.php';
/*$response = file_get_contents('https://blockchain.info/rawtx/3172272904d5bf8caee9ce7f74502756b1b09eddc7d343c2eb345678837ffe7b?format=json');
$r = json_decode($response);
echo '<pre>';
print_r($r);
exit;*/
$smarty = new Smarty;
if (isset($_GET['id'])) {
    //Get transasction
    $query = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
    $query->execute(array(
        ':id' => $_GET['id']
    ));
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $transaction[] = $row;
    }

//    Get sender
    $query_sender = $pdo->prepare("SELECT * FROM transactions tr JOIN transactions_user tu ON tr.id = tu.transaction_id WHERE tr.id = :id AND tu.type = 'sender'");
    $query_sender->execute(array(
        ':id' => $_GET['id']
    ));
    while ($row = $query_sender->fetch(PDO::FETCH_ASSOC)) {
        $sender[] = $row;
    }

    //Get Receiver
    $query_receive = $pdo->prepare("SELECT * FROM transactions tr JOIN transactions_user tu ON tr.id = tu.transaction_id WHERE tr.id = :id AND tu.type = 'receive'");
    $query_sender->execute(array(
        ':id' => $_GET['id']
    ));
    while ($row = $query_sender->fetch(PDO::FETCH_ASSOC)) {
        $receive[] = $row;
    }
    $smarty->assign('trans', $transaction);
    $smarty->assign('sender', $sender);
    $smarty->assign('receive', $receive);
    $smarty->display('item.tpl');
} else {
    $query_all = $pdo->prepare("SELECT * FROM transactions");
    $query_all->execute();
    while ($row = $query_all->fetch(PDO::FETCH_ASSOC)) {
        $transaction[] = $row;
    }
    $smarty->assign('trans', $transaction);
    $smarty->display('index.tpl');
}


