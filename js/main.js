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

window.addEventListener('load', () => {
    let burger = document.querySelector('.burger');

    burger.addEventListener('click', () => {
          var x = document.getElementById("topnav");

          if (x.className === "topnav") {
              x.className += " responsive";
          } else {
                x.className = "topnav";
          }
    });    
});
