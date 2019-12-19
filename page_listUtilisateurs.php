<?php

session_start();

include "PHP/DB/DB.inc.php";

$login = $_SESSION['login'];
$db = DB::getInstance();
$user = $db->getUtilisateur($login)[0];

if ($db == null) {
    echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
}
else {
    try {


        $tabUser = $db->getAllUtilisateur();

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require_once("PHP/Twig/lib/Twig/Autoloader.php");

        Twig_Autoloader::register();
        $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

        $tpl = $twig->loadTemplate( "TemplateConsultUtilisateur.twig" );


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
            "tabUser"=>$tabUser
        ));
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    $db->close();
}
