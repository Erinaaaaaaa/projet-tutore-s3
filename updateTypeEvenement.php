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
$tpl = $twig->resolveTemplate("ajoutTypeEvenement.twig");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id      = $_POST['id_typeevenement'];
    $libelle = $_POST['libelle'];
    $roles   = $_POST['roles'];

    $result = false;

    if (evenementExiste($_POST['id_typeevenement'])) {
        // Modification d'evenement
        $result = updateTypeEvenement($id,$libelle,$roles);
    } else {
        // Création de type d'evenement
        $result = insertTypeEvenement($libelle,$roles);
    }

    if (!$result) {

        echo $tpl->render(array("id_typeevenement" => $id, "libelle" => $libelle, "roles" => $roles,
            "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));

    }
    else
        header("Location: listTypeEvenement.php");

} else {
    if(isset($_GET['id_typeevenement'])) {

        $typeEvenement = getTypeEvenement($_GET['id_typeevenement'])[0];


        echo $tpl->render(array("id" => $_GET['id_typeevenement'], "libelle" => $typeEvenement->getLibelle(), "roles" => $typeEvenement->getRoles()
        ));

    } else {
        echo $tpl->render(array());
    }
}

