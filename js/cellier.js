/**
 * @file Script contenant les fonctions de gestion des celliers
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener('load', () => {
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
            btnAjoutCellier.addEventListener('click',(evt)=> {
                if (document.querySelector("[name='nomCellier']").value == ""){
                    document.querySelector("[name='nomCellier']").style.borderColor='red';
                    document.getElementById("errorCellier").style.color='red';
                    document.getElementById("errorCellier").innerHTML='Le champs ne peut pas être vide';
                    evt.preventDefault()
                }
                else{
                    var param = new FormData();
                    var image = document.querySelector('#imageCellier').files[0]
                    var nomCellier = document.querySelector("[name='nomCellier']").value;
                    var id = document.querySelector("[name='idUsagerCellier']").value;


                    param.append('image',image)
                    param.append('nomCellier','test' )
                    param.append('id', id)


                    console.log(image);
                    console.log(nomCellier);
                    console.log(id);
                    console.log(param);

                    // var image = document.getElementById("imageCellier");
                    // var file = image.files[0];
                    // console.log(file);
                    // var param ={
                    //     "nomCellier":document.querySelector("[name='nomCellier']").value,
                    //     "image":file,
                    //     "id": document.querySelector("[name='idUsagerCellier']").value
                    // };

                    let requete = new Request(BaseURL + "index.php?requete=ajoutCellier",{method:'POST', body: JSON.stringify(param)});
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
                            console.log(param.nomCellier);
                            console.log(param.id);
                            console.log(response);

                            let output = "";

                            output += "<a href='index.php?requete=listeBouteilleCellier&idCellier="+ response + "'>" + param.nomCellier + "</a>";
                            // output += "<button class='modifierCellier'>  Modifier </button>\n"
                            // output += "<button class='supprimerCellier'>  Supprimer</button>";
                            let insert = document.getElementById('insertChild');
                            insert.setAttribute('data-id',response);
                            insert.innerHTML= output;
                            console.log(output);
                            formCellier.style.display='none';

                        })
                        .catch(error => {
                            console.error(error);
                        });
                }

            });
        }

    // let btnModifierCellier = document.querySelector("[name='modifierCellier']");
    //     if (btnModifierCellier) {
    //     }

    document.querySelectorAll(".supprimerCellier").forEach(element => {
            element.addEventListener('click',(evt)=>{
                let idCellier = evt.target.closest('.cellierId').dataset.id;
                console.log(idCellier);

                var param ={
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
            });
        });


    // });
});