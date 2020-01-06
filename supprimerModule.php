<?php
	include "PHP/DB/DB.inc.php";

	$db = DB::getInstance();
	$idModule = $db -> getModuleFromLibelle($_GET['Module'])[0] -> getIdModule();
	$db->deleteModule($idModule);
	
	header("Location: formSupprimerModule.php");
?>
