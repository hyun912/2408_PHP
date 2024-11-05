<?php

namespace Models;

use Models\Model;
use Throwable;

class User extends Model {
  public function getUserInfo(array $paramArr) { 
    try {
      $sql = 
      '    SELECT * '
      .'   FROM users '
      .'   WHERE u_email = :u_email '
      ;

      $stmt = $this->conn->prepare($sql);
      $stmt->execute($paramArr);
      return $stmt->fetch();
    } catch (Throwable $th) {
      echo 'User->getUSerInfo(), '.$th->getMessage();
      exit;
    }
  }
}