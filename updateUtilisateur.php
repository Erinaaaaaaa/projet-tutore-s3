<?php
session_start();

require_once "PHP/fonctions/func.users.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

// Vérification de session
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("inscription.twig");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $oldId  = $_POST['oldId'];
    $id     = $_POST['id'];
    $nom    = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp    = $_POST['mdp'];
    $role   = $_POST['role'];
    $groupe = $_POST['groupe'];

    $result = false;

    if (utilisateurExiste($_POST['oldId'])) {
        // Modification d'utilisateur
        $result = updateUtilisateur($oldId, $id, $nom, $prenom, $mdp, $role, $groupe);
    } else {
        // Création d'utilisateur
        $result = addUtilisateur($id, $nom, $prenom, $mdp, $role, $groupe);
    }

    if (!$result) {

        echo $tpl->render(array("id" => $id, "nom" => $nom,
            "prenom" => $prenom, "groupe" => $groupe, "role" => $role,
            "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));

    }
    else
        header("Location: listUtilisateurs.php");

} else {
    if(isset($_GET['id'])) {

        $utilisateur = getUtilisateur($_GET['id']);




        echo $tpl->render(array("id" => $_GET['id'], "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(), "groupe" => $utilisateur->getGroupe(),"role"=>$utilisateur->getRole(),
            "cree_le" => $utilisateur->getCreeLe(), "maj_me" => $utilisateur->getmajLe()));

    } else {
        echo $tpl->render(array());
    }
}

