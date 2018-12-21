<?php
include 'header.php';
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Index para las páginas
*/
?>

<secttion class="container-fluid">
	<p class="titulo">Listado de Clientes</p>
	<div class="table-responsive-lg">
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
	<ul id="listaPaginacion" class="pagination-sm"></ul>
	<hr>
	<div class="table-responsive">
		<p class="titulo">Listado de Moviminientos</p>
		<p class="cuenta">Cuenta:</p>
		<table class="table">
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
	<div id="paginadorMovimientos">
		<ul id="listaPaginacionMovimientos" class="pagination-sm"></ul>
	</div>
	
	
</secttion>

<?php include 'footer.php';?>