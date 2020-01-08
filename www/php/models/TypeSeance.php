<?php


class TypeSeance
{
    // Attributs pour PDO
    private $id;
    private $libelle;
    private $actif;

    /**
     * TypeSeance constructor.
     * @param $id
     * @param $libelle
     * @param $actif
     */
    public function __construct($id=-1, $libelle="", $actif=false)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->actif = $actif;
    }

    public function getId(){return $this->id;}
    public function getLibelle(){return $this->libelle;}
    public function estActif(){return $this->actif;}

}