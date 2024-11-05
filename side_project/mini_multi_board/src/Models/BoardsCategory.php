<?php

namespace Models;

use Models\Model;
use Throwable;

class BoardsCategory extends Model {

  public function getBoardName($paramArr) {
    try {
      $sql = 
         ' SELECT * '
        .' FROM boards_category '
        .' WHERE '
        .'       bc_type = :bc_type '
        .'   AND deleted_at IS NULL '
      ;

      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramArr);
      return $stmt->fetch();
    } catch (Throwable $th) {
      echo 'BoardCategory->getBoardName(), '.$th->getMessage();
      exit; 
    }
  }

  public function getBoardsNameList() {
    try {
      $sql =
         ' SELECT '
         .'       bc_type '
        .'       ,bc_name '
        .' FROM '
        .'      boards_category '
        .' ORDER BY '
        .'          bc_type ASC '
      ;

      $stmt = $this->conn->query($sql);
      return $stmt->fetchAll();

    } catch (Throwable $th) {
      echo 'BoardCategory->getBoardsNameList(), '.$th->getMessage();
      exit; 
    }
  }
}