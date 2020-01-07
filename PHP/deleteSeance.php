<?php

chdir("..");

session_start();
require_once "PHP/fonctions/func.seance.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.groupes.php";


// TODO: à transformer en fonction


$db = DB::getInstance();
if ($db == null) {
    echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
} else {
	if(isset($_GET['id'])) {

		echo 'test2';
    	$seance = getSeanceIdSc($_GET['id'])[0];
    	echo $seance;
    	if( $seance->getIdUtilisateur() === $_SESSION['login']) {
    		try {
				$db->deleteEvenementsForSeance($_GET['id']);
				$db->deleteSemaphoresForSeance($_GET['id']);
				$db->deleteSeance($_GET['id']);
    		    echo '<meta http-equiv="refresh" content="0;URL=../listSeance.php">';
	
	    	} catch (Exception $e) {
	    		echo "ça MARCHE PAS: " . $e->getMessage();
		
    		}
		}
	}
	echo '<meta http-equiv="refresh" content="0;URL=../listSeance.php">';

}
$db->close();
