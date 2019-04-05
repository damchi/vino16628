<!--
    Page de gestion des usagers (admin)
-->

<script src="./js/gererUsagers.js"></script>

<div class="encadré">
    <div class="containeurBlanc divAdmin">
        <div class="form">
            <div>Recherche</div>

            <div class="group">
                <label class="icon_form"><i class="fas fa-search"></i></label>
                <input name="rechercheUsager">
            </div>
        </div>

        <div id="listeUsagers">
            <!-- templateUsager -->
        </div>
    </div>
</div>

<template id="templateUsager">
    <div class="usager itemListe" data-id="">
        <a href="index.php?requete=detailsUsager&idUsager=%id_usager%">
            <span class="description"></span>
        </a>
      
        <div class="boutons">
          <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button> 
        </div>
    </div>
</template>