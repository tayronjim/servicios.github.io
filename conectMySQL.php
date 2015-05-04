<?php 
	
	function conectDB(){
		$link = mysqli_connect("localhost","root","root","servicios_soporte") or die("Error " . mysqli_error($link)); 
		return $link;
	}

	function desconectDB($link){
		mysqli_close($link);
	}

	function empresas(){
		$link = conectDB();
		$result = $link->query("SELECT * FROM empresa");
		desconectDB($link);
		return $result;
	}
	
	function listaServicios(){
		$link = conectDB();
		$result = $link->query("SELECT * FROM servicios");
		desconectDB($link);
		return $result;
	}

	function usuarios($IDEmpresa){
		$link = conectDB();
		$result = $link->query("SELECT * FROM usuarios WHERE id_empresa=".$IDEmpresa);
		desconectDB($link);
		return $result;
	}

	function usuario($IDUsuario){
		$link = conectDB();
		if($IDUsuario==0){
			$result = $link->query("SELECT id,usuario FROM usuarios");
		}
		else{
			$result = $link->query("SELECT id,usuario FROM usuarios WHERE id=".$IDUsuario);
		}
		
		desconectDB($link);
		return $result;
	}

	function buscaServicios($IDUsuario){
		$link = conectDB();
		$query = "
		SELECT 
			servicios.id,servicios.servicio, realizado.fecha 
		FROM servicios 
			left join serv_realizados as realizado 
			on realizado.id_serv = servicios.id and realizado.fecha = (SELECT max(fecha) from serv_realizados where realizado.`id_serv` = id_serv order by id_equipo) and realizado.id_equipo=(SELECT id_equipo FROM usuarios WHERE id=".$IDUsuario.")
		GROUP BY servicios.id";
		$result = $link->query($query);
		desconectDB($link);
		return $result;
	}

	function insertaServicios($query){
		$link = conectDB();
		$result = $link->query($query);
		desconectDB($link);
		return $result;
	}

?>