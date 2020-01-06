<?php

require_once "PHP/DB/DB.inc.php";

/**
 * @param string $id Identifiant de l'utilisateur
 * @return array La liste des affectations. Le tableau est vide en cas d'erreur de connexion.
 */
function getAffectationsPourEnseignant(string $id) {
    try {
        return DB::getInstance()->getAffectation($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

/**
 * @return array Retourne un tableau contenant toutes les affectations.
 * Le tableau est vide en cas d'erreur de connexion à la base de données.
 */
function getAllAffectation() {
    $db = DB::getInstance();

    try {
        return $db->getAffectations();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function affectationExiste(string $id, string $module) {
    $db = DB::getInstance();

    $affectations = getAffectationsPourEnseignant($id);

    foreach ($affectations as $affectation) {
        if ($affectation->getIdModule() == $module)
            return true;
    }

    return false;
}

function insererAffectation(string $id, string $module) {
    try {
        DB::getInstance()->addAffectation($id, $module);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}
