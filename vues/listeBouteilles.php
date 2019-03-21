<!-- Bouton Ajouter une bouteille -->
<div class="boutonSolo boutonHaut">
    <button><a href="index.php?requete=nouvelleBouteilleCellier&idCellier=<?= $data['idCellier'] ?>"><i class="fas fa-plus"></i>  Ajouter une bouteille</a></button>
</div>

<div class="listeBouteille">    
    <?php
    foreach ($data['listeBouteilles'] as $cle => $bouteille) {
    ?>

    <!-- Carte -->
    <div class="carte bouteille" data-id="<?php echo $bouteille['id_bouteille'] ?>">
        <!-- Titre -->
        <div class="carte-titre">
            <h4><?php echo $bouteille['nom'] ?></h4>
        </div>

        <div class="carte-description">
            <!-- Texte -->
            <div class="carte-texte">Quantité : <span class="quantite"><?php echo $bouteille['quantite'] ?></span></div>
            <div class="carte-texte">Pays : <?php echo $bouteille['pays'] ?></div>
            <div class="carte-texte">Type : <?php echo $bouteille['type'] ?></div>
            <div class="carte-texte">Millesime : <?php echo $bouteille['millesime'] ?></div>
            <div class="carte-texte"><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></div>
        </div>

        <!-- Carte image -->
        <div class="carte-image">
            <img src="https:<?php echo $bouteille['url_img'] ?>" alt="Image de la bouteille">
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