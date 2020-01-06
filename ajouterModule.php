<?php
	include "DB.inc.php";
	
	if (empty($_GET['module']) || empty($_GET['libelle']) || empty($_GET['droit'])) {
		header("Location: formAjouterModule.php");
	}
	else {
		$db = DB::getInstance();
		$couleur = str_replace('#', '' , $_GET['couleur']);
		$droit = implode($_GET['droit']);
		$db->insertModule($_GET['module'],$_GET['libelle'],$couleur,$droit);
	
		header("Location: formAjouterModule.php");
	}
?>
