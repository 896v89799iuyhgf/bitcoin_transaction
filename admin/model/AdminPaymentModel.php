<?php
require_once '../includes/database.php';
class AdminPaymentModel extends Database {
    function updateFee($fee, $type, $address) {
        $query = $this->pdo->prepare("UPDATE payment SET fee = :fee, fee_type = :fee_type, fee_address = :fee_address");
        $query->execute(array(':fee' => $fee, ':fee_type' => $type, ':fee_address' => $address));

        if($query->rowCount() > 0)
            return true;
        return false;
    }

    function getFee(){
        $query = $this->pdo->prepare("SELECT fee, fee_type, fee_address FROM payment");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
