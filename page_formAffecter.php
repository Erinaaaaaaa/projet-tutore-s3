<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Affectation</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Affecter un module à un enseignant</h1></header>
		<form action="PHP/affecter.php">
			<fieldset style="margin-left:25%;margin-right:25%">
		 		<table align="center">
					<?php
						echo "<tr>";
						if (isset($_GET['erreur'])) {
							echo "<td colspan=\"2\" align=\"center\" style=\"color:red\">", $_GET['erreur'], "</td>";
						}
						echo "</tr>";
					?>
					<tr>
						<td>
							Enseignant:
						</td>
						<td>
							<select name="Enseignant">
								<?php
									include "PHP/DB/DB.inc.php";
									$db = DB::getInstance();
									$utilisateurs = $db->getAllUtilisateur();
									foreach ($utilisateurs as $utilisateur){
										if (!(strpos($utilisateur->getRole(), "E")===false)) {
											echo "<option value=\"",$utilisateur->getIdUtilisateur(),"\">",$utilisateur->getNom()," ",$utilisateur->getPrenom();
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Module:
						</td>
						<td>
							<select name="Module">
								<?php
									$db = DB::getInstance();
									$modules = $db->getModules();
									foreach ($modules as $module){
										echo "<option value=\"",$module->getIdModule(),"\">",$module->getLibelle();
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="Affecter" value="Affecter">
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</body>
</html>


<?php



?>
