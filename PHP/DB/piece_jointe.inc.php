<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class piece_jointe {

    private $id;
    private $nom_fichier;
    private $chemin;
    private $evenement;


    /**
     * Seance constructor.
     * @param $id
     * @param $nom_fichier
     * @param $chemin
     * @param $evenement
     */
    public function __construct($id, $nom_fichier, $chemin, $evenement)
    {
        $this->id = $id;
        $this->nom_fichier = $nom_fichier;
        $this->chemin = $chemin;
        $this->evenement = $evenement;
    }

    public function getId(){return $this->id;}
    public function getNomFichier(){return $this->nom_fichier;}
    public function getChemin(){return $this->chemin;}
    public function getEvenement(){return $this->evenement;}



}
?>
