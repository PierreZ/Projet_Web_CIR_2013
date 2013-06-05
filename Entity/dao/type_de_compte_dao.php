<?php
include_once $root."Entity/dao/dao.php";
include_once $root."Entity/business/type_de_compte.php";
/******************************************************************************/
// Class type_de_compte_dao
/******************************************************************************/
class type_de_compte_dao extends dao {

  function find($type_compte)
  {
    $query  = "SELECT * FROM TYPE_DE_COMPTE WHERE TYPE_COMPTE= :type_compte;"; 
    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':type_compte', $type_compte);
        
    if (($prepared_query->execute())&&($prepared_query->rowCount()>0))
    {
      $resultat = $prepared_query->fetch(PDO::FETCH_ASSOC);

      $type_compte = $resultat['TYPE_COMPTE'];


      $type_compte = new type_de_compte($type_compte);
      $type_compte->settype_compte($type_compte);    
      return $type_compte;
    }
    else return false;
  }
  
  function insert(&$object)
  {
    $type_compte = $object->gettype_compte();
    $mot_de_passe = $object->getmot_de_passe();
    $type_compte = $object->gettype_compte();
    $solde = $object->getsolde();
    $query  = "INSERT INTO TYPE_DE_COMPTE (TYPE_COMPTE) VALUES (:type_compte);";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':type_compte', $type_compte);

    if ($prepared_query->execute())
    {
      $object->settype_compte($this->database->lastinsertid());
      return true;
    }
    else return false;
  }
  
  function update(&$object)
  {
 
    $type_compte = $object->gettype_compte();

    $query  = "UPDATE TYPE_DE_COMPTE SET TYPE_COMPTE=:type_compte WHERE TYPE_COMPTE = :type_compte;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':type_compte', $type_compte);

    if ($prepared_query->execute())
    {
      return true;
    }
    else return false;
  }

  function delete(&$object)
  {
    $id = $object->gettype_compte();
    $query  = "DELETE FROM TYPE_DE_COMPTE WHERE TYPE_COMPTE = :type_compte;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':type_compte', $type_compte);

    if ($prepared_query->execute())
    {
      $object=null;
      return true;
    }
    else return false;
  }


}

?>

