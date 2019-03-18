window.addEventListener('load',()=> {

    let btnAffichetCellier = document.querySelector("[name='afficheFormCellier']");
    let formCellier = document.getElementById("formCellier");
        formCellier.style.display='none';
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