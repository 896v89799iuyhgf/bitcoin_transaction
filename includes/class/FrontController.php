<?php
require_once 'includes/database.php';

class FrontController extends Database {
    public function parseUri() {
        return $_REQUEST['route'];
    }

    public function countUser(){
        $query = $this->pdo->query("SELECT * FROM users WHERE user_group = 'User'");
        return $query->rowCount();
    }

    public function countTransByTime($time){
        if($time == 'day') {
            $query = $this->pdo->query("SELECT SUM(total) AS Total, COUNT(id) AS Counts FROM transactions WHERE DATE(transaction_date) = CURDATE()");
        } elseif ($time == 'week') {
            $query = $this->pdo->query("SELECT SUM(total) AS Total, COUNT(id) AS Counts FROM transactions WHERE WEEK(transaction_date) = WEEK(CURDATE())");
        } elseif($time == 'month') {
            $query = $this->pdo->query("SELECT SUM(total) AS Total, COUNT(id) AS Counts FROM transactions WHERE MONTH(transaction_date) = MONTH(CURDATE())");
        } elseif ($time == 'year') {
            $query = $this->pdo->query("SELECT SUM(total) AS Total, COUNT(id) AS Counts FROM transactions WHERE YEAR(transaction_date) = YEAR(CURDATE())");
        }
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
