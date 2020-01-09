<?php
	session_start();

	require_once "PHP/fonctions/func.users.php";
	require_once("PHP/Twig/lib/Twig/Autoloader.php");

	// Vérification de session
	if (!isset($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
		if (strpos(getUtilisateur($_SESSION['login'])->getRole(), "A") === false) {
			header("Location: accueil.php");
		}
	}
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>consultation des modules</title>
		<link rel="stylesheet" type="text/css" href="css.css" />
	</head>
	<body>
		<header><h1 align="center">Consultation de la table modules</h1></header>
		<?php
			echo "<table align=\"center\">";
			echo "<tr>";
			echo "<th> id_module </th>";
			echo "<th> libelle </th>";
			echo "<th> couleur </th>";
			echo "<th> droit </th>";
			echo "<th> date_ajout </th>";
			echo "<th> date_modif </th>";

			$db = DB::getInstance();
			$modules = $db -> getModules();
			foreach ($modules as $module) {
				echo "<tr>";
				echo "<td>", $module -> getIdModule() , "</td>";
				echo "<td>", $module -> getLibelle() ,  "</td>";
				echo "<td>", $module -> getCouleur() ,  "</td>";
				echo "<td>", $module -> getDroit() ,    "</td>";
				echo "<td>", $module -> getDateAjout() ,"</td>";
				echo "<td>", $module -> getDateModif(), "</td>";
				echo "</tr>";
			}

			echo "</table>";
		?>
	</body>
</html>
