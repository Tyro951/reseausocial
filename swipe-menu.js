var Menu = document.querySelector("#menu");
var barMenu = document.querySelector("#menuburger");
console.log(barMenu);
console.log(Menu);


// regarde bien si touchstart existe et si il est le premier déclenché
var clickedEvent = "click"; // Au clic si "touchstart" n'est pas détecté
window.addEventListener('touchstart', function detectTouch() {
	clickedEvent = "touchstart"; // Transforme l'événement en "touchstart"
	window.removeEventListener('touchstart', detectTouch, false);
}, false);

// Créé un "toggle class" en Javascrit natif 
barMenu.addEventListener(clickedEvent, function(evt) {
	console.log(clickedEvent);
	// Modification du menu burger
	if(!this.getAttribute("class")) {
		this.setAttribute("class", "clicked");
	} else {
		this.removeAttribute("class");
	}

	// Créé l'effet pour le menu slide compatible partout
	if(Menu.getAttribute("class") != "visible") {
		Menu.setAttribute("class", "visible");
	} else {
		Menu.setAttribute("class", "invisible");
	}
}, false);



if(screen.width <= 1024) {
	var startX = 0; // point de départ
	var distance = 100; // distance nécessaire de swipe pour afficher le menu

	// Au premier point de contact
	window.addEventListener("touchstart", function(evt) {
		// Récupère les "touches" effectuées
		var touches = evt.changedTouches[0]; // le point de touche devient active
		startX = touches.pageX; //pageX = retourne les coordoonés horizontale au moment ou l'écran a été touché .
		between = 0;
	}, false);

	// Quand les points de contacts sont en mouvement
	window.addEventListener("touchmove", { passive: false }, function(evt) { //sert à éviter les effets de bord avec le tactile
		evt.preventDefault();
		evt.stopPropagation();
	}, false);

	// Quand le contact s'arrête
	window.addEventListener("touchend", function(evt) {
		var touches = evt.changedTouches[0]; //le point de touche se désactive
		var between = touches.pageX - startX; //coordoonés de fin de touche - coordoonés de début de touche

		// Détection de la direction
		if(between > 0) {
			var orientation = "gad";
		} else {
			var orientation = "dag";
		}

		// Modification du menu burger
		if(Math.abs(between) >= distance && orientation == "gad" && Menu.getAttribute("class") != "visible") {
				barMenu.setAttribute("class", "clicked");
		}
		if(Math.abs(between) >= distance && orientation == "dag" && Menu.getAttribute("class") != "invisible") {
				barMenu.removeAttribute("class");
		}

		// Créé l'effet pour le menu slide (compatible partout)
		if(Math.abs(between) >= distance && orientation == "gad" && Menu.getAttribute("class") != "visible") {
			Menu.setAttribute("class", "visible");
		}
		if(Math.abs(between) >= distance && orientation == "dag" && Menu.getAttribute("class") != "invisible") {
			Menu.setAttribute("class", "invisible");
		}
	}, false);
}