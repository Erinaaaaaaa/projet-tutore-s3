<?php
	include "consultUtilisateur.php";

    if(isUtilisateurOk($_REQUEST['login'], $_REQUEST['mdp']))
    {
        echo "<meta http-equiv=\"refresh\" content=\"0;url=accueil.php\">";
    }
    else
    {
        require_once( "../Twig-1.35.3/lib/Twig/Autoloader.php" );

        Twig_Autoloader::register();
        $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

        $tpl = $twig->loadTemplate( "templateConnexion.tpl" );

        echo $tpl->render( array("Erreur"=>"Identifiant ou mot de passe incorrect."));

    }

    if((empty($_REQUEST['login']) && empty($_REQUEST['mdp'])))
    {
        echo 'Entrez une valeur dans chaque rubrique';
    }




/*
if(IS_LOGIN_OK($_REQUEST['login']) && IS_PWD_OK( $_REQUEST['login'], $_REQUEST['mdp']))
{
    echo "<meta http-equiv=\"refresh\" content=\"0;url=accueil.php\">";
}

if((empty($_REQUEST['login']) && empty($_REQUEST['mdp'])))
{
    echo 'Entrez une valeur dans chaque rubrique';
}
else{
    if(!IS_LOGIN_OK($_REQUEST['login']) || !IS_PWD_OK($_REQUEST['login'],$_REQUEST['mdp']))
    {
        if(!IS_LOGIN_OK($_REQUEST['login']) && !empty($_REQUEST['login']))
        {
            echo 'Login erroné';
        }
        else if(IS_LOGIN_OK($_REQUEST['login']) && !IS_PWD_OK($_REQUEST['login'], $_REQUEST['mdp']) && empty($_REQUEST['mdp']))
        {
            echo 'Veuillez entrer un mot de passe';
        }

        else if((IS_LOGIN_OK($_REQUEST['login'] && !IS_PWD_OK($_REQUEST['login'], $_REQUEST['mdp'])) && !empty($_REQUEST['mdp'])))
        {
            echo 'Mot de passe incorrect';
        }

    }
}*/


?>