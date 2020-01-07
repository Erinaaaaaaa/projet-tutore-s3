<?php
session_start();
// REQUIRES
require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.evenement.php";
require_once "PHP/fonctions/func.users.php";

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

    var_dump($_POST);

    // TODO: Listing des séances de l'utilisateur courant
    // TODO: Investiguer les pièces jointes dans la méthode d'ajout
    $duree = $_POST['heure'].':'.$_POST['minute'];
    if (!addEvenement($_POST['Categorie'], $_POST['Description'], null, $duree, $_POST['Date'], 13)) {
        $message = "Impossible d'ajouter cet évènement";
    } else {
        $message = "Évènement enregistré avec succès!";
        header("Location: listEvenement.php");
        die();
    }


}

$dateMax = new DateTime('06/30');
$crea    = getUtilisateur($_SESSION['login'])->getCreeLe();

list($year,$month,$day) = explode('-', $crea);
$dateMin = new DateTime();



echo $tpl->render(array(
    "titre"=>"Inscription d'un évènement",
    "types"=>$typesSeance,
    "dateMin"=>$dateMin->format("Y-m-d"),
    "dateMax"=>$dateMax->format("Y-m-d"),
    "date"=>date("Y-m-d"),
    "message"=>$message
    
));

