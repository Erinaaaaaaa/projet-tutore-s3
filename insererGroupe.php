<?php

	/*if( isset($_GET['table']) && ($_GET['table'] == 'Groupe' )
	{
		$connStr = 'pgsql:host=platea.moe port=5432 dbname=diskus;charset=utf8';
		$pdo     =  new PDO($connStr, 'diskus', 'tutorat_diskusapp', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		if( $_GET['table'] == 'Groupe' && !empty($_POST['groupe']) ) )
		{
			$groupe = htmlspecialchars( $_POST['groupe'] );
			$groupePere = htmlspecialchars( $_POST['groupePere'] ); 
 
			$reqVerifExiste = $pdo->prepare("SELECT * from Client WHERE nom=? AND adr=?");
			$reqInsertion   = $pdo->prepare("INSERT INTO Client (nom, adr) VALUES (?,?)");

			$reqVerifExiste->execute( array( $nom, $adr ) );

			if( $reqVerifExiste->rowCount() != 0 )
			{
				header("Location: insertion.php");
			}

			$reqInsertion->execute( array( $nom, $adr ) );

			header("Location: consultClient.php");
		}
			$reqVerifExiste->execute( array( $ncli, $np ) );

			if( $reqVerifExiste->rowCount() != 0 )
			{
				header("Location: insertion.php");
			}

			$req = $pdo->prepare("SELECT * FROM Produit where np=?");
			$req->execute(array($np));

			$donne = $req->fetch();

			if( $qa <= $donne['qs'] )
			{
				$reqInsertion->execute( array( $ncli, $np, $qa ) );
				header("Location: consultAchat.php");
			}
			else
				header("Location: insertion.php");
		}
		else
			header("Location: insertion.php");
	}
	else
	{
		header("Location: insertion.php");
	}*/

?>
<html>
<head>
</head>
<body>
	<fieldset>
		<form action = "verifGroupeP.php" method="POST">
		<table align="center">
			<tr>
				<td>Groupe Père</td>
				<td>
					<select name="groupePere">
						<option selected value="1">info1
						<option value="2">info2
					</select>
				</td>
			
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Valider">
				</td>
			</tr>
		</table>
	</form>
	</fieldset>