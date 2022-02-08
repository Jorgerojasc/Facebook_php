<?php

	class insertar_model extends Model
	{
		function inserta($id, $nom,$cont,$des)
		{

			$arrayName = array('id'=>$id,'nom' => $nom, 'cont'=>$cont, 'des'=>$des);
			return $this->db->insert($arrayName,"jorge");
		}
	}
?>