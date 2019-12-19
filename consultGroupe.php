
<?php

include "foncAux.inc.php";
$connStr = 'pgsql:host=diskus.top port=5432 dbname=diskus'; 
page_header();


try {


$pdo = new PDO($connStr, 'diskus', 'tutorat_diskusapp', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$stmt = $pdo->prepare($requete); 
$stmt ->execute(); 

$requete = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where table_name='Groupe'; ";
$stmt2 = $pdo->prepare($requete);
$stmt2 ->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rkey = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$nbtuples = count($result);

echo "<table style =\" border: solid black 1px\">";

foreach ($result as $tuple) 
{
	echo"<tr>";
	foreach ($tuple as $key => $value)
    {
		echo "<td>$value</td>";
	}
	echo"</tr>";

}
echo "</table>";

}
catch (PDOException $e) {
	echo "probleme de connexion :".$e->getMessage();    
}

$pdo = null; //fermeture de la connexion

page_footer();
?>