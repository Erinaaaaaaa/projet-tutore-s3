<?php

if (!isset($_SESSION)) session_start();

// Définir la racine
define('ROOT_PATH', realpath(__DIR__)."/");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['login']))
    include "accueil.inc.php";
else
    include "login.inc.php";


