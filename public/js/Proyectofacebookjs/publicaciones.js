comprobar =""

function ocultardiv(){
	console.log(comprobar)
	document.getElementById('texto_publicacion').style.visibility = "hidden"
	document.getElementById('boton_publicar').style.visibility = "visible"

}
function compartir_p(){
	publicacion = document.getElementById("input_publicacion").value
	id = sessionStorage.getItem("Id")
	nombre = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	if (publicacion.trim() == "" || publicacion.trim() == " " || publicacion.length ==0) {
		publicacion = "NA"
		alert("No haz ingresado datos!")
	}
	var xmlhttp = new XMLHttpRequest()
	if (publicacion.trim() !="" || publicacion.trim() !=" " || publicacion!=0) {
		xmlhttp.open("POST",config['url']+"Facebook_publicaciones/publicar",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
		xmlhttp.send("publicacion="+publicacion+"&id="+id+"&nombre="+nombre)
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				window.location.assign(config['url']+"Facebook_interfaz/Facebook_vista")
			}
		}
	}
}
function contar_likes(){
	int = sessionStorage.getItem("publicaciones")
	id = sessionStorage.getItem("Id")
	persona = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Facebook_publicaciones/cantidad_likes",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("id="+id+"&persona="+persona)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			res = JSON.parse(xmlhttp.responseText)
/*			console.log(res[0].idpublicacion)
			console.log(res)*/
			contador = res.length
			t=0
			for (var i = 0; i <res.length; i++) {
				temp =0
				id_buscar = res[i].idpublicacion+"dar_like"

				id_no = res[i].idpublicacion+"no_like"
				id_like = res[i].idpublicacion+"like"
				texto = res[i].idpublicacion+"texto"
				for (var x =0; x < contador; x++) {
					
					f =x+1
					id_buscar = res[x].idpublicacion+"dar_like"
					id_no = res[x].idpublicacion+"no_like"
					id_like = res[x].idpublicacion+"like"

					texto = res[x].idpublicacion+"texto"
					if (res[f] == undefined) {
						break
					}
					if (res[i].idpublicacion == res[x].idpublicacion) {
						temp ++

					}

					f++
				}
				document.getElementById(res[i].idpublicacion+"texto").innerHTML =temp
				document.getElementById(res[i].idpublicacion+"dar_like").style.color = "#3784FF";
				document.getElementById(res[i].idpublicacion+"no_like").style.visibility = "hidden"
				document.getElementById(res[i].idpublicacion+"like").style.visibility ="visible"

				temp =0
			}
		}
	}
	
}

function cargar_publicaciones(){
	xmlhttp = new XMLHttpRequest()
	nombre = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	id = sessionStorage.getItem("Id")
	console.log(id)
	xmlhttp.open("POST",config['url']+"Facebook_publicaciones/publicaciones_amigos",true)
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	xmlhttp.send("nombre="+nombre+"&id="+id)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			respuesta =  xmlhttp.responseText
			var obj = JSON.parse(respuesta)
/*			console.log(obj)*/
			error = '"'+'No se encontro ningun registro'+'"'

			if (respuesta.trim() == error || respuesta == "No se encontro ningun registro") {
				var publicacion_interfaz = "<div id='publicacion_dinamica' >"+
												 "No tienes Ninguna publicacion :("+
											    "</div>"
					document.getElementById("Publicaciones").innerHTML += publicacion_interfaz
			}
			else{
				for (var i =0;i<obj.length; i++) {
					concatenar = '"'+obj[i].nombre +'"'+","+'"'+obj[i].Descripcion+'"'
					id = obj[i].id
					var publicacion_interfaz = "<div id='publicacion_dinamica' >"+
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
					document.getElementById("Publicaciones").innerHTML += publicacion_interfaz
				}
				contar_likes()
				cargar_conectados()
			}
		}
	}
}
function dar_likes(nombre,publicacion,id){
	/*el nombre es de la persona que publico algo*/
	persona = sessionStorage.getItem("Usuario")+' '+sessionStorage.getItem("Apellido")
	id = sessionStorage.getItem("Id")
	var xmlhttp = new XMLHttpRequest()
	xmlhttp.open("POST",config['url']+"Facebook_publicaciones/insertar_like",true)
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	xmlhttp.send("id="+id+"&persona="+persona+"&nombre="+nombre+"&publicacion="+publicacion)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			contar_likes()
			res = JSON.parse(xmlhttp.responseText)
			id = res.id_publicacion +"texto"
			id2 = res.id_publicacion+"dar_like"
			id3 = res.id_publicacion+"no_like"
			id4 = res.id_publicacion+"like"
			document.getElementById(id).innerHTML = res.cantidad
			document.getElementById(id2).style.color = "#3784FF";
			document.getElementById(id3).style.visibility = "hidden"
			document.getElementById(id4).style.visibility ="visible"
		}
	}

}
function salir_session(){
	id = sessionStorage.getItem("Id")
	xmlhttp = new XMLHttpRequest()
	xmlhttp.open("POST",config['url']+"Facebook_publicaciones/cerrar",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("id="+id)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			window.location.assign(config['url']+"Login_facebook/login")
		}
	}
}
function cargar_conectados(){
	usuario = sessionStorage.getItem("Usuario")+" "+sessionStorage.getItem("Apellido")
	id = sessionStorage.getItem("Id")
	xmlhttp = new XMLHttpRequest()
	xmlhttp.open("POST",config['url']+"Facebook_publicaciones/contactos",true)
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")
	xmlhttp.send("id="+id+"&usuario="+usuario)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			conectado= JSON.parse(xmlhttp.responseText)
			console.log(conectado)
			if (conectado == 'No se encontro ningun registro') {
				document.getElementById("conectados").style.visibility ="hidden"
			}
			else{
				for (var i = 0; i < conectado.length; i++) {
					var contenedor_conectados = "<div class='todo'>"+
													"<div class='div_foto'>"+
														"<img class='foto_c' src='"+
															conectado[i].Foto+
														"'>"+
													"</div>"+
													"<div class='texto_c'>"+
														"<p>"+conectado[i].nombre+
														"</p>"+
													"</div>"+
													"<div class ='circulo_c' id='"+conectado[i].nombre+
													i+"'"+"</div>"+
												"</div>"
					document.getElementById("conectados").innerHTML +=contenedor_conectados
					if (conectado[i].Conectado == 0) {
						document.getElementById(conectado[i].nombre+i).style.backgroundColor = "gray"
					}
				}

			}
		}
	}
}
