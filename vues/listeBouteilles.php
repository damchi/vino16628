

<div class="hautDePage">
    <!-- Bouton Ajouter une bouteille -->
    <div class="boutonSolo boutonHaut">
        <button><a href="index.php?requete=nouvelleBouteilleCellier&idCellier=<?= $data['idCellier'] ?>"><i class="fas fa-plus"></i>  Ajouter une bouteille</a></button>
    </div>

    <!-- Recherche Bouteille-->

    <div id="recherche_bouteille_cellier" class="group">
        <label class="icon_form"><i class="fas fa-search"></i></label>
        <input type="text" name="rechercheInfo" placeholder="Recherche">
    </div>
  
    <!--Bouton choisir affichage-->
    <div class="afficheListe">
        <button class="afficherListeBouteille"><i class="fas fa-list"></i></button>
        <button class="afficherVignetteBouteille"><i class="fas fa-th"></i></button>
    </div>

</div>

<div class="recherche">

    <ul class="listeAutoComplete"></ul>
    <input type="hidden" name="idCellier" value="<?= $_SESSION['idCellier']?>">
    <p>Filtrer par </p>

    <select name="pays">
        <option value="">Pays</option>
        <?php
        foreach ( $data['pays'] as  $pays){
            if ($pays['pays'] != ""){
                echo '<option value="'.$pays['pays'].' ">'.$pays['pays'].'</option>';
            }

        }
        ?>

    </select>
    <select name="millesime">
        <option value="">Millésimes</option>
        <?php
        foreach ( $data['millesime'] as  $millesime){
            if ($millesime['millesime'] != ""){
                echo '<option value="'.$millesime['millesime'].'">'.$millesime['millesime'].'</option>';
            }
        }
        ?>


    </select>
    <select name="type">
        <option value="">Type</option>
        <?php
        foreach ( $data['type'] as  $type){
            echo '<option value="'.$type['id_type']. '">'.$type['type'].'</option>';
        }
        ?>

    </select>
    <button id="reset"> Remettre à zéro</button>

    <div id="errorFiltre"></div>
</div>

<!--<div class="listeBouteilletab">

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>SAQ</th>
                <th>Type</th>
                <th>Pays</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Format</th>
                <th>Date d'achat</th>
                <th>Garder Jusqu'à</th>
                <th>Notes</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        <?php
/*        foreach ($data['listeBouteilles'] as $cle => $bouteille) {
        */?>
        <tr>
            <td><?php /*echo $bouteille['nom'] */?></td>
            <td><a href="<?php /*echo $bouteille['url_saq']*/?>">Saq</a></td>
            <td><?php /*echo $bouteille['type'] */?></td>
            <td><?php /*echo $bouteille['pays'] */?></td>
            <td><?php /*echo $bouteille['prix'] */?></td>
            <td><?php /*echo $bouteille['quantite'] */?></td>
            <td><?php /*echo $bouteille['format'] */?></td>
            <td><?php /*echo $bouteille['date_achat'] */?></td>
            <td><?php /*echo $bouteille['garde_jusqua'] */?></td>
            <td><?php /*echo $bouteille['notes'] */?></td>
            <td>
                <button class='btnAjouter'><i class="fas fa-plus"></i></button>
                <button class='btnBoire'><i class="fas fa-minus"></i></button>
                <button class='btnModifier'><a href="index.php?requete=modifierBouteille&idBouteille=<?/*= $bouteille['id_bouteille'] */?>"><i class="fas fa-edit"></i></a></button>
                <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>

		<?php
/*	    }
	    */?>
        </tbody>
    </table>
</div>-->

<div id="listeBouteille" class="listeBouteilleParVignette">
    <?php
    foreach ($data['listeBouteilles'] as $cle => $bouteille) {
    ?>

    <!-- Carte -->
    <div class="carte bouteille" data-id="<?php echo $bouteille['id_bouteille'] ?>">
        <!-- Titre -->
        <div class="carte-titre">
            <h4><?php echo $bouteille['nom'] ?></h4>
        </div>

        <div class="carte-information">
            <!-- Texte -->
            <div class="carte-quantite">Quantité : <span class="quantite"><?php echo $bouteille['quantite'] ?></span></div>
            <div class="carte-pays">Pays : <?php echo $bouteille['pays'] ?></div>
            <div class="carte-type">Type : <?php echo $bouteille['type'] ?></div>
            <div class="carte-millesime">Millesime : <?php echo $bouteille['millesime'] ?></div>
            <?php
            if ($bouteille['code_saq'] != null ) {
                ; ?>
                <div class="carte-code_saq">Code saq : <a
                            href="<?php echo $bouteille['url_saq'] ?>"><?php echo $bouteille['code_saq'] ?></a></div>
                <?php
            }
            ?>

<!--            <!-- Your share button code -->
<!--            <div class="fb-share-button"-->
<!--                 data-href="https://www.your-domain.com/your-page.html"-->
<!--                 data-layout="button_count">-->
<!--            </div>-->

        </div>

        <div class="carte-information_2">
            <!-- Texte -->
            <div class="carte-format"> Format : <?php echo $bouteille['format'] ?></span></div>
            <div class="carte-pays">Date achat : <?php echo $bouteille['date_achat'] ?></div>
            <div class="carte-type">garde jusqu'à : <?php echo $bouteille['garde_jusqua'] ?></div>
            <div class="carte-millesime">Notes : <?php echo $bouteille['notes'] ?></div>
        </div>

        <!-- Carte image -->
        <div class="carte-image">
            <?php

            if ($bouteille['url_img'] == null){
                ?>
                <img src="./images/bouteille_vin.png" alt="Image de la bouteille">

                <?php
            }
            else{
                ?>
                <img src="https:<?php echo $bouteille['url_img'] ?>" alt="Image de la bouteille">

                <?php
            }
            ?>
        </div>

        <!-- Bouton -->
        <div class="carte-pied">
            <button class='btnAjouter'><i class="fas fa-plus"></i></button>
            <button class='btnBoire'><i class="fas fa-minus"></i></button>
            <button class='btnModifier'><a href="index.php?requete=modifierBouteille&idBouteille=<?= $bouteille['id_bouteille'] ?>"><i class="fas fa-edit"></i></a></button>
            <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    
    <?php
    }
    ?>

</div>

<!--</div>-->
