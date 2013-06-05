<?php
include_once $root."Entity/dao/dao.php";
include_once $root."Entity/business/utilisateur.php";
/******************************************************************************/
// Class utilisateur_dao
/******************************************************************************/
class utilisateur_dao extends dao {

  function find($login)
  {
    $query  = "SELECT * FROM UTILISATEUR WHERE LOGIN= :login;"; 
    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':login', $login);

    if (($prepared_query->execute())&&($prepared_query->rowCount()>0))
    {
      $resultat = $prepared_query->fetch(PDO::FETCH_ASSOC);

      $login = $resultat['LOGIN'];
      $mot_de_passe = $resultat['MOT_DE_PASSE'];
      $type_compte = $resultat['TYPE_COMPTE'];
      $solde = $resultat['SOLDE'];
      //return $resultat;
      $utilisateur = new utilisateur($login,$mot_de_passe,$type_compte,$solde);
      $utilisateur->setLogin($login);    
      return $utilisateur;
    }
    else return false;
  }
  
  function insert(&$object)
  {
    $login = $object->getLogin();
    $mot_de_passe = $object->getMot_de_passe();
    $type_compte = $object->getType_compte();
    $solde = $object->getSolde();
    $query  = "INSERT INTO UTILISATEUR (LOGIN, MOT_DE_PASSE, TYPE_COMPTE, SOLDE) VALUES (:login,:mot_de_passe,:type_compte,:solde);";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':login', $login);
    $prepared_query->bindParam(':mot_de_passe', $mot_de_passe);
    $prepared_query->bindParam(':type_compte', $type_compte);
    $prepared_query->bindParam(':solde', $solde);
    if ($prepared_query->execute())
    {
      $object->setlogin($this->database->lastinsertid());
      return true;
    }
    else return false;
  }
  
  function update(&$object)
  {

    $login = $object->getLogin();
    $mot_de_passe = $object->getMot_de_passe();
    $type_compte = $object->getType_compte();
    $solde = $object->getSolde();
    $query  = "UPDATE UTILISATEUR SET LOGIN=:login, MOT_DE_PASSE=:mot_de_passe, TYPE_COMPTE=:type_compte, SOLDE=:solde WHERE LOGIN = :login;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':login', $login);
    $prepared_query->bindParam(':mot_de_passe', $mot_de_passe);
    $prepared_query->bindParam(':type_compte', $type_compte);
    $prepared_query->bindParam(':solde', $solde);
    if ($prepared_query->execute())
    {
      return true;
    }
    else return false;
  }

  function delete(&$object)
  {
    $login = $object->getLogin();
    $query  = "DELETE FROM UTILISATEUR WHERE LOGIN = :login;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':login', $login);

    if ($prepared_query->execute())
    {
      $object=null;
      return true;
    }
    else return false;
  }

}

?>

