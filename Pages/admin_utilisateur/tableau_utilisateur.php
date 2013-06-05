<?php

require_once "../../Entity/dao/utilisateur_dao.php";


// TABLEAU des utilisateurs  
$bdd = new PDO('mysql:host=localhost;dbname=conges','conges','conges');
$sql = "SELECT * FROM UTILISATEUR";
$prepare=$bdd->prepare($sql);
$prepare->execute();
$nbrUtilisateur=$prepare->rowCount();

?>
<?php


for ($i=0; $i < $nbrUtilisateur ; $i++) { 
	$sql = "SELECT * FROM UTILISATEUR LIMIT $i,1";
	$prepare=$bdd->prepare($sql);
	$prepare->execute();
	$resultat = $prepare->fetch(PDO::FETCH_ASSOC);
		echo "<tr>";
			echo "<td>$resultat[LOGIN]</td>";
			echo "<td>$resultat[TYPE_COMPTE]</td>";
			echo "<td>$resultat[MOT_DE_PASSE]</td>";
			echo "<td>$resultat[SOLDE]</td>";
		echo "</tr>";

}
?>