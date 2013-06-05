$(document).ready(function () {
    var menu_ul = $('.resume > ul'), // initilisation de quelques variables globales
    menu_a  = $('.resume > li'),
    menu_solde=$('.solde_restant');
    var var_url_ajax=window.var_url+'Pages/admin_agenda/traitement_requete_ajax.php';


$(document).on('click','.jour', function(e){ // clic sur un jour sans congé
var temp=$(this).children().attr("datetime"); // On récupere la date du clic
  var var_login=$('#select').find(":selected").text();
  if (var_login=='') {return ;};
jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    date:temp,
    login:var_login,
    action:'clic_jour'
  }, 
  success: function(data, textStatus, jqXHR) {
refresh_calendar();
refresh_wrapper();
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }
});
});

$(document).on('click','.conge', function(e){ // Clic sur un congé
var temp=$(this).children().attr("datetime"); // On récupere la date du clic
  var var_login=$('#select').find(":selected").text();
    if (var_login=='') {return ;};

jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    date:temp,
    login:var_login,
    action:'clic_conge'
  }, 
  success: function(data, textStatus, jqXHR) {
refresh_calendar();
refresh_wrapper();
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }
});
});



    $('#button_suppr').click(function () { // Afichage du dropdown suppr
      if ($('#dropbox_suppr').is(':hidden')) {
        $('#dropbox_suppr').slideDown('normal', function () {
                // animation si clic
              });
      } else {
        $('#dropbox_suppr').hide();
      }

    });

    $('#button_ajouter').click(function () { // Affichage du dropdown ajouter
      if ($('#dropbox_ajouter').is(':hidden')) {
        $('#dropbox_ajouter').slideDown('normal', function () {
                // animation si clic
              });
      } else {
        $('#dropbox_ajouter').hide();
      }

    });

    




 $(document).on('click','#Submit_ajout', function(e){ // Click sur le bouton submit_ajout
  var var_ajout_nouveau_debut_journee=$('.ajout_nouveau_debut_journee').find(":selected").text();
  var var_ajout_nouveau_debut=$('#ajout_nouveau_debut').val();

  var var_ajout_nouveau_fin_journee=$('.ajout_nouveau_fin_journee').find(":selected").text();
  var var_ajout_nouveau_fin=$('#ajout_nouveau_fin').val();

  var var_login=$('#select').find(":selected").text();

    if ((var_ajout_nouveau_debut_journee=='') || // Si il y a un cahmp vide on quitte
      (var_ajout_nouveau_debut=='') ||
      (var_ajout_nouveau_fin_journee=='') ||
      (var_ajout_nouveau_fin=='')||
      (var_login=='')) {
      alert('un champ est vide !');
    return ;
  }
  else{
        jQuery.ajax({ // Premiere requete ajax d'insertion
          type: 'POST',
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'ajout_conge',
    login:var_login,
    ajout_nouveau_debut_journee: var_ajout_nouveau_debut_journee,
    ajout_nouveau_debut:var_ajout_nouveau_debut,
    ajout_nouveau_fin_journee:var_ajout_nouveau_fin_journee,
    ajout_nouveau_fin:var_ajout_nouveau_fin,

     // Les donnees que l'on souhaite envoyer au serveur au format JSON
   }, 


  success: function(data, textStatus, jqXHR) {
  if(data){
alert(data);
           }
  $('#dropbox_ajouter').hide();
// Refresh du calendrier
refresh_calendar();

//refresh du wrapper
refresh_wrapper();
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }
});
 }; // fin du if


}); // Fin du click ajout


  $(document).on('click','#Submit_suppr', function(e){ // Click sur le bouton submit_suppr

    var var_suppr_debut_journee=$('.suppr_debut_journee').find(":selected").text();
    var var_suppr_debut=$('#suppr_debut').val();

    var var_suppr_fin_journee=$('.suppr_fin_journee').find(":selected").text();
    var var_suppr_fin=$('#suppr_fin').val();

    var var_login=$('#select').find(":selected").text();


    if ((var_suppr_debut_journee=='') || // Si il y a un cahmp vide on quitte
      (var_suppr_debut=='') ||
      (var_suppr_fin_journee=='') ||
      (var_suppr_fin=='')||
      (var_login=='')) {
      alert('un champ est vide !');
    return ;
  }

  jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action:'suppr_conge',
    suppr_debut: var_suppr_debut, 
    suppr_debut_journee: var_suppr_debut_journee, 
    suppr_fin_journee: var_suppr_fin_journee,
    suppr_fin: var_suppr_fin,
    login:var_login

  }, 
  success: function(data, textStatus, jqXHR) {
  $('#dropbox_ajouter').hide();
   refresh_calendar();

//refresh du wrapper
refresh_wrapper();

  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }
});
});// Fin du click suppr








function refresh_wrapper(){
  var var_login=$('#select').find(":selected").text();
  menu_ul.hide();
  var var_mois = document.getElementById('info_mois').innerHTML;
  var var_annee = document.getElementById('info_annee').innerHTML;
  jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {     // Les donnees que l'on souhaite envoyer au serveur au format JSON
  action: 'maj_wrapper',
  mois: var_mois,
  annee:var_annee,
  login:var_login,

}, 
success: function(data) {
  $(".wrapper").replaceWith(data);
  $('.resume > li').removeClass('active');
  $('.resume > li').next().stop(true,true).slideUp('normal');


},
error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }

});
}


function refresh_calendar(){

  var var_mois = document.getElementById('info_mois').innerHTML;
  var var_annee = document.getElementById('info_annee').innerHTML;
  var var_login=$('#select').find(":selected").text();
  jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'liste_change',
    mois: var_mois,
    annee:var_annee,
    login:var_login,

     // Les donnees que l'on souhaite envoyer au serveur au format JSON
   }, 
   success: function(data) {
    $(".cal_frame").replaceWith(data);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
  }
});
}


}); // Fin du fichier js