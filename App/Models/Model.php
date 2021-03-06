<?php 
namespace App\Models;

use App\Traits\ModelTraits;
use App\Drivers\Database;
use PDO;

class Model extends Database {
  use ModelTraits;
  
  public function __construct()
  {
    parent::__construct();
  }

  public function runQuery(string $query, array $arguments = [], $fetch = null) {
    $stm = $this->db->prepare($query);
    // $stm->bindParam(':table', $this->table, PDO::PARAM_STR);
    $stm->execute($arguments);
    $result = null;
    if($fetch == 'all') {
        $result = $stm->fetchAll(PDO::FETCH_OBJ);
    } else if($fetch == 'first') {
      $result = $stm->fetch(PDO::FETCH_OBJ);
    }
    return $result;
  }



}