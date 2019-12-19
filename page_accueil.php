<?php
session_start();

require_once "PHP/DB/DB.inc.php";

if (!isset($_SESSION['login'])) {
    header("Location: erreurSess.php");
}

$login = $_SESSION['login'];
$db = DB::getInstance();
$user = $db->getUtilisateur($login)[0];

require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));

$tpl = $twig->loadTemplate("accueil.twig");

echo $tpl->render(array("user"=>$user, "titre"=>"Accueil",
    "options"=>array(
        array(
            "nom"=>"Visualiser",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        ),
        array(
            "nom"=>"Parametrage",
            "url"=>"page_listUtilisateurs.php"
        )
    )));

?>
