<?php

class MenuType extends DB_conn {

  public function select() {

    $sql = "select * from menu where status <> 0";
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

    $sql = "insert into menu ($implod_Col) values (:" . $implod_PlaceHolder . ")";
    //echo $sql;die;
    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }
  
  public function selectOne($id) {
    $sql = "select * from menu where id = $id";
    $stmt = $this->connect()->prepare($sql);
//    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  

  public function update($field, $id) {
    $st = "";
    $counter = 1;
    $total_fields = count($field);
    foreach ($field as $key => $value) {
      if ($counter === $total_fields) {
        $set = "$key = :" . $key;
        $st = $st . $set;
      } else {
        $set = "$key = :" . $key . ", ";
        $st = $st . $set;
        $counter++;
      }
    }
    $sql = "";
    $sql .= "update menu set " . $st;
    $sql .= " where id = " . $id;
    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }
    

  public function del($id) {
    $sql = "update menu set status = 0 where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }

}
