<?php

require_once "PHP/DB/DB.inc.php";

function AddPiece_jointe(string $nom_fichier, string $chemin,  $id_evenement) {
    $db = DB::getInstance();

    try {
        return $db->addPiece_jointe($nom_fichier, $chemin, $id_evenement);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return false;
    }
}
