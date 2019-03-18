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
    
    let btnAffichetCellier = document.querySelector("[name='afficheFormCellier']");
    let formCellier = document.getElementById("formCellier");
    if (formCellier){
        formCellier.style.display='none';
    }
    if (btnAffichetCellier) {
        btnAffichetCellier.addEventListener('click',()=> {
            if (formCellier.style.display == 'none'){
                formCellier.style.display='block';
            }
            else {
                formCellier.style.display='none';
            }

        });
    }
    let btnAjoutCellier = document.querySelector("[name='ajouterCellier']");

        if (btnAjoutCellier){
            btnAjoutCellier.addEventListener('click',()=> {
                var param ={
                    "nomCellier":document.querySelector("[name='nomCellier']").value,
                    "id": document.querySelector("[name='idUsagerCellier']").value,
                };
                let requete = new Request(BaseURL + "index.php?requete=ajoutCellier",{method:'POST', body: JSON.stringify(param)});

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
                    .then(response => {
                        console.log(param.nomCellier);
                        console.log(param.id);
                        console.log(response);

                        let output = "<div> Nom du cellier :";
                        output += "<a href='index.php?requete=listeBouteilleCellier&idCellier="+ response + "'>" + param.nomCellier + "</a>";
                        output += "</div>";

                        let insert = document.getElementById('insertChild');
                        insert.innerHTML= output;
                        formCellier.style.display='none';

                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        }
});