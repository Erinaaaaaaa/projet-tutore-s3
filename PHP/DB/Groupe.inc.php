<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Groupe {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $groupe;
    private $groupePere;

    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Groupe constructor.
     * @param $groupe
     * @param $groupePere
     */
    public function __construct($groupe="", $groupePere="")
    {
        $this->groupe = $groupe;
        $this->groupePere = $groupePere;
    }
    
    public function getGroupe(){return $this->groupe;}
    public function getGroupePere(){return $this->groupePere;}


    public function __toString() {
        $res = "groupe:".$this->groupe."\n";
        $res = $res ."groupePere:".$this->groupePere."\n";
        $res = $res ."<br/>";
        return $res;
    }
}

?>
