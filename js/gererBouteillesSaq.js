/**
 * @file Script contenant les fonctions de la page de gestion des bouteilles SAQ
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
    /*
        Retourne la div correspondant à une bouteille SAQ spécifiée par son id.
    */
    
    function divBouteilleSaq(idBouteilleSaq) {
        return document.querySelector(
            ".bouteilleSaq[data-id='" + idBouteilleSaq + "']"
        );
    }
    
    /*
        Fait la requête Ajax pour supprimer une bouteille SAQ donnée et l'enlève du DOM.
    */
        
    function supprimerBouteilleSaq(idBouteilleSaq) {
        /*
            On demande à l'administrateur de confirmer la suppression.
        */

        let div = divBouteilleSaq(idBouteilleSaq);
        let nomBouteille = div.querySelector(".nom").innerHTML;
        let codeSaq = div.querySelector(".codeSaq").innerHTML;
        
        let texteConfirm = (
            "Suppression de la bouteille \"" + nomBouteille + "\" " + 
            "(code SAQ " + codeSaq + ")"
        );
        
        if (confirm(texteConfirm)) {
            /* Requête Ajax supprimerBouteilleSaq avec id comme seul paramètre */
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
                /* Suppression de la div de la bouteille dans le DOM */
                console.log(response);
                divBouteilleSaq(idBouteilleSaq).remove();
            })
            .catch(error => {
                console.error(error);
            });            
        }
    }
    
    /*
        Pour chaque div bouteilleSaq, le bouton supprimer supprime la bouteille.
    */
            
    document.querySelectorAll('.bouteilleSaq').forEach(divBouteilleSaq => {
        let idBouteilleSaq = divBouteilleSaq.dataset.id;
        
        divBouteilleSaq.querySelector(".btnSupprimer").addEventListener('click', evt => {
            supprimerBouteilleSaq(idBouteilleSaq);
        });
    });
});
