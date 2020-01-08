<?php


class Module
{
    // Attributs pour PDO
    private $code;
    private $libelle;
    private $couleur;
    private $date_creation;
    private $date_modification;

    /**
     * Modules constructor.
     * @param $code
     * @param $libelle
     * @param $couleur
     * @param $date_creation
     * @param $date_modification
     */
    public function __construct($code="", $libelle="", $couleur="", $date_creation=null, $date_modification=null)
    {
        $this->code = $code;
        $this->libelle = $libelle;
        $this->couleur = $couleur;
        $this->date_creation = $date_creation;
        $this->date_modification = $date_modification;
    }

    public function getCode(){return $this->code;}
    public function getLibelle(){return $this->libelle;}
    public function getCouleur(){return $this->couleur;}
    public function getDateCreation(){return $this->date_creation;}
    public function getDateModification(){return $this->date_modification;}



}