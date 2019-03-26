<?php
/*
    Vue du catalogue des bouteilles de la SAQ (admin)
*/
?>

<h1>Page de gestion des bouteilles SAQ</h1>

<ul class="listeBouteillesSaq">
    <?php
    foreach ($data['bouteilles'] as $bouteille) {
        ?>
        <li class="bouteilleSaq" data-id="<?= $bouteille['id_bouteille_saq'] ?>">
            <span class="nom"><?= $bouteille['nom'] ?></span>
            &nbsp;(Code SAQ <span class="codeSaq"><?= $bouteille['code_saq'] ?></span>)
            
            <div class="boutons">
                <button class='btnModifier'><a href="index.php?requete=modifierBouteilleSaq&idBouteilleSaq=<?= $bouteille['id_bouteille_saq'] ?>"><i class="fas fa-edit"></i></a></button>
                <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button>                
            </div>
        </li>
        <?php
    }
    ?>    
</ul>