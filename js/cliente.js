jQuery(function($){
	//Obtenemos la Información del Token de Login
	var informacionUsr = parseJwt(token);
	//Mostramos el nombre de la persona que inició sesión
	$(".nombreUsuario").text("Bienvenido, "+informacionUsr.nombre+" "+informacionUsr.apellido);

	//Habilitamos los botones del cambio de divisas
	$('.botonDivisa').removeAttr('disabled');

	//Solicitamos el listado de los movimientos
	obtenerMovimientosPorUsuario(token,-1,1);

});