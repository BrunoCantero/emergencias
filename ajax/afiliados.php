<?php
session_start();
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
   // include "../head.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from sys_afiliados where id_afiliado='".$id_del."'");
       // echo $query;
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"DELETE FROM sys_afiliados WHERE id_afiliado='".$id_del."'")){
?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php 
            }else {
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
    <?php
            } //end else
        } //end if
    ?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        // $b = mysqli_real_escape_string($con,(strip_tags($_REQUEST['b'], ENT_QUOTES)));
         //$b= $_REQUEST['b'];
         //echo $b;
         $aColumns = array('nombre_afiliado','apellido_afiliado','numero_afiliado','numero_documento_afiliado');//Columnas de busqueda
         $sTable = "sys_afiliados";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by fecha_creacion desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 50; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
        //main query to fetch the data
        $sql="SELECT *  FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">N° </th>
                        <th class="column-title">Nombre/Apellido </th>
                        <th class="column-title">N° DNI </th>
                        <th class="column-title">Plan </th>
                        <th class="column-title">Precio plan </th>
                        <th class="column-title">Obra Social</th>
                        <th class="column-title">Telefono</th>
                        <th class="column-title">Activo? </th>
                        <th>Fecha Registro</th>
                        <th class="column-title">Direccion</th>
                        <th class="column-title">Adherentes</th>
                        <th class="column-title">Observaciones</th>
                        <th class="column-title">Patologias</th>
                  
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id_afiliado=$r['id_afiliado'];
                            $fecha_creacion=date('d/m/Y', strtotime($r['fecha_creacion']));
                            $nombre_afiliado=$r['nombre_afiliado'];
                            $apellido_afiliado=$r['apellido_afiliado'];
                            $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado;
                            $obrasocial_afiliado=$r['obrasocial_afiliado'];
                            $telefono_afiliado=$r['telefono_afiliado'];
                            $numero_afiliado=$r['numero_afiliado'];
                            $numero_documento_afiliado=$r['numero_documento_afiliado'];
                            $fecha_nacimiento_afiliado=$r['fecha_nacimiento_afiliado'];
                            $observaciones_afiliado=htmlspecialchars_decode( $r['observaciones_afiliado']);
                            $direccion_afiliado=$r['direccion_afiliado'];
                            $rela_planes=$r['rela_planes'];
                            $rela_tipo_cobro=$r['rela_tipo_cobro'];
                            $status_id=$r['status_id'];
                            $precio_plan=$r['precio_plan'];
                            $patologias_afiliado=$r['patologias_afiliado'];
                           // $view_id_afiliado=$r['id_afiliado'];


                            $sql = mysqli_query($con, "select * from sys_planes where Id_planes=$rela_planes");
                            if($c=mysqli_fetch_array($sql)) {
                                $nombre_plan=$c['nombre_plan'];
                            }
                             $sql = mysqli_query($con, "select count(*) as count_adherentes from sys_afiliados_adherentes where rela_afiliado=$id_afiliado");
                            if($c=mysqli_fetch_array($sql)) {
                                $count_adherentes=$c['count_adherentes'];
                            }

                        $sql = mysqli_query($con, "select * from sys_tipo_cobro where Id_tipo_cobro=$rela_tipo_cobro");
                          if($c=mysqli_fetch_array($sql)) {
                          $descripcion_cobro=$c['descripcion_cobro'];
                           }
                                 /* $sql = mysqli_query($con, "select * from obras_sociales where id_obrasocial=$rela_obrasocial");
                            if($c=mysqli_fetch_array($sql)) {
                                $nombre_obrasocial=$c['nombre_obrasocial'];
                            }
*/
                            $sql = mysqli_query($con, "select * from status where id=$status_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_status=$c['name'];
                            }


                ?>
                    <input type="hidden" value="<?php echo $id_afiliado;?>" id="id<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $nombre_afiliado;?>" id="nombre_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $apellido_afiliado;?>" id="apellido_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $rela_planes;?>" id="rela_planes<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $rela_tipo_cobro;?>" id="rela_tipo_cobro<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $fecha_nacimiento_afiliado;?>" id="fecha_nacimiento_afiliado<?php echo $id_afiliado;?>">
   


                    <!-- me obtiene los datos -->
                    <input type="hidden" value="<?php echo $numero_documento_afiliado;?>" id="numero_documento_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $numero_afiliado;?>" id="numero_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $observaciones_afiliado;?>" id="observaciones_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $patologias_afiliado;?>" id="patologias_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $nombre_plan;?>" id="nombre_plan<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $telefono_afiliado;?>" id="telefono_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $precio_plan;?>" id="precio_plan<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $obrasocial_afiliado;?>" id="obrasocial_afiliado<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $name_status;?>" id="name_status<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $fecha_creacion;?>" id="fecha_creacion<?php echo $id_afiliado;?>">
                    <input type="hidden" value="<?php echo $direccion_afiliado;?>" id="direccion_afiliado<?php echo $id_afiliado;?>">


                    <tr class="even pointer">
                        <td><?php echo $numero_afiliado;?></td>
                        <td><?php echo $nombre_completo;?></td>
                        <td><?php echo $numero_documento_afiliado; ?></td>
                        <td><?php echo $nombre_plan;?></td>
                        <td>$<?php echo $precio_plan;?></td>
                        <td><?php echo $obrasocial_afiliado;?></td>
                        <td><?php echo $telefono_afiliado;?></td>
                        <td><a <?php if($status_id=="2"){echo " class=\"glyphicon glyphicon-remove \" style=\"color:#FF0000;\" width=\"15\" height=\"15\"";}else{echo "class=\"glyphicon glyphicon-ok\" style=\"color:#4b44ff;\" ";}?> > </td>
                        <td><?php echo $fecha_creacion;?></td>
                        <td><?php echo $direccion_afiliado;?></td>
                        <td><a href="view_details.php?id=<?php echo $id_afiliado;?>" class='btn btn-default' onclick="obtener_adherentes();" > <i class="glyphicon glyphicon-zoom-in"></i><?php echo $count_adherentes;?></a> </td>
                        <td><?php echo $observaciones_afiliado;?></td>
                        <td><?php echo $patologias_afiliado;?></td>

