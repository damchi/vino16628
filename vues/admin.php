<!--
    Tableau de bord de l'administrateur
-->

<div class="encadré">
    <div class="containeurBlanc">
        <div class="tableauBord">
        <h1>Section d'administration</h1>
            <section id="usager">
            <a href="?requete=gererUsagers">
                <h2>Usagers</h2>
                <p>
                    <span>Nombre d'administrateurs : </span>
                    <span class="grandNbr"><?= $data['nbAdmin'] ?></span>
                </p>
                <p>
                    <span>Nombre d'usagers : </span>
                    <span class="grandNbr"><?= $data['nbUsagers'] ?></span>
                </p>
            </section id="catalogue">
            <a href="?requete=gererCatalogueSaq">
                <section>
                    <h2>Catalogue SAQ</h2>
                    <p>
                        <span>Nombre de produits dans le catalogue SAQ : </span>
                        <span class="grandNbr"><?= $data['nbProduitsSaq'] ?></span>
                    </p>
                </section>
            </a>
        </div>
    </div>
</div>