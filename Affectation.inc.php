<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Affectation {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_utilisateur;
    private $id_module;

    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Affectation constructor.
     * @param $id_utilisateur
     * @param $id_module
     */
    public function __construct($id_utilisateur="", $id_module="")
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->id_module = $id_module;
    }
    public function getIdUtilisateur(){return $this->id_utilisateur;}
    public function getIdModule(){return $this->id_module;}




    public function __toString() {
        $res = "id_utilisateur:".$this->id_utilisateur."\n";
        $res = $res ."id_module:".$this->id_module."\n";
        $res = $res ."<br/>";
        return $res;
    }
}

?>
