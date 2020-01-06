<?php

/*classe permettant de representer les tuples de la table Utilisateur */
class Semaphore {
    /*avec PDO, il faut que les noms attributs soient les mêmes que ceux de la table*/
    private $id_seance;
    private $id_utilisateur;
	private $etat;


    /* Les méthodes qui commencent par __ sont des methodes magiques */
    /* Elles sont appelées automatiquement par php suite à certains événements. */
    /* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
    /* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
         il y aura une erreur lorsqu'il sera appelé automatiquement par PDO
     */
    /**
     * Utilisateur constructor.
     * @param $id_seance
     * @param $id_utilisateur
 	 * @param $etat
     */
    public function __construct($id_seance="", $id_utilisateur="", $etat="")
    {
        $this->id_seance = $id_seance;
        $this->id_utilisateur = $id_utilisateur;
		$this->etat = $etat;
    }

    public function getIdSeance() { return $this->id_seance; }
    public function getIdUtilisateur() { return $this->id_utilisateur; }
	public function getEtat() { return $this->etat; }



    public function __toString() {
        $res = "id_seance:".$this->id_seance."\n";
        $res = $res ."id_utilisateur:".$this->id_utilisateur."\n";
		$res = $res ."etat:".$this->etat."\n";
        return $res;

    }
}
