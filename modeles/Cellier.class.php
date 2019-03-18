<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 15/03/2019
 * Time: 11:11
 */

class Cellier extends Modele
{
    const TABLE ='vino__cellier';

    /**
     * @param $id
     * @return array
     */
    public function getUsagerCellier($id){
        $cellier = Array();

        $stmt = "SELECT * FROM " . self::TABLE. " WHERE id_usager_cellier = ".$id;
        $stmt_result = $this->_db->query($stmt);

        if ($stmt_result->num_rows) {
            while ($rows = $stmt_result-> fetch_assoc()){
                $cellier[] = $rows;
            }
        }
//        $stmt->close();
        return $cellier;
    }

    public function ajoutCellierUsager($data){
        $stmt = $this->_db->prepare("INSERT INTO " . self::TABLE. "(nom,id_usager_cellier) VALUES (?,?)");
        $stmt->bind_param('si',$data->nomCellier,$data->id);
        $stmt->execute();
        return $this->_db->insert_id;
    }
}