<?php
require ("../db_config.php");

//sleep(5);

$id = $_POST['id'];

$sql = "SELECT id FROM personas where user_id ='".$id."';";

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
if ($total>0) {
	$row=mysqli_fetch_row($result);
    $sql = "SELECT id,estado_chofer FROM chofer where persona_id ='".$row[0]."';";
    $result = mysqli_query($con, $sql);
	$total = mysqli_num_rows($result);
	if ($total>0) {
		$row=mysqli_fetch_row($result);
		if ($row[1] == null) {
			$sql="UPDATE chofer 
				  SET estado_chofer = 'libre'
				  WHERE id = '".$row[0]."';";
			$result = mysqli_query($con, $sql);
			if ($result) {
				echo 'Estado: LIBRE';
			}else{
				echo "No se pudo cambiar tu estado a de desconectado a libre";
			}
		}else if ($row[1] == 'libre') {
			$sql="UPDATE chofer 
				  SET estado_chofer = null
				  WHERE id = '".$row[0]."';";
			$result = mysqli_query($con, $sql);
			if ($result) {
				echo 'Estado: DESCONECTADO';
			}else{
				echo "No se pudo cambiar tu estado a de libre a desconectado";
			}
		}else if ($row[1] == 'En viaje') {
			$sql="UPDATE chofer 
				  SET estado_chofer = 'libre'
				  WHERE id = '".$row[0]."';";
			$result = mysqli_query($con, $sql);
			if ($result) {
				echo 'Estado: LIBRE';
			}else{
				echo "No se pudo cambiar tu estado a de libre a desconectado";
			}
		}
	}else{
		echo "No se encontró el id de persona en la tabla chofer";
	}
}else{
	echo "No se encontró el id de usuario en la tabla personas";
}

//Cierro
mysqli_close($con);

?>