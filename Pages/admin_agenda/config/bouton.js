$(document).ready(function () {
    var var_url_ajax=window.var_url+'Pages/admin_agenda/config/traitement_requete_ajax.php';

$('#button_conge').click(function () { // Afichage du dropdown conge
      if ($('#dropbox_conge').is(':hidden')) {
        $('#dropbox_conge').slideDown('normal', function () {
                // animation si clic
              });
      } else {
        $('#dropbox_conge').hide();
      }

    });

$('#button_ferie').click(function () { // Afichage du dropdown ferie
      if ($('#dropbox_ferie').is(':hidden')) {
        $('#dropbox_ferie').slideDown('normal', function () {
                // animation si clic
              });
      } else {
        $('#dropbox_ferie').hide();
      }

    });


$(document).on('click','#Submit_ferie', function(e){

  var var_conge=$('#ajout_ferie').val();
jQuery.ajax({ // Premiere requete ajax d'insertion
          type: 'POST',
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'ajout_ferie',
conge:var_conge

     }, 
  success: function(data, textStatus, jqXHR) {
            $('#dropbox_ferie').hide();

 },
  error: function(jqXHR, textStatus, errorThrown) {
  }
});
}); //fermeture click


$(document).on('click','#Submit_conge', function(e){

  var var_debut_conge=$('#ajout_debut').val();
    var var_fin_conge=$('#ajout_fin').val();
jQuery.ajax({ // Premiere requete ajax d'insertion
          type: 'POST',
  url: var_url_ajax, // L'url vers laquelle la requete sera envoyee
  data: {
    action: 'ajout_conge',
debut:var_debut_conge,
fin:var_fin_conge

     }, 
  success: function(data, textStatus, jqXHR) {
            $('#dropbox_conge').hide();

 },
  error: function(jqXHR, textStatus, errorThrown) {
  }
});
}); //fermeture click


});// Fin du js