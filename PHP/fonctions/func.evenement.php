<?php

require_once "PHP/DB/DB.inc.php";

function getEvenementsPourSeance(int $id_seance) {
    try {
        return DB::getInstance()->getEvenement($id_seance);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return array();
    }
}

// TODO: type hints
function addEvenement($categorie,$description,$pj,$temps,$pour_le,$id_seance) {
    try {
        DB::getInstance()->insertEvenement($categorie,$description,$pj,$temps,$pour_le,$id_seance);
        return true;
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return false;
    }
}

function deleteEvenement(int $id) {
    try {
        DB::getInstance()->deleteEvenement($id);
        return true;
    } catch (PDOException $e) {
        echo "exception" . $e->getMessage();
        return false;
    }
}

