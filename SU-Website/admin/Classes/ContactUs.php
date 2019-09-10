<?php

class ContactUs extends DB_conn {

  public function select() {

    $sql = "select * from contactUs order by id desc";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }

  public function insert($fullName, $phone, $email, $message) {
    $sql = "insert into contactUs (fullName, phone, email, message) values ('$fullName', '$phone', '$email', '$message') ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
  }

  public function selectOne($id) {
    $sql = "select * from contactUs where id = $id";
    $stmt = $this->connect()->prepare($sql);
//    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function del($id) {
    $sql = "delete from contactUs where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }

}
