<!--@author Jorge Rojas C.  -->
<!DOCTYPE html>
<html>
<head>
	<title>Facebook</title>
	<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/
		muro_facebook.js"></script>
		<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/
		publicaciones.js"></script>
	<script type="text/javascript" src="<?= JS  ?>config.js"></script>
</head>
<link rel="stylesheet" type="text/css" href="<?=CSS  ?>Estilosfacebook.css">
<body onload="cargar_herramientas();cargar_lado_izquierdo();cargar_contenedor_publicaciones();cargar_publicaciones();cargar_publicacion_mi_muro()">
	<div id="cabecera_facebook">
		<img id="logo_facebook" src="<?=IMG  ?>logo_facebook.svg"><br>
		<form id="barra_cabecera_buscar" method="POST" autocomplete="off">
<!-- ---------------------BUSCAR AMIGOS------------------------------------- -->
			<input id="buscar" type="text" onkeyup="buscar_amigo()" onclick="menu_atras()" name="buscar" placeholder="Buscar">
			<button id="boton_lupa" ><img id="logo_lupa" src="<?=IMG  ?>lupa.svg"></button>		
		</form>
		<div id="resultado_busqueda" ></div>
		<div id="ocultar_respuestas" onclick="ocultar_buscador()"></div>
		
		<div id="nombre_sesion" onclick="muro();">

		</div>
		<div id="inicio" onclick="inicio()">
			<p>&nbsp;&nbsp;&nbsp;&nbsp;Inicio&nbsp;&nbsp;&nbsp;&nbsp;</p>
		</div>
<!--  		<div id="buscar_amigos">
 			<P>Buscar Amigos</P>
		</div>  -->
		<div id="solicitudes" onclick="mostrar_solicitud()">
			<img id="img_solicitud" src="<?=IMG ?>solicitudes.svg">
		</div>
		<div id="notificaciones_solicitud">
			<div id="imagen_flecha">
				<img id="flecha_img" src="<?=IMG  ?>flecha_arriba.svg">
			</div>
		</div>
		<div id="cerrar_session" onclick="salir_session()">
			<p id="texto_salir">Salir</p>
		</div>
	</div>
	<div id="contenedor_juegos">
		<!-- <div id="juegos_instantanios">
			<p>JUEGOS INSTANTANEOS</p>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="logo" src="<?=IMG  ?>spiderman.png">
			<img id="logo" src="<?=IMG  ?>uno.png">
		</div>
		<div id="juegos_usuario">
			<P>TUS JUEGOS</P>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="logo" src="<?=IMG  ?>angry_birds_f.png">
			<img id="logo" src="<?=IMG  ?>dragon_city.png">
			<img id="logo" src="<?=IMG  ?>crazy_penguin.png">
		</div> -->
	</div>

</body>
</html>