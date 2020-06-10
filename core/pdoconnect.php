<?php
    class PDOconnect
    {
        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset;
        private $dsn;

        function __construct()
        {
            $this->host = 'localhost';
            $this->db   = 'problem_book';
            $this->charset = 'utf8';
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

            $this->user = 'root';
            $this->pass = '1234567';
        }

        function connect()
        {
            $pdo = new PDO($this->dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
    }
?>