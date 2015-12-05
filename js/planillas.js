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
	var grupoAgregar = document.getElementById('grupoAgregar');
	var grupoAgregarDoble = document.getElementById('grupoAgregarDoble');
	var grupoBtnAgregar = document.getElementById('grupoBtnAgregar');
	var grupoBtnModificar = document.getElementById('grupoBtnModificar');
	var docenteBtnEliminar = document.getElementById('grupoBtnEliminar');
	var selectCurso = document.getElementById('selectAgregarCurso');

	grupoAgregarModificar.className="";
	grupoAgregar.className="form-group col-xs-12 col-sm-12 col-lg-12";
	grupoAgregarDoble.className="form-group col-xs-12 col-sm-12 col-lg-12";
	grupoBtnAgregar.className="col-xs-12 col-sm-12 col-lg-12 espacio-boton";
	grupoBtnModificar.className="hide";
	grupoBtnEliminar.className="hide";
	selectCurso.onchange= "";
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
		if ($('#grupoBtnAgregar').attr('class') == "hide" && $('#grupoBtnEliminar').attr('class') == "hide") {
			document.location="../php/grupos/gestionGrupos.php?id_carrera="+valorSeleccionado+"&curso="+valorSeleccionado2[0]+"&num_grupo="+valorSeleccionado2[1]+"&num_grupo_doble="+valorSeleccionado2[2];
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
	idProfesor= cuentaDiv(false, false);
	if (idProfesor < 6) {
		$("#div-profesores").html($("#div-profesores").html()+'<div id="divProfesor'+idProfesor+'" class="form-group"><input name="txtProfesor'+idProfesor+'" class="input-readonly" type="text" value="'+$("#selectAgregarDocente option:selected").text()+" - "+$("#selectTiempoProfesor").val()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
		$("button").on('click', function() {
			if ($(this).parent().attr('id') != "grupoBtnAgregar" && $(this).parent().attr('id') != "grupoBtnModificar") {
				$("#"+$(this).parent().attr('id')).remove();
			}
		});
		idProfesor++;
	}
});

$("#btnHorario").click(function () {
	idHorario= cuentaDiv(false, true);
	if (idHorario < 6) {
		$("#div-horarios").html($("#div-horarios").html()+'<div id="divHorario'+idHorario+'" class="form-group"><input name="txtHorario'+idHorario+'" class="input-readonly" type="text" value="'+$("#selectDiaSemana option:selected").text()+" "+$("#selectHoraInicio option:selected").text()+" - "+$("#selectHoraFin option:selected").text()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
		$("button").on('click', function() {
			if ($(this).parent().attr('id') != "grupoBtnAgregar" && $(this).parent().attr('id') != "grupoBtnModificar") {
				$("#"+$(this).parent().attr('id')).remove();
			}
		});
		idHorario++;
	}
});

$("#btnProfesorDoble").click(function () {
	idProfesor= cuentaDiv(true, false);
	if (idProfesor < 6) {
		$("#div-profesoresDoble").html($("#div-profesoresDoble").html()+'<div id="divProfesorDoble'+idProfesor+'" class="form-group"><input name="txtProfesorDoble'+idProfesor+'" class="input-readonly" type="text" value="'+$("#selectAgregarDocenteDoble option:selected").text()+" - "+$("#selectTiempoProfesorDoble").val()+'" readonly /><button type="button" class="btn btn-danger pull-right btn-xs"><span class="glyphicon glyphicon-minus"></span></button></div>');
		$("button").on('click', function() {
			if ($(this).parent().attr('id') != "grupoBtnAgregar" && $(this).parent().attr('id') != "grupoBtnModificar") {
				$("#"+$(this).parent().attr('id')).remove();
			}
		});
		idProfesor++;
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

//////////////////////////////////////////////
function cargarCboxPorCarrera(obj) {
	var valorSeleccionado = obj.options[obj.selectedIndex].value;
	var valorTexto = obj.options[obj.selectedIndex].text;
	document.location="masterPage.php?cargarPorCarrera="+valorSeleccionado+"&valorPorCarreraTexto="+valorTexto;
}
