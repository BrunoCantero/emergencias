<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_razon_social_area'])) {
           $errors[] = "Razon social vacìa";
        } else if (
			!empty($_POST['mod_razon_social_area'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		$id=$_POST['mod_id'];
		$razon_social_area=$_POST["mod_razon_social_area"];
		$fecha_alta_area=$_POST['mod_fecha_alta_area'];
		$rela_categoria=$_POST['mod_rela_categoria'];
		$cuit_area=$_POST['mod_cuit_area'];
		$titular_area=$_POST['mod_titular_area'];
		$domicilio_area=$_POST['mod_domicilio_area'];
		$telefono_area=$_POST['mod_telefono_area'];
		$email_area=$_POST['mod_email_area'];
		$status_id=$_POST['mod_status_id'];
		$detalles_area=$_POST['mod_detalles_area'];
		$precio_facturar_area=$_POST['mod_precio_facturar_area'];

		$sql="update sys_areas_protegidas set fecha_alta_area ='$fecha_alta_area',razon_social_area ='$razon_social_area',rela_categoria ='$rela_categoria',cuit_area ='$cuit_area',titular_area ='$titular_area',domicilio_area ='$domicilio_area',telefono_area ='$telefono_area',email_area ='$email_area',status_id ='$status_id', detalles_area ='$detalles_area',precio_facturar_area ='$precio_facturar_area' WHERE id_area_protegida=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El Area Protegida ha sido actualizada satisfactoriamente.";
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