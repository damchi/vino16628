/**
 * @file Script de l'animation de la page d'inscription et de connection
 * @author Julien Granero
 * @update 2019-03-25
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 */

window.addEventListener("load", function () {
	// Lance l'animation dès le chargement de la page	
	animationLogin();
	// Met automatiquement la hauteur de la première section pour garantir l'animation
	var sectionVisible = document.querySelector(".sectionMobileVisible");
	sectionVisible.style.maxHeight = sectionVisible.scrollHeight + "px"
})

function animationLogin() {
  document.querySelectorAll(".btnToggle").forEach(btnToggle => btnToggle.addEventListener("click", function() {
  	var elementAMontrer = this.nextElementSibling;
  	// L'élément à cacher est différent pour le premier bouton
  	if (this.id == 1) {
  	  var elementACacher = document.querySelector(".sectionMobile");
	} 
	else {
	  var elementACacher = this.previousElementSibling;
	}
	elementAMontrer.style.maxHeight = elementAMontrer.scrollHeight + "px";
	elementACacher.style.maxHeight = 0;
  }
))}