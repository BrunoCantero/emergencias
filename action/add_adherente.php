<?php	
	session_start();

	if (empty($_POST['nombre_adherente'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['nombre_adherente']) 
		){
	//$user_id=$_SESSION['user_id'];
		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		
		$rela_afiliado= $_POST['rela_afiliado'];
		$nombre_adherente= $_POST['nombre_adherente'];
		$fecha_nacimiento_adherente=$_POST["fecha_nacimiento_adherente"];
		$dni_adherente=$_POST["dni_adherente"];
		$sexo_adherente=$_POST["sexo_adherente"];
		$patologias_adherente=$_POST["patologias_adherente"];

//$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));

		$sql="INSERT INTO sys_afiliados_adherentes (rela_afiliado,nombre_adherente,fecha_nacimiento_adherente,dni_adherente,sexo_adherente,patologias_adherente) value ('$rela_afiliado', '$nombre_adherente', '$fecha_nacimiento_adherente','$dni_adherente','$sexo_adherente','$patologias_adherente')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu Adherente ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>