<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 17/03/2019
 * Time: 14:58
 */
?>
<div class="ListeCelliers" >
    <button name="afficheFormCellier"><i class="fas fa-plus">Ajouter un cellier</i></button>

    <!--<div id="divCellier">
        <input type="text" required name="nomCellier" placeholder="Nouveau Cellier">
        <i class="fas fa-plus"></i>
        <div id="errorCellier"></div>
        <input type="hidden" name="idUsagerCellier" value="<?= $_SESSION['user_id']?>">-->
<!--    </div>-->

    <?php
    foreach ($data as $cle => $cellier) {
    ?>

         <div class="cellierId listeCellier" data-id="<?= $cellier['id_cellier'] ?>">
             <a href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>'>  <?= $cellier['nom']; ?> </a>
             <button class="modifierCellier" id="modifCellier"><i class="fas fa-edit"></i></button>
             <button class="supprimerCellier"><i class="fas fa-trash-alt"></i></button>
         </div>

    <?php
    }
    ?>
    <div class="cellierId" id="insertChild" data-id="">
    </div>
</div>


