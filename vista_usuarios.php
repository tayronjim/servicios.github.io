<?php 
	include("conectMySQL.php");
	$IDEmpresa=$_GET['idempresa'];
 ?>
<select>
	<option>Usuario</option>
	<option>Todos</option>
	<?php 
		$usuario = usuarios($IDEmpresa);
		while($row = mysqli_fetch_array($usuario)) { 
	  		echo "<option value='" . $row["id_equipo"] . "'>" . $row["usuario"] . "</option>"; 
	  	}
 	?>
</select>
<br><br>
Listado de Usuarios