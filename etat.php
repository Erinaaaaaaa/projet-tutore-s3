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


/*
 * changement mois et année avec boutons
 */

if (!isset($_POST['month+']) && !isset($_POST['month-']))
{
	$moisActuel    = intval(date('n'))-1;
	$anneeActuelle = intval(date('Y'));
}
else
{
	$moisActuel = $_POST['month'];
	$anneeActuelle = $_POST['year'];
}

$tabMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

if (isset($_POST['month+']))
{
	$moisActuel = $moisActuel+1;
}
if (isset($_POST['month-']))
{
	$moisActuel = $moisActuel-1;
}

if ($moisActuel < 0)
{
	$moisActuel    = 11;
	$anneeActuelle = $anneeActuelle-1;
}
if ($moisActuel > 11)
{
	$moisActuel    = 0;
	$anneeActuelle = $anneeActuelle+1;
}

///////////////////////////////////////////////////////



/* @var $seances Seance */
$allSeances     = getSeances();
$modules        = getAllModules();
$types          = getTypesSeance();
$groupes        = getGroupes();
$users          = getAllUtilisateurs();
$typesEvenement = getTypesEvenement();

$date = new DateTime(date("Y-m-d"));

$dateMin = new DateTime('09/01');
if (intval($date->diff($dateMin)->format("%R%d")) > 0)
	$dateMin->setDate(intval($dateMin->format("Y"))-1, 9, 1);

$dateMax = new DateTime('06/30');
if (intval($date->diff($dateMax)->format("%R%d")) < 0)
	$dateMax->setDate(intval($dateMax->format("Y"))+1, 6, 30);

$dateCreaMinMois = new DateTime();
$dateCreaMinMois->setDate($anneeActuelle, $moisActuel+1, 1);

$dateCreaMaxMois = new DateTime();
$dateCreaMaxMois->setDate($anneeActuelle, $moisActuel+2, 1);

$crea    = getUtilisateur($_SESSION['login'])->getCreeLe();
list($year,$month,$day) = explode('-', $crea);
$date2 = new DateTime();
$date2->setDate( $year, 9, 1);

/* De façon à ne pas pourvoir entrer une date incohérente : */

$dateCreaMin  = new DateTime();
$dateCreaMin->setDate(date("Y"), date('m'), 1);
if (intval($date->diff($dateCreaMin)->format("%R%d")) > 0)
	$dateCreaMin->setDate(intval($dateCreaMin->format("Y"))-1, 9, 1);

$dateCreaMax  = new DateTime();
$dateCreaMax->setDate(date("Y"), date('m')+1, 1);
if (intval($date->diff($dateCreaMax)->format("%R%d")) < 0)
	$dateCreaMax->setDate(intval($dateCreaMax->format("Y"))+1, 6, 30);

$echeanceMin  = new DateTime('09/01');
if (intval($date->diff($echeanceMin)->format("%R%d")) > 0)
	$echeanceMin->setDate(intval($echeanceMin->format("Y"))-1, 9, 1);

$echeanceMax  = new DateTime('06/30');
if (intval($date->diff($echeanceMax)->format("%R%d")) < 0)
	$echeanceMax->setDate(intval($echeanceMax->format("Y"))+1, 6, 30);

///////////////////////////////////////////////////////




$tabModules      = array();
$tabGroupes      = array();
$tabTypes        = array();
$tabTypesEv      = array();
$tabCreateurs    = array();
$tabSemaphores   = array();
$tabPiece_jointe = array();

if (isset($_POST['DateCreaMin'])) {
	$dateCreaMin = new DateTime($_POST['DateCreaMin']);
}
else {
	$dateCreaMin = $dateCreaMinMois;
}
if (isset($_POST['DateCreaMax'])) {
	$dateCreaMax = new DateTime($_POST['DateCreaMax']);
}
else {
	$dateCreaMax = $dateCreaMaxMois;
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

////////////////////////////////////////////////////////////////////

if (isset($_POST['month'])) {
	$dateCreaMin = new DateTime();
	$dateCreaMin->setDate($anneeActuelle,$moisActuel+1,1);
}
if (isset($_POST['month'])) {
	$dateCreaMax = new DateTime();
	$dateCreaMax->setDate($anneeActuelle,$moisActuel+2,0);
}

////////////////////////////////////////////////////////////////////


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
        $event->pj = getPjPourEvenement($event->getIdEvenement());
    }

    $seance->nom_type   = getTypeSeance($seance->getType())->getLibelle();
    $seance->obj_user   = getUtilisateur($seance->getIdUtilisateur());

	array_push($tabSemaphores, getSemaphoreSeUs($seance->getIdSeance(), $_SESSION['login']));
}

/* association des séances avec leur numero de semaine */

$tabSeancesFiltrees = array();

foreach ($seancesFiltrees as $seance) {
	if (!array_key_exists(date($seance->getDateCreation()), $tabSeancesFiltrees)) {
		$date = new DateTime(date($seance->getDateCreation()));
		$numSemaine     = $date->format("W");
		$seancesSemaine = array();

		foreach ($seancesFiltrees as $s) {
			$dateSeance       = new DateTime(date($s->getDateCreation()));
			$numSemaineSeance = $dateSeance->format("W");
			if ($numSemaineSeance == $numSemaine) {
				array_push($seancesSemaine, $s);
			}
		}

		$tabSeancesFiltrees[$numSemaine] = $seancesSemaine;
	}
}

/* sauvegarde des sémaphores */

if (isset($_POST['save'])) {
	foreach ($tabSemaphores as $semaphore) {
		if ($semaphore !== null) {
			if (isset($_POST['sem'])) {
				if (in_array($semaphore->getIdSeance(), $_POST['sem'])) {
					updateSemaphore($semaphore->getIdSeance(), $_SESSION['login'], "t");
					$semaphore->setEtat("t");
				}
				else {
					updateSemaphore($semaphore->getIdSeance(), $_SESSION['login'], "f");
					$semaphore->setEtat("f");
				}
			}
			else {
				updateSemaphore($semaphore->getIdSeance(), $_SESSION['login'], "f");
				$semaphore->setEtat("f");
			}
		}
	}
}

echo $tpl->render(array("titre"=>"Etat des séances",
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
    "tabSeances"        => $tabSeancesFiltrees,
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
	"tabSemaphores"  => $tabSemaphores,
	"tabPiece_jointe"=> $tabPiece_jointe,
	"debutAnnee"     => strval($dateMin->format("Y-m-d")),
	"finAnnee"       => strval($dateMax->format("Y-m-d")),
	"dateCreaMinMois"=> strval($dateCreaMinMois->format("Y-m-d")),
	"dateCreaMaxMois"=> strval($dateCreaMaxMois->format("Y-m-d")),
	"dateCreaMin"    => strval($dateCreaMin->format("Y-m-d")),
	"dateCreaMax"    => strval($dateCreaMax->format("Y-m-d")),
	"dateEvMin"      => strval($echeanceMin->format("Y-m-d")),
	"dateEvMax"      => strval($echeanceMax->format("Y-m-d")),
	"moisActuel"     => $tabMois[$moisActuel]." ".$anneeActuelle,
	"chiffreMois"    => $moisActuel,
	"chiffreAnnee"   => $anneeActuelle,
));
