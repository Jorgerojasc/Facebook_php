<?php
	/**
	 * 
	 */
	class jorge_model extends Model
	{
		
		function prueba(){
			return $this->db->select("nom, cont, des", "jorge");
		}
	}
 ?>