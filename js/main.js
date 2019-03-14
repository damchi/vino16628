/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

const BaseURL = document.baseURI;

window.addEventListener('load', function() {
    /*
        Le bouton boire diminue la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnBoire").forEach(function(element){
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            
            let requete = new Request(
                BaseURL+"index.php?requete=boireBouteilleCellier",
                {method: 'POST', body: '{"id": '+id+'}'}
            );
            
            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  return response.json();
                }
                else {
                  throw new Error('Erreur');
                }
            })
            .then(response => {
                location.reload();
                console.debug(response);
            })
            .catch(error => {
                console.error(error);
            });
        })
    });

    /*
        Le bouton ajouter augmente la quantité d'une bouteille dans le cellier.
    */
    
    document.querySelectorAll(".btnAjouter").forEach(function(element){
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            
            let requete = new Request(
                BaseURL+"index.php?requete=ajouterBouteilleCellier",
                {method: 'POST', body: '{"id": '+id+'}'}
            );
            
            fetch(requete).then(response => {
                if (response.status === 200) {
                  return response.json();
                }
                else {
                  throw new Error('Erreur');
                }
            })
            .then(response => {
                location.reload();
                console.debug(response);
            })
            .catch(error => {
                console.error(error);
            });
        })
    });

    /*
        Éléments de la page d'ajout
    */
    
    let inputRecherche = document.querySelector("[name='recherche']");
    let liste = document.querySelector('.listeAutoComplete');

    let formNouvelleBouteille = {
        nom: document.querySelector("[name='nom']"),
        img: document.querySelector("form img"),
        code_saq: document.querySelector("[name='code_saq']"),
        pays: document.querySelector("[name='pays']"),
        prix_saq: document.querySelector("[name='prix_saq']"),
        url_saq: document.querySelector("[name='url_saq']"),
        format: document.querySelector("[name='format']"),
        type: document.querySelector("[name='type']"),
        millesime: document.querySelector("[name='millesime']"),
        quantite: document.querySelector("[name='quantite']"),
        date_achat: document.querySelector("[name='date_achat']"),
        prix: document.querySelector("[name='prix']"),
        garde_jusqua: document.querySelector("[name='garde_jusqua']"),
        notes: document.querySelector("[name='notes']"),
    };

    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");

    /*
        On cache par défaut l'image de la bouteille dans le formulaire parce qu'il n'y en a pas encore et qu'on ne veut pas avoir le petit icône.
    */
    
    formNouvelleBouteille.img.style.display = "none";
    
    /*
        L'input recherche est un autocomplete qui remplit la liste.
    */
    
    inputRecherche.addEventListener("keyup", function(evt){
        console.log(evt);
        let nom = inputRecherche.value;
        liste.innerHTML = "";

        if(nom){
            let requete = new Request(
                BaseURL+"index.php?requete=autocompleteBouteille",
                {method: 'POST', body: '{"nom": "'+nom+'"}'}
            );

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

                response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+ element.id +"'>"+element.nom+"</li>";
                })
            })
            .catch(error => {
                console.error(error);
            });
        }
    });

    /*
        Cliquer sur un élément de la liste ajoute les attributs de la bouteille au formulaire.
    */
    
    liste.addEventListener("click", function(evt){
        console.dir(evt.target);

        if(evt.target.tagName == "LI"){
            let idBouteilleSaq = evt.target.dataset.id;
            
            let requete = new Request(
                BaseURL+"index.php?requete=getBouteilleSaq",
                {method: 'POST', body: '{"id_bouteille_saq": "'+idBouteilleSaq+'"}'}
            );

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
                
                formNouvelleBouteille.nom.value = response.nom;
                formNouvelleBouteille.image.value = response.image;
                formNouvelleBouteille.code_saq.value = response.code_saq;
                formNouvelleBouteille.pays.value = response.pays;
                formNouvelleBouteille.description.value = response.description;
                formNouvelleBouteille.prix_saq.value = response.prix_saq;
                formNouvelleBouteille.url_saq.value = response.url_saq;
                formNouvelleBouteille.url_img.value = response.url_img;
                formNouvelleBouteille.format.value = response.format;
                formNouvelleBouteille.type.value = response.type;                

                formNouvelleBouteille.img.src = response.url_img;
                formNouvelleBouteille.img.style.display = "block";
                
                liste.innerHTML = "";
                inputRecherche.value = "";
            })
            .catch(error => {
                console.error(error);
            });        
        }
    });

    /*
        Le bouton ajouter soumet le formulaire d'ajout de bouteille.
    */
    
    btnAjouter.addEventListener("click", function(evt) {
        var param = {
            "nom": formNouvelleBouteille.nom.value,
            "image": formNouvelleBouteille.image.value,
            "code_saq": formNouvelleBouteille.code_saq.value,
            "pays": formNouvelleBouteille.pays.value,
            "description": formNouvelleBouteille.description.value,
            "prix_saq": formNouvelleBouteille.prix_saq.value,
            "url_saq": formNouvelleBouteille.url_saq.value,
            "url_img": formNouvelleBouteille.url_img.value,
            "format": formNouvelleBouteille.format.value,
            "type": formNouvelleBouteille.type.value,
            "date_achat": formNouvelleBouteille.date_achat.value,
            "garde_jusqua": formNouvelleBouteille.garde_jusqua.value,
            "notes": formNouvelleBouteille.date_achat.value,
            "prix": formNouvelleBouteille.prix.value,
            "quantite": formNouvelleBouteille.quantite.value,
            "millesime": formNouvelleBouteille.millesime.value,
        };

        let requete = new Request(
            BaseURL+"index.php?requete=ajouterNouvelleBouteilleCellier",
            {method: 'POST', body: JSON.stringify(param)}
        );
        
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
        })
        .catch(error => {
            console.error(error);
        });
    });
});

