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
        try {
            $this->switchRequete();
        }
        catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            http_response_code(200);
        }
    }
    
    private function switchRequete()
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
                    $this->getBouteilleSaq();
                } else {
                    header("Location:index.php?requete=login");
                }
                break;
            case 'autocompleteBouteille':
                $this->autocompleteBouteille();
                break;
            case 'autocompleteBouteilleListe':
                $this->autocompleteBouteilleListe();
                break;
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
            case 'bouteilleIndividuelle':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->voirBouteille();
                } else {
                    header("Location: index.php?requete=login");
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
            case 'ajoutUsager':
                if (isset($_POST['ajouterUsager'])) {
                    if (trim($_POST['nom']) != "" || trim($_POST['prenom']) || trim($_POST['mail']) != "" || trim($_POST['password']) != "" || trim($_POST['pseudo']) != "") {
                        $this->ajoutUsager($_POST["nom"], $_POST["prenom"], $_POST['mail'], $_POST['password'], $_POST['pseudo']);
                    } else {
                        $this->formlogin();
                    }
                } else {
                    header("Location:index.php?requete=inscription");
                }
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
//                    var_dump('rrr');
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
            case 'modifierCellier':
                if (isset($_SESSION['user_pseudo'])) {
                    $this->modificationCellier();
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
            case 'gererUsagers':
                if (isset($_SESSION['admin'])) {
                    $this->gererUsagers();
                } else {
                    $this->fermerSession();
                }
                break;
            case 'autocompleteUsager':
                if (isset($_SESSION['admin'])) {
                    $this->autocompleteUsager();
                }
                break;
            case 'detailsUsager':
                if (isset($_SESSION['admin'])) {
                    $this->detailsUsager();
                }
                break;
            case 'supprimerUsager':
                if (isset($_SESSION['admin'])) {
                    $this->supprimerUsager();
                }
                break;
            case 'gererCatalogueSaq':
                if (isset($_SESSION['admin'])) {
                    $this->gererCatalogueSaq();
                } else {
                    $this->fermerSession();
                }
                break;
            case 'reinitialiserCatalogue':
                if (isset($_SESSION['admin'])) {
                    $this->reinitialiserCatalogue();
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
//        $dataBouteille = $cellier->countBouteille($_SESSION['user_id']);
        include("vues/entete.php");
        include("vues/listeCelliers.php");
        include("vues/pied.php");

    }

    private function adminAccueil()
    {
        $usr = new Usager();
        $data['nbAdmin'] = $usr->nbUsagers(['admin' => true]);
        $data['nbUsagers'] = $usr->nbUsagers(['admin' => false]);
        
        $saq = new SAQ();
        $data['nbProduitsSaq'] = $saq->nbProduits();
        
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

    private function getBouteilleSaq()
    {
        $saq = new SAQ();
        $body = json_decode(file_get_contents('php://input'));
        $bouteilleSaq = $saq->getProduit($body->id_bouteille_saq);
        echo json_encode($bouteilleSaq);
    }

    private function autocompleteBouteille()
    {
        $saq = new SAQ();
        $body = json_decode(file_get_contents('php://input'));
        $nbResultats = isset($body->nbResultats) ? $body->nbResultats : 10000;
        $listeBouteille = $saq->autocomplete($body->nom, $nbResultats);
        echo json_encode($listeBouteille);
    }

    private function autocompleteBouteilleListe()
    {
        $bte = new Bouteille();
        $body = json_decode(file_get_contents('php://input'));
        $listeBouteille = $bte->chercheBouteille($_SESSION['idCellier'], $body->nom);
        echo json_encode($listeBouteille);

    }

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
//                        echo "<pre>";
//                        var_dump($bouteille);
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

    private function voirBouteille()
    {
        $bte = new Bouteille();
        $usr = new Usager();

        if ($usr->estProprietaireBouteille($_SESSION['user_pseudo'], $_GET['idBouteille'])) {

            $data['bouteille'] = $bte->getBouteille($_GET['idBouteille']);
            $data['types'] = $bte->getTypes();
            include("vues/entete.php");
            include("vues/bouteilleIndividuelle.php");
            include("vues/pied.php");
        }
    }

    private function modifierBouteilleSaq()
    {
        $saq = new SAQ();

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $data['bouteille'] = $saq->getProduit($_GET['idBouteilleSaq']);
                $data['types'] = $saq->getTypes();
                include("vues/entete.php");
                include("vues/formBouteilleSaq.php");
                include("vues/pied.php");
                break;

            case 'POST':
                $bouteille = [];

                foreach ($_POST as $cle => $valeur) {
                    $bouteille[$cle] = !empty($valeur) ? $valeur : null;
                }

                $saq->modifieProduit($bouteille);
                header("Location: index.php?requete=gererCatalogueSaq");
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
        $saq = new SAQ();
        $res = $saq->supprimeProduit($body->id);
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

    private function ajoutUsager($nom, $prenom, $mail, $password, $pseudo)
    {
        $usager = new Usager();

        if ($usager->ajoutNouveauUsager($nom, $prenom, $mail, $password, $pseudo) == true) {
            $this->formlogin();
        } else {
            $errorMessage = " l'identifiant ou pseudi existe déjà";
            $this->formlogin($errorMessage);
        }
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
        $usager = new Usager();
        return $usager->login($identifiant, $mdp);
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


//        $body = json_decode(file_get_contents('php://input'));
//        var_dump(file_get_contents('php://input'));
        if (!empty($_POST['nomCellier']) && !empty($_POST['id'])) {
            $cellier = new Cellier();
//            $resultat = $cellier->ajoutCellierUsager($body);
            $resultat = $cellier->ajoutCellierUsager($_POST['nomCellier'],$_POST['id']);
            echo json_encode($resultat);
        }
    }

    private function verifCellier()
    {
        $body = json_decode(file_get_contents('php://input'));
        if (!empty($body)) {
            $bouteille = new Bouteille();
            $resultat = $bouteille->countBouteilleCellier($body->idCellier);
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

    private function gererUsagers()
    {
        include("vues/entete.php");
        include("vues/gererUsagers.php");
        include("vues/pied.php");
    }
    
    private function autocompleteUsager()
    {
        $usr = new Usager();
        $body = json_decode(file_get_contents('php://input'));
        $listeUsagers = $usr->autocomplete($body->nom);
        echo json_encode($listeUsagers);
    }

    private function detailsUsager()
    {
        $usr = new Usager();
        $data['usager'] = $usr->getUsager($_GET['idUsager']);
        
        include("vues/entete.php");
        include("vues/detailsUsager.php");
        include("vues/pied.php");
    }

    private function supprimerUsager()
    {
        $body = json_decode(file_get_contents('php://input'));
        $usr = new Usager();
        $res = $usr->supprimer($body->id);
        echo json_encode($res);
    }

    private function gererCatalogueSaq()
    {
        include("vues/entete.php");
        include("vues/gererCatalogueSaq.php");
        include("vues/pied.php");
    }
    
    private function reinitialiserCatalogue()
    {
        $saq = new SAQ();
        $saq->supprimeTousProduits();
        $res = $saq->getProduits(200, 0);
        echo json_encode($res);
    }

    private function modificationCellier()
    {
        if (!empty($_POST['nomCellierMofif']) && !empty($_POST['idUserModif'])&& !empty($_SESSION['user_id'])) {
            $cellier = new Cellier();
            $resultat = $cellier->updateCellier($_POST['nomCellierMofif'],$_POST['idUserModif'],$_SESSION['user_id']);
            echo json_encode($resultat);
        }

    }
}
?>















