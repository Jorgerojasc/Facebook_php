<?php
	class Prueba extends Controller{
		function __construct(){
			parent::__construct();
		}
		function prueba2(){
    		$this->view->render("Proyecto_facebook","Facebook_vista",true);
    		$this->view->render("Proyecto_facebook","Muro_vista",true);
    	}
	}
?>