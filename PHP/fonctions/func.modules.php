<?php

require_once "PHP/DB/DB.inc.php";

/**
 * @return array Retourne une liste de tous les modules. Tableau vide en cas d'erreur.
 */
function getAllModules() {
    try {
        return DB::getInstance()->getModules();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

/**
 * @param string $id Identifiant du module
 * @return Module|null Retourne le module correspondant s'il existe, null sinon.
 */
function getModule(string $id) {
    $db = DB::getInstance();

    $module = $db->getModule($id);

    if (sizeof($module) == 1)
        return $module[1];
    else
        return null;
}

