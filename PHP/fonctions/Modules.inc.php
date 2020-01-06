<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Modules {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_module;
    private $libelle;
    private $couleur;
    private $droit;
    private $date_ajout;
    private $date_modif;

    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Modules constructor.
     * @param $id_module
     * @param $libelle
     * @param $couleur
     * @param $droit
     * @param $date_ajout
     * @param $date_modif
     */
    public function __construct($id_module="", $valeur="", $libelle="", $couleur="", $droit="", $date_ajout="", $date_modif="")
    {
        $this->id_module = $id_module;
        $this->libelle = $libelle;
        $this->couleur = $couleur;
        $this->droit = $droit;
        $this->date_ajout = $date_ajout;
        $this->date_modif = $date_modif;
    }
    public function getIdModule(){return $this->id_module;}
    public function getLibelle(){return $this->libelle;}
    public function getCouleur(){return $this->couleur;}
    public function getDroit(){return $this->droit;}
    public function getDateAjout(){return $this->date_ajout;}
    public function getDateModif(){return $this->date_modif;}


    public function __toString() {
        $res = "id_module:".$this->id_module."\n";
        $res = $res ."libelle:".$this->libelle."\n";
        $res = $res ."couleur:".$this->couleur."\n";
        $res = $res ."droit:".$this->droit."\n";
        $res = $res ."date d'ajout:".$this->date_ajout."\n";
        $res = $res ."date de modification:".$this->date_modif."\n";
        $res = $res ."<br/>";
        return $res;
    }
}

?>
