<?php
/******************************************************************************/
// Class bdd : Singleton only one connexion to the database 
/******************************************************************************/
class bdd
{

  // Attributes
  /*****************************/
  private $dsn = 'mysql:host=localhost;dbname=conges';
  private $user = "conges";
  private $passwd = "conges";
  private static $instance;
  private $instancePDO;

  // Constructor
  /*****************************/
  private function __construct()
  {
    // Database connexion + communication using UTF-8
    try
    {
      $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
      );
      $this->instancePDO = new PDO($this->dsn, $this->user, $this->passwd, $options);
      $this->instancePDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }
  }
    
  public static function getInstance()
  {
    if (!isset (self::$instance)) // case : class is not instanciated
    {  
      self::$instance = new self; // create itself
    }        
    return self::$instance;
  }
  
  public function getInstancePDO()
  {         
    return $this->instancePDO;
  }
  
  // Destructor
  /*****************************/
  function __destruct()
  {
    $this->db = null;
  }

}

?>

