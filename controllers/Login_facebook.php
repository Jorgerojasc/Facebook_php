<?php
	/**
    * @author Jorge Rojas C.       
    */
	class Login_facebook extends Controller{
		function __construct(){
			parent::__construct();
		}
		function login(){
			$this->view->render("Proyecto_facebook","Registro_login_Facebook_vista",true);
			$this->view->render("Proyecto_facebook","Publicaciones_vista",true);
			
		}
		function logearse(){

			$_SESSION['correo'] = 1;
			$this->loadOtherModel("facebook");
			$l = $this->facebook->login_usuario($_POST["correo"],$_POST["password"]);

			echo json_encode($l);

		}
		function registro(){
			$this->loadOtherModel("facebook");
		$t = $this->facebook->insertar_registros($_POST["nombre"],$_POST["apellido"],$_POST["correo"],$_POST["password"],$_POST["sexo"],$_POST["fecha"],$_POST["conectado"]);
/*			$t = $this->facebook->insertar_registros("juan","perez","jorge@hotmadil.com","dk55sf","Mujer","25","0");*/
			echo json_encode($t);

		}
		function foto_perfil_registrado(){
			$this->loadOtherModel("facebook");
			$p = $this->facebook->foto_registrado();
			echo $p;
		}
		function foto_perfil_logeado(){
			$this->loadOtherModel("facebook");
			$f = $this->facebook->foto_logeado($_POST["id_usuario"]);
			echo $f;
		}
		function busqueda(){
			$this->loadOtherModel("facebook");
			$f = $this->facebook->busqueda_amigo($_POST["nombre_amigo"],$_POST["nombre_buscador"]);
			echo json_encode($f);

		}


	}
?>