<!--@author Jorge Rojas C.  -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=CSS  ?>Estilos_publicaciones.css">
	<script type="text/javascript" src="<?= JS  ?>config.js"></script>
	<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/publicaciones.js"></script>
	<title>Facebook</title>
</head>
<body onload="contar_likes();cargar_publicaciones()">
	<div id="Publicaciones">
		<div id="crear_publicacion">
			<div id="cabecera_crear_publicacion">
				<p id="texto_crear">Crear publicación</p>
			</div>
			
			<textarea onclick="ocultardiv()" id="input_publicacion"></textarea>
			<input id="boton_publicar" type="button" name="Compartir" value="Compartir" onclick="compartir_p();cargar_publicaciones();">
		
		</div>
	</div>
	<div id="conectados">
		
	</div>

</body>
</html>