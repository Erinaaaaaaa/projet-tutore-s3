<?php

//Creation date
/*$test2 = new DateTime('09/01/2019');
echo 'creation: ';
echo date_format($test2, 'd-m-Y');*/

$datemin = new DateTime('09/01');
$Min = date_format($datemin, 'd-m-Y');
echo date_format($datemin, 'd-m-Y');
echo '<br>';
/*$datemax = strtotime("+13 day +10 month", strtotime(date(date_format($datemin, 'd-m-Y'));
echo date('d-m-Y', $datemax);*/

$datemax = new DateTime('06/30');
echo date_format($datemax, 'd-m-Y');
/*$jour    = date('D');
$numJour = date('j');
$numMois = date('m');
$annee   = date('Y');
$JourS  = strtotime("+1 day", strtotime(date('d')));
$MoisS  = strtotime("+1 month", strtotime(date('d-m-Y')));
$AnneeS = strtotime("+1 year", strtotime(date('Y')));
$test1  = strtotime("+1 day +1 month +1 year", strtotime(date('Y')));
$dateMin = strtotime("-16 day -3 month", strtotime(date('Y')));
echo date('Y-m-d', $dateMin);

echo date('Y-m-d', $test1);
echo date('d', $JourS);
echo date('m', $MoisS);
echo date('Y', $AnneeS);
echo '<br>';

$date = date(date('d', $JourS).date('m', $MoisS).date('Y', $AnneeS));
echo date('Y-m-d', $JourS);
echo '<br>';
echo date('Y-m-d', $MoisS);
echo '<br>';
echo date('Y-m-d', $AnneeS);*/
?>