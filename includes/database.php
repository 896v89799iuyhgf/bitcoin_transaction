<?php
class Database
{
    private $dsn;
    private $host;
    private $username;
    private $password;
    private $db_name;
    public $pdo;
    public $kl;

    function __construct()
    {
        $this->host = 'localhost';
        $this->kl = 'localhost';
        $this->db_name = 'tkb_bitcoin_template';
        $this->username = 'tkb_root';
        $this->password = 'Cantho123456@';
        $this->dsn = "mysql:host=$this->host;dbname=$this->db_name";
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

