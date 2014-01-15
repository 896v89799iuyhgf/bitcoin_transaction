<?php
require_once 'includes/database.php';

class ReceiptModel extends Database
{
    function calculateFee($amount) {
        $result = $this->getFee();
        if($result['fee_type'] == 'p')
            $fee = $amount * $result['fee'] / 100;
        elseif($result['fee_type'] == 'n')
            $fee = $result['fee'];

        return $fee;
    }

    function getFee(){
        $query = $this->pdo->query("SELECT * FROM payment");
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    function add_transaction($userid, $sender_wallet, $transaction_hash, $total, $payment_reason, $order_number, $note, $transaction_message, $receiver)
    {
        $fee = $this->calculateFee($total);
        $total = $total + $fee;
        $trans_query = $this->pdo->prepare("INSERT INTO transactions (user_id, sender_wallet, transaction_hash, total, payment_reason, order_number, notes, transaction_message, transaction_date, short_code) VALUES (:user_id, :transaction_hash, :total, :payment_reason, :order_number, :notes, :message, NOW(), :short_code)");
        $recceiver_query = $this->pdo->prepare("INSERT INTO transactions_user (transaction_id, wallet_id, name, address, city, state, zip_code, country) VALUES (:transaction_id, :wallet_id, :name, :address, :city, :state, :zip_oder, :country)");
        try {
            $this->pdo->beginTransaction();
            $trans_query->execute(array(
                ':user_id' => $userid,
                ':sender_wallet' => $sender_wallet,
                ':transaction_hash' => $transaction_hash,
                ':total' => $total,
                ':payment_reason' => $payment_reason,
                ':order_number' => $order_number,
                ':notes' => $note,
                ':message' => $transaction_message,
                ':short_code' => substr(str_shuffle(md5(microtime())), 0, 4)
            ));
            $transaction_id = $this->pdo->lastInsertId();
            $recceiver_query->execute(array(
                ':transaction_id' => $transaction_id,
                ':wallet_id' => $receiver['Wallet'],
                ':name' => $receiver['Name'],
                ':address' => $receiver['Address'],
                ':city' => $receiver['City'],
                ':state' => $receiver['State'],
                ':zip_oder' => $receiver['Postal'],
                ':country' => $receiver['Country']
            ));
            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
        return true;
    }

    function getTransactionByUser($userid) {
        $query = $this->pdo->prepare("SELECT tu.name, tu.address, t.id, t.total, t.transaction_date, t.notes FROM transactions t LEFT JOIN transactions_user tu ON t.id = tu.transaction_id WHERE t.user_id = :user_id ");
        $query->execute(array('user_id' => $userid));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getTransactionById($transid) {
        $query = $this->pdo->prepare("SELECT tu.wallet_id, tu.name, tu.address, tu.city, tu.state, tu.zip_code, tu.country, t.id, t.total, t.transaction_date, t.notes, t.order_number,t.payment_reason, t.transaction_hash, t.sender_wallet, t.short_code FROM transactions t LEFT JOIN transactions_user tu ON t.id = tu.transaction_id WHERE t.id = :transaction_id");
        $query->execute(array(':transaction_id' => $transid));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function getTransactionByShortCode($shortcode){
        $query = $this->pdo->prepare("SELECT id FROM transactions WHERE short_code = :short_code");
        $query->execute(array(':short_code' => $shortcode));
        $result =$query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
