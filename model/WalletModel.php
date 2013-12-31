<?php
require_once 'includes/database.php';

class WalletModel extends Database
{
    function insertWallet($user_id, $address, $password) {
        $query = $this->pdo->prepare("INSERT INTO wallet (user_id,address, password) VALUES (:user_id, :address, :password)");
        $query->execute(array(':user_id' => $user_id,':address' => $address, ':password' => $password));

        if($query->rowCount())
            return true;
        return false;
    }

    function updateWallet($wallet_id, $address, $password){
        $query = $this->pdo->prepare("UPDATE wallet SET address = :address, password = :password WHERE wallet_id = :wallet_id");
        $query->execute(array(':address' => $address, ':password' => $password, ':wallet_id' => $wallet_id));

        if($query->rowCount())
            return true;
        return false;
    }

    function removeWallet($wallet_id) {
        $query = $this->pdo->prepare("DELETE FROM wallet WHERE wallet_id = :wallet_id");
        $query->execute(array(':wallet_id' => $wallet_id));

        if($query->rowCount())
            return true;
        return false;
    }

    function getWallets($user_id){
        $query = $this->pdo->prepare("SELECT wallet_id, address, password FROM wallet WHERE user_id = :user_id");
        $query->execute(array(':user_id' => $user_id));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getWalletById($id) {
        $query = $this->pdo->prepare("SELECT address, password FROM wallet WHERE wallet_id = :wallet_id");
        $query->execute(array(':wallet_id' => $id));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
