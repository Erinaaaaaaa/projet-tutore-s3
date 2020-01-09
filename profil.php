<?php

session_start();

require_once "PHP/fonctions/func.users.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("profil.twig");
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id     = $_SESSION['login'];

    $user = getUtilisateur($id);
    $nom    = $_POST['nom'];
    
    $prenom = $_POST['prenom'];
    

    $result = false;

    $result = updateProfil($id, $nom, $prenom); 


    
    if ($result==true) {
        header("Location: parametrage.php");
    }
    else{
        echo $tpl->render(array("id" => $id, "nom" => $nom,
            "prenom" => $prenom, "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));
    }

} else {
    if (isset($_SESSION['login'])) {

        $id = $_SESSION['login'];

        $user = getUtilisateur($id);
        $nom  = $user->getNom();
    
        $prenom = $user->getPrenom();
    

        $result = false;
        echo $tpl->render(array("id" => $id, "nom" => $nom,
            "prenom" => $prenom));
    }
}