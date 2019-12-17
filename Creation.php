<?php

require 'consultUtilisateur.php';
require_once 'DB/DB.inc.php';

    $db = DB::getInstance();
    if ($db == null) {
        echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
    }
    else {
    try {

        $db->insertUtilisateur($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['mdp'], $_REQUEST['roles'], $_REQUEST['groupe'], $_REQUEST['crea'], $_REQUEST['maj']);

    }

    catch (Exception $e) {
        //echo $e->getMessage();
        require_once( "../Twig-1.35.3/lib/Twig/Autoloader.php" );

        Twig_Autoloader::register();
        $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));

        $tpl = $twig->loadTemplate( "inscription.tpl" );

        echo $tpl->render( array("ErreurInscription"=>"ça MARCHE PAS "));

    }
    }
    $db->close();

?>
