<?php
	class todoenuno_model extends Model{
		function inserta_alumnos($nombre,$expediente,$edad,$semestre,$idcarrera, $idplan){
			$arrayAlumnos = array('expediente' => $expediente, 'nombre'=>$nombre, 'edad'=>$edad,'semestre'=>$semestre, 'idcarrera'=>$idcarrera, 'idplan'=>$idplan);
			return $this->db->insert($arrayAlumnos,"alumnos");
		}
		function inserta_carreras($carrera){
			$arraycarrera = array('carrera' =>$carrera , );
			return $this->db->insert($arraycarrera,"carreras");
		}
		function inserta_planes($plan){
			$arrayPlanes = array('plan'=>$plan);
			return $this->db->insert($arrayPlanes,"planes");
		}
		function select_todo(){
			return $this->db->select("idcarrera","carreras");
		}
		function mostrar(){
			return $this->db->select("*","carreras");
		}
		function mostrar_planes(){
			return $this->db->select("*","planes");
		}
		function mostrar_alumnos(){
			return $this->db->select("*","alumnos a, planes p, carreras c", "a.idplan=p.idplan AND a.idcarrera=c.idcarrera" );
		}
		function carreraid(){
			return $this->db->select("idcarrera, carrera","carreras");
		}
		function planid(){
			return $this->db->select("idplan,plan","planes");
			
		}
		function imagen($destino){
			$destino_db = array('imagen' =>$destino);
			return $this->db->insert($destino_db,"imagenes");
		}
		function mostrar_img(){
			return $this->db->select("imagen","imagenes");
		}
	}

?>