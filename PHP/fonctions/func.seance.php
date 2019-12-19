<?php

require_once "PHP/DB/DB.inc.php";

function getSeancesPourUtilisateur(string $utilisateur) {
    try {
        return DB::getInstance()->getSeance($utilisateur);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function addSeance(string $module, string $date_creation, string $type,
                   string $groupe, string $id_utilisateur) {
    try {
        DB::getInstance()->insertSeance($module, $date_creation, $type, $groupe, $id_utilisateur);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

function deleteSeance(int $id) {
    try {
        DB::getInstance()->deleteTypeSeance($id);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}