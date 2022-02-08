<?php
	/**
	 * 
	 */
	class muro_model extends Model
	{
		/*$mensaje = '"'.'No se encontro ningun registro'.'"';*/
		
		function imagen_portada($persona,$imagen){
			if($imagen == "portada"){
				$condicion = "'$persona' LIKE CONCAT(u.Nombre,' ',u.Apellido) AND u.idusuario = p.idusuario AND p.Descripcion LIKE 'Portada'";
				$mostrar_portada = $this->db->select("p.Foto","publicaciones p, usuarios u",$condicion);
				if($mostrar_portada == "No se encontro ningun registro" ){
					$condicion = "'$persona' LIKE CONCAT(u.Nombre,' ',u.Apellido) AND u.idusuario = p.idusuario AND p.Descripcion LIKE 'Predeterminada' ";
					$resultado =  $this->db->select("p.Foto","usuarios u, publicaciones p",$condicion);
					$extraer_ruta = json_encode($resultado);
					$decodificar_ruta = json_decode($extraer_ruta);
					$imprimir_ruta = $decodificar_ruta->{'Foto'};
					$fotos = array('perfil' =>$imprimir_ruta ,'portada'=>"None");
					return $fotos;
				}
				if($mostrar_portada != "No se encontro ningun registro"){
					$condicion = "'$persona' LIKE CONCAT(u.Nombre,' ',u.Apellido) AND u.idusuario = p.idusuario AND p.Descripcion LIKE 'Predeterminada' ";
					$resultado =  $this->db->select("p.Foto","usuarios u, publicaciones p",$condicion);
					$extraer_ruta = json_encode($resultado);
					$decodificar_ruta = json_decode($extraer_ruta);
					$extraer_portada = json_encode($mostrar_portada);
					$decodificar_portada = json_decode($extraer_portada);
					$imprimir_portada = $decodificar_portada->{'Foto'};
					$imprimir_ruta = $decodificar_ruta->{'Foto'};
					$fotos = array('perfil' =>$imprimir_ruta ,'portada'=>$imprimir_portada );
					return $fotos;
				}
			}
		
		}
		function insertar_solicitud($emisor,$receptor){
			/*en estatus 0 = enviado, 1 = aceptado y 2 = rechazado*/
			$condicion = "'$emisor' LIKE emisor AND '$receptor' LIKE receptor";
			$comprobar = $this->db->select("COUNT(receptor) as contador","solicitudes",$condicion);
			$count= json_encode($comprobar);
			$decodificar_count = json_decode($count);
			$valor_count = $decodificar_count->{'contador'};
			$i =(int) $valor_count;
			if ($i == 0) {
				$estatus = array('estatus' => 0);
				$this->db->insert($estatus,"estatus");
				$ordenar = "idestatus DESC";
				$id_estatus = $this->db->select("idestatus", "estatus",'',$ordenar);
				$extraer_id= json_encode($id_estatus[0]);
				/*Marca error si no tengo ningun elemento en estatus*/
				$id_reciente = json_decode($extraer_id);
				$valor_id = $id_reciente->{'idestatus'};
				$id = json_encode($valor_id);
				$solicitud = array('idestatus'=>$valor_id,'emisor' =>$emisor ,'receptor'=>$receptor);
				return $this->db->insert($solicitud,"solicitudes");	
			}
			else{
				return false;
			}
		}
		function busca_solicitud($amigo,$id){
			$condicion = "'$id' LIKE s.emisor AND '$amigo' LIKE s.receptor AND e.idestatus = s.idestatus";
			$r = $this->db->select("e.estatus","solicitudes s, estatus e",$condicion);
			$valor = json_encode($r);
			$decodificar = json_decode($valor);
			$extraer_valor = $decodificar->{'estatus'};
			return $t = (int) $extraer_valor;

		}
		function muro_solicitud($solicitante,$emisor){
			$condicion = "'$solicitante' LIKE CONCAT(u.Nombre,' ',u.Apellido) AND u.idusuario LIKE s.emisor AND '$emisor' LIKE s.receptor AND s.idestatus LIKE e.idestatus  ";
			return $this->db->select("e.estatus","solicitudes s, estatus e, usuarios u",$condicion); 
		}
		function notificar($usuario){
			
			$condicion = "'$usuario' LIKE receptor AND s.emisor LIKE u.idusuario AND u.idusuario LIKE p.idusuario AND e.estatus LIKE 0 AND  e.idestatus LIKE s.idestatus AND p.Descripcion LIKE 'Predeterminada'";/*aqui poner lo de si la foto es predeterminada o la cambio, o al dar click en añadir foto de portada, que selecione aquella foto que tenga en decripcion predeterminada y sustituya la ruta de la foto*/
			return $this->db->select("CONCAT(u.Nombre, ' ',u.Apellido) AS nombre,p.Foto ","publicaciones p, solicitudes s, usuarios u, estatus e ",$condicion);
				
			

		}
		function insertar_estatus($emisor, $receptor,$status){
			$where = "'$emisor' LIKE CONCAT(u.Nombre, ' ' ,u.Apellido) AND '$receptor' LIKE s.receptor AND u.idusuario LIKE s.emisor";
			$comprobar = $this->db->select("s.idsolicitud","solicitudes s, usuarios u",$where);
			$arreglo = json_encode($comprobar);
			$decodificar = json_decode($arreglo);
			$valor_solicitud = $decodificar->{'idsolicitud'};
			$where_estatus = "$valor_solicitud LIKE s.idsolicitud AND s.idestatus LIKE e.idestatus";
			if ($status == "Aceptar") {
				$estatus = array('e.estatus' =>1 );
				return $r = $this->db->update($estatus,"estatus e , solicitudes s",$where_estatus );	
			}
			if ($status == "Eliminar") {
				$estatus = array('e.estatus' =>2 );
				return $r = $this->db->update($estatus,"estatus e , solicitudes s",$where_estatus );
			}
		}
		function contar_amigos($receptor,$id){
			$condicion_cout2="";
			$condicion_amigos = "'$receptor' LIKE s.receptor AND s.emisor LIKE u.idusuario AND u.idusuario LIKE p.idusuario AND e.estatus LIKE 1 AND  e.idestatus LIKE s.idestatus";
			if($id !="Na"){
				$condicion_cout2 = "$id LIKE s.emisor AND s.emisor LIKE u.idusuario AND u.idusuario LIKE p.idusuario AND e.estatus LIKE 1 AND  e.idestatus LIKE s.idestatus";
			}
			if ($id == "Na") {
				$condicion_cout2 = "'$receptor' LIKE CONCAT(u.Nombre,' ',u.Apellido) AND s.emisor LIKE u.idusuario AND u.idusuario LIKE p.idusuario AND e.estatus LIKE 1 AND  e.idestatus LIKE s.idestatus";
			}

			$count1 = $this->db->select("COUNT(DISTINCT s.emisor) AS numero","solicitudes s, usuarios u, publicaciones p, estatus e", $condicion_amigos);
			$count2 = $this->db->select("COUNT(DISTINCT s.receptor) AS numero2","solicitudes s, usuarios u, publicaciones p, estatus e", $condicion_cout2);
			$total_amigos = $count2+$count1;
			return $total_amigos;

		}
		function cambiar_portada($dest,$id,$update){
			if ($update == "No") {
				$destino_db = array('Foto' =>$dest,'Descripcion'=>"Portada",'idusuario'=>$id);
				return $this->db->insert($destino_db,"publicaciones");	
			}
			if ($update == "Si") {
				$where = "$id LIKE idusuario AND Descripcion LIKE 'Portada' ";
				$destino_db = array('Foto' =>$dest,'Descripcion'=>"Portada");
				return $this->db->update($destino_db,"publicaciones", $where);
			}
		}
		function cambiar_perfil($dest, $id){
			$where ="$id LIKE idusuario AND Descripcion LIKE 'Predeterminada'";
			$destino_perfil = array('Foto' =>$dest,'Descripcion'=>"Predeterminada"  );
			return $this->db->update($destino_perfil,"publicaciones",$where);

		}
		function comprobar_foto_p($usuario){
			$P = "Predeterminada";
			$where = "'$usuario' LIKE CONCAT(u.Nombre, ' ',u.Apellido) AND u.idusuario = p.idusuario AND p.Descripcion LIKE $p";
			return $this->db->select("p.Foto","publicaciones p, usuarios u",$where);
		}
	}
?>