<?php

session_start();
// VERIFICATION SESSION
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}
// INCLUDES
require_once "PHP/Twig/lib/Twig/Autoloader.php";

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("etat.twig");

require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.groupes.php";
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.seance.php";
require_once "PHP/fonctions/func.evenement.php";

/* @var $seances Seance */
$allSeances     = getSeances();
$modules        = getAllModules();
$types          = getTypesSeance();
$groupes        = getGroupes();
$users          = getAllUtilisateurs();
$typesEvenement = getTypesEvenement();

$dateMin = new DateTime('09/01');
$dateMax = new DateTime('06/30');
$crea    = getUtilisateur($_SESSION['login'])->getCreeLe();
list($year,$month,$day) = explode('-', $crea);
$date2 = new DateTime();
$date2->setDate( $year, 9, 1);

/* De façon à ne pas pourvoir entrer une date incohérente : */
$date = new DateTime(date("Y-m-d"));

$dateCreaMin  = new DateTime('09/01');
if (intval($date->diff($dateCreaMin)->format("%R%d")) > 0)
	$dateCreaMin->setDate(intval($dateCreaMin->format("Y"))-1, 9, 1);

$dateCreaMax  = new DateTime('06/30');
if (intval($date->diff($dateCreaMax)->format("%R%d")) < 0)
	$dateCreaMax->setDate(intval($dateCreaMax->format("Y"))+1, 6, 30);

$echeanceMin  = new DateTime('09/01');
if (intval($date->diff($echeanceMin)->format("%R%d")) > 0)
	$echeanceMin->setDate(intval($echeanceMin->format("Y"))-1, 9, 1);

$echeanceMax  = new DateTime('06/30');
if (intval($date->diff($echeanceMax)->format("%R%d")) < 0)
	$echeanceMax->setDate(intval($echeanceMax->format("Y"))+1, 6, 30);


$tabModules   = array();
$tabGroupes   = array();
$tabTypes     = array();
$tabTypesEv   = array();
$tabCreateurs = array();

if (isset($_POST['DateCreaMin'])) {
	$dateCreaMin = new DateTime($_POST['DateCreaMin']);
}
if (isset($_POST['DateCreaMax'])) {
	$dateCreaMax = new DateTime($_POST['DateCreaMax']);
}
if (isset($_POST['EcheanceMin'])) {
	$echeanceMin = new DateTime($_POST['EcheanceMin']);
}
if (isset($_POST['EcheanceMax'])) {
	$echeanceMax = new DateTime($_POST['EcheanceMax']);
}
if (isset($_POST['Modules'])) {
	$tabModules = $_POST['Modules'];
}
if (isset($_POST['Types'])) {
	$tabTypes = $_POST['Types'];
}
if (isset($_POST['TypesEv'])) {
	$tabTypesEv = $_POST['TypesEv'];
}
if (isset($_POST['Groupes'])) {
	$tabGroupes = $_POST['Groupes'];
}
if (isset($_POST['Createurs'])) {
	$tabCreateurs = $_POST['Createurs'];
}



/* ajout des groupes fils à la liste des groupes sélectionnés */

foreach ($groupes as $g) {
	if (in_array($g->getGroupePere(), $tabGroupes) && !in_array($g->getGroupe(), $tabGroupes)) {
		array_push($tabGroupes, $g->getGroupe());
	}
}

/* Selection des seances par rapport aux filtres */

$seancesFiltrees = array();

foreach ($allSeances as $s) {
	$dateCrea = new DateTime($s->getDateCreation());
	if ( intval($dateCrea->diff($dateCreaMin)->format("%R%d")) <= 0 &&
		 intval($dateCrea->diff($dateCreaMax)->format("%R%d")) >= 0 &&
		 (in_array($s->getModule(),        $tabModules  ) || empty($tabModules  )) &&
		 (in_array($s->getGroupe(),        $tabGroupes  ) || empty($tabGroupes  )) &&
		 (in_array($s->getType(),          $tabTypes    ) || empty($tabTypes    )) &&
	 	 (in_array($s->getIdUtilisateur(), $tabCreateurs) || empty($tabCreateurs)))
	{
		array_push($seancesFiltrees, $s);
	}
}

/* @var $seance Seance */
foreach ($seancesFiltrees as $seance)
{
    $seance->obj_module = getModule($seance->getModule());
    $seance->allEvenements = getEvenementsPourSeance($seance->getIdSeance());

	/* Selection des évènements par rapport aux filtres */

	$seance->evenements = array();

	foreach ($seance->allEvenements as $e) {
		$echeance = new DateTime($e->getPourLe());
		if ( intval($echeance->diff($echeanceMin)->format("%R%d")) <= 0 &&
			 intval($echeance->diff($echeanceMax)->format("%R%d")) >= 0 &&
			 (in_array($e->getCategorie(), $tabTypesEv ) || empty($tabTypesEv)))
		{
			array_push($seance->evenements, $e);
		}
	}

    /* @var $event Evenement */
    foreach ($seance->evenements as $event)
    {
        $event->nom_type = getTypeEvenement($event->getCategorie())->getLibelle();
    }

    $seance->nom_type   = getTypeSeance($seance->getType())->getLibelle();
    $seance->obj_user   = getUtilisateur($seance->getIdUtilisateur());
}

echo $tpl->render(array("titre"=>"Accueil",
    "sections"=>array(
        array(
            "nom"=>"Visualiser",
            "url"=>"https://hooooooooo.com/"
        ),
        array(
            "nom"=>"Etat",
            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
        ),
        array(
            "nom"=>"Parametrage",
            "url"=>"page_listUtilisateurs.php"
        )
    ),
    "options"=>array(
        array(
            "nom", "Google",
            "url", "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
        )
    ),
    "seances"        => $seancesFiltrees,
	"modules"        => $modules,
	"types"          => $types,
	"groupes"        => $groupes,
	"users"          => $users,
	"typesEvenement" => $typesEvenement,
	"tabModules"     => $tabModules,
	"tabTypes"       => $tabTypes,
	"tabTypesEv"     => $tabTypesEv,
	"tabGroupes"     => $tabGroupes,
	"tabCreateurs"   => $tabCreateurs,
	"dateMin"        => strval($dateCreaMin->format("Y-m-d")),
	"dateMax"        => strval($dateCreaMax->format("Y-m-d")),
	"dateEvMin"      => strval($echeanceMin->format("Y-m-d")),
	"dateEvMax"      => strval($echeanceMax->format("Y-m-d")),
));
