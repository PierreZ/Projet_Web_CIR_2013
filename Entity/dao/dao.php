<?php
include_once $root."Entity/dao/bdd.php";
/******************************************************************************/
// Abstract class dao
/******************************************************************************/
abstract class dao {

  // Attributes
  /*****************************/
  public $database;
  
  public function __construct()
  {
    $this->database = bdd::getInstance()->getInstancePDO();
  }
  
  abstract function find($id);
  abstract function insert(&$objet);
  abstract function update(&$objet);
  abstract function delete(&$objet);
  
}

?>

