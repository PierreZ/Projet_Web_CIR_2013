$(document).ready(function() {
    var var_url_ajax=window.var_url+'Pages/admin_utilisateur/traitement_requete_ajax.php';
    $('#button_modifier').click(function () { // Afichage du dropdown modifier
      if ($('#dropbox_modifier').is(':hidden')) {
        $('#dropbox_modifier').slideDown('normal', function () {
                // animation si clic
              });
      } else {
        $('#dropbox_modifier').hide();
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

$(document).on('click','#Submit_ajout', function(e){

  var var_nouveau_statut=$('.nouveau_statut').find(":selected").text();
  var var_nouveau_nom=$('#nouveau_nom').val();

  var var_nouveau_mdp=$('#nouveau_mdp').val();

  var var_nouveau_solde=$('#nouveau_solde').val();

if(isNaN(var_nouveau_solde)){ // test de nombre
        alert('Vous devez entrer un nombre pour le solde!');
    return ;
    }

if ((var_nouveau_nom=='') ||(var_nouveau_mdp=='')||(var_nouveau_statut=='')) {alert('Un champ est vide !!');return ;};

     jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'ajout',
    nouveau_nom: var_nouveau_nom,
    nouveau_mdp:var_nouveau_mdp,
    nouveau_solde:var_nouveau_solde,
    nouveau_statut:var_nouveau_statut
  }, 
  success: function(data, textStatus, jqXHR) {
    location.reload() ; 
  },
  error: function(jqXHR, textStatus, errorThrown) {
  }
}); // Ajax

});//fin click

$(document).on('click','#Submit_modif', function(e){ 
  var var_suppr=$('input[name=suppr]').is(':checked');
  var var_utilisateur=$('#select').find(":selected").text();
  var var_modifier_statut=$('.modifier_statut').find(":selected").text();
  var var_modifier_nom=$('#modifier_nom').val();
  var var_modifier_mdp=$('#modifier_mdp').val();
  var var_modifier_solde=$('#modifier_solde').val();

alert

if ((var_utilisateur=='')) {alert('Un champ est vide !!');return ;};

 jQuery.ajax({
  type: 'POST', // Le type de ma requete
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'modif',
    suppr:var_suppr,
    utilisateur:var_utilisateur,
    modifier_nom: var_modifier_nom,
    modifier_mdp:var_modifier_mdp,
    modifier_solde:var_modifier_solde,
    modifier_statut:var_modifier_statut
  }, 
  success: function(data, textStatus, jqXHR) {
    location.reload() ; 
  },
  error: function(jqXHR, textStatus, errorThrown) {
  }
}); // Ajax


}); // Fin click

}); // fin fichier