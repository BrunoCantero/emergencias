<?php	
	session_start();
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	
	//$user_id=$_SESSION['user_id'];
		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		
	    $rela_afiliado= $_POST['rela_afiliado'];
	    $rela_user= $_POST['rela_user'];
		$rela_adherente= $_POST['rela_adherente'];
		$fecha_despacho=date("Y-m-d");		
		//$fecha_despacho_end= date($fecha_despacho,"Y-m-d");
		$hora_llamada=date("H:i");
		$rela_codigo=$_POST["rela_codigo"];
		$rela_medicos=$_POST["rela_medicos"];
		$rela_moviles=$_POST["rela_moviles"];
		$desde_despacho=$_POST["desde_despacho"];
		$hasta_despacho=$_POST["hasta_despacho"];
		$socio=$_POST ["socio"];
		$no_afiliado=$_POST ["no_afiliado"];
	if ($rela_afiliado!=="" && $rela_adherente=="")
//$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));

   {     $sql="INSERT INTO sys_despachos (rela_user,fecha_despacho,hora_llamada,rela_afiliado,rela_medicos,rela_moviles,rela_codigo,desde_despacho,hasta_despacho,socio) value ('$rela_user','$fecha_despacho', '$hora_llamada', '$rela_afiliado','$rela_medicos','$rela_moviles','$rela_codigo','$desde_despacho','$hasta_despacho','$socio')";
		$query_new_insert = mysqli_query($con,$sql);
	}
	else if($rela_afiliado=="" && $rela_adherente!=="") {
		$sql="INSERT INTO sys_despachos (rela_user,fecha_despacho,hora_llamada,rela_adherente,rela_medicos,rela_moviles,rela_codigo,desde_despacho,hasta_despacho,socio) value ('$rela_user','$fecha_despacho', '$hora_llamada','$rela_adherente','$rela_medicos','$rela_moviles','$rela_codigo','$desde_despacho','$hasta_despacho','$socio')";
		$query_new_insert = mysqli_query($con,$sql);
	}
	
	else if($rela_afiliado!=="" && $rela_adherente!=="") {
echo $errors[] = "<div class='alert alert-danger' role='alert'>				<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Debe seleccionar un afiliado o un adherente, No ambos!</strong>	 </div>	";
		exit;
	}
	else if($rela_afiliado=="" && $rela_adherente=="") {
		$sql="INSERT INTO sys_despachos (rela_user,fecha_despacho,hora_llamada,no_afiliado,rela_medicos,rela_moviles,rela_codigo,desde_despacho,hasta_despacho,socio) value ('$rela_user','$fecha_despacho', '$hora_llamada','$no_afiliado','$rela_medicos','$rela_moviles','$rela_codigo','$desde_despacho','$hasta_despacho','$socio')";
		$query_new_insert = mysqli_query($con,$sql);
	}
			if ($query_new_insert){
				$messages[] = "Tu Despacho ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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