<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 17/03/2019
 * Time: 14:58
 */
?>
<div class="encadré">
    <div class="containeurBlanc">
        <div class="sous-menu">
            <div name="afficheFormCellier"><p><i class="fas fa-plus"></i>  Ajouter un Cellier</p>
            </div>
            <div class="listeCelliers" >
                <div id="divCellier">
                    <div id="formCellier">
    <!--                <div action="" id="formCellier">-->
                        <label for="imageCellier" class="labelImg">Choisir une image</label>
                        <input type="file" class="input" name="image"  id="imageCellier" accept="image/*">
                        <input type="text" required name="nomCellier" placeholder="Nom du Cellier">
                        <button name="ajouterCellier"> <i class="fas fa-plus">  </i> </button>
                        <div id="errorCellier"></div>
                        <input type="hidden" name="idUsagerCellier" value="<?= $_SESSION['user_id']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="containerCellier" id="insertChild">

        <?php
            foreach ($data as $cle => $cellier) {
            ?>
                    <div class="cellierId listeCellier" data-id="<?= $cellier['id_cellier'] ?>" >

                            <div class="divImgCellier">
                                <a class="nomCellier" href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>'>

                                <?php
                                if ($cellier['image']  === null) {
                                    ?>
                                    <img src="./images/cellier.png" class="imgCellier">
                                    <?php
                                }
                                else{
                                    ?>
                                    <img src="./images/<?=$cellier['image'];?>" class="imgCellier" alt="Image du cellier">
                                    <?php
                                }
                                ?>
                                </a>

                            </div>
                        <div class="divTexteCellier">
                            <h2><a class="nomCellier" href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>'>  <?= $cellier['nom']; ?></a></h2>
                            <?php
                            //                        if($cellier['total'] != null){
                            ?>
                            <div class="mc">
                                <p>Nombre de bouteilles :
                                    <?php
                                    if($cellier['total'] != null){
                                        echo $cellier['total'];
                                    }
                                    else{
                                        echo "0";
                                    }?> </p>

                                <p>Nombre de bouteilles Rouge : <?php
                                    if ($cellier['total_rouge'] != null) {
                                        echo $cellier['total_rouge'];
                                    }
                                    else{
                                        echo "0";
                                    }?></p>

                                <p>Nombre de bouteilles Blanc :
                                    <?php if ($cellier['total_blanc'] != null) {
                                        echo $cellier['total_blanc'];
                                    }
                                    else{
                                        echo "0";
                                    }?></p>
                                <p>Nombre de bouteilles Rosé :
                                    <?php if ($cellier['total_rose'] != null) {
                                        echo $cellier['total_rose'];
                                    }
                                    else{
                                        echo "0";
                                    }?></p>

                            </div>
                            <?php

                            ?>
                        </div>
                        <div class="divBtnCellier">
<!--                            <div class="modifierCellier btnCellier" > <i class="fas fa-edit"></i></div>-->
                            <div class="supprimerCellier btnCellier"><i class="fas fa-trash-alt"></i></div>
                        </div>
                    </div>
            <?php
            }
            ?>
        </div>


    </div>
    </div>
</div>


