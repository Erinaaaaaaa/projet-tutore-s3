<?php

require_once "models/Affectation.php";
require_once "models/EtatSemaphore.php";
require_once "models/Evenement.php";
require_once "models/Groupe.php";
require_once "models/PieceJointe.php";
require_once "models/Module.php";
require_once "models/Seance.php";
require_once "models/Semaphore.php";
require_once "models/TypeEvenement.php";
require_once "models/TypeSeance.php";
require_once "models/Utilisateur.php";

class DB
{
    /**
     * @var PDO Objet maintenant la connexion à la base de données.
     */
    private $pdo = null;

    /**
     * @var DB Singleton de l'objet DB
     */
    private static $db = null;

    /**
     * Obtient une instance de la classe DB
     * @return DB une instance de la classe DB
     */
    public static function getInstance()
    {
        if (is_null(DB::$db))
            self::$db = new DB();

        return DB::$db;
    }

    /**
     * DB constructor.
     */
    private function __construct()
    {
        // CONSTANTES DE CONNEXION
        $hostname = "diskus.top";
        $port = 5432;

        $dbName = "diskus2";
        $username = "diskus2";
        $password = "diskus2";

        $this->pdo = new PDO("pgsql:host=$hostname port=$port dbname=$dbName", $username, $password);

        $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    private function query($requete, $param, $nomClasse)
    {
        $req = $this->pdo->prepare($requete);
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse);

        if (is_null($param))
            $req->execute();
        else
            $req->execute($param);

        $tab = [];

        while ($tuple = $req->fetch())
            $tab[] = $tuple;

        return $tab;
    }

    private function update($ordre, $param)
    {
        $req = $this->pdo->prepare($ordre);
        $res = $req->execute($param); //execution de l'ordre SQL
        return $req->rowCount();
    }

    // METHODES PUBLIQUES

    // ===== UTILISATEURS =====

    public function getUtilisateurs()
    {
        return $this->query("SELECT * FROM Utilisateur", null, Utilisateur::class);
    }

    /**
     * Récupère un utilisateur de la base de données.
     * @param string $login Identifiant de l'utilisateur
     * @return Utilisateur|null Utilisateur correspondant s'il existe.
     */
    public function getUtilisateur($login)
    {
        $results = $this->query("SELECT * FROM Utilisateur WHERE Id = ?",
            array($login), Utilisateur::class);

        if (sizeof($results) == 1) return $results[0];
        else return null;
    }

    public function addUtilisateur($id,$nom,$prenom,$mdp,$role,$groupe)
    {
        return $this->update("INSERT INTO Utilisateur (Id, Mdp, Nom, Prenom, Roles, Groupes) VALUES (?,?,?,?,?,?)",
                array($id,$mdp,$nom,$prenom,$role,$groupe)) > 0;
    }

    public function updateUtilisateur($oldId,$id,$nom,$prenom,$mdp,$role,$groupe)
    {
        return $this->update("UPDATE Utilisateur SET Id = ?, Nom = ?, Prenom = ?, Mdp = ?, Roles = ?, Groupes = ? WHERE Id = ?",
                array($id,$nom,$prenom,$mdp,$role,$groupe,$oldId)) > 0;
    }

    public function deleteUtilisateur($id)
    {
        return $this->update("DELETE FROM Utilisateur WHERE Id = ?", array($id)) > 0;
    }

    // ===== GROUPES =====

    /**
     * @return array Obtenir tous les groupes présents dans la base
     */
    public function getGroupes()
    {
        return $this->query("SELECT * FROM Groupe", null, Groupe::class);
    }

    public function getGroupe($nom)
    {
        $results = $this->query("SELECT * FROM Groupe WHERE Nom = ?",
            array($nom), Groupe::class);

        if (sizeof($results) == 1) return $results[0];
        else return null;
    }

    public function addGroupe($nom, $pere)
    {
        return $this->update("INSERT INTO Groupe VALUES (?, ?)", array($nom, $pere)) > 0;
    }

    public function updateGroupe($nom, $pere, $ancienNom)
    {
        return $this->update("UPDATE Groupe SET Nom = ?, Pere = ? WHERE Nom = ?",
            array($nom, $pere, $ancienNom)) > 0;
    }

    /**
     * Supprime un groupe et ses fils.
     * @param $id string Nom du groupe à supprimer
     * @return bool Vrai si une ligne a été supprimée.
     */
    public function deleteGroupe($id)
    {
        return $this->update("DELETE FROM Groupe WHERE Nom = ? ", array($id)) > 0;
    }

    // ===== MODULES =====

    public function getModules()
    {
        return $this->query("SELECT * FROM Module", null, Module::class);
    }

    // ===== AFFECTATIONS =====

    public function getAffectations()
    {
        return $this->query("SELECT * FROM Affectation", null, Affectation::class);
    }

    public function addAffectation($user, $module)
    {
        return $this->update("INSERT INTO Affectation VALUES (?, ?)", array($user, $module)) > 0;
    }

    public function deleteAffectation($utilisateur, $module)
    {
        return $this->update("DELETE FROM Affectation WHERE Utilisateur = ? AND Module = ?",
            array($utilisateur, $module)) > 0;
    }

    // ===== SEANCES =====

    public function getSeance($id)
    {
        if (empty($id)) return null;

        $results = $this->query("SELECT * FROM Seance WHERE Id = ?",
            array($id), Seance::class);

        if (sizeof($results) == 1) return $results[0];
        else return null;
    }

    public function getSeances()
    {
        return $this->query("SELECT * FROM Seance", null, Seance::class);
    }

    public function addSeance($module, $date, $type, $groupe, $utilisateur)
    {
        return $this->update("INSERT INTO Seance(module, date, type, groupe, utilisateur) VALUES (?,?,?,?,?)",
            array($module, $date, $type, $groupe, $utilisateur)) > 0;
    }

    // TODO: Ajouter trigger pour date de modification
    public function updateSeance($id, $module, $date, $type, $groupe)
    {
        return $this->update("UPDATE Seance SET Module = ?, Date = ?, Type = ?, Groupe = ? WHERE Id = ?",
            array($module, $date, $type, $groupe, $id)) > 0;
    }

    public function deleteSeance($id)
    {
        return $this->update("DELETE FROM Seance WHERE Id = ?", array($id)) > 0;
    }

    // ===== TYPES SEANCE =====

    public function getTypesSeance()
    {
        return $this->query("SELECT * FROM Type_Seance", null, TypeSeance::class);
    }
}