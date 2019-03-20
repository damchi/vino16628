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

    <div id="formCellier">
        <p> Nom du cellier : <input type="text" required name="nomCellier"></p>
        <div id="errorCellier"></div>
        <input type="hidden" name="idUsagerCellier" value="<?= $_SESSION['user_id']?>">
        <button name="ajouterCellier">Enregistrer</button>
    </div>

    <?php
    foreach ($data as $cle => $cellier) {
    ?>

         <div class="cellierId" data-id="<?= $cellier['id_cellier'] ?>">
             <a href='index.php?requete=listeBouteilleCellier&idCellier=<?= $cellier['id_cellier'] ?>'>  <?= $cellier['nom']; ?> </a>
             <button class="modifierCellier">  Modifier </button>
             <button class="supprimerCellier">  Supprimer</button>
         </div>
    <?php
    }
    ?>
    <div class="cellierId" id="insertChild" data-id="">
    </div>
</div>


