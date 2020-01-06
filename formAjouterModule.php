<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter un module</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Ajouter un module</h1></header>
		<fieldset style="margin-left:25%;margin-right:25%">
			<table align="center">
				<form action="ajouterModule.php" method="get">
					<tr>
						<td align="right"> id_module: </td>
						<td> <input type="text" name="module" value="" placeholder="M1111" maxlength="8"> </td>
					</tr>
					<tr>
						<td align="right"> libelle: </td>
						<td> <input type="text" name="libelle" value="" placeholder="français" maxlength="20"> </td>
					</tr>
					<tr>
						<td align="right"> couleur: </td>
						<td> <input type="color" name="couleur" value="#2d9f87"> </td>
					</tr>
					<tr>
						<td align="right"> droit: </td>
						<td>
							<input type="checkbox" name="droit[]" value="A"> Administrateur <br/>
							<input type="checkbox" name="droit[]" value="E"> Enseignant <br/>
							<input type="checkbox" name="droit[]" value="T"> Tuteur <br/>
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td> <input type="submit" name="creer" value="Créer"> </td>
						<td> <input type="reset" name="annuler" value="Annuler"> </td>
					</tr>
				</form>
			</table>
		</fieldset>
	</body>
</html>
