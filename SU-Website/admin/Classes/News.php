<?php

class News extends DB_conn {

  public function select() {

    $sql = "select * from content where status <> 0 and contentType = 1 order by id desc";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }
  
  public function selectNews() {

    $sql = "select id, title, body, DATE_FORMAT(date,\"%M %e %Y\")  from content where status <> 0 and contentType = 1 limit 3";
    
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }
  
  public function selectAllNews() {

    $sql = "select id, title, body, DATE_FORMAT(date,\"%M %e %Y\")  from content where status <> 0 and contentType = 1";
    
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

    $sql = "insert into content ($implod_Col) values (:" . $implod_PlaceHolder . ")";

    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      return TRUE;
    }
  }

  public function insertImg($authorID, $image, $alt) {
    $sql = "insert into image (authorID, source, alt) values ('$authorID', '$image', '$alt')";
    $stmt = $this->connect()->prepare($sql)->execute();
  }

  public function selectImgId() {
    $sql = "select max(id) as imgI from image";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['imgI'];
  }

  public function selectOne($id) {
    $sql = "select * from content where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function retrieveImg($imgID) {

    $sql = "select source , alt from image where id = $imgID";
    $result = $this->connect()->query($sql);
//       echo $sql;
//       echo $imgID;die();
    $stmt = $result->fetch(PDO::FETCH_ASSOC);
    $result->execute();
    return $stmt;
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
    $sql .= "update content set " . $st;
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
  
//  public function updateAlt($alt, $id) {
//    $sql = "update image set alt = '$alt' where id = $id";
//     echo $sql;die();
//    $stmt = $this->connect()->prepare($sql);
//    $stmt->execute();
//   
//  }
  

  public function del($id) {
    $sql = "update content set status = 0 where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $stmt_exec = $stmt->execute();
    
     if ($stmt_exec) {
       return TRUE;
    }
  }

}
