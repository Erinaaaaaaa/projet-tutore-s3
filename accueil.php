<?php
session_start();
	if (!isset($_SESSION['login']))
	{
		header("Location: erreurSess.php");
	}
?>
<html>
	<head>
	</head>
	<body>
		<fieldset align="center">
			<form action="page_interm.php" method="POST">
				<br/><br/><br/><br/>
				<input type="radio" name="choix" value="saisie">Saisie
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="choix" value="etat">Etat
				<br/><br/><br/><br/>
				<input type="submit" name="ok" value="Valider">
				&nbsp;&nbsp;
				<input type="reset" name="renit" value="Effacer">
			</form>

			<form action="inscription.php">
				<input type="submit" name="creaUser" value="Créer un utilisateur">				
			</form>
		</fieldset>
		</form>
	</body>
</html>