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
            return $cellier;
        }
//        $stmt->close();
    }

}