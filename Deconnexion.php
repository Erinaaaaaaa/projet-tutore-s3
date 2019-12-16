<?php 
	session_start();
	if(isset($_SESSION['login']) && $_POST['Deco'])
	{
		session_destroy();
		echo 'coucou';
		echo "<meta http-equiv=\"refresh\" content=\"5;url=index.html\">";
	}
	else 
	{
		echo 'oh no<br>';

	}
?>