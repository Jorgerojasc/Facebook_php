mostrar = true
mensaje = '"'+'No se encontro ningun registro'+'"'
function muro(){
	sessionStorage.setItem("Vista",1);
	window.location.assign(config['url']+"Facebook_interfaz/Muro_vista");

}
function inicio(){
	sessionStorage.setItem("Vista",0);
	window.location.assign(config['url']+"Facebook_interfaz/Facebook_vista")

}
function visitar_muro(nombre){
	sessionStorage.setItem("Amigo",nombre)
	window.location.assign(config['url']+"Facebook_interfaz/Muro_vista");
	sessionStorage.setItem("Vista",2);
	
}
function datos_usuarios(){
	vista = sessionStorage.getItem("Vista")
	if (vista == 2) {
		imagen = "portada"
		document.getElementById('Nombre_persona').innerHTML = sessionStorage.getItem("Amigo")
		document.getElementById('agregar').style.visibility = "visible";
		document.getElementById('opcion_foto_portada').style.visibility = "hidden";
		persona = sessionStorage.getItem("Amigo");
		/*Poner aqui las fotos publicadas por el amigo a agregar y la cantidad de amigos que tiene etc...*/
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Facebook_interfaz/imagen_portada_muro",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("persona="+persona+"&imagen="+imagen);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
				var respuesta = xmlhttp.responseText;
				console.log(respuesta)
				var obj = JSON.parse(respuesta)
				console.log(obj.perfil)
				if (obj.portada !="None") {
					document.getElementById("Foto_de_perfil").innerHTML = "<img src='"+obj.perfil+"'>"
					document.getElementById("foto_de_portada").style.backgroundImage = "url("+"'"+obj.portada+"'"+")"
				}
				if(obj.portada == "None"){
					document.getElementById("Foto_de_perfil").innerHTML = "<img src='"+obj.perfil+"'>"
				}
				
			}
		}

	}
	else{
		imagen = "portada"
		document.getElementById('Nombre_persona').innerHTML = sessionStorage.getItem("Usuario") +" "+ sessionStorage.getItem("Apellido");
		document.getElementById('agregar').style.visibility = "hidden";
		document.getElementById('opcion_foto_portada').style.visibility = "visible";
		persona = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido");
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST",config['url']+"Facebook_interfaz/imagen_portada_muro",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("persona="+persona+"&imagen="+imagen);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			
				var respuesta = xmlhttp.responseText;
				console.log(respuesta)
				var obj = JSON.parse(respuesta)
				console.log(obj.perfil)
				if (obj.portada !="None") {
					document.getElementById("Foto_de_perfil").innerHTML = "<img src='"+obj.perfil+"'>"
					document.getElementById("foto_de_portada").style.backgroundImage = "url("+"'"+obj.portada+"'"+")"
				}
				if(obj.portada == "None"){
					document.getElementById("Foto_de_perfil").innerHTML = "<img src='"+obj.perfil+"'>"
				}
				
			}
		}

	}
}
function enviar_solicitud(){
	sessionStorage.setItem("Solicitud","Enviada");
	emisor = sessionStorage.getItem("Id");
	receptor = sessionStorage.getItem("Amigo");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Facebook_interfaz/solicitud",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("emisor="+emisor+"&receptor="+receptor);
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
			/*Poner estos estilos en un onload, en una funcion aparte, hasta que estatus sea diferente de aceptada, si es aceptada poner amigo*/
			document.getElementById("texto_agregar").innerHTML = "solicitud de amistad enviada";
			document.getElementById("agregar").style.width = "228px";
			document.getElementById("texto_agregar").style.width = "200px";
		}
	}
	
}
function cargar_estatus_solicitud(){
	var xmlhttp = new XMLHttpRequest();
	vista = sessionStorage.getItem("Vista")
	amigo = sessionStorage.getItem("Amigo");
	id = sessionStorage.getItem("Id");
	xmlhttp.open("POST", config['url']+"Facebook_interfaz/buscar_solicitud",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("amigo="+amigo+"&id="+id);
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			respuesta = xmlhttp.responseText;
			
			if(respuesta == 1){
				document.getElementById("texto_agregar").innerHTML = "Amigos";
				document.getElementById("imagen_agregar").innerHTML = "<img id='aceptado' src='"+config['img']+"flecha.svg"+"'>";
				document.getElementById("agregar").style.width = "100px";
				document.getElementById("texto_agregar").style.width = "100px";
			}
			if(respuesta == 0){
				document.getElementById("texto_agregar").innerHTML = "solicitud de amistad enviada";
				document.getElementById("agregar").style.width = "228px";
				document.getElementById("texto_agregar").style.width = "200px";	
			}
			
		}
	} 
}
function mostrar_solicitud(){
	if(mostrar == true){
		var xmlhttp = new XMLHttpRequest()
		usuario = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
		xmlhttp.open("POST",config['url']+"Facebook_interfaz/notificar_solicitud",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
		xmlhttp.send("usuario="+usuario);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				notificaciones = JSON.parse(xmlhttp.responseText)
				console.log(notificaciones)
				console.log(notificaciones)
				texto_a = '"'+"Aceptar"+'"'
				texto_e = '"'+"Eliminar"+'"'
				document.getElementById("notificaciones_solicitud").style.visibility = "visible"
				for (var i =0; i<notificaciones.length; i++) {
					var persona = '"'+notificaciones[i].nombre+'"';
					var personas = "<div class='notificacion_s'>"+
										"<img id='imagen_s' src='"+notificaciones[i].Foto+"'>"
										+"<div id='nombre_s'>"+notificaciones[i].nombre+"</div>"+
										 "<div class='aceptar_s' onclick='opcion("+persona+","+texto_a+")' id='"+notificaciones[i].nombre+"'>"+
											"<div id='texto_s'>"+"Confirmar"+"</div>"
										+"</div>"
										+"<div class='rechazar_s' onclick='opcion("+persona+","+texto_e+")' id='"+notificaciones[i].nombre+"1"+"'>"+
											"<div id='texto_s_r'>"+"Eliminar"+"</div>"
										+"</div>"
									+"</div>"
					document.getElementById("notificaciones_solicitud").innerHTML += personas

				}
				if (notificaciones.length == undefined) {
					var persona = '"'+notificaciones.nombre+'"';
					var personas = "<div class='notificacion_s'>"+
										"<img id='imagen_s' src='"+notificaciones.Foto+"'>"
										+"<div id='nombre_s'>"+notificaciones.nombre+"</div>"+
										 "<div class='aceptar_s' onclick='opcion("+persona+","+texto_a+")' id='"+notificaciones.nombre+"'>"+
											"<div id='texto_s'>"+"Confirmar"+"</div>"
										+"</div>"
										+"<div class='rechazar_s' onclick='opcion("+persona+","+texto_e+")' id='"+notificaciones.nombre+"1"+"'>"+
											"<div id='texto_s_r'>"+"Eliminar"+"</div>"
										+"</div>"
									+"</div>"
					document.getElementById("notificaciones_solicitud").innerHTML += personas

				}
				if(notificaciones == "No se encontro ningun registro" || notificaciones == mensaje){
					document.getElementById("notificaciones_solicitud").innerHTML = "No tienes solicitudes de Amistad :("
				}
				mostrar=false
			}
		}
	}
	if(mostrar == false){
		document.getElementById("notificaciones_solicitud").innerHTML = "";
		document.getElementById("notificaciones_solicitud").style.visibility = "hidden"
		mostrar = true

	}

} 
/*-------------------------------------29/05/2019-----------------------*/
function opcion(nombre,status,muro){
	emisor = nombre;
	receptor = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido"); 
	var xmlhttp = new XMLHttpRequest()
	if (status == "Aceptar") {
		xmlhttp.open("POST", config['url']+"Facebook_interfaz/estatus_solicitud", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
		xmlhttp.send("emisor="+emisor+"&receptor="+receptor+"&status="+status)
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var estatus = xmlhttp.responseText;
				if(muro == "muro" ){
					document.getElementById("agregar_desde_muro").innerHTML = "Amigo";
					document.getElementById("agregar_desde_muroE").style.visibility = "hidden";
				}
				else{
					id_rechazado = document.getElementById(nombre).id + 1;
					document.getElementById(nombre).style.visibility = "hidden"
					document.getElementById(id_rechazado).style.visibility = "hidden"
					document.getElementById(nombre).innerHTML = "<div id='texto_enviado'>"+"Ahora son amigos"+"</div>"
				}
			}
		}
	}
	if(status == "Eliminar"){
		xmlhttp.open("POST", config['url']+"Facebook_interfaz/estatus_solicitud", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
		xmlhttp.send("emisor="+emisor+"&receptor="+receptor+"&status="+status)
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				if (muro == "muro") {
					document.getElementById("agregar_desde_muro").innerHTML = "Ahora no son amigos";
					document.getElementById("agregar_desde_muroE").style.visibility = "hidden";
				}
				var estatus = xmlhttp.responseText;
				document.getElementById(nombre).style.visibility = "hidden"
				document.getElementById(id_rechazado).style.visibility = "hidden"
				document.getElementById(nombre).innerHTML = "<div id='texto_enviado'>"+"Solicitud eliminada"+"</div>"
			}
		}

	}
}
function cargar_amigos(){
	receptor = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	id = sessionStorage.getItem("Id")
	console.log(id)
	vista = sessionStorage.getItem("Vista")
	amigo = sessionStorage.getItem("Amigo")
	var xmlhttp = new XMLHttpRequest()
	xmlhttp.open("POST", config['url']+"Facebook_interfaz/cantidad_amigos",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	if (vista == 1) {
		xmlhttp.send("receptor="+receptor+"&id="+id);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var cantidad = JSON.parse(xmlhttp.responseText);
				total  = parseInt(cantidad.numero) + parseInt(cantidad.numero2)
				document.getElementById("Amigos_numero").innerHTML += "("+total+")"

			}
		}
	}
	if (vista == 2) {
		id = "Na"
		xmlhttp.send("receptor="+amigo+"&id="+id);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var cantidad = JSON.parse(xmlhttp.responseText);
				total  =  parseInt(cantidad.numero2)
				document.getElementById("Amigos_numero").innerHTML += "("+total+")"
			}
		}
	}
}
function cargar_muro_solicitud(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Facebook_interfaz/buscar_solicitudes",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if (vista == 2) {
		texto_a = '"'+"Aceptar"+'"'
		texto_e = '"'+"Eliminar"+'"'
		texto_muro = '"'+"muro"+'"'
		emisor = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
		solicitante = sessionStorage.getItem("Amigo");
		xmlhttp.send("solicitante="+solicitante+"&emisor="+emisor);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				persona = '"'+solicitante+'"'
				var solicitud = JSON.parse(xmlhttp.responseText);
				if (solicitud.estatus == 0) {
					document.getElementById("agregar").style.visibility = "hidden";
					document.getElementById("agregar_desde_muro").style.visibility = "visible"
					document.getElementById("agregar_desde_muroE").style.visibility = "visible"
					var boton_aceptar = "<div class='texto_ba' onclick='opcion("+persona+","+texto_a+","+texto_muro+")'>"+
											"Aceptar"+
										"</div>"
										
					var boton_eliminar = "<div class='texto_ba' onclick='opcion("+persona+","+texto_e+","+texto_muro+")'>"+
											"Eliminar"+
										  "</div>"					 
					document.getElementById("agregar_desde_muro").innerHTML = boton_aceptar
					document.getElementById("agregar_desde_muroE").innerHTML = boton_eliminar
				}
				if (solicitud.estatus == 1) {
					document.getElementById("texto_agregar").innerHTML = "Amigos";
					document.getElementById("imagen_agregar").innerHTML = "<img id='aceptado' src='"+config['img']+"flecha.svg"+"'>";
					document.getElementById("agregar").style.width = "90px";
					document.getElementById("texto_agregar").style.width = "90px";
				}
			}
		}
	}
}
function div_agregar(){
	document.getElementById("agregar_img_p").style.visibility = "visible"
}
function div_ocultar(){
	document.getElementById("agregar_img_p").style.visibility = "hidden"
}
var respuesta_portada =""
function enviar_img(){
	document.getElementById("texto_portada").innerHTML = "Cambiar"
	document.getElementById("boton_cambiar").style.visibility = "visible"
	var xmlhttp = new XMLHttpRequest()
	usuario = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	xmlhttp.open("POST",config['url']+"Facebook_interfaz/comprobar_portada",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("usuario="+usuario)
	input = document.getElementById("boton_enviar")
	/*name = input.name*/
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			respuesta_portada = xmlhttp.responseText
			console.log(respuesta_portada.trim())
			
		}
	}


}
function env_datos(){
	var xmlhttp = new XMLHttpRequest()
	input = document.getElementById("boton_enviar")
	/*name = input.name*/
	arch = input.files[0].name
	console.log(config['img']+arch)
	id = sessionStorage.getItem("Id");
	mensaje = '"'+'No se encontro ningun registro'+'"'

	if(respuesta_portada.trim() ==  'No se encontro ningun registro' || respuesta_portada.trim()==mensaje.trim()){
		update = "No"
		xmlhttp.open("POST",config['url']+"Facebook_interfaz/env_img",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id+"&update="+update+"&arch="+arch);
		document.getElementById("form").submit()
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				window.location.assign(config['url']+"Facebook_interfaz/Muro_vista");

			}
		}
	}
	if(respuesta_portada.trim()!="No se encontro ningun registro"){
		update = "Si"
		xmlhttp.open("POST",config['url']+"Facebook_interfaz/env_img",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id+"&update="+update+"&arch="+arch);
		document.getElementById("form").submit()
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				window.location.assign(config['url']+"Facebook_interfaz/Muro_vista");

			}
		}

	}
}

