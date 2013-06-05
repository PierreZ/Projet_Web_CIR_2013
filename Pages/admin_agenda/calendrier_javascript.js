$(document).ready(function(){

    var var_url_ajax=window.var_url+'Pages/admin_agenda/traitement_requete_ajax.php';


$('#select').change(function() {
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

  });

 

$(document).on('click', '.cal_precedent', function(){
var var_mois = document.getElementById('info_mois').innerHTML;
var var_annee = document.getElementById('info_annee').innerHTML;
var var_login=$('#select').find(":selected").text();
		jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'previous',
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


	});

$(document).on('click', '.cal_suivant', function(){
  var var_mois = document.getElementById('info_mois').innerHTML;
var var_annee = document.getElementById('info_annee').innerHTML;
    var var_login=$('#select').find(":selected").text();

    jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'next',
    mois: var_mois,
    annee:var_annee,
    login:var_login, // Les donnees que l'on souhaite envoyer au serveur au format JSON
}, 
success: function(data) {
$(".cal_frame").replaceWith(data);
},
error: function(jqXHR, textStatus, errorThrown) {
    // Une erreur s'est produite lors de la requete
}
});

});

  });

