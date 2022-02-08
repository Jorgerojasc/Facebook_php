<?php
	class actualizar_model extends Model{
		function actualiza(){
			return $this->db->update(['id'=>1, 'nom'=>'admin', 'cont'=>'passadmin', 'des'=>'admint'],"jorge","id =1");
		}
	}
?>