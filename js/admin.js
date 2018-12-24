
var token = "";
var api = "";
var id_usuario="";
var usd2mxn=0;
var mxn2usd=0;
var isPesosActive = true;
var isDollarActive = false;
var paginaActualMovimietos = 1;


//Revisamos que exista el token
if (sessionStorage.getItem('token') == null){
	//Si no hay token lo regresamos al index
	window.location.replace("index.php");
}
else
{
	//Obtenemos el token del login
	token = sessionStorage.getItem("token");
	//Obtenemos la API de la sesión
	api = sessionStorage.getItem("api");

	//Solicitamos los valores actuales de las divisas
	axios.get(api+'/money/conversion')
	.then(function(response) {
	  usd2mxn = response.data.usd2mxn;
	  mxn2usd = response.data.mxn2usd
	})
	.catch(function(error) {
	  console.log(error)
	})
}


//Funcion para cerrar la sesion
jQuery(function($){
	$("#botonCerrarSesion").click(function() {
		//Borramos todo lo que hay en la sesion
		sessionStorage.clear();
		//Reditreccionamos al login
		window.location.replace("index.php");
	});
});


jQuery(function($){

	//Solicitamos el listado de los usuarios la primera vez que carga la página
	obtenerListadoUsuarios(token,api+"/users/list?page=1&sortBy=apellido&sortDirection=desc");
	
	//Funcion para obtener los movimientos de cada usuario
	$(document).on('click', '.botonMovimientos', function() {

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

	//Obtenemos la Información del Token de Login
	var informacion = parseJwt(token);
	//Mostramos el nombre de la persona que inició sesión
	$(".nombreUsuario").text("Bienvenido, "+informacion.nombre+" "+informacion.apellido);

						
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

function obtenerMovimientosPorUsuario(token,user_id,pagina)
{
	var url=api+'/users/'+user_id+'/movements?page='+pagina+'&sortBy=amount&sortDirection=desc';
	var listadoMovimientos;
		
	//Obtenemos el listado de movimientos	
	axios.get(url,{
		headers: { "Authorization": token }
	})
	.then(function(response) {

		//Construimos el paginador
		construirPaginadorMovimientos(response.data.pagination.totalPages);
							
		//Enviamos la información para desplegarla en pantalla
		construirTablaMovimientos(response.data.records);

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

function construirPaginadorMovimientos(paginasTotales){

	$('#listaPaginacionMovimientos').twbsPagination({
		totalPages: paginasTotales,
		visiblePages: 5,
		next: 'Siguiente',
		prev: 'Anterior',
		first: 'Primero',
		last: 'Último',
		onPageClick: function (event, pagina) {
			paginaActualMovimietos=pagina;
		    //Solicitamos los movimientos del usuario de la siguiente página
		    obtenerMovimientosPorUsuario(token,id_usuario,pagina);
		}
	});
}

//Funcion para construi la tabla de movimientos
function construirTablaMovimientos(arregloMovimientos){
	var resultado="";
	arregloMovimientos.forEach(movimiento => {
		var fila='<tr>'+
		'<td>'+movimiento.description+'</td>'+
		'<td>'+movimiento.type+'</td>'+
		'<td>'+darFormatoCantidad(movimiento.amount)+'</td>'+
		'<td>'+new Date(movimiento.created_at)+'</td>'+
		'</tr>';
		resultado+=fila;
	});

	$('#paginaContenidoMovimientos').html(resultado);
	$('p.cuenta').text("Cuenta: "+arregloMovimientos[0].account);
}

//Funcion para dar formato de dinero a las cantidades
function darFormatoCantidad(cantidad){
	var resultado = 0;
	if(isPesosActive)
	{
		const formatter = new Intl.NumberFormat('es-MX', {
			style: 'currency',
			currency: 'MXN',
			minimumFractionDigits: 2
		})
		resultado= formatter.format(cantidad/100)
	}//Dollar
	else
	{
		const formatter = new Intl.NumberFormat('en-US', {
			style: 'currency',
			currency: 'USD',
			minimumFractionDigits: 2
		})
		resultado = formatter.format((cantidad/100)*mxn2usd);
	}

	return resultado;
}
jQuery(function($){
	$(".botonDivisa").click(function() {


 		$(this).addClass('active').siblings().removeClass("active");
 		
 		 obtenerMovimientosPorUsuario(token,id_usuario,paginaActualMovimietos);
 		//Obtenemos el id del usuario
		if($(this).attr("id")=="botonCambiaPeso")
		{
			isPesosActive = true;
			isDollarActive = false;
		}
		else
		{
			isPesosActive = false;
			isDollarActive = true;
		}
    });
});
