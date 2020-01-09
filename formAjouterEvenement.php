<?php
session_start();
// VERIFICATION SESSION
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}
// REQUIRES
require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.evenement.php";
require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.piece_jointe.php";

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
 * - PJ
 * - Temps
 * - Date
 */

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // TODO: Listing des séances de l'utilisateur courant
    // TODO: Investiguer les pièces jointes dans la méthode d'ajout

    $id_evenement = addEvenement($_POST['Categorie'], $_POST['Description'],null, $_POST['Temps'], $_POST['Date'],$_GET['id_seance']);

    if ($id_evenement != -1) {
        $message = "Impossible d'ajouter cet évènement";
    } else {
        $message = "Évènement enregistré avec succès!";
    }

    if(isset($_FILES["PJ"]))
    {
        // PRÉREQUIS POUR WOODY: chmod -R 777 public_html
        // (Généralement le 777 est pas recommandé mais bon avec woody...)

        // Récupérer le chemin d'un dossier "uploaded" dans le dossier courant
        list($scriptPath) = get_included_files();
        $folder = pathinfo($scriptPath, PATHINFO_DIRNAME) . "/upload";

        // Dépacer le fichier dans le dossier uploaded
        move_uploaded_file($_FILES["PJ"]["tmp_name"], "$folder/" . $_FILES["PJ"]["name"]);

        if(!addPiece_jointe($_FILES["PJ"]["name"], "$folder/" . $_FILES["PJ"]["name"], $id_evenement)){
            $message = "";
        } else {
            $message = "";
        }
    }





}

//Colonne Role dans la table Type Event
$typeevenement = getTypesEvenement();
$user = getUtilisateur($_SESSION['login']);
$roleUser = $user->getRole(); //1
$length = strlen($roleUser); //2
$tabRoles = array();
for ($i=0; $i < $length; $i++) { 
    array_push($tabRoles, $roleUser[$i]); //3
}
$type2 = array();
$cpt = 0;
foreach ($typeevenement as $event) {
    $typeEvent = $event->getRoles();
    while ($cpt < $length) { 
        if( $tabRoles[$cpt] == $typeEvent ){
            array_push($type2, $event);
        }
        $cpt++;
    }
    
    $cpt=0;
}

$dateMax = new DateTime('06/30');
$crea    = getUtilisateur($_SESSION['login'])->getCreeLe();

list($year,$month,$day) = explode('-', $crea);
$dateMin = new DateTime();



echo $tpl->render(array(
    "titre"=>"Inscription d'un évènement",
    "tabTypes"=>$type2,
    "types"=>$typesSeance,
    "dateMin"=>$dateMin->format("Y-m-d"),
    "dateMax"=>$dateMax->format("Y-m-d"),
    "date"=>date("Y-m-d"),
    "message"=>$message,
    "user"=>$_SESSION['login'],

));
