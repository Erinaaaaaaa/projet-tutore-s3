<?php
	function IS_LOGIN_OK($login)
	{
		return $login == "ft182806" || $login == "admin" || $login == "prof" || $login == "tuteur";
	}

	function IS_PWD_OK($login, $mdp)
	{
		return ($login == "ft182806" && $mdp == "31032000") || 
			   ($login == "admin"    && $mdp == "admin"   ) || 
			   ($login == "prof"     && $mdp == "prof"    ) || 
			   ($login == "tuteur"   && $mdp == "tuteur"  );
	}


?>