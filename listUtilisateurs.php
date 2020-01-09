<?php

require_once "PHP/fonctions/func.users.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}
else {
	if (strpos(getUtilisateur($_SESSION['login'])->getRole(), "A") === false) {
		header("Location: accueil.php");
	}
}

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate( "consultation_utilisateurs.twig" );


$login = $_SESSION['login'];
$user = getUtilisateur($login);

$tabUser = getAllUtilisateurs();

echo $tpl->render( array("user"=>$user, "titre"=>"Gestion des utilisateurs",
    "options"=>array(
        array(
            "nom"=>"Ajouter",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        )),
    "tabUser"=>$tabUser
));
