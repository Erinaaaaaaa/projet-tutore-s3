<?php

require_once "func.users.php";

/**
 * @param string $id Identifiant de l'utilisateur
 * @param string $password Mot de passe de l'utilisateur
 * @return bool true si authentification avec succès, false sinon
 */
function isLoginOk(string $id, string $password) {
    if (!utilisateurExiste($id)) {
        return false;
    }

    $user = getUtilisateur($id);

    return password_verify($password, $user->getMdp());
}