function cambiarTableHorizontal() {
	var boton = document.getElementById("boton-tamano-tabla-horizontal");

	if (boton.className == "glyphicon glyphicon-resize-full") {
		var elemento = document.getElementById("contenedor-tabla");
		elemento.className="container contenedor-tabla-fluid";

		boton.className="glyphicon glyphicon-resize-small";
	} else {
		var elemento = document.getElementById("contenedor-tabla");
		elemento.className="container";
		boton.className="glyphicon glyphicon-resize-full";
	}
}

function cambiarTableVertical() {
	var boton = document.getElementById("boton-tamano-tabla-vertical");

	if (boton.className == "glyphicon glyphicon-menu-up") {
		var elemento = document.getElementById("tabla-planillas");
		elemento.className="tabla table-responsive contenedor-tabla-0";

		boton.className="glyphicon glyphicon-menu-down";
	} else {
		var elemento = document.getElementById("tabla-planillas");
		elemento.className="tabla table-responsive contenedor-tabla-1";
		boton.className="glyphicon glyphicon-menu-up";
	}
}

function desabilitar_habiltarOpciones(){
	var li_nav= document.getElementById("li_nav");
	var a_nav= document.getElementById("a_nav");
	var li_nav2= document.getElementById("li_nav2");
	var a_nav2= document.getElementById("a_nav2");
	var li_nav3= document.getElementById("li_nav3");
	var a_nav3= document.getElementById("a_nav3");
	var li_nav4= document.getElementById("li_nav4");
	var a_nav4= document.getElementById("a_nav4");
	var li_nav5= document.getElementById("li_nav5");
	var a_nav5= document.getElementById("a_nav5");
	var habilita= document.getElementById("spam_h");

	if(li_nav.className == "dropdown" && a_nav.className == "dropdown-toggle"){
		li_nav.className="desabilitado_li disabled";
		a_nav.className="desabilitado_a disabled";
		li_nav2.className="desabilitado_li disabled";
		a_nav2.className="desabilitado_a disabled";
		li_nav3.className="desabilitado_li disabled";
		a_nav3.className="desabilitado_a disabled";
		li_nav4.className="desabilitado_li disabled";
		a_nav4.className="desabilitado_a disabled";
		li_nav5.className="desabilitado_li disabled";
		a_nav5.className="desabilitado_a disabled";
		habilita.className= "glyphicon glyphicon-ok-circle  hab_opcion";
	}else{
		li_nav.className="dropdown";
		a_nav.className="dropdown-toggle";
		li_nav2.className="dropdown";
		a_nav2.className="dropdown-toggle";
		li_nav3.className="dropdown";
		a_nav3.className="dropdown-toggle";
		li_nav4.className="dropdown";
		a_nav4.className="dropdown-toggle";
		li_nav5.className="dropdown";
		a_nav5.className="dropdown-toggle";
		habilita.className= "glyphicon glyphicon-ban-circle";
	}
}

function ocultar_mostrarBotonesModal(oculta) {
	var btnModificar= document.getElementById("btn_Modificar");
	var btnEliminar= document.getElementById("btn_Eliminar");
	var btnAgregar= document.getElementById("btn_Agregar");

	switch (oculta) {
		case 0:
			btnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
			btnEliminar.className="ocultar_botones";
			btnAgregar.className="ocultar_botones";

			break;
		case 1:
			btnModificar.className="ocultar_botones";
			btnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
			btnAgregar.className="ocultar_botones";

			break;
		case 2:
			btnModificar.className="ocultar_botones";
			btnEliminar.className="ocultar_botones";
			btnAgregar.className="btn btn-primary btn-block";

			break;
	}
}
