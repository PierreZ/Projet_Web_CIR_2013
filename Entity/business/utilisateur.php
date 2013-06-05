<?php
/******************************************************************************/
// Classe utilisateur
/******************************************************************************/
class utilisateur {

  // Attributs
  /*****************************/
  private $login;
  private $mot_de_passe;
  private $type_compte;
  private $solde;
  // Constructeur
  /*****************************/
  function __construct($login=null,$mot_de_passe=null,$type_compte=null,$solde=null)
  {

     $this->login = $login;
     $this->mot_de_passe = $mot_de_passe;
     $this->type_compte = $type_compte;
     $this->solde = $solde;
  }
  
  // Destructeur
  /*****************************/
  function __destruct()
  {
  
  }
  
  // Getter/setter
  /*****************************/
  //login
  function getLogin()
  {
    return $this->login;
  }
  function setLogin($login)
  {
    $this->login=$login;
  }
  //mot_de_passe
  function getMot_de_passe()
  {
    return $this->mot_de_passe;
  }
  function setMot_de_passe($mot_de_passe)
  {
    $this->mot_de_passe=$mot_de_passe;
  }
  //type_compte
  function getType_compte()
  {
    return $this->type_compte;
  }
  function setType_compte($type_compte)
  {
    $this->type_compte=$type_compte;
  }
  //solde
  function getSolde()
  {
    return $this->solde;
  }
  function setSolde($solde)
  {
    $this->solde=$solde;
  }


}

?>

