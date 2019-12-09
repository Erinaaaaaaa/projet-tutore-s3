<?php
	include "fonc.verif.php";

	
	
	if(IS_LOGIN_OK($_REQUEST['login']) && IS_PWD_OK( $_REQUEST['login'], $_REQUEST['mdp']))
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=accueil.php\">";
	}

	if((empty($_REQUEST['login']) && empty($_REQUEST['mdp'])))
	{
		echo 'Entrez une valeur dans chaque rubrique';
	} 
	else{
		if(!IS_LOGIN_OK($_REQUEST['login']) || !IS_PWD_OK($_REQUEST['login'],$_REQUEST['mdp']))
		{
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