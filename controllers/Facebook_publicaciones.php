<?php
	/**
    * @author Jorge Rojas C.       
    */
	class Facebook_publicaciones extends Controller{
		function __construct(){
			parent::__construct();
		}
		function imagen_usuario(){
			$this->loadOthermodel("publicaciones");
			$datos = $this->publicaciones->traer_datos($_POST["usuario"],$_POST["id"]);
			echo json_encode($datos);

		}
		function vista_registro(){
			$this->view->render("Proyecto_facebook","Registro_login_Facebook_vista",true);
		}
		function publicar(){
			$this->loadOthermodel("publicaciones");
			if($_POST["publicacion"] != "NA" ){
				$publicacion = $this->publicaciones->publica($_POST["publicacion"],$_POST["id"],$_POST["nombre"]);
				echo json_encode($publicacion);
			}
		}
		function publicaciones_amigos(){
			$this->loadOthermodel("publicaciones");
			$publicaciones = $this->publicaciones->publicaciones_todos($_POST["nombre"],$_POST["id"]);
			echo json_encode($publicaciones);
		}
		function insertar_like(){
			$this->loadOthermodel("publicaciones");
			$like = $this->publicaciones->inserta_like($_POST["id"],$_POST["persona"],$_POST["nombre"],$_POST["publicacion"]);
/*			$like = $this->publicaciones->inserta_like(1,"Jorge Rojas","Jorge Rojas","Hola a todos");*/
			echo json_encode($like);
		}
		function cantidad_likes(){
			$this->loadOthermodel("publicaciones");
			$cantidad = $this->publicaciones->cuenta_likes($_POST["id"],$_POST["persona"]);
			/*$cantidad = $this->publicaciones->cuenta_likes("Jorge Rojas",1);*/
			echo json_encode($cantidad);
		}
		function cerrar(){
			$this->loadOthermodel("publicaciones");
			$actualizar = $this->publicaciones->no_conectado($_POST["id"]);
			session_start();
			session_destroy();
		}
		function contactos(){
			$this->loadOthermodel("publicaciones");
			$contacto = $this->publicaciones->conectados($_POST["id"],$_POST["usuario"]);
			echo json_encode($contacto);
		}
		function publicaciones_mias(){
			$this->loadOthermodel("publicaciones");
			$publicacion = $this->publicaciones->mis_publicaciones($_POST["id"],$_POST["nombre"],$_POST["vista"]);
		/*	$publicacion = $this->publicaciones->mis_publicaciones(1,"Monica Trejo",2);*/
			echo json_encode($publicacion);
		}
	}

?>