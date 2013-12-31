<?php
require_once '../includes/database.php';
class AdminUserModel extends Database {
    function getUsers() {
        $query = $this->pdo->prepare("SELECT * FROM users");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getUserById($user_id){
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function getUserInfo($userid)
    {
        $user_query = $this->pdo->prepare("SELECT * FROM user_profile WHERE user_id = :user_id");
        $user_query->execute(array(':user_id' => $userid));

        $user = $user_query->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        }
        return false;
    }

    function loginUser($email, $password) {
        $user_query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password AND status = 1 AND user_group = 'Admin'");
        $user_query->execute(array(':email' => $email, ':password' => md5($password)));
        $user = $user_query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }
        return false;
    }

    function updateUser($user_id, $username, $password, $email, $phone, $status, $group) {
        $query = $this->pdo->prepare("UPDATE users SET username = :username, password = :password, email = :email, phone = :phone, status = :status, user_group = :group WHERE id = :userid");
        $query->execute(array(
            ':userid' => $user_id,
            ':username' => $username,
            ':password' => md5($password),
            ':email' => $email,
            ':phone' => $phone,
            ':status' => $status,
            ':group' => $group
        ));

        if($query->rowCount())
            return true;
        return false;
    }

    function insertUser($username, $password, $email, $phone, $status = null, $group = null) {
        try {
            if(isset($status)) $status = 1;
            if(isset($group)) $group = 'Admin';

            //Check if user exist
            $user_query = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
            $user_query->execute(array(':email' => $email));
            $user = $user_query->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                //Insert user into database
                $insert_user_query = $this->pdo->prepare("INSERT INTO users (username, password, email, phone, status, user_group) VALUES (:username, :password, :email, :phone, :status, :user_group)");

                $insert_user_query->execute(array(
                    ':username' => $username,
                    ':password' => md5($password),
                    ':email' => $email,
                    ':phone' => $phone,
                    ':status' => $status,
                    ':user_group' => $group
                ));

                if ($insert_user_query->rowCount() > 0)
                    return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    function setAdmin($user_id){
        $query = $this->pdo->prepare("UPDATE users SET group = 'Admin' WHERE id = :user_id");
        $query->execute(array('user_id' => $user_id));
        if($query->rowCount() > 0)
            return true;
        return false;
    }

    function setUserStatus($user_id, $status){
        $query = $this->pdo->prepare("UPDATE users SET status = :status WHERE id = :user_id");
        $query->execute(array('user_id' => $user_id, ':status' => $status));
        if($query->rowCount() > 0)
            return true;
        return false;
    }

    function getIpHiStory($userid) {
        $query = $this->pdo->prepare("SELECT u.username, l.action, l.ip_address, l.time FROM user_logs l JOIN users u ON l.user_id = u.id WHERE l.user_id = :userid");
        $query->execute(array(':userid' => $userid));

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getTransactionByUser($userid) {
        $query = $this->pdo->prepare("SELECT tu.name, tu.address, t.id, t.total, t.transaction_date, t.notes FROM transactions t LEFT JOIN transactions_user tu ON t.id = tu.transaction_id WHERE t.user_id = :user_id ");
        $query->execute(array('user_id' => $userid));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getTransactionById($transid) {
        $query = $this->pdo->prepare("SELECT tu.wallet_id, tu.name, tu.address, tu.city, tu.state, tu.zip_code, tu.country, t.id, t.total, t.transaction_date, t.notes, t.order_number,t.payment_reason, t.transaction_hash, t.sender_wallet FROM transactions t LEFT JOIN transactions_user tu ON t.id = tu.transaction_id WHERE t.id = :transaction_id");
        $query->execute(array(':transaction_id' => $transid));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
