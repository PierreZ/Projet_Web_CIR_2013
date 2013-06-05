<?php
require("../../Setup/config.php");

require_once($root."Entity/dao/utilisateur_dao.php");
require_once($root."Entity/dao/demi_journee_dao.php");
$demi_journee_dao=new demi_journee_dao();
$utilisateur_dao=new utilisateur_dao();

$action=$_POST['action'];


switch ($action) {
	case 'ajout':
$nouveau_nom=$_POST['nouveau_nom'];
$nouveau_solde=$_POST['nouveau_solde'];
$nouveau_mdp=$_POST['nouveau_mdp'];
$nouveau_statut=$_POST['nouveau_statut'];
$utilisateur=new utilisateur($nouveau_nom,$nouveau_mdp,$nouveau_statut,$nouveau_solde);
$utilisateur_test=$utilisateur_dao->find($nouveau_nom);
if (!is_object($utilisateur_test)) {
    	 $utilisateur_dao->insert($utilisateur);

    }else{
    }
		break;

		case 'modif':
    $suppr=$_POST['suppr'];
    $login=$_POST['utilisateur'];
    $modifier_nom=$_POST['modifier_nom'];
    $modifier_mdp=$_POST['modifier_mdp'];
    $modifier_solde=$_POST['modifier_solde'];
    $modifier_statut=$_POST['modifier_statut'];

    if ($suppr=='true') {
        
$utilisateur=$utilisateur_dao->find($login);
$utilisateur_dao->delete($utilisateur);
    }else{
    	$utilisateur_ancien=$utilisateur_dao->find($login);
    	$utilisateur_nouveau=new utilisateur();
    	if ($modifier_nom=='') {
    		$utilisateur_nouveau->setLogin($utilisateur_ancien->getLogin());
    	} else {
    		   $utilisateur_nouveau->setLogin($modifier_nom);
			}
    	if ($modifier_mdp=='') {
    		$utilisateur_nouveau->setMot_de_passe($utilisateur_ancien->getMot_de_passe());
    	} else {
    		$utilisateur_nouveau->setMot_de_passe($modifier_mdp);
    	}
    	if ($modifier_statut=='') {
    		$utilisateur_nouveau->setType_compte($utilisateur_ancien->getType_compte());
    	} else {
    		$utilisateur_nouveau->setType_compte($modifier_statut);
    	}
    	   if ($modifier_solde=='') {
    		$utilisateur_nouveau->setSolde($utilisateur_ancien->getSolde());
    	} else {
    		$utilisateur_nouveau->setSolde($modifier_solde);
    	}
    	
    	$utilisateur_dao->update($utilisateur_nouveau);
    	
    }
			break;
}

?>