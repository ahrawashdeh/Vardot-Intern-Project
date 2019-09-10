<?php

class Events extends DB_conn {

  public function select() {

    $sql = "select event.id, event.startTime, event.endTime, event.campus, content.title, content.body, content.date, content.author  
       from event inner join content on event.contentID = content.id where
       event.status != 0 ";

    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

  public function selectEvent() {

    $sql = "select event.id, event.startTime, event.endTime, event.campus, content.imgID, content.title, content.body, DATE_FORMAT(content.date,\"%M %e %Y\"), content.author 
       from event inner join content on event.contentID = content.id where
       event.status != 0 limit 3";

    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

  public function selectAllEvent() {

    $sql = "select event.id, event.startTime, event.endTime, event.campus, content.imgID, content.title, content.body, DATE_FORMAT(content.date,\"%M %e %Y\"), content.author 
       from event inner join content on event.contentID = content.id where
       event.status != 0 ";

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

    $sql = "insert into event ($implod_Col) values (:" . $implod_PlaceHolder . ")";

    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();


    if ($stmt_exec) {
      return TRUE;
    }
  }

  public function selectEventById($id) {

    $sql = "select event.id, event.startTime, event.endTime, event.campus, content.imgID, content.title, content.body, DATE_FORMAT(content.date,\"%M %e %Y\"), content.author 
       from event inner join content on event.contentID = content.id where
       event.id = $id and event.status != 0";

    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

  public function insertImg($authorID, $image, $alt) {
    $sql = "insert into image (authorID, source, alt) values ('$authorID', '$image', '$alt')";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
  }

  public function insertContent($authorID, $title, $body, $date, $author, $imgId, $contentType) {
    $sql = "insert into content (authorID, title, body, date, author, imgID, contentType) values "
            . "($authorID, '$title', '$body', '$date', '$author', $imgId, $contentType)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
  }

  public function selectImgId() {
    $sql = "select max(id) as maxImgId from image";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxImgId'];
  }

  public function selectContentId() {
    $sql = "select max(id) as maxContentId from content";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxContentId'];
  }

  public function selectOne($id) {
    $sql = "select * from event where id = $id";
    $stmt = $this->connect()->prepare($sql);
//    $stmt->bindValue(":id", $id);
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

  public function retrieveContent($contentID) {

    $sql = "select * from content where id = $contentID";
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
    $sql .= "update event set " . $st;
    $sql .= " where id = " . $id;

    $stmt = $this->connect()->prepare($sql);

    foreach ($field as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    $stmt_exec = $stmt->execute();

    if ($stmt_exec) {
      header('location: events.php');
    }
  }

  public function update2($field, $id) {
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
      header('location: events.php');
    }
  }

  public function del($id) {
    $sql = "update event set status = 0 where id = $id";
//    echo $sql;    die();
    $stmt = $this->connect()->prepare($sql);
//    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $stmt_exec = $stmt->execute();
    if ($stmt_exec) {
      return TRUE;
    }
  }

}
