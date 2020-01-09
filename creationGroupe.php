<?php

require_once "PHP/Twig/lib/Twig/Autoloader.php";
require_once "PHP/fonctions/func.groupes.php";
require_once "PHP/fonctions/func.users.php";

session_start();
// VERIFICATION SESSION
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}
else {
	if (strpos(getUtilisateur($_SESSION['login'])->getRole(), "A") === false) {
		header("Location: accueil.php");
	}
}

Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate("groupe.twig");

$grp = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    insertGroupe($_POST['nomGroupe'], $_POST['groupePere']);

}

if (isset($_GET['id'])) {
    $grp = getGroupe($_GET['id']);
}

echo $tpl->render(array(
    "gp" => $grp,
    "allGroupes" => getGroupes()
));
