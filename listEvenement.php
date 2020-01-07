<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}

require_once "PHP/fonctions/func.evenement.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.users.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate( "consultation_evenement.twig" );


$login = $_SESSION['login'];
$user = getUtilisateur($login);

$tabEvenement = getEvenements();

$heureTt = 0;
$minTt = 0;
foreach ($tabEvenement as $value) {
    $duree = $value->getTemps();

    if ($duree == "" || $duree == null)
        $duree = "0:0";

    list($heure,$minute) = explode(':', $duree);

    $heureTt = $heureTt + intval($heure);
    $minTt = $minTt + intval($minute);
    if($minTt >= 60)
    {
        $minTt = $minTt - 60;
        $heureTt ++;
    }
}

$dureeTt = $heureTt.':'.$minTt;

echo $tpl->render( array("user"=>$user, "titre"=>"Gestion des evenements",
    "options"=>array(
        array(
            "nom"=>"Ajouter",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        )),
    "tabEven"=>$tabEvenement,
    "duree"=>$dureeTt
));