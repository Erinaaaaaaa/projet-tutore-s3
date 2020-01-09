<?php

require_once "__inc.php";
require_once ROOT_PATH."php/func.php";


if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    $id = $_POST['id'];
    $type = $_POST['Categorie'];
    $libelle = $_POST['Description'];
    $date = $_POST['Date'];
    $duree = $_POST['duree'];
    $seance = $_POST['seance'];

    if (empty($date))
        $date = null;

    if (empty($duree))
        $duree = null;

    $ev = null;

    if (!empty($id))
        $ev = $db->getEvenement($id);

    $result = false;

    if (!empty($id))
        $result = $db->updateEvenement($id, $type, $libelle, $date, $duree, $seance);
    else
        $result = $db->addEvenement($type, $libelle, $date, $duree, $seance);

    if (!$result) {
        $tpl = $twig->resolveTemplate("creation-evenement.twig");

        $seances = $db->getSeances();

        foreach ($seances as $seance)
            $seance->objmodule = $db->getModule($seance->getModule());

        echo $tpl->render(array(
            "user"=>$db->getUtilisateur($_SESSION['login']),
            "titre"=>($ev == null ? "Création":"Modification")." d'un évènement",
            "sections"=>getSidebarSections($_SESSION['login']),
            "evenement"=>$ev,
            "types"=>$db->getTypesEvenementForRoles($db->getUtilisateur($_SESSION["login"])->getRoles()),
            "dateMin"=>date("Y-m-d"),
            "dateMax"=>getCurrentPeriode()[1]->format("Y-m-d"),
            "date"=>($ev == null ? date("Y-m-d") : $ev->getEcheance()),
            "seances"=>$seances,
            "message" => "Une erreur est survenue lors de l'application des changements."
        ));
        die();

    } else {
        // Modification avec succès
        header("Location: ".basename(__FILE__));
    }
}


if (isset($_GET['id']))
{
    $tpl = $twig->resolveTemplate("creation-evenement.twig");

    /* @var $ev Evenement */
    $ev = null;

    if ($_GET['id'] != "new")
        $ev = $db->getEvenement($_GET['id']);

    $seances = $db->getSeances();

    foreach ($seances as $seance)
        $seance->objmodule = $db->getModule($seance->getModule());

    echo $tpl->render(array(
        "user"=>$db->getUtilisateur($_SESSION['login']),
        "titre"=>($ev == null ? "Création":"Modification")." d'un évènement",
        "sections"=>getSidebarSections($_SESSION['login']),
        "evenement"=>$ev,
        "types"=>$db->getTypesEvenementForRoles($db->getUtilisateur($_SESSION["login"])->getRoles()),
        "dateMin"=>date("Y-m-d"),
        "dateMax"=>getCurrentPeriode()[1]->format("Y-m-d"),
        "date"=>($ev == null ? date("Y-m-d") : $ev->getEcheance()),
        "seances"=>$seances
        // "types"=>$db->getTypesSeance()
    ));
}
else
{

    $tpl = $twig->resolveTemplate("liste-evenements.twig");

    echo $tpl->render(
        array(
            "titre" => "Évènements",
            "user" => $db->getUtilisateur($_SESSION['login']),
            "sections"=>getSidebarSections($_SESSION['login']),
            "tabEvent" => $db->getEvenements(),
        )
    );

}