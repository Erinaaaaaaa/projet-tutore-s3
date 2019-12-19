<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'PHP/DB/DB.inc.php';

require_once("PHP/Twig/lib/Twig/Autoloader.php");
Twig_Autoloader::register();
$twig = new Twig_Environment(new Twig_Loader_Filesystem("./tpl"));

$tpl = $twig->loadTemplate("inscription.twig");

echo "uioefguozgheuozhbzigbkreiohte h uogohirtiohrtshiofg,iofgjhpigfjhpsiogjphioj (langue chat pour 'hey c'est verif update')";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = DB::getInstance();
    if ($db == null) {
        echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
    } else {
        try {

            $users = $db->getUtilisateur($_POST['oldId']);

            // utilisateur non existant
            if (sizeof($users) == 0)
            {
                $id     = $_POST['id'];
                $nom    = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mdp    = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $role   = $_POST['role'];
                $groupe = $_POST['groupe'];

                $db->insertUtilisateur($id, $nom, $prenom, $mdp, $role, $groupe);
            }
            else
            {
                $user = $users[0];

                $oldId = $_POST['oldId'];
                $id    = $_POST['id'];
                $nom    = $_POST['nom'];
                $prenom    = $_POST['prenom'];
                $mdp    = $user->getMdp();
                $role    = $_POST['role'];
                $groupe    = $_POST['groupe'];

                //Modification du mot de passe :
                if(!empty($_POST['mdp']))
                {
                    echo '<br>MOT DE PASSE NON VIDE';
                    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                }

                //Modification de l'utilisateur :
                $db->updateUtilisateur($oldId, $id, $nom, $prenom, $mdp, $role, $groupe);
            }

        } catch (Exception $e) {
            echo $tpl->render(array("ErreurInscription" => "ça MARCHE PAS: " . $e->getMessage()));

        }
    }


    $db->close();
} else {

    echo $tpl->render(array());

}

// header("Location : listUtilisateurs.php");


