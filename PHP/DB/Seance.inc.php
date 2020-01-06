<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Seance {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_seance;
    private $module;
    private $date_creation;
	private $date_modif;
    private $type;
    private $groupe;
    private $id_utilisateur;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_seance
     * @param $module
     * @param $date_creation
     * @param $type
     * @param $groupe
     * @param $id_utilisateur
     */
    public function __construct($id_seance="", $module="", $date_creation="", $date_modif="", $type="", $groupe="", $id_utilisateur="")
    {
        $this->id_seance = $id_seance;
        $this->module = $module;
        $this->date_creation = $date_creation;
		$this->date_modif = $date_modif;
        $this->type = $type;
        $this->groupe = $groupe;
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getIdSeance() { return $this->id_seance; }
    public function getModule() { return $this->module; }
    public function getDateCreation() { return $this->date_creation; }
	public function getDateModif() { return $this->date_modif; }
    public function getType() { return $this->type; }
    public function getGroupe() { return $this->groupe; }
    public function getIdUtilisateur() { return $this->id_utilisateur; }



    public function __toString() {
        $res = "id_seance:".$this->id_seance."\n";
        $res = $res ."module:".$this->module."\n";
        $res = $res ."date_creation:".$this->date_creation."\n";
        $res = $res ."type:".$this->type."\n";
        $res = $res ."groupe:".$this->groupe."\n";
        $res = $res ."id_utilisateur:".$this->id_utilisateur."\n";
        $res = $res ."<br/>";
        return $res;

    }
}

?>
