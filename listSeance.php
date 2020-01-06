<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}

require_once "PHP/fonctions/func.seance.php";
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.users.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate( "consultation_seance.twig" );

$db = DB::getInstance();

$login = $_SESSION['login'];
$user = getUtilisateur($login);

$tabSeance = getSeances();

$tabModules = $db->getModules();
$nomsModules = array();

foreach ($tabSeance as $seance) {
	foreach ($tabModules as $module) {
		if ($module->getIdModule() == $seance->getModule())
			$nomsModules[$seance->getModule()] = $module->getLibelle();
	}
}

$tabTypes = $db->getTypesSeance();
$types = array();

foreach ($tabSeance as $seance) {
	foreach ($tabTypes as $type) {
		if ($type->getIdTypeSeance() == $seance->getType())
			$types[$seance->getType()] = $type->getLibelle();
	}
}

$tabUtilisateurs = $db->getAllUtilisateur();
$nomsPrenomsProfs = array();

foreach ($tabSeance as $seance) {
	foreach ($tabUtilisateurs as $utilisateur) {
		if ($utilisateur->getIdUtilisateur() == $seance->getIdUtilisateur())
			$nomsPrenomsProfs[$seance->getIdUtilisateur()] = $utilisateur->getPrenom() . " " . $utilisateur->getNom();
	}
}


echo $tpl->render( array("user"=>$user, "titre"=>"Gestion des Seances",
    "options"=>array(
        array(
            "nom"=>"Ajouter",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        )),
    "tabSeance"=>$tabSeance,
	"tabNomsModules"=>$nomsModules,
	"tabTypesSeance"=>$types,
	"tabNomsPrenomsProfs"=>$nomsPrenomsProfs
));
