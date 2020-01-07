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

    	$evenement = getEvenement($_GET['id'])[0];
    	$idseance = $evenement->getIdSeance();
    	$seance->getSeance($idseance)[0];
    	echo $idseance;
    	echo $seance;
    	if( $seance->getIdSeance()->get === $_SESSION['login']) {
    		
    		try {
        		$db->deleteEvenement($_GET['id']);
        		echo '<meta http-equiv="refresh" content="0;URL=../listEvenement.php">';

    		} catch (Exception $e) {
        		echo "ça MARCHE PAS: " . $e->getMessage();

    		}
		}
	}
	echo 'test';
	echo '<meta http-equiv="refresh" content="0;URL=../listEvenement.php">';

}
$db->close();


	