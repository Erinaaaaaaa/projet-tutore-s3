<?php
session_start();

require_once "PHP/fonctions/func.evenement.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");
require_once "PHP/fonctions/func.typeevenement.php";

// Vérification de session
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("ajoutEvenement.twig");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id          = $_POST['id'];
    $categorie   = $_POST['Categorie'];
    $description = $_POST['Description'];
    $temps       = $_POST['Temps'];
    $pour_le     = $_POST['Date'];

    print_r($_POST);

    $result = false;

    if (evenementExiste($_POST['id'])) {
        // Modification d'evenement
        $result = updateEvenement($id,$categorie,$description,$temps,$pour_le);
        //$result = updateevenement($oldId, $id, $nom, $prenom, $mdp, $role, $groupe);
    } else {
        // Création d'evenement
        $result = addEvenement($categorie,$description,null,$temps,$pour_le,13);
    }

    if (!$result) {

        echo $tpl->render(array("id" => $id, "categorie" => $categorie, "types" => getTypesEvenement(),
            "description" => $description, "temps" => $temps, "pour_le" => $pour_le,
            "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));

    }
    else
        header("Location: listEvenement.php");

} else {
    if(isset($_GET['id'])) {

        $evenement = getEvenement($_GET['id'])[0];




        echo $tpl->render(array("id" => $_GET['id'], "categorie" => $evenement->getCategorie(), "types" => getTypesEvenement(),
            "description" => $evenement->getDescription(), "temps" => $evenement->getTemps(),"pour_le"=>$evenement->getPourLe()
           ));

    } else {
        echo $tpl->render(array());
    }
}

