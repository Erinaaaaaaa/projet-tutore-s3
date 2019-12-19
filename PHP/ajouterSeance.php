<?php
include "DB/DB.inc.php";

	$db = DB::getInstance();
	// TODO: récupérer l'ID du module
	$db->insertSeance($_GET['Module'],$_GET['Date'],$_GET['Type'],$_GET['Groupe'],'prof');
?>
