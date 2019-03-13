<div class="cellier">
    <div class="row">
<?php
foreach ($data as $cle => $bouteille) {
 
    ?>

    <!-- Card Narrower -->
    <div class="card card-cascade narrower col-lg-4 col-sm-6 mb-4">

        <!-- Card image -->
        <div class="view view-cascade overlay">
            <img  class="card-img-top" src="https:<?php echo $bouteille['image'] ?>" alt="Card image cap">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>

        <!-- Card content -->
        <div class="card-body card-body-cascade">

            <!-- Label -->
            <h5 class="purple-text pb-2 pt-1"><i class="fas fa-glass-cheers"></i> Vins</h5>

            <!-- Title -->
            <h4 class="font-weight-bold card-title"><?php echo $bouteille['nom'] ?></h4>

            <!-- Text -->
            <p class="card-text">
                <span>Quantité : <?php echo $bouteille['quantite'] ?></span>
            </p>
            <p class="card-text">Pays : <?php echo $bouteille['pays'] ?></p>
            <p class="card-text">Type : <?php echo $bouteille['type'] ?></p>
            <p class="card-text">Millesime : <?php echo $bouteille['millesime'] ?></p>
            <p class="card-text"><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>

            <!-- Button -->
            <div class="options" data-id="<?php echo $bouteille['id_bouteille'] ?>">
                <button>Modifier</button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>

            </div>
        </div>
    </div>
    <!-- Card Narrower -->







    <!--<div class="bouteille" data-quantite="">
        <div class="img">
            
            <img src="https:<?php /*echo $bouteille['image'] */?>">
        </div>
        <div class="description">
            <p class="nom">Nom : <?php /*echo $bouteille['nom'] */?></p>
            <p class="quantite">Quantité : <?php /*echo $bouteille['quantite'] */?></p>
            <p class="pays">Pays : <?php /*echo $bouteille['pays'] */?></p>
            <p class="type">Type : <?php /*echo $bouteille['type'] */?></p>
            <p class="millesime">Millesime : <?php /*echo $bouteille['millesime'] */?></p>
            <p><a href="<?php /*echo $bouteille['url_saq'] */?>">Voir SAQ</a></p>
        </div>
        <div class="options" data-id="<?php /*echo $bouteille['id_bouteille'] */?>">
            <button>Modifier</button>
            <button class='btnAjouter'>Ajouter</button>
            <button class='btnBoire'>Boire</button>
            
        </div>
    </div>-->
<?php


}

?>
    </div>
</div>


