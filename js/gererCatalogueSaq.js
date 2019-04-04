/**
 * @file Script contenant les fonctions de la page de gestion des bouteilles SAQ
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Éléments de la page
    */
    
    const boutonReinitialiser =
        document.getElementById('reinitialiserCatalogue');
    
    const inputRecherche =
        document.querySelector('[name="rechercheCatalogue"]');
    
    const divListeBouteilles =
          document.getElementById('listeBouteilles');
    
    const templateBouteille =
        document.getElementById('templateBouteille');
        
    /*
        Le bouton "réinitialiser le catalogue" demande une confirmation avant
        d'effacer le catalogue existant et d'importer la liste des bouteilles
        depuis le site de la SAQ. On vide ensuite l'input de recherche et on
        recharge les résultats.
    */
    
    boutonReinitialiser.addEventListener('click', () => {
        let texteConfirmation =
            "Le catalogue actuel sera supprimé et la liste des bouteilles " +
            "sera importée depuis le site de la SAQ. " +
            "Êtes-vous sûr de vouloir continuer?";

        if (confirm(texteConfirmation)) {
            reinitialiserCatalogue();
        }   
    });
    
    /*
        L'input recherche est un autocomplete qui remplit la liste au fur et à
        mesure qu'on tape des lettres.
    */

    inputRecherche.addEventListener('keyup', () => {
        chargerResultatRecherche();
    });
    
    /*
        On remplit la liste avec la recherche vide lors de l'initialisation de
        la page.
    */
    
    chargerResultatRecherche();
    
    function chargerResultatRecherche() {
        let requete = new Request(
            "index.php?requete=autocompleteBouteille",
            {method: 'POST', body: '{"nom": "' + inputRecherche.value + '"}'}
        );

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
            remplirDivListeBouteilles(response);
        })
        .catch(error => {
            console.error(error);
        });        
    }
    
    function reinitialiserCatalogue() {
        let requete = new Request(
            "index.php?requete=reinitialiserCatalogue",
            {method: 'POST', body: '{}'}
        );

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
            inputRecherche.value = '';
            chargerResultatRecherche();
        })
        .catch(error => {
            console.error(error);
        });        
    }

    /**
     *  Fait la requête Ajax pour supprimer une bouteille SAQ donnée et l'enlève du DOM.
     *  @param {int} idBouteille
     */
    function supprimerBouteille(idBouteille) {
        /*
            Requête Ajax de suppression
        */

        let requete = new Request(
            BaseURL + "index.php?requete=supprimerBouteilleSaq",
            {method: 'POST', body: '{"id": ' + idBouteille + '}'}
        );

        fetch(requete).then(response => {
            if (response.status === 200) {
                return response.json();
            }
            else {
                throw new Error('Erreur');
            }
        })
        .then(response => {
            /*
                On enlève la div du DOM au retour de la requête Ajax.
            */

            let divBouteille = divListeBouteilles.querySelector(
                ".bouteille[data-id='" + idBouteille + "']"
            );

            divBouteille.remove();
        })
        .catch(error => {
            console.error(error);
        });            
    }

    /**
     *  Vide la div liste bouteilles et y ajoute une div avec les informations
     *  sur la bouteille pour chacune des bouteilles du tableau passé en
     *  paramètre.
     *
     *  @param Array listeBouteilles
     */
    function remplirDivListeBouteilles(listeBouteilles) {
        divListeBouteilles.innerHTML = '';
        
        for (bouteille of listeBouteilles) {
            /*
                La div bouteille est composée à partir d'un template HTML.
            */
            
            let clone = document.importNode(
                templateBouteille.content, true
            );
            
            let divBouteille = clone.querySelector('.bouteille');
            
            /*
                L'id de la bouteille est stocké dans l'attribut data-id de la
                div bouteille. Les autres attributs ont chacun leur élément à
                l'intérieur de la div.
            */
            
            divBouteille.dataset.id = bouteille.id_bouteille_saq;
            divBouteille.querySelector('.nom').innerHTML = bouteille.nom;
            
            /*
                On insère le bon id de bouteille dans le lien du bouton
                modifier à la place du texte "%id_bouteille_saq%".
            */
            
            let lienModifier = divBouteille.querySelector(".btnModifier a");
            
            lienModifier.href = lienModifier.href.replace(
                /%id_bouteille_saq%/, bouteille.id_bouteille_saq
            );
            
            /*
                On ajoute l'event listener du bouton supprimer. Il demande une
                confirmation avant de supprimer la bouteille.
            */

            let boutonSupprimer = divBouteille.querySelector(".btnSupprimer");
            
            boutonSupprimer.addEventListener('click', evt => {
                let divBouteille = evt.target.closest('.bouteille');
                let idBouteille = divBouteille.dataset.id;
                let nom = divBouteille.querySelector(".nom").innerHTML;
                
                let texteConfirmation = (
                    "Suppression de la bouteille \"" + nom + "\""
                );

                if (confirm(texteConfirmation)) {
                    supprimerBouteille(idBouteille);
                }                
            });
            
            divListeBouteilles.appendChild(divBouteille);
        }
    }

    /**
     *  Retourne la div correspondant à une bouteille SAQ spécifiée par son id.
     *  @param {int} idBouteille l'id
     *  @returns {element} La div
     */
    function divBouteille(idBouteille) {
        return document.querySelector(
            ".bouteilleSaq[data-id='" + idBouteille + "']"
        );
    }
});
