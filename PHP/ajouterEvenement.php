<?php
include "DB/DB.inc.php";

	if (empty($_GET['Description'])) {
		header ('Location: formAjouterEvenement.php?erreur=Description Obligatoire');
	}
	else {
		$db = DB::getInstance();

		$nomsFichiers = "";
		$tabFichiers = array();

		if (isset($_GET['file'][0]))
			array_push($tabFichiers, $_GET['file'][0]);
		if (isset($_GET['file'][1]))
			array_push($tabFichiers, $_GET['file'][1]);
		if (isset($_GET['file'][2]))
			array_push($tabFichiers, $_GET['file'][2]);

			if ($_GET['file'][0] != null) {
				foreach ($tabFichiers as $file) {
					$nomsFichiers = $nomsFichiers . "documents_" . date("Y-m-d") . "/" . $file . ":";
				}
			}

		$db->insertEvenement($_GET['Categorie'],$_GET['Description'],$nomsFichiers,$_GET['Temps'],$_GET['Date'], '3');
	}
?>
