<?php

// REQUIRES
require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.evenement.php";

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("ajoutTypeEvenement.twig");

$message = null;

/*
 * Champs POST
 * - id_typeevenement
 * - libelle
 * - roles
 */

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // TODO: Listing des séances de l'utilisateur courant
    // TODO: Investiguer les pièces jointes dans la méthode d'ajout

   if(! insertTypeEvenement($_POST['libelle'], $_POST['roles'])){
       $message = "Impossible d'ajouter ce type d'evenement";
   }
   else{
       $message = "Type d'evenement enregistré avec succès!";
       header("Location: listTypeEvenement.php");
       die();
   }


}

echo $tpl->render(array(
    "titre"=>"Inscription d'un type d'évènement",
    "message"=>$message
));

