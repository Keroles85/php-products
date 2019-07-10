<?php

/*interface Database {

}*/

class Database {
  private $host = 'localhost';
  private $db_name = 'furniture';
  private $username = 'keroles';
  private $password = 'password';
  private $connection;

  public function dbConnect() {
    $this->connection = null;

    try {
      $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", "{$this->username}", "{$this->password}");
      $this->connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->connection;
    } catch (PDOException $e) {
      die("ERROR: Could not connect. " . $e->getMessage());
    }

  }

}