<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 17/03/2019
 * Time: 14:58
 */
?>
<div class="cellier">
    <div class="">
<!--        <form method="post" action="index.php?requete=listeBouteilleCellier">-->

    <?php
    foreach ($data as $cle => $cellier) {
    ?>
            <div>
                <div> Nom du cellier:<a href='index.php?requete=listeBouteilleCellier&idCellier=<?=$cellier['id_cellier']?>' >  <?= $cellier['nom'];?> </a> </div>



                <!--                <input type="hidden" name="idCellier" value="--><?//= $cellier['id_cellier']?><!--">-->
<!--                <input type="submit" name="entrerCellier" value="Entrer dans le celllier">-->
<!--                <button class="entrerCellier" name="entrerCellier" data-id="--><?//= $cellier['id_cellier']?><!--">Entrer dans le cellier</button>-->
            </div>
    <?php
    }
?>
            <button name="ajouterCellier">Ajouter un cellier</button>
<!--        </form>-->

    </div>
</div>


