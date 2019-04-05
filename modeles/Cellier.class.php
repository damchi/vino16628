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
     * @param $id du cellier
     * @return array
     * recupere les celliers usagers avec les informations de contenu
     */
    public function getUsagerCellier($id){  
        $cellier = Array();
        $stmt = "SELECT vino__cellier.image, vino__cellier.id_cellier, vino__cellier.nom, vino__cellier.id_usager_cellier, b.total, c.total_rouge, d.total_blanc, e.total_rose
                FROM vino__cellier 
                        LEFT JOIN (
                            SELECT count(*) as total, id_cellier 
                            FROM vino__bouteille  
                            where id_cellier IN (
                                SELECT id_cellier 
                                FROM vino__cellier 
                                WHERE id_usager_cellier = ". $id.")
                           GROUP BY vino__bouteille.id_cellier
                        ) as b ON  b.id_cellier = vino__cellier.id_cellier
                        
                      LEFT JOIN(
                            SELECT count(vino__bouteille.type) as total_rouge, id_cellier 
                            FROM vino__bouteille
                             WHERE vino__bouteille.type = 1 AND id_cellier IN (
                                    SELECT id_cellier 
                                    FROM vino__cellier 
                                    WHERE id_usager_cellier = ". $id .")
                               GROUP BY vino__bouteille.id_cellier
                            ) as c ON c.id_cellier = vino__cellier.id_cellier
                      LEFT JOIN(
                        SELECT count(vino__bouteille.type) as total_blanc, id_cellier 
                        FROM vino__bouteille
                         WHERE vino__bouteille.type = 2 AND id_cellier IN (
                                SELECT id_cellier 
                                FROM vino__cellier 
                                WHERE id_usager_cellier = " . $id .")
                           GROUP BY vino__bouteille.id_cellier
                        ) as d ON d.id_cellier = vino__cellier.id_cellier
                      LEFT JOIN(
                            SELECT count(vino__bouteille.type) as total_rose, id_cellier 
                            FROM vino__bouteille
                             WHERE vino__bouteille.type = 3 AND id_cellier IN (
                                    SELECT id_cellier 
                                    FROM vino__cellier 
                                    WHERE id_usager_cellier = " . $id .")
                               GROUP BY vino__bouteille.id_cellier
                            ) as e ON e.id_cellier = vino__cellier.id_cellier
                WHERE id_usager_cellier = " .$id;
        $stmt_result = $this->_db->query($stmt);

        if ($stmt_result->num_rows) {
            while ($rows = $stmt_result-> fetch_assoc()){
                $cellier[] = $rows;
            }
        }
//        $stmt->close();
        return $cellier;
    }

    /**
     * @param $nom du cellier
     * @param $id de l'usager
     * @return mixed inforamtion du cellier
     */
    public function ajoutCellierUsager($nom, $id) {
//            var_dump($_FILES["image"]);
        $nom = $this->_db->escape_string($nom);

//

        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];

            // Verifie extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            //taille max 5MB
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");


            if(in_array($filetype, $allowed)){
                // cree une string unique par image
                $key = '';
                $keys = array_merge(range(0, 9), range('a', 'z'));

                for ($i = 0; $i < 10; $i++) {
                    $key .= $keys[array_rand($keys)];
                }
                $filename = $key.$filename;
                $image = $this->_db->escape_string($filename);

                move_uploaded_file($_FILES["image"]["tmp_name"], "./images/" .$filename);

            } else{
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        }





        if (isset($image)){
            $sql = " INSERT INTO " .self::TABLE."(nom,image,id_usager_cellier) VALUES ('".$nom."','".$image."',".$id.")";
        }
        else{
            $sql = " INSERT INTO " .self::TABLE."(nom,id_usager_cellier) VALUES ('".$nom."',".$id.")";
        }


        $this->_db->query($sql);

        $id = $this->_db->insert_id;
        $result = $this->_db->query("SELECT * FROM ". self::TABLE." WHERE id_cellier = {$id}");
        $cellier = $result->fetch_object();
        return $cellier;


    }

    /**
     * @param $data information du cellier
     * @return mixed
     * suppression deu cellier
     */
    public function supprimeCellierUsager($data){
//        var_dump($data);
        $stmt = $this->_db->prepare("DELETE FROM " . self::TABLE. " WHERE id_cellier = ? ");
        $stmt->bind_param('i',$data->idCellier);
       return $stmt->execute();
    }


}