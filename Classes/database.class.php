<?php
  Class Database{
      private $user='';
      private $pass='';
      private $db='';
      private $host='localhost';

      protected $conn;

    protected function getConnection(){
      try {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db .'charset=utf8';
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->conn = $pdo;
        return $pdo;
      } catch (PDOException $err) {
        echo "Couldn't connect to the database. <br>PDOException Trace: <br>".$err;
      }
    }

    protected function closeConnection()
    {
      $this->conn = null;
    }
  }
?>
