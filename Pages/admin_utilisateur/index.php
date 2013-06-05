<?php

session_start();
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

    <script type="text/javascript" src="../admin_agenda/jquery-2.0.0.js"></script><!-- Import de jQuery -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!-- Import de jQuery UI -->
    <script type="text/javascript" src="../../Setup/setup.js"></script>
    
</head>
	<body>

 	<?php
 		require("../../Setup/config.php");
		require("header.php");
		require '../admin_agenda/nav.php';

 		require("$root/Pages/admin_utilisateur/admin_utilisateur.php");
 	?>
 	<?php

 		require("$root/View/Template/footer.php");
 	?>

   <script src="bouton.js" type="text/javascript"></script>

	</body>
</html>