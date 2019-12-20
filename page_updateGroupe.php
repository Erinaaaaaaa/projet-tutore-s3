<?php
session_start();

require_once "PHP/fonctions/func.users.php";
include "PHP/fonctions/func.groupes.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
    $twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
    $tpl = $twig->loadTemplate("groupe.twig");

if (!isset($_SESSION['login'])) {
    header("Location: page_index.php");
}


/* if(isset($_GET['id'])) {

    $utilisateur = $db->getUtilisateur($_GET['id']);

    
    $groupe = getGroupe($_GET['id']);
    
    

    echo $tpl->render(array("gp" => $groupe, "allGroupes" => getGroupes()));

}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $groupe       = $_POST['nomGroupe'];
    $groupeP      = $_POST['groupePere'];
    $oldNomGroupe = $_POST['oldNomGroupe'];
    

    $result = false;

    $result = updateGroupe($groupe, $groupeP, $oldNomGroupe);
    

    if (!$result) {

        echo $tpl->render(array("groupe"=>$groupe, "allGroupes" => getGroupes(), "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));

    } else {
    	header("Location: page_listGroupes.php");
    }
    

} 
    if(isset($_GET['id'])) {

        $groupe = getGroupe($_GET['id']);


        echo $tpl->render(array("gp" => $groupe, "allGroupes" => getGroupes()));

    } else {
        echo $tpl->render(array());
    }

