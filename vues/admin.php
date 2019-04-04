<!--
    Tableau de bord de l'administrateur
-->

<div class="encadré">
    <div class="containeurBlanc">
        <div class="tableauBord">
            <section>
                <h2>Usagers</h2>
                <p>
                    <span>Nombre d'administrateurs : </span>
                    <?= $data['nbAdmin'] ?>
                </p>
                <p>
                    <span>Nombre d'usagers : </span>
                    <?= $data['nbUsagers'] ?>
                </p>
            </section>
            <a href="?requete=gererCatalogueSaq">
                <section>
                    <h2>Catalogue SAQ</h2>
                    <p>
                        <span>Nombre de produits dans le catalogue SAQ : </span>
                        <?= $data['nbProduitsSaq'] ?>
                    </p>
                </section>
            </a>
        </div>
    </div>
</div>