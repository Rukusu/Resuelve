jQuery(function($){
	$("#btnEnviar").click(function(){
		var user = $("#in-correo").val();
		var password = CryptoJS.MD5($("#in-pass").val()).toString();
		var promesaLogin = login(user,password);

		promesaLogin.then(function (responseLogin){
				    		
			sessionStorage.setItem("token",responseLogin.headers.authorization);

			//Redireccionamos a la vista
			window.location.replace("admin.php");

	   	}).catch(function(error) {
			console.log(error.response);
			$("p.errorLogin").text(error.response.data);		
		})
	});
});

function login(user, password){
	//Obtenemos la API de la sesión
	var api = sessionStorage.getItem("api");
	//Se hace la peticion a la API para login
	//Devolvemos el objeto de la promesa
	return axios.post(api+'/users/adminLogin', {
		user: user,
		password: password
	});
}