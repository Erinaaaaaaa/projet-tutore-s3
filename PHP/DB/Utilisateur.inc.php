<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Utilisateur {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $mdp;
    private $role;
    private $groupe;
    private $cree_le;
    private $maj_le;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_utilisateur
     * @param $nom
     * @param $prenom
     * @param $mdp
     * @param $role
     * @param $groupe
     * @param $cree_le
     * @param $maj_le
     */
    public function __construct($id_utilisateur="", $nom="", $prenom="", $mdp="", $role="", $groupe="", $cree_le="", $maj_le="")
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
        $this->role = $role;
        $this->groupe = $groupe;
        $this->cree_le = $cree_le;
        $this->maj_le = $maj_le;
    }

    public function getIdUtilisateur() { return $this->id_utilisateur; }
    public function getPrenom() { return $this->prenom; }
    public function getMdp() { return $this->mdp; }
    public function getRole() { return $this->role; }
    public function getGroupe() { return $this->groupe; }
    public function getCreeLe() { return $this->cree_le; }
    public function getMajLe() { return $this->maj_le; }



    public function __toString() {
        $res = "id_utilisateur:".$this->id_utilisateur."\n";
        $res = $res ."nom:".$this->nom."\n";
        $res = $res ."prenom:".$this->prenom."\n";
        $res = $res ."mdp:".$this->mdp."\n";
        $res = $res ."role:".$this->role."\n";
        $res = $res ."groupe:".$this->groupe."\n";
        $res = $res ."cree_le:".$this->cree_le."\n";
        $res = $res ."maj_le:".$this->maj_le."\n";
        $res = $res ."<br/>";
        return $res;

    }
}

?>
