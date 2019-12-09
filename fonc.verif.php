<?php
	function IS_LOGIN_OK($login)
	{
		return $login == "ft182806";
	}

	function IS_PWD_OK($login, $mdp)
	{
		return ($login == "ft182806" && $mdp == "31032000");
	}


?>