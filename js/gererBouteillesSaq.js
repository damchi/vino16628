/**
 * @file Script contenant les fonctions de la page de gestion des bouteilles SAQ
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    const inputRecherche = document.querySelector(
        "[name='rechercheCatalogue']"
    );
    
    const ulBouteillesSaq = document.getElementById("ulBouteillesSaq");
    
    const templateLiBouteilleSaq = document.getElementById(
        "templateLiBouteilleSaq"
    );
    
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
    
    /**
     *  ait la requête Ajax pour supprimer une bouteille SAQ donnée et l'enlève du DOM.
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
            
            let aBtnModifier = li.querySelector(".btnModifier a");
            
            aBtnModifier.href = aBtnModifier.href.replace(
                /\(id_bouteille_saq\)/, bouteille.id_bouteille_saq
            );
            
            /*
                On ajoute l'event listener du bouton supprimer. Il demande une
                confirmation avant de supprimer la bouteille.
            */
            
            li.querySelector(".btnSupprimer").addEventListener('click', evt => {
                let li = evt.target.closest('li');
                let idBouteilleSaq = li.dataset.id;
                let nom = li.querySelector(".nom").innerHTML;
                
                let texteConfirm = (
                    "Suppression de la bouteille \"" + nom + "\""
                );

                if (confirm(texteConfirm)) {
                    supprimerBouteilleSaq(idBouteilleSaq);
                }                
            });
            
            ulBouteillesSaq.appendChild(li);
        }
    }
    
    /*
        L'input recherche est un autocomplete qui remplit la liste.
    */

    inputRecherche.addEventListener("keyup", evt => {
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
    });
});
