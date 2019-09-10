<?php

require_once 'global_variables.php';

class DB_conn {

  public function connect() {
    global $servername, $username, $dbName, $password;
    try {
//      $connection = new PDO("mysql:host=$this->servername;dbname=mydb", $this->username, $this->password);
      $connection = new PDO("mysql:host=" . $servername . ";dbname=" . $dbName, $username, $password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//      echo "Connected DB Conn Class";
      return $connection;
    } catch (PDOException $e) {
      echo "Connection failed : " . $e->getMessage();
    }
  }

}
