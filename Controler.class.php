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
				case 'listeBouteille':
					$this->listeBouteille();
					break;
				case 'getBouteilleSaq':
					$this->getBouteilleSAQ();
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
//					var_dump('eee');
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':
					$this->boireBouteilleCellier();
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
           	 		$this->connexion();
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
				default:
					$this->formlogin();
					break;
			}
		}

		private function accueil()
		{
			$bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier();
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}
		
		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();
            
            echo json_encode($cellier);
                  
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
                    include("vues/ajoutBouteille.php");
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
                //var_dump($_POST['data']);

                //var_dump($data);
                $resultat = $usager->login($body);
                echo json_encode($resultat);
            }

		}
}
?>















