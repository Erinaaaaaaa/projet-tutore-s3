<?php
session_start();

// VERIFICATION SESSION
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

// INCLUDES
require_once "PHP/fonctions/func.users.php";
require_once "PHP/Twig/lib/Twig/Autoloader.php" ;

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("accueil.twig");


// VARIABLES
$login = $_SESSION['login'];
$user = getUtilisateur($login);




echo $tpl->render(array("user"=>$user, "titre"=>"Accueil",
    "sections"=>array(
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
    ),
    "options"=>array(
        array(
            "nom", "Google",
            "url", "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
        )
    )
));