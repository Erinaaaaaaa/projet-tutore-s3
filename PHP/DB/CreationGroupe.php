<html>
<head>
	<title>Création Groupe</title>
</head>
<body>
	<fieldset>
		<form action="ajoutG.php" method="POST">
			<table>
				<tr>
					<td>Nom du Groupe</td>
					<td>
						<input type="text" name="nomGroupe"/>
					</td>
				</tr>
				<tr>
					<td>
						<select name="groupePere">
							<?php 
								include 'DB.inc.php';

								$db = DB::getInstance();
								$groupes = $db->getGroupes();

								foreach($groupes as $groupe)
								{
									echo'<option value="'.$groupe->getGroupe().'">'.$groupe->getGroupe();
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="OK" value="Valider">
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
</body>
</html>
