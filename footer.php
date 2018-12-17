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
		
		<script>
			
			var user= 'admin';
			var password ="pruebaresuelve123";
			var listadoUsuarios;
			
			var promesaLogin = login(user,CryptoJS.MD5(password).toString());

			
			obtenerListadoUsuarios(promesaLogin,"https://us-central1-prueba-resuelve.cloudfunctions.net/users/list?page=23&sortBy=apellido&sortDirection=desc");

			

			function login(user, password){
				//Se hace la peticion a la API para login
				var x =axios.post('https://us-central1-prueba-resuelve.cloudfunctions.net/users/adminLogin', {
					user: user,
					password: password
				});
				return x;

			}

			function obtenerListadoUsuarios(promesaLogin,urlPagina){
				
				promesaLogin.then(function (responseLogin) {
					//Si recibimos un Estatus 200 del Login
					console.log(responseLogin);
					var token=responseLogin.headers.authorization;
						
					//Obtenemos la Información del Token de Login
					var informacion=parseJwt (token);
					console.log(informacion);
						
					//Enviamos el Token para obtener el listado de Usuarios
					axios.get(urlPagina, {
					headers: { "Authorization": token }
					})
					.then(function(response) {
						console.log(response)
						//obtenemos todos los usuarios de la pagina
						listadoUsuarios=response.data.records;
						console.log(listadoUsuarios[0]);
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
	</body>
</html>