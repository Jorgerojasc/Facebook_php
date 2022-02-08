<?php
	class Controlador extends Controller{
		function __construct(){
			parent::__construct();
		}
        function env_imagen(){//es el bueno
            $imagen = $_FILES['images']["name"];
            $guardar = $_FILES['images']['tmp_name'];
            $destino = $imagen;
            copy($guardar, $destino);
            $this->loadOtherModel("todoenuno");
            $e = $this->todoenuno->imagen($destino);

        }
		function ver(){
    		$this->view->render("prueba","vista_B",true);
    	}
    	function talumnos(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->inserta_alumnos($_POST['nombre'],$_POST['expediente'],$_POST['edad'],$_POST['semestre'],$_POST['idcarrera'],$_POST['idplan']);
    		echo json_encode($e);
    	}
    	function tCarreras(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->inserta_carreras($_POST['carrera']);
    		echo $e;
    	}
    	function tPlanes(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->inserta_planes($_POST['plan']);
    		echo $e;
    	}
    	function mostrar_tablaC(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->mostrar();
			echo json_encode($e);
			
    	}
    	function mostrar_tablaP(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->mostrar_planes();
            echo json_encode($e);
    	}
    	function mostrar_tablaA(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->mostrar_alumnos();
    		echo json_encode($e);
    	}

    	function join(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->carreraid();
    		echo "Id carrera<select id='idcarrera_ta'>";
    		foreach ($e as $idC) {
    			echo "<option value=".$idC['idcarrera'].">".$idC['carrera']."</option>";
    		}
    		echo "</select>";
    	}
    	function join_plan(){
    		$this->loadOtherModel("todoenuno");
    		$e = $this->todoenuno->planid();
    		echo "Id_plan<select id='idplan_ta'>";
    		foreach ($e as $idC) {
    			echo "<option value=".$idC['idplan'].">".$idC['plan']."</option>";
    		}
    		echo "</select>";
    	}
        function insertar_img(){
            $this->loadOtherModel("todoenuno");
            $p = $_POST["imagen_2"];
            $foto = $_FILES[$_POST['imagen_2']]["name"];
            $guardar = $_FILES[$_POST['imagen_2']]["tmp_name"];
            $destino = "public/images/".$_POST['imagen_2'];
            copy($guardar, $destino);
            $e = $this->todoenuno->imagen($destino);
        }
        function mostrar_imagenes(){
            $this->loadOtherModel("todoenuno");
            $e = $this->todoenuno->mostrar_img();
            echo json_encode($e);

        }
/*        function mostrar_consulta(){
            $this->loadOtherModel("todoenuno");
            $r = $this->todoenuno
        }*/
    	
	}
?>