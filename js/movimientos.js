function obtenerMovimientosPorUsuario(token,user_id,pagina)
{
	
	var url="";

	//Si los movimientos los solicita un cliente
	if(user_id == -1)
	{
		url=api+'/users/myMovements?page='+pagina+'&sortBy=amount&sortDirection=desc';
	}
	else //Los movimientos los solicita el administrador
	{
		url=api+'/users/'+user_id+'/movements?page='+pagina+'&sortBy=amount&sortDirection=desc';
	}

	
		
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
		console.log(error);
	})
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

//
jQuery(function($){
	//Obtenemos el path de la URL actual
	var pathname = window.location.pathname;
	$(".botonDivisa").click(function() {
		
 		$(this).addClass('active').siblings().removeClass("active");
 		
 		//Si es la vista del cliente
 		if(pathname == "/resuelve/cliente.php")
 		{
 			//No enviamos el id_usuario
 			obtenerMovimientosPorUsuario(token,-1,paginaActualMovimietos);
 		}
 		else
 		{
 			//Obtenemos los movimientos del usuario elegido
 			obtenerMovimientosPorUsuario(token,id_usuario,paginaActualMovimietos);
 		}
 		
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