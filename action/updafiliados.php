<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_nombre_afiliado'])){
			$errors[] = "Nombre vacio";
		} else if (empty($_POST['mod_apellido_afiliado'])){
			$errors[] = "Apellido vacío";
		}  else if (
			!empty($_POST['mod_nombre_afiliado']) &&
			!empty($_POST['mod_apellido_afiliado'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos



	$numero_afiliado = $_POST["mod_numero_afiliado"];
	$nombre_afiliado = $_POST["mod_nombre_afiliado"];
	$apellido_afiliado = $_POST["mod_apellido_afiliado"];
	$rela_tipo_doc = $_POST["mod_rela_tipo_doc"];
	$numero_documento_afiliado = $_POST["mod_numero_documento_afiliado"];
	$fecha_nacimiento_afiliado = $_POST["mod_fecha_nacimiento_afiliado"];
	$rela_planes = $_POST["mod_rela_planes"];
	$precio_plan = $_POST["mod_precio_plan"];
	$direccion_afiliado = $_POST["mod_direccion_afiliado"];
	$observaciones_afiliado = $_POST["mod_observaciones_afiliado"];
	$patologias_afiliado = $_POST["mod_patologias_afiliado"];
	$rela_tipo_cobro = $_POST["mod_rela_tipo_cobro"];
	$telefono_afiliado = $_POST["mod_telefono_afiliado"];
	$obrasocial_afiliado = $_POST["mod_obrasocial_afiliado"];
	$status_id = $_POST["mod_status_id"];
	$id=$_POST["mod_id"];

		$sql = "update sys_afiliados set nombre_afiliado='$nombre_afiliado',apellido_afiliado='$apellido_afiliado',rela_tipo_doc='$rela_tipo_doc',
		numero_afiliado='$numero_afiliado',numero_documento_afiliado='$numero_documento_afiliado',fecha_nacimiento_afiliado='$fecha_nacimiento_afiliado',rela_planes='$rela_planes',precio_plan='$precio_plan',direccion_afiliado='$direccion_afiliado',observaciones_afiliado='$observaciones_afiliado' ,patologias_afiliado='$patologias_afiliado',rela_tipo_cobro='$rela_tipo_cobro',telefono_afiliado='$telefono_afiliado',obrasocial_afiliado='$obrasocial_afiliado',status_id='$status_id'  where id_afiliado=$id";
	//echo $sql;
		$query_update = mysqli_query($con,$sql);
			if ($query_update){

				//$messages[] = "El afiliado ha sido actualizado satisfactoriamente.";
				echo '<div class="alert alert-succes" role="alert"><strong>El afiliado ha sido actualizado satisfactoriamente!</strong> ';
			} else{
				echo  ' <div class="alert alert-danger" role="alert"><strong> Lo siento algo ha salido mal intenta nuevamente</strong> ';
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		

?>