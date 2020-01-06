<?php

// REQUIRES
require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.evenement.php";

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("ajoutEvenement.twig");

$typesSeance = getTypesEvenement();
$message = null;

/*
 * Champs POST
 * - Categorie
 * - Description
 * - Temps
 * - Date
 */

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // TODO: Listing des séances de l'utilisateur courant
    // TODO: Investiguer les pièces jointes dans la méthode d'ajout
    if (!addEvenement($_POST['Categorie'], $_POST['Description'], null, $_POST['Temps'], $_POST['Date'], 13)) {
        $message = "Impossible d'ajouter cet évènement";
    } else {
        $message = "Évènement enregistré avec succès!";
        header("Location: listEvenement.php");
        die();
    }


}

echo $tpl->render(array(
    "titre"=>"Inscription d'un évènement",
    "types"=>$typesSeance,
    "message"=>$message
));

