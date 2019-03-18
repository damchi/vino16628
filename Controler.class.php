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
					if (isset($_SESSION['user_pseudo'])){
                        $this->afficheBouteilleCellier($_GET['idCellier']);
					}
                    else{
                        header("Location:index.php?requete=login");
                    }
					break;
				case 'getBouteilleSaq':
                    if (isset($_SESSION['user_pseudo'])){

                        $this->getBouteilleSAQ();
                    }
					else{
						header("Location:index.php?requete=login");
					}
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					if (isset($_SESSION['user_pseudo'])){
						$this->ajouterNouvelleBouteilleCellier();
                    }
                    else{
                        header("Location:index.php?requete=login");
                    }
					break;
				case 'ajouterBouteilleCellier':
                    if (isset($_SESSION['user_pseudo'])){
                        $this->ajouterBouteilleCellier();
					}
					else{
						header("Location:index.php?requete=login");
					}
					break;
				case 'boireBouteilleCellier':
                    if (isset($_SESSION['user_pseudo'])){
                        $this->boireBouteilleCellier();
					}
					else{
						header("Location:index.php?requete=login");
					}
					break;
				case 'inscription':
					$this->formInscription();
					break;
				case 'ajoutUsager':
					$this->ajoutUsager();
					break;
                case 'login':
                        $this->formlogin();
                    break;
                case 'logedin':
//					if (isset($_SESSION['user_pseudo'])){
						$this->connexion();
//                    }
//                    else{
//                        header("Location:index.php?requete=login");
//                    }
                    break;
				case 'accueil':
					if (isset($_SESSION['user_pseudo'])){
//					var_dump($_SESSION['user_pseudo']);
                        $this->accueil();
					}
					else{
                        header("Location:index.php?requete=login");
                    }
					break;
				case 'logout':
                    $_SESSION = array();

                    // Delete la session en lui assignant un tableau vide et le cookie de session en créant
                    // un nouveau cookie avec la date d'expiration dans le passé
                    if(isset($_COOKIE[session_name()]))
                    {
                        setcookie(session_name(), '', time() - 3600);
                    }
                    session_destroy();
                    header('location:index.php?requete=login');
					break;
                case 'ajoutCellier':
                    if (isset($_SESSION['user_pseudo'])) {
                        $this->ajoutCellier();
                    }
                    else{
                        header("Location:index.php?requete=login");
                    }
                    break;
				default:
					$this->formlogin();
					break;
			}
		}

		private function accueil()
		{
//			$bte = new Bouteille();
//            $data = $bte->getListeBouteilleCellier();
			$cellier = new Cellier();
			$data = $cellier->getUsagerCellier($_SESSION['user_id']);
			include("vues/entete.php");
//			include("vues/listeBouteille.php");
			include("vues/listeCellier.php");
			include("vues/pied.php");

		}
    	private function afficheBouteilleCellier($idCellier){
            $bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier($idCellier);
            include("vues/entete.php");
			include("vues/listeBouteille.php");
            include("vues/pied.php");

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
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}
		private function ajouterNouvelleBouteilleCellier()
		{
			switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $bte = new Bouteille();
                    $data['types'] = $bte->getTypes();
                    include("vues/entete.php");
                    include("vues/formBouteille.php");
                    include("vues/pied.php");
                    break;
                case 'POST':
                    $bte = new Bouteille();
                    $body = json_decode(file_get_contents('php://input'));
                    $resultat = $bte->ajouterBouteilleCellier($body);
                    echo json_encode($resultat);
                    break;
			}
        }
		
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
		
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}

		private function formInscription(){
			include ('vues/entete.php');
			include ('vues/ajoutUsager.php');
			include ('vues/pied.php');

		}

		private function ajoutUsager(){
            $body = json_decode(file_get_contents('php://input'));

            if(!empty($body)){
                $usager = new Usager();
                //var_dump($_POST['data']);

                //var_dump($data);
                $resultat = $usager->ajoutNouveauUsager($body);
                echo json_encode($resultat);
            }

		}

		private function formlogin(){
            include ('vues/entete.php');
            include ('vues/login.php');
            include ('vues/pied.php');
		}

		private function connexion(){
            $body = json_decode(file_get_contents('php://input'));
            if(!empty($body)){
                $usager = new Usager();
                $resultat = $usager->login($body);
                echo json_encode($resultat);
            }
		}

		private function ajoutCellier(){
            $body = json_decode(file_get_contents('php://input'));
            if(!empty($body)){
                $cellier = new Cellier();
                $resultat = $cellier->ajoutCellierUsager($body);
                echo json_encode($resultat);
            }
        }
}
?>















