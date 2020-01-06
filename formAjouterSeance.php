<?php

session_start();
// VERIFICATION SESSION
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

// REQUIRES
require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.groupes.php";
require_once "PHP/fonctions/func.seance.php";
require_once "PHP/fonctions/func.users.php";

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("ajoutSeance.twig");

$message = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // TODO: vérifier que les contenus obligatoires sont présents
    if (!addSeance($_POST['Module'], $_POST['Date'], $_POST['Type'], $_POST['Groupe'], $_SESSION['login'])) {
        $message = "Impossible d'enregistrer la séance.";
    }
    else {
        $message = "Séance ajoutée avec succès!";
    }

}

// TODO: Vérifier que la date correspond à l'année universitaire en cours
$dateMin = new DateTime('09/01');
$dateMax = new DateTime();
$crea    = getUtilisateur($_SESSION['login'])->getCreeLe();
list($year,$month,$day) = explode('-', $crea);
$date2 = new DateTime();
$date2->setDate( $year, 9, 1);
echo $tpl->render(
    array(
        "titre"=>"Inscription d'une séance",
        "message"=>$message,
        "dateMin"=>$date2->format("Y-m-d g:i:s"),
        "dateMax"=>$dateMax->format("Y-m- g:i:s"),
        "date"=>date("Y-m-d"),
        // TODO: prendre en compte l'utilisateur courant
        "groupes"=>getGroupes(),
        "modules"=>getAllModules(),
        "types"=>getTypesSeance(),
    )
);
