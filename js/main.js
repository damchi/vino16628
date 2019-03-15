/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

const BaseURL = document.baseURI;

window.addEventListener('load', function() {
    /*
        Le bouton boire diminue la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnBoire").forEach(function(element){
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            
            let requete = new Request(
                BaseURL+"index.php?requete=boireBouteilleCellier",
                {method: 'POST', body: '{"id": '+id+'}'}
            );
            
            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  return response.json();
                }
                else {
                  throw new Error('Erreur');
                }
            })
            .then(response => {
                location.reload();
                console.debug(response);
            })
            .catch(error => {
                console.error(error);
            });
        })
    });

    /*
        Le bouton ajouter augmente la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnAjouter").forEach(function(element){
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            
            let requete = new Request(
                BaseURL+"index.php?requete=ajouterBouteilleCellier",
                {method: 'POST', body: '{"id": '+id+'}'}
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
                location.reload();
                console.debug(response);
            })
            .catch(error => {
                console.error(error);
            });
        })
    });
});

