<section class="admin_agenda"> 

    <?php
    require 'nav.php';
    ?>
    <section class="admin_agenda_resume">
        <?php
        require("wrapper.php");
        $wrapper=new wrapper(''); // Création d'un objet de type wrapper
        ?>
    </section>

    <?php
    require("calendrier.php"); 
    $date = new DateTime('today');
    $calendrier=new calendrier($date->format('m'),$date->format('Y'),''); // Création d'un objet de type calendrier
    ?>



    <section class="admin_agenda_bouton ">

        <a href="<?php echo $url.'Pages/admin_agenda/config/';?>" id="admin_bouton_config"  >Configuration de base </a> <br/> <!-- Bouton de configuration-->
        <?php
        require 'select_utilisateur.php'; // Import de la sélection de l'utilisateur
        echo "<br/>";
        ?>




        <section class="admin_agenda_bouton_bottom"> 

            <div class="container_suppr"> 
                <div id="button_suppr" class="title">
                    <h6>Supprimer une période de congés</h6>
                </div>
                <div id="dropbox_suppr">

                    <div class="contact-form">
                        <section class="title">
                            <h6>Entrez le début du congé à supprimer</h6>
                        </section>
                        <section class="line">
                            <select class="suppr_debut_journee">
                                <?php
                                require('./select_journee.php');
                                ?>
                            </select> 
                            <p>Date: <input type="text" id="suppr_debut" /></p>
                        </section>
                        <section class="title">
                            <h6>Entrez la fin du congé à supprimer</h6>
                        </section>
                        <section class="line">
                            <select class="suppr_fin_journee">
                                <?php
                                require('./select_journee.php');
                                ?>
                            </select> 
                            <p>Date: <input type="text" id="suppr_fin" /></p>
                        </section>
                        <input type="submit" id="Submit_suppr" value="Submit">
                    </div>
                </div>
            </div>


            <div class="container_ajouter"><!--Ajout du bouton ajouter-->
                <div id="button_ajouter" class="title">
                    <h6>Ajouter une période de congés</h6>

                </div>
                <div id="dropbox_ajouter">

                    <div class="contact-form">
                        <section class="title">
                            <h6>Entrez le début du congé</h6>
                        </section>
                        <section class="line">
                            <select class="ajout_nouveau_debut_journee">
                                <?php
                                require('./select_journee.php');
                                ?>
                            </select> 
                            <p>Date: <input type="text" id="ajout_nouveau_debut" /></p>
                        </section>
                        <section class="title">
                            <h6>Entrez la fin du congé</h6>
                        </section>
                        <section class="line">
                            <select class="ajout_nouveau_fin_journee">
                                <?php
                                require('./select_journee.php');
                                ?>
                            </select> 
                            <p>Date: <input type="text" id="ajout_nouveau_fin" /></p>
                        </section>
                        <input type="submit" id="Submit_ajout" value="Submit">
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>



