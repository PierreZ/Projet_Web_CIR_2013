<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Gestion des congés - LOGIN</title>
        <link rel="stylesheet" href="./Pages/Login/style_login.css" />
        <meta >
    </head>
    
    <body>    
	 	<?php
	 		require("./Setup/config.php"); // Fichier config
	 			 		
 		?>
			<section class="logo_isen">
				<img src="./View/img/logo-ISEN.jpg"> 
			</section>
 		<section class="log">


    <form method="post" action="Action/connexion.php">
                <p>
                    <label for="Login">Votre login</label> : <input type="text" name="login" id="login" />
                        <br/><br/>
                        <label for="Password">Votre mot de passe</label> : <input type="password" name="password" id="password" />
                        <br/><br/>
                </p>
            <div id="lower">
<input type="submit" name="submit" value="Envoyer" />
            </div>
        </form>
		
    	</section>
     
     	<?php
	 		include_once("$root/View/Template/footer.php");
	 	?> 
	 		
		
    </body>
</html>