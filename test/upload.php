<?php

header("Content-Type: text/plain");

// PRÉREQUIS POUR WOODY: chmod -R 777 public_html
// (Généralement le 777 est pas recommandé mais bon avec woody...)

// Récupérer le chemin d'un dossier "uploaded" dans le dossier courant
list($scriptPath) = get_included_files();
$folder = pathinfo($scriptPath, PATHINFO_DIRNAME)."/uploaded";

if ($_SERVER['REQUEST_METHOD'] != 'POST') die();

// Dépacer le fichier dans le dossier uploaded
move_uploaded_file($_FILES["file"]["tmp_name"], "$folder/".$_FILES["file"]["name"]);