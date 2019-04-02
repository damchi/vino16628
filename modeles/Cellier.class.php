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

//        $stmt = "SELECT * FROM " . self::TABLE. " WHERE id_usager_cellier = ".$id;
        $stmt = "SELECT vino__cellier.image, vino__cellier.id_cellier, vino__cellier.nom, vino__cellier.id_usager_cellier, b.total, c.total_rouge, d.total_blanc
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
                WHERE id_usager_cellier = 82";
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
     * @param $data
     * @return mixed
     */
    public function ajoutCellierUsager($data){
            var_dump($data);
//        $nom = $this->_db->escape_string($data->nomCellier);
//        var_dump($data->image);

//        $_FILES["image"] = $data['image'];
//
//
//        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
//
//            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
//            $filename = $_FILES["image"]["name"];
//            $filetype = $_FILES["image"]["type"];
//            $filesize = $_FILES["image"]["size"];
//
//            // Verify file extension
//            $ext = pathinfo($filename, PATHINFO_EXTENSION);
//            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
//
//            // Verify file size - 5MB maximum
//            $maxsize = 5 * 1024 * 1024;
//            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
//
//            // Verify MYME type of the file
//            if(in_array($filetype, $allowed)){
//
//
//                $key = '';
//                $keys = array_merge(range(0, 9), range('a', 'z'));
//
//                for ($i = 0; $i < 10; $i++) {
//                    $key .= $keys[array_rand($keys)];
//                }
//                $filename = $key.$filename;
//                $image = $this->_db->escape_string($filename);
//
//
//                // Check whether file exists before uploading it
////                if(file_exists("./images/" . $filename)){
////                    echo $filename . " is already exists.";
////                } else{
//                move_uploaded_file($_FILES["image"]["tmp_name"], "./images/" .$filename);
////                    echo "Your file was uploaded successfully.";
////                }
//            } else{
//                echo "Error: There was a problem uploading your file. Please try again.";
//            }
//        } else{
//            echo "Error: " . $_FILES["image"]["error"];
//        }
////
//
//
//
//
//        $sql = "
//            INSERT INTO " .self::TABLE. " (nom,image,id_usager_cellier)
//            VALUES ('$nom', '$image',$data->id)";

        $sql = " INSERT INTO " .self::TABLE."(nom,id_usager_cellier) VALUES ('".$nom."',".$data->id.")";
//        var_dump($sql);
//        die();
        $this->_db->query($sql);
        return $this->_db->insert_id;



//        $stmt = $this->_db->prepare("INSERT INTO " . self::TABLE. "(nom,id_usager_cellier) VALUES (?,?)");
//        $stmt->bind_param('si',$data->nomCellier,$data->id);
//        $stmt->execute();
//        return $this->_db->insert_id;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function supprimeCellierUsager($data){
//        var_dump($data);
        $stmt = $this->_db->prepare("DELETE FROM " . self::TABLE. " WHERE id_cellier = ? ");
        $stmt->bind_param('i',$data->idCellier);
       return $stmt->execute();
    }

//    public function countBouteille($data){
//        $stmt = " SELECT COUNT(*) FROM vino__bouteille where id_cellier = " . $data->idCellier;
//        $stmt_result = $this->_db->query($stmt);
//        return $stmt_result;
//    }

}