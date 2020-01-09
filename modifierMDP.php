<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php"); die();
}

require_once("PHP/fonctions/func.users.php");
require_once("PHP/Twig/lib/Twig/Autoloader.php");

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl"));
$tpl = $twig->resolveTemplate( "profil.twig" );

$db = DB::getInstance();

$login = $_SESSION['login'];
$user = getUtilisateur($login);

$erreur = "";

if (isset($_POST['oldPass']) && isset($_POST['newPass1']) && isset($_POST['newPass2']))
{
	if ($_POST['oldPass']!="" && $_POST['newPass1']!="" && $_POST['newPass2']!="") 
	{
		if (!password_verify($_POST['oldPass'], $user->getMdp()))
		{
			$erreur = "Ancien mot de passe incorrect";
		}
		else
		{
			if (strcmp($_POST['newPass1'],$_POST['newPass2']) === 0)
			{
				$cptMin = 0;
				$cptMaj = 0;
				$cptOth = 0;
				
				if(strlen($_POST['newPass1']) >= 8)
				{

					$str = $_POST['newPass1'];
					for ($i=0; $i < strlen($str); $i++) { 
						if (ctype_alpha($str[$i]) && ctype_upper($str[$i]))
						{
							$cptMaj++;
						}
						else if(ctype_alpha($str[$i]) && ctype_lower($str[$i]))
						{
							$cptMin++;
						}
						else
						{
							$cptOth++;
						}
					}
				}
				if($cptMin >=2 && $cptMaj>=2 && $cptOth>=2)
				{
					$db -> updateMdpUtilisateur($_SESSION['login'], password_hash($_POST['newPass1'], PASSWORD_DEFAULT));
					header("Location: parametrage.php");
				}
			}
			else
			{
				$erreur = "Le champ de confirmation et le nouveau mot de passe ne correspondent pas";
			}
		}
	}
	else
	{
		$erreur = "Tous les champs sont obligatoires";
	}
}
echo $tpl->render( array(/*"user"=>$user,*/ "titre"=>"Modifier mot de passe",
	    "options"=>array(
	        array(
	            "nom"=>"Ajouter",
	        ),
	        array(
	            "nom"=>"Etat",
	            "url"=>"https://www.ebay.com/p/1942719?iid=182754789929"
	        )),
	     "erreur"=>$erreur
	));


