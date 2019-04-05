<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 09:58
 */

class Usager extends Modele
{
    const TABLE = 'vino__usager';

    /**
     * verifie l'existance d'un usager avec son mail ou pseudo
     * @param $mail
     * @param $pseudo
     * @return bool
     */
    public function existUsager($mail, $pseudo) {
        $mail = $this->_db->escape_string($mail);
        $pseudo = $this->_db->escape_string($pseudo);
        
        $sql = "
            SELECT * FROM " . self::TABLE . "
            WHERE mail = '$mail' OR pseudo = '$pseudo'
        ";
        
        return (boolean) $this->_db->query($sql)->fetch_assoc();
    }

    /**
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $password
     * @param $pseudo
     * @return mixed
     * ajout d'un nouveau usager dans la BDD
     *
     */
    public function ajoutNouveauUsager($nom,$prenom,$mail,$password,$pseudo){
        $retour = new stdClass();

        if ($this->existUsager($mail,$pseudo) == false){
            $mdp = password_hash($password, PASSWORD_DEFAULT);
            $admin = '0';
            $stmt = $this->_db->prepare("INSERT INTO " .self::TABLE . " (nom, prenom, mail, mdp, admin,pseudo) VALUES (?, ?, ?,?,?,?)");
            $stmt->bind_param("ssssis", $nom, $prenom, $mail,$mdp,$admin,$pseudo);
            $retour -> succes = true;
            $stmt->execute();
        }
        else{
            $retour -> succes = false;
        }

        return $retour -> succes;
    }

	/**
	 * Cette méthode retourne la liste des usagers correspondant au terme de
     * recherche passé en paramètre.
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param int $nbResultats Le nombre de résultat maximal à retourner.
	 * 
	 * @return array Attributs de l'usager pris dans la BD
	 */   
	public function autocomplete($nom, $nbResultats = 10) {		
		$nom = $this->_db->escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
        $nbResultats = (int) $nbResultats;
		 
		$sql = "
            SELECT * FROM vino__usager
            WHERE LOWER(nom) LIKE LOWER('%$nom%')
            OR LOWER(prenom) LIKE LOWER('%$nom%')
            OR LOWER(mail) LIKE LOWER('%$nom%')
            OR LOWER(pseudo) LIKE LOWER('%$nom%')
            LIMIT 0, $nbResultats
        ";

        $res = $this->_db->query($sql);
		$rows = Array();
        
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        
		return $rows;
	}
	
    /**
     * @param $identifiant
     * @param $password
     * @return stdClass
     * fonction de login dans l'application verification si la personne est admin ou non
     */
    public function login($identifiant,$password){
        $retour = new stdClass();
        $retour -> admin = false;
        $retour -> succes = false;


        $identifiantEscape = $this->_db->real_escape_string($identifiant);

        $stmt = "SELECT * FROM " . self::TABLE. " WHERE mail = '".$identifiantEscape ."' OR pseudo ='" . $identifiantEscape ."'";
        $stmt_result = $this->_db->query($stmt);

        if ($stmt_result->num_rows == 1) {
            $row_data = $stmt_result->fetch_assoc();
            if (password_verify($password, $row_data["mdp"])) {
                $_SESSION['user_pseudo'] = $row_data["pseudo"];
                $_SESSION['user_id'] = $row_data["id_usager"];
                $retour -> succes = true;
                if ($row_data["admin"] == 1){
                    $_SESSION['admin'] = $row_data["admin"];
                    $retour -> admin = true;
                }
                else{
                    $retour -> admin = false;
                }
            }
        }
        return $retour;
    }

	/**
	 * Vérifie si un usager est le propriétaire d'une bouteille.
	 * 
     * @param chaine $pseudo pseudo de l'usager
	 * @param int $idBouteille id de la bouteille
	 * 
	 * @return Boolean true si l'usager est le propriétaire, false sinon
	 */
	public function estProprietaireBouteille($pseudo, $idBouteille) {
        $pseudo = $this->_db->escape_string($pseudo);
        $idBouteille = (int) $idBouteille;
        
        $sql = "
            SELECT * FROM vino__bouteille b
            JOIN vino__cellier c ON b.id_cellier = c.id_cellier
            JOIN vino__usager u ON c.id_usager_cellier = u.id_usager
            WHERE pseudo = '$pseudo' AND id_bouteille = $idBouteille
        ";

        return (boolean) $this->_db->query($sql)->fetch_assoc();
    }
    
	/**
	 * Vérifie si un usager est le propriétaire d'un cellier.
	 * 
     * @param chaine $pseudo pseudo de l'usager
	 * @param int $idCellier id du cellier
	 * 
	 * @return Boolean true si l'usager est le propriétaire, false sinon
	 */
	public function estProprietaireCellier($pseudo, $idCellier) {
        $pseudo = $this->_db->escape_string($pseudo);
        $idCellier = (int) $idCellier;
        
        $sql = "
            SELECT * FROM vino__cellier c
            JOIN vino__usager u ON c.id_usager_cellier = u.id_usager
            WHERE pseudo = '$pseudo' AND id_cellier = $idCellier
        ";
        
        return (boolean) $this->_db->query($sql)->fetch_assoc();
    }
    
	/**
	 * Retourne le nombre d'usagers correspondant à certains critères.
	 * 
     * @param Array $criteres
     *        'admin' => (boolean)
     *
	 * @return int Le nombre d'usagers
	 */
	public function nbUsagers($criteres = []) {
        $sql = "SELECT COUNT(*) AS count FROM vino__usager WHERE 1 = 1";
        
        if (isset($criteres['admin'])) {
            $sql .= " AND admin = " . ($criteres['admin'] ? 'TRUE' : 'FALSE');
        }

        $res = $this->_db->query($sql);
        $row = $res->fetch_assoc();
        
        return (int) $row['count'];
    }

	/**
	 * Supprime un usager selon son id.
	 *
	 * @param int idUsager
	 *
     * @return int 1 si supprimé, 0 si inexistant
	 */
	public function supprimer($idUsager) {
        $idUsager = (int) $idUsager;
        
		$sql = "
            DELETE FROM vino__usager
            WHERE id_usager = $idUsager
        ";

		var_dump($sql);

        $this->_db->query($sql);
        
        return $this->_db->affected_rows;
	}
}