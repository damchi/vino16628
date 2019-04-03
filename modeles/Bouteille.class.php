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
     * @param $data
     * @return mixed
     * ajoute une bouteille au cellier
     */
    public function ajouterBouteilleCellier($data) {
        $idCellier = (int) $data['id_cellier'];
        $nom = $this->_db->escape_string($data['nom']);
        $codeSaq = $this->_db->escape_string($data['code_saq']);
        $pays = $this->_db->escape_string($data['pays']);
        $urlSaq = $this->_db->escape_string($data['url_saq']);
        $urlImg = $this->_db->escape_string($data['url_img']);
        $format = $this->_db->escape_string($data['format']);
        $dateAchat = $this->_db->escape_string($data['date_achat']);
        $gardeJusqua = $this->_db->escape_string($data['garde_jusqua']);
        $notes = $this->_db->escape_string($data['notes']);
        $prix = (float) $data['prix'];
        $quantite = (int) $data['quantite'];
        $millesime = (int) $data['millesime'];
        $type = (int) $data['type'];
//        $image = $this->_db->escape_string($_FILES['image']['name']);
//echo "<pre>";
//var_dump($_FILES);



        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){


                $key = '';
                $keys = array_merge(range(0, 9), range('a', 'z'));

                for ($i = 0; $i < 10; $i++) {
                    $key .= $keys[array_rand($keys)];
                }
                $filename = $key.$filename;
                $image = $this->_db->escape_string($filename);


                // Check whether file exists before uploading it
//                if(file_exists("./images/" . $filename)){
//                    echo $filename . " is already exists.";
//                } else{
                    move_uploaded_file($_FILES["image"]["tmp_name"], "./images/" .$filename);
//                    echo "Your file was uploaded successfully.";
//                }
            } else{
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else{
            echo "Error: " . $_FILES["image"]["error"];
        }
//




        $sql = "
            INSERT INTO vino__bouteille (id_cellier, nom,image, code_saq, pays, url_saq, url_img, format, date_achat, garde_jusqua, notes, prix, quantite, millesime, type)
            VALUES ($idCellier, '$nom', '$image','$codeSaq', '$pays', '$urlSaq', '$urlImg', '$format', '$dateAchat', '$gardeJusqua', '$notes', $prix, $quantite, $millesime, $type)";
//        var_dump($sql);
        $this->_db->query($sql);

		
        return $this->_db->insert_id;
	}
	
	/**
	 * Retourne les attributs d'une bouteille donnée.
	 * 
	 * @param int idBouteille
	 * 
	 * @return Tableau associatif des attributs ou null si la bouteille n'existe pas
	 */    
	public function getBouteille($idBouteille) {
        $idBouteille = (int) $idBouteille;
        
		$sql = "
            SELECT * FROM vino__bouteille
            WHERE id_bouteille = $idBouteille
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
        $idCellier = (int) $idCellier;
        
		$sql = "
            SELECT b.*, t.type FROM vino__bouteille b
			INNER JOIN vino__type t ON t.id_type = b.type
            WHERE id_cellier = $idCellier
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
		$sql = "SELECT * from vino__type";
        $res = $this->_db->query($sql);
		$types = Array();
		
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
     * @return int 1 si modifiée, 0 si inexistante
	 */
	public function modifierBouteille($data) {
        $idBouteille = (int) $data['id_bouteille'];
        $idCellier = (int) $data['id_cellier'];
        $nom = $this->_db->escape_string($data['nom']);
        $codeSaq = $this->_db->escape_string($data['code_saq']);
        $pays = $this->_db->escape_string($data['pays']);
        $urlSaq = $this->_db->escape_string($data['url_saq']);
        $urlImg = $this->_db->escape_string($data['url_img']);
        $format = $this->_db->escape_string($data['format']);
        $dateAchat = $this->_db->escape_string($data['date_achat']);
        $gardeJusqua = $this->_db->escape_string($data['garde_jusqua']);
        $notes = $this->_db->escape_string($data['notes']);
        $prix = (float) $data['prix'];
        $quantite = (int) $data['quantite'];
        $millesime = (int) $data['millesime'];
        $type = (int) $data['type'];
        
        $sql = "
            UPDATE vino__bouteille
            SET id_cellier = $idCellier, nom = '$nom', code_saq = '$codeSaq', pays = '$pays', url_saq = '$urlSaq', url_img = '$urlImg', format = '$format', date_achat = '$dateAchat', garde_jusqua = '$gardeJusqua', notes = '$notes', prix = $prix, quantite = $quantite, millesime = $millesime, type = $type
            WHERE id_bouteille = $idBouteille
        ";        

        $this->_db->query($sql);
        
        return $this->_db->affected_rows;
	}
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $idBouteille
	 * @param int $nombre Nombre de bouteilles à ajouter ou retirer
	 * 
	 * @return int Nouveau nombre de bouteilles après l'opération
	 */
	public function modifierQuantiteBouteilleCellier($idBouteille, $nombre) {
        $idBouteille = (int) $idBouteille;
        $nombre = (int) $nombre;
        
		$sql = "
            UPDATE vino__bouteille
            SET quantite = GREATEST(quantite + $nombre, 0)
            WHERE id_bouteille = $idBouteille
        ";
        
        $this->_db->query($sql);
		
		$sql = "
            SELECT quantite from vino__bouteille
            WHERE id_bouteille = $idBouteille
        ";
        
        $res = $this->_db->query($sql);
		
        return $res->fetch_assoc();
	}
    
	/**
	 * Supprime une bouteille d'un cellier.
	 *
	 * @param int idBouteille
	 *
     * @return int 1 si supprimée, 0 si inexistante
	 */
	public function supprimerBouteille($idBouteille) {
        $idBouteille = (int) $idBouteille;
        
		$sql = "
            DELETE FROM vino__bouteille
            WHERE id_bouteille = $idBouteille
        ";

        $this->_db->query($sql);
        
        return $this->_db->affected_rows;
	}

    /**
     * Donne le nombre de bouteilles dans un cellier donné.
     * @param int $idCellier
     * @return stdClass
     */
    public function countBouteilleCellier($idCellier) {
        $idCellier = (int) $idCellier;
        
        $sql = "
            SELECT COUNT(*) AS total
            FROM vino__bouteille WHERE id_cellier = $idCellier
        ";
        
        $res = $this->_db->query($sql);
        $row = $res->fetch_assoc();        
        $retour = new stdClass();

        if ($row['total'] > 0) {
            $retour->succes = true;
            $retour->nbBouteille = $row['total'];
        }
        else{
            $retour->succes = false;
            $retour->nbBouteille = 0;
        }
        
        return $retour;
    }

//    /**
//     * @param $idCellier
//     * @param $nom
//     * @param int $nb_resultat
//     * @return array
//     */
//	public function chercheBouteille($idCellier, $nom, $nbResultats = 10) {
//        $idCellier = (int) $idCellier;
//        $nom = $this->_db->escape_string($nom);
//        $nom = preg_replace("/\*/", "%", $nom);
//        $nbResultats = (int) $nbResultats;
//
//        $sql = "
//            SELECT DISTINCT nom FROM " . self::TABLE . "
//            WHERE id_cellier = $idCellier AND LOWER(nom) LIKE LOWER('%$nom%')
//            LIMIT 0, $nbResultats
//        ";
//        $res = $this->_db->query($sql);
//        $rows = Array();
//        while ($row = $res->fetch_assoc()) {
//            $rows[] = $row;
//        }
//        return $rows;
//    }

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

}