sumTiempos= 0;
idProfesor= 0;
function cambiarTableHorizontal() {
	var boton = document.getElementById("boton-tamano-tabla-horizontal");
	setTimeout(cambiaDivTabla,400);

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
	cambiaDivTabla();

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
	var li_nav6= document.getElementById("li_nav6");
	var a_nav6= document.getElementById("a_nav6");
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
		li_nav6.className="desabilitado_li disabled";
		a_nav6.className="desabilitado_a disabled";
		li_nav7.className="desabilitado_li disabled";
		a_nav7.className="desabilitado_a disabled";

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
		li_nav6.className="dropdown";
		a_nav6.className="dropdown-toggle";
		li_nav7.className="dropdown";
		a_nav7.className="dropdown-toggle";

		habilita.className= "glyphicon glyphicon-ban-circle";
	}
}
/////////////////////////////////////////////////////////

function cargarDatosUsuarios(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/usuarios/agregar_usuario.php?id="+valorSeleccionado;
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
	cursosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	cursosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	cursosBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
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
	cursosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	cursosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	cursosBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
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
	proyectoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	proyectoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	proyectoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
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
	proyectoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	proyectoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	proyectoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
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
	proyectosBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	proyectosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	proyectosBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	seccionEliminarProyecto.className="hide";
	selectEliminarProyecto.onchange="";
}

function cargarDatosProyecto(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/proyectos/gestorProyectos.php?id="+valorSeleccionado;
}

/////////////////////////////////////////////////////////
function cargarDatosProyectoPresupuestoAgregar(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/proyectos/gestorProyectosAsignarPresupuesto.php?id="+valorSeleccionado+"&agregandoPresupuestoProyecto=1";
}

function cargarDatosProyectoPresupuestoEliminar(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/proyectos/gestorProyectosAsignarPresupuesto.php?id="+valorSeleccionado+"&eliminadoPresupuestoProyecto=1";
}

/////////////////////////////////////////////////////////

function activarAgregarProyectoPresupuesto() {
	var selectEliminarProyecto2 = document.getElementById('selectEliminarProyecto2');
	var seccionEliminarProyecto = document.getElementById('seccionEliminarProyecto2');

	var proyectoBtnEliminar = document.getElementById('proyectosBtnEliminar2');
	var proyectoBtnAgregar = document.getElementById('proyectosBtnAgregar2');

	selectEliminarProyecto2.setAttribute("onchange", "cargarDatosProyectoPresupuestoAgregar(this)");
	proyectoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	proyectoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	seccionEliminarProyecto.className="hide";
}

function activarEliminarProyectoPresupuesto() {
	var selectEliminarProyecto2 = document.getElementById('selectEliminarProyecto2');
	var seccionEliminarProyecto = document.getElementById('seccionEliminarProyecto2');

	var proyectosBtnEliminar = document.getElementById('proyectosBtnEliminar2');
	var proyectosBtnAgregar = document.getElementById('proyectosBtnAgregar2');


	selectEliminarProyecto2.setAttribute("onchange", "cargarDatosProyectoPresupuestoEliminar(this)");
	proyectosBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	proyectosBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	seccionEliminarProyecto.className="hide";
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
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	seccionEliminarDocente.className="";
}

function activarModificarDocente(){
	var docenteBtnModificar = document.getElementById('docentesBtnModificar');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar');
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar');
	var docenteAgregar = document.getElementById('docenteAgregar');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
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
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	seccionEliminarDocente.className="hide";
	selectEliminarDocente.onchange="";
}

///////////////////////////////////////////////
function activarAgregarDocenteConPermisos() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar2');
	var docenteAgregar = document.getElementById('docenteAgregar2');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente2');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar2');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar2');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar2');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	seccionEliminarDocente.className="";
}

function activarModificarDocenteConPermisos(){
	var docenteBtnModificar = document.getElementById('docentesBtnModificar2');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar2');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar2');
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar2');
	var docenteAgregar = document.getElementById('docenteAgregar2');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente2');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	seccionEliminarDocente.className="";
}

function activarEliminarDocenteConPermisos() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar2');
	var docenteAgregar = document.getElementById('docenteAgregar2');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente2');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar2');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar2');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar2');
	var selectEliminarDocente = document.getElementById('selectEliminarDocente2');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	seccionEliminarDocente.className="hide";
	selectEliminarDocente.onchange="";
}
/////////////////////////////////////////////////
function cargarDatosDocentes(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
	 	document.location="../php/docentes/gestion_docentes.php?id="+valorSeleccionado;
 }
}