function cargar_contenedor_publicaciones(){
	var xmlhttp = new XMLHttpRequest();
	usuario = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	id = sessionStorage.getItem("Id");
	xmlhttp.open("POST", config['url']+"Facebook_publicaciones/imagen_usuario",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("usuario="+usuario+"&id="+id)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			res = JSON.parse(xmlhttp.responseText)
			console.log(res.Foto)
			document.getElementById("crear_publicacion").innerHTML += "<div id='prin'>"+
								"<img id='foto_user' src='"+res.Foto+"'>"+
								"<p id='texto_publicacion'>"+"¿Que estas pensando "+sessionStorage.getItem("Usuario")+
								"?</p>"+"</div>";

		}
	}

}
function datos_portada(){
	document.getElementById("boton_cambiar_perfil").style.visibility = "visible"

}
function enviar_img_perfil(){
	var xmlhttp = new XMLHttpRequest()
	input = document.getElementById("boton_perfil")
	arch = input.files[0].name
	console.log(config['img']+arch)
	id = sessionStorage.getItem("Id");
	xmlhttp.open("POST", config['url']+"Facebook_interfaz/enviar_perfil",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("arch="+arch+"&id="+id)
	document.getElementById("form_perfil").submit()
	window.location.assign(config['url']+"Facebook_interfaz/Muro_vista")
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 400) {
			window.location.assign(config['url']+"Facebook_interfaz/Muro_vista");
		}
	}

}
function cargar_publicacion_mi_muro(){
	vista = sessionStorage.getItem("Vista")
	if (vista == 1) 
	{
		xmlhttp = new XMLHttpRequest()
		nombre = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
		id = sessionStorage.getItem("Id")
		vita ="1"
		console.log(id+"entro al if")
		xmlhttp.open("POST",config['url']+"Facebook_publicaciones/publicaciones_mias",true)
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		xmlhttp.send("id="+id+"&nombre="+nombre+"&vista="+vista)
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				respuesta =  xmlhttp.responseText
				var obj = JSON.parse(respuesta)
				error = '"'+'No se encontro ningun registro'+'"'

				if (respuesta.trim() == error || respuesta == "No se encontro ningun registro") {
					var publicacion_interfaz = "<div id='publicacion_dinamica' >"+
													 "No tienes Ninguna publicacion :("+
												    "</div>"
						document.getElementById("Publicacion").innerHTML += publicacion_interfaz
				}
				else{
					for (var i =0;i<obj.length; i++) {
						concatenar = '"'+obj[i].nombre +'"'+","+'"'+obj[i].Descripcion+'"'
						id = obj[i].id
						var publicacion_interfaz = "<div id='publicacion_dinamica1' >"+
								 	"<div class='bloque'>"+"Focus Div!"+"</div>"+
								 	"<div class='nombre_dinamico'>"+obj[i].nombre+"</div>"+

								 	"<p class ='fecha_dinamica' >"+
								 		obj[i].fecha+
								 	"</p>"+							
								 	"<div class='imagen_dinamica'>"+"<img class='img_dinamica' src='"+obj[i].Foto+"'>"+"</div>"
								 	+"<div class='bloque2'>"+"Focus Div!"+"</div>"
								 	+"<div class='descripcion_dinamica'>"+obj[i].Descripcion+"</div>"+
								 	"<div class='Likes' id='g'>"+
								 		"<div class='principal_l' id='"+id+"'"+"onclick ='dar_likes("+concatenar+","+id+")'>"+
								 			"<img class='imagen_l' id='"+id+'no_like'+"'"+" src='"+config['img']+"Like.png"+"'>"+
								 			"<img class='imagen_ll' id='"+id+'like'+"'"+"  src='"+config['img']+"dar_like.svg"+"'>"+
								 			"<p class ='texto_like' id='"+id+'dar_like'+"'"+">Me gusta("+
								 				"<p2 id='"+id+"texto'"+"></p2>"+
								 			")</p>"+
								 		"</div>"+
								 	"</div>"+
							    "</div>"
						document.getElementById("Publicacion").innerHTML += publicacion_interfaz
					}
					contar_likes()
				}
			}
		}

	}
	if (vista == 2) {
		xmlhttp = new XMLHttpRequest()
		nombre = sessionStorage.getItem("Amigo")
		id = sessionStorage.getItem("Id")
		vista ="2"
		console.log(id+"entro al if")
		xmlhttp.open("POST",config['url']+"Facebook_publicaciones/publicaciones_mias",true)
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		xmlhttp.send("id="+id+"&nombre="+nombre+"&vista="+vista)
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				respuesta =  xmlhttp.responseText
				var obj = JSON.parse(respuesta)
				error = '"'+'No se encontro ningun registro'+'"'

				if (respuesta.trim() == error || respuesta == "No se encontro ningun registro") {
					var publicacion_interfaz = "<div id='publicacion_dinamica' >"+
													 "No tienes Ninguna publicacion :("+
												    "</div>"
						document.getElementById("Publicacion").innerHTML += publicacion_interfaz
				}
				else{
					for (var i =0;i<obj.length; i++) {
						concatenar = '"'+obj[i].nombre +'"'+","+'"'+obj[i].Descripcion+'"'
						id = obj[i].id
						var publicacion_interfaz = "<div id='publicacion_dinamica1' >"+
								 	"<div class='bloque'>"+"Focus Div!"+"</div>"+
								 	"<div class='nombre_dinamico'>"+obj[i].nombre+"</div>"+

								 	"<p class ='fecha_dinamica' >"+
								 		obj[i].fecha+
								 	"</p>"+							
								 	"<div class='imagen_dinamica'>"+"<img class='img_dinamica' src='"+obj[i].Foto+"'>"+"</div>"
								 	+"<div class='bloque2'>"+"Focus Div!"+"</div>"
								 	+"<div class='descripcion_dinamica'>"+obj[i].Descripcion+"</div>"+
								 	"<div class='Likes' id='g'>"+
								 		"<div class='principal_l' id='"+id+"'"+"onclick ='dar_likes("+concatenar+","+id+")'>"+
								 			"<img class='imagen_l' id='"+id+'no_like'+"'"+" src='"+config['img']+"Like.png"+"'>"+
								 			"<img class='imagen_ll' id='"+id+'like'+"'"+"  src='"+config['img']+"dar_like.svg"+"'>"+
								 			"<p class ='texto_like' id='"+id+'dar_like'+"'"+">Me gusta("+
								 				"<p2 id='"+id+"texto'"+"></p2>"+
								 			")</p>"+
								 		"</div>"+
								 	"</div>"+
							    "</div>"
						document.getElementById("Publicacion").innerHTML += publicacion_interfaz
					}
					contar_likes()
				}
			}
		}

	}
}
