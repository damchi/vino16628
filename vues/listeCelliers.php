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
        <div class="boutonSolo boutonHaut">
            <button name="afficheFormCellier"><i class="fas fa-plus"></i>  Ajouter un cellier</button>
        </div>
        <div class="listeCelliers">
            <div id="divCellier">
                <form action="" id="formCellier">
                    <input type="text" required name="nomCellier" placeholder="Nouveau Cellier">
                    <button name="ajouterCellier"> <i class="fas fa-plus">  </i> </button>
                    <div id="errorCellier"></div>
                    <input type="hidden" name="idUsagerCellier" value="<?= $_SESSION['user_id']?>">
                </form>
            </div>
            <?php
            foreach ($data as $cle => $cellier) {
            ?>

                 <div class="cellierId listeCellier" data-id="<?= $cellier['id_cellier'] ?>">
                     <a class="nomCellier" href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>'>  <?= $cellier['nom']; ?> </a>
                     <button class="modifierCellier btnCellier" id="modifCellier"><i class="fas fa-edit"></i></button>
                     <button class="supprimerCellier btnCellier"><i class="fas fa-trash-alt"></i></button>
                 </div>

            <?php
            }
            ?>
            <div class="cellierId" id="insertChild" data-id=""></div>
        </div>
    </div>
</div>


