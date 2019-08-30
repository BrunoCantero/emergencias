<?php	
	session_start();

	if (empty($_POST['razon_social_area'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['razon_social_area']) 
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		//$created_at=date("Y-m-d H:i:s");

		$razon_social_area=$_POST["razon_social_area"];
		$fecha_alta_area=$_POST['fecha_alta_area'];
		$rela_categoria=$_POST['rela_categoria'];
		$cuit_area=$_POST['cuit_area'];
		$titular_area=$_POST['titular_area'];
		$domicilio_area=$_POST['domicilio_area'];
		$telefono_area=$_POST['telefono_area'];
		$email_area=$_POST['email_area'];
		$status_id=$_POST['status_id'];
		$detalles_area=$_POST['detalles_area'];
		$precio_facturar_area=$_POST['precio_facturar_area'];
		//$archivo_adjunto = $_FILES['archivo_adjunto']['name'];
       // $adjunto_tmp = $_FILES['archivo_adjunto']['tmp_name'];
        //$ruta = "documentos/" . $archivo_adjunto;
        //$archivo_adjunto="/documentos/".$archivo_adjunto;
		// move_uploaded_file($adjunto_tmp, "../documentos/".$archivo_adjunto);

 /*if(isset($archivo_adjunto)){
        if(!empty($archivo_adjunto)){      
            //$location = '../documentos/';   
            @move_uploaded_file($adjunto_tmp, "documentos/".$archivo_adjunto);   
            if(move_uploaded_file($adjunto_tmp, $ruta)){
                echo 'File uploaded successfully';
            }
        }       
    }  else {
        echo 'You should select a file to upload !!';
    }
*/

		$sql="INSERT INTO sys_areas_protegidas (razon_social_area,fecha_alta_area,rela_categoria,cuit_area,titular_area,domicilio_area,telefono_area,email_area,status_id,detalles_area,precio_facturar_area) VALUES ('$razon_social_area','$fecha_alta_area','$rela_categoria','$cuit_area','$titular_area','$domicilio_area','$telefono_area','$email_area','$status_id','$detalles_area','$precio_facturar_area')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu AREA PROTEGIDA ha sido ingresado satisfactoriamente.";
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