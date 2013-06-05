<?php

session_start();
require("../../Setup/config.php");
if ($_SESSION['statut'] == 'admin'){
}else{
header("Refresh: 0; ../../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Gestion des congés - ADMINISTRATEUR</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> <!-- Import du CSS de jQuery UI -->
    <link rel="stylesheet" href="style_admin.css" /><!-- Import ddu CSS local -->

    <script type="text/javascript" src="jquery-2.0.0.js"></script><!-- Import de jQuery -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!-- Import de jQuery UI -->
    <script type="text/javascript" src="../../Setup/setup.js"></script>
    <script type="text/javascript">
    $(function() { // Initialisation des objets de type dataPicker provenant de jQuery UI

        $( "#suppr_debut" ).datepicker();
        $( "#suppr_fin" ).datepicker();
        $( "#ajout_nouveau_debut" ).datepicker();
        $( "#ajout_nouveau_fin" ).datepicker();
    });
    </script>
    
</head>
<body>
<br/>
   <?php
   require("header.php");

   ?>


   <?php
   require("admin_agenda.php"); // Import de la page
   ?>


   <?php
   include_once("$root/View/Template/footer.php"); // Import du footer
   ?>

   <script src="wrapper_javascript.js" type="text/javascript"></script> <!-- Import des scipts du résumé (wrapper) -->
   <script src="bouton.js" type="text/javascript"></script> <!-- Import des scipts des boutons-->
   <script src="calendrier_javascript.js" type="text/javascript"></script>

</body>
</html>