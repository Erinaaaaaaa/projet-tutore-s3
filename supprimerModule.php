<?php
	include "DB.inc.php";

	$db = DB::getInstance();
	$idModule = $db -> getIdModule($_GET['Module'])[0] -> getIdModule();
	$db->deleteModule($idModule);
	
	header("Location: formSupprimerModule.php");
?>