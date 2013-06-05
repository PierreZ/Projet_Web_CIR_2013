<section class="lateral">

    <div class="container_ajouter"><!--Ajout du bouton ajouter-->
        <div id="button_ajouter" class="title">
            <h6>Ajouter un utilisateur</h6>

        </div>
        <div id="dropbox_ajouter">

            <div class="contact-form">
                <section class="title">
                    <h6>Nom de l'utilisateur</h6>
                </section>
                <section class="line">
                    <p><input type="text" id="nouveau_nom" /></p>
                </section>
                <section class="title">
                    <h6>Catégorie d'utilisateur</h6>
                </section>
                <section class="line">
                    <select class="nouveau_statut">
                       <?php
                       require('select_compte.php');
                       ?> 
                   </select>   
               </section>
               <section class="title">
                <h6>Nouveau Mot de passe</h6>
            </section>
            <section class="line">
                <p><input type="password" id="nouveau_mdp" /></p>
            </section>

            <section class="title">
                <h6>Nouveau Solde</h6>
            </section>
            <section class="line">
                <p><input type="number" id="nouveau_solde" /></p>
            </section>

            <input type="submit" id="Submit_ajout" value="Submit">
        </div>
    </div>
</div>

<div class="container_modifier"><!--Ajout du bouton modifier-->
    <div id="button_modifier" class="title">
        <h6>modifier un utilisateur</h6>

    </div>
    <div id="dropbox_modifier">

        <div class="contact-form">
            <section class="title">
                <h6>Choisissez un utilisateur</h6>
            </section>
            <?php
            require('../admin_agenda/select_utilisateur.php');
            ?>
            <input type="checkbox" name="suppr">Supprimer<br/>(vider congé d'abord avant suppr)
            <section class="title">
                <h6>Modification du Nom de l'utilisateur</h6>
            </section>
            <section class="line">
                <p><input type="text" id="modifier_nom" /></p>
            </section>
                            <section class="title">
                    <h6>modification catégorie d'utilisateur</h6>
                </section>
                <section class="line">
                    <select class="modifier_statut">
                       <?php
                       require('select_compte.php');
                       ?> 
                   </select>   
            <section class="title">
                <h6>Modification mot de passe</h6>
            </section>
            <section class="line">
                <p><input type="text" id="modifier_mdp" /></p>
            </section>

            <section class="title">
                <h6>modification de  Solde</h6>
            </section>
            <section class="line">
                <p><input type="text" id="modifier_solde" /></p>
            </section>

            <input type="submit" id="Submit_modif" value="Submit">
        </div>
    </div>
</div>

</section>

<div id="scroll">
    <table class='tableau'>
       <tr>
          <th>Login</th>
          <th>Type de compte</th>
          <th>Mot de passe</th>
          <th>Solde</th>
      </tr>

      <?php
      require_once 'tableau_utilisateur.php';
      ?>

  </table>
</div>




<!-- Bouton avec pop up modif utilisateur -->




