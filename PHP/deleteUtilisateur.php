<?php
chdir(".."); 
require 'PHP/consultUtilisateur.php';
require_once 'PHP/DB/DB.inc.php';


// TODO: à transformer en fonction


    $db = DB::getInstance();
    if ($db == null) {
        echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
    } else {
        try {
            $db->deleteSemaphoresForUtilisateur($_GET['id']);
            $db->deleteUtilisateur($_GET['id']);
            echo '<meta http-equiv="refresh" content="0;URL=../listUtilisateurs.php">';

        } catch (Exception $e) {
            echo "ça MARCHE PAS: " . $e->getMessage();

        }
    }


    $db->close();


