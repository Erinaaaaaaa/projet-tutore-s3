<?php

require_once "DB.php";

function getSidebarSections($login) {
    global $db;
    $roles = $db->getUtilisateur($login)->getRoles();

    $liens = array(
        array("nom"=>"Profil", "url"=>"javascript:alert('Non implémenté')"),
        array("nom"=>"Etat", "url"=>"javascript:alert('Non implémenté')"),
        array("nom"=>"Journal de bord", "url"=>"javascript:alert('Non implémenté')"),
        array("nom"=>"Paramétrage", "url"=>"/param/index.php")
    );

    return $liens;
}

function getSidebarOptions($page) {

}

function getCurrentPeriode($date = null) {
    $debut = new DateTime("09/01");
    $fin   = new DateTime("06/30");

    $today = new DateTime();

    while ($debut > $today)
    {
        $debut = $debut->sub(new DateInterval("P1Y"));
        $fin = $fin->sub(new DateInterval("P1Y"));
    }

    while ($fin < $today)
        $fin = $fin->add(new DateInterval("P1Y"));

    return [$debut, $fin];
}

function getPeriode($anneeDebut) {

}