<?php

// TODO: voir si faut la garder

require 'PHP/consultUtilisateur.php';
require_once 'PHP/DB/DB.inc.php';

require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));

$tpl = $twig->loadTemplate("inscription.twig");

/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = DB::getInstance();
    if ($db == null) {
        echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
    } else {
        try {

            $hash = password_hash($_REQUEST['mdp'], PASSWORD_DEFAULT);
            $db->insertUtilisateur($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['prenom'], $hash, $_REQUEST['roles'], $_REQUEST['groupe'], $_REQUEST['crea'], $_REQUEST['maj']);

        } catch (Exception $e) {
            echo $tpl->render(array("ErreurInscription" => "ça MARCHE PAS: " . $e->getMessage()));

        }
    }


    $db->close();
} else {

    echo $tpl->render(array());

}*/

?>
