<?php
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Header para las páginas
*/
include 'modelo/headerFunciones.php';
ob_start("ob_gzhandler");
?>
<!DOCTYPE html>
<html lang="es-419">
	<head>
		<!--metas-->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Amilkhael">
		<meta name="description" content="">
		<!-- Metadatos Facebook-->
		<meta property="og:url" content="" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />

		<!-- Metadatos Twitter-->
	    <meta name="twitter:card" content="summary_large_image">
	    <meta name="twitter:site" content="">
	    <meta name="twitter:creator" content="">
	    <meta name="twitter:title" content="">
	    <meta name="twitter:description" content="">
	    <meta name="twitter:image" content="">


		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

		<!-- Titulo -->
		<?php imprimeTitulo();?>

		<!--css-->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">



		<!--fonts-->
		<!--js-->
		
		<!-- favicon -->
		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="images/favicon//apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/favicon//apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/favicon//apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/favicon//apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/favicon//apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="images/favicon//apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="images/favicon//apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="images/favicon//apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon//android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/favicon//favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="images/favicon//favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicon//favicon-16x16.png">
		<link rel="manifest" href="images/favicon//manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="images/favicon//ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<link rel="alternate" href="" hreflang="es-mx" />

	</head>
<body>
	<header class="container-fluid">
		<div class="row backgroundAzul justify-content-end topBar align-items-center">
			<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 text-right">
				<p class="nombreUsuario"></p>
			</div>
			<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right">
				<button type="button" class="botonAmarillo" id="botonCerrarSesion">Cerrar Sesión</button>
			</div>
		</div>
	</header>