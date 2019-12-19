<?php

require 'Groupe.inc.php';
require 'Modules.inc.php';
require 'Affectation.inc.php';
require 'Utilisateur.inc.php';

class DB {
    private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
    private $connect=null; //connexion PDO à la base

    /************************************************************************/
    //	Constructeur gerant  la connexion à la base via PDO
    //	NB : il est non utilisable a l'exterieur de la classe DB
    /************************************************************************/
    private function __construct() {
        // Connexion à la base de données
        $connStr = 'pgsql:host=platea.moe port=5432 dbname=diskus'; // A MODIFIER !
        try {
            // Connexion à la base
            $this->connect = new PDO($connStr, 'diskus', 'tutorat_diskusapp'); //A MODIFIER !
            // Configuration facultative de la connexion
            $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo "probleme de connexion :".$e->getMessage();
            return null;
        }
    }

    /************************************************************************/
    //	Methode permettant d'obtenir un objet instance de DB
    //	NB : cet objet est unique pour l'exécution d'un même script PHP
    //	NB2: c'est une methode de classe.
    /************************************************************************/
    public static function getInstance() {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new DB();
            }
            catch (PDOException $e) {
                echo $e;
            }
        } //fin IF
        $obj = self::$instance;

        if (($obj->connect) == null) {
            self::$instance=null;
        }
        return self::$instance;
    } //fin getInstance

    /************************************************************************/
    //	Methode permettant de fermer la connexion a la base de données
    /************************************************************************/
    public function close() {
        $this->connect = null;
    }

    /************************************************************************/
    //	Methode uniquement utilisable dans les méthodes de la class DB
    //	permettant d'exécuter n'importe quelle requête SQL
    //	et renvoyant en résultat les tuples renvoyés par la requête
    //	sous forme d'un tableau d'objets
    //	param1 : texte de la requête à exécuter (éventuellement paramétrée)
    //	param2 : tableau des valeurs permettant d'instancier les paramètres de la requête
    //	NB : si la requête n'est pas paramétrée alors ce paramètre doit valoir null.
    //	param3 : nom de la classe devant être utilisée pour créer les objets qui vont
    //	représenter les différents tuples.
    //	NB : cette classe doit avoir des attributs qui portent le même que les attributs
    //	de la requête exécutée.
    //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
    //	que d'éléments dans le tableau passé en second paramètre.
    //	NB : si la requête ne renvoie aucun tuple alors la fonction renvoie un tableau vide
    /****************+********************************************************/
    private function execQuery($requete,$tparam,$nomClasse) {
        //on prépare la requête
        $stmt = $this->connect->prepare($requete);
        //on indique que l'on va récupére les tuples sous forme d'objets instance de Client
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse);
        //on exécute la requête
        if ($tparam != null) {
            $stmt->execute($tparam);
        }
        else {
            $stmt->execute();
        }
        //récupération du résultat de la requête sous forme d'un tableau d'objets
        $tab = array();
        $tuple = $stmt->fetch(); //on récupère le premier tuple sous forme d'objet
        if ($tuple) {
            //au moins un tuple a été renvoyé
            while ($tuple != false) {
                $tab[]=$tuple; //on ajoute l'objet en fin de tableau
                $tuple = $stmt->fetch(); //on récupère un tuple sous la forme
                //d'un objet instance de la classe $nomClasse
            } //fin du while
        }
        return $tab;
    }

    /************************************************************************/
    //	Methode utilisable uniquement dans les méthodes de la classe DB
    //	permettant d'exécuter n'importe quel ordre SQL (update, delete ou insert)
    //	autre qu'une requête.
    //	Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL
    //	param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré)
    //	param2 : tableau des valeurs permettant d'instancier les paramètres de l'ordre SQL
    //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
    //	que d'éléments dans le tableau passé en second paramètre.
    /************************************************************************/
    private function execMaj($ordreSQL,$tparam) {
        $stmt = $this->connect->prepare($ordreSQL);
        $res = $stmt->execute($tparam); //execution de l'ordre SQL
        return $stmt->rowCount();
    }

    /*************************************************************************
     * Fonctions qui peuvent être utilisées dans les scripts PHP
     *************************************************************************/

    //Gestion des utilisateurs

    // TODO: Retourner un objet utilisateur et pas un tableau
    public function getAllUtilisateur(){
        $requete = 'select * from utilisateur';
        return $this->execQuery($requete,null,'Utilisateur');
    }
    
    public function getUtilisateur($id) {
        $requete = 'select * from utilisateur where id_utilisateur = ?';
        return $this->execQuery($requete,array($id),'Utilisateur');
    }

    public function getUtilisateurNom($nom) {
        $requete = 'select * from utilisateur where nom = ?';
        return $this->execQuery($requete,array($nom),'Utilisateur');
    }

    public function getUtilisateurPrenom($prenom) {
        $requete = 'select * from utilisateur where prenom = ?';
        return $this->execQuery($requete,array($prenom),'Utilisateur');
    }

    public function insertUtilisateur($id_utilisateur,$nom,$prenom,$mdp,$role,$groupe) {
        $requete = 'insert into utilisateur values(?,?,?,?,?,?,now(),now())';
        $tparam = array($id_utilisateur,$nom,$prenom,$mdp,$role,$groupe);
        return $this->execQuery($requete,$tparam,"Utilisateur");
    }

    /*public function updateUtilisateur($id,$colonne,$valeur)
    {
        $requete = "update utilisateur set $colonne = ? where id_utilisateur = ?";
        $tparam = array($valeur,$id);
        return $this->execMaj($requete,$tparam);
    }*/

    public function updateUtilisateur($oldId,$id,$nom,$prenom,$mdp,$role,$groupe)
    {
        $requete = "update utilisateur set id_utilisateur = ?, nom= ?, prenom=?,mdp=?,role=?,groupe=? where id_utilisateur = ?";
        $tparam = array($id,$nom,$prenom,$mdp,$role,$groupe,$oldId);
        return $this->execMaj($requete,$tparam);
    }

    //TODO: A voir pour remplacer avec un trieur


    public function deleteUtilisateur($id) {
        $requete = 'delete from utilisateur where id_utilisateur = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des modules

    public function getModule($id) {
        $requete = 'select * from modules where id_module = ?';
        return $this->execQuery($requete,array($id),'Modules');
    }

    public function insertModule($id_module,$valeur,$libelle,$couleur,$droit) {
        $requete = 'insert into modules values(?,?,?,?,?)';
        $tparam = array($id_module,$valeur,$libelle,$couleur,$droit);
        return $this->execQuery($requete,$tparam);
    }

    public function deleteModule($id) {
        $requete = 'delete from modules where id_module = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Groupe

    public function getGroupe($grp) {
        $requete = 'select * from groupe where groupe.groupe = ?';
        return $this->execQuery($requete,array($grp),'Groupe');
    }

    public function getGroupes()
    {
        $requete = 'Select * from Groupe';
        return $this->execQuery($requete,null, 'Groupe');
    }

    public function insertGroupe($groupe,$groupePere) {
        $requete = 'insert into groupe values(?,?)';
        $tparam = array($groupe,$groupePere);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteGroupe($grp) {
        $requete = 'delete from groupe where groupe.groupe = ?';
        $tparam = array($grp);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Affectations

    public function getAffectation($id) {
        $requete = 'select * from affectation where id_utilisateur = ?';
        return $this->execQuery($requete,array($id),'Affectation');
    }

    public function insertAffectation($id,$mod) {

        $requete = 'insert into affectation values (?,?)';
        $tparam = array($id,$mod);
        return $this->execQuery($requete,$tparam);
    }

    public function deleteAffectation($id) {
        $requete = 'delete from affectation where id_utilisateur = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }



} //fin classe DB

?>
