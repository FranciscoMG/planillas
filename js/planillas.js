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

////////////////////////////////////////////////////////
function activarAgregarCursos() {
	var cursosEliminarModificar = document.getElementById('cursosEliminarModificar');
	var cursosAgregar = document.getElementById('cursosAgregar');
	var seccionCursosEliminar = document.getElementById('seccionCursosEliminar');

	var cursosBtnModificar = document.getElementById('cursosBtnModificar');
	var cursosBtnEliminar = document.getElementById('cursosBtnEliminar');
	var cursosBtnAgregar = document.getElementById('cursosBtnAgregar');

	cursosEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	cursosAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	cursosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	cursosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	cursosBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	seccionCursosEliminar.className="";
}

function activarModificarCursos() {
	var cursosEliminarModificar = document.getElementById('cursosEliminarModificar');
	var cursosAgregar = document.getElementById('cursosAgregar');
	var seccionCursosEliminar = document.getElementById('seccionCursosEliminar');

	var cursosBtnModificar = document.getElementById('cursosBtnModificar');
	var cursosBtnEliminar = document.getElementById('cursosBtnEliminar');
	var cursosBtnAgregar = document.getElementById('cursosBtnAgregar');

	cursosEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	cursosAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	cursosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
	cursosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	cursosBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionCursosEliminar.className="";
}

function activarEliminarCursos() {
	var cursosEliminarModificar = document.getElementById('cursosEliminarModificar');
	var cursosAgregar = document.getElementById('cursosAgregar');
	var seccionCursosEliminar = document.getElementById('seccionCursosEliminar');
	var selectCursos = document.getElementById('selectCursos');

	var cursosBtnModificar = document.getElementById('cursosBtnModificar');
	var cursosBtnEliminar = document.getElementById('cursosBtnEliminar');
	var cursosBtnAgregar = document.getElementById('cursosBtnAgregar');

	cursosEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	cursosAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	cursosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	cursosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 ";
	cursosBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionCursosEliminar.className="hide";
	selectCursos.onchange="";
}

function cargarDatosCursos(obj) {
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/cursos/manejadorCursos.php?id="+valorSeleccionado;
}

/////////////////////////////////////////////////////////

function activarAgregarProyecto() {
	var proyectoEliminarModificar = document.getElementById('proyectoEliminarModificar');
	var proyectoAgregar = document.getElementById('proyectoAgregar');
	var seccionEliminarProyecto = document.getElementById('seccionEliminarProyecto');

	var proyectoBtnModificar = document.getElementById('proyectosBtnModificar');
	var proyectoBtnEliminar = document.getElementById('proyectosBtnEliminar');
	var proyectoBtnAgregar = document.getElementById('proyectosBtnAgregar');

	proyectoEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	proyectoAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	proyectoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	proyectoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	proyectoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	seccionEliminarProyecto.className="";
}

function activarModificarProyecto(){
	var proyectoBtnModificar = document.getElementById('proyectosBtnModificar');
	var proyectoBtnEliminar = document.getElementById('proyectosBtnEliminar');
	var proyectoBtnAgregar = document.getElementById('proyectosBtnAgregar');
	var proyectoEliminarModificar = document.getElementById('proyectoEliminarModificar');
	var proyectoAgregar = document.getElementById('proyectoAgregar');
	var seccionEliminarProyecto = document.getElementById('seccionEliminarProyecto');

	proyectoEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 ";
	proyectoAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	proyectoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
	proyectoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	proyectoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionEliminarProyecto.className="";
}

function activarEliminarProyecto() {
	var proyectosEliminarModificar = document.getElementById('proyectoEliminarModificar');
	var proyectosAgregar = document.getElementById('proyectoAgregar');
	var seccionEliminarProyecto = document.getElementById('seccionEliminarProyecto');

	var proyectosBtnModificar = document.getElementById('proyectosBtnModificar');
	var proyectosBtnEliminar = document.getElementById('proyectosBtnEliminar');
	var proyectosBtnAgregar = document.getElementById('proyectosBtnAgregar');
	var selectEliminarProyecto = document.getElementById('selectEliminarProyecto');

	proyectosEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	proyectosAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	proyectosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	proyectosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 ";
	proyectosBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionEliminarProyecto.className="hide";
	selectEliminarProyecto.onchange="";
}

function cargarDatosProyecto(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/proyectos/gestorProyectos.php?id="+valorSeleccionado;
}

/////////////////////////////////////////////////////////
function activarAgregarDocente() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar');
	var docenteAgregar = document.getElementById('docenteAgregar');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	seccionEliminarDocente.className="";
}

function activarModificarDocente(){
	var docenteBtnModificar = document.getElementById('docentesBtnModificar');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar');
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar');
	var docenteAgregar = document.getElementById('docenteAgregar');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 ";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionEliminarDocente.className="";
}

function activarEliminarDocente() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar');
	var docenteAgregar = document.getElementById('docenteAgregar');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar');
	var selectEliminarDocente = document.getElementById('selectEliminarDocente');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docentesAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docentesBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	docentesBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 ";
	docentesBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionEliminarDocente.className="hide";
	selectEliminarDocente.onchange="";
}

function cargarDatosDocentes(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/docentes/gestion_docentes.php?id="+valorSeleccionado;
}

function refrescar(){
	document.location="masterPage.php";
}

function cargarDatosUsuarios(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value; 
	document.location="../php/usuarios/agregar_usuario.php?id="+valorSeleccionado;
}
