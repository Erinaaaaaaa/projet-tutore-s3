<?php
session_start();

require_once "PHP/DB/DB.inc.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

$db = DB::getInstance();

if(isset($_GET['id'])) {

    $utilisateur = $db->getUtilisateur($_GET['id'])[0];

    require_once("PHP/Twig/lib/Twig/Autoloader.php");

    Twig_Autoloader::register();
    $twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
    $tpl = $twig->loadTemplate("inscription.twig");


    echo $tpl->render(array("id" => $_GET['id'], "nom" => $utilisateur->getNom(),
        "prenom" => $utilisateur->getPrenom(), "groupe" => $utilisateur->getGroupe(),"role"=>$utilisateur->getRole(),
        "cree_le" => $utilisateur->getCreeLe(), "maj_me" => $utilisateur->getmajLe()));

}
