<?php
	function contenu()
	{

	}
?>

<html>
<head>
	 <link href="modele.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<table border>
	<tr>
		<th>Semaine</th>
		<th>Module</th>
		<th>Date</th>
		<th>Type</th>
		<th>Groupe</th>
		<th id = "createur"></th>
		<th>PJ</th>
		<th>durée<br>hh:mm</th>
		<th>pour le</th>
	</tr>
	<tr>
		<td><?php $date = date('W'); echo $date;?></td>
		<td>Module</td>
		<td><?php 
				$jour    = date('D');
				$numJour = date('j');
				$numMois = date('m');
				$annee   = date('Y');

				echo $jour.'. '.$numJour.'/'.$numMois.'/'.$annee;
			?>
		</td>
		<td>Type</td>
		<td>Groupe</td>
		<td></td>
		<td><input type="file" accept="/*"></td>
		<td>durée<br>hh:mm</td>
		<td><?php 
				$jour    = date('D');
				$numJour = date('j');
				$numMois = date('m');
				$annee   = date('Y');

				echo $jour.'. '.$numJour.'/'.$numMois.'/'.$annee;
			?>
		</td> 
	</tr>
</table>
</body>
<html>