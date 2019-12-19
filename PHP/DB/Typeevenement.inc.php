<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Typeevenement {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_typeevenement;
    private $libelle;
    private $roles;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_typeevenement
     * @param $libelle
     * @param $roles
     */
    public function __construct($id_typeevenement="", $libelle="", $roles="")
    {
        $this->id_typeevenement = $id_typeevenement;
        $this->libelle = $libelle;
        $this->roles = $roles;
    }

    public function getIdTypeEvenement() { return $this->id_typeevenement; }
    public function getLibelle() { return $this->libelle; }
    public function getRoles() { return $this->roles; }



    public function __toString() {
        $res = "id_typesevenement:".$this->id_typeevenement."\n";
        $res = $res ."libelle:".$this->libelle."\n";
        $res = $res ."roles:".$this->roles."\n";
        return $res;

    }
}

?>