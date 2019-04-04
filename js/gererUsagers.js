/**
 * @file Script contenant les fonctions de la page de gestion des usagers SAQ
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Éléments de la page
    */
    
    const inputRecherche =
        document.querySelector('[name="rechercheUsager"]');
    
    const divListeUsagers =
          document.getElementById('listeUsagers');
    
    const templateUsager =
        document.getElementById('templateUsager');
        
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
            "index.php?requete=autocompleteUsager",
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
            remplirDivListeUsagers(response);
        })
        .catch(error => {
            console.error(error);
        });        
    }
    
    /**
     *  Fait la requête Ajax pour supprimer une usager SAQ donnée et l'enlève du DOM.
     *  @param {int} idBouteille
     */
    function supprimerUsager(idUsager) {
        /*
            Requête Ajax de suppression
        */

        let requete = new Request(
            BaseURL + "index.php?requete=supprimerUsager",
            {method: 'POST', body: '{"id": ' + idUsager + '}'}
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

            let divUsager = divListeUsagers.querySelector(
                ".usager[data-id='" + idUsager + "']"
            );

            divUsager.remove();
        })
        .catch(error => {
            console.error(error);
        });            
    }

    /**
     *  Vide la div liste usagers et y ajoute une div avec les informations
     *  sur l'usager pour chacun des usagers du tableau passé en paramètre.
     *
     *  @param Array listeUsagers
     */
    function remplirDivListeUsagers(listeUsagers) {
        divListeUsagers.innerHTML = '';
        
        for (usager of listeUsagers) {
            /*
                La div usager est composée à partir d'un template HTML.
            */
            
            let clone = document.importNode(
                templateUsager.content, true
            );
            
            let divUsager = clone.querySelector('.usager');
                        
            /*
                L'id de la usager est stocké dans l'attribut data-id de la
                div usager. Les autres attributs ont chacun leur élément à
                l'intérieur de la div.
            */
            
            divUsager.dataset.id = usager.id_usager;
            let description = usager.pseudo;
            description += (usager.admin == '1') ? ' (admin)' : '';
            divUsager.querySelector('.description').innerHTML = description;
            
            /*
                On insère le bon id de usager dans le lien du bouton
                modifier à la place du texte "%id_usager%".
            */
            
//            let lienModifier = divUsager.querySelector(".btnModifier a");
//            
//            lienModifier.href = lienModifier.href.replace(
//                /%id_usager_saq%/, usager.id_usager_saq
//            );
            
            /*
                On ajoute l'event listener du bouton supprimer. Il demande une
                confirmation avant de supprimer la usager.
            */

            let boutonSupprimer = divUsager.querySelector(".btnSupprimer");
            
            boutonSupprimer.addEventListener('click', evt => {
                let divUsager = evt.target.closest('.usager');
                let idUsager = divUsager.dataset.id;
                let description = divUsager.querySelector(".description").innerHTML;
                
                let texteConfirmation = (
                    "Suppression de l'usager \"" + description + "\""
                );

                if (confirm(texteConfirmation)) {
                    supprimerUsager(idUsager);
                }                
            });
            
            divListeUsagers.appendChild(divUsager);
        }
    }
});
