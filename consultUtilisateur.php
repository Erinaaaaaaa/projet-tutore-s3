<?php

require "fctAuth.inc.php";
require "DB.inc.php";

function isUtilisateurOk($id,$mdp)
{
    $db = DB::getInstance();
    if ($db == null) {
        //echo "Impossible de se connecter &agrave; la base de donneeacute;es !";
        return false;
    }
    else {
        try {



            $tabUtilisateur = $db->getUtilisateur($id);

            if (sizeof($tabUtilisateur) != 1)
            {
                return false;
            }

            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            $isok = isMdpOk($tabUtilisateur[0]->getMdp(), $mdp);
            return $isok;

        }
        catch (Exception $e) {
            //echo $e->getMessage();
        }
        $db->close();
    }

    return false;
}

?>