function cargarDatosDocentesConPermiso(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
	 	document.location="../php/docentes/gestion_docentesConPermiso.php?id="+valorSeleccionado;
 }
}


function refrescar(){
	document.location="masterPage.php";
}
///////////////////////////////////////////////
function activarAgregarDocenteAdministrativo() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar3');
	var docenteAgregar = document.getElementById('docenteAgregar3');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente3');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar3');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar3');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar3');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	seccionEliminarDocente.className="";
}

function activarModificarDocenteAdministrativo(){
	var docenteBtnModificar = document.getElementById('docentesBtnModificar3');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar3');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar3');
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar3');
	var docenteAgregar = document.getElementById('docenteAgregar3');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente3');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	seccionEliminarDocente.className="";

}

function activarEliminarDocenteAdministrativo() {
	var docenteEliminarModificar = document.getElementById('docenteEliminarModificar3');
	var docenteAgregar = document.getElementById('docenteAgregar3');
	var seccionEliminarDocente = document.getElementById('seccionEliminarDocente3');

	var docenteBtnModificar = document.getElementById('docentesBtnModificar3');
	var docenteBtnEliminar = document.getElementById('docentesBtnEliminar3');
	var docenteBtnAgregar = document.getElementById('docentesBtnAgregar3');
	var selectEliminarDocente = document.getElementById('selectEliminarDocente3');

	docenteEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	docenteAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	docenteBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	docenteBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	docenteBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	seccionEliminarDocente.className="hide";
	selectEliminarDocente.onchange="";
}
function cargarDatosDocentesAdministrativo(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
	 	document.location="../php/docentes/gestion_docenteAdministrativo.php?id="+valorSeleccionado;
 }
}
//////////////// Refresca la pagina cuando se cierra el modal ///////
$('#modalDocentesAdministrativo').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalDocentesConPermisos').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalAsignarPresupuesto').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalCursos').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalDocentes').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalGrupos').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalPresupuesto').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalProyectos').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalProyectosPresupuesto').on('hidden.bs.modal', function (e) {
  refrescar();
})
$('#modalRegistro').on('hidden.bs.modal', function (e) {
  refrescar();
})
/////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function activarAgregarGrupos() {
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoAgregar = document.getElementById('grupoAgregar');
	var grupoAgregarDoble = document.getElementById('grupoAgregarDoble');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var docenteBtnEliminar = document.getElementById('grupoBtnEliminar');

	grupoAgregarModificar.className="";
	grupoAgregar.className="form-group col-xs-12 col-sm-12 col-lg-12";
	grupoAgregarDoble.className="form-group col-xs-12 col-sm-12 col-lg-12";
	grupoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	grupoBtnModificar.className="hide";
	grupoBtnEliminar.className="hide";
}

function activarModificarGrupos(){
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoAgregar = document.getElementById('grupoAgregar');
	var grupoAgregarDoble = document.getElementById('grupoAgregarDoble');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var grupoBtnEliminar = document.getElementById('grupoBtnEliminar');

	grupoAgregarModificar.className="";
	grupoAgregar.className="hide";
	grupoAgregarDoble.className="hide";
	grupoBtnAgregar.className="hide";
	grupoBtnModificar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	grupoBtnEliminar.className="hide";
}

function activarEliminarGrupos() {
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var grupoBtnEliminar = document.getElementById('grupoBtnEliminar');
	var selectCurso = document.getElementById('selectAgregarCurso');

	grupoAgregarModificar.className="hide";
	grupoBtnAgregar.className="hide";
	grupoBtnModificar.className="hide";
	grupoBtnEliminar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	selectCurso.onchange= "";
}

function activarGrupoDoble() {
	if (document.getElementById('cbhGrupoDoble').checked) {
		document.getElementById('grupoDoble').className="";
	} else {
		document.getElementById('grupoDoble').className="hide";
	}
}

function cargarDatosCarrera(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
		if ($('#grupoBtnModificar').attr('class') == "hide" && $('#grupoBtnEliminar').attr('class') == "hide") {
			document.location="masterPage.php?modalGrupos=1&id_carrera="+valorSeleccionado;
		} else {
			if ($('#grupoBtnAgregar').attr('class') == "hide" && $('#grupoBtnEliminar').attr('class') == "hide") {
				document.location="masterPage.php?modalGrupos=2&id_carrera="+valorSeleccionado;
			} else {
				if ($('#grupoBtnAgregar').attr('class') == "hide" && $('#grupoBtnModificar').attr('class') == "hide") {
					document.location="masterPage.php?modalGrupos=3&id_carrera="+valorSeleccionado;
				}
			}
		}
 	}
}

