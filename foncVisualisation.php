<?php

	function visualisation()
	{
		echo '<fieldset>';
		echo '<fieldset>';
		echo '<p align="center">Cahier de texte</p>';
		echo '</fieldset>';
		echo '<fieldset>';
		echo '<form method="POST">';
		echo '<table align=\'center\' border>';
		echo '<tr>';
		echo '<td>';
		echo '<textarea name="travail effectué" disabled="disabled">Voici le travail effectué</textarea>';
		echo '</td>';
		echo '<td>';
		echo '<textarea name="travail à faire" disabled="disabled">Voici le travail à faire</textarea>';
		echo '</td>';
		echo '<td>';
		echo '<input type="file" accept=/* value="php.png">';
		echo '</td>';
		echo '<td>';
		echo '<textarea name="travail effectué">Voici la zone de commentaires</textarea>';
		echo '</td>';
		echo '</tr>';
		echo '</form>';
		echo '</fieldset>';
		echo '<form action="Deconnexion.php" method="POST">';
		echo '<input type="submit" name="Deco" value="Deconnexion">';
		echo '</form>';
		echo '</fieldset>';
	}
?>