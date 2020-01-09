<?php

require_once 'DB/DB.inc.php';


// TODO: à transformer en fonction


$db = DB::getInstance();
if ($db == null) {
    echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
} else {
    try {
        $db->deleteEvenement($_GET['id']);
		if (isset($_GET['id_seance'])) {
			echo '<meta http-equiv="refresh" content="0;URL=../gererEvenements.php?id_seance=',$_GET['id_seance'],'">';
		}
		else {
        	echo '<meta http-equiv="refresh" content="0;URL=../gererEvenements.php">';
		}

    } catch (Exception $e) {
        echo "ça MARCHE PAS: " . $e->getMessage();

    }
}


$db->close();
