<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
include "../config/config.php";//Contiene funcion que conecta a la base de datos

//recupero las variables enviadas desde el formulario

$numero_afiliado = $_POST["numero_afiliado"];
$nombre_afiliado = $_POST["nombre_afiliado"];
$apellido_afiliado = $_POST["apellido_afiliado"];
$rela_tipo_doc = $_POST["rela_tipo_doc"];
$numero_documento_afiliado = $_POST["numero_documento_afiliado"];
$fecha_nacimiento_afiliado = $_POST["fecha_nacimiento_afiliado"];
$rela_planes = $_POST["rela_planes"];
$precio_plan = $_POST["precio_plan"];
$direccion_afiliado = $_POST["direccion_afiliado"];
$observaciones_afiliado = $_POST["observaciones_afiliado"];
$patologias_afiliado = $_POST["patologias_afiliado"];
$rela_tipo_cobro = $_POST["rela_tipo_cobro"];
$telefono_afiliado = $_POST["telefono_afiliado"];
$obrasocial_afiliado = $_POST["obrasocial_afiliado"];
$status_id = $_POST["status_id"];
$fecha_creacion=date("Y-m-d H:m:i");
 
//valido si no se repite el numero de afiliados 
if($numero_afiliado!=""){
		$rq=mysqli_query($con,"select numero_afiliado from sys_afiliados where numero_afiliado=$numero_afiliado ");
		$rownum=mysqli_num_rows($rq);
		//echo $rownum;
	   if($rownum=mysqli_num_rows($rq)>0){
			$errors []= "Lo siento ya existe un afiliado con ese numero.".mysqli_error($con);
			echo '<div class="alert alert-danger" role="alert"><strong>Lo siento ya existe un afiliado con ese numero!</strong> ';
		}
		else{

$sql="insert into sys_afiliados (nombre_afiliado,apellido_afiliado,numero_afiliado,rela_tipo_doc,numero_documento_afiliado,fecha_nacimiento_afiliado,rela_planes,precio_plan,direccion_afiliado,observaciones_afiliado,patologias_afiliado,rela_tipo_cobro,telefono_afiliado,obrasocial_afiliado,status_id,fecha_creacion) 
		value ('$nombre_afiliado','$apellido_afiliado','$numero_afiliado','$rela_tipo_doc','$numero_documento_afiliado','$fecha_nacimiento_afiliado','$rela_planes',
		'$precio_plan','$direccion_afiliado','$observaciones_afiliado','$patologias_afiliado','$rela_tipo_cobro','$telefono_afiliado','$obrasocial_afiliado','$status_id','$fecha_creacion')";
      //  echo $sql;
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu afiliado ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
	/* else {
			$errors []= "Error desconocido.";
		}*/
		
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

	}
}


	/*if (empty($_POST['nombre_afiliado'])) {
           $errors[] = "error";
        } else if (empty($_POST['apellido_afiliado'])){
			$errors[] = "error";
		} else if (
			!empty($_POST['nombre_afiliado']) &&
			!empty($_POST['apellido_afiliado'])
		){

		*/
		



		

		// $user_id=$_SESSION['user_id'];
?>