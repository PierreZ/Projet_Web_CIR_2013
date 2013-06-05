<?php

require("../../Setup/config.php");
    require_once($root."Entity/business/jour_ferie.php");
    require_once($root."Entity/dao/jour_ferie_dao.php");
    require_once($root."Entity/business/demi_journee.php");
    require_once($root."Entity/dao/demi_journee_dao.php");
class calendrier{

  private $premier_jour_repere;
  private $dernier_jour_repere;
  private $date;




  function __construct($mois,$annee,$login){

    $this->date=new DateTime('01-'.$mois.'-'.$annee);



 // Constructeur récupère la date d'aujourdhui et appel la méthode set calendar
    $string=$this->set_calendar($this->date,$login);

    echo ($string);
  }


// $repere est une variable de type DateTime qui comprend jour, mois, année, heure, fuseaux horaires.

  function set_calendar($repere,$login){



$premier_jour_repere = new DateTime('first day of '.$repere->format('M').' '.$repere->format('Y'));//Premier jour du mois cible
$dernier_jour_repere =new DateTime('last day of '.$repere->format('M').' '.$repere->format('Y'));//dernier jour du mois cible
// var_dump($premier_jour_repere);
// var_dump($dernier_jour_repere);

$compteur=0;
 if ($premier_jour_repere->format('N')!='1') { // Recherche des jours hors mois précédent
  $dernier_jour_mois_precedent= new DateTime('first day of '.$repere->format('M').' '.$repere->format('Y'));
$dernier_jour_mois_precedent->modify('-1day'); // On recule d'un jour pour avoir le dernier jour du mois précédent
$debut_boucle = new DateTime('first day of '.$repere->format('M').' '.$repere->format('Y'));
$debut_boucle->modify('-1day');
$temp=$premier_jour_repere->format('N');
$temp--;

 for ($i=1; $i < $temp; $i++) {  // on recule dans les jours
 	$debut_boucle->modify('-1day');
 }
}
else{ // Sinon on met le premier jour du mois recherché
  $debut_boucle=new DateTime('first day of '.$repere->format('M').' '.$repere->format('Y'));

}


 if ($dernier_jour_repere->format('N')!='7') { //  Recherche des jours hors mois suivant
   $premier_jour_mois_suivant=new DateTime('last day of '.$repere->format('M').' '.$repere->format('Y'));
   $premier_jour_mois_suivant->modify('+1day'); 
   $fin_boucle =new DateTime('last day of '.$repere->format('M').' '.$repere->format('Y'));
   $fin_boucle->modify('+1day');
 for ($i=1; $i < 8-$dernier_jour_repere->format('N'); $i++) { //on avance dans les jours
 	$fin_boucle->modify('+1day');
 }



}
else{

	$fin_boucle=new DateTime('last day of '.$repere->format('M').' '.$repere->format('Y'));
    $fin_boucle->modify('+1day');//On fixe le dernier jour à Dimanche sinon

  }

  $string='  <section class="cal_frame">
  <table class="cal">
  <thead>
  <tr class="cal_header">
  <th><a href="#" class="cal_precedent" title="Précédent"><</a></th>
  <th colspan="5" class="cal_title"><span id="info_mois">'.$repere->format('m').'</span>-<span id="info_annee">'.$repere->format('Y').'</span></th>
  <th><a href="#" class="cal_suivant" title="Suivant">></a></th>
  </tr>
  <tr class="cal_jour">
  <th abbr="Lundi"> Lundi </th>
  <th abbr="Mardi"> Mardi </th>
  <th abbr="Mercredi"> Mercredi </th>
  <th abbr="Jeudi"> Jeudi </th>
  <th abbr="Vendredi"> Vendredi </th>
  <th abbr="Samedi"> Samedi </th>
  <th abbr="Dimanche"> Dimanche </th>
  </tr>
  </thead>  
  <tbody>';

  $string=$string.'<tr class="semaine">';



$interval = new DateInterval('P1D');// P1D=> Plus 1 Day => L'intervalle comprend chaque jour


$i=new DatePeriod($debut_boucle,$interval,$fin_boucle); 



foreach($i as $jour){


            if ($jour->format('m')!=$repere->format('m')) { // test si le jour appartient aux mois voulu
              $conge=$this->get_conge($jour,$login);
              $string=$string.'<td class="jour_hors_mois"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'</time</td>';
            }
            
            else{

              if ($this->get_ferie($jour)=='True') { // Jour férie ?
                $string=$string.'<td class="jour_ferie"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'<br/>Jour férié </time></td>';
              }
              else {
                $conge=$this->get_conge($jour,$login);
                switch($conge){
                  case 'matin':
                  $string=$string.'<td class="conge"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'<br/>Congé le matin</time</td>';
                  break;

                  case 'apres-midi':
                  $string=$string.'<td class="conge"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'<br/>Congé l\'après-midi</time</td>';
                  break; 
                  case 'journee':
                  $string=$string.'<td class="conge"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'<br/>Congé la journée</time</td>';
                  break;

                  default:
                  $string=$string.'<td class="jour"><time datetime="'.$jour->format('Y-m-d').'">'.$jour->format('d').'</time></td>';
                  break;
                }
              }
            }


            $compteur++;
     	if ($compteur%7==0) {// Gestion du retour à la ligne
        $string=$string."</tr>";
        $string=$string.'<tr class="semaine">';

      }


    }

    $string=$string.'</tbody></table></section>';

    return $string;
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

      }
      ?>

