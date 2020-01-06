<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}

require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.affectations.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate( "consultation_affectations.twig" );


$login = $_SESSION['login'];
$user = getUtilisateur($login);

$tabModules = getAllModules();
$allAffectations = getAllAffectation();

$tabLibModules = array();

foreach ($allAffectations as $affectation) {
	foreach ($tabModules as $module) {
		if ($module->getIdModule() == $affectation->getIdModule())
			$tabLibModules[$affectation->getIdModule()] = $module->getLibelle();
	}
}

$message = "";
if (isset($_GET['message']))
	$message = $_GET['message'];

echo $tpl->render( array("user"=>$user, "titre"=>"Gestion des affectations",
    "options"=>array(
        array(
            "nom"=>"Ajouter",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        )),
    "tabAffectations"=>$allAffectations,
	"tabLibModules"=>$tabLibModules,
	"message"=>$message
));
