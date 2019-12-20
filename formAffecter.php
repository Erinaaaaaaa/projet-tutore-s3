<?php

// INCLUDES
require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.affectations.php";
require_once "PHP/Twig/lib/Twig/Autoloader.php" ;

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("affecter.twig");

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
}

$users = getAllUtilisateurs();

$profs = array();

/* @var $user Utilisateur */
foreach ($users as $user) {
    if (!(strpos($user->getRole(), "E")===false)) {
        $profs[] = $user;
    }
}

$modules = getAllModules();

echo $tpl->render(array(
    "titre"=>"Affecter un enseignant",
    "profs"=>$profs,
    "modules"=>$modules,
    "erreur"=>$message
));
