<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>module à modifier</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header><h1 align="center">Selection du module à modifier</h1></header>
		<fieldset style="margin-left:25%;margin-right:25%">
			<table align="center">
				<form action="formModifierModule.php" method="get">
					<tr>
						<td align="right"> liste des modules : </td>
						<td> 
							<?php
								include "DB.inc.php";
								$db = DB::getInstance();
								echo "<select name=\"Module\">";
								$modules = $db -> getModules();
								foreach ($modules as $module) {
									echo "<option value=\"", $module->getIdModule(), "\">", $module->getLibelle(), "\n";
								}
								echo "</select>";
							?>
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td> <input type="submit" name="valider" value="Valider"> </td>
					</tr>
				</form>
			</table>
		</fieldset>
	</body>
</html>
