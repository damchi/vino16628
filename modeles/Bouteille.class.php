<?php
/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele {
    const TABLE = 'vino__bouteille';
	/**
	 * Ajoute une bouteille à un cellier.
	 * 
	 * @param Array $data Tableau des attributs de la bouteille.
	 * 
	 * @return int Id de la nouvelle bouteille
	 */
	public function ajouterBouteilleCellier($data) {
        $sql = "
            INSERT INTO vino__bouteille (id_cellier, nom, image, code_saq,
            pays, description, url_saq, url_img, format, date_achat,
            garde_jusqua, notes, prix, quantite, millesime, type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";        

        $stmt = $this->_db->prepare($sql);

        $stmt->bind_param(
            "isssssssssssdiii", $data['id_cellier'], $data['nom'],
            $data['image'], $data['code_saq'], $data['pays'],
            $data['description'], $data['url_saq'], $data['url_img'],
            $data['format'], $data['date_achat'], $data['garde_jusqua'],
            $data['notes'], $data['prix'], $data['quantite'],
            $data['millesime'], $data['type']
        );
        
        $stmt->execute();
		
        return $this->_db->insert_id;
	}
	
	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */   
	public function autocomplete($nom, $nb_resultat = 10) {		
		$sql = "
            SELECT id_bouteille_saq, nom FROM vino__bouteille__saq
            WHERE LOWER(nom) LIKE LOWER(?) LIMIT 0, ?
        ";
        
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
        $nom = '%'.$nom.'%';
		 
        $stmt = $this->_db->prepare($sql);
        $stmt->bind_param("si", $nom, $nb_resultat);
        $stmt->execute();
		$res = $stmt->get_result();
		$rows = Array();
        
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;					
        }
        
		return $rows;
	}
	
	/**
	 * Retourne les attributs d'une bouteille donnée.
	 * 
	 * @param int idBouteille
	 * 
	 * @return Tableau associatif des attributs ou null si la bouteille n'existe pas
	 */    
	public function getBouteille($idBouteille) {
		$sql = "
            SELECT * FROM vino__bouteille
            WHERE id_bouteille = " . (int) $idBouteille . "
        ";

        $res = $this->_db->query($sql);
		
        return $res->fetch_assoc();
	}
	
	/**
	 * Retourne les attributs d'une bouteille SAQ donnée.
	 * 
	 * @param int idBouteilleSaq
	 * 
	 * @return Tableau associatif des attributs ou null si la bouteille n'existe pas
	 */    
	public function getBouteilleSaq($idBouteilleSaq) {
		$sql = "
            SELECT * FROM vino__bouteille__saq
            WHERE id_bouteille_saq = " . (int) $idBouteilleSaq . "
        ";

        $res = $this->_db->query($sql);
		
        return $res->fetch_assoc();
	}
	
	/**
	 * Retourne la liste des bouteilles d'un cellier donné.
	 * 
	 * @param int idCellier
	 * 
	 * @return Tableau des bouteilles avec tous leurs attributs
	 */
	public function getListeBouteillesCellier($idCellier) {
		$sql = "
            SELECT b.*, t.type FROM vino__bouteille b
			INNER JOIN vino__type t ON t.id_type = b.type
            WHERE id_cellier = " . (int) $idCellier . "
        ";

        $res = $this->_db->query($sql);
		$liste = Array();
                
        while ($row = $res->fetch_assoc()) {
            $liste[] = $row;
        }

        return $liste;
	}
	
	/**
	 * Retourne le catalogue de bouteilles SAQ.
	 * 
	 * @return Tableau des bouteilles avec tous leurs attributs
	 */
	public function getListeBouteillesSaq() {
		$sql = "
            SELECT b.*, t.type FROM vino__bouteille__saq b
			INNER JOIN vino__type t ON t.id_type = b.type
        ";

        $res = $this->_db->query($sql);
		$liste = Array();
                
        while ($row = $res->fetch_assoc()) {
            $liste[] = $row;
        }

        return $liste;
	}
	
	/**
	 * Retourne la liste des types de bouteilles.
	 * 
	 * @return Tableau des types de bouteilles
	 */   
	public function getTypes() {
		$types = Array();
		$sql = "SELECT * from vino__type";

        if (!($res = $this->_db->query($sql))) {
			throw new Exception($this->_err['requete'] . $this->_db->error, 1);
		}
		
        while ($row = $res->fetch_assoc()) {
            $types[] = $row;
        }

        return $types;
	}	
	
	/**
	 * Modifie les attributs d'une bouteille d'un cellier.
	 * 
	 * @param Array $data Tableau des attributs de la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierBouteille($data) {
        $sql = "
            UPDATE vino__bouteille
            SET id_cellier = ?, nom = ?, image = ?, code_saq = ?, pays = ?,
                description = ?, url_saq = ?, url_img = ?, format = ?,
                date_achat = ?, garde_jusqua = ?, notes = ?, prix = ?,
                quantite = ?, millesime = ?, type = ?
            WHERE id_bouteille = ?
        ";        

        $stmt = $this->_db->prepare($sql);

        $res = $stmt->bind_param(
            "isssssssssssdiiii", $data['id_cellier'], $data['nom'],
            $data['image'], $data['code_saq'], $data['pays'],
            $data['description'], $data['url_saq'], $data['url_img'],
            $data['format'], $data['date_achat'], $data['garde_jusqua'],
            $data['notes'], $data['prix'], $data['quantite'],
            $data['millesime'], $data['type'], $data['id_bouteille']
        );

        return $stmt->execute();
	}
	
	/**
	 * Modifie les attributs d'une bouteille dans le catalogue de la SAQ.
	 * 
	 * @param Array $data Tableau des attributs de la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierBouteilleSaq($data) {
        $sql = "
            UPDATE vino__bouteille__saq
            SET nom = ?, image = ?, code_saq = ?, pays = ?,
                description = ?, prix_saq = ?, url_saq = ?, url_img = ?,
                format = ?, type = ?
            WHERE id_bouteille_saq = ?
        ";        

        $stmt = $this->_db->prepare($sql);

        $res = $stmt->bind_param(
            "sssssdsssii", $data['nom'], $data['image'], $data['code_saq'],
            $data['pays'], $data['description'], $data['prix_saq'],
            $data['url_saq'], $data['url_img'], $data['format'], $data['type'],
            $data['id_bouteille_saq']
        );

        return $stmt->execute();
	}
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre) {
		$requete = "
            UPDATE vino__bouteille
            SET quantite = GREATEST(quantite + ". (int) $nombre .", 0)
            WHERE id_bouteille = " . (int) $id . "
        ";
        
        $this->_db->query($requete);
		
		$sql = "
            SELECT quantite from vino__bouteille
            WHERE id_bouteille = " . (int) $id . "
        ";
        
        $res = $this->_db->query($sql);
		
        return $res->fetch_assoc();
	}
    
    /**
     * @param $data
     * @return stdClass
     */
    public function  countBouteilleCellier($data){
        $retour = new stdClass();
        $retour -> succes = false;
        $retour -> nbBouteille = 0;
//        $retour -> raison = '';


        $stmt = $this->_db->prepare("SELECT count(*) as total FROM " .self::TABLE ." WHERE id_cellier = ?");
        $stmt->bind_param('i',$data->idCellier);
        $stmt->execute();

        $stmt_result = $stmt->get_result()->fetch_assoc();
//        var_dump($stmt_result['total']);

        if ($stmt_result['total'] > 0) {
//            var_dump($stmt_result);
            $retour -> succes = true;
            $retour->nbBouteille = $stmt_result['total'];
        }
        else{
            $retour -> succes = false;
        }
        return $retour;

    }

	/**
	 * Supprime une bouteille d'un cellier.
	 *
	 * @param int idBouteille
	 *
	 * @return Boolean true en cas de succès, false sinon
	 */
	public function supprimerBouteille($idBouteille) {
		$sql = "
            DELETE FROM vino__bouteille
            WHERE id_bouteille = " . (int) $idBouteille . "
        ";

        return $this->_db->query($sql);
	}

    /**
     * rempli select millisime dans le filtre
     * @param $idCellier
     * @return array
     * @throws Exception
     */
    public function getMillesimeCellier($idCellier){
        $millesime = Array();
        $sql = " SELECT distinct millesime  FROM " . self::TABLE . "
            WHERE id_cellier = " . $idCellier;

        if (!($res = $this->_db->query($sql))) {
            throw new Exception($this->_err['requete'] . $this->_db->error, 1);
        }
        while ($row = $res->fetch_assoc()) {
            $millesime[] = $row;
        }
        return $millesime;
    }

    /**
     * rempli le select Cellier dans le filtre
     * @param $idCellier
     * @return array
     * @throws Exception
     */
    public function getPaysCellier($idCellier){
        $pays = Array();

        $sql = " SELECT distinct pays  FROM " . self::TABLE . "
            WHERE id_cellier =".$idCellier;

        if (!($res = $this->_db->query($sql))) {
            throw new Exception($this->_err['requete'] . $this->_db->error, 1);
        }
        while ($row = $res->fetch_assoc()) {
            $pays[] = $row;
        }
        return $pays;
    }

    /**
     * rempli le select type dans le filtre
     * @param $idCellier
     * @return array
     * @throws Exception
     */
    public function getTypeCellier($idCellier){
        $type = Array();

        $sql = " SELECT distinct vino__type.type , vino__type.id_type FROM " . self::TABLE . "
            JOIN vino__type on vino__bouteille.type = vino__type.id_type  
            WHERE vino__bouteille.id_cellier =".$idCellier;
        if (!($res = $this->_db->query($sql))) {
            throw new Exception($this->_err['requete'] . $this->_db->error, 1);
        }
        while ($row = $res->fetch_assoc()) {
            $type[] = $row;
        }
        return $type;

    }

    /**
     * @param $data
     * @return array
     * @throws Exception
     * filtre les bouteilles dans le celliers via les selects
     */
    public function getBouteilleFiltre($data){
        $bouteilles = array();
        $id = $this->_db->real_escape_string($data->id);
        $pays = $this->_db->real_escape_string($data->pays);
        $millesime = $this->_db->real_escape_string($data->millesime);
        $type = $this->_db->real_escape_string($data->type);
//        var_dump(trim($pays));

        $sql = " SELECT *  FROM " . self::TABLE . "
            WHERE  id_cellier = ".$id;

        if (trim($pays) != ""){
            $sql .= " AND  pays = '".$pays ."'";
        }

        if (trim($millesime) != ""){
            $sql .= " AND  millesime = ".$millesime ;
        }
        if (trim($type) != ""){
            $sql .= " AND type = ".$type;
        }

//        var_dump($sql);

        if (!($res = $this->_db->query($sql))) {
            throw new Exception($this->_err['requete'] . $this->_db->error, 1);
        }
        while ($row = $res->fetch_assoc()) {
            $bouteilles[] = $row;
        }
        return $bouteilles;
    }

    /**
     * @param $idCellier
     * @param $nom
     * @param int $nb_resultat
     * @return array
     */
    public function chercheBouteille($idCellier,$nom, $nb_resultat = 10){
//	    var_dump($idCellier);
//	    var_dump($nom);
        $bouteilles = array();

        $nom = $this->_db->real_escape_string($nom);
//        $nom = preg_replace("/\*/","%" , $nom);
//        $nom = '%'.$nom.'%';

//	    var_dump($idCellier);

//        $sql = " SELECT *  FROM " . self::TABLE . "
//            WHERE  id_cellier = ".$id;
        $sql = " SELECT * FROM " . self::TABLE . "
            WHERE id_cellier = $idCellier AND ( LOWER(nom) LIKE '%".$nom. "%' OR lower(notes) LIKE '%".$nom. "%'OR lower(pays) LIKE '%".$nom. "%' OR lower(description) LIKE '%".$nom. "%' OR lower(millesime) LIKE '%".$nom. "%' OR lower(format) LIKE '%".$nom. "%')LIMIT 0," .$nb_resultat;

//        var_dump($sql);

        if (!($res = $this->_db->query($sql))) {
            throw new Exception($this->_err['requete'] . $this->_db->error, 1);
        }
        while ($row = $res->fetch_assoc()) {
            $bouteilles[] = $row;
        }
        return $bouteilles;
    }

	/**
	 * Supprime une bouteille du catalogue de la SAQ.
	 *
	 * @param int idBouteilleSaq
	 *
	 * @return Boolean true en cas de succès, false sinon
	 */
	public function supprimerBouteilleSaq($idBouteilleSaq) {
		$sql = "
            DELETE FROM vino__bouteille__saq
            WHERE id_bouteille_saq = " . (int) $idBouteilleSaq . "
        ";

        return $this->_db->query($sql);
	}	
}