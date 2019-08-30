<?php	
	session_start();
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	
	//$user_id=$_SESSION['user_id'];
		include "../config/config.php";//Contiene funcion que conecta a la base de datos
		
	    $rela_afiliado= $_POST['rela_afiliado'];
	    $rela_user= $_POST['rela_user'];
		$rela_adherente= $_POST['rela_adherente'];
		$fecha_atencion=date("Y-m-d");		
		$hora_atencion=date("H:i:s");		
		//$fecha_despacho_end= date($fecha_despacho,"Y-m-d");
		$rela_medicos=$_POST["rela_medicos"];
		$obra_social=$_POST["obra_social"];
		$no_afiliado=$_POST["no_afiliado"];
        $motivo_consulta=$_POST["motivo_consulta"];
        $observaciones=$_POST["observaciones"];
        
        if ($rela_afiliado!=="" && $rela_adherente==""){
//$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
        if($no_afiliado!=="") {
        echo $errors[] = "<div class='alert alert-danger' role='alert'>				<button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>no puede ingresar un particular si ya seleccionó un afiliado!</strong>	 </div>	";
                exit;
    }
            else{
                    $sql="INSERT INTO sys_atenciones_base (rela_user,fecha_atencion,hora_atencion,rela_afiliado,rela_medicos,obra_social,motivo_consulta,observaciones) value ('$rela_user','$fecha_atencion','$hora_atencion','$rela_afiliado','$rela_medicos','$obra_social','$motivo_consulta','$observaciones')";
                    $query_new_insert = mysqli_query($con,$sql);
        }
    }   
    
	else if($rela_afiliado=="" && $rela_adherente!=="" && $no_afiliado=="") {
	echo	$sql="INSERT INTO sys_atenciones_base (rela_user,fecha_atencion,hora_atencion,rela_adherente,rela_medicos,obra_social,motivo_consulta,observaciones) value ('$rela_user','$fecha_atencion','$hora_atencion','$rela_adherente','$rela_medicos','$obra_social','$motivo_consulta','$observaciones')";
		$query_new_insert = mysqli_query($con,$sql);
    }
   
	
	else if($rela_afiliado!=="" && $rela_adherente!=="") {
echo $errors[] = "<div class='alert alert-danger' role='alert'>				<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Debe seleccionar un afiliado o un adherente, No ambos!</strong>	 </div>	";
		exit;
    }
   
            else if($rela_afiliado=="" && $rela_adherente!=="" && $no_afiliado!=="") {
                echo $errors[] = "<div class='alert alert-danger' role='alert'>				<button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>no puede ingresar un particular si ya seleccionó un afiliado!</strong>	 </div>	";
                        exit;
                    }
	else if($rela_afiliado=="" && $rela_adherente=="" && $no_afiliado!=="") {
		$sql="INSERT INTO sys_atenciones_base (rela_user,fecha_atencion,hora_atencion,no_afiliado,rela_medicos,obra_social,motivo_consulta,observaciones) value ('$rela_user','$fecha_atencion','$hora_atencion','$no_afiliado','$rela_medicos','$obra_social','$motivo_consulta','$observaciones')";
		$query_new_insert = mysqli_query($con,$sql);
	}
			if ($query_new_insert){
				$messages[] = "Tu Atencion ha sido ingresado satisfactoriamente.";
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