mensaje = '"'+'No se encontro ningun registro'+'"'
function hacer_registro(){
	
	nombre = document.getElementById('nombre_id').value;
	apellido = document.getElementById('apellido_id').value;
	correo = document.getElementById('correo_id').value;
	password = document.getElementById('password_id').value;
	dia = document.getElementById('dia_id').value;
	mes = document.getElementById('mes_id').value;
	anio = document.getElementById('anio_id').value;
	sessionStorage.setItem("Usuario",nombre);
	var sexo = document.getElementsByName('sexo');
	fecha_completa = dia+"/"+mes+"/"+anio
	fecha = parseInt(anio);
	conectado = 1;
	var resultado="Selecciona uno";
	//recorro el areglo que manda sexo y con la propiedad checked obtengo el estado marcado de una casilla de verificación  
    for(var i=0;i<sexo.length;i++)
    {
        if(sexo[i].checked)
        {
            resultado=sexo[i].value;
        }
    }
    var  resultado_sexo = resultado;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST",config['url']+"Login_facebook/registro",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('nombre='+nombre+'&apellido='+apellido+'&correo='+correo+'&password='+password+'&fecha='+
    	fecha+"&sexo="+resultado_sexo+"&conectado="+conectado);
    xmlhttp.onreadystatechange = function()
    {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    	{
    		res = JSON.parse(xmlhttp.responseText)
    		msm = '"'+"No"+'"'
    		if (res.trim() == "No" || res == msm) {
    			alert("El correo introducido ya esta en uso!")
    		}
    		else{
	    		sessionStorage.setItem("Sexo",resultado_sexo);
				sessionStorage.setItem("Usuario",nombre);
				sessionStorage.setItem("Apellido",apellido);
				sessionStorage.setItem("Id", res)
	    		alert("Bienvenido "+nombre+" "+apellido);
	    		window.location.assign(config['url']+"Facebook_interfaz/Facebook_vista")
    		}
    	}
    }
}
function hacer_login(){
	correo = document.getElementById("correo_log").value;
	password = document.getElementById("password_log").value;
	console.log(password+"------------------")
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Login_facebook/logearse",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("correo="+correo+"&password="+password);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			resp = xmlhttp.responseText;
			respuesta = JSON.parse(xmlhttp.responseText)
			
			if(respuesta.Correo == correo && respuesta.Password==password){
				sexo_null = "login";
				sessionStorage.setItem("Usuario",respuesta.Nombre);
				sessionStorage.setItem("Apellido",respuesta.Apellido);
				sessionStorage.setItem("Correo",respuesta.Correo);
				sessionStorage.setItem("Sexo",sexo_null);
				sessionStorage.setItem("Id",respuesta.idusuario);
				sessionStorage.setItem("Vista",0);
				alert("Bienvenido: "+respuesta.Nombre);
				window.location.assign(config['url']+"Facebook_interfaz/Facebook_vista")
			}
			else{
				alert("Datos incorrectos");
			}
		}
	}
}

