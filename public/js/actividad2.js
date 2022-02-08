function Alumnos(elegir){
	var xmlhttp = new XMLHttpRequest();
	if(elegir == "enviar_a")
	{
		nombre = document.getElementById("nombre_ta").value;
		expediente = document.getElementById("expediente_ta").value;
		edad = document.getElementById("edad_ta").value;
		semestre = document.getElementById("semestre_ta").value;
		idcarrera = document.getElementById("idcarrera_ta").value;
		convertir = parseInt(idcarrera);
		idplan = document.getElementById("idplan_ta").value;
		convertir_plan = parseInt(idplan);
		convertir_expediente = parseInt(expediente);
		var x = convertir+convertir_plan;
		xmlhttp.open("POST",config['url']+"Controlador/talumnos", true); 
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send('nombre='+nombre+'&expediente='+expediente+'&edad='+edad+'&semestre='+semestre+
			'&idcarrera='+convertir+'&idplan='+convertir_plan);
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	        {
	        	
	            document.getElementById("Tabla_A").innerHTML = "Se enviaron correctamente";
	            resp = xmlhttp.responseText;
	            console.log(resp);

	    	}
		}

	}
	if(elegir == "mostrar_tablaA"){
		xmlhttp.open("POST",config['url']+"Controlador/mostrar_tablaA");
		xmlhttp.setRequestHeader("Content-type", "aplication/x-www-form-urlencoded");
		xmlhttp.send('');
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				tabla = JSON.parse(xmlhttp.responseText);
				console.log(tabla)
				var r = "<table id='cont'>"+
								"<tr>"+
									"<th>nombre</th>"+
									"<th>expediente</th>"+
									"<th>edad</th>"+
									"<th>semestre</th>"+
									"<th>plan</th>"+
									"<th>carrera</th>"+
								"</tr>"+
								"<tr></tr>"+
								"</table>";
				document.getElementById("tablas").innerHTML = r;
				for (var i =0 ; i<tabla.length; i++) {
					var t = "<tr>"+
								"<td>"+tabla[i].nombre+"</td>"+
							
								`<td>${tabla[i].expediente}</td>`+
							
								"<td>"+tabla[i].edad+"</td>"+
							
								"<td>"+tabla[i].semestre+"</td>"+
							
								"<td>"+tabla[i].plan+"</td>"+
							
								"<td>"+tabla[i].carrera+"</td>"+
							"</tr>";
					document.getElementById("cont").innerHTML +=t;
				}
			}
		}

	}
	if(elegir == "enviar_c"){
			carrera = document.getElementById("carrera_tc").value;
			xmlhttp.open("POST",config['url']+"Controlador/tCarreras",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send('carrera='+carrera);
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("Tabla_C").innerHTML = "Se enviaron correctamente";
				}
			}

	}
	if(elegir == "mostrar_tablaC")
	{
			xmlhttp.open("POST",config['url']+"Controlador/mostrar_tablaC",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send();
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					var c = "<table id='tabla_carrera'>"+
									"<tr>"
										+"<th>idcarrera</th>"+
										"<th>Carrera</th>"+
									"<tr>"
								+"</table>";
					tablas = JSON.parse(xmlhttp.responseText);
					document.getElementById("tablas").innerHTML = c;
					for (var i =0; i<tablas.length ; i++) {

						var tabla_c = "<tr>"+
											"<td>"+tablas[i].idcarrera+"</td>"+
											"<td>"+tablas[i].carrera+"</td>"+
										"</tr>";
						document.getElementById("tabla_carrera").innerHTML += tabla_c;
					}
				}
			}
	}

	if(elegir == "enviar_p")
	{
		plan = document.getElementById("plan_tp").value;
		xmlhttp.open("POST",config['url']+"Controlador/tPlanes",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send('plan='+plan);
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("Tabla_P").innerHTML = "Se enviaron correctamente";

			}
		}
	}
	if(elegir == "mostrar_tablaP"){
		xmlhttp.open("POST",config['url']+"Controlador/mostrar_tablaP",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send();
		xmlhttp.onreadystatechange  = function(){
			console.log(xmlhttp.readyState);
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

				tablas = JSON.parse(xmlhttp.responseText);
				var p = "<table id='tabla_plan'>"+
							"<tr>"+
								"<th>iplan</th>"+
								"<th>plan</th>"+
							"</tr>"
						"</table>";
				document.getElementById("tablas").innerHTML = p;
				for (var i = 0; i <tablas.length; i++) {
					var tabla_p = "<tr>"+//el.idplan significa que accedera a ese atributo
									"<td>"+tablas[i].idplan+"</td>"+
									"<td>"+tablas[i].plan+"</td>"+
								"</tr>";
					document.getElementById("tabla_plan").innerHTML +=tabla_p; 
				}


			}
		}

	}

}
function cargaropciones(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Controlador/join",true);
	xmlhttp.setRequestHeader("Content-type", "aplication/x-www-form-urlencoded");
	xmlhttp.send('');
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			select = xmlhttp.responseText;
			document.getElementById("seleccion").innerHTML = select;
		}
	}
}
function cargaropciones_planes(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Controlador/join_plan",true);
	xmlhttp.setRequestHeader("Content-type", "aplication/x-www-form-urlencoded");
	xmlhttp.send('');
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			select = xmlhttp.responseText;
			document.getElementById("seleccion_plan").innerHTML = select;
		}
	}
}
function subir_imagen(){
	var imagen_seleccionada = document.getElementById("img_2").files[0].name;//nombre de la imagen
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Controlador/insertar_img",true);
	xmlhttp.setRequestHeader("Content-type", "aplication/x-www-form-urlencoded");
	xmlhttp.send('imagen_2='+imagen_seleccionada);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			alert(imagen_seleccionada);
		}
	}

}
function Imagen(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",config['url']+"Controlador/mostrar_imagenes",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send();
	document.getElementById("tablas").innerHTML ="";
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			imagen = JSON.parse(xmlhttp.responseText);
			for (var i = 0; i<imagen.length; i++) {
				var img = "<img src="+config['img']+imagen[i].imagen+">";
				document.getElementById("tablas").innerHTML += img;
			}
			console.log(imagen);
		}
	}
}