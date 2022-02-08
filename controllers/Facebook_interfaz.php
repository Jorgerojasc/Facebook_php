<?php
    /**
    * @author Jorge Rojas C.       
    */
	class Facebook_interfaz extends Controller{
		function __construct(){
			parent::__construct();
		}
		function Facebook_vista(){

            error_reporting(0);
            if($_SESSION['correo']==null || $_SESSION['correo']==''){
                $this->view->render("Proyecto_facebook","Registro_login_Facebook_vista",true);
                session_destroy();
                die();
            }
            else{
                $this->view->render("Proyecto_facebook","Facebook_vista",true);
                $this->view->render("Proyecto_facebook","Publicaciones_vista", true);
                $this->view->render("Proyecto_facebook","vista_izquierda",true);
                echo "<script type='text/javascript'>sessionStorage.setItem('Vista',0);</script>"; 
            }
    	}//con post para recibir los datos
        function Muro_vista(){
            $this->view->render("Proyecto_facebook","Muro_vista",true);
            $this->view->render("Proyecto_facebook","Facebook_vista",true);
             echo "<script type='text/javascript'>document.getElementById('contenedor_juegos').style.visibility = 'hidden';</script>";
        }
        function imagen_portada_muro(){
            /*persona hay que enviarla desde ajax el sessionstorage("amigo")*/
            $this->loadOthermodel("muro");
            $foto = $this->muro->imagen_portada($_POST["persona"],$_POST["imagen"]);
            echo json_encode($foto);
        }
        function solicitud(){
            $this->loadOthermodel("muro");
            $solicitud = $this->muro->insertar_solicitud($_POST["emisor"],$_POST["receptor"]);
            /*$solicitud = $this->muro->insertar_solicitud("1","Martha Sanchez");*/
            echo json_encode($solicitud);
        }
        function buscar_solicitud(){
            $this->loadOthermodel("muro");
            $busqueda = $this->muro->busca_solicitud($_POST["amigo"],$_POST["id"]);
            echo json_encode($busqueda);
        }
        function buscar_solicitudes(){
            /*aqui pondra en el muro de la persona confirma o eliminar*/
            $this->loadOthermodel("muro");
            $resultado = $this->muro->muro_solicitud($_POST["solicitante"],$_POST["emisor"]);
            /*$resultado = $this->muro->muro_solicitud("Maria suarez","Jorge Rojas");*/
            echo json_encode($resultado);
        }
        function notificar_solicitud(){
            $this->loadOthermodel("muro");
            $notificaciones = $this->muro->notificar($_POST["usuario"]);
            /*$notificaciones = $this->muro->notificar("Jorge Rojas");*/
            echo json_encode($notificaciones);
        }
        function estatus_solicitud(){
            $this->loadOthermodel("muro");
         $estatus = $this->muro->insertar_estatus($_POST["emisor"], $_POST["receptor"],$_POST["status"]);
            echo $estatus;
        }
        function cantidad_amigos(){
            $this->loadOthermodel("muro");
            $numero_amigos = $this->muro->contar_amigos($_POST["receptor"],$_POST["id"]);
            /*$numero_amigos = $this->muro->contar_amigos("Monica Trejo",152);*/
            echo json_encode($numero_amigos);
        }
        function comprobar_portada(){
            $this->loadOthermodel("muro");
            $portada = $this->muro->comprobar_foto_p($_POST["usuario"]);
            echo json_encode($portada);
        }
        function env_img(){
            $this->loadOtherModel("muro");
            $id = $_POST["id"];
            /*$name = $_POST["name"];*/
            $update = $_POST["update"];
            $arch = $_POST["arch"];
            $imagen = $_FILES['portada']['name'];
            $guardar = $_FILES['portada']['tmp_name'];
            $destino = $imagen;
            $dest= "C:/xampp/htdocs/Betas/public/images"."/".$imagen;
            move_uploaded_file($guardar,$dest);
            $destino_bd = IMG.$arch;
            $e = $this->muro->cambiar_portada($destino_bd, $id,$update);
        }
        function enviar_perfil(){
            $this->loadOtherModel("muro");
            $id = $_POST["id"];
            $arch = $_POST["arch"];
            $imagen = $_FILES['perfil']['name'];
            $guardar = $_FILES['perfil']['tmp_name'];
            $destino = $imagen;
            $dest= "C:/xampp/htdocs/Betas/public/images"."/".$imagen;
            move_uploaded_file($guardar,$dest);
            $destino_bd = IMG.$arch;
            $e = $this->muro->cambiar_perfil($destino_bd, $id);
        }
	}
?>