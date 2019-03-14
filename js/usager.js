window.addEventListener('load',()=>{
    let btnAjouterUsager = document.querySelector("[name='ajouterUsager']");
    console.log(btnAjouterUsager);
    if (btnAjouterUsager){
        btnAjouterUsager.addEventListener('click',()=>{
            var param ={
                "nom":document.querySelector("[name='nom']").value,
                "prenom": document.querySelector("[name='prenom']").value,
                "mail":document.querySelector("[name='mail']").value,
                "mdp":document.querySelector("[name='mdp']").value,
                "pseudo":document.querySelector("[name='pseudo']").value
            };
            // console.log(JSON.stringify(param));
            let requete = new Request(BaseURL + "index.php?requete=ajoutUsager",{method:'POST', body: JSON.stringify(param)});
            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                        // console.log(response.json());
                        return response.json();
                    } else {
                        throw new Error('Erreur');
                    }
                });


        });

    }


});