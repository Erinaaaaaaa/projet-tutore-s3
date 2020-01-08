<?php

require 'Groupe.inc.php';
require 'Module.inc.php';
require 'Affectation.inc.php';
require 'Utilisateur.inc.php';
require 'Seance.inc.php';
require 'Evenement.inc.php';
require 'Typeseance.inc.php';
require 'Typeevenement.inc.php';
require 'Semaphore.inc.php';

class DB {
    private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
    private $connect=null; //connexion PDO à la base

    /************************************************************************/
    //	Constructeur gerant  la connexion à la base via PDO
    //	NB : il est non utilisable a l'exterieur de la classe DB
    /************************************************************************/
    private function __construct() {
        // Connexion à la base de données
        $connStr = 'pgsql:host=diskus.top port=5432 dbname=diskus'; // A MODIFIER !
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


    public function utilisateurExiste($id) {
        return $this->getUtilisateur($id) != null;
    }

    public function getUtilisateurs(){
        $requete = 'select * from utilisateur';
        return $this->execQuery($requete,null,'Utilisateur');
    }

    public function getUtilisateur($id) {
        $requete = 'select * from utilisateur where id_utilisateur = ?';
        $tmp = $this->execQuery($requete,array($id),'Utilisateur');
        if (sizeof($tmp) == 1)
            return $tmp[0];
        else
            return null;
    }

    public function addUtilisateur($id_utilisateur, $nom, $prenom, $mdp, $role, $groupe) {
        $requete = 'insert into utilisateur values(?,?,?,?,?,?,now(),now())';
        $tparam = array($id_utilisateur,$nom,$prenom,$mdp,$role,$groupe);
        return $this->execQuery($requete,$tparam,"Utilisateur");
    }

    public function updateUtilisateur($oldId,$id,$nom,$prenom,$mdp,$role,$groupe)
    {
        $requete = "update utilisateur set id_utilisateur = ?, nom= ?, prenom=?,mdp=?,role=?,groupe=? where id_utilisateur = ?";
        $tparam = array($id,$nom,$prenom,$mdp,$role,$groupe,$oldId);
        return $this->execMaj($requete,$tparam);
    }
	
    public function updateMdpUtilisateur($id, $mdp)
    {
        $requete = "update utilisateur set mdp = ? where id_utilisateur = ?";
        $tparam = array($mdp,$id);
        return $this->execMaj($requete,$tparam);
    }
	
    //TODO: A voir pour remplacer avec un trieur
    public function getUtilisateurMdp($id, $mdp) {
        $requete = 'select * from utilisateur where id_utilisateur = ? and mdp = ?';
        $tparam = array($id, $mdp);
        return $this->execQuery($requete,$tparam,"Utilisateur");
    }

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

    public function getModules() {
        $requete = 'select * from modules;';
        return $this->execQuery($requete,array(),'Modules');
    }

    public function getModuleFromLibelle($libelle) {
        $requete = 'select * from modules where libelle = ?';
        $tparam = array($libelle);
        return $this->execQuery($requete,$tparam,'Modules');
    }

    public function addModule($id_module, $libelle, $couleur, $droit) {
        $requete = 'insert into modules values(?,?,?,?,DATE(NOW()),DATE(NOW()))';
        $tparam = array($id_module,$libelle,$couleur,$droit);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteModule($id) {
        $requete = 'delete from modules where id_module = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

    public function updateModule($maj, $col, $val, $id) {
        $requete = "update modules set date_modif = ?, $col = ? where id_module = ?";
        $tparam = array($maj, $val, $id);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Groupe

    public function getGroupes() {
        $requete = 'select * from groupe';
        return $this->execQuery($requete,null,'Groupe');
    }

    public function groupeExiste($grp) {
        return sizeof($this->getGroupe($grp)) != 0;
    }

    public function getGroupe($grp) {
        $requete = 'select * from groupe where groupe = ?';
        return $this->execQuery($requete,array($grp),'Groupe');
    }

    public function addGroupe($groupe, $groupePere) {
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

	public function getAffectations() {
        $requete = 'select * from affectation';
        return $this->execQuery($requete,null,'Affectation');
    }

	public function getAffectation($id) {
        $requete = 'select * from affectation where id_utilisateur = ?';
        return $this->execQuery($requete,array($id),'Affectation');
    }

    public function addAffectation($id, $mod) {

        $requete = 'insert into affectation values (?,?)';
        $tparam = array($id,$mod);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteAffectation($id, $idModule) {
        $requete = 'delete from affectation where id_utilisateur = ? and id_module = ?';
        $tparam = array($id, $idModule);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Seances

	public function seanceExiste($id) {
        return $this->getSeance($id) != null;
    }

	public function getDerniereSeance() {
        // Permet de récupérer le tuple complet avec le dernier ID
		$requete = 'select * from seance where id_seance = (select max(id_seance) from seance)';
        return $this->execQuery($requete,null,'Seance');
	}

	public function getSeances() {
        $requete = 'select * from seance';
        return $this->execQuery($requete,null,'Seance');
    }

	public function getSeancesForUtilisateur($utilisateur) {
        $requete = 'select * from seance where id_utilisateur = ?';
        return $this->execQuery($requete,array($utilisateur),'Seance');
    }

	public function getSeance($id_seance) {
        $requete = 'select * from seance where id_seance = ?';
        return $this->execQuery($requete,array($id_seance),'Seance');
    }

    public function addSeance($module, $date_creation, $type, $groupe, $id_utilisateur) {
		$date_modif = date("Y-m-d");
        $requete = 'insert into seance (module, date_creation, date_modif, type, groupe, id_utilisateur) values (?,?,?,?,?,?)';
        $tparam = array($module,$date_creation,$date_modif,$type,$groupe,$id_utilisateur);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteSeance($id) {
        $requete = 'delete from seance where id_seance = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

	public function updateSeance($id,$idModule,$idType,$groupe){
		$date_modif = date("Y-m-d");
        $requete = "update seance set module = ?, date_modif = ?, type = ?, groupe = ? where id_seance = ?";
        $tparam = array($idModule,$date_modif,$idType,$groupe,$id);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Evenements

    public function evenementExiste($id) {
        return $this->getEvenement($id) != null;
    }

    public function getEvenements(){
        $requete = 'select * from evenement';
        return $this->execQuery($requete,null,'Evenement');
    }

    public function getEvenement($id){
        $requete = 'select * from evenement where id_evenement = ?';
        $tparam = array($id);
        return $this->execQuery($requete,$tparam,'Evenement');
    }

    public function getEvenementsForSeance($id) {
        $requete = 'select * from evenement where id_seance = ?';
        return $this->execQuery($requete,array($id),'Evenement');
    }

    public function addEvenement($categorie, $description, $pj, $temps, $pour_le, $id_seance) {
	$requete = "update seance set date_modif = ? where id_seance = ?";
	$tparam  = array(date("Y-m-d"), $id_seance);
	$this->execMaj($requete, $tparam);
        $requete = 'insert into evenement (categorie,description,pj,temps,pour_le,id_seance) values (?,?,?,?,?,?)';
        $tparam = array($categorie,$description,$pj,$temps,$pour_le,$id_seance);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteEvenement($id_ev) {
        $requete = 'delete from evenement where id_evenement = ?';
        $tparam = array($id_ev);
        return $this->execMaj($requete,$tparam);
    }

	public function deleteEvenementsForSeance($id_se) {
        $requete = 'delete from evenement where id_seance = ?';
        $tparam = array($id_se);
        return $this->execMaj($requete,$tparam);
    }

    public function updateEvenement($id,$categorie,$description,$temps,$pour_le){
        $requete = "update evenement set categorie = ?, description= ?, temps=?,pour_le=? where id_evenement = ?";
        $tparam = array($categorie,$description,$temps,$pour_le,$id);
        return $this->execMaj($requete,$tparam);
    }

    //Gestion des Types de seances

    public function typeSeanceExiste($id) {
        return $this->getTypeSeance($id) != null;
    }

    public function getTypesSeance() {
        $requete = 'select * from typeseance';
        return $this->execQuery($requete,null,'Typeseance');
    }

    public function getTypeSeance($id) {
        $requete = 'select * from typeseance where id_typeseance = ?';
        $tmp = $this->execQuery($requete,array($id),'Typeseance');
        if (sizeof($tmp) == 0)
            return null;
        else return $tmp[0];
    }

    public function addTypeSeance($libelle) {

        $requete = 'insert into typeseance(libelle) values (?)';
        $tparam = array($libelle);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteTypeSeance($id) {
        $requete = 'delete from typeseance where id_typeseance = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

	//Gestion des Types d'évènements

    public function typeEvenementExiste($id) {
        return $this->getTypeEvenement($id) != null;
    }

    public function getTypesEvenement() {
        $requete = 'select * from typeevenements';
        return $this->execQuery($requete,null,'Typeevenement');
    }
	
    public function getTypeEvenementRole($role){
        $requete = 'select * from typeevenements where roles = ?';
        $tparam  = array($role);
        return $this->execQuery($requete,$tparam,'Typeevenement');
    }

    public function getTypeEvenement($id) {
        $requete = 'select * from typeevenements where id_typeevenement = ?';
        $tmp = $this->execQuery($requete,array($id),'Typeevenement');
        if (sizeof($tmp) == 0) return null;
        else return $tmp[0];
    }

    public function addTypeEvenement($libelle, $roles) {

        $requete = 'insert into typeevenements(libelle, roles) values (?,?)';
        $tparam = array($libelle, $roles);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteTypeEvenement($id) {
        $requete = 'delete from typeevenements where id_typeevenement = ?';
        $tparam = array($id);
        return $this->execMaj($requete,$tparam);
    }

	//Gestion des Sémaphores

    public function getSemaphore($id) {
        $requete = 'select * from semaphore where id_utilisateur = ?';
        $tmp = $this->execQuery($requete,array($id),'Semaphore');
        if (sizeof($tmp) == 0) return null;
        else return $tmp[0];
    }

	public function getSemaphoreSeUs($id_seance, $id_user) {
        $requete = 'select * from semaphore where id_seance = ? and id_utilisateur = ?';
        $tmp = $this->execQuery($requete,array($id_seance, $id_user),'Semaphore');
        if (sizeof($tmp) == 0) return null;
        else return $tmp[0];
    }

    public function addSemaphore($id_seance, $id_utilisateur) {

        $requete = 'insert into semaphore values (?,?,false)';
        $tparam = array($id_seance, $id_utilisateur);
        return $this->execMaj($requete,$tparam);
    }

    public function deleteSemaphoresForSeance($id_seance) {
        $requete = 'delete from semaphore where id_seance = ?';
        $tparam = array($id_seance);
        return $this->execMaj($requete,$tparam);
    }

	public function updateSemaphore($id_seance, $id_utilisateur, $etat) {
        $requete = 'update semaphore set etat = ? where id_seance = ? and id_utilisateur = ?';
        $tparam = array($etat, $id_seance, $id_utilisateur);
        return $this->execMaj($requete,$tparam);
    }
} //fin classe DB

?>
