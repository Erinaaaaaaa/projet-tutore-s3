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

function getCreateur(int $id_seance) {
    try {
        return DB::getInstance()->getCreateur($id_seance);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getSeanceIdSc($id_seance) {
    try {
        return DB::getInstance()->getSeanceIdSc($id_seance);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

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
