<?php
// INCLUDES
require_once "PHP/Twig/lib/Twig/Autoloader.php";

// PREPARATION TWIG
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("etat.twig");

require_once "PHP/fonctions/func.users.php";
require_once "PHP/fonctions/func.modules.php";
require_once "PHP/fonctions/func.typeseance.php";
require_once "PHP/fonctions/func.typeevenement.php";
require_once "PHP/fonctions/func.seance.php";
require_once "PHP/fonctions/func.evenement.php";

/* @var $seances Seance */
$seances = getSeances();

/* @var $seance Seance */
foreach ($seances as $seance)
{
    $seance->obj_module = getModule($seance->getModule());
    $seance->evenements = getEvenementsPourSeance($seance->getIdSeance());

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
    "seances" => $seances,
    "vardump" => gettype($seances[0]->getDateCreation())
));