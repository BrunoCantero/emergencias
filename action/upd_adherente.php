<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre_adherente'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['mod_nombre_adherente'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		//recibo los campos del modal para insertarlos en el update
		$id=$_POST['mod_id'];
		$nombre_adherente=$_POST["mod_nombre_adherente"];
		$rela_afiliado = $_POST["mod_rela_afiliado"];
		$dni_adherente = $_POST["mod_dni_adherente"];
		$fecha_nacimiento_adherente = $_POST["mod_fecha_nacimiento_adherente"];
		$patologias_adherente = $_POST["mod_patologias_adherente"];
		$sexo_adherente = $_POST["mod_sexo_adherente"];


		$sql ="update sys_afiliados_adherentes set nombre_adherente ='$nombre_adherente',rela_afiliado ='$rela_afiliado',dni_adherente ='$dni_adherente',fecha_nacimiento_adherente ='$fecha_nacimiento_adherente',patologias_adherente ='$patologias_adherente',sexo_adherente ='$sexo_adherente' WHERE id_afiliado_adherente=$id";
//echo $sql;
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El ADHERENTE ha sido actualizado satisfactoriamente.";
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