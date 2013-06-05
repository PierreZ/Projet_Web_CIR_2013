<?php


echo '<select id="select" >';
echo '<option value="" selected="Choisissez un utilisateur"></option>';
require_once $root."Entity/dao/utilisateur_dao.php";


// TABLEAU des utilisateurs  
$bdd = new PDO('mysql:host=localhost;dbname=conges','conges','conges');
$sql = "SELECT * FROM UTILISATEUR";
$prepare=$bdd->prepare($sql);
$prepare->execute();
$nbrUtilisateur=$prepare->rowCount();




for ($i=0; $i < $nbrUtilisateur ; $i++) {
	$sql = "SELECT * FROM UTILISATEUR LIMIT $i,1";
	$prepare=$bdd->prepare($sql);
	$prepare->execute();
	$resultat = $prepare->fetch(PDO::FETCH_ASSOC);

	echo '<option value="list_item">'.$resultat['LOGIN'].'</option>';


}

echo '</select>';
?>
