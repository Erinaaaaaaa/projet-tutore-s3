<?php

require_once "PHP/DB/DB.inc.php";

function seanceExiste(string $id) {
    $db = DB::getInstance();

    try {
        return $db->seanceExiste($id);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return false;
    }
}

function getSeances() {
    try {
        return DB::getInstance()->getSeances();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getSemaphoreSeUs($id_seance, $id_user) {
    try {
        return DB::getInstance()->getSemaphoreSeUs($id_seance, $id_user);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function updateSemaphore($id_seance, $id_user, $etat) {
    try {
        DB::getInstance()->updateSemaphore($id_seance, $id_user, $etat);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getSeanceIdSc($id_seance) {
    try {
        return DB::getInstance()->getSeance($id_seance);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getSeancesPourUtilisateur(string $utilisateur) {
    try {
        return DB::getInstance()->getSeancesForUtilisateur($utilisateur);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function addSeance(string $module, string $date_creation, string $type,
                   string $groupe, string $id_utilisateur) {
    try {
        $db = DB::getInstance();
		$db->addSeance($module, $date_creation, $type, $groupe, $id_utilisateur);
		$utilisateurs = $db->getUtilisateurs();
		foreach ($utilisateurs as $utilisateur) {
			$db->addSemaphore($db->getDerniereSeance()->getIdSeance(), $utilisateur->getIdUtilisateur());
		}
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

function updateSeance($id,$idModule,$idType,$goupe){
    try {
        $result = DB::getInstance()->updateSeance($id,$idModule,$idType,$goupe);
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
