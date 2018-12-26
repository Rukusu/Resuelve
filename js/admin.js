jQuery(function($){

	//Obtenemos la Información del Token de Login
	var informacionUsr = parseJwt(token);
	//Mostramos el nombre de la persona que inició sesión
	$(".nombreUsuario").text("Bienvenido, "+informacionUsr.nombre+" "+informacionUsr.apellido);

	//Solicitamos el listado de los usuarios la primera vez que carga la página
	obtenerListadoUsuarios(token,api+"/users/list?page=1&sortBy=apellido&sortDirection=desc");

	//Funcion para obtener los movimientos de cada usuario
	$(document).on('click', '.botonMovimientos', function() {

		//Habilitamos los botones del cambio de divisas
		$('.botonDivisa').removeAttr('disabled');
		
		//Cuando ya se ha seleccionado al menos una ves los movimientos de un usuario
		if(id_usuario != "")
		{
			//Deseleccionamod el anterior
			$("#"+id_usuario).removeClass('active');
		}
		//Mostramos que de quien solicitamos los movimientos
		$(this).addClass('active');

		//Obtenemos el id del usuario
		id_usuario= $(this).attr("id");

		//Reconstruimos el paginador de movimientos
		$('#listaPaginacionMovimientos').remove();
		$('#paginadorMovimientos').html('<ul id="listaPaginacionMovimientos" class="pagination-sm justify-content-center"></ul>');

		//Solicitamos el listado de los movimientos
		obtenerMovimientosPorUsuario(token,id_usuario,1);
	});
});

function obtenerListadoUsuarios(token,urlPagina){
	var listadoUsuarios;

						
	//Enviamos el Token para obtener el listado de Usuarios
	axios.get(urlPagina, {
			headers: { "Authorization": token }
	})
	.then(function(response) {
						
		//obtenemos todos los usuarios de la pagina
		listadoUsuarios = response.data.records;
		//Construimos la información que va en el paginador
		construirPaginadorUsuarios(response.data.pagination.totalPages);
		//Enviamos la información para desplegarla en pantalla
		construirTablaUsuarios(response.data.records);

	})
	.catch(function(error) {
		console.log(error)
	})
}


function construirPaginadorUsuarios(paginasTotales){

	$('#listaPaginacion').twbsPagination({
	    totalPages: paginasTotales,
	    visiblePages: 5,
	    next: 'Siguiente',
	    prev: 'Anterior',
	    first: 'Primero',
	    last: 'Último',
	    onPageClick: function (event, pagina) {
	    	//Solicitamos el listado de usuarios de la siguiente página
		   	obtenerListadoUsuarios(token,api+"/users/list?page="+pagina+"&sortBy=apellido&sortDirection=desc");
        }
    });
}

function construirTablaUsuarios(arregloClientes){
	var resultado="";
    arregloClientes.forEach(cliente => {
	   	var fila='<tr>'+
	       	'<td>'+cliente.nombre+'</td>'+
	       	'<td>'+cliente.segundo_nombre+'</td>'+
	       	'<td>'+cliente.apellido+'</td>'+
	       	'<td>'+cliente.segundo_apellido+'</td>'+
	       	'<td>'+cliente.email+'</td>'+
	       	'<td>'+cliente.active+'</td>'+
	       	'<td><button id="'+cliente.uid+'" class="botonAmarillo botonMovimientos">Ver Movimientos</button></td>'+
	       	'</tr>';
	       	resultado+=fila;
	});

	$('#paginaContenido').html(resultado);
}