<?php

class Users extends DB_conn {

  public function select() {

    $sql = "select * from user where status <> 0 order by id desc";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }

  public function insert($field) {
    $implod_Col = implode(', ', array_keys($field));
    $implod_PlaceHolder = implode(', :', array_keys($field));

    $sql = "insert into user ($implod_Col) values (:" . $implod_PlaceHolder . ")";

    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      header('location: users.php');
    }
  }

  public function del($id) {
    $sql = "update user set status = 0 where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }

}
