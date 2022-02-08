<!--@author Jorge Rojas C.  -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=CSS  ?>Estilos_muro.css">
	<script type="text/javascript" src="<?= JS  ?>config.js"></script>
	<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/registro_login.js"></script>
	<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/muro_facebook.js"></script>
</head>
<body onload="cargar_herramientas();datos_usuarios();cargar_estatus_solicitud();cargar_amigos();cargar_muro_solicitud();cargar_publicaciones();cargar_publicacion_mi_muro()">
	<div id="foto_de_portada">
	</div>
	<form id="form" action="<?php URL ?>env_img" method="POST" enctype="multipart/form-data">
		<div id="opcion_foto_portada">
			<div id="texto_foto">
				<p id="texto_portada">Añadir foto de portada</p>
				<input type="file" name="portada" id="boton_enviar" onclick="enviar_img()">
				<input id="boton_cambiar" type="button" name="enviar" value="cambiar" onclick ="env_datos()">
			</div>
			<div id="imagen_camara">
				<img id="camara" src="<?=IMG  ?>camara.svg">
			</div>
		</div>	
	</form>
	<div id="Publicacion"></div>
<!-- 	<div id="na" onclick="prueba()">
		Prueba
		
	</div> -->
	<div id="Nombre_persona">
		
	</div>
	<div id="agregar" onclick="enviar_solicitud()">
		<div id="texto_agregar">
			Añadir a mis amigos
		</div>
		<div id="imagen_agregar">
			<img src="<?=IMG  ?>añadir_amigo.svg">
		</div>
	</div>
	<div id="agregar_desde_muro">
		
	</div>
	<div id="agregar_desde_muroE">
		
	</div>
	<div id="opciones_perfil">
		<nav id="nav_opciones">
			<!-- <a href="">Biografia</a>
			<a href="">Informacion</a> -->
			<a id="Amigos_numero" href="">Amigos</a>
			<!-- <a id="fotos" href="">Fotos</a> -->
		</nav>
	</div>
	<div id="Foto_de_perfil" >
	</div>
	<form id="form_perfil" action="<?php URL ?>enviar_perfil"  method="POST" enctype="multipart/form-data">
		<div id="intercambiar_f">
			<input type="file" name="perfil" id="boton_perfil" onclick="datos_portada()">
			<input id="boton_cambiar_perfil" type="button" name="enviar" value="cambiar" onclick ="enviar_img_perfil()">
		</div>
	</form>
	<div id="agregar_img_p">
			<p id="actualizar_img">Actualizar</p>
			<img id="img_perfil" src="<?=IMG  ?>camara.svg">
	</div>

</body>
</html>