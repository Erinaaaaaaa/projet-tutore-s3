<?php

	include "PHP/consultUtilisateur.php";

require_once("./PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

$tpl = $twig->loadTemplate( "templateConnexion.tpl" );

    if(isUtilisateurOk($_REQUEST['login'], $_REQUEST['mdp']))
    {
    	session_start();
    	$_SESSION['login'] = $_REQUEST['login'];
        echo "<meta http-equiv=\"refresh\" content=\"0;url=accueil.php\">";
    }
    else
    {
        if(empty($_REQUEST['login']) || empty($_REQUEST['mdp']))
        {
            echo $tpl->render( array("Erreur"=>"Entrez une valeur dans chaque rubrique"));
        }
        else {
            echo $tpl->render(array("Erreur" => "Identifiant ou mot de passe incorrect."));
        }
    }



