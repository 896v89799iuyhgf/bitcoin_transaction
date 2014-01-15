<?php
require_once 'includes/database.php';

class UserModel extends Database
{
    function loginUser($email, $password, $remember_me)
    {
        //Check if user exist
        $user_query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password AND status = 1 AND user_group = 'User'");
        $user_query->execute(array(':email' => $email, ':password' => md5($password)));
        $user = $user_query->fetch(PDO::FETCH_ASSOC);

        //check if user over 4 failed login
        $fail_query = $this->pdo->prepare("SELECT COUNT(f.email) AS failed, u.status, u.user_group FROM users u RIGHT JOIN failed_logins f ON u.email = f.email WHERE f.email = :email AND u.user_group = 'User'");
        $fail_query->execute(array(':email' => $email));
        $attempt = $fail_query->fetch(PDO::FETCH_ASSOC);
        if ($attempt['failed'] >= 4) {
            $this->pdo->exec("UPDATE users SET status = 2 WHERE email = '" . $email . "' AND user_group = 'User'");
            return 'Your account has been locked for 4 failed attempt, please contact administrator!';
        }

        if ($user) {
            //Remember me active
            if($remember_me != 1){
                $hour = time() + 31536000;
                $hash = md5($email.md5($password));
                setcookie('id_bitcoin', $user['id'], $hour);
                setcookie('hash_bitcoin', $hash, $hour);
            }

            $this->logip($user['id'], 'login');
            return $user;
        } else {
            $this->failed_attempt($email);
        }
        return 'Wrong Email or Password!';
    }

    function registerUser($username, $password, $email, $phone, $status = null, $group = null)
    {
        try {
            if (!isset($status)) $status = 1;
            if (!isset($group)) $group = 'User';

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

    function getUserSetting($userid)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE id = :userid");
        $query->execute(array(':userid' => $userid));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return false;
    }

    function updateUserInfo($query, $userid, $name, $address, $city, $state, $code, $country)
    {
        if ($query == 'insert') {
            $query = $this->pdo->prepare("INSERT INTO user_profile (user_id, name, address, city, state, zip_code, country) VALUES (:user_id, :name, :address, :city, :state, :zip_code, :country)");
        } else if ($query == 'update') {
            $query = $this->pdo->prepare("UPDATE user_profile SET name = :name, address = :address, city = :city, state = :state, zip_code = :zip_code, country = :country WHERE user_id = :user_id");
        }

        $query->execute(array(
            ':user_id' => $userid,
            ':name' => $name,
            ':address' => $address,
            ':city' => $city,
            ':state' => $state,
            ':zip_code' => $code,
            ':country' => $country));
        if ($query->rowCount())
            return true;
        return false;
    }

    function updateUserSetting($userid, $email, $oldpass, $password, $phone)
    {
        //check if old password is right
        $pass_query = $this->pdo->prepare("SELECT password FROM users WHERE id = :userid");
        $pass_query->execute(array(':userid' => $userid));
        $response = $pass_query->fetch(PDO::FETCH_ASSOC);

        if ($response['password'] == md5($oldpass)) {
            $query = $this->pdo->prepare("UPDATE users SET email = :email, password = :password, phone = :phone WHERE id = :userid");
            $query->execute(array(
                ':email' => $email,
                ':password' => md5($password),
                ':phone' => $phone,
                ':userid' => $userid
            ));

            if ($query->rowCount() > 0) {
                $_SESSION['site_error'] = 'You Setting Updated';
                return true;
            }
        } else {
            $_SESSION['site_error'] = 'Wrong password';
        }
        return false;
    }

    function logip($userid, $action)
    {
        $query = $this->pdo->prepare("INSERT INTO user_logs (user_id, action, ip_address) VALUES (:userid, :action, :ip_address)");
        $query->execute(array(
            'userid' => $userid,
            ':action' => $action,
            ':ip_address' => $this->get_client_ip()
        ));
        if ($query->rowCount() > 0)
            return true;
        return false;
    }

    function failed_attempt($email)
    {
        $query = $this->pdo->prepare("INSERT INTO failed_logins (email, ip_address, attempted) VALUES (:email, :ip_address, CURRENT_TIMESTAMP)");
        $query->execute(array(
            ':email' => $email,
            ':ip_address' => ip2long($this->get_client_ip())
        ));
    }

    // Function to get the client ip address
    function get_client_ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function resetPassword($email){
        $new_pass = mt_rand();
        $query = $this->pdo->prepare("UPDATE users SET password = :newpass WHERE email = :email");
        $query->execute(array(':newpass' => md5($new_pass), ':email' => $email));
        if($query->rowCount() > 0)
            return $new_pass;
        return false;
    }
}
