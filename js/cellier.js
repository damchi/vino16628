/**
 * @file Script contenant les fonctions de gestion du cellier
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Le bouton boire diminue la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".bouteille .btnBoire").forEach(element => {
        element.addEventListener("click", function(evt) {
            console.log(evt);
            console.log(evt.target.parentElement.parentElement.parentElement);
            let id = evt.target.parentElement.parentElement.parentElement.dataset.id;
            requeteModifierQuantite('boireBouteilleCellier', id);
        });
    });

    /*
        Le bouton ajouter augmente la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".bouteille .btnAjouter").forEach(element => {
        element.addEventListener("click", function(evt) {
            console.log(evt);            
            let id = evt.target.parentElement.parentElement.parentElement.dataset.id;
            requeteModifierQuantite('ajouterBouteilleCellier', id);
        });
    });

    /*
        Fait la requête Ajax pour modifier la quantite d'une bouteille donnée.
    */
        
    function requeteModifierQuantite(nomRequete, idBouteille) {
        let spanQuantite = document.querySelector(
            ".bouteille[data-id='" + idBouteille + "'] .quantite"
        );
        
        console.log(spanQuantite);
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
            spanQuantite.innerHTML = response.quantite;
        })
        .catch(error => {
            console.error(error);
        });
    }

    // document.querySelectorAll(".entrerCellier").forEach(function(element){
    //     element.addEventListener("click", function(evt){
    //         let id = evt.target.dataset.id;
    //         // console.log(id);
    //
    //         let requete = new Request(
    //             BaseURL+"index.php?requete=listeBouteilleCellier",
    //             {method: 'POST', body: '{"id": '+id+'}'}
    //         );
    //
    //         fetch(requete)
    //             .then(response => {
    //                 if (response.status === 200) {
    //                     return response.json();
    //                 }
    //                 else {
    //                     throw new Error('Erreur');
    //                 }
    //             })
    //             .then(response => {
    //
    //             })
    //             .catch(error => {
    //                 console.error(error);
    //             });
    //     })
    // });
});