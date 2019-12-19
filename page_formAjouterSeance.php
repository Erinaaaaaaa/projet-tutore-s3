<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter une séance</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Ajouter une séance</h1></header>
		<form action="PHP/ajouterSeance.php" method="get">
			<fieldset style="margin-left:25%;margin-right:25%">
		 		<table align="center">
					<tr>
						<td>
							Module:
						</td>
						<td>
							<?php
								include "PHP/DB/DB.inc.php";
								$db = DB::getInstance();
								$affectations = $db->getAffectation("adminProf");
								echo "<select name=\"Module\">";
								foreach ($affectations as $affectation) {
									if (isset($db->getModule($affectation->getIdModule())[0])) {
										$module = $db->getModule($affectation->getIdModule())[0];
										echo "<option value=\"", $module->getIdModule(), "\">", $module->getLibelle(), "\n";
									}
								}
								echo "</select>";
							?>
						</td>
					</tr>
					<tr>
						<td>
							Date:
						</td>
						<td>
							<?php
								$dateMin = new DateTime('09/01');
								$dateMax = new DateTime('06/30');
								$dateMax->add(new DateInterval('P1Y'));
								echo "<input type=\"date\" min=\"", $dateMin->format('Y-m-d'), "\" max=\"", $dateMax->format('Y-m-d'), "\" name=\"Date\" value=\"", date("Y") ,"-", date("m") ,"-", date("d") ,"\"/>\n"
							?>
						</td>
					</tr>
					<tr>
						<td>
							Type:
						</td>
						<td>
							<select name="Type">
								<option value="CM">Cours magistral
								<option value="TD">TD
								<option selected value="TP">TP
								<option value="Projet">Projet
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Groupe:
						</td>
						<td>
							<?php
								$db = DB::getInstance();
								$groupes = $db->getUtilisateur('prof')[0]->getGroupe();
								if (empty($groupes)) {
									$groupes = $db->getGroupes();
									echo "<select name=\"Groupe\">\n";
									foreach ($groupes as $groupe) {
										echo "<option value=\"", $groupe->getGroupe(), "\">", $groupe->getGroupe();
									}
									echo "</select>\n";
								}
								else {
									$liste = explode(':', $groupes);
									echo "<select name=\"Groupe\">\n";
									foreach ($liste as $groupe) {
										echo "<option value=\"", $db->getGroupe($groupe)[0]->getGroupe(), "\">", $db->getGroupe($groupe)[0]->getGroupe();
									}
									echo "</select>\n";
								}
							?>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input type="submit" name="valider" value="Valider">
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</body>
</html>
