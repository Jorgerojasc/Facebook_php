<!DOCTYPE html>
<html>
<head>
	<title>Betas :C</title>
</head>
<link rel="stylesheet" type="text/css" href="<?=CSS  ?>estilo.css">
<script type="text/javascript" src="<?= JS  ?>actividad2.js"></script>
<script type="text/javascript" src="<?= JS  ?>config.js"></script>

<body onload="cargaropciones();cargaropciones_planes();">
	<form onsubmit="return false">
		<div id="div1">
			<p>Tabla Alumnos</p>
			Expediente<input id="expediente_ta" type="number" name="expediente"><br>
			Nombre<input id="nombre_ta" type="text" name="nombre"><br>
			edad<input id="edad_ta" type="number" name="edad"><br>
			semestre<input id="semestre_ta" type="number" name="semestre"><br>
			<div id="seleccion">				
			</div>
			<div id="seleccion_plan">
				
			</div>
			<div id="tabla_contenido">

				
			</div>
			</select><br>
			<button onclick="Alumnos('enviar_a')" id="enviar_a" >Enviar</button>
			<button id="mostrar_a" onclick="Alumnos('mostrar_tablaA')">Mostrar tabla</button>
			<p id="Tabla_A"></p>
		</div>	
	</form>
	<form onsubmit="return false">
		<div id="div2">
			<p>Tabla Carreras</p>
			carrera<input id="carrera_tc" type="text" name="carrera"><br>
			<button id="enviar_c" onclick="Alumnos('enviar_c')">Enviar</button>
			<button id="mostrar_c" onclick="Alumnos('mostrar_tablaC')">Mostrar tablas</button><br>
			<p id="Tabla_C">
			</p>
			<div id="mostrar_tablaC"></div>
		</div>		
	</form>
	<form onsubmit="return false">
		<div id="div3">
			<p>Tabla Planes</p>
			plan<input id="plan_tp" type="text" name="plan"><br>
			<button id="enviar_p" onclick="Alumnos('enviar_p')">Enviar</button>
			<button id="mostrar_p" onclick="Alumnos('mostrar_tablaP')">Mostrar tablas</button>
			<p id="Tabla_P"></p>
		</div>
	</form>
	<form action="<?php URL ?>env_imagen" method="POST" enctype="multipart/form-data">
		<input type="file" name="images">
		<input type="submit" name="enviar" value="enviar">
	</form>
	<div id="imagen_mostrar">

		<button id="mostrar_imagen" onclick="Imagen();">Mostrar Imagen</button>
	</div>
	<div id="tablas">
	</div>
	<div id="tabla2"></div>
	
</body>
</html>