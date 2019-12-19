<?php

session_start();
// session_destroy();

include "PHP/consultUtilisateur.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("tplLogin.twig");

// echo $tpl->render(array());

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isUtilisateurOk($_REQUEST['login'], $_REQUEST['mdp'])) {
        // session_start();
        $_SESSION['login'] = $_REQUEST['login'];
        // Redirection vers la page d'accueil
        echo "<meta http-equiv=\"refresh\" content=\"0;url=page_accueil.php\">";
    } else {
        if (empty($_REQUEST['login']) || empty($_REQUEST['mdp'])) {
            echo $tpl->render(array(
                "titre"=>"Accès au journal de bord",
                "Erreur" => "Entrez une valeur dans chaque rubrique"
            ));
        } else {
            echo $tpl->render(array(
                "titre"=>"Accès au journal de bord",
                "Erreur" => "Identifiant ou mot de passe incorrect."
            ));
        }
    }
} else {
    session_destroy();
    echo $tpl->render(array("titre"=>"Accès au journal de bord",
        "options"=>array(
            array(
                "nom"=>"google",
                "url"=>"https://google.fr/"
            )
        )));
}


