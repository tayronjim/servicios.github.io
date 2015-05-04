<!DOCTYPE html>
<?php
include("conectMySQL.php");
?>
<html>
<head>
	<title>Servicios</title>
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
		$IDEmpresa = 0;
		$(document).ready(function(){

			$("#listado_empresas").change(function(){
	 			if($("#listado_empresas").val()>0){
	 				$("#infoMenu").html("<body></body>");
	 				$("#menu").show();
	 				$IDEmpresa = $("#listado_empresas").val();

	 				// alert($IDEmpresa);
	 			}
	 			if($("#listado_empresas").val()==0){
	 				$("#menu").hide();
	 				$("#infoMenu").html("<body></body>");
	 			}
			});


			$("#menu1").click(function(){
				alert("Atrasos");
			});
			$("#menu2").click(function(){
				$("#infoMenu").load('vista_usuarios.php?idempresa='+$IDEmpresa);
			});
			$("#menu3").click(function(){
				$("#infoMenu").load('vista_registros.php?idempresa='+$IDEmpresa);
			});
			$("#menu4").click(function(){
				
				$("#infoMenu").load('vista_checklist.php?idempresa='+$IDEmpresa);
			});
		});

	</script>
</head>
<body>
Control de servicios
<br>
<select id="listado_empresas">
	<option value="0">Empresas</option>
	<?php 
		$empresas = empresas();
		while($row = mysqli_fetch_array($empresas)) { 
	  		echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>"; 
	  	}
	 ?>
</select>
<div id="menu" hidden><ul><li><a href="#" id="menu1">Atrasos</a></li><li><a href="#" id="menu2">Usuarios</a></li><li><a href="#" id="menu3">Registros</a></li><li><a href="#" id="menu4">Registrar</a></li></ul></div>
<div id="infoMenu"></div>
</body>
</html>