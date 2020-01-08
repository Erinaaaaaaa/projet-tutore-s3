<?php
if (!isset($_SESSION)) session_start();

// INCLUDES

require_once ROOT_PATH."php/DB.php";
require_once ROOT_PATH."twig/lib/Twig/Autoloader.php";
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem(ROOT_PATH."tpl"));
$tpl = $twig->resolveTemplate("accueil.twig");


// VARIABLES
$login = $_SESSION['login'];
$user = DB::getInstance()->getUtilisateur($login);




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
            "url"=>"/param/"
        )
    ),
    "options"=>array(
        array(
            "nom", "Google",
            "url", "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
        )
    )
));