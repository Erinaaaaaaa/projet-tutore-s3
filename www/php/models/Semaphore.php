<?php


class Semaphore
{
    // Attributs pour PDO
    private $id;
    private $libelle;

    /**
     * Semaphore constructor.
     * @param int $id
     * @param string $libelle
     */
    public function __construct($id = -1, $libelle = "")
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    public function getId(){return $this->id;}
    public function getLibelle(){return $this->libelle;}
}