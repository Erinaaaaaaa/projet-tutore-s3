<?php

session_start();

include "PHP/fonctions/func.groupes.php";

$login = $_SESSION['login'];
$db = DB::getInstance();
$user = $db->getUtilisateur($login);

if ($db == null) {
    echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
}
else {
    try {


        $tabGroupe = $db->getGroupes();

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require_once("PHP/Twig/lib/Twig/Autoloader.php");

        Twig_Autoloader::register();
        $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

        $tpl = $twig->loadTemplate( "TemplateConsultGroupe.twig" );


        echo $tpl->render( array("user"=>$user, "titre"=>"Gestion des utilisateurs",
            "options"=>array(
                array(
                    "nom"=>"Ajouter",
                    "url"=>"https://hooooooooo.com/"
                ),
                array(
                    "nom"=>"Etat",
                    "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
                )),
            "tabGroupe"=>$tabGroupe,
        ));
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    $db->close();
}
