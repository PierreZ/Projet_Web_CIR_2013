<?php
require_once "../../Entity/dao/type_de_compte_dao.php";


// TABLEAU des utilisateurs  
$bdd = new PDO('mysql:host=localhost;dbname=conges','conges','conges');
$sql = "SELECT * FROM TYPE_DE_COMPTE";
$prepare=$bdd->prepare($sql);
$prepare->execute();
$nbrPERIODE_JOURNEE=$prepare->rowCount();




for ($i=0; $i < $nbrPERIODE_JOURNEE ; $i++) {
	$sql = "SELECT * FROM TYPE_DE_COMPTE LIMIT $i,1";
	$prepare=$bdd->prepare($sql);
	$prepare->execute();
	$resultat = $prepare->fetch(PDO::FETCH_ASSOC);

	echo '<option value="'.$resultat['TYPE_COMPTE'].'">'.$resultat['TYPE_COMPTE'].'</option>';


}



?>