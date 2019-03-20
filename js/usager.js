
    let validationFormulaire = (()=>{
        let obj ={}
        obj.estValide = (unObjet)=>{
            if (unObjet.value ==""){
                unObjet.style.borderColor ="red";
            }
            else{
                unObjet.style.borderColor="transparent";
            }
        };
        obj.estMail = (unMail)=>{
            let regexMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i;
            let outputMail = "";

            if (regexMail.test(unMail.value)){
                unMail.style.borderColor="transparent";
            }
            else{
                unMail.style.borderColor="red";
                outputMail +=" l'email n'est pas valide";
                let errorMail = document.getElementById('errorMail');
                errorMail.innerHTML = outputMail;
                errorMail.style.color ='red';
            }
        };

        obj.estNom = (unNom)=>{
            let regexNom = /^[a-zA-Z]+$/i;
            let outputNom = "";

            if (regexNom.test(unNom.value)){
                unNom.style.borderColor="transparent";
            }
            else{
                unNom.style.borderColor="red";
                outputNom +=" le nom n'est pas valide";
                let errorNom = document.getElementById('errorNom');
                errorNom.innerHTML = outputNom;
                errorNom.style.color ='red';
            }
        };

        obj.estPrenom = (unPrenom)=>{
            let regexPrenom = /^[a-zA-Z]+$/i;
            let outputPrenom = "";

            if (regexPrenom.test(unPrenom.value)){
                unPrenom.style.borderColor="transparent";
            }
            else{
                unPrenom.style.borderColor="red";
                outputPrenom +=" le prénom n'est pas valide";
                let errorPrenom = document.getElementById('errorPrenom');
                errorPrenom.innerHTML = outputPrenom;
                errorPrenom.style.color ='red';
            }
        };

        obj.estPseudo = (unPseudo)=>{
            let regexPseudo = /^\w+$$/i;
            let outputPseudo = "";

            if (regexPseudo.test(unPseudo.value)){
                unPseudo.style.borderColor="transparent";
            }
            else{
                unPseudo.style.borderColor="red";
                outputPseudo +=" le pseudo n'est pas valide";
                let errorPseudo = document.getElementById('errorPseudo');
                errorPseudo.innerHTML = outputPseudo;
                errorPseudo.style.color ='red';
            }
        };


        return obj;
    })();


window.addEventListener('load',()=>{
    let ajouterUsager = document.getElementById('ajouterUsager');
    let emailInscription = document.getElementById('emailInscription');
    let nomInscription = document.getElementById('nomInscription');
    let prenomInscription = document.getElementById('prenomInscription');

    if (ajouterUsager) {
        ajouterUsager.addEventListener('click',()=>{
            validationFormulaire.estValide(emailInscription);
            validationFormulaire.estMail(emailInscription);

            validationFormulaire.estValide(nomInscription);
            validationFormulaire.estNom(nomInscription);

            validationFormulaire.estValide(prenomInscription);
            validationFormulaire.estPrenom(prenomInscription);

            validationFormulaire.estValide(pseudoInscription);
            validationFormulaire.estPseudo(pseudoInscription);
        });

    }

});