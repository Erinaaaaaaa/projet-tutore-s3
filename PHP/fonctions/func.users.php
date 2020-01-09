<?php

require_once "PHP/DB/DB.inc.php";

/**
 * @param string $id L'identifiant de l'utilisateur
 * @return bool true si l'utilisateur existe, false sinon
 */
function utilisateurExiste(string $id) {
    $db = DB::getInstance();

    try {
        return $db->utilisateurExiste($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

/**
 * @param string $id L'identifiant de l'utilisateur
 * @return Utilisateur|null Un utilisateur si il existe, null sinon.
 */
function getUtilisateur(string $id) {
    if (!utilisateurExiste($id)) {
        return null;
    }

    try {
        return DB::getInstance()->getUtilisateur($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return null;
    }
}

/**
 * @return array Retourne un tableau contenant tous les utilisateurs.
 * Le tableau est vide en cas d'erreur de connexion à la base de données.
 */
function getAllUtilisateurs() {
    $db = DB::getInstance();

    try {
        return $db->getUtilisateurs();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

/**
 * @param string $id     L'identifiant de l'utilisateur
 * @param string $nom    Le nom de l'utilisateur
 * @param string $prenom Le prénom de l'utilisateur
 * @param string $mdp    Le mot de passe de l'utilisateur (non haché)
 * @param string $role   Le ou les rôles de l'utilisateur
 * @param string $groupe Le groupe de l'utilisateur
 * @return bool          true si l'utilisateur a été créé, false sinon
 */
function addUtilisateur(string $id, string $nom, string $prenom,
                        string $mdp, string $role, string $groupe) {
    $db = DB::getInstance();

    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    try {
        $db->addUtilisateur($id, $nom, $prenom, $mdp, $role, $groupe);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }

    return true;
}

/**
 * @param string $oldId   Identifiant courant de l'utilisateur
 * @param string $id      Nouvel identifiant de l'utilisateur
 * @param string $nom     Nouveau nom de l'utilisateur
 * @param string $prenom  Nouveau prénom de l'utilisateur
 * @return bool           true si utilisateur mis à jour, false sinon
 */
function updateUtilisateur(string $oldId, string $id, string $nom,
                           string $prenom, string $mdp, string $role, string $groupe) {
    $db = DB::getInstance();
    $user = $db->getUtilisateur($oldId);

    if ($user == null) {
        return false;
    }

    if ($mdp == null) {
        $mdp = $user->getMdp();
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }
    try {
        $db->updateUtilisateur($oldId, $id, $nom, $prenom, $mdp, $role, $groupe);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }

    return true;
}

/**
 * @param string $id      Identifiant de l'utilisateur
 * @param string $nom     Nouveau nom de l'utilisateur
 * @param string $prenom  Nouveau prénom de l'utilisateur
 * @return bool           true si utilisateur mis à jour, false sinon
 */
function updateProfil(string $id, string $nom, string $prenom) {
    $db = DB::getInstance();
    $user = $db->getUtilisateur($id);

    if ($user == null) {
        return false;
        echo 'user null';
    }

    try {
        $db->updateProfil($id, $nom, $prenom);
    } catch (PDOException $e) {
        echo "exception".$e->getMessage();
        return false;
    }
    return true;
}

/**
 * @param string $oldId   Identifiant courant de l'utilisateur
 * @param string $id      Nouvel identifiant de l'utilisateur
 * @param string $nom     Nouveau nom de l'utilisateur
 * @param string $prenom  Nouveau prénom de l'utilisateur
 * @param string $mdp     Nouveau mot de passe (non haché) de l'utilisateur
 * @param string $role    Nouveau(x) rôle(s) de l'utilisateur
 * @param string $groupe  Nouveau groupe de l'utilisateur
 * @return bool           true si utilisateur mis à jour, false sinon
 */
function GenererMDP(string $id, string $mdp) {
    $db = DB::getInstance();
    $user = $db->getUtilisateur($id);

    if ($user == null) {
        return false;
    }

    if ($mdp == null) {
        $mdp = $user->getMdp();
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }
    try {
        $db->genererMdpUtilisateur($id, $mdp);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }

    return true;
}

/**
 * @param string $id Identifiant de l'utilisateur à supprimer
 * @return bool true is supprimé avec succès, false sinon
 */
function deleteUtilisateur(string $id) {
    $db = DB::getInstance();

    try {
        $db->deleteUtilisateur($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }

    return true;
}