<?php
	class eliminar_model extends Model{
		function elimina($id,$nom,$cont,$des){
			$cadena = "id ='$id' AND nom = '$nom' AND cont= '$cont' AND des= '$des'";
			return $this->db->delete("jorge",$cadena);
		}
	}
?>