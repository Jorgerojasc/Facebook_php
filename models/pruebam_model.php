<?php
	class pruebam_model extends Model{
		function muestra($id,$nom,$cont,$des){
			$cadena = "SELECT id,nom,cont,des FROM jorge WHERE id='$id' AND nom='$nom' AND cont='$cont' AND des = '$des' ";
			return $this->db->query($cadena);
		}

	}  
?>