<?php
$transaction_hash = $_GET['transaction_hash'];
$value_in_btc = $_GET['value'] / 100000000;
$address = $_GET['address'];

//Commented out to test, uncomment when live
if ($_GET['test'] == true) {
    return;
}

mail('tan@songnguyen.com.vn','asd', $address . ' received a payment of ' . $value_in_btc . ' transaction hash ' . $transaction_hash);
