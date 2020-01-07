<?php
chdir("..");
require 'PHP/consultAffectation.php';
require_once 'PHP/DB/DB.inc.php';


// TODO: à transformer en fonction


    $db = DB::getInstance();
    if ($db == null) {
        echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
    } else {
        try {
            $db->deleteAffectation($_GET['id'], $_GET['idModule']);
            echo '<meta http-equiv="refresh" content="0;URL=../listAffectations.php">';

        } catch (Exception $e) {
            echo "ça MARCHE PAS: " . $e->getMessage();

        }
    }


    $db->close();
