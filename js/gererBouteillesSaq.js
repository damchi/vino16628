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
    
    const ulBouteillesSaq =
          document.getElementById('ulBouteillesSaq');
    
    const templateLiBouteilleSaq =
        document.getElementById('templateLiBouteilleSaq');
        
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
            BaseURL + "index.php?requete=autocompleteBouteille",
            {method: 'POST', body: '{"nom": "' + inputRecherche.value + '"}'}
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
            remplirUlBouteillesSaq(response);
        })
        .catch(error => {
            console.error(error);
        });        
    }
    
    function reinitialiserCatalogue() {
        let requete = new Request(
            BaseURL + "index.php?requete=reinitialiserCatalogue",
            {method: 'POST', body: '{}'}
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
            inputRecherche.value = '';
            chargerResultatRecherche();
        })
        .catch(error => {
            console.error(error);
        });        
    }

    /**
     *  Fait la requête Ajax pour supprimer une bouteille SAQ donnée et l'enlève du DOM.
     *  @param {int} idBouteilleSaq
     */
    function supprimerBouteilleSaq(idBouteilleSaq) {
        /*
            Requête Ajax de suppression
        */

        let requete = new Request(
            BaseURL + "index.php?requete=supprimerBouteilleSaq",
            {method: 'POST', body: '{"id": ' + idBouteilleSaq + '}'}
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
            /*
                On enlève la div du DOM au retour de la requête Ajax.
            */

            console.log(response);
            divBouteilleSaq(idBouteilleSaq).remove();
        })
        .catch(error => {
            console.error(error);
        });            
    }

    /**
     *  Vide la ul des bouteilles et y ajoute un li pour chacune des bouteilles
     *  de la liste.
     *
     *  @param Array listeBouteillesSaq
     */
    function remplirUlBouteillesSaq(listeBouteillesSaq) {
        ulBouteillesSaq.innerHTML = '';
        
        for (bouteille of listeBouteillesSaq) {
            /*
                Le li de la bouteille est composé à partir d'un template HTML.
            */
            
            let clone = document.importNode(
                templateLiBouteilleSaq.content, true
            );
            
            let li = clone.querySelector('li');
            
            /*
                On met l'id de la bouteille dans son attribut data-id et son
                nom dans le span .nom.
            */
            
            li.dataset.id = bouteille.id_bouteille_saq;
            li.querySelector('.nom').innerHTML = bouteille.nom;
            
            /*
                On insère le bon id de bouteille dans le lien du bouton
                modifier.
            */
            
            let lienModifier = li.querySelector(".btnModifier a");
            
            lienModifier.href = lienModifier.href.replace(
                /\(id_bouteille_saq\)/, bouteille.id_bouteille_saq
            );
            
            /*
                On ajoute l'event listener du bouton supprimer. Il demande une
                confirmation avant de supprimer la bouteille.
            */

            let boutonSupprimer = li.querySelector(".btnSupprimer");
            
            boutonSupprimer.addEventListener('click', evt => {
                let li = evt.target.closest('li');
                let idBouteilleSaq = li.dataset.id;
                let nom = li.querySelector(".nom").innerHTML;
                
                let texteConfirmation = (
                    "Suppression de la bouteille \"" + nom + "\""
                );

                if (confirm(texteConfirmation)) {
                    supprimerBouteilleSaq(idBouteilleSaq);
                }                
            });
            
            ulBouteillesSaq.appendChild(li);
        }
    }

    /**
     *  Retourne la div correspondant à une bouteille SAQ spécifiée par son id.
     *  @param {int} idBouteilleSaq l'id
     *  @returns {element} La div
     */
    function divBouteilleSaq(idBouteilleSaq) {
        return document.querySelector(
            ".bouteilleSaq[data-id='" + idBouteilleSaq + "']"
        );
    }
});
