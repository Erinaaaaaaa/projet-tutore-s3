<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Evenement {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_evenement;
    private $categorie;
    private $description;
    private $temps;
    private $pour_le;
    private $id_seance;

    public $nom_type;
    public $pj;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_evenement
     * @param $categorie
     * @param $description
	 * @param $pj
     * @param $temps
     * @param $pour_le
     * @param $id_seance
     */
    public function __construct($id_evenement="", $categorie="", $description="", $pj="", $temps="", $pour_le="", $id_seance="")
    {
        $this->id_evenement = $id_evenement;
        $this->categorie = $categorie;
        $this->description = $description;
		$this->pj = $pj;
        $this->temps = $temps;
        $this->pour_le = $pour_le;
        $this->id_seance = $id_seance;
    }

    public function getIdEvenement() { return $this->id_evenement; }
    public function getCategorie() { return $this->categorie; }
    public function getDescription() { return $this->description; }
	public function getPj() { return $this->pj; }
    public function getTemps() { return $this->temps; }
    public function getPourLe() { return $this->pour_le; }
    public function getIdSeance() { return $this->id_seance; }



    public function __toString() {
        $res = "id_evenement:".$this->id_evenement."\n";
        $res = $res ."categorie:".$this->categorie."\n";
        $res = $res ."description:".$this->description."\n";
		$res = $res ."Pièces jointes:".$this->pj."\n";
        $res = $res ."temps:".$this->temps."\n";
        $res = $res ."pour_le:".$this->pour_le."\n";
        $res = $res ."id_seance:".$this->id_seance."\n";
        $res = $res ."<br/>";
        return $res;

    }
}

?>
