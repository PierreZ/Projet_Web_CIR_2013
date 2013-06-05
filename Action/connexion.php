<?php
session_start();
require("../Setup/config.php");
require_once $root."Entity/dao/utilisateur_dao.php";


/*Récupération des info d'identification*/
$login=$_POST['login'];
$mdp=$_POST['password'];
$utilisateur_dao= new utilisateur_dao();

$utilisateur=$utilisateur_dao->find($login);
if ($utilisateur==FALSE) {

	echo "Vous n'êtes pas identifié !!";
	header("Refresh: 2; ../index.php");
}
//if ($utilisateur_dao['LOGIN']===$login){
if($utilisateur->getLogin()==$login){
	
	//if($utilisateur_dao['MOT_DE_PASSE']===$mdp){
	if($utilisateur->getMot_de_passe()==$mdp){
		//if($utilisateur_dao['TYPE_COMPTE']==='admin'){
		if($utilisateur->getType_compte()=='admin'){	
			$_SESSION['statut'] = 'admin';
			header("Refresh: 0; ../Pages/admin_agenda/index.php");
		}
		else{
			echo "Vous n'etes pas un admin,redirection vers la page utilisateur!";
			header("Refresh: 1; ../Pages/utilisateur/index.php");
		}
	
	}
	else{
		echo "Mauvais login/mot de passe!";
		header("Refresh: 1; ../index.php");
	}
}



?>

