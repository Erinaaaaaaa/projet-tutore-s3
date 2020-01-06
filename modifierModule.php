<?php
	include "DB.inc.php";
	
	if (empty($_GET['module']) || empty($_GET['libelle']) || empty($_GET['droit'])) {
		header("Location: debutModifierModule.php");
	}
	else {
		$db = DB::getInstance();
		$couleur = substr($_GET['couleur'], 1);
		$droit = implode($_GET['droit']);
		$module = $db -> getModule($_GET['oldModule'])[0];
		
		if ($_GET['libelle'] != $module -> getLibelle())
			$db->updateModule(date("Y-m-d"),"libelle",$_GET['libelle'],$module->getIdModule());
		if ($_GET['couleur'] != $module -> getCouleur())
			$db->updateModule(date("Y-m-d"),"couleur",$couleur,$module->getIdModule());

		if ($_GET['droit'] != $module -> getDroit())
			$db->updateModule(date("Y-m-d"),"droit",$droit,$module->getIdModule());

		if ($_GET['module'] != $module -> getIdModule())
			$db->updateModule(date("Y-m-d"),"id_module",$_GET['module'],$module->getIdModule());

	
		header("Location: debutModifierModule.php");
	}
?>
