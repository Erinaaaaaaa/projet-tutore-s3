<?php
$dateMin = new DateTime('09/01');

$crea = getDateCrea()

list($month, $day, $year) = split('-', $crea);
echo $year
$dateMax = new DateTime('06/30');
$dateMax->add(new DateInterval('P1Y'));
?>