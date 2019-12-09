<?php
$choix=$_POST['choix'];

if(isset($_POST['choix']) && $choix=='saisie')
{
	header('location:prototype.php');
}
else if (isset($_POST['choix']) && $choix=='etat') {
	header('location:visualisation.php');
}
?>
