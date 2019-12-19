<?php

	if(isset($_POST['groupe1']))
	{
		$groupe = $_POST['groupe1'];
	}
	if(isset($_POST['groupe2']))
	{
		$groupe = $_POST['groupe2'];
	}
	if(isset($groupe))
	{?>
		<fieldset>
		<form action = "verifDemiGroupe.php" method="POST">
		<table align="center">
			<tr>
				<td>Groupe</td>
				<td>
							<?php
							for($g = 'A'; $g < 'J'; $g++)
							{
								if($g != 'E')
								{
									if($groupe == $g)
									{
										$g1 = $groupe.'1';
										$g2 = $groupe.'2';
										echo '<input type="checkbox" name="demiGroupe[]" value='.$g1.'>'.$g1;
										echo '<input type="checkbox"
										    name="demiGroupe[]" value='.$g2.'>'.$g2;

										/*echo '<option selected value="'.$groupe.'1">'.$groupe.'1<option value="'.$groupe.'2">'.$groupe.'2';*/
									}
								}

							}?>
				</td>
			
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Valider">
				</td>
			</tr>
		</table>
	</form>
	</fieldset><?php
	}

	
?>