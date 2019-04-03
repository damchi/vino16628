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
console.log(BaseURL);

/* --- Gestion du navbar pour le mobile --- */
window.addEventListener('load', () => {
    let burger = document.querySelector('.burger');
    var x = document.getElementById("topnav");
    burger.addEventListener('click', () => {
        console.log('e');
        console.log(x)
        console.log(x.className);
          if (x.className == "topnav colNav") {
            x.classList.remove('colNav');
            x.classList.add("responsive");
          } else {
            console.log('eeeeee');
               x.classList.add('colNav');
               x.classList.remove('responsive');
          }
    });    
});
