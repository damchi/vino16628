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
    // let requete = new Request( "index.php?requete=verifierBouteille",{method:'POST', body: JSON.stringify(param)});
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
            console.log(response);
            // console.log(response.nbBouteille);
            if (response.succes == true ){

                let result = confirm('Le cellier contient '+ response.nbBouteille +' bouteille voulez vous le supprimer ?');
                if (result == true){
                    console.log('aaaaa');
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
    * Toggle pour afficher les champs d'ajout celliers
    * */
    let btnAffichetCellier = document.querySelector("[name='afficheFormCellier']");
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

                            /** Créeation du nouveau Cellier sur la mem page*/

                            let output = "";
                            output += "<div class='divImgCellier'>"
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
                                output += "<div class='supprimerCellier btnCellier'><i class='fas fa-trash-alt fa-2x'></i></div>";
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


    document.querySelectorAll(".supprimerCellier").forEach(element => {

            element.addEventListener('click',(evt)=>{
                let idCellier = evt.target.closest('.cellierId').dataset.id;
                console.log(idCellier);
                supprimeCellier(idCellier)

            });
        });

    // document.querySelectorAll(".modifierCellier").forEach(element => {
    //
    //     element.addEventListener('click',(evt)=>{
    //
    //         let idCellier = evt.target.closest('.cellierId').dataset.id;
    //         let fromModifier = document.getElementById('modifier'+idCellier)
    //         let styleForm = window.getComputedStyle(fromModifier);
    //
    //         console.log(styleForm.display);
    //         if (styleForm.display === 'none'){
    //             fromModifier.style.display='block';
    //         }
    //         else {
    //             fromModifier.style.display='none';
    //
    //         }
    //
    //     });
    // });
    //
    //
    // document.querySelectorAll(".inputModifierCellier").forEach(element => {
    //
    //         element.addEventListener('click',(evt)=>{
    //             // console.log('ee');
    //             // console.log(evt)
    //             let idCellier = evt.target.closest('.formModifCellier').dataset.id;
    //             console.log(idCellier);
    //
    //             modiferCellier(idCellier,evt)
    //
    //         });
    //
    // });



});


// function modiferCellier(idCellier,evt){
//     // let btnModifCellier = document.querySelector("[name='inputModifierCellier']");
//
//     // if (btnModifCellier){
//     //     btnAjoutCellier.addEventListener('click',(evt)=> {
//
//     // if (document.querySelector("[name='nomCellierModif']").value == ""){
//     //     console.log(document.querySelector("[name='nomCellierModif']").value)
//     //     document.querySelector("[name='nomCellierModif']").style.borderColor='red';
//     //     document.getElementById("errorCellierModif").style.color='red';
//     //     document.getElementById("errorCellierModif").innerHTML='Le champs ne peut pas être vide';
//     //     evt.preventDefault()
//     // }
//     // else {
//     //
//     //     let imageModif = document.querySelector('#imageCellierModifier').files[0];
//     //     let nomCellierModif = document.querySelector("[name='nomCellierModif']").value;
//     //     // let idUserModif = document.querySelector("[name='idUsagerCellierModifier']").value;
//     //     let idCellierModif = idCellier
//     //
//     //     let param = new FormData();
//     //     param.append('image',imageModif);
//     //     param.append('nomCellierMofif',nomCellierModif );
//     //     // param.append('idUserModif', idUserModif);
//     //     param.append('idCellierModif', idCellierModif);
//     //
//     //     let requete = new Request(BaseURL + "index.php?requete=modifierCellier",{method:'POST', body: param});
//     //
//     //     fetch(requete)
//     //         .then(response => {
//     //             console.log('ee');
//     //             if (response.status === 200) {
//     //                 // console.log(response.json());
//     //                 return response.json();
//     //             }
//     //             else {
//     //                 throw new Error('Erreur');
//     //             }
//     //         })
//     //         .then(response => {
//     //             console.log(response)
//     //         })
//     //         .catch(error => {
//     //             console.error(error);
//     //         });
//     // }
//
//     // });
//
//     // }
//
// }
