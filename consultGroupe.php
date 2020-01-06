<style>
    table * {
        border-collapse: collapse;
        border: 1px solid silver;
    }
</style>

<?php

$connStr = 'pgsql:host=diskus.top port=5432 dbname=diskus'; 

$pdo = new PDO($connStr, "diskus","tutorat_diskusapp");

$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

$requete = "select * from groupe";

echo "<table>";
foreach ($pdo->query($requete) as $row)
{
    ?>
        <tr>
            <td><?php echo $row['groupe'] ?></td>
            <td><?php echo $row['groupepere'] ?></td>
        </tr>
    <?php
}
echo '</table>';

?>