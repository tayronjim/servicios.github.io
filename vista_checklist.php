<?php 
	include("conectMySQL.php");
	$IDEmpresa=$_GET['idempresa'];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<script type="text/javascript">
 	$(document).ready(function(){
 		$("#listadoUsuarios").change(function(){
 			if($("#listadoUsuarios").val()>0){
 				$("#tablaCheckList").show();
 			}
 			if($("#listadoUsuarios").val()==0){
 				$("#tablaCheckList").hide();
 				$('input[type="checkbox"]').attr('checked',false);
 				$('input[type="date"]').val('');
 			}
		});
 	});

 	function checkCheckbox(){
 			$error=0;
 			$query = "insert into serv_realizados (fecha,id_serv,id_empresa,id_equipo) values ";
 			$('input[type="checkbox"]:checked').each(function() {
				//$(this).val() es el valor del checkbox correspondiente
				//alert($(this).attr('id'));
				$checkID = $(this).attr('id');
				$ID = $checkID.substring($checkID.length-1);
				$fila = $(this).parent().parent();
				$texto = $("#col3_2").children().attr('id');
				$fecha = $("#date_"+$ID).val();
				$servID = $("#servID_"+$ID).attr('id').substring($checkID.length);
				if($fecha==""){alert("fecha vacia"); $error=1; return;}
				$query  = $query + "('"+ $fecha +"',"+$servID+","+$("#listado_empresas").val()+","+$("#listadoUsuarios").val()+"),";
				// alert($("#date_"+$ID).val());
				// alert($("#servID_"+$ID).attr('id'));
				// insert into serv_realizados (fecha,id_serv,id_empresa,id_equipo) values ('2000-01-20',1,1,1),('2000-02-20',3,1,1);
			});
			if($error==0){
				$query = $query.substring(0,$query.length-1)+";";
	 			llamadaAjax($query);
			}
			else{
				switch($error){
					case 1: alert("Hay una fecha vacia");
					break;
					default: alert("Ocurrio un error");
				}
			}
 	}

 	function llamadaAjax($query){
	    $.ajax({
	        type: "POST",
	        url: "selector.php",
	        data: {valueFunction: 'insertaServicios', query : $query},
	        success: function( respuesta ){
	                alert($query);
	     }});
	}
 	</script>
 </head>
 <body>
 	<select id="listadoUsuarios">
	<option value="0">Usuarios</option>
<?php 
	$usuario = usuarios($IDEmpresa);
	while($row = mysqli_fetch_array($usuario)) { 
  		echo "<option value='" . $row["id_equipo"] . "'>" . $row["usuario"] . "</option>"; 
  	}
 ?>
</select>
<br><br>
 	<table id="tablaCheckList" border="1" hidden>
 		<tr>
 			<td></td>
 			<td> Fecha </td>
 			<td> Servicio </td>
 		</tr>
 		<?php 
 			$resultado = listaServicios();
 			$valID=0;
 			while($row = mysqli_fetch_array($resultado)) { 
 				$valID++;
 				?>
 				<tr id="<?php echo 'row_' . $valID; ?>">
 					<td id="<?php echo 'col1_' . $valID; ?>"> <input id="<?php echo 'check_' . $valID; ?>" type='checkbox'> </td>
		 			<td id="<?php echo 'col2_' . $valID; ?>"> <input id="<?php echo 'date_' . $valID; ?>" type='date'> </td>
 					<td id="<?php echo 'col3_' . $valID; ?>"> <label id="<?php echo 'servID_' . $row['id']; ?>"><?php echo $row["servicio"]; ?></label>  </td>
		  		</tr>
		<?php
		  	}
 		?>
 		 <tr>
 			<td colspan="3" align="right"> <input type="button" value="Enviar" onclick="checkCheckbox()"> </td>
 		</tr>
 	</table>
 
 </body>
 </html>