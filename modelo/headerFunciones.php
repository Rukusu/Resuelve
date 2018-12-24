<?php
/**
* 	@author Amilkhael Chávez Delgado;
*	Documento: Funciones para el header
*/

//Imprime el script necesario para cada seccion
function imprimeScripts()
{
	$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    $cf = explode ("\..", $current_file_name); 
	switch ($cf[0])
    {
        case 'index':
            echo '<script  src="js/login.js"></script>';
            break;
        case 'admin':
            echo '<script  src="js/admin.js"></script>';
            break;
        default:
            echo '<script  src="js/login.js"></script>';
            break;
        }
}

//Imprime Titulo
function imprimeTitulo()
{
	$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    $cf = explode ("\..", $current_file_name); 

    switch ($cf[0]) 
    {
    	case 'index':
    		echo "<title>Resuelve</title>";
    		break;
    	case 'admin':
    		echo "<title>Administrador | Resuelve</title>";
    		break;
        case 'cliente':
            echo "<title>Cliente | Resuelve</title>";
            break;
    	default:
    		echo "<title>Resuelve</title>";
    		break;
    }
}

