<?php
	class publicaciones_model extends Model{
		function traer_datos($usuario, $id){
			$where = "$id LIKE idusuario AND Descripcion LIKE 'Predeterminada' ";
			return $this->db->select("Foto","publicaciones",$where);

		}
		function publica($publicacion,$id,$nombre){
			$datos = array('Descripcion' =>$publicacion,'idusuario'=>$id);
			return $this->db->insert($datos,"publicaciones");
		}
		function publicaciones_todos($nombre,$id){
			$todos = "SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre,p.Descripcion,DATE_FORMAT(p.Fecha_publicacion,'%e %M %Y - %r') AS fecha,v.Foto,p.id_publicacion as id FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE '$nombre' LIKE s.receptor AND s.idestatus LIKE e.idestatus AND e.estatus LIKE 1 AND e.idestatus LIKE s.idestatus AND s.emisor LIKE p.idusuario AND p.Descripcion <>'Predeterminada' AND p.Descripcion <>'Portada' AND v.Descripcion <> 'Portada' AND v.Foto IS NOT null AND s.emisor LIKE p.idusuario AND u.idusuario LIKE p.idusuario AND v.idusuario LIKE u.idusuario AND v.Foto <> 'Portada' UNION SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre,p.Descripcion,DATE_FORMAT(p.Fecha_publicacion,'%e %M %Y - %r') AS fecha,v.Foto,p.id_publicacion as id FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE  $id LIKE p.idusuario AND p.Descripcion <> 'Portada' AND p.Descripcion IS NOT null AND p.Descripcion <>'Predeterminada' AND p.idusuario LIKE u.idusuario AND v.Descripcion <> 'Portada' AND v.Descripcion IS NOT null  AND v.idusuario LIKE $id AND v.idusuario LIKE u.idusuario AND v.Foto <> 'Portada' UNION SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre,p.Descripcion,DATE_FORMAT(p.Fecha_publicacion,'%e %M %Y - %r') AS fecha,v.Foto,p.id_publicacion as id FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE  $id LIKE s.emisor AND s.idestatus LIKE e.idestatus AND e.estatus LIKE 1 AND p.Descripcion <>'Predeterminada' AND p.Descripcion <>'Portada' AND v.Descripcion <> 'Portada' AND v.Foto IS NOT null AND v.Foto <> 'Portada' AND s.receptor LIKE CONCAT(u.Nombre, ' ',u.Apellido) AND $id <>p.idusuario AND u.idusuario LIKE p.idusuario AND p.idusuario LIKE v.idusuario ORDER BY fecha DESC ";
			$todo_en_uno = $this->db->query($todos);
			return $todo_en_uno;
		}
		function inserta_like($id,$persona,$nombre,$publicacion){
			$where = "$id LIKE ur.idUR AND p.Descripcion LIKE '$publicacion'";
			$obtener_datos = $this->db->select("p.id_publicacion as idpublicacion, ur.idUR","publicaciones p, usuarior ur",$where);
			$where_comprobar = "$id LIKE idUR AND p.id_publicacion LIKE l.idpublicacion AND '$publicacion' LIKE p.Descripcion ";
			$comprobar_like = $this->db->select("idpublicacion, idUR","likes l,publicaciones p", $where_comprobar);
			$where_cantidad_likes = "'$publicacion' LIKE p.Descripcion AND p.id_publicacion LIKE l.idpublicacion AND ur.idUR LIKE p.idusuario";
			$cantidad = $this->db->select("COUNT(l.idUR) as cantidad, p.id_publicacion","likes l, publicaciones p, usuarior ur",$where_cantidad_likes);
			if($comprobar_like == "No se encontro ningun registro" ){
				$insertar = $this->db->insert($obtener_datos,"likes");
				return $cantidad;
			}
			if ($comprobar_like != "No se encontro ningun registro") {
				/*return false;*/
				return $cantidad;
			}
		}
		function cuenta_likes($id,$persona){
			$todo = "SELECT DISTINCT l.idpublicacion,l.idlike FROM likes l, usuarios u, publicaciones p, estatus e, solicitudes s WHERE l.idpublicacion LIKE p.id_publicacion AND u.idusuario LIKE $id AND e.estatus LIKE 1 AND s.receptor LIKE '$persona' AND CONCAT(u.Nombre,' ',u.Apellido) LIKE '$persona' AND u.idusuario LIKE p.idusuario UNION SELECT  DISTINCT l.idpublicacion,l.idlike FROM likes l, usuarios u, publicaciones p, estatus e, solicitudes s WHERE l.idpublicacion LIKE p.id_publicacion AND u.idusuario LIKE $id AND e.estatus LIKE 1 AND s.emisor LIKE $id AND CONCAT(u.Nombre,' ',u.Apellido) LIKE '$persona' AND u.idusuario LIKE p.idusuario UNION SELECT l.idpublicacion, l.idlike FROM likes l, usuarios u, publicaciones p, estatus e, solicitudes s, usuarior ur  WHERE   l.idUR LIKE $id";
			$resultado = $this->db->query($todo);
			return $resultado;
			
		}
		function no_conectado($id){
			$where = "$id LIKE idusuario";
			$conectado = array('Conectado' => 0 );
			$this->db->update($conectado,"usuarios",$where);

		}
		function conectados($id, $usuario){
			$where = "SELECT  DISTINCT CONCAT(u.Nombre,' ',u.Apellido )as nombre, v.Foto, u.Conectado FROM solicitudes s, publicaciones p,publicaciones v, estatus e, usuarios u WHERE '$usuario' LIKE s.receptor AND s.idestatus LIKE e.idestatus AND e.estatus LIKE 1 AND e.idestatus LIKE s.idestatus AND s.emisor LIKE p.idusuario AND v.Descripcion LIKE 'Predeterminada' AND s.emisor LIKE p.idusuario AND  u.idusuario LIKE p.idusuario AND v.idusuario LIKE u.idusuario UNION SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre, v.Foto,u.Conectado  FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE  $id LIKE s.emisor AND s.idestatus LIKE e.idestatus AND e.estatus LIKE 1  AND v.Descripcion <> 'Portada'   AND s.receptor LIKE CONCAT(u.Nombre, ' ',u.Apellido) AND $id <>p.idusuario AND u.idusuario LIKE p.idusuario AND p.idusuario LIKE v.idusuario AND v.Foto IS NOT null";
			return $resultado = $this->db->query($where);


		}
		function mis_publicaciones($id, $nombre,$vista){
			if ($vista == 1 || $vista=="1" ) {
				$todo = "SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre,p.Descripcion,DATE_FORMAT(p.Fecha_publicacion,'%e %M %Y - %r') AS fecha,v.Foto,p.id_publicacion as id FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE $id LIKE p.idusuario AND p.Descripcion <>'Portada' AND p.Descripcion <>'Predeterminada' AND $id LIKE u.idusuario AND '$nombre' LIKE CONCAT(u.Nombre, ' ', u.Apellido) AND v.idusuario LIKE $id AND v.Foto IS NOT null AND v.Descripcion <> 'Portada' ORDER BY fecha DESC";
				$res = $this->db->query($todo);
				return $res;
			}
			if ($vista == 2 || $vista == "2") {
				$where_id = "CONCAT(Nombre, ' ',Apellido) LIKE '$nombre' ";
				$id = $this->db->select("idusuario","usuarios",$where_id);
				$extraer_id= json_encode($id);
				$id_reciente = json_decode($extraer_id);
				$valor_id = $id_reciente->{'idusuario'};
				$todo = "SELECT DISTINCT CONCAT(u.Nombre, ' ', u.Apellido) as nombre,p.Descripcion,DATE_FORMAT(p.Fecha_publicacion,'%e %M %Y - %r') AS fecha,v.Foto,p.id_publicacion as id FROM publicaciones p,publicaciones v, solicitudes s,estatus e,usuarios u WHERE $valor_id LIKE p.idusuario AND p.Descripcion <>'Portada' AND p.Descripcion <>'Predeterminada' AND $valor_id LIKE u.idusuario AND '$nombre' LIKE CONCAT(u.Nombre, ' ', u.Apellido) AND v.idusuario LIKE $valor_id AND v.Foto IS NOT null AND v.Descripcion <> 'Portada' ORDER BY fecha DESC";
				return $res = $this->db->query($todo);
			}
		}
	}
?>