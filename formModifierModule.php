<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modification du module</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Modification du module</h1></header>
		<fieldset style="margin-left:25%;margin-right:25%">
			<table align="center">
				<form action="modifierModule.php" method="get">
					<tr>
						<td colspan="2" align="center"> 
							<?php
								include "PHP/DB/DB.inc.php";
								$db = DB::getInstance();
								echo "<input type=\"hidden\" name=\"oldModule\" maxlength=\"8\" value=\"", $db -> getModule($_GET['Module'])[0] -> getIdModule(), "\">";
							?>
						</td>
					</tr>
					<tr>
						<td align="right"> id_module: </td>
						<?php
							$db = DB::getInstance();
							$module = $db -> getModule($_GET['Module'])[0] -> getIdModule();
							echo "<td> <input type=\"text\" name=\"module\" value=\"$module\" maxlength=\"8\"> </td>";
						?>
					</tr>
					<tr>
						<td align="right"> libelle: </td>
						<?php
							$db = DB::getInstance();
							$libelle = $db -> getModule($_GET['Module'])[0] -> getLibelle();
							echo "<td> <input type=\"text\" name=\"libelle\" value=\"$libelle\" maxlength=\"20\"> </td>";
						?>
					</tr>
					<tr>
						<td align="right"> couleur: </td>
						<?php
							$db = DB::getInstance();
							$couleur = $db -> getModule($_GET['Module'])[0] -> getCouleur();
							echo "<td> <input type=\"color\" name=\"couleur\" value=\"#$couleur\"> </td>";
						?>
					</tr>
					<tr>
						<td align="right"> droit: </td>
						<td>
						<?php
							$db = DB::getInstance();
							$droit = $db -> getModule($_GET['Module'])[0] -> getDroit();
							$checked = "checked";
							if (!(strpos($droit,"A")===false))
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"A\" $checked> Administrateur <br/>";
							else
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"A\"> Administrateur <br/>";
								
							if (!(strpos($droit,"E")===false))
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"E\" $checked> Enseignant <br/>";
							else
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"E\"> Enseignant <br/>";
								
							if (!(strpos($droit,"T")===false))
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"T\" $checked> Tuteur <br/>";
							else
								echo "<input type=\"checkbox\" name=\"droit[]\" value=\"T\"> Tuteur <br/>";
						?>
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td> <input type="submit" name="modifier" value="Modifier"> </td>
						<td> <input type="reset" name="retour" value="Retour"> </td>
					</tr>
				</form>
			</table>
		</fieldset>
	</body>
</html>
