<?php

session_start();

require_once "PHP/fonctions/func.login.php";
require_once "PHP/Twig/lib/Twig/Autoloader.php";

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("tplLogin.twig");

// CONSTANTES

$titre = "Accès au journal de bord";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $login = $_REQUEST['login'];
    $mdp   = $_REQUEST['mdp'];

    if (isLoginOk($login, $mdp)) {
        $_SESSION['login'] = $login;
        // Redirection vers la page d'accueil
        header("Location: accueil.php");
        die();
    } else {
        if (empty($login) || empty($mdp)) {
            echo $tpl->render(array(
                "titre"=>$titre,
                "Erreur" => "Entrez une valeur dans chaque rubrique"
            ));
        } else {
            echo $tpl->render(array(
                "titre"=>$titre,
                "Erreur" => "Identifiant ou mot de passe incorrect."
            ));
        }
    }
} else {
    session_destroy();
    echo $tpl->render(array("titre"=>$titre,
        "options"=>array(
            array(
                "nom"=>"google",
                "url"=>"https://google.fr/"
            )
        )));
}
