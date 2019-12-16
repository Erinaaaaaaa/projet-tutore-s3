<?php
	include "fonc.verif.php";

	
	
	if(IS_LOGIN_OK($_REQUEST['login']) && IS_PWD_OK( $_REQUEST['login'], $_REQUEST['mdp']))
	{
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		// $_SESSION[ 'mdp' ] = $_REQUEST[ 'mdp' ];
		echo $_SESSION['login'];

		echo "<meta http-equiv=\"refresh\" content=\"5;url=accueil.php\">";
	}

	if((empty($_REQUEST['login']) && empty($_REQUEST['mdp'])))
	{
		echo "<meta http-equiv=\"refresh\" content=\"5;url=index.html\">";
		echo 'Entrez une valeur dans chaque rubrique';
	} 
	else{
		if(!IS_LOGIN_OK($_REQUEST['login']) || !IS_PWD_OK($_REQUEST['login'],$_REQUEST['mdp']))
		{
			echo "<meta http-equiv=\"refresh\" content=\"5;url=index.html;\">";
			if(!IS_LOGIN_OK($_REQUEST['login']) && !empty($_REQUEST['login']))
			{
				echo 'Login erroné';
			}
			else if(IS_LOGIN_OK($_REQUEST['login']) && !IS_PWD_OK($_REQUEST['login'], $_REQUEST['mdp']) && empty($_REQUEST['mdp']))
			{
				echo 'Veuillez entrer un mot de passe';
			} 
				
			else if((IS_LOGIN_OK($_REQUEST['login'] && !IS_PWD_OK($_REQUEST['login'], $_REQUEST['mdp'])) && !empty($_REQUEST['mdp'])))
			{
				echo 'Mot de passe incorrect';
			}
		
		}
	}


?>