/**
 * @file Script contenant les fonctions de la page de gestion des bouteilles SAQ
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
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
    
    /*
        Event listener pour le bouton supprimer de chaque div bouteilleSaq. Demande une confirmation à l'administrateur avant de faire la suppression.
    */
    
    document.querySelectorAll('.bouteilleSaq').forEach(divBouteilleSaq => {
        let idBouteilleSaq = divBouteilleSaq.dataset.id;
        
        divBouteilleSaq.querySelector(".btnSupprimer").addEventListener('click', evt => {
            let nomBouteille = divBouteilleSaq.querySelector(".nom").innerHTML;
            let codeSaq = divBouteilleSaq.querySelector(".codeSaq").innerHTML;

            let texteConfirm = (
                "Suppression de la bouteille \"" + nomBouteille + "\" " + 
                "(code SAQ " + codeSaq + ")"
            );

            if (confirm(texteConfirm)) {
                supprimerBouteilleSaq(idBouteilleSaq);
            }
        });
    });
});
