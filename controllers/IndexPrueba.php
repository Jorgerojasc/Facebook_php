<?php

class Index extends Controller{
    function __construct() {
        parent::__construct();
    }

    function Index(){
    	$this->loadOtherModel("actualizar");
    	$p = $this->actualizar->actualiza();
    	echo "<pre> H";
    	print_r($p);
    	echo"</pre>";
    	echo json_encode($p);

    }
    function eliminar(){
    	$this->loadOtherModel("eliminar");
    	$e = $this->eliminar->elimina($_POST['v'],$_POST['v1'],$_POST['v2'],$_POST['v3']);
    	echo json_encode($e);
    }
    function r(){
    	$this->loadOtherModel("insertar");
    	$e = $this->insertar->inserta($_POST['v'],$_POST['v1'],$_POST['v2'],$_POST['v3']);
    	/*$this->loadOtherModel("pruebam");
    	$b = $this->pruebam->muestra();*/
    	echo ($e);

    }

    function ver(){
    	$this->view->render("prueba","vista",true);

    }
    function mos(){
    	$this->loadOtherModel("pruebam");
    	$e = $this->pruebam->muestra('1','rr','tt','bb');
    	echo json_encode($e);
    }
    function ver2(){
    	$this->view->render("prueba","vistatablas",true);
    }
    //usa la base de datos tr
}
?>
