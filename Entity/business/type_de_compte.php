<?php
/******************************************************************************/
// Classe type_de_compte
/******************************************************************************/
class type_de_compte {

  // Attributs
  /*****************************/
  private $type_compte;

  // Constructeur
  /*****************************/
  function __construct($type_compte=null)
  {

     $this->type_compte = $type_compte;

  }
  
  // Destructeur
  /*****************************/
  function __destruct()
  {
  
  }
  
  // Getter/setter
  /*****************************/
  //type_compte
  function gettype_compte()
  {
    return $this->type_compte;
  }
  function settype_compte($type_compte)
  {
    $this->type_compte=$type_compte;
  }

}
