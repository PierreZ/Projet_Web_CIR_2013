<?php
require_once $root."Entity/dao/periode_journee_dao.php";


// TABLEAU des utilisateurs  
$bdd = new PDO('mysql:host=localhost;dbname=conges','conges','conges');
$sql = "SELECT * FROM PERIODE_JOURNEE";
$prepare=$bdd->prepare($sql);
$prepare->execute();
$nbrPERIODE_JOURNEE=$prepare->rowCount();




for ($i=0; $i < $nbrPERIODE_JOURNEE ; $i++) {
	$sql = "SELECT * FROM PERIODE_JOURNEE LIMIT $i,1";
	$prepare=$bdd->prepare($sql);
	$prepare->execute();
	$resultat = $prepare->fetch(PDO::FETCH_ASSOC);

	echo '<option value="'.$resultat['PERIODE_JOURNEE'].'">'.$resultat['PERIODE_JOURNEE'].'</option>';


}



?>