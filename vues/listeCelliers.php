<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 17/03/2019
 * Time: 14:58
 */
?>
<div class="ListeCelliers" >
    <button name="afficheFormCellier">Ajouter un cellier</button>

    <!--<div id="divCellier">
        <input type="text" required name="nomCellier" placeholder="Nouveau Cellier">
        <i class="fas fa-plus"></i>
        <div id="errorCellier"></div>
        <input type="hidden" name="idUsagerCellier" value="<?= $_SESSION['user_id']?>">-->
    </div>
    <?php
    foreach ($data as $cle => $cellier) {
    ?>

        <div class="listeCellier" data-id="<?= $cellier['id_cellier'] ?>">
            <a href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>' class="nomCellier">  <?= $cellier['nom']; ?> </a>
            <i class="btnCellier far fa-edit"></i>
            <i class="fas fa-trash-alt btnCellier"></i>
        </div>
    <?php
    }
    ?>
    <div class="cellierId" id="insertChild" data-id="">
    </div>
</div>


