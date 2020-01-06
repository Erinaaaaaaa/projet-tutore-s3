<?php

require_once "PHP/DB/DB.inc.php";

/**
 * @return array Retourne la liste de groupes.
 *  Le tableau est vide en cas d'erreur de bases de données.
 */
function getGroupes() {
    $db = DB::getInstance();

    try {
        return $db->getGroupes();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getGroupe(string $id) {
    $db = DB::getInstance();

    try {
        $tmp = $db->getGroupe($id);
        if (sizeof($tmp) == 0) return null;
        else return $tmp[0];
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return null;
    }
}

function getGroupePere(string $id) {
    $db = DB::getInstance();

    try {
        $tmp = $db->getGroupePere($id);
        if (sizeof($tmp) == 0) return null;
        else return $tmp[0];
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return null;
    }
}

function insertGroupe(string $groupe, string $pere) {
    $db = DB::getInstance();

    if ($db->groupeExiste($groupe)) {
        return false;
    }

    try {
        $db->addGroupe($groupe, $pere);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        echo $e->getMessage() . "<br>" . $e->getTraceAsString();
        return false;
    }

    return true;
}

function updateGroupe(string $groupe, string $pere, string $oldNomGroupe)
{
    $db = DB::getInstance();

    try {
        $db->updateGroupe($groupe, $pere, $oldNomGroupe);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        echo $e->getMessage() . "<br>" . $e->getTraceAsString();
        return false;
    }

    return true;
}