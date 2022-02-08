<!DOCTYPE html>
<html>
<head>
	<title>Hola</title>
</head>
<script type="text/javascript"src="<?=JS ?>java.js"></script>
<script type="text/javascript" src="<?=JS ?>config.js"></script>
<body>
	<!-- Enviar datos con get a mi controlador y de mi controlador a mi base de datos -->	
	<p>Ventana de datos</p>
	<form onsubmit="return false" >
		<div>
			Id<input id="n1"type="number" name="id">
			<br>
			nombre<input id="n2"type="text" name="nom">
			<br>
			contraseña<input id="n3" type="text" name="cont">
			<br>
			Des<input id="n4"type="text" name="des"><br>
			<!-- <input id="n5" type="submit" value="Enviar" name="enviar" onclick="prueba2()"> -->
			<button onclick="prueba2('n5')" id="n5">Enviar</button>
			<button onclick="prueba2('n6')" id="n6">Eliminar</button>
			<p id="Mensaje"></p>
		</div>
	</form>
</body>
</html>
<!-- Hacer lo ismo con un delete y que me muestre el mensaje de que se muestre, que muestre al no encontrar un registro -->
<!-- insertar datos por cada tabla y mostrarlos y eliminarlos, boton ver datos, crear un 1 modelo y 1 controlador -->