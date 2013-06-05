<?php
include_once $root."Entity/dao/dao.php";
include_once $root."Entity/business/jour_ferie.php";
/******************************************************************************/
// Class jour_ferie_dao
/******************************************************************************/
class jour_ferie_dao extends dao {

  function find($date_ferie)
  {
    $query  = "SELECT * FROM JOUR_FERIE WHERE DATE_FERIE=:date_ferie;"; 
    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_ferie', $date_ferie);
        
    if (($prepared_query->execute())&&($prepared_query->rowCount()>0))
    {
      $resultat = $prepared_query->fetch(PDO::FETCH_ASSOC);

      $date_ferie = $resultat['DATE_FERIE'];


      $jour_ferie = new jour_ferie($date_ferie);
      $jour_ferie->setdate_ferie($date_ferie);    
      return $jour_ferie;
    }
    else return false;
  }
  
  function insert(&$object)
  {
    $date_ferie = $object->getdate_ferie();

    $query  = "INSERT INTO JOUR_FERIE (DATE_FERIE) VALUES (:date_ferie);";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_ferie', $date_ferie);

    if ($prepared_query->execute())
    {
      $object->setdate_ferie($this->database->lastinsertid());
      return true;
    }
    else return false;
  }
  
  function update(&$object)
  {
 
    $date_ferie = $object->getdate_ferie();

    $query  = "UPDATE JOUR_FERIE SET DATE_FERIE=:date_ferie WHERE DATE_FERIE = :date_ferie;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_ferie', $date_ferie);

    if ($prepared_query->execute())
    {
      return true;
    }
    else return false;
  }

  function delete(&$object)
  {
    $id = $object->getjour_ferie();
    $query  = "DELETE FROM JOUR_FERIE WHERE DATE_FERIE = :date_ferie;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_ferie', $date_ferie);

    if ($prepared_query->execute())
    {
      $object=null;
      return true;
    }
    else return false;
  }


}

?>

