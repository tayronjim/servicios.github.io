<?php 
	include("conectMySQL.php");
	$IDEmpresa=$_GET['idempresa'];
 ?>
<script type="text/javascript">
	$IDUsuario = -1;
	$(document).ready(function(){
 		$("#filtroUsuarios").change(function(){
 			if($("#filtroUsuarios").val()>=0){
 				$IDUsuario = $("#filtroUsuarios").val();
 				$("#filtroServiciosRealizados").show();
 				$("#tablaRegistroServicios").show();
 				$("#tablaRegistroServicios").html("<body></body>");
 				$("#tablaRegistroServicios").load('tablas_registros.php?idusuario='+$IDUsuario+'&idempresa='+$IDEmpresa);
 			}
 			if($("#filtroUsuarios").val()<0){
 				$IDUsuario = $("#filtroUsuarios").val();
 				$("#tablaRegistroServicios").html("<body></body>");
 				$("#filtroServiciosRealizados").hide();
 				$("#tablaRegistroServicios").hide();
 				
 			}
		});
 	});
</script>
<select id="filtroUsuarios">
	<option value="-1">Usuario</option>
	<option value="0">Todos</option>
	<?php 
	$usuario = usuarios($IDEmpresa);
	while($row = mysqli_fetch_array($usuario)) { 
  		echo "<option value='" . $row["id_equipo"] . "'>" . $row["usuario"] . "</option>"; 
  	}
 	?>
</select>
<br><br>
Listado de Registros
<br><br>
<select id="filtroServiciosRealizados" hidden>
	<option value="ultimo">Ultimo Servicio</option>
	<option value="todos">Todos</option>
</select>
<div id="tablaRegistroServicios" hidden></div>
	