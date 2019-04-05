/**
 * @file Script contenant les fonctions de gestion des celliers
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

/**
 * supprime cellier
 * @param idCellier
 */
function supprimeCellier(idCellier){

    let param ={
        "idCellier": idCellier,
    };
    let requete = new Request(BaseURL + "index.php?requete=verifierBouteille",{method:'POST', body: JSON.stringify(param)});
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
        .then(response =>{
            // console.log(response);
            if (response.succes == true ){
                // alert pour confirmer la suppression
                let result = confirm('Le cellier contient '+ response.nbBouteille +' bouteille voulez vous le supprimer ?');
                // si ok sur alert alors supression
                if (result == true){
                    // console.log('aaaaa');
                    let requeteDelete = new Request(BaseURL + "index.php?requete=supprimerCellier",{method:'POST', body: JSON.stringify(param)});
                    fetch(requeteDelete)
                    .then(response => {
                        console.log(response);
                        if (response.status === 200) {
                            // console.log(response.json());
                            return response.json();
                        }
                        else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response=>{
                        location.reload();
                    })
                }
            }
            else {
                let requeteDelete = new Request(BaseURL + "index.php?requete=supprimerCellier",{method:'POST', body: JSON.stringify(param)});
                fetch(requeteDelete)
                    .then(response => {
                        console.log(response);
                        if (response.status === 200) {
                            // console.log(response.json());
                            return response.json();
                        }
                        else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response=>{
                        location.reload();
                    })
            }
        })
}


window.addEventListener('load', () => {
    /*
    * Toggle pour afficher les champs d'ajout celliers en mobile
    * */
        let btnAffichetCellier = document.querySelector("[name='afficheFormCellier']");
        /**
         *
         * @element formCellier div form ajout cellier
         */
        let formCellier = document.getElementById("formCellier");
        if (btnAffichetCellier) {
            btnAffichetCellier.addEventListener('click',()=> {
                if (formCellier.style.display == 'block'){
                    formCellier.style.display='none';
                }
                else {
                    formCellier.style.display='block';
                }

            });
        }

    /* Bouton ajout de cellier*/
    let btnAjoutCellier = document.querySelector("[name='ajouterCellier']");

        if (btnAjoutCellier){
            btnAjoutCellier.addEventListener('click',(evt)=> {
                /*Verification des champs obligatoire pour l'ajout de celliers */
                if (document.querySelector("[name='nomCellier']").value == ""){
                    document.querySelector("[name='nomCellier']").style.borderColor='red';
                    document.getElementById("errorCellier").style.color='red';
                    document.getElementById("errorCellier").innerHTML='Le champs ne peut pas être vide';
                    evt.preventDefault()
                }
                else{
                    /* Traitement des données de nouveaux formulaire*/

                    let image = document.querySelector('#imageCellier').files[0];
                    let nomCellier = document.querySelector("[name='nomCellier']").value;
                    let id = document.querySelector("[name='idUsagerCellier']").value;

                    /**
                     *
                     * @type {FormData} objet form data avec les parametres cellier à ajouter
                     */
                    let param = new FormData();
                    param.append('image',image);
                    param.append('nomCellier',nomCellier );
                    param.append('id', id);

                    /* Requete pour ajouter le cellier */
                    let requete = new Request(BaseURL + "index.php?requete=ajoutCellier",{method:'POST', body: param});
                    // let requete = new Request( "index.php?requete=ajoutCellier",{method:'POST', body: param});
                    console.log(requete);
                    fetch(requete)
                        .then(response => {
                            console.log('ee');
                            if (response.status === 200) {
                                // console.log(response.json());
                                return response.json();
                            }
                            else {
                                throw new Error('Erreur');
                            }
                        })
                        .then(response => {

                            /** Créeation du nouveau Cellier sur la meme page*/

                            let output = "";
                            output += "<div class='divImgCellier'>";
                            output += '<a class="nomCellier" href="index.php?requete=listeBouteilleCellier&idCellier='+ response.id_cellier +'">';

                            if (response.image == null){
                                output += "<img class='imgCellier' src=./images/cellier.png>";
                            }
                            else{
                                output += "<img class='imgCellier' src=./images/"+response.image +">";
                            }
                            output += "</a>";
                            output += "</div>";

                            output += "<div class='divTexteCellier'>";
                                output += "<h2><a class='nomCellier' href='index.php?requete=listeBouteilleCellier&idCellier="+ response.id_cellier + "'>" + response.nom + "</a></h2>";
                                output += "<div class='mc'>";
                                    output += "<p>Nombre de bouteilles : 0 </p>";
                                    output += "<p>Nombre de bouteilles Rouge : 0 </p>";
                                    output += "<p>Nombre de bouteilles Blanc : 0 </p>";
                                    output += "<p>Nombre de bouteilles Rosé : 0 </p>";
                                output += "</div>";
                            output += "</div>";
                            output += "<div class='divBtnCellier'>";
                                output += "<div class='supprimerCellier btnCellier'><i class='fas fa-trash-alt'></i></div>";
                            output += "</div>";

                            let node = document.createElement("DIV");
                            node.setAttribute('data-id',response.id_cellier);
                            node.classList.add('listeCellier');
                            node.classList.add('cellierId');
                            node.innerHTML =output;
                            document.getElementById("insertChild").appendChild(node);

                            document.querySelectorAll(".supprimerCellier").forEach(element => {

                                element.addEventListener('click',(evt)=>{
                                    let idCellier = evt.target.closest('.cellierId').dataset.id;
                                    console.log(idCellier);
                                    supprimeCellier(idCellier)

                                });
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        }
    /**
     * recuperation des boutons supprimer
     *
     */
    document.querySelectorAll(".supprimerCellier").forEach(element => {

            element.addEventListener('click',(evt)=>{
                /**
                 *
                 * idCellier id du cellier a supprimer
                 */
                let idCellier = evt.target.closest('.cellierId').dataset.id;
                console.log(idCellier);
                supprimeCellier(idCellier)
            });
        });
});


