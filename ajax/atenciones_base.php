<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from sys_atenciones_base where id_atencion='".$id_del."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM sys_atenciones_base WHERE id_atencion='".$id_del."'")){
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
              <strong>Error!</strong> No se pudo eliminar esta atencion . Existen gastos vinculadas a ésta categoria. 
            </div>
<?php
        } //end else
    } //end if
?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('id_atencion','no_afiliado');//Columnas de busqueda
         $sTable = "sys_atenciones_base";
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
        $sWhere.=" order by id_atencion desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 100; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './antecion_base.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                    <th class="column-title">N°
                     Atencion </th>
                     <th class="column-title">Recepcionista</th>
                     <th class="column-title">Fecha</th>
                     <th class="column-title">Hora</th>
                    <th class="column-title">Medico </th>
                    <th class="column-title">Particular </th>
                    <th class="column-title">Afiliado </th>
                    <th class="column-title">Obra Social </th>
                    <th class="column-title">Motivo Consulta </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($r=mysqli_fetch_array($query)) {
                        $id_atencion=$r['id_atencion'];
                        $fecha_atencion= date('d/m/Y', strtotime($r['fecha_atencion']));
                        $hora_atencion= date('H:i:s', strtotime($r['hora_atencion']));
                        $rela_medicos = $r['rela_medicos'];
                        $rela_afiliado = $r['rela_afiliado'];
                        $rela_adherente = $r['rela_adherente'];
                        $motivo_consulta = $r['motivo_consulta'];
                        $obra_social = $r['obra_social'];
                        $no_afiliado = $r['no_afiliado'];
                        $rela_user = $r['rela_user'];
                        
                        
                        $sql = mysqli_query($con, "select name from user where id=$rela_user");
                        if($c=mysqli_fetch_array($sql)) {
                            $username=$c['name'];
                           
                        }
                     //busco por adherente para setear en la tabla, caso contrario busco y seteo el afiliado 
                     if($no_afiliado=="")   {
                     if($rela_adherente!=="" && $rela_afiliado==""){

                            $nombre_completo="";
                            $sql = mysqli_query($con, "select nombre_adherente from sys_afiliados_adherentes where id_afiliado_adherente=$rela_adherente");
                            if($c=mysqli_fetch_array($sql)) {
                                $nombre_completo=$c['nombre_adherente'];
                            }

                        }
                        else{

                            $sql = mysqli_query($con, "select apellido_afiliado,nombre_afiliado from sys_afiliados where id_afiliado=$rela_afiliado");
                            if($c=mysqli_fetch_array($sql)) {
                                $apellido_afiliado=$c['apellido_afiliado'];
                                $nombre_afiliado=$c['nombre_afiliado'];
                                $nombre_completo=$apellido_afiliado . ' ' .  $nombre_afiliado;
                            }

                        }
                    }

                            if($rela_medicos!==""){
                                $nombre_apellido_medico="";

                            $sql = mysqli_query($con, "select nombre_apellido_medico from sys_medicos where id_medico=$rela_medicos" );
                            if($c=mysqli_fetch_array($sql)) {
                                $nombre_apellido_medico=$c['nombre_apellido_medico'];
                               
                            }
                        }
                        else if($rela_medicos==""){
                            $sql = mysqli_query($con, "select nombre_apellido_medico from sys_medicos where id_medico=1");
                            if($c=mysqli_fetch_array($sql)) {
                                $nombre_apellido_medico=$c['nombre_apellido_medico'];
                        }
                    }
                ?>
                    <input type="hidden" value="<?php echo $id_despacho;?>" id="id_atencion<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $fecha_atencion;?>" id="fecha_atencion<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $hora_atencion;?>" id="hora_atencion<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $rela_afiliado;?>" id="rela_afiliado<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $rela_adherente;?>" id="rela_adherente<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $rela_medicos;?>" id="rela_medicos<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $no_afiliado;?>" id="no_afiliado<?php echo $id_atencion;?>">
                    <input type="hidden" value="<?php echo $motivo_consulta;?>" id="motivo_consulta<?php echo $id_atencion;?>">
                    <tr class="even pointer">

                  
                    <td width="30" ><?php echo $id_atencion; ?></td>
                    <td ><?php echo $username; ?></td>
                    <td ><?php echo $fecha_atencion; ?></td>
                    <td ><?php echo $hora_atencion; ?></td>
                    <td ><?php echo $nombre_apellido_medico; ?></td>
                    <td ><?php echo $no_afiliado; ?></td>
                    <td ><?php if($no_afiliado=="" && $nombre_completo!=="") {echo $nombre_completo;} ?></td>                   
                    <td ><?php echo $obra_social; ?></td>
                    <td ><?php echo $motivo_consulta; ?></td>

                    <td ><span class="pull-right">
                        
                  <!--  <a href="#" class='btn btn-default' title='Editar atencion' onclick="obtener_datos('<?php  $id_atencion;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> -->
                    <a href="#" class='btn btn-danger' title='Borrar atencion' onclick="eliminar('<?php echo $id_atencion; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
            <?php
                } //end while
            ?>
                <tr>
               
                    <td colspan=10><span class="pull-right">
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
              <strong>Aviso!</strong> No hay datos para mostrar
            </div>
        <?php    
        }
    }
?>
