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

    var param ={
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

                    var image = document.querySelector('#imageCellier').files[0];
                    var nomCellier = document.querySelector("[name='nomCellier']").value;
                    var id = document.querySelector("[name='idUsagerCellier']").value;

                    var param = new FormData()
                    param.append('image',image)
                    param.append('nomCellier',nomCellier )
                    param.append('id', id)

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

                            if (response.image == null){
                                output += "<img class='imgCellier' src=./images/cellier.png>";
                            }
                            else{
                                output += "<img class='imgCellier' src=./images/"+response.image +">";
                            }
                            var node = document.createElement("DIV");
                            output += "<a class='nomCellier' href='index.php?requete=listeBouteilleCellier&idCellier="+ response.id_cellier + "'>" + response.nom + "</a>";
                            // output += "<button class='modifierCellier'>  Modifier </button>\n"
                            output += "<div class='supprimerCellier btnCellier'><i class='fas fa-trash-alt'></i></div>";
                            // let insert = document.getElementById('insertChild');
                            // var textnode = document.createTextNode(out);
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


    // });
});