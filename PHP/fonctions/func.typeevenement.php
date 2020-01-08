<?php 

// TODO: doc

require_once "PHP/DB/DB.inc.php";

function getTypesEvenement() {
    try {
        return DB::getInstance()->getTypesEvenement();
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getTypesEvenementRole($role) {
    try {
        return DB::getInstance()->getTypeEvenementRole($role);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return array();
    }
}

function getTypeEvenement(int $id) {
    try {
        return DB::getInstance()->getTypeEvenement($id);
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return null;
    }
}

function insertTypeEvenement(string $libelle, string $roles) {
    try {
        DB::getInstance()->addTypeEvenement($libelle, $roles);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}

function deleteTypeEvenement(int $id) {
    try {
        DB::getInstance()->deleteTypeEvenement($id);
        return true;
    } catch (PDOException $e) {
echo "exception".$e->getMessage();
        return false;
    }
}