function cargar_lado_izquierdo(){
	imagen_login = sessionStorage.getItem("Sexo");
	vista = sessionStorage.getItem("Vista")
	if(imagen_login == "login" && vista ==0){
		document.getElementById("nombre_usuario").innerHTML = `${sessionStorage.getItem('Usuario')} ${sessionStorage.getItem('Apellido')}`
		//o podemos hacer esto : sessionStorage.getItem("Usuario")+sessionStorage.getItem("Apellido")
		var id= sessionStorage.getItem("Correo");
		id_usuario= sessionStorage.getItem("Id");
		//editar_perfil = "<div class='editar_perfil_izq' id='"+id+"'"+">Editar perfil</div>"
		//document.getElementById("menu_izquierda").innerHTML += editar_perfil;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Login_facebook/foto_perfil_logeado",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send('id_usuario='+id_usuario);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				respuesta = xmlhttp.responseText;
				document.getElementById("imagen_usuario").innerHTML +="<img id='imagen_predeterminada' src='"+respuesta.trim()+"'>";
			}
		}
	}
	if(imagen_login != "login" && vista ==0){
		document.getElementById("nombre_usuario").innerHTML = `${sessionStorage.getItem('Usuario')} ${sessionStorage.getItem('Apellido')}`	
		var id= sessionStorage.getItem("Correo");
		//editar_perfil = "<div class='editar_perfil_izq' id='"+id+"'"+">Editar perfil</div>"
		//document.getElementById("menu_izquierda").innerHTML += editar_perfil;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Login_facebook/foto_perfil_registrado",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				respuesta = xmlhttp.responseText;
				document.getElementById("imagen_usuario").innerHTML +="<img id='imagen_predeterminada' src='"+respuesta+"'>";
			}
		}
	}
}
function cargar_herramientas(){
	imagen_login = sessionStorage.getItem("Sexo");
	if(imagen_login == "login"){
		id_usuario= sessionStorage.getItem("Id");
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Login_facebook/foto_perfil_logeado",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send('id_usuario='+id_usuario);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				respuesta = xmlhttp.responseText;
				document.getElementById("nombre_sesion").innerHTML="<img id='imagen_cabecera' src='"+respuesta+"'>"+"<p>"+
				sessionStorage.getItem('Usuario')+"&nbsp;&nbsp;&nbsp;&nbsp;"+"</p>";
			}
		}
	}
	else{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Login_facebook/foto_perfil_registrado",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				respuesta = xmlhttp.responseText;
				document.getElementById("nombre_sesion").innerHTML="<img id='imagen_cabecera' src='"+respuesta+"'>"+"<p>"+
				sessionStorage.getItem('Usuario')+"&nbsp;&nbsp;&nbsp;&nbsp;"+"</p>";
	
			}
		}
	}
}
function buscar_amigo(){
	nombre_amigo = document.getElementById("buscar").value;
	nombre_buscador = sessionStorage.getItem("Usuario")
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Login_facebook/busqueda",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("nombre_amigo="+nombre_amigo+"&nombre_buscador="+nombre_buscador);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			busqueda = JSON.parse(xmlhttp.responseText);
			if (busqueda == null) 
			{
					document.getElementById("resultado_busqueda").innerHTML = 
								"<div id='amigo'>"+
									"<p class='pi'>Busca amigos.....</p>"+
								"</div>";
			}
			else{
				document.getElementById('resultado_busqueda').innerHTML = ""
				for (var i=0;i<busqueda.length; i++) 
				{
					var person = '"'+busqueda[i].nombre+'"';
					var amigos = "<div class='amigo' onclick='visitar_muro("+person+")"+"'"+"id='"+busqueda[i].nombre+"'>"+
									"<img class='foto_busqueda' src='"+busqueda[i].foto+"'>"+
									"<p class='pi' id='"+busqueda[i].nombre+"'>"+busqueda[i].nombre+"</p>"+
								"</div>";
					document.getElementById("resultado_busqueda").innerHTML += amigos;
				}
				if (busqueda.length == undefined) {
					var person = '"'+busqueda.nombre+'"';
					document.getElementById("resultado_busqueda").innerHTML =
								"<div class='amigo'onclick='visitar_muro("+person+")"+"'"+"id='"+busqueda.nombre+"'>"+
										"<img class='foto_busqueda' src='"+busqueda.foto+"'>"+
										"<p class='pi'>"+busqueda.nombre+"</p>"+
								"</div>"; 
				}

				if(busqueda == "No se encontro ningun registro" || busqueda.trim()==mensaje){
					document.getElementById("resultado_busqueda").innerHTML =
								"<div id='amigo'>"+
										"<p id='pi'>No se encontraron resultados :(</p>"+
								"</div>";
				}
				
			}
		}
	}
}
function menu_atras(){
	if (sessionStorage.getItem("Vista")==0) {
		document.getElementById("menu_izquierda").style.zIndex = "-99999999"
		document.getElementById("ocultar_respuestas").style.visibility = "visible";
		document.getElementById("resultado_busqueda").style.visibility ="visible"
	}
	else{
		document.getElementById("foto_de_portada").style.zIndex = "-99999999"
		document.getElementById("ocultar_respuestas").style.visibility = "visible";
		document.getElementById("resultado_busqueda").style.visibility ="visible"
	}

}
function ocultar_buscador(){
	if (sessionStorage.getItem("Vista")==0) {
		document.getElementById("resultado_busqueda").style.visibility = "hidden";
		document.getElementById("ocultar_respuestas").style.visibility = "hidden"
		document.getElementById("menu_izquierda").style.zIndex = "99999999999"
	}
	else{
		document.getElementById("resultado_busqueda").style.visibility = "hidden";
		document.getElementById("ocultar_respuestas").style.visibility = "hidden";

	}
}