function cargarDatosGrupo(obj){
	var valorSeleccionado = (document.getElementById('selectAgregarCarrera')).value;
	var valorSeleccionado2 = (obj.options[obj.selectedIndex].value).split(" ");
	if (valorSeleccionado != "0") {
		if ($('#grupoBtnModificar').attr('class') == "hide" && $('#grupoBtnEliminar').attr('class') == "hide") {
			document.location="masterPage.php?modalGrupos=1&id_carrera="+valorSeleccionado+"&curso="+valorSeleccionado2[0];
		} else {
			if ($('#grupoBtnAgregar').attr('class') == "hide" && $('#grupoBtnEliminar').attr('class') == "hide") {
				document.location="../php/grupos/gestionGrupos.php?id_carrera="+valorSeleccionado+"&curso="+valorSeleccionado2[0]+"&num_grupo="+valorSeleccionado2[1]+"&num_grupo_doble="+valorSeleccionado2[2];
			}
		}
	}
}

////////////////////////////////////////////////////////////////////////
function activarAgregarPresupuesto() {
	var presupuestoEliminarModificar = document.getElementById('presupuestoEliminarModificar');
	var presupuestoAgregar = document.getElementById('presupuestoAgregar');
	var seccionEliminarPresupuesto = document.getElementById('seccionEliminarPresupuesto');

	var presupuestoBtnModificar = document.getElementById('presupuestoBtnModificar');
	var presupuestoBtnEliminar = document.getElementById('presupuestoBtnEliminar');
	var presupuestoBtnAgregar = document.getElementById('presupuestoBtnAgregar');

	presupuestoEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	presupuestoAgregar.className="col-xs-12 col-sm-12 col-lg-12";
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	seccionEliminarPresupuesto.className="";
}

function activarModificarPresupuesto(){
	var presupuestoEliminarModificar = document.getElementById('presupuestoEliminarModificar');
	var presupuestoAgregar = document.getElementById('presupuestoAgregar');
	var seccionEliminarPresupuesto = document.getElementById('seccionEliminarPresupuesto');

	var presupuestoBtnModificar = document.getElementById('presupuestoBtnModificar');
	var presupuestoBtnEliminar = document.getElementById('presupuestoBtnEliminar');
	var presupuestoBtnAgregar = document.getElementById('presupuestoBtnAgregar');

	presupuestoEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12 ";
	presupuestoAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	seccionEliminarPresupuesto.className="";
}

function activarEliminarPresupuesto() {
	var presupuestoEliminarModificar = document.getElementById('presupuestoEliminarModificar');
	var presupuestoAgregar = document.getElementById('presupuestoAgregar');
	var seccionEliminarPresupuesto = document.getElementById('seccionEliminarPresupuesto');

	var presupuestoBtnModificar = document.getElementById('presupuestoBtnModificar');
	var presupuestoBtnEliminar = document.getElementById('presupuestoBtnEliminar');
	var presupuestoBtnAgregar = document.getElementById('presupuestoBtnAgregar');
	var selectEliminarPresupuesto = document.getElementById('selectEliminarPresupuesto');

	presupuestoEliminarModificar.className="col-xs-12 col-sm-12 col-lg-12";
	presupuestoAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton col-lg-12 ";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide";
	seccionEliminarPresupuesto.className="hide";
	selectEliminarPresupuesto.onchange="";
}

function cargarDatosPresupuesto(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/presupuestos/gestorPresupuesto.php?id="+valorSeleccionado;
}

////////////////////////////////////////////////////////////////////////

function activarAsignarPresup() {
	var asignarGrupoPresup = document.getElementById('asignarGrupoPresup');
	var eliminarGrupoPresup = document.getElementById('eliminarGrupoPresup');

	var btnAsignarGrupoPresup = document.getElementById('btnAsignarGrupoPresup');
	var btnEliminarGrupoPresup = document.getElementById('btnEliminarGrupoPresup');

	asignarGrupoPresup.className="form-group col-xs-12 col-sm-12 col-lg-12";
	eliminarGrupoPresup.className="hide";
	btnAsignarGrupoPresup.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	btnEliminarGrupoPresup.className="hide";
}

