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

    // let btnModifierCellier = document.querySelector("[name='modifierCellier']");
    //     if (btnModifierCellier) {
    //     }

    document.querySelectorAll(".supprimerCellier").forEach(element => {
            element.addEventListener('click',(evt)=>{
                let idCellier = evt.target.closest('.cellierId').dataset.id;
                // console.log(idCellier);

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
                            console.log('rrrr');
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