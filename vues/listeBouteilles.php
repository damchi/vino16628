<div class="options carte-pied">
    <button><a href="index.php?requete=nouvelleBouteilleCellier&idCellier=<?= $data['idCellier'] ?>">Ajouter une bouteille</a></button>
</div>

<div class="listeBouteille">    

    <?php
//    foreach ($data['listeBouteilles'] as $cle => $bouteille) {
    ?>
    <?php foreach ($data['listeBouteilles'] as $cle => $bouteille) { ?>

    <!-- Carte -->
    <div class="carte bouteille" data-id="<?php echo $bouteille['id_bouteille'] ?>">

        <!-- Titre -->
        <div class="carte-titre">
            <h4><?php echo $bouteille['nom'] ?></h4>
        </div>

        <div class="carte-description">
            <!-- Icone -->
<!--            <h5><i class="fas fa-glass-cheers"></i> Vins</h5>-->

            <!-- Texte -->
            <p class="carte-texte">Quantité : <span class="quantite"><?php echo $bouteille['quantite'] ?></span></p>
            <p class="carte-texte">Pays : <?php echo $bouteille['pays'] ?></p>
            <p class="carte-texte">Type : <?php echo $bouteille['type'] ?></p>
            <p class="carte-texte">Millesime : <?php echo $bouteille['millesime'] ?></p>
            <p class="carte-texte"><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
        </div>

        <!-- Carte image -->
        <div class="carte-image">
            <img src="https:<?php echo $bouteille['url_img'] ?>" alt="Image de la bouteille">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>

        <!-- Bouton -->
        <div class="options carte-pied">
            <button class='btnAjouter'>Ajouter</button>
            <button class='btnBoire'>Boire</button>
            <button class='btnModifier'><a href="index.php?requete=modifierBouteille&idBouteille=<?= $bouteille['id_bouteille'] ?>">Modifier</a></button>
            <button class='btnSupprimer'>Supprimer</button>
        </div>
    </div>
    <!-- Carte -->
    
    <?php
    }
    ?>

</div>

<!--    --><?php //} ?>
</div>
