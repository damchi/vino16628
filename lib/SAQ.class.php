<?php
/**
 * Class MonSQL
 * Classe qui génère ma connection à MySQL à travers un singleton
 *
 *
 * @author Jonathan Martel
 * @version 1.0
 *
 *
 *
 */
class SAQ extends Modele {

	const DUPLICATION = 'duplication';
	const ERREURDB = 'erreurdb';

	private static $_webpage;
	private static $_status;
	private $stmt;

	public function __construct() {
		parent::__construct();
		if (!($this -> stmt = $this -> _db -> prepare("INSERT INTO vino__bouteille__saq(nom, type, code_saq, pays, prix_saq, url_saq, url_img, format) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"))) {
			echo "Echec de la préparation : (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
	}

	/**
	 * getProduits
	 * @param int $nombre
	 * @param int $debut
	 */
	public function getProduits($nombre = 100, $debut = 0) {
		$s = curl_init();

		//curl_setopt($s, CURLOPT_URL, "http://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?searchType=&orderBy=&categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=".$debut."&tri=&metaData=YWRpX2YxOjA8TVRAU1A%2BYWRpX2Y5OjE%3D&pageSize=". $nombre ."&catalogId=50000&searchTerm=*&sensTri=&pageView=&facet=&categoryId=39919&storeId=20002");
		curl_setopt($s, CURLOPT_URL, "https://fr.simplesite.com");
		curl_setopt($s, CURLOPT_URL, 
        "https://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=" . $debut . "&pageSize=" . $nombre . "&catalogId=50000&searchTerm=*&categoryId=39919&storeId=20002");
		curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        
        // Quick fix pour que ça marche sous Windows sans installer les root certificates
        curl_setopt($s, CURLOPT_SSL_VERIFYPEER, false);
        
		//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

		self::$_webpage = curl_exec($s);
		self::$_status = curl_getinfo($s, CURLINFO_HTTP_CODE);
		curl_close($s);

		$doc = new DOMDocument();
		$doc -> recover = true;
		$doc -> strictErrorChecking = false;
//		$doc -> loadHTML(self::$_webpage);
		@$doc -> loadHTML(self::$_webpage);
		$elements = $doc -> getElementsByTagName("div");
		$i = 0;
		foreach ($elements as $key => $noeud) {
			if (strpos($noeud -> getAttribute('class'), "resultats_product") !== false) {
				$info = self::recupereInfo($noeud);
				$retour = $this -> ajouteProduit($info);
				if ($retour -> succes == false) {
					echo "erreur : " . $retour -> raison . "<br>";
					echo "<pre>";
//					var_dump($info);
					echo "</pre>";
					echo "<br>";
				} else {
					$i++;
				}
			}
		}

		return $i;
	}

    public function supprimeTousProduits() {
        $sql = "DELETE FROM vino__bouteille__saq";
        $res = $this->_db->query($sql);
        return $res;
    }

	private function get_inner_html($node) {
		$innerHTML = '';
		$children = $node -> childNodes;
		foreach ($children as $child) {
			$innerHTML .= $child -> ownerDocument -> saveXML($child);
		}

		return $innerHTML;
	}

	private function recupereInfo($noeud) {
		$info = new stdClass();
		$info -> img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src');
		$info -> url = $noeud -> getElementsByTagName("a") -> item(0) -> getAttribute('href');
		$p = $noeud -> getElementsByTagName("p");
        
		foreach ($p as $node) {
			if ($node -> getAttribute('class') == 'nom') {
				$info -> nom = trim($node -> textContent);
			}
            else if ($node -> getAttribute('class') == 'desc') {
				$info -> desc = new stdClass();
				$info -> desc -> texte = $node -> textContent;
				$res = preg_match_all("/\r\n\s*(.*)\r\n/", $info -> desc -> texte, $aDesc);
                
				if (isset($aDesc[1][2])) {
					preg_match("/\d{8}/", $aDesc[1][2], $aRes);
					$info -> desc -> code_SAQ = trim($aRes[0]);
				}
                
				if (isset($aDesc[1][1])) {
					preg_match("/(.*),(.*)/", $aDesc[1][1], $aRes);

					$info -> desc -> pays = trim($aRes[1]);
					$info -> desc -> format = substr(trim($aRes[2]), 2);
				}

                
				if (isset($aDesc[1][0])) {
					$info -> desc -> type = trim($aDesc[1][0]);
				}

                
				$info -> desc -> texte = trim($info -> desc -> texte);
			}
		}
        
		$p = $noeud -> getElementsByTagName("td");
        
		foreach ($p as $node) {
			if ($node -> getAttribute('class') == 'price') {
				$info -> prix = trim($node -> textContent);
				preg_match("/ \r\n(.*)$/", $info -> prix, $aRes);
				$info -> prix = trim($aRes[1]);
                $info -> prix = preg_replace("/,/", ".", $info -> prix); // Pour avoir un float
			}
		}

		return $info;
	}

	private function ajouteProduit($bte) {
		$retour = new stdClass();
		$retour -> succes = false;
		$retour -> raison = '';

		// Récupère le type
        $sql = "select id_type from vino__type where type = '" . $bte -> desc -> type . "'";
		$rows = $this -> _db -> query($sql);
		
		if ($rows -> num_rows == 1) {
			$type = $rows -> fetch_assoc();
			$type = $type['id_type'];

            $sql = "select id_bouteille_saq from vino__bouteille__saq where code_saq = '" . $bte -> desc -> code_SAQ . "'";

			$rows = $this -> _db -> query($sql);
            
			if ($rows -> num_rows < 1) {

				$this -> stmt -> bind_param("sissdsss", $bte -> nom, $type, $bte -> desc -> code_SAQ, $bte -> desc -> pays, $bte -> prix, $bte -> url, $bte -> img, $bte -> desc -> format);
				$retour -> succes = $this -> stmt -> execute();
			} else {
				$retour -> succes = false;
				$retour -> raison = self::DUPLICATION;
			}
		} else {
			$retour -> succes = false;
			$retour -> raison = self::ERREURDB;

		}
		return $retour;

	}
    
	/**
	 * Retourne le nombre de produits dans le catalogue correspondant à
     * certains critères.
	 * 
     * @param Array criteres
     *        (aucun critère encore programmé)
     *
	 * @return int Le nombre de produits
	 */
	public function nbProduits($criteres = []) {
        $sql = "SELECT COUNT(*) AS count FROM vino__bouteille__saq WHERE 1 = 1";
        
        if (isset($criteres['...'])) {
            $sql .= " AND ... ";
        }

        $res = $this->_db->query($sql);
        $row = $res->fetch_assoc();
        
        return (int) $row['count'];
    }
}