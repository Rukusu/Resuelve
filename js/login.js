jQuery(function($){
	$("#btnEnviar").click(function(){
		var user = $("#in-correo").val();
		var password = CryptoJS.MD5($("#in-pass").val()).toString();

		login(user,password);
	});
});
jQuery(function($){
	//Ocultamos la topbar en la página de login
	$("header").hide();
});

function login(user, password){

	//Obtenemos la API de la sesión
	var api = sessionStorage.getItem("api");
	var endPoint="";
	var promesaLogin="";

	//Si es un correo de cliente
	if(isValidEmailAddress(user))
	{
		//Establememos el endpoint para clientes
		endPoint="/users/login";
		//Se hace la peticion a la API para login de cliente
		promesaLogin = axios.post(api+endPoint, {
			email: user,
			password: password
		});
	}//Es el administrador
	else
	{
		//Establememos el endpoint para el administrador
		endPoint="/users/adminLogin";
		//Se hace la peticion a la API para login de administrador
		promesaLogin = axios.post(api+endPoint, {
			user: user,
			password: password
		})
	}
	
	//Obtenemos la respuesta después del login
	promesaLogin.then(function (responseLogin){
		
		//Almacenamos el token en la sesión		    		
		sessionStorage.setItem("token",responseLogin.headers.authorization);

		//Si es un correo de cliente
		if(isValidEmailAddress(user))
		{
			//Redireccionamos a la vista del cliente
			window.location.replace("cliente.php");
		}//Es el administrador
		else
		{
			//Redireccionamos a la vista del administrador
			window.location.replace("admin.php");
		}

	})
	.catch(function(error) {
		console.log(error.response);
		//Mostramos en la bista el mensaje de error
		$("p.errorLogin").text(error.response.data);		
	})
}

//Funcion para validar el correo
function isValidEmailAddress(email) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(email);
};

/*Función para hacer pruebas*/
jQuery(function($){
	$(".btnPruebas").click(function(){
		
		//Obtenemos el id de la prueba
		switch($(this).attr("id"))
		{
			case "btnAdmin":
			    $("#in-correo").val("admin");
			    $("#in-pass").val("pruebaresuelve123")
			    break;
			case "btnCActivo":
			    $("#in-correo").val("Gregory.Keebler@yahoo.com");
			    $("#in-pass").val("pruebaresuelve123")
			    break;
			case "btnCInactivo":
			    $("#in-correo").val("Ross78@yahoo.com");
			    $("#in-pass").val("pruebaresuelve123");
		    	break;
			default:
		    	$("#in-correo").val("");
			    $("#in-pass").val("");
		}


		
	});
});