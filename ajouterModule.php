<?php
	include "PHP/DB/DB.inc.php";
	
	if (empty($_GET['module']) || empty($_GET['libelle']) || empty($_GET['droit'])) {
		header("Location: formConsultationModule.php");
	}
	else {
		$db = DB::getInstance();
		$couleur = str_replace('#', '' , $_GET['couleur']);
		$droit = implode($_GET['droit']);
		$db->addModule($_GET['module'],$_GET['libelle'],$couleur,$droit);
	
		header("Location: formConsultationModule.php");
	}
?>
