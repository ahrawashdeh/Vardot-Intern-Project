<?php

class MenuItem extends DB_conn {

  public function select() {

    $sql = "select * from menuItem where status <> 0 order by id desc";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }

  public function selectParent() {

    $sql = "select * from menuItem where status <> 0 and parentID is null and menuID = 25";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }

  public function selectMenuType() {
    $sql = "select * from menu where status <> 0";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }

      return $data;
    }
  }

  public function insert($title, $url, $menuOrder, $authorID, $parent, $islinkable, $menuID) {

    $sql = "insert into menuItem (title, url, MenuOrder, authorID, parentID, islinkable, menuID ) values "
            . "('$title', '$url', $menuOrder, $authorID, $parent, '$islinkable', $menuID)";
    //echo $sql;die;
    $stmt = $this->connect()->prepare($sql);


    $stmt_exec = $stmt->execute();


    if ($stmt_exec) {
      return TRUE;
    }
  }

//  public function insert($field) {
//    $implod_Col = implode(', ', array_keys($field));
//    $implod_PlaceHolder = implode(', :', array_keys($field));
//
//    $sql = "insert into menuItem ($implod_Col) values (:" . $implod_PlaceHolder . ")";
//    //echo $sql;die;
//    $stmt = $this->connect()->prepare($sql);
//
//    foreach ($field as $key => $value) {
//      $stmt->bindValue(':' . $key, $value);
//    }
//    $stmt_exec = $stmt->execute();
//
//
//    if ($stmt_exec) {
//      header('location: menuItem.php');
//    }
//  }
//  public function insertMenuType($type, $authorID) {
//    $sql = "insert into menu (typeName, authorID) values ('$type', $authorID)";
//    $stmt = $this->connect()->prepare($sql);
//    $stmt->execute();
//  }
//
//  public function selectMenuTypeId() {
//    $sql = "select max(id) as MenuTypeId from menu";
//    $stmt = $this->connect()->prepare($sql);
//    $stmt->execute();
//    $result = $stmt->fetch(PDO::FETCH_ASSOC);
//    return $result['MenuTypeId'];
//  }

  public function selectMenuItem() {
    $sql = "select * from menuItem where status != 0";
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

  public function selectMenuItemById($id) {
    $sql = "select * from menuItem where status != 0 and menuID = $id";
//    echo $sql;die;
    $result = $this->connect()->query($sql);
    if ($result->rowCount() > 0) {

      while ($row = $result->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

  public function selectOne($id) {
    $sql = "select * from menuItem where id = $id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  
    public function selectChilds($id) {
    $sql = "select * from menuItem where parentID = $id and status = 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {

      while ($row = $stmt->fetch()) {
        $data[] = $row;
      }
      return $data;
    }
  }

//   public function selectMenuItem($id) {
//    $sql = "select * from menuItem where menuID = $id and status = 1";
//    $stmt = $this->connect()->prepare($sql);
//    $stmt->execute();
//    $result = $stmt->fetch(PDO::FETCH_ASSOC);
//    return $result;
//  }
//  public function retrieveMenuType($MenuID) {
//    $sql = "select typeName from menu where id = $MenuID";
//    $result = $this->connect()->query($sql);
//    $stmt = $result->fetch(PDO::FETCH_ASSOC);
//    $result->execute();
//    return $stmt;
//  }

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
    $sql .= "update menuItem set " . $st;
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

  public function updateParentID($parent, $id) {
    $sql = "update menuItem set parentID = $parent where id = $id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
  }
  
   public function updateMenuID($menuID, $id) {
    $sql = "update menuItem set menuID = $menuID where id = $id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
  }

  public function del($id) {
    $sql = "update menuItem set status = 0 where id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
     $stmt_exec = $stmt->execute();
    if($stmt_exec) {
      return TRUE;
    }
  }

}
