function cambiarTable() {
	var boton = document.getElementById("boton-tamano-tabla");

	if (boton.className == "glyphicon glyphicon-resize-full") {
		var elemento = document.getElementById("contenedor-tabla");
		elemento.className="container-flud";

		boton.className="glyphicon glyphicon-resize-small";
	} else {
		var elemento = document.getElementById("contenedor-tabla");
		elemento.className="container";
		boton.className="glyphicon glyphicon-resize-full";
	}	
}

function disminuirTable() {
	var elemento = document.getElementById("contenedor-tabla");
	elemento.className="container";
}