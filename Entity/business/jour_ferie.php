<?php
/******************************************************************************/
// Classe jour_ferie
/******************************************************************************/
class jour_ferie {

  // Attributs
  /*****************************/
  private $date_ferie;

  // Constructeur
  /*****************************/
  function __construct($date_ferie=null)
  {

     $this->date_ferie = $date_ferie;

  }
  
  // Destructeur
  /*****************************/
  function __destruct()
  {
  
  }
  
  // Getter/setter
  /*****************************/
  //date_ferie
  function getdate_ferie()
  {
    return $this->date_ferie;
  }
  function setdate_ferie($date_ferie)
  {
    $this->date_ferie=$date_ferie;
  }
}
