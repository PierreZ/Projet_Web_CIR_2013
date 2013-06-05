<?php
require "../../Setup/config.php";
require_once($root."Entity/dao/utilisateur_dao.php");
require_once $root.'Entity/business/utilisateur.php';
  require_once($root."Entity/business/jour_ferie.php");
  require_once($root."Entity/dao/jour_ferie_dao.php");
   require_once($root."Entity/business/demi_journee.php");
   require_once($root."Entity/dao/demi_journee_dao.php");

class wrapper 
{
	private $solde;


	function __construct($login)
	{
		$this->solde=$this->find_solde($login);



		$string='<div class="wrapper">';
		$string=$string. '<ul class="solde_restant">';

		$string=$string. '<li <a href="#"><span>'.$this->solde.' demi-journée restante</span></a></li>';
		$string=$string. '</ul>';
		$string=$string. '<ul class="resume">';
		$mois = new DateTime('first day of this month');

 			for ($i=0; $i<13 ; $i++) { // Le switch sert à avoir les mois en francais
 				$nbr_sub=$this->countsubitem($mois,$login);
        switch ($mois->format('m')) {
 					case '1':
 					$string=$string. '<li class="item1"><a href="#">Janvier '.$mois->format('Y').'<span id="nbr_sub1">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub1">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '2':
 					$string=$string. '<li class="item2"><a href="#">Février '.$mois->format('Y').'<span id="nbr_sub2">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub2">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '3':
 					$string=$string. '<li class="item3"><a href="#">Mars '.$mois->format('Y').'<span id="nbr_sub3">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub3">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '4':
 					$string=$string. '<li class="item4"><a href="#">Avril '.$mois->format('Y').'<span id="nbr_sub4">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub4">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '5':
 					$string=$string. '<li class="item5"><a href="#">Mai '.$mois->format('Y').'<span id="nbr_sub5">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub5">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '6':
 					$string=$string. '<li class="item6"><a href="#">Juin '.$mois->format('Y').'<span id="nbr_sub6">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub6">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '7':
 					$string=$string. '<li class="item7"><a href="#">Juillet '.$mois->format('Y').'<span id="nbr_sub7">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub7">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '8':
 					$string=$string. '<li class="item8"><a href="#">Août '.$mois->format('Y').'<span id="nbr_sub8">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub8">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '9':
 					$string=$string. '<li class="item9"><a href="#">Septembre '.$mois->format('Y').'<span id="nbr_sub9">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub9">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '10':
 					$string=$string. '<li class="item10"><a href="#">Octobre '.$mois->format('Y').'<span id="nbr_sub10">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub10">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '11':
 					$string=$string. '<li class="item11"><a href="#">Novembre '.$mois->format('Y').'<span id="nbr_sub11">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub11">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 					case '12':
 					$string=$string. '<li class="item12"><a href="#">Décembre '.$mois->format('Y').'<span id="nbr_sub12">'.$nbr_sub.'</span></a></li>';
 					$string=$string.' <ul class="sub12">';
 					$string=$string.$this->subitem($mois,$login);
 					$string=$string.'</ul>';
 					break;
 				}
 				$mois->modify('+1month');
 			}



 			$string=$string.'</ul></div>';
 			echo $string;
 		}

    function countsubitem($mois,$login){

$premier_jour_mois = new DateTime('first day of '.$mois->format('M').' '.$mois->format('Y'));//Premier jour du mois cible
$dernier_jour_mois =new DateTime('last day of '.$mois->format('M').' '.$mois->format('Y'));
$dernier_jour_mois->modify('+1day');
$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour


$i=new DatePeriod($premier_jour_mois,$interval,$dernier_jour_mois); 

$compteur=0;

foreach($i as $jour){

              if ($this->get_ferie($jour)=='True') { // Jour férie ?
                $compteur++;
              }
              else {
                $conge=$this->get_conge($jour,$login);
                switch($conge){
                  case 'matin':
                  $compteur++;
                  break;

                  case 'apres-midi':
                  $compteur++;
                  break; 
                  case 'journee':
                  $compteur++;
                  break;

                }
              }



            }
            return $compteur;


          }
          function subitem($mois,$login){

	$premier_jour_mois = new DateTime('first day of '.$mois->format('M').' '.$mois->format('Y'));//Premier jour du mois cible
  $dernier_jour_mois =new DateTime('last day of '.$mois->format('M').' '.$mois->format('Y'));
  $dernier_jour_mois->modify('+1day');
$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour


$i=new DatePeriod($premier_jour_mois,$interval,$dernier_jour_mois); 

$string='';

foreach($i as $jour){

              if ($this->get_ferie($jour)=='True') { // Jour férie ?
              	$string=$string.'<li class="subitem"><a href="#">Jour férié le '.$jour->format('d').'<span></span></a></li>';
              }
              else {
              	$conge=$this->get_conge($jour,$login);
              	switch($conge){
              		case 'matin':
              		$string=$string.'<li class="subitem"><a href="#">Congé le '.$jour->format('d').' matin<span></span></a></li>';
              		break;

              		case 'apres-midi':
              		$string=$string.'<li class="subitem"><a href="#">Congé le '.$jour->format('d').' après-midi<span></span></a></li>';
              		break; 
              		case 'journee':
              		$string=$string.'<li class="subitem"><a href="#">Congé le '.$jour->format('d').'<span></span></a></li>';
              		break;

              	}
              }



            }
            return $string;
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

function get_ferie($jour){


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
  function get_conge($jour,$login){




   $demi_journee_dao=new demi_journee_dao();


   $jour=$jour->format('Y-m-d');
   $demi_journee=$demi_journee_dao->find($jour);
        if (!is_object($demi_journee)) { // Si jour férie, alors jour_férié est un objet et non juste un bool
        	return false;
        }
        else{
        	if ($demi_journee->getlogin()==$login) {
        		return $demi_journee->getperiode_journee();           } 
        	}



        }

      }?>
