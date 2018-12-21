<?php
include 'header.php';
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Index para las páginas
*/
?>

<section class="container-fluid">
	<div class="row align-items-center justify-content-center contenido-login">
		<div class="login-wrapper">
			<h1 class="text-center">Iniciar Sesión</h1>
			<form>
				<div class="form-group">
			    	<label for="in-correo">Correo</label>
			    	<input type="input" class="form-control" id="in-correo" name="in-correo"  placeholder="correo@ejemplo.com">
				</div>
				<div class="form-group">
			  		<label for="in-pass">Contraseña</label>
			    	<input type="password" class="form-control" id="in-pass" name="in-pass" placeholder="Ingresa tu contraseña">
				</div>
			  <button type="button" id="btnEnviar" class="btn btn-primary float-right">Enviar</button>
			</form>
		</div>
	</div>
	
</section>

<?php include 'footer.php';?>