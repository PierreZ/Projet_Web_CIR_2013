<?php

session_start();
if ($_SESSION['statut'] == 'admin'){
	header("Refresh: 2; admin_agenda/index.php");
}else{
header("Refresh: 0; ../index.php");
}
?>