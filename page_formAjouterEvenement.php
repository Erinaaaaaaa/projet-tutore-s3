<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter un évènement</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Ajouter un évènement</h1></header>
		<form action="PHP/ajouterEvenement.php">
			<fieldset style="margin-left:25%;margin-right:25%">
		 		<table align="center">
					<tr>
						<td>
							Catégorie:
						</td>
						<td>
							<select name="Categorie">
								<option value="tutorat">tutorat
								<option value="fait">fait
								<option selected value="a_faire">à faire
								<option value="evaluation">évaluation
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Description du travail:
						</td>
						<td>
							<input type="text" name="Description" value="">
							<?php
								if (isset($_GET['erreur']))
									echo "<label style=\"color:red\">",$_GET['erreur'],"</label>";
							?>
						</td>
					</tr>
					<tr>
						<td>
							*Pièces jointes (3 max):
						</td>
						<td>
							<input type="file" name="file[]" accept="/*" multiple size="3">
						</td>
					</tr>
					<tr>
						<td>
							*Temps:
						</td>
						<td>
							<input type="time" name="Temps" min="00:00" max="99:59">
						</td>
					</tr>
					<tr>
						<td>
							*Pour le:
						</td>
						<td>
							<input type="date" name="Date" value="aaaa-mm-jj">
						</td>
					</tr>
					<tr>
						<td>
							(* champs optionnels)
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


<?php



?>
