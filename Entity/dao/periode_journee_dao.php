<?php
include_once $root."Entity/dao/dao.php";
include_once $root."Entity/business/periode_journee.php";
/******************************************************************************/
// Class periode_journee_dao
/******************************************************************************/
class periode_journee_dao extends dao {

  function find($periode_journee)
  {
    $query  = "SELECT * FROM PERIODE_JOURNEE WHERE PERIODE_JOURNEE= :periode_journee;"; 
    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':periode_journee', $periode_journee);
        
    if (($prepared_query->execute())&&($prepared_query->rowCount()>0))
    {
      $resultat = $prepared_query->fetch(PDO::FETCH_ASSOC);

      $periode_journee = $resultat['PERIODE_JOURNEE'];


      $periode_journee = new periode_journee($periode_journee);
      $periode_journee->setperiode_journee($periode_journee);    
      return $periode_journee;
    }
    else return false;
  }
  
  function insert(&$object)
  {
    $periode_journee = $object->getperiode_journee();
    $mot_de_passe = $object->getmot_de_passe();
    $type_compte = $object->gettype_compte();
    $solde = $object->getsolde();
    $query  = "INSERT INTO PERIODE_JOURNEE (PERIODE_JOURNEE) VALUES (:periode_journee);";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':periode_journee', $periode_journee);

    if ($prepared_query->execute())
    {
      $object->setperiode_journee($this->database->lastinsertid());
      return true;
    }
    else return false;
  }
  
  function update(&$object)
  {
 
    $periode_journee = $object->getperiode_journee();

    $query  = "UPDATE PERIODE_JOURNEE SET PERIODE_JOURNEE=:periode_journee WHERE PERIODE_JOURNEE = :periode_journee;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':periode_journee', $periode_journee);

    if ($prepared_query->execute())
    {
      return true;
    }
    else return false;
  }

  function delete(&$object)
  {
    $id = $object->getperiode_journee_id();
    $query  = "DELETE FROM PERIODE_JOURNEE WHERE PERIODE_JOURNEE = :periode_journee;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':periode_journee', $periode_journee);

    if ($prepared_query->execute())
    {
      $object=null;
      return true;
    }
    else return false;
  }


}

?>

