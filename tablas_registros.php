<?php 
	include("conectMySQL.php");
	$IDEmpresa=$_GET['idempresa'];
	$IDUsuario=$_GET['idusuario'];
 ?>

		<?php 
			$resUsuario = usuario($IDUsuario);
			while($row = mysqli_fetch_array($resUsuario)) { 
		?>
				<table border="1">
		  		<tr><td colspan="2"><?php echo $row["usuario"]; ?></td></tr>
		  		<tr>
					<td>
						SERVICIO
					</td>
					<td>FECHA</td>
				</tr>
				<?php
				$resServicios = buscaServicios($row["id"]);
				while($rowS = mysqli_fetch_array($resServicios)) { 
					echo "<tr><td>".$rowS['servicio']."</td><td>".$rowS['fecha']."</td></tr>";
				}
				?>
				
			</table>
		<?php
		  	}
		 ?>