<!--
    Tableau de bord de l'administrateur
-->

<div class="encadré">
    <div class="containeurBlanc">
        <div class="tableauBord">
        <h1 id="titreAdmin">Section d'administration</h1>
        <a href="?requete=gererUsagers">
            <section id="usager">
                <h2>Usagers</h2>
                <div class="statAdmin">
                    <h3>Nombre d'administrateurs : </h3>
                    <span class="grandNbr"><?= $data['nbAdmin'] ?></span>
                </div>
                <div class="statAdmin">
                    <h3>Nombre d'usagers : </h3>
                    <span class="grandNbr"><?= $data['nbUsagers'] ?></span>
                </div>
            </section id="catalogue">
            </a>
            <a href="?requete=gererCatalogueSaq">
                <section>
                    <h2>Catalogue SAQ</h2>
                    <div class="statAdminCat">
                        <h3>Nombre de produits dans le catalogue SAQ : </h3>
                        <span class="grandNbr"><?= $data['nbProduitsSaq'] ?></span>
                    </div>
                </section>
            </a>
        </div>
    </div>
</div>