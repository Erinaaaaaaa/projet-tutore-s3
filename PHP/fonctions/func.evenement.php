<?php

require_once "PHP/DB/DB.inc.php";

function evenementExiste(string $id) {
    $db = DB::getInstance();

    try {
        return $db->evenementExiste($id);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return false;
    }
}


function getEvenements(){
    try {
        return DB::getInstance()->getEvenements();
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return array();
    }
}

function getEvenement(string $id) {
    if (!evenementExiste($id)) {
        return null;
    }

    try {
        return DB::getInstance()->getEvenement($id);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return null;
    }
}


function getEvenementsPourSeance(int $id_seance) {
    try {
        return DB::getInstance()->getEvenementsForSeance($id_seance);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return array();
    }
}

// TODO: type hints
function addEvenement($categorie,$description,$pj,$temps,$pour_le,$id_seance) {
    try {
        DB::getInstance()->addEvenement($categorie,$description,$pj,$temps,$pour_le,$id_seance);
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

function updateEvenement($id,$categorie,$description,$temps,$pour_le){
    try {
        $result = DB::getInstance()->updateEvenement($id,$categorie,$description,$temps,$pour_le);
        if ($result == 0) {
            echo "oh no";
            return false;
        }
        return true;
    } catch (PDOException $e) {
        echo "exception" . $e->getMessage();
        return false;
    }
}

