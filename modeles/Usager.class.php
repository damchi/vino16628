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
    public function existUsager($mail,$pseudo){
        try {
            #Prepare stmt or reports errors

            $stmt = $this->_db->prepare("SELECT * FROM " . self::TABLE. " WHERE mail = ? OR pseudo = ?" ) or trigger_error($stmt->error, E_USER_ERROR);;
            $stmt ->bind_param("ss",$mail,$pseudo );

            #Execute stmt or reports errors
            $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);

            #Save data or reports errors
            ($stmt_result = $stmt->get_result()) or trigger_error($stmt->error, E_USER_ERROR);

            #Check if are rows in query
            if ($stmt_result->num_rows > 0) {

                return true;

            } else {

                return false;
            }
            $stmt->close();

        } catch(Exception $e) {
            error_log($e->getMessage());
            exit('Error');
        }
    }

    /**
     * @param $data
     */
    public function ajoutNouveauUsager($data){
        var_dump($this->existUsager($data->mail,$data->pseudo));
        if ($this->existUsager($data->mail,$data->pseudo) == false){


            $mdp = password_hash($data->mdp, PASSWORD_DEFAULT);
            $admin = '0';

            $stmt = $this->_db->prepare("INSERT INTO " .self::TABLE . " (nom, prenom, mail, mdp, admin,pseudo) VALUES (?, ?, ?,?,?,?)");

            $stmt->bind_param("ssssis", $data->nom, $data->nom, $data->mail,$mdp,$admin,$data->pseudo);

            $stmt->execute();
        }
    }

}