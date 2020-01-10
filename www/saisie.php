<?php

require_once "__inc.php";

echo $twig->render("saisie.twig", array(
    "user"=>$db->getUtilisateur($_SESSION['login']),
    "titre"=>"Saisie d'une nouvelle activité"
));