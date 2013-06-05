<?php

session_start();

if ($_SESSION['statut'] == 'admin'){
}else{
header("Refresh: 0; ../../../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Gestion des congés - ADMINISTRATEUR</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> <!-- Import du CSS de jQuery UI -->
    <link rel="stylesheet" href="../style_admin.css" /><!-- Import ddu CSS local -->
    <script type="text/javascript" src="../jquery-2.0.0.js"></script><!-- Import de jQuery -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!-- Import de jQuery UI -->
    <script type="text/javascript" src="../../../Setup/setup.js"></script>
        <script type="text/javascript" src="bouton.js"></script>

    <script type="text/javascript">
    $(function() { // Initialisation des objets de type dataPicker provenant de jQuery UI

        $( "#ajout_debut" ).datepicker();
        $( "#ajout_fin" ).datepicker();
        $( "#ajout_ferie" ).datepicker();
    });
    </script>
    
</head>
<body>
<br/>
   <?php
   require("../../../Setup/config.php"); // Import du fichier config
   require("../header.php");
   require('../nav.php')
    

   ?>

            <div class="container_conge"><!--Ajout du bouton ajouter-->
                <div id="button_conge" class="title">
                    <h6>Ajouter un congé commun</h6>

                </div>
                <div id="dropbox_conge">

                    <div class="contact-form">
                        <section class="title">
                            <h6>Entrez le début du congé</h6>
                        </section>
                        <section class="line">

                            <p>Date: <input type="text" id="ajout_debut" /></p>
                        </section>
                        <section class="title">
                            <h6>Entrez la fin du congé</h6>
                        </section>
                        <section class="line">
                            <p>Date: <input type="text" id="ajout_fin" /></p>
                        </section>
                        <input type="submit" id="Submit_conge" value="Submit">
                    </div>
                </div>
            </div>
                        <div class="container_ferie"><!--Ajout du bouton ajouter-->
                <div id="button_ferie" class="title">
                    <h6>Ajouter un jour férié</h6>

                </div>
                <div id="dropbox_ferie">

                    <div class="contact-form">
                        <section class="title">
                            <h6>Entrez le jour férié</h6>
                        </section>
                        <section class="line">

                            <p>Date: <input type="text" id="ajout_ferie" /></p>
                        </section>
                        
                        <input type="submit" id="Submit_ferie" value="Submit">
                    </div>
                </div>
            </div>

   <?php
   include_once("$root/View/Template/footer.php"); // Import du footer
   ?>



</body>
</html>