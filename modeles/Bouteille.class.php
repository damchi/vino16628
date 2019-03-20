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
	 * @throws Exception Erreur de requête sur la base de données 
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
	 * @throws Exception Erreur de requête sur la base de données 
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
	 * @throws Exception Erreur de requête sur la base de données 
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
	 * @throws Exception Erreur de requête sur la base de données 
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
	 * Retourne la liste des types de bouteilles.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
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
	 * Modifie les attributs d'une bouteille.
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
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
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
}