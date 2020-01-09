<?php

require_once "__inc.php";

echo $twig->render("profil.twig", array(
    "titre"=>"Profil",
    "user"=>$db->getUtilisateur($_SESSION['login']),
    "sections"=>getSidebarSections($_SESSION['login']),
    "options"=>getSidebarOptions("profil"),
    "modules"=>$db->getModules()
));