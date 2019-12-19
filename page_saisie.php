<?php
session_start();
	if (!isset($_SESSION['login']))
	{
		//header("Location: erreurSess.php");
		echo 'Variable de session "login" non définie';
	}
	else
	{
?>
<html>
	<head>
		<title>Cahier de texte</title>
	</head>
	<body>
		<fieldset>
			<fieldset>
				<p align="center">Cahier de texte</p>
			</fieldset>

				<fieldset>
					
					<!--<form method="POST">-->
						<table align='center' border>
							<tr>
								<td>
									travail effectué
								</td>
								<td>
									travail à faire
								</td>
								<td>
									Ajouter une nouvelle séance
								</td>
								<td>
								</td>
								<!--<td>
									<input type="reset" name="renit" value="Effacer">
								</td>-->
							</tr>
							<tr>
								<form method = "POST">
									<td>
										<textarea name="travail effectué"></textarea><br>
										<input type="file" accept=/*><br/>
										<input type="reset" name="renit" value="Effacer">
									</td>
								</form>
							<form method="POST">
								<td>
									<textarea name="travail à faire"></textarea><br>
									<input type="file" accept=/*><br/>
									<input type="reset" name="renit" value="Effacer">
								</td>
							</form>
								<td>
									<input type="button" name="travail effectué+" value="Nouvelle séance" />
								</td>
								<td>
									<input type="submit" name="ok" value="Valider">
								</td>
								<!--<td>
									<input type="reset" name="renit" value="Effacer">
								</td>-->
							</tr>
				<!--</form>-->
			</fieldset>
			<form action="Deconnexion.php" method="POST">
		<input type="submit" name="Deco" value="Deconnexion">
		</form>

		</fieldset>

		
	</body>
</html>

<?php 
}
