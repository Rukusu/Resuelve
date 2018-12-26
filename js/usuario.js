var token = "";
var api = "";
var id_usuario="";
var usd2mxn=0;
var mxn2usd=0;
var isPesosActive = true;
var isDollarActive = false;
var paginaActualMovimietos = 1;


//Revisamos que exista el token
if (sessionStorage.getItem('token') == null){
	//Si no hay token lo regresamos al index
	window.location.replace("index.php");
}
else
{
	//Obtenemos el token del login
	token = sessionStorage.getItem("token");
	//Obtenemos la API de la sesión
	api = sessionStorage.getItem("api");

	//Solicitamos los valores actuales de las divisas
	axios.get(api+'/money/conversion')
	.then(function(response) {
	  usd2mxn = response.data.usd2mxn;
	  mxn2usd = response.data.mxn2usd
	})
	.catch(function(error) {
	  console.log(error)
	})
}

//Funcion para cerrar la sesion
jQuery(function($){
	$("#botonCerrarSesion").click(function() {
		//Borramos todo lo que hay en la sesion
		sessionStorage.clear();
		//Reditreccionamos al login
		window.location.replace("index.php");
	});
});

