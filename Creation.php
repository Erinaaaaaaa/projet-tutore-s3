<?php
	

	if(!empty($_REQUEST['id']) && !empty($_REQUEST['nom']) && !empty($_REQUEST['prenom']) && !empty($_REQUEST['mdp']) && !empty($_REQUEST['groupe']) )
	{
		$id       = $_REQUEST[  'id'  ];
		$nom      = $_REQUEST[  'nom' ];
		$prenom   = $_REQUEST['prenom'];
		$groupe   = $_REQUEST['groupe'];
		echo 'tous les champs sont ok';
		
	}
	else
	{
		echo 'Veuillez entrer une valeur dans chaque rubrique';
		echo "<meta http-equiv=\"refresh\" content=\"2;url=inscription.php\">";
	}
?>