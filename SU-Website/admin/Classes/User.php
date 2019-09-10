<?php

session_start();

require_once '../config/DB_conn.php';

class User extends DB_conn {

  public function login() {

    $username = $_POST['username'];
    $password = $_POST['password'];
//    $username = filter_input(INPUT_POST, 'username');
//    $password = filter_input(INPUT_POST, 'password');
    $password = sha1($password);
    
    
    $db = new DB_conn();
    $connection = $db->connect();

    try {
      if (isset($_POST['login'])) {
        $sql = "select * from user where username = '" . $username . "' and password = '" . $password . "' and permission = 'super Admin'";
        //echo $sql;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch();
      

        if ($result['username'] == $username && $result['password'] == $password) {
          $_SESSION['username'] = $username;
          $_SESSION['authorID'] = $result['id'];
       
          
          header('location: index.php');
        } else {
          $_SESSION["err"] = "invalid username or password";
        }
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
    }
//    var_dump($result);
//    die;
  }
}

//$obj = new User();
//$obj->login();
