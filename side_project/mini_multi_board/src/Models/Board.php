<?php

namespace Models;

use Models\Model;
use Throwable;

class Board extends Model {
  public function getBoardList(array $paramArr) {
    try {
      $sql = 
        ' SELECT * '
        .' FROM boards '
        .' WHERE '
        .'       bc_type = :bc_type '
        .'   AND deleted_at IS NULL '
        .' ORDER BY '
        .'   created_at DESC, b_id DESC '
      ;

      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramArr);
      return $stmt->fetchAll();
    } catch (Throwable $th) {
      echo 'Board->getBoardList(), '.$th->getMessage();
      exit;
    }
  }

  public function getBoardDetail(array $paramArr) {
    try {
      $sql = 
         ' SELECT '
        .'  boards.b_title '
        .' ,boards.b_content '
        .' ,boards.b_img '
        .' ,boards.b_id '
        .' ,users.u_name '
        .' FROM boards '
        .'  JOIN users '
        .'    ON boards.u_id = users.u_id '
        .'    AND boards.b_id = :b_id '
        .'    AND boards.deleted_at IS NULL '
      ;
        
      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramArr);
      return $stmt->fetch();
    } catch (Throwable $th) {
      echo 'Board->getBoardDetail(), '.$th->getMessage();
      exit;
    }
  }
}