function eliminarAsignarPresup() {
	var asignarGrupoPresup = document.getElementById('asignarGrupoPresup');
	var eliminarGrupoPresup = document.getElementById('eliminarGrupoPresup');

	var btnAsignarGrupoPresup = document.getElementById('btnAsignarGrupoPresup');
	var btnEliminarGrupoPresup = document.getElementById('btnEliminarGrupoPresup');

	asignarGrupoPresup.className="hide";
	eliminarGrupoPresup.className="form-group col-xs-12 col-sm-12 col-lg-12";
	btnAsignarGrupoPresup.className="hide";
	btnEliminarGrupoPresup.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
}

////////////////////////////////////////////////////////////////////////
$("#btnProfesor").click(function () {
	idProfesor= cuentaDiv(false, false);
	if (idProfesor < 6 && $("#selectAgregarDocente option:selected").text() != "") {
		$("#div-profesores").html($("#div-profesores").html()+'<div id="divProfesor'+idProfesor+'" class="form-group"><input id="txtProfesor'+idProfesor+'" name="txtProfesor'+idProfesor+'" class="input-readonly" type="text" value="'+$("#selectAgregarDocente option:selected").text()+" - "+$("#selectTiempoProfesor").val()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs" onclick="eliminarProfesor(document.getElementById(\'txtProfesor'+idProfesor+'\'))"><span class="glyphicon glyphicon-minus"></span></button></div>');
		modificaJornada(false, FraccionToDoble(trim(document.getElementById("txtProfesor"+(idProfesor)).value.split("-")[1])));
	}
});

function eliminarProfesor(divProfesor) {
	modificaJornada(true, FraccionToDoble(trim(divProfesor.value.split("-")[1])));
	$("#"+$(divProfesor).parent().attr('id')).remove();
}

function modificaJornada(esResta, cantidad) {
	if (esResta) {
		sumTiempos= Number(document.getElementById("txtJornada").value);
		sumTiempos-= cantidad;
		document.getElementById("txtJornada").value=sumTiempos;
	} else {
		sumTiempos= Number(document.getElementById("txtJornada").value);
		sumTiempos+= cantidad;
		document.getElementById("txtJornada").value=sumTiempos;
	}
}

$("#btnHorario").click(function () {
	idHorario= cuentaDiv(false, true);
	if (idHorario < 6) {
		$("#div-horarios").html($("#div-horarios").html()+'<div id="divHorario'+idHorario+'" class="form-group"><input name="txtHorario'+idHorario+'" class="input-readonly" type="text" value="'+$("#selectDiaSemana option:selected").text()+" "+$("#selectHoraInicio option:selected").text()+" - "+$("#selectHoraFin option:selected").text()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
		$("button").on('click', function() {
			if ($(this).parent().attr('id') != "grupoBtnAgregar" && $(this).parent().attr('id') != "grupoBtnModificar") {
				$("#"+$(this).parent().attr('id')).remove();
			}
		});
	}
});

$("#btnProfesorDoble").click(function () {
	idProfesor= cuentaDiv(true, false);
	if (idProfesor < 6 && $("#selectAgregarDocenteDoble option:selected").text() != "") {
		$("#div-profesoresDoble").html($("#div-profesoresDoble").html()+'<div id="divProfesorDoble'+idProfesor+'" class="form-group"><input id="txtProfesorDoble'+idProfesor+'" name="txtProfesorDoble'+idProfesor+'" class="input-readonly" type="text" value="'+$("#selectAgregarDocenteDoble option:selected").text()+" - "+$("#selectTiempoProfesorDoble").val()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs" onclick="eliminarProfesor(document.getElementById(\'txtProfesorDoble'+idProfesor+'\'))"><span class="glyphicon glyphicon-minus"></span></button></div>');
		modificaJornada(false, FraccionToDoble(trim(document.getElementById("txtProfesorDoble"+(idProfesor)).value.split("-")[1])));
	}
});

$("#btnHorarioDoble").click(function () {
	idHorario= cuentaDiv(true, true);
	if (idHorario < 6) {
		$("#div-horariosDoble").html($("#div-horariosDoble").html()+'<div id="divHorarioDoble'+idHorario+'" class="form-group"><input name="txtHorarioDoble'+idHorario+'" class="input-readonly" type="text" value="'+$("#selectDiaSemanaDoble option:selected").text()+" "+$("#selectHoraInicioDoble option:selected").text()+" - "+$("#selectHoraFinDoble option:selected").text()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
		$("button").on('click', function() {
			if ($(this).parent().attr('id') != "grupoBtnAgregar" && $(this).parent().attr('id') != "grupoBtnModificar") {
				$("#"+$(this).parent().attr('id')).remove();
			}
		});
		idHorario++;
	}
});

function cuentaDiv(esDoble, tipoDiv) {
	idDiv=0;
	RevisarDiv= "";
	if (esDoble) {
		if (tipoDiv) {
			RevisarDiv= "divHorarioDoble";
		} else {
			RevisarDiv= "divProfesorDoble";
		}
	} else {
		if (tipoDiv) {
			RevisarDiv= "divHorario";
		} else {
			RevisarDiv= "divProfesor";
		}
	}
	for (var i = 0; i < 6; i++) {
		if (document.getElementById(RevisarDiv+i)) {
			if (tipoDiv) {
				document.getElementById(RevisarDiv+i).id=RevisarDiv+idDiv;
				idDiv++;
			} else {
				document.getElementById(RevisarDiv+i).id=RevisarDiv+idDiv;
				idDiv++;
			}
		}
	}
	return idDiv;
}

////////////////////////////////////////////////////////////////////////
function cargarCboxPorCarrera(obj) {
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	var valorTexto = obj.options[obj.selectedIndex].text;
	document.location="masterPage.php?cargarPorCarrera="+valorSeleccionado+"&valorPorCarreraTexto="+valorTexto;
}
////////////////////////////////////////////////////////////////////////

function cambiaDivTabla() {
	gruposDiv= document.getElementsByClassName("gruposDiv");
 	horariosDiv= document.getElementsByClassName("horariosDiv");
	docentesDiv= document.getElementsByClassName("docentesDiv");
	for (var i = 0; i < gruposDiv.length; i++) {
		if (horariosDiv[i].offsetHeight > docentesDiv[i].offsetHeight) {
			gruposDiv[i].style.height= (docentesDiv[i].offsetHeight)+"px";
		} else {
			gruposDiv[i].style.height= (horariosDiv[i].offsetHeight)+"px";
		}
	}
}

////////////////////////////////////////////////
function trim(cadena){
	return cadena.replace(/^\s+|\s+$/g, "");
}

//////////////// conversor ////////////////////
function FraccionToDoble(fraccion){
	var valor = 0.0;
	switch (fraccion) {
		case '1':
			valor = 1.000;
			break;
		case '7/8':
			valor = 0.875;
			break;
		case '3/4':
			valor = 0.750;
			break;
		case '5/8':
			valor = 0.625;
			break;
		case '1/2':
			valor = 0.500;
			break;
		case '3/8':
			valor = 0.375;
			break;
		case '1/4':
			valor = 0.250;
			break;
		case '1/8':
			valor = 0.125;
			break;
		case '1/16':
			valor = 0.0625;
			break;

		default:
			valor = 0;
		break;
	}
	return valor;
}

//////////////////////// para modal reportes /////////////////////
function activarModalReportesDocentes(){
	formReporteDocente = document.getElementById('formReporteDocente');
	formReporteDocente.className='';

	formReporteProyecto = document.getElementById('formReporteProyecto');
	formReporteProyecto.className='hide';
	formReportePresupuesto = document.getElementById('formReportePresupuesto');
	formReportePresupuesto.className='hide';
	formReporteGrupo = document.getElementById('formReporteGrupo');
	formReporteGrupo.className='hide';
}
function activarModalReportesProyectos(){
	formReporteProyecto = document.getElementById('formReporteProyecto');
	formReporteProyecto.className='';

	formReporteDocente = document.getElementById('formReporteDocente');
	formReporteDocente.className='hide';
	formReportePresupuesto = document.getElementById('formReportePresupuesto');
	formReportePresupuesto.className='hide';
	formReporteGrupo = document.getElementById('formReporteGrupo');
	formReporteGrupo.className='hide';
}
function activarModalReportesPresupuestos(){
	formReportePresupuesto = document.getElementById('formReportePresupuesto');
	formReportePresupuesto.className='';

	formReporteDocente = document.getElementById('formReporteDocente');
	formReporteDocente.className='hide';
	formReporteProyecto = document.getElementById('formReporteProyecto');
	formReporteProyecto.className='hide';
	formReporteGrupo = document.getElementById('formReporteGrupo');
	formReporteGrupo.className='hide';
}
function activarModalReportesGrupos(){
	formReporteGrupo = document.getElementById('formReporteGrupo');
	formReporteGrupo.className='';

	formReporteDocente = document.getElementById('formReporteDocente');
	formReporteDocente.className='hide';
	formReporteProyecto = document.getElementById('formReporteProyecto');
	formReporteProyecto.className='hide';
	formReportePresupuesto = document.getElementById('formReportePresupuesto');
	formReportePresupuesto.className='hide';
}
