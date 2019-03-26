<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Controler
{
    /**
     * Traite la requête
     * @return void
     */
    public function gerer()
    {
        switch ($_GET['requete']) {
            case 'listeBouteilleCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->afficheBouteillesCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'getBouteilleSaq':
                if (isset($_SESSION['user_pseudo'])) {

                    $this->getBouteilleSAQ();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'autocompleteBouteille':
                $this->autocompleteBouteille();
                break;
//            case 'autocompleteBouteilleListe':
//                $this->autocompleteBouteilleListe();
//                break;
            case 'nouvelleBouteilleCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->nouvelleBouteilleCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'modifierBouteille':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->modifierBouteille();
                } else {
                    header("Location: index.php?requete=login");
                }
                break;
            case 'modifierBouteilleSaq':
                if (isset($_SESSION['admin'])) {
                    $this->modifierBouteilleSaq();
                } else {
                    $this->fermerSession();
                }
                break;
            case 'supprimerBouteille':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->supprimerBouteille();
                } else {
                    header("Location: index.php?requete=login");
                }
                break;
            case 'supprimerBouteilleSaq':
                if (isset($_SESSION['admin'])) {
                    $this->supprimerBouteilleSaq();
                } else {
                    $this->fermerSession();
                }
                break;
            case 'ajouterBouteilleCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->ajouterBouteilleCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'boireBouteilleCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->boireBouteilleCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'inscription':
                $this->formInscription();
                break;
            case 'ajoutUsager':
                if (isset($_POST['ajouterUsager'])) {
                    if (trim($_POST['nom']) != "" || trim($_POST['prenom']) || trim($_POST['mail']) != "" || trim($_POST['password']) != "" || trim($_POST['pseudo']) != "") {
                        $this->ajoutUsager($_POST["nom"], $_POST["prenom"], $_POST['mail'], $_POST['password'], $_POST['pseudo']);

//                         $this->formlogin();
                    } else {
                        $this->formInscription();
                    }
                } else {
                    header("Location:index.php?requete=inscription");
                }
//					$this->ajoutUsager();
                break;
            case 'login':
                $this->formlogin();
                break;
            case 'logedin':
                if (isset($_POST['btnLogin'])) {
                    if (trim($_POST['identifiant']) != "" || trim($_POST['password'])) {
                        $connexion = $this->connexion($_POST['identifiant'], $_POST['password']);

                        if ($connexion->succes === true) {
                            if (isset($_SESSION['user_pseudo'])) {
                                if ($connexion->admin == false) {
                                    $this->accueil();
                                } else {
                                    $this->adminAccueil();
                                }
                            } else {
                                header("Location:index.php?requete=login");
                            }
                        } else {
                            $errorMessage = 'Identifiant ou mot de passe incorrect';
                            $this->formlogin($errorMessage);
                        }
                    }
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'accueil':
                if (isset($_SESSION['user_pseudo'])) {
//					var_dump($_SESSION['user_pseudo']);
                    $this->accueil();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'logout':
                $this->fermerSession();
                break;
            case 'ajoutCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->ajoutCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'verifierBouteille':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->verifCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'supprimerCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->supprimeCellier();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'filtre':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->filtreBouteille();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'adminAccueil':
                if (isset($_SESSION['admin'])) {
                    $this->adminAccueil();
                } else {
                    $this->fermerSession();
                }
                break;
            case 'gererBouteillesSaq':
                if (isset($_SESSION['admin'])) {
                    $this->gererBouteillesSaq();
                } else {
                    $this->fermerSession();
                }
                break;
            default:
                if (isset($_SESSION['user_pseudo'])) {
                    $this->accueil();
                } else {
                    $this->formlogin();
                }
                break;
        }
    }


    private function accueil()
    {
        $cellier = new Cellier();
        $data = $cellier->getUsagerCellier($_SESSION['user_id']);
        include("vues/entete.php");
        include("vues/listeCelliers.php");
        include("vues/pied.php");

    }

    private function adminAccueil()
    {

        include("vues/entete.php");
        include("vues/admin.php");
        include("vues/pied.php");

    }

    private function afficheBouteillesCellier()
    {
        $usr = new Usager();

        if ($usr->estProprietaireCellier($_SESSION['user_pseudo'], $_GET['idCellier'])) {
            $bte = new Bouteille();
            $data['idCellier'] = $_GET['idCellier'];
            $_SESSION['idCellier'] = $_GET['idCellier'];
            $data['listeBouteilles'] = $bte->getListeBouteillesCellier($_GET['idCellier']);
            $data['millesime'] = $bte->getMillesimeCellier($_GET['idCellier']);
            $data['pays'] = $bte->getPaysCellier($_GET['idCellier']);
            $data['type'] = $bte->getTypeCellier($_GET['idCellier']);
            include("vues/entete.php");
            include("vues/listeBouteilles.php");
            include("vues/pied.php");
        }
    }

    private function getBouteilleSAQ()
    {
        $bte = new Bouteille();
        $body = json_decode(file_get_contents('php://input'));
        $bouteilleSaq = $bte->getBouteilleSaq($body->id_bouteille_saq);
        echo json_encode($bouteilleSaq);
    }

    private function autocompleteBouteille()
    {
        $bte = new Bouteille();
        $body = json_decode(file_get_contents('php://input'));
        $listeBouteille = $bte->autocomplete($body->nom);
        echo json_encode($listeBouteille);

    }

//    private function autocompleteBouteilleListe()
//    {
//        $bte = new Bouteille();
//        $body = json_decode(file_get_contents('php://input'));
//        $listeBouteille = $bte->chercheBouteille($_SESSION['idCellier'], $body->nom);
//        echo json_encode($listeBouteille);
//
//    }

    private function nouvelleBouteilleCellier()
    {
        $bte = new Bouteille();
        $usr = new Usager();

        if ($usr->estProprietaireCellier($_SESSION['user_pseudo'], $_GET['idCellier'])) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['bouteille'] = [];
                    $data['idCellier'] = $_GET['idCellier'];
                    $data['types'] = $bte->getTypes();
                    include("vues/entete.php");
                    include("vues/formBouteille.php");
                    include("vues/pied.php");
                    break;

                case 'POST':
                    $bouteille = [];

                    foreach ($_POST as $cle => $valeur) {
                        $bouteille[$cle] = !empty($valeur) ? $valeur : null;
                    }

                    $bte->ajouterBouteilleCellier($bouteille);
                    header("Location: index.php?requete=listeBouteilleCellier&idCellier=" . $bouteille['id_cellier']);
                    break;
            }
        }
    }

    private function modifierBouteille()
    {
        $bte = new Bouteille();
        $usr = new Usager();

        if ($usr->estProprietaireBouteille($_SESSION['user_pseudo'], $_GET['idBouteille'])) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data['bouteille'] = $bte->getBouteille($_GET['idBouteille']);
                    $data['types'] = $bte->getTypes();
                    include("vues/entete.php");
                    include("vues/formBouteille.php");
                    include("vues/pied.php");
                    break;

                case 'POST':
                    $bouteille = [];

                    foreach ($_POST as $cle => $valeur) {
                        $bouteille[$cle] = !empty($valeur) ? $valeur : null;
                    }

                    $bte->modifierBouteille($bouteille);
                    header("Location: index.php?requete=listeBouteilleCellier&idCellier=" . $bouteille['id_cellier']);
                    break;
            }
        }
    }

    private function modifierBouteilleSaq()
    {
        $bte = new Bouteille();

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $data['bouteille'] = $bte->getBouteilleSaq($_GET['idBouteilleSaq']);
                $data['types'] = $bte->getTypes();
                include("vues/entete.php");
                include("vues/formBouteilleSaq.php");
                include("vues/pied.php");
                break;

            case 'POST':
                $bouteille = [];

                foreach ($_POST as $cle => $valeur) {
                    $bouteille[$cle] = !empty($valeur) ? $valeur : null;
                }

                $bte->modifierBouteilleSaq($bouteille);
                header("Location: index.php?requete=gererBouteillesSaq");
                break;
        }
    }

    private function supprimerBouteille()
    {
        $body = json_decode(file_get_contents('php://input'));
        $usr = new Usager();

        if ($usr->estProprietaireBouteille($_SESSION['user_pseudo'], $body->id)) {
            $bte = new Bouteille();
            $res = $bte->supprimerBouteille($body->id);
        } else {
            $res = false;
        }

        echo json_encode($res);
    }

    private function supprimerBouteilleSaq()
    {
        $body = json_decode(file_get_contents('php://input'));
        $bte = new Bouteille();
        $res = $bte->supprimerBouteilleSaq($body->id);
        echo json_encode($res);
    }

    private function boireBouteilleCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        $usr = new Usager();

        if ($usr->estProprietaireBouteille($_SESSION['user_pseudo'], $body->id)) {
            $bte = new Bouteille();
            $resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
            echo json_encode($resultat);
        }
    }

    private function ajouterBouteilleCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        $usr = new Usager();

        if ($usr->estProprietaireBouteille($_SESSION['user_pseudo'], $body->id)) {
            $bte = new Bouteille();
            $resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
            echo json_encode($resultat);
        }
    }

    private function formInscription($errorMessage = "")
    {
        $dataMessage = $errorMessage;
        include('vues/entete.php');
        include('vues/ajoutUsager.php');
        include('vues/pied.php');

    }

    private function ajoutUsager($nom, $prenom, $mail, $password, $pseudo)
    {
//            $body = json_decode(file_get_contents('php://input'));
//
//            if(!empty($body)){
//                $usager = new Usager();
//                //var_dump($_POST['data']);
//
//                //var_dump($data);
//                $resultat = $usager->ajoutNouveauUsager($body);
//                echo json_encode($resultat);
//            }

        $usager = new Usager();
        if ($usager->ajoutNouveauUsager($nom, $prenom, $mail, $password, $pseudo) == true) {
            $this->formlogin();
        } else {
            $errorMessage = " l'identifiant ou pseudi existe déjà";

            $this->formInscription($errorMessage);
        }
//        var_dump($usager->ajoutNouveauUsager($nom,$prenom,$mail,$password,$pseudo));


    }

    private function formlogin($errorMessage = "")
    {
        $dataMessage = $errorMessage;
        include('vues/entete.php');
        include('vues/login.php');
        include('vues/pied.php');
    }

    private function connexion($identifiant, $mdp)
    {
//            $body = json_decode(file_get_contents('php://input'));
//            if(!empty($body)){
//                $usager = new Usager();
//                $resultat = $usager->login($body);
//                echo json_encode($resultat);
//            }

        $usager = new Usager();
        return $usager->login($identifiant, $mdp);
//        var_dump($usager->login($identifiant,$mdp)->succes);

    }

    private function fermerSession()
    {
        $_SESSION = array();

        // Delete la session en lui assignant un tableau vide et le cookie de session en créant
        // un nouveau cookie avec la date d'expiration dans le passé
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }

        session_destroy();
        header('location:index.php?requete=login');
    }

    private function ajoutCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            $cellier = new Cellier();
            $resultat = $cellier->ajoutCellierUsager($body);
            echo json_encode($resultat);
        }
    }

    private function verifCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            $bouteille = new Bouteille();
            $resultat = $bouteille->countBouteilleCellier($body);
            echo json_encode($resultat);
        }
    }

    private function supprimeCellier()
    {
        $usr = new Usager();


//        if ($usr->estProprietaireCellier($_SESSION['user_pseudo'], $idCellier)) {
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            if ($usr->estProprietaireCellier($_SESSION['user_pseudo'], $body->idCellier)) {

                $cellier = new Cellier();
                $resultat = $cellier->supprimeCellierUsager($body);
                echo json_encode($resultat);
            }
        }
//        }
//        else{
//            $this->formlogin();
//        }
    }

    private function filtreBouteille()
    {
        $usr = new Usager();
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            if ($usr->estProprietaireCellier($_SESSION['user_pseudo'], $_SESSION['idCellier'])) {
                $bte = new Bouteille();
                $resultat = $bte->getBouteilleFiltre($body);
                echo json_encode($resultat);
            }
        }
    }

    private function gererBouteillesSaq()
    {
        $bte = new Bouteille();
        $data['bouteilles'] = $bte->getListeBouteillesSaq();

        include("vues/entete.php");
        include("vues/gererBouteillesSaq.php");
        include("vues/pied.php");
    }

}
?>















