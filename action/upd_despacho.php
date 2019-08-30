<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } 
		  else if (
			!empty($_POST['mod_hora_salida'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos


        $id=$_POST["mod_id"];
        $hora_salida = $_POST["mod_hora_salida"];
        $hora_llegada = $_POST["mod_hora_llegada"];
        $hora_finalizacion = $_POST["mod_hora_finalizacion"];

		echo $sql = "update sys_despachos set hora_salida='$hora_salida',hora_llegada='$hora_llegada',hora_finalizacion='$hora_finalizacion'
	  where id_despacho=$id";
	//echo $sql;
		$query_update = mysqli_query($con,$sql);
			if ($query_update){

				//$messages[] = "El afiliado ha sido actualizado satisfactoriamente.";
				echo '<div class="alert alert-succes" role="alert"><strong>Hora ingresada</strong> ';
			} else{
				echo  ' <div class="alert alert-danger" role="alert"><strong> Algo ha salido mal</strong> ';
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		

?>