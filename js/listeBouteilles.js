/**
 * @file Code spécifique à la page de liste des bouteilles d'un cellier (vue listeBouteilles.php)
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Encadre l'image de la bouteille en rouge et rend visible le bouton supprimer si la quantité de la bouteille est zéro.
    */

    function ajusterDivBouteilleSelonQuantite(divBouteille) {
        let btnSupprimer = divBouteille.querySelector('.btnSupprimer');
        let quantite = divBouteille.querySelector('.quantite').innerHTML;
        divBouteille.querySelector('.carte-image').style.border = (quantite > 0) ? "" : "2px solid red";
        btnSupprimer.style.display = (quantite > 0) ? 'none' : 'inline';
    }

    /*
        Met à jour la quantité d'une bouteille donnée dans le DOM et ajuste la visibilité du bouton supprimer en conséquence.
    */

    function ajusterQuantiteDom(idBouteille, quantite) {
        let divBouteille = document.querySelector(".bouteille[data-id='" + idBouteille + "']");
        divBouteille.querySelector(".quantite").innerHTML = quantite;
        ajusterDivBouteilleSelonQuantite(divBouteille);
    }

    /*
        Retire une bouteille du DOM.
    */

    function retirerBouteilleDom(idBouteille) {
        let divBouteille = document.querySelector(".bouteille[data-id='" + idBouteille + "']");
        divBouteille.remove();
    }

    /*
        Fait la requête Ajax pour modifier la quantite d'une bouteille donnée et modifie la quantité dans le DOM avec la nouvelle valeur.
    */

    function modifierQuantite(nomRequete, idBouteille) {
        let requete = new Request(
            BaseURL + "index.php?requete=" + nomRequete,
            {method: 'POST', body: '{"id": ' + idBouteille + '}'}
        );

        console.log(requete);

        fetch(requete).then(response => {
            if (response.status === 200) {
                return response.json();
            }
            else {
                throw new Error('Erreur');
            }
        })
        .then(response => {
            console.log(response);
            ajusterQuantiteDom(idBouteille, response.quantite);
        })
        .catch(error => {
            console.error(error);
        });
    }

    /*
        Fait la requête Ajax pour supprimer une bouteille donnée et l'enlève du DOM.
    */

    function supprimerBouteille(idBouteille) {
        let requete = new Request(
            BaseURL + "index.php?requete=supprimerBouteille",
            {method: 'POST', body: '{"id": ' + idBouteille + '}'}
        );

        console.log(requete);

        fetch(requete).then(response => {
            if (response.status === 200) {
                return response.json();
            }
            else {
                throw new Error('Erreur');
            }
        })
        .then(response => {
            console.log(response);
            retirerBouteilleDom(idBouteille);
        })
        .catch(error => {
            console.error(error);
        });
    }

    /*
        Pour chaque div bouteille :

            - Le bouton boire diminue la quantié de la bouteille dans le cellier;
            - Le bouton ajouter diminue la quantité de la bouteille dans le cellier;
            - Le bouton supprimer supprime la bouteille;
            - Bouton supprimer visible et cadre rouge si la quantité est zéro.
    */

    document.querySelectorAll('.bouteille').forEach(divBouteille => {
        let idBouteille = divBouteille.dataset.id;

        divBouteille.querySelector(".btnBoire").addEventListener('click', evt => {
            modifierQuantite('boireBouteilleCellier', idBouteille);
        });

        divBouteille.querySelector(".btnAjouter").addEventListener('click', evt => {
            modifierQuantite('ajouterBouteilleCellier', idBouteille);
        });

        divBouteille.querySelector(".btnSupprimer").addEventListener('click', evt => {
            supprimerBouteille(idBouteille);
        });

        ajusterDivBouteilleSelonQuantite(divBouteille);
    });

    /**************FONCTION DE FILTRE******************/
    /*
    * div d'affichage du message d'erreur en cas de non resultat
    * */
    let errorFiltre = document.getElementById('errorFiltre');

    /**
     * div du change text recherche
     * @type {HTMLElement | null}
     */
    let rechercheCellier = document.querySelector("[name ='rechercheInfo']");

    /**
     * @param response retour du fecth
     * traite le resultat de la recherche et du filtre
     */
    function resultatRecherche(response){
        console.log(response.length);
        if (response.length === 0){
            console.log('ee');
            let output = " Désolé aucun vin ne correspond à vos critères dans votre cellier";
            errorFiltre.innerHTML = output;
            errorFiltre.style.color='red';
            if (errorFiltre.style.display='none'){
                errorFiltre.style.display='block'
            }
        }
        else {
            // console.log(response.id_bouteille);
            /**
             * @param idResponse
             * array des id des bouteilles trouvés dans les filtres ou recherche
             **/
            let idResponse = [];

            for ( var i =0; i<response.length; i++){
                idResponse.push(response[i].id_bouteille)
            }

            /*
            * Si l'id des bouteilles affichées est présent dans idResponse alors il est affiché sinon non
            **/
            divBouteille.forEach((bouteille)=>{
                bouteille.style.display = 'grid';
                // idDiv.push(bouteille.dataset.id)
                console.log();
                if (idResponse.includes(bouteille.dataset.id) == false){
                    bouteille.style.display = 'none';
                }
            });
        }
    }

    /**
     * Remise à zéro de la recherche
     */
    function resetRecherche() {
        divBouteille.forEach((bouteille)=>{
            bouteille.style.display = 'grid';
            reset.style.display='none';
            errorFiltre.style.display='none';

            document.querySelector("[name = 'millesime']").value = "";
            document.querySelector("[name = 'pays']").value ="";
            document.querySelector("[name = 'type']").value ="";
            document.querySelector("[name ='rechercheInfo']").value = "";
        });
    }

    /**
     *
     * @type {Element | null}
     * div avec les select pour les filtre
     */
    let selectRecherche = document.querySelector('.recherche');

    /**
     * Liste des vignettes de bouteilles
     * */
    let divBouteille = document.querySelectorAll(".bouteille");

    let reset = document.getElementById("reset");

    if (reset){
        reset.addEventListener('click',()=>{
            resetRecherche();
        });
    }


    if(selectRecherche){
        /**
         * Pour chaque select de filtre les bouteilles choisis sont affihés
         */
        selectRecherche.addEventListener('change',()=>{
            /**
             * affichage du bouton remise a zéro quand le select sont touchés
             * */
            reset.style.display ='grid';


            let idCellier = document.querySelector("[name = 'idCellier']").value;
            let millesime = document.querySelector("[name = 'millesime']").value;
            let pays = document.querySelector("[name = 'pays']").value;
            let type = document.querySelector("[name = 'type']").value;


            // console.log(select);
            // console.log(millesime);
            // console.log(pays);
            // console.log(type);

            var param ={
                "millesime" : millesime,
                "pays": pays,
                "type" : type,
                "id" : idCellier
            };

            // console.log(param);

            let requete = new Request(BaseURL + "index.php?requete=filtre",{method:'POST', body: JSON.stringify(param)});

            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        // console.log(response.json());
                        return response.json();
                    }
                    else {
                        throw new Error('Erreur');
                    }
                })
                .then(response=>{
                    console.log(response);
                    resultatRecherche(response);
                });
        });
    }
    console.log(rechercheCellier);
    if (rechercheCellier){
        let liste = document.querySelector('.listeAutoComplete');

        rechercheCellier.addEventListener("keyup", function(evt){
            /**
             * affichage du bouton remise a zéro quand le champ de recherche est touché
             * */
            reset.style.display ='grid';

            console.log(evt);

            let nom = rechercheCellier.value;
            console.log(nom);
            liste.innerHTML = "";

            if(nom){
                let requete = new Request(
                    BaseURL+"index.php?requete=autocompleteBouteilleListe",
                    {method: 'POST', body: '{"nom": "'+nom+'"}'}
                );

                console.log(requete);

                fetch(requete).then(response => {
                    if (response.status === 200) {
                        return response.json();
                    }
                    else {
                        throw new Error('Erreur');
                    }
                })
                    .then(response => {
                        console.log(response);
                        resultatRecherche(response);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    }

    /* Afficher la liste des bouteille par liste ou par vignette*/
    let listeBouteille = document.querySelector('.afficherListeBouteille');
    if(listeBouteille){
        let bouteille = document.getElementById('listeBouteille');
        listeBouteille.addEventListener('click', function(){
            if(bouteille.classList.contains('listeBouteilleParListe')){
                bouteille.classList.remove('listeBouteilleParListe');
                bouteille.classList.add('listeBouteilleParVignette')
                listeBouteille.innerHTML = '<i class="fas fa-list"></i>';
            }else{
                bouteille.classList.remove('listeBouteilleParVignette');
                bouteille.classList.add('listeBouteilleParListe');
                listeBouteille.innerHTML = '<i class="fas fa-th"></i>';
            }
        });
    }

    /* Afficher la Filtre de recherche*/
    var recherche = document.querySelector('.recherche button');
    if(recherche){
        var filtreRecherche = document.getElementById('filtreRecherche');
        recherche.addEventListener('click', function () {
            if (filtreRecherche.style.display === 'none'){
                recherche.innerHTML = 'Filtrer par &nbsp; <i class="fas fa-angle-up"></i>';
                filtreRecherche.style.display = 'block';
     
            }else{
                recherche.innerHTML = 'Filtrer par &nbsp; <i class="fas fa-angle-down"></i>';
                filtreRecherche.style.display = 'none';
     
            }
         });    
    }
    


});