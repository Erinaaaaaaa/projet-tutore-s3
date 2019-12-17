<?php 
	session_start();
	session_destroy();

    require_once("./PHP/Twig/lib/Twig/Autoloader.php");

    Twig_Autoloader::register();
    $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

    $tpl = $twig->loadTemplate( "templateConnexion.twig" );

    echo $tpl->render( array("Erreur"=>"Revenez vite ! ... UwU <3 "));