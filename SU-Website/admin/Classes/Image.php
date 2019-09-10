<?php

class Image extends DB_conn {

    public function selectOne($id) {
    $sql = "select * from image where id = $id";
    $stmt = $this->connect()->prepare($sql);
//    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
}

