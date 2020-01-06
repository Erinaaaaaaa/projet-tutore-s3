<?php

require_once 'DB/DB.inc.php';


// TODO: à transformer en fonction


$db = DB::getInstance();
if ($db == null) {
    echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
} else {
    try {
		$db->deleteEvenementsForSeance($_GET['id']);
		$db->deleteSemaphoresForSeance($_GET['id']);
		$db->deleteSeance($_GET['id']);
        echo '<meta http-equiv="refresh" content="0;URL=../listEvenement.php">';

    } catch (Exception $e) {
        echo "ça MARCHE PAS: " . $e->getMessage();

    }
}


$db->close();
