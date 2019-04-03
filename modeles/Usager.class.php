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
        
        $res = $this->_db->query($sql);
        $row = $res->fetch_assoc();
        
        return $row ? true : false;
    }


//    public function ajoutNouveauUsager($data){


    /**
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $password
     * @param $pseudo
     * @return mixed
     */
    public function ajoutNouveauUsager($nom,$prenom,$mail,$password,$pseudo){
        $retour = new stdClass();

        if ($this->existUsager($mail,$pseudo) == false){
            //            $mdp = password_hash($data->mdp, PASSWORD_DEFAULT);
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

        return $retour-> succes;
    }


    /**
     * @param $identifiant
     * @param $password
     * @return stdClass
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
	 * @param int $idCellier id du cellier
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
}