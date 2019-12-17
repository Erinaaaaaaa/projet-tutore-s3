<?php
	function contenu()
	{
		echo '<table class="titreColonnes">';
			echo '<tr>';
				echo '<th width=5%>sem</th>';
				echo '<th width=9%>Module</th>';
				echo '<th width=15%>Date</th>';
				echo '<th width=2%>Type</th>';
				echo '<th width=3%>Groupe</th>';
				echo '<th style="width:16%">Enseignant</th>';
				echo '<th>Pièces-jointes</th>';
				echo '<th>Durée</th>';
				echo '<th width=20%>pour le</th>';
			echo '</tr>';
			echo '<tr class="seance">';
				echo '<td align = "center">';
					$date = date('W'); 
					echo $date;
				echo '</td>';
				echo '<td align = "center" style="width:18.7%">Base de données</td>';
				echo '<td align = "center" style="width:31.5%"><?php ';
					$jour    = date('D');
					$numJour = date('j');
					$numMois = date('m');
					$annee   = date('Y');

					echo $jour.'. '.$numJour.'/'.$numMois.'/'.$annee;

				echo '</td>';
				echo '<td align = "center" style="width:12%">TD</td>';
				echo '<td align = "center" style="width:9.5%">I</td>';
				echo '<td align = "center">Laurence Nivet</td>';
				echo '<td align = "center"><input type="file" accept="/*"></td>';
				echo '<td align = "center">durée<br>hh:mm</td>';
				echo '<td align = "center"></td>';
			echo '</tr>';
		echo '</table>';
	}
?>

<html>
<head>
	 <link href="style/modele.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<?php
		contenu();
	?>
</body>
<html>
