
    let validationFormulaire = (()=>{
        let obj ={}
        obj.estValide = (unObjet)=>{
            if (unObjet.value ==""){
                unObjet.style.borderColor ="red";
                return false
            }
            else{
                // unObjet.style.borderColor="green";
            }
        };

        obj.estNom = (unNom)=>{
            let regexNom = /^[a-zA-Z]+$/i;
            let outputNom = "";
            let errorNom = document.getElementById('errorNom');


            if (regexNom.test(unNom.value)){
                unNom.style.borderColor="";
                outputNom +="";
                errorNom.innerHTML = outputNom;
            }
           else {
                unNom.style.borderColor="red";
                outputNom +=" le nom n'est pas valide";
                errorNom.innerHTML = outputNom;
                errorNom.style.color ='red';
            }
        };

        obj.estPrenom = (unPrenom)=>{
            let regexPrenom = /^[a-zA-Z]+$/i;
            let outputPrenom = "";
            let errorPrenom = document.getElementById('errorPrenom');

            if (regexPrenom.test(unPrenom.value)){
                unPrenom.style.borderColor="";
                outputPrenom +="";
                errorPrenom.innerHTML = outputPrenom;

            }
            else{
                unPrenom.style.borderColor="red";
                outputPrenom +=" le prénom n'est pas valide";
                errorPrenom.innerHTML = outputPrenom;
                errorPrenom.style.color ='red';
            }
        };

        obj.estMail = (unMail)=>{
            let regexMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i;
            let outputMail = "";
            let errorMail = document.getElementById('errorMail');

            if (regexMail.test(unMail.value)){
                outputMail +="";
                errorMail.innerHTML = outputMail;
                unMail.style.borderColor="";
            }
            if (!regexMail.test(unMail.value)){
                unMail.style.borderColor="red";
                outputMail +=" l'email n'est pas valide";
                errorMail.innerHTML = outputMail;
                errorMail.style.color ='red';
            }

        };

        obj.estPseudo = (unPseudo)=>{
            let regexPseudo = /^\w+$$/i;
            let outputPseudo = "";
            let errorPseudo = document.getElementById('errorPseudo');


            if (regexPseudo.test(unPseudo.value)){
                unPseudo.style.borderColor="";
                outputPseudo +="";
                errorPseudo.innerHTML = outputPseudo;
            }
            else{
                unPseudo.style.borderColor="red";
                outputPseudo +=" le pseudo n'est pas valide";
                errorPseudo.innerHTML = outputPseudo;
                errorPseudo.style.color ='red';
            }
        };

        obj.estPass = (unPass)=>{
            let outputPass= "";
            console.log(unPass.value);

            if (unPass.value ==""){
                unPass.style.borderColor="red";
                outputPass +=" le mot de pass n'est pas valide";
                let errorPass = document.getElementById('errorPass');
                if (errorPass){
                    errorPass.innerHTML = outputPass;
                    errorPass.style.color ='red';
                }
            }
        };

        // console.log(obj);
        return obj;
    })();


window.addEventListener('load',()=>{
    let ajouterUsager = document.getElementById('ajouterUsager');
    let emailInscription = document.getElementById('emailInscription');
    let nomInscription = document.getElementById('nomInscription');
    let prenomInscription = document.getElementById('prenomInscription');
    let passInscription = document.getElementById('passInscription');

    let btnLogin = document.getElementById('btnLogin');
    let idLogin = document.getElementById('identifiantLogin');
    let passwordLogin = document.getElementById('passwordLogin');



    if (ajouterUsager) {
        ajouterUsager.addEventListener('click',(event)=>{
            if (validationFormulaire.estValide(emailInscription) == false ||
                validationFormulaire.estValide(nomInscription) == false ||
                validationFormulaire.estValide(prenomInscription) == false ||
                validationFormulaire.estValide(pseudoInscription) == false ||
                validationFormulaire.estPass(passInscription) == false ){
                event.preventDefault();
            }
            // validationFormulaire.estValide(emailInscription);
            validationFormulaire.estMail(emailInscription);

            // validationFormulaire.estValide(nomInscription);
            validationFormulaire.estNom(nomInscription);

            // validationFormulaire.estValide(prenomInscription);
            validationFormulaire.estPrenom(prenomInscription);

            // validationFormulaire.estValide(pseudoInscription);
            validationFormulaire.estPseudo(pseudoInscription);
            validationFormulaire.estPass(passInscription);
        });
    }

    if (btnLogin){
        btnLogin.addEventListener('click',()=>{

            if (validationFormulaire.estValide(idLogin) == false||validationFormulaire.estValide(passwordLogin)== false ){
                event.preventDefault();
            }
            validationFormulaire.estPass(passwordLogin);
            console.log(document.getElementById('message').value);

        });

    }
    let errorLogin =document.getElementById('message');
    if (errorLogin) {
        errorLogin.style.color= "red";
    }

});