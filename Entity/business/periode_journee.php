<?php
/******************************************************************************/
// Classe periode_journee
/******************************************************************************/
class periode_journee {

  // Attributs
  /*****************************/
  private $periode_journee;

  // Constructeur
  /*****************************/
  function __construct($periode_journee=null)
  {

     $this->periode_journee = $periode_journee;

  }
  
  // Destructeur
  /*****************************/
  function __destruct()
  {
  
  }
  
  // Getter/setter
  /*****************************/
  //periode_journee
  function getperiode_journee()
  {
    return $this->periode_journee;
  }
  function setperiode_journee($periode_journee)
  {
    $this->periode_journee=$periode_journee;
  }

}
