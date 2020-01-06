<?php

// TODO: doc

require_once "PHP/DB/DB.inc.php";

function getTypesSeance() {
    try {
        return DB::getInstance()->getTypesSeance();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getTypeSeance(int $id) {
    try {
        return DB::getInstance()->getTypeSeance($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return null;
    }
}

function insertTypeSeance(string $libelle) {
    try {
        DB::getInstance()->insertTypeSeance($libelle);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

function deleteTypeSeance(int $id) {
    try {
        DB::getInstance()->deleteTypeSeance($id);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}