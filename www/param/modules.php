<?php

require_once "__inc.php";

if (isset($_GET['id'])) {
    echo $twig->resolveTemplate("creation-module.twig")->render(array(
        "user" => $db->getUtilisateur($_SESSION['login']),
        "titre" => "Modification des modules",
    ));
} else {
    echo $twig->resolveTemplate("liste-modules.twig")->render(array(
        "user" => $db->getUtilisateur($_SESSION['login']),
        "titre" => "Gestion des modules",
        "modules" => $db->getModules()
    ));
}