<!--<?php/* 

                            $id_session=$_SESSION['user_id'];

$query_s=mysqli_query($con,"SELECT rela_perfil from user where id=$id_session");
$row_user=mysqli_fetch_array($query_s); 
    $rela_perfil=$row_user['rela_perfil'];
    */
                        ?>
-->


<!--
<?php 
/*$datatarget= "";

     if($rela_perfil=="2" || $rela_perfil=="3")
      $datatarget.=".bs-example-modal-lg-udp_";
  else
    $datatarget.= ".bs-example-modal-lg-udp";
                        */
                        ?>

-->
   <td ><span class="pull-right">  
                       <a href="#" class='btn btn-primary' title='Visualizar Afiliado'   onclick="view_afiliado('<?php echo $id_afiliado;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-view"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="#" class='btn btn-warning' title='Editar Afiliado'   <?php  

$id=$_SESSION['user_id'];
    $query_user=mysqli_query($con,"SELECT * from user where id=$id");
   while( $row_user=mysqli_fetch_array($query_user)){
     $rela_perfil = $row_user['rela_perfil'];
   }
if($rela_perfil=="2")
{
   echo  $onclick  ="onclick=\"alert('no tiene permiso')\""; 
   echo  $disabled=" disabled readonly ";
}
elseif($rela_perfil=="1")
{

echo $onclick="onclick=\"obtener_datos(  $id_afiliado)\"";
   echo $datatarget= "data-target= \".bs-example-modal-lg-udp\"  ";     

}
  ?>    data-toggle="modal" ><i class="glyphicon glyphicon-edit"></i></a> 

                        <a href="#" class='btn btn-danger' title='Borrar Afiliado' 
                        <?php  

$id=$_SESSION['user_id'];
    $query_user=mysqli_query($con,"SELECT * from user where id=$id");
   while( $row_user=mysqli_fetch_array($query_user)){
     $rela_perfil = $row_user['rela_perfil'];
   }
if($rela_perfil=="2")
{
   echo  $onclick  ="  "; 
   echo  $disabled=" disabled readonly ";     
}
elseif($rela_perfil=="1")
{

echo $onclick="onclick=\"eliminar(  $id_afiliado)\"";

}
  ?>  ><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                       

                        
                    </tr>
                   
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=13>
                        <span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>