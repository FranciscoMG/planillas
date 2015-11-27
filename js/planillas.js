var idProfesor= 0;
var idHorario= 0;

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

function cargarDatosDocentes(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
	 	document.location="../php/docentes/gestion_docentes.php?id="+valorSeleccionado;
 }
}

function refrescar(){
	document.location="masterPage.php";
}

/////////////////////////////////////////////////////////////////////////

function activarAgregarGrupos() {
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var docenteBtnEliminar = document.getElementById('grupoBtnEliminar');

	grupoAgregarModificar.className="";
	grupoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	grupoBtnModificar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
	grupoBtnEliminar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide";
}

function activarModificarGrupos(){
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var grupoBtnEliminar = document.getElementById('grupoBtnEliminar');

	grupoAgregarModificar.className="";
	grupoBtnAgregar.className="hide";
	grupoBtnModificar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	grupoBtnEliminar.className="hide";
}

function activarEliminarGrupos() {
	var grupoAgregarModificar = document.getElementById('grupoAgregarModificar');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var grupoBtnEliminar = document.getElementById('grupoBtnEliminar');

	grupoAgregarModificar.className="hide";
	grupoBtnAgregar.className="hide";
	grupoBtnModificar.className="hide";
	grupoBtnEliminar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
}

function cargarDatosCarrera(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	if (valorSeleccionado != "0") {
	 	document.location="masterPage.php?modalGrupos=1&id_carrera="+valorSeleccionado;
 }
}

function cargarDatosCursos2(obj) {
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location=window.location+"&id_curso="+valorSeleccionado;
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
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12";
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
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
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
	presupuestoBtnModificar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 hide";
	presupuestoBtnEliminar.className="col-xs-12 col-sm-12 col-md-12 col-lg-12 ";
	presupuestoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 hide";
	seccionEliminarPresupuesto.className="hide";
	selectEliminarPresupuesto.onchange="";
}

function cargarDatosPresupuesto(obj){
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	document.location="../php/presupuestos/gestorPresupuesto.php?id="+valorSeleccionado;
}

$("#btnProfesor").click(function () {
	$("#div-profesores").html($("#div-profesores").html()+'<div id="divProfesor'+idProfesor+'" class="form-group"><input name="txtProfesor'+idProfesor+'" class="input-readonly" type="text" value="'+$("#selectAgregarDocente option:selected").text()+" - "+$("#selectTiempoProfesor").val()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
	/*$("button").on('click', function() {
 		$("#"+$(this).parent().attr('id')).remove();
	});*/
	idProfesor++;
});

$("#btnHorario").click(function () {
	$("#div-horarios").html($("#div-horarios").html()+'<div id="divHorario'+idHorario+'" class="form-group"><input name="txtHorario'+idHorario+'" class="input-readonly" type="text" value="'+$("#selectDiaSemana option:selected").text()+" "+$("#selectHoraInicio option:selected").text()+" - "+$("#selectHoraFin option:selected").text()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
	/*$("button").on('click', function() {
 		$("#"+$(this).parent().attr('id')).remove();
	});*/
	idProfesor++;
});
