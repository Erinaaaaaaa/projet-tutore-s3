<?php

	if(isset($_POST['groupePere']))
	{
		$Pere = $_POST['groupePere'];
		echo '<fieldset><form action="verifGroupe.php" method="POST"/><table align="center"><tr><td>Groupe</td><td>';
		if($Pere == '1')
		{
			echo '<select name="groupe'.$Pere.'"><option selected value="A"> A<option value="B"> B<option value="C"> C<option value="D"> D</select>';
		}

		if($Pere == '2')
		{
			echo '<select name="'.$Pere.'"><option selected value="F"> F<option value="G"> G<option value="H"> H<option value="I"> I<option value="J"> J</select>';
		}
		
		echo'</td></tr><tr><td colspan="2" align="center"><input type="submit" name = "groupe" value="Valider"/></td></tr></table></form></fieldset>';
	}
	else
	{
		echo 'groupe vide';
	}
	
	
?>