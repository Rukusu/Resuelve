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

		
		<!--Consulta de información-->
		<script>
			// Salvamos la API en la sesion
			sessionStorage.setItem("api", "https://us-central1-prueba-resuelve.cloudfunctions.net/");
		</script>
		
		<?php imprimeScripts(); ?>		
		<script>
			function parseJwt (token) {
	            var base64Url = token.split('.')[1];
	            var base64 = base64Url.replace('-', '+').replace('_', '/');
	            return JSON.parse(window.atob(base64));
	        };
		</script>
		


	</body>
</html>