
$(document).ready(function() {
    var var_url_ajax=window.var_url+'Pages/admin_agenda/traitement_requete_ajax.php';
    var menu_ul = $('.resume > ul'),
        menu_a  = $('.resume > li'),
        menu_solde=$('.solde_restant');
    var var_mois = document.getElementById('info_mois').innerHTML;
    var var_annee = document.getElementById('info_annee').innerHTML;
    menu_ul.hide();
    menu_solde.hide();


$('#select').change(function() {


var var_login=$('#select').find(":selected").text();
 menu_ul.hide();
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

menu_solde.show();


  });

 

 $(document).on('click','.resume > li', function(e){
      // menu_a.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('fast');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });


});


