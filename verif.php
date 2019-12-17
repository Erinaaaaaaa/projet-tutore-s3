<?php

	include "fonc.verif.php";

	include "consultUtilisateur.php";

    if(isUtilisateurOk($_REQUEST['login'], $_REQUEST['mdp']))
    {
    	session_start();
    	$_SESSION['login'] = $_REQUEST['login'];
        echo "<meta http-equiv=\"refresh\" content=\"0;url=accueil.php\">";
    }
    else
    {
        require_once( "./Twig/lib/Twig/Autoloader.php" );

        Twig_Autoloader::register();
        $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

        $tpl = $twig->loadTemplate( "templateConnexion.tpl" );

        echo $tpl->render( array("Erreur"=>"Identifiant ou mot de passe incorrect."));

    }

    if((empty($_REQUEST['login']) && empty($_REQUEST['mdp'])))
    {
        echo 'Entrez une valeur dans chaque rubrique';
    }

?>