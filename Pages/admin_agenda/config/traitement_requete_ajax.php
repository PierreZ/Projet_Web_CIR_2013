<?php

require("../../../Setup/config.php");

require_once($root."Entity/dao/jour_ferie_dao.php");
require_once($root."Entity/dao/demi_journee_dao.php");

$demi_journee_dao=new demi_journee_dao();

$action=$_POST['action'];

switch ($action) {
	case 'ajout_ferie':
$date=new DateTime($_POST['conge']);
$ferie=new jour_ferie($date->format('Y-m-d'));
$jour_ferie_dao=new jour_ferie_dao();
$jour_ferie_dao->insert($ferie);
		break;
	
case 'ajout_conge':
$debut=new DateTime($_POST['debut']);
$fin=new DateTime($_POST['fin']);
$fin->modify('+1day');

        		$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour
        		$i=new DatePeriod($debut,$interval,$fin);
require_once "../../../Entity/dao/utilisateur_dao.php";


// TABLEAU des utilisateurs  
$bdd = new PDO('mysql:host=localhost;dbname=conges','conges','conges');
$sql = "SELECT * FROM UTILISATEUR";
$prepare=$bdd->prepare($sql);
$prepare->execute();
$nbrUtilisateur=$prepare->rowCount();



foreach($i as $jour){ 
if ($jour->format('N')!=6 && $jour->format('N')!=7 ) { // Si c'est samedi ou dimanche
					
for ($i=0; $i < $nbrUtilisateur ; $i++) {
	$sql = "SELECT * FROM UTILISATEUR LIMIT $i,1";
	$prepare=$bdd->prepare($sql);
	$prepare->execute();
	$resultat = $prepare->fetch(PDO::FETCH_ASSOC);
					$demi_journee=new demi_journee($jour->format('Y-m-d'),$resultat['LOGIN'],'journee');
					$demi_journee_dao->insert($demi_journee);
	


}


}
}
	break;

	default:
		# code...
		break;
}

?>