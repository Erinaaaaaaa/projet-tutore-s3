<?php

// require_once ROOT_PATH."php/DB.php";

function getSidebarSections($login) {

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