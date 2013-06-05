<?php
/******************************************************************************/
// Classe demi_journee
/******************************************************************************/
class demi_journee {

  // Attributs
  /*****************************/
  private $date_demi_journee;
  private $login;
  private $periode_journee;

  // Constructeur
  /*****************************/
  function __construct($date_demi_journee=null,$login,$periode_journee)
  {

   $this->date_demi_journee = $date_demi_journee;
      $this->login = $login;
         $this->periode_journee = $periode_journee;

 }
 
  // Destructeur
 /*****************************/
 function __destruct()
 {
  
 }
 
  // Getter/setter
 /*****************************/
  //date_demi_journee
 function getdate_demi_journee()
 {
  return $this->date_demi_journee;
}
function setdate_demi_journee($date_demi_journee)
{
  $this->date_demi_journee=$date_demi_journee;
}

  //login
function getlogin()
{
  return $this->login;
}
function setlogin($login)
{
  $this->login=$login;
}

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