<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Typeseance {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_typeseance;
    private $libelle;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_typeseance
     * @param $libelle
     */
    public function __construct($id_typeseance="", $libelle="")
    {
        $this->id_typeseance = $id_typeseance;
        $this->libelle = $libelle;
    }

    public function getIdTypeSeance() { return $this->id_typeseance; }
    public function getLibelle() { return $this->libelle; }



    public function __toString() {
        $res = "id_typeseance:".$this->id_typeseance."\n";
        $res = $res ."libelle:".$this->libelle."\n";
        return $res;

    }
}