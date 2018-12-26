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
			<h1 class="text-center">Iniciar sesión</h1>
			<form>
				<div class="form-group">
			    	<label for="in-correo">Correo</label>
			    	<input type="input" class="form-control" id="in-correo" name="in-correo"  placeholder="correo@ejemplo.com" value="">
				</div>
				<div class="form-group">
			  		<label for="in-pass">Contraseña</label>
			    	<input type="password" class="form-control" id="in-pass" name="in-pass" placeholder="Ingresa tu contraseña" value="">
				</div>
				<p class="errorLogin"></p>
				<button type="button" id="btnEnviar" class="botonAmarillo float-right">Enviar</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<p>Acceder como <strong>administrador</strong></p>
			<button type="button" id="btnAdmin" class="botonAmarillo btnPruebas">Probar</button>
			<p>Con éste usuario y contraseña se podrá acceder al panel de administrador, visualizando el listado de clientes y los movimientos de cada uno.</p>
		</div>
		<div class="col">
			<p>Acceder como <strong>cliente activo</strong></p>
			<button type="button" id="btnCActivo" class="botonAmarillo btnPruebas">Probar</button>
			<p>Con éste usuario y contraseña se podrá acceder a la cuenta del cliente para consultar sus movimientos.</p>
		</div>
		<div class="col">
			<p>Acceder <strong>cliente no activo</strong></p>
			<button type="button" id="btnCInactivo" class="botonAmarillo btnPruebas">Probar</button>
			<p>Con éste usuario y contraseña no se podrá acceder ya que el usuario no está activo. Mostrará el mensaje <strong>"El usuario está desactivado"</strong> que envía el servidor.</p>
		</div>
	</div>

</section>

<?php include 'footer.php';?>