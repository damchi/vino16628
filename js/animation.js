window.addEventListener("load", function () {
		animationLogin();
})

function animationLogin() {
  document.querySelectorAll(".mouvante").forEach(mouvante => mouvante.addEventListener("click", function() {

  	var elementAMontrer = this.nextElementSibling;
  	console.log(elementAMontrer);
  	if (this.id == 1) {
  	  var elementACacher = this.parentNode.childNodes[9];
  	  console.log(elementACacher);
	} 
	else {
	  var elementACacher = this.previousElementSibling;
	  console.log(elementACacher);
	}
	elementAMontrer.style.maxHeight = elementAMontrer.scrollHeight + "px";
	elementACacher.style.maxHeight = 0;
  }
))}