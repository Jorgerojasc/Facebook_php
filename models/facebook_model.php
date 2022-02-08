<?php
	/**
    * @author Jorge Rojas C.       
    */
	class facebook_model extends Model
	{

		function insertar_registros($nombre,$apellido,$correo,$password,$sexo,$edad,$conectado)
		{
			/*Comprobamos si ya existe el correo*/
			$where_comprobar = "'$correo' LIKE Correo";
			$comprobar_correo = $this->db->select("Correo","usuarios",$where_comprobar);

			if($comprobar_correo == "No se encontro ningun registro"){
				$_SESSION["correo"] = 1;
				$arrayregistro = array('Nombre' =>$nombre ,'Apellido'=>$apellido,'Correo'=>$correo, 'Password'=>$password,'Sexo'=>$sexo,'Edad'=>$edad, 'Conectado'=>$conectado );
				$this->db->insert($arrayregistro,"usuarios");
				$orderBy = "idusuario DESC";
				$id = $this->db->select("idusuario","usuarios",'',$orderBy);
				$extraer_id= json_encode($id[0]);
				$id_reciente = json_decode($extraer_id);
				$valor_id = $id_reciente->{'idusuario'};
				$where_comprobar = "'$correo' LIKE Correo";
				if ($sexo == "Mujer") {
					$ruta_foto = "http://localhost/Betas/public/images/Woman.jpg";
					$descripcion = "Predeterminada";
					$arraypredeterminada = array('Foto' => $ruta_foto,
						'Descripcion'=>$descripcion,'idusuario'=>$valor_id);
					$this->db->insert($arraypredeterminada,"publicaciones");
					$usuarior = array('idUR' => $valor_id );
					$this->db->insert($usuarior,"usuarior");
					return $valor_id;
				}
				else{
					$ruta_foto = "http://localhost/Betas/public/images/Man.jpg";
					$descripcion = "Predeterminada" ;
					$arraypredeterminada = array('Foto' => $ruta_foto,
						'Descripcion'=>$descripcion,'idusuario'=>$valor_id );
					$this->db->insert($arraypredeterminada,"publicaciones");
					$usuarior = array('idUR' => $valor_id );
					$this->db->insert($usuarior,"usuarior");
					return $valor_id;

				}
				
			}
			else{
				return 'No';
			}
		}
		function foto_registrado(){
			$orderBy = "idusuario DESC";
			$id = $this->db->select("Foto","publicaciones",'',$orderBy);
			$extraer_Foto= json_encode($id[0]);
			$Foto_ruta = json_decode($extraer_Foto);
			$string_Foto = $Foto_ruta->{'Foto'};
			return $string_Foto;
		}
		function foto_logeado($id_usuario){
			$where = "idusuario = $id_usuario AND Descripcion LIKE 'Predeterminada' ";
			$foto_id = $this->db->select("Foto","publicaciones",$where);
			$extrar_foto = json_encode($foto_id);
			$decodificar_foto = json_decode($extrar_foto);
			$ruta_foto_usuario = $decodificar_foto->{'Foto'};
			return $ruta_foto_usuario;

		}
		function login_usuario($correo,$password){
			$arraylogin = array('Correo' =>$correo ,'Password'=>$password );
			$where_updte = "'$correo' LIKE Correo AND '$password' LIKE Password";
			$arrayupdate = array('Conectado' => 1 );
			$update = $this->db->update($arrayupdate,"usuarios",$where_updte);
			$condicion = " Correo LIKE '$correo' AND Password LIKE '$password'";
			return $this->db->select("Correo, Password, Nombre, Apellido, idusuario","usuarios",$condicion);
		}
		function busqueda_amigo($nombre,$buscador){
			if ($nombre != "") {
				$condicion = "CONCAT(u.Nombre,' ',u.Apellido) LIKE '%".$nombre."%' AND nombre != '$buscador' AND p.idusuario = u.idusuario AND p.Descripcion LIKE 'Predeterminada' ";
				return $this->db->select("CONCAT(u.Nombre, ' ', u.Apellido) As nombre, p.Foto as foto","usuarios u, publicaciones p",$condicion);
				
			}
		}
	}
?>