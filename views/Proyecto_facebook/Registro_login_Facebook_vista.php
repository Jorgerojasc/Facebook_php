<!--@author Jorge Rojas C.  -->
<!DOCTYPE html>
<html>
<head>
	<title>Facebook - Entra o regístrate</title>
</head>
<link rel="stylesheet" type="text/css" href="<?=CSS  ?>Estilos_login.css">
<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/registro_login.js"></script>
<script type="text/javascript" src="<?=JS  ?>Proyectofacebookjs/publicaciones.js"></script>
<script type="text/javascript" src="<?= JS  ?>config.js"></script>
<body onload="cargar_publicaciones()">
	<div  id="Cabecera_login">
		<div id ="imagen_letras">
			<img id="letras_f" src="<?=IMG  ?>Facebook_letras.svg">
		</div>
<!-- -----------------------------Login-------------------------------- -->
		<form id="formulario_login" method="POST" >
			<table>
				<tr>
					<td><label >Correo electrónico o teléfono</label></td>
					<td><label class="pass_label">Contraseña</label></td>
				</tr>
				<tr>
					<td><input id="correo_log" class="introducir_correo" type="text" name="correo" required></td>
					<td><input id="password_log" class="introducir_pass" type="password" name="contrasena" required></td>
					<td><input class="boton_login" type="submit" name="Enviar" onclick="hacer_login()"></td>
					<td>
						<div class="recuperar_cuenta"><a href="">¿Has olvidado los datos de la cuenta?</div>
					</td>
				</tr>
			</table>
			
		</form>
	</div>
<!-- -------------------------Registro--------------------------------- -->
	<div id="registro_cuenta">
		<div class="texto_crear_cuenta">Registrate</div>
		<div class="cuenta_gratis">Es gratis y lo será siempre.</div>
		<form action="<?= URL ?>Facebook_interfaz/Facebook_vista" class="formulario_registro" method="POST" autocomplete="off"><!-- Preguntar de la vista -->
			<input id="nombre_id" class="inputt_nombre" type="text" name="nombre" placeholder="Nombre" required>
			<input id = "apellido_id"class="inputt_apellido" type="text" name="apellido" placeholder="Apellidos" required>
			<input id="correo_id" class="inputt_correo" type="text" name="correo" placeholder="Número de móvil o correo electrónico" required>
			<input id="password_id" class="inputt_pass" type="password" name="contrasena" placeholder="Contraseña nueva" required><br>
			<div class="texto_fecha">Fecha de nacimiento</div>
			<select id="dia_id" class="fecha_dia" required>
				<option value ="0" required>Dia</option>
				<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
				<option value="4">04</option>
				<option value="5">05</option>
				<option value="6">06</option>
				<option value="7">07</option>
				<option value="8">08</option>
				<option value="9">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select id ="mes_id" class="fecha_mes">
				<option value="0">Mes</option>
				<option value="1" rquired>ene</option>
				<option value="2">feb</option>
				<option value="3">mar</option>
				<option value="4">Abr</option>
				<option value="5">may</option>
				<option value="6">jun</option>
				<option value="7">jul</option>
				<option value="8">ago</option>
				<option value="9">sep</option>
				<option value="10">oct</option>
				<option value="11">nov</option>
				<option value="12">dic</option>
			</select>
			<!-- al insertar una fecha debemos dar la edad y ademas guardar la fecha completa  -->
			<select id="anio_id" class="fecha_año">
				<option value="0">Año</option>
				<option value="1">2019</option>
				<option value="2">2018</option>
				<option value="3">2017</option>
				<option value="4">2016</option>
				<option value="5">2015</option>
				<option value="6">2014</option>
				<option value="7">2013</option>
				<option value="8">2012</option>
				<option value="9">2011</option>
				<option value="10">2010</option>
				<option value="11">2009</option>
				<option value="12">2008</option>
				<option value="13">2007</option>
				<option value="14">2006</option>
				<option value="15">2005</option>
				<option value="16">2004</option>
				<option value="17">2003</option>
				<option value="18">2002</option>
				<option value="19">2001</option>
				<option value="20">2000</option>
				<option value="21">1999</option>
				<option value="22">1998</option>
				<option value="23">1997</option>
				<option value="24">1996</option>
				<option value="25">1995</option>
				<option value="26">1994</option>
				<option value="27">1993</option>
				<option value="28">1992</option>
				<option value="28">1991</option>
				<option value="29">1990</option>
				<option value="30">1989</option>
				<option value="31">1988</option>
				<option value="32">1987</option>
				<option value="33">1986</option>
				<option value="34">1985</option>
				<option value="35">1984</option>
				<option value="36">1983</option>
				<option value="37">1982</option>
				<option value="38">1981</option>
				<option value="39">1980</option>
				<option value="40">1979</option>
				<option value="41">1978</option>
				<option value="42">1977</option>
				<option value="43">1976</option>
				<option value="44">1975</option>
				<option value="45">1974</option>
				<option value="46">1973</option>
				<option value="47">1972</option>
				<option value="48">1971</option>
				<option value="49">1970</option>
				<option value="50">1969</option>
				<option value="51">1968</option>
				<option value="52">1967</option>
				<option value="53">1966</option>
				<option value="54">1965</option>
				<option value="55">1964</option>
				<option value="56">1963</option>
				<option value="57">1962</option>
				<option value="58">1961</option>
				<option value="59">1960</option>
				<option value="60">1959</option>
				<option value="61">1958</option>
				<option value="62">1957</option>
				<option value="63">1956</option>
				<option value="64">1955</option>
				<option value="65">1954</option>
				<option value="66">1953</option>
				<option value="67">1952</option>
				<option value="68">1951</option>
				<option value="69">1950</option>
				<option value="70">1949</option>
				<option value="71">1948</option>
				<option value="72">1947</option>
				<option value="73">1946</option>
				<option value="74">1945</option>
				<option value="75">1944</option>
				<option value="76">1943</option>
				<option value="77">1942</option>
				<option value="78">1941</option>
				<option value="79">1940</option>
				<option value="80">1939</option>
				<option value="81">1938</option>
				<option value="82">1937</option>
				<option value="83">1936</option>
				<option value="84">1935</option>
				<option value="85">1934</option>
				<option value="86">1933</option>
				<option value="87">1932</option>
				<option value="88">1931</option>
				<option value="89">1930</option>
				<option value="90">1929</option>
				<option value="91">1928</option>
				<option value="92">1927</option>
				<option value="93">1926</option>
				<option value="94">1925</option>
				<option value="95">1924</option>
				<option value="96">1923</option>
				<option value="97">1922</option>
				<option value="98">1921</option>
				<option value="99">1920</option>
				<option value="100">1919</option>
				<option value="101">1918</option>
				<option value="102">1917</option>
				<option value="103">1916</option>
				<option value="104">1915</option>
				<option value="105">1914</option>
				<option value="106">1913</option>
				<option value="107">1912</option>
				<option value="108">1911</option>
				<option value="109">1910</option>
				<option value="110">1909</option>
				<option value="111">1908</option>
				<option value="112">1907</option>
				<option value="113">1906</option>
				<option value="114">1905</option>
			</select>
			<div id="texto_nacimiento_fecha">
				<a class="texto_nacimiento" href="" tabindex="0">¿Por qué tengo que facilitar mi fecha de nacimiento?</a>
			</div>
			<br>
			<input class="sexo_elegir" id="sexo_mujer" type="radio" name="sexo" value="Mujer">   Mujer
			<input class="sexo_elegir" id="sexo_hombre" type="radio" name="sexo" value="Hombre">  Hombre
			<br>
			<div id="terminos_y_condiciones">
				Al hacer click en Registrarte, acepta las <a class="condiciones" href="https://www.facebook.com/legal/terms/update">Condiciones</a>, la <a class="p_datos" href="https://www.facebook.com/about/privacy/update">Política de datos</a> y la <a class="p_cookies" href="https://www.facebook.com/policies/cookies/">Políticas de cookies</a>. Es posible que te enviemos
				notificaciones pos SMS que podras desactivar cuando quieras.
			</div>
			<button class="boton_registro" onclick="hacer_registro()">Registrarte</button>
		</form>
<!-- --------------------------------------------------------------------------------------------------- -->
		<div id="contenedor_personapublica">
			<div class="pagina_personajepublico">
				<a class="crea_pagina" href="">Crea una página</a> para un personaje público, un grupo de música
					o un negocio.
			</div>
		</div>
	</div>
	<div id="idiomas">
		<br>
		<table class="tabla_idiomas">
			<thead><a class="estilo_idioma_e" href="">Español(España)</a></thead>
			<thead><a class="estilo_idioma_en" href="">English(US)</a></thead>
			<thead><a class="estilo_idioma_p" href="">Português (Brasil)</a></thead>
			<thead><a class="estilo_idioma_f" href="">Français (France)</a></thead>
			<thead><a class="estilo_idioma_i" href="">Italiano</a></thead>
			<thead><a class="estilo_idioma_d" href="">Deutsch</a></thead>
			<thead><a class="estilo_idioma_a" href="">اربية</a></thead>
			<thead><a class="estilo_idioma_c" href="">日本語</a></thead>
			<thead><a class="estilo_idioma_n" href="">हिन्दी</a></thead>
			<thead><a class="estilo_idioma_co" href="">中文(简体)</a></thead>
			<thead><input class="input_boton" type="image" src="<?=IMG  ?>cruz.png" name="b"></thead>
		</table>
		<div id="caracteristicas">
			<div class="tabla_caracteristicas">
				<table>
					<thead><a class="opcion" href="">Registrarte</a></thead><!-- cambiar a texto  -->
					<thead><a class="opciones" href="">Entrar</a></thead>
					<thead><a class="opciones" href="">Messinger</a></thead>
					<thead><a class="opciones" href="">Facebook Lite</a></thead>
					<thead><a class="opciones" href="">Buscar amigos</a></thead>
					<thead><a class="opciones" href="">Personas</a></thead>
					<thead><a class="opciones" href="">Perfiles</a></thead>
					<thead><a class="opciones" href="">Páginas</a></thead>
					<thead><a class="opciones" href="">Categorías de páginas</a></thead>
					<thead><a class="opciones" href="">Lugares</a></thead>
					<thead><a class="opciones" href="">Juegos</a></thead>
					<thead><a class="opciones" href="">Lugares</a></thead>
				</table>
				<table>
					<thead><a class="opcion" href="">Marketplace</a></thead>
						<thead><a class="opciones_1" href="">&nbsp;&nbsp;&nbsp;Grupos</a></thead>
						<thead><a class="opciones_1" href="">Instagram</a></thead>
						<thead><a class="opciones_1" href="">Local</a><thead>
						<thead><a class="opciones_1" href="">Recaudaciones de fondos</a></thead>
						<thead><a class="opciones_1" href="">Información</a></thead>
						<thead><a class="opciones_1" href="">Crear anuncio</a></thead>
						<thead><a class="opciones_1" href="">Crear página</a></thead>
						<thead><a class="opciones_1" href="">Desarrolladores</a></thead>
						<thead><a class="opciones_1" href="">Empleo</a></thead>
						<thead><a class="opciones_1" href="">Privacidad</a></thead>
						<thead><a class="opciones_1" href="">Cookies</a></thead>
				</table>
				<table>
					<thead><a class="opcion" href="">Gestió de anuncio</a></thead>
					<thead><a class="opciones_1" href="">&nbsp;&nbsp;&nbsp;Condiciones</a></thead>
					<thead><a class="opciones_1" href="">Seguridad de la cuenta</a></thead>
					<thead><a class="opciones_1" href="">Ayuda para entrar en Facebook</a><thead>
					<thead><a class="opciones_1" href="">Recaudaciones de fondos</a></thead>
					<thead><a class="opciones_1" href="">Ayuda</a></thead>
				</table> 
			</div>
		</div>
		<div id="marca_registrada">
			Facebook© 2019
		</div>
	</div>
	<div id="derecha">
		<div id="texto_mundo">
			Facebook te ayuda a comunicarte y compartir 
			con las personas que forman parte de tu vida.
		</div>
		<div id="imagen_mundo">
			<img class="mundo" src="<?=IMG   ?>mundo_facebook.png">
		</div>
		<!-- <div id="texto_sesiones">///Aqui es cuando el usuario cierra sesion
			Inicio de sesión recientes
		</div>
		<div id="texto_añadir">
			Haz clic en una foto o añade una cuenta
		</div>
		<div id="agregar_cuenta">
			<div id="nombre_cuenta">
				<img class="simbolo_mas" src="<?=IMG  ?>plus.svg">
			</div>
			<div class="texto_cuenta">
				Añadir cuenta
			</div>
			
		</div>
		<div id="agregar_cuenta_2">
			<div id="nombre_cuenta">
				<img class="simbolo_mas" src="<?=IMG  ?>plus.svg">
			</div>
			<div class="texto_cuenta">
				Añadir cuenta
			</div>
			
		</div> -->
	</div>
</body>

</html>
