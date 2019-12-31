<?php
session_start();

require_once "PHP/fonctions/func.seance.php";
require_once("PHP/Twig/lib/Twig/Autoloader.php");
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.groupes.php";

// Vérification de session
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("ajoutSeance.twig");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id            = $_GET['id_seance'];
    $idModule      = $_POST['Module'];
    $idType        = $_POST['Type'];
    $groupe        = $_POST['Groupe'];

    $result = false;

    if (seanceExiste($_GET['id_seance'])) {
        // Modification d'evenement
        $result = updateSeance($id,$idModule,$idType,$groupe);
        //$result = updateevenement($oldId, $id, $nom, $prenom, $mdp, $role, $groupe);
    } else {
        // Création d'evenement
        $result = addSeance($id,$description,null,$temps,$pour_le,13);
    }

    if (!$result) {

        /*echo $tpl->render(array("id" => $id, "modules" => getAllModules(), "types" => getTypesSeance(),
            "description" => $description,
            "ErreurInscription" => "Une erreur est survenue lors de l'application des changements."));*/

    }
    else
        header("Location: listSeance.php");

} else {
    if(isset($_GET['id_seance'])) {

        $seance = getSeanceIdSc($_GET['id_seance'])[0];


        echo $tpl->render(array("id" => $_GET['id_seance'], "id_mod" => $seance->getModule(), "modules" => getAllModules(),
			"typeActuel" => $seance->getType(), "types" => getTypesSeance(),
            "groupeActuel" => $seance->getGroupe(), "groupes" => getGroupes()
           ));

    } else {
        echo $tpl->render(array());
    }
}
