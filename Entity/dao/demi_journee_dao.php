<?php
include_once $root."Entity/dao/dao.php";
include_once $root."Entity/business/demi_journee.php";
/******************************************************************************/
// Class demi_journee_dao
/******************************************************************************/
class demi_journee_dao extends dao {
  

  function find($date_demi_journee)
  {
    $query  = "SELECT * FROM DEMI_JOURNEE WHERE DATE_DEMI_JOURNEE= :date_demi_journee"; 
    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_demi_journee', $date_demi_journee);        
    if (($prepared_query->execute())&&($prepared_query->rowCount()>0))
    {
      $resultat = $prepared_query->fetch(PDO::FETCH_ASSOC);

      $date_demi_journee = $resultat['DATE_DEMI_JOURNEE'];
      $login = $resultat['LOGIN'];
      $periode_journee=$resultat['PERIODE_JOURNEE'];

      $demi_journee = new demi_journee($date_demi_journee,$login,$periode_journee);
      return $demi_journee;
    }
    else return false;
  }
  
  function insert(&$object)
  {
    $date_demi_journee = $object->getdate_demi_journee();
    $login=$object->getlogin();
    $periode_journee=$object->getperiode_journee();


    $query  = "INSERT INTO DEMI_JOURNEE (LOGIN,PERIODE_JOURNEE,DATE_DEMI_JOURNEE) VALUES (:login,:periode_journee,:date_demi_journee);";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':login', $login);
    $prepared_query->bindParam(':periode_journee', $periode_journee);
    $prepared_query->bindParam(':date_demi_journee', $date_demi_journee);

    if ($prepared_query->execute())
    {
      $object->setdate_demi_journee($this->database->lastinsertid());
      return true;
    }
    else return false;
  }
  
  function update(&$object)
  {
 
    $date_demi_journee = $object->getdate_demi_journee();
    $query  = "UPDATE DEMI_JOURNEE SET DATE_DEMI_JOURNEE=:date_demi_journee WHERE DATE_DEMI_JOURNEE = :date_demi_journee;";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_demi_journee', $date_demi_journee);

    if ($prepared_query->execute())
    {
      return true;
    }
    else return false;
  }

  function delete(&$object)
  {
    $date_demi_journee = $object->getdate_demi_journee();
        $login = $object->getlogin();
                $periode_journee = $object->getperiode_journee();



    $query  = "DELETE FROM DEMI_JOURNEE WHERE DATE_DEMI_JOURNEE = :date_demi_journee AND LOGIN=:login AND PERIODE_JOURNEE=:periode_journee";

    $prepared_query = $this->database->prepare($query);
    $prepared_query->bindParam(':date_demi_journee', $date_demi_journee);
        $prepared_query->bindParam(':login', $login);
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

