<?php
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Footer para las páginas
*/
?>
	<footer>
		
	</footer>
		<!--js-->
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
		
		<!--Consulta de información-->
		<script>
			
			var user= 'admin';
			var password ="pruebaresuelve123";
			var api="https://us-central1-prueba-resuelve.cloudfunctions.net/"
			
			var promesaLogin = login(user,CryptoJS.MD5(password).toString());

			
			//Solicitamos el listado de los usuarios
			obtenerListadoUsuarios(promesaLogin,api+"/users/list?page=1&sortBy=apellido&sortDirection=desc");

			
			

			function login(user, password){
				//Se hace la peticion a la API para login
				//Devolvemos el objeto de la promesa
				return axios.post(api+'/users/adminLogin', {
					user: user,
					password: password
				});
			}

			function obtenerListadoUsuarios(promesaLogin,urlPagina){
				var listadoUsuarios;
				
				promesaLogin.then(function (responseLogin) {
					//Si recibimos un Estatus 200 del Login
					console.log(responseLogin);
					var token = responseLogin.headers.authorization;
						
					//Obtenemos la Información del Token de Login
					var informacion = parseJwt(token);
					console.log(informacion);
						
					//Enviamos el Token para obtener el listado de Usuarios
					axios.get(urlPagina, {
						headers: { "Authorization": token }
					})
					.then(function(response) {
						console.log(response)
						
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
				})
				.catch(function (error) {
					//En caso de error
					console.log(error);
				});	
			}

			function obtenerMovimientosPorUsuario(promesaLogin,user_id,pagina)
			{
				var url=api+'/users/'+user_id+'/movements?page='+pagina+'&sortBy=amount&sortDirection=desc';
				var listadoMovimientos;

				promesaLogin.then(function (responseLogin) {
					//Si recibimos un Estatus 200 del Login
					var token = responseLogin.headers.authorization;
					
					//Obtenemos el listado de movimientos	
					axios.get(url,{
						headers: { "Authorization": token }
					})
					.then(function(response) {
						console.log(response)

						//Construimos el paginador
						construirPaginadorMovimientos(response.data.pagination.totalPages);
						
						//Enviamos la información para desplegarla en pantalla
						construirTablaMovimientos(response.data.records);

					})
					.catch(function(error) {
					  console.log(error)
					})
				})
				.catch(function (error) {
					//En caso de error
					console.log(error);
				});
			}

			function parseJwt (token) {
	            var base64Url = token.split('.')[1];
	            var base64 = base64Url.replace('-', '+').replace('_', '/');
	            return JSON.parse(window.atob(base64));
	        };
		</script>
		<!--Paginacion y Ordenamiento-->
		<script>
		var id_usuario="";
		function construirPaginadorUsuarios(paginasTotales){

			$('#listaPaginacion').twbsPagination({
		        totalPages: paginasTotales,
		        visiblePages: 5,
		        next: 'Siguiente',
		        prev: 'Anterior',
		        first: 'Primero',
		        last: 'Último',
		        onPageClick: function (event, pagina) {
		        	obtenerListadoUsuarios(promesaLogin,api+"/users/list?page="+pagina+"&sortBy=apellido&sortDirection=desc");
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
		           	'<td><button id="'+cliente.uid+'" class="botonMovimientos">Ver Movimientos</button></td>'+
		           	'</tr>';
	            	resultado+=fila;
				});

		        $('#paginaContenido').html(resultado);
		}

		function construirPaginadorMovimientos(paginasTotales){
			console.log("total paginas movimientos"+paginasTotales);


			$('#listaPaginacionMovimientos').twbsPagination({
		        totalPages: paginasTotales,
		        visiblePages: 5,
		        next: 'Siguiente',
		        prev: 'Anterior',
		        first: 'Primero',
		        last: 'Último',
		        onPageClick: function (event, pagina) {
		        	//Solicitamos los movimientos del usuario en la pagina determinada
		        	obtenerMovimientosPorUsuario(promesaLogin,id_usuario,pagina);
		        }
		    });
		}
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

		function darFormatoCantidad(cantidad){
			const formatter = new Intl.NumberFormat('es-MX', {
			  style: 'currency',
			  currency: 'MXN',
			  minimumFractionDigits: 2
			})

			return formatter.format(cantidad/100);
		}

		//Funcion para obtener los movimientos de cada usuario
		$(document).ready(function(){
			$(document).on('click', '.botonMovimientos', function() {
				//Obtenemos el id del usuario
   			    id_usuario= $(this).attr("id");

   			    //Repintamos el paginador
   			    $('#listaPaginacionMovimientos').remove();
				$('#paginadorMovimientos').html('<ul id="listaPaginacionMovimientos" class="pagination-sm"></ul>');

				//Solicitamos el listado de los movimientos
				obtenerMovimientosPorUsuario(promesaLogin,id_usuario,1);
			});
		});
		</script>

	</body>
</html>