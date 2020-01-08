<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}

// INCLUDES 
require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.affectations.php";
require_once "PHP/Twig/lib/Twig/Autoloader.php" ;

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("affecter.twig");

$login = $_SESSION['login'];
$userActuel = getUtilisateur($login);

$message = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (affectationExiste($_POST['Enseignant'], $_POST['Module'])) {
        $message = "L'affectation existe déjà.";
    } else {
        if (!insererAffectation($_POST['Enseignant'], $_POST['Module'])) {
            $message = "Impossible de créer l'affectation";
        } else {
            $message = "Affectation créée avec succès";
        }
    }
	header("Location: listAffectations.php?message=$message");
}

$users = getAllUtilisateurs();

$profs = array();

/* @var $user Utilisateur */
foreach ($users as $user) {
    if ((strpos($user->getRole(), "E") == 0) || (strpos($user->getRole(), "T") == 0)) {
        $profs[] = $user;
    }
}

$modules = getAllModules();

echo $tpl->render(array("user"=>$userActuel, "titre"=>"Gestion des affectations",
    "options"=>array(
        array(
            "nom"=>"Ajouter",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        )),
    "titre"=>"Affecter un enseignant",
    "profs"=>$profs,
    "modules"=>$modules,
    "erreur"=>$message
));
