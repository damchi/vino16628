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
	 * Retourne la liste des bouteilles d'un cellier donné.
	 * 
	 * @param int idCellier
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return Tableau des bouteilles avec tous leurs attributs
	 */
    
	public function getListeBouteilleCellier($idCellier = 0) {
		$liste = Array();
        
		$sql = "
            SELECT b.*, t.type FROM vino__bouteille b
			INNER JOIN vino__type t ON t.id_type = b.type
        ";

        if ($idCellier) {
            $sql .= " WHERE id_cellier = " . (int) $idCellier;
        }
        
        if (!($res = $this->_db->query($sql))) {
			throw new Exception("Erreur de requête sur la base de donnée: " . $this->_db->error, 1);
		}
		
        while ($row = $res->fetch_assoc()) {
            $liste[] = $row;
        }

        return $liste;
	}
	
	/**
	 * Retourne les attributs d'une bouteille SAQ donnée.
	 * 
	 * @param int idBouteilleSaq
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return Tableau associatif des attributs
	 */
    
	public function getBouteilleSaq($idBouteilleSaq = 0) {
		$sql = "
            SELECT * FROM vino__bouteille__saq
            WHERE id_bouteille_saq = " . (int) $idBouteilleSaq . "
        ";

        if (!($res = $this->_db->query($sql))) {
			throw new Exception("Erreur de requête sur la base de donnée: " . $this->_db->error, 1);
		}
		
        return $res->fetch_assoc();
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
			throw new Exception("Erreur de requête sur la base de donnée: " . $this->_db->error, 1);
		}
		
        while ($row = $res->fetch_assoc()) {
            $types[] = $row;
        }

        return $types;
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
       
	public function autocomplete($nom, $nb_resultat=10)
	{		
		$rows = Array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
        $nom = '%'.$nom.'%';
		 
		//echo $nom;
		$requete = "
            SELECT id_bouteille_saq, nom FROM vino__bouteille__saq
            WHERE LOWER(nom) LIKE LOWER(?) LIMIT 0, ?
        ";
        
        $stmt = $this->_db->prepare($requete);
        $stmt->bind_param("si", $nom, $nb_resultat);
        $stmt->execute();
        
		if($res = $stmt->get_result())
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['id'] = $row['id_bouteille_saq'];
                    unset($row['id_bouteille_saq']);
					$rows[] = $row;					
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de données", 1);			 
		}
		
		//var_dump($rows);
		return $rows;
	}
	
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{
        $sql = "
            INSERT INTO vino__bouteille (id_cellier, nom, image, code_saq,
            pays, description, url_saq, url_img, format, date_achat,
            garde_jusqua, notes, prix, quantite, millesime, type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";        

        $stmt = $this->_db->prepare($sql);

        // Temporaire le temps de faire la programmation des celliers multiples
        $data->id_cellier = 0;
        
        $stmt->bind_param(
            "isssssssssssdiii", $data->id_cellier, $data->nom, $data->image,
            $data->code_saq, $data->pays, $data->description, $data->url_saq,
            $data->url_img, $data->format, $data->date_achat,
            $data->garde_jusqua, $data->notes, $data->prix, $data->quantite,
            $data->millesime, $data->type
        );
        
        ($res = $stmt->execute()) or trigger_error($stmt->error);

        return $res;
	}
	
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		$requete = "
            UPDATE vino__bouteille
            SET quantite = GREATEST(quantite + ". (int) $nombre .", 0)
            WHERE id_bouteille = ". (int) $id ."
        ";
        
		//echo $requete;
        return $this->_db->query($requete);
	}
}




?>