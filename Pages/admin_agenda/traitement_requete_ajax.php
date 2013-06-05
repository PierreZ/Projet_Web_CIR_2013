<?php
require("../../Setup/config.php");
require_once('calendrier.php');
require_once 'wrapper.php';
require_once($root."Entity/dao/demi_journee_dao.php");
require_once($root."Entity/dao/utilisateur_dao.php");



$action=$_POST['action'];


switch ($action) { 
	case 'clic_jour':
	$temp=new DateTime($_POST['date']);
	$login=$_POST['login'];
	$utilisateur_dao=new utilisateur_dao();
	$utilisateur=$utilisateur_dao->find($login);
	$solde=$utilisateur->getSolde();
	if ($temp->format('N')!=6 && $temp->format('N')!=7 && (compteur_single_conge($temp,$login,'matin')<=$solde)){
		set_single_conge($temp,$login,'matin');
		update_enlever_solde($login,1);
	}
	break;

	case 'clic_conge':
	$temp=new DateTime($_POST['date']);
	$login=$_POST['login'];
	$utilisateur_dao=new utilisateur_dao();
	$utilisateur=$utilisateur_dao->find($login);
	$solde=$utilisateur->getSolde();
	if ($temp->format('N')!=6 && $temp->format('N')!=7){
		switch (test_conge($temp,$login)) {

			case 'matin':
			if (compteur_single_conge($temp,$login,'apres-midi')<=$solde) {
				remove_single_conge($temp,$login,'matin');
				set_single_conge($temp,$login,'apres-midi');
				update_enlever_solde($login,1);			
			}

			break;
			case 'apres-midi':
			if (compteur_single_conge($temp,$login,'journee')<=$solde) {
				remove_single_conge($temp,$login,'apres-midi');
				set_single_conge($temp,$login,'journee');
				update_enlever_solde($login,2);
			}

			break;
			case 'journee':
			remove_single_conge($temp,$login,'journee');
			break;
		}
	}
	break;




	case 'previous': // mois précédent pour le calendier 
	$mois=$_POST['mois'];
	$annee=$_POST['annee'];
	$login=$_POST['login']; 
	$temp=new DateTime('01-'.$mois.'-'.$annee);
	$temp->modify('-1month');
	$calendrier=new calendrier($temp->format('m'),$temp->format('Y'),$login);
	break;

	case 'next': // Mois suivant pour le calendrier
	$mois=$_POST['mois'];
	$annee=$_POST['annee'];
	$login=$_POST['login'];
	$temp=new DateTime('01-'.$mois.'-'.$annee);
	$temp->modify('+1month');
	$calendrier=new calendrier($temp->format('m'),$temp->format('Y'),$login);
	break;
	case 'liste_change': // Refresh du calendrier sans changer le mois
	$mois=$_POST['mois'];
	$annee=$_POST['annee'];
	$login=$_POST['login'];
	$temp=new DateTime('01-'.$mois.'-'.$annee);
	$calendrier=new calendrier($temp->format('m'),$temp->format('Y'),$login);
	break;

	case 'maj_wrapper': // Refresh du wrapper

	$login=$_POST['login'];
	$wrapper=new wrapper($login);
	break;
	
	case 'ajout_conge': // ajout d'un congé

	$login=$_POST['login']; 
	$ajout_nouveau_debut_journee=$_POST['ajout_nouveau_debut_journee'];
	$ajout_nouveau_debut=new DateTime($_POST['ajout_nouveau_debut']);
	$ajout_nouveau_fin_journee=$_POST['ajout_nouveau_fin_journee'];
	$ajout_nouveau_fin=new DateTime($_POST['ajout_nouveau_fin']);
	$fin_boucle=new DateTime($_POST['ajout_nouveau_fin']);
	$fin_boucle->modify('+1day');

	$solde=find_solde($login);

	$compteur=0;

	if ($ajout_nouveau_debut->format('Y-m-d')===$ajout_nouveau_fin->format('Y-m-d')) { // Si il n'y a qu'un seul jours

	$compteur=compteur_single_conge($ajout_nouveau_debut,$login,$ajout_nouveau_debut_journee);
	if ($solde>=$compteur) {
		set_single_conge($ajout_nouveau_debut,$login,$ajout_nouveau_debut_journee);
		update_enlever_solde($login,$compteur);
		echo "Congé ajouté";
	} else {
		echo "pas assez de congé ! veuillez modifier les congés";
	}
	
}
	else { // Si il y a plusieurs jours
		$compteur=compteur_multi_conge($ajout_nouveau_debut,$ajout_nouveau_debut_journee,$ajout_nouveau_fin,$ajout_nouveau_fin_journee,$login,$fin_boucle);
		if ($solde>=$compteur && $solde!=0) {
			set_multi_conge($ajout_nouveau_debut,$ajout_nouveau_debut_journee,$ajout_nouveau_fin,$ajout_nouveau_fin_journee,$login,$fin_boucle);
			update_enlever_solde($login,$compteur);
			echo "Congé ajouté";



		} else {
			echo "pas assez de congé ! veuillez modifier les congés";
		}
		
	}// Fin du else


	break;

	case 'suppr_conge':
	$login=$_POST['login']; 
	$suppr_debut_journee=$_POST['suppr_debut_journee'];
	$suppr_debut=new DateTime($_POST['suppr_debut']);
	$suppr_fin_journee=$_POST['suppr_fin_journee'];
	$suppr_fin=new DateTime($_POST['suppr_fin']);
	$fin_boucle=new DateTime($_POST['suppr_fin']);
	$fin_boucle->modify('+1day');


	if ($suppr_debut->format('Y-m-d')===$suppr_fin->format('Y-m-d')) { 
		remove_single_conge($suppr_debut,$login,$suppr_debut_journee);
	}
	else{

		remove_multi_conge($suppr_debut,$suppr_debut_journee,$suppr_fin,$suppr_fin_journee,$login,$fin_boucle);
	}

	break;

}










function update_enlever_solde($login,$compteur){
	$utilisateur= new utilisateur();
	$utilisateur_dao=new utilisateur_dao();
	$utilisateur=$utilisateur_dao->find($login);

	if (!is_object($utilisateur)) { // Si jour férie, alors jour_férié est un objet et non juste un bool
		return 0;
	}else{
		$solde=$utilisateur->getSolde();
		$solde=$solde-$compteur;
		$utilisateur->setSolde($solde);
		$utilisateur_dao->update($utilisateur);

	}

}

function update_ajouter_solde($login,$compteur){
	$utilisateur= new utilisateur();
	$utilisateur_dao=new utilisateur_dao();
	$utilisateur=$utilisateur_dao->find($login);

	if (!is_object($utilisateur)) { // Si jour férie, alors jour_férié est un objet et non juste un bool
		return 0;
	}else{
		$solde=$utilisateur->getSolde();
		$solde=$solde+$compteur;
		$utilisateur->setSolde($solde);
		$utilisateur_dao->update($utilisateur);

	}

}



function get_ferie($jour){

	require_once("../../Entity/business/jour_ferie.php");
	require_once("../../Entity/dao/jour_ferie_dao.php");
	$jour_ferie=new jour_ferie();
	$jour_ferie_dao=new jour_ferie_dao();


	$jour=$jour->format('Y-m-d');
	$jour_ferie=$jour_ferie_dao->find("$jour");
    if (!is_object($jour_ferie)) { // Si jour férie, alors jour_férié est un objet et non juste un bool
    	return false;
    }else{
    	return True;
    }

}



function find_solde($login){
	$utilisateur= new utilisateur();
	$utilisateur_dao=new utilisateur_dao();
	$utilisateur=$utilisateur_dao->find($login);

	if (!is_object($utilisateur)) { // Si jour férie, alors jour_férié est un objet et non juste un bool
		return 0;
	}else{
		return $utilisateur->getSolde();
	}
}

function set_single_conge($ajout_nouveau_debut,$login,$ajout_nouveau_debut_journee){

	$demi_journee_dao=new demi_journee_dao();
	$demi_journee=new demi_journee($ajout_nouveau_debut->format('Y-m-d'),$login,$ajout_nouveau_debut_journee);
	if (test_conge($ajout_nouveau_debut,$login)==false || get_ferie($ajout_nouveau_debut)==true ) {
	if ($ajout_nouveau_debut->format('N')==6 || $ajout_nouveau_debut->format('N')==7 ) { // Si c'est samedi ou dimanche
		# code...
} else {
	$demi_journee_dao->insert($demi_journee);
}

}
else {
	echo "il y a déjà un jour de congé dans cette période, veuillez l'enlever pour poser une période de congé";
}
}

function remove_single_conge($suppr_debut,$login,$suppr_debut_journee){

	$demi_journee_dao=new demi_journee_dao();
	$demi_journee=new demi_journee($suppr_debut->format('Y-m-d'),$login,$suppr_debut_journee);
	if (test_conge($suppr_debut,$login)==false || get_ferie($suppr_debut)==true ) {
	if ($suppr_debut->format('N')==6 || $suppr_debut->format('N')==7 ) { // Si c'est samedi ou dimanche
}
else {

}

} else {
	$compteur=compteur_single_conge($suppr_debut,$login,$suppr_debut_journee);
	$demi_journee_dao->delete($demi_journee);
	update_ajouter_solde($login,$compteur);}
}


function compteur_single_conge($ajout_nouveau_debut,$login,$ajout_nouveau_debut_journee){
	$compteur=0;
	if ($ajout_nouveau_debut->format('N')==6 || $ajout_nouveau_debut->format('N')==7  || get_ferie($ajout_nouveau_debut)==true  ) { // Si c'est samedi ou dimanche
		# code...
} else {
	switch ($ajout_nouveau_debut_journee) {
		case 'matin':
		$compteur++;
		break;

		case 'apres-midi':
		$compteur++;
		break;
		case 'journee':
		$compteur++;
		$compteur++;
		break;

	}	}
	



	return $compteur;
}






function test_conge($jour,$login){



	require_once("../../Entity/business/demi_journee.php");
	require_once("../../Entity/dao/demi_journee_dao.php");
	$demi_journee_dao=new demi_journee_dao();


	$jour=$jour->format('Y-m-d');
	$demi_journee=$demi_journee_dao->find($jour);
        if (!is_object($demi_journee)) { // Si congé, alors demijournee est un objet et non juste un bool
        	return false;
        }
        else{
        	if ($demi_journee->getlogin()==$login) {
        		return $demi_journee->getperiode_journee();
        	} 
        }
    }






    function remove_multi_conge($suppr_debut,$suppr_debut_journee,$suppr_fin,$suppr_fin_journee,$login,$fin_boucle){
    	$demi_journee_dao=new demi_journee_dao();
	$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour
	$i=new DatePeriod($suppr_debut,$interval,$fin_boucle);
	$compteur=0;
	foreach($i as $jour){
		$temp=test_conge($jour,$login);
		if ($temp=='false') {
		}
		else{
			$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$temp);
			$demi_journee_dao->delete($demi_journee);
			if ($temp!='journee') {
				$compteur++;

			} else {
				$compteur=$compteur+2;
			}
		}
	}
	update_ajouter_solde($login,$compteur);
}





function set_multi_conge($ajout_nouveau_debut,$ajout_nouveau_debut_journee,$ajout_nouveau_fin,$ajout_nouveau_fin_journee,$login,$fin_boucle){
	$demi_journee_dao=new demi_journee_dao();
        		$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour
        		$i=new DatePeriod($ajout_nouveau_debut,$interval,$fin_boucle);
        		$string='journee';
        		foreach($i as $jour){ 

        			if (test_conge($jour,$login)==false || get_ferie($jour)==true ) {

	if ($jour->format('N')==6 || $jour->format('N')==7 ) { // Si c'est samedi ou dimanche
		# code...
} else {

		if ($jour->format('Y-m-d')==$ajout_nouveau_debut->format('Y-m-d')) { // Si la boucle est au premier jour

				if ($ajout_nouveau_debut_journee=='matin') { // Si l'utilisateur a marqué matin le premier jour, il faut mettre journée
				$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$string);
				$demi_journee_dao->insert($demi_journee);
			}
					else { // Si il a marqué aprem ou journée, on l'insère
					$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$ajout_nouveau_debut_journee);
					$demi_journee_dao->insert($demi_journee);
				}

			}
		else { // Si la boucle n'est pas au premier jour
			if ($jour->format('Y-m-d')==$ajout_nouveau_fin->format('Y-m-d')) { // Si la boucle est au dernier jour
				if ($ajout_nouveau_fin_journee=='apres-midi') { // Si la fin du congé est une apres-midi
					$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$string);
					$demi_journee_dao->insert($demi_journee);
				} else {
					$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$ajout_nouveau_fin_journee);
					$demi_journee_dao->insert($demi_journee);
				}
				
			} else { // Si c'est un jour quelconque de la boucle
			$demi_journee=new demi_journee($jour->format('Y-m-d'),$login,$string);
			$demi_journee_dao->insert($demi_journee);
		}

	}
}
} else {
	echo "il y a déjà un jour de congé dans cette période, veuillez l'enlever pour poser une période de congé";
	
}
	}// FIn du for
}

function compteur_multi_conge($ajout_nouveau_debut,$ajout_nouveau_debut_journee,$ajout_nouveau_fin,$ajout_nouveau_fin_journee,$login,$fin_boucle){
        		$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour
        		$i=new DatePeriod($ajout_nouveau_debut,$interval,$fin_boucle);
        		$compteur=0;
        		foreach($i as $jour){ 
	if ($jour->format('N')==6 || $jour->format('N')==7  || get_ferie($jour)==true || test_conge($jour,$login)!=false ) { // Si c'est samedi ou dimanche
		# code...
} else {


		if ($jour->format('Y-m-d')==$ajout_nouveau_debut->format('Y-m-d')) { // Si la boucle est au premier jour

				if ($ajout_nouveau_debut_journee=='apres-midi' || $ajout_nouveau_debut_journee=='journee') { // Si l'utilisateur a marqué matin le premier jour, il faut mettre journée
				$compteur++;
				$compteur++;
			}
					else { // Si il a marqué aprem ou journée, on l'insère
					$compteur++;


				}

			}
		else { // Si la boucle n'est pas au premier jour
			if ($jour->format('Y-m-d')==$ajout_nouveau_fin->format('Y-m-d')) { // Si la boucle est au dernier jour
				if ($ajout_nouveau_fin_journee!='matin') { // Si la fin du congé est une apres-midi
					$compteur++;
					$compteur++;
				} else {
					$compteur++;
				}
				
			} else { // Si c'est un jour quelconque de la boucle
			$compteur++;
			$compteur++;
		}

	}
	}}// FIn du for
	return $compteur;
}


?>