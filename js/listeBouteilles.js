/**
 * @file Code spécifique à la page de liste des bouteilles d'un cellier (vue listeBouteilles.php)
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Le bouton boire diminue la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnBoire").forEach(element => {
        element.addEventListener("click", function(evt) {
            console.log(evt);
            let idBouteille = evt.target.closest('.bouteille').dataset.id;
            modifierQuantite('boireBouteilleCellier', idBouteille);
        });
    });

    /*
        Le bouton ajouter augmente la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnAjouter").forEach(element => {
        element.addEventListener("click", function(evt) {
            console.log(evt);            
            let idBouteille = evt.target.closest('.bouteille').dataset.id;
            modifierQuantite('ajouterBouteilleCellier', idBouteille);
        });
    });

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
            
            let spanQuantite = document.querySelector(
                ".bouteille[data-id='" + idBouteille + "'] .quantite"
            );

            spanQuantite.innerHTML = response.quantite;
        })
        .catch(error => {
            console.error(error);
        });
    }
});