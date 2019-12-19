<?php
	include "DB/DB.inc.php";

	$db = DB::getInstance();
	$affectations = $db->getAffectation($_GET['Enseignant']);
	$existeDeja = false;

	foreach ($affectations as $affectation) {
		if ($affectation->getIdModule()==$_GET['Module'])
			$existeDeja = true;
	}

	if ($existeDeja) {
		header ('Location: page_formAffecter.php?erreur=L\'affectation existe déjà');
	}
	else {
		$db->insertAffectation($_GET['Enseignant'], $_GET['Module']);
	}
?>
