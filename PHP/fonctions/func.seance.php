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
        $db = DB::getInstance();
		$db->insertSeance($module, $date_creation, $type, $groupe, $id_utilisateur);
		$utilisateurs = $db->getAllUtilisateur();
		foreach ($utilisateurs as $utilisateur) {
			$db->insertSemaphore($db->getIdDerniereSeance()[0][0], $utilisateur->getIdUtilisateur());
		}
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

function deleteSeance(int $id) {
    try {
        $db = DB::getInstance();
		$db->deleteTypeSeance($id);
		$db->deleteSemaphore($id);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}
