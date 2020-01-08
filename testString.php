<?php
	$str = 'aaBC?:tAvfsb<A';
	
	$cptMin = 0;
	$cptMaj = 0;
	$cptOth = 0;

	if(strlen($str) > 8)
	{
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

	echo $cptMin.' minuscules '.$cptMaj.' majuscules et'.$cptOth.' autre(s) caractère(s)';
?>