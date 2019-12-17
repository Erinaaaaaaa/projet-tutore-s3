<?php
session_start();

	if (!isset($_SESSION['login']))
	{
		header("Location: erreurSess.php");
	}

    require_once("../Twig-1.35.3/lib/Twig/Autoloader.php");

    Twig_Autoloader::register();
    $twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));

    $tpl = $twig->loadTemplate("accueil.twig");

    echo $tpl->render(array());


    if(isset($_POST['choix']) )
    {
        if($_POST['choix']=='saisie')
        {
            header('location:prototype.php');
        }
        else if ($_POST['choix'] == 'etat') {header('location:visualisation.php');}
    }

?>
