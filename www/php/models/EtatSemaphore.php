<?php


class EtatSemaphore
{
    // Attributs pour PDO
    private $utilisateur;
    private $seance;
    private $etat;

    public function __construct($utilisateur = "", $seance = -1, $etat = -1)
    {
        $this->utilisateur = $utilisateur;
        $this->seance = $seance;
        $this->etat = $etat;
    }

    public function getUtilisateur(){return $this->utilisateur;}
    public function getSeance(){return $this->seance;}
    public function getEtat(){return $this->etat;}
}