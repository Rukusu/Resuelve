<?php
include 'header.php';
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Index para las páginas
*/
?>



<section class="container-fluid tablaContenido">
	<div class="row">
		<div class="col-12">
			<p class="titulo">Listado de Clientes</p>
			<div class="table-responsive-lg tablaInformacion">
				<table class="table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Segundo nombre</th>
							<th>Apellido</th>
							<th>Segundo apellido</th>
							<th>Correo</th>
							<th>Estatus</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="paginaContenido">

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<ul id="listaPaginacion" class="pagination-sm justify-content-center"></ul>
		</div>
	</div>

	
</section>
	<hr>
<section class="container-fluid tablaContenido">

	<div class="table-responsive tablaInformacion">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<p class="titulo">Listado de Movimientos</p>
				<p class="cuenta">Cuenta:</p>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<button type="button" class="botonAmarillo botonDivisa active" id="botonCambiaPeso" disabled="">Cantidad en Pesos</button>
				<button type="button" class="botonAmarillo botonDivisa" id="botonCambiaDolar" disabled="">Cantidad en Dolares</button>
			</div>
		</div>
		
		<table id="movimientos" class="table">
			<thead>
				<tr>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th>Cantidad</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody id="paginaContenidoMovimientos">
				
			</tbody>
		</table>
	</div>
	<div class="row">
		<div id="paginadorMovimientos" class="col-12">
			<ul id="listaPaginacionMovimientos" class="pagination-sm justify-content-center"></ul>
		</div>
	</div>
	
	
</section>

<?php include 'footer.php';?>