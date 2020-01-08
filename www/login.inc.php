<?php

if (!isset($_SESSION)) session_start();

require_once ROOT_PATH."php/DB.php";
require_once ROOT_PATH."twig/lib/Twig/Autoloader.php";

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem(ROOT_PATH."tpl"));
$tpl = $twig->resolveTemplate("login.twig");

$db = DB::getInstance();

// CONSTANTES

$titre = "Accès au journal de bord";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $login = $_REQUEST['login'];
    $mdp   = $_REQUEST['mdp'];

    $user = $db->getUtilisateur($login);

    if (isset($user) && $user->mdpEstValide($mdp)) {
        $_SESSION['login'] = $login;
        // Redirection vers la page d'accueil
        header("Location: /index.php");
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
