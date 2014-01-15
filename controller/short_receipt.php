<?php
require "model/ReceiptModel.php";
$receiptmodel = new ReceiptModel();
$short_code = $_GET['c'];
$trans = $receiptmodel->getTransactionByShortCode($short_code);
$id = $trans['id'];
header("Location: user_dashboard?page=receipt_item&item=" . $id);

