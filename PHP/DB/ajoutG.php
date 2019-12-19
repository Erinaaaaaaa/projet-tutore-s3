<?php 
	include 'DB.inc.php';

	echo 'le groupe n\'est pas encore crée';

	$db = DB::getInstance();

	
	if(isset($_POST['nomGroupe']) && isset($_POST['groupePere']))
	{

		$nomGroupe = $_POST['nomGroupe'];
		$nomPere   = $_POST['groupePere'];
		$db->insertGroupe($nomGroupe, $nomPere);
		echo 'le groupe est crée';		
	}
	
?>