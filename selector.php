<?php 
	include("conectMySQL.php");

	switch ($_POST['valueFunction']) {
		case 'insertaServicios':
			insertaServicios($_POST['query']);
			break;
		case 'func-2':
			echo "valueFunction-2";
			break;
		
		default:
			echo "valueFunction-default";
			break;
	}
 ?>