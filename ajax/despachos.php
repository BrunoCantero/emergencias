<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from sys_despachos where id_despacho='".$id_del."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM sys_despachos WHERE id_despacho='".$id_del."'")){
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
              <strong>Error!</strong> No se pudo eliminar ésta  categoria. Existen gastos vinculadas a ésta categoria. 
            </div>
<?php
        } //end else
    } //end if
?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('id_despacho');//Columnas de busqueda
         $sTable = "sys_despachos";
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
        $sWhere.=" order by id_despacho desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 150; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './despachos.php';
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
                     Servicio </th>
                     <th class="column-title">Despachante </th>
                    <th class="column-title">Fecha </th>
                    <th class="column-title">Medico </th>
                    <th class="column-title">Codigo </th>
                    <th class="column-title">Socio </th>
                    <th class="column-title">no Afiliado </th>
                    <th class="column-title">Afiliado </th>
                    <th class="column-title">Desde </th>
                    <th class="column-title">Hasta </th>
                    <th class="column-title">Llamada </th>
                    <th class="column-title">Salida </th>
                    <th class="column-title">Llegada </th>
                    <th class="column-title">Fin </th>
                    <th class="column-title">Movil </th>

                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($r=mysqli_fetch_array($query)) {
                        $id_despacho=$r['id_despacho'];
                        $fecha_despacho= date('d/m/Y', strtotime($r['fecha_despacho']));
                        $fecha_despacho_distinta= date('d/m/Y', strtotime($r['fecha_despacho']));
                        $socio=$r['socio'];
                        $rela_adherente=$r['rela_adherente'];
                        $rela_afiliado=$r['rela_afiliado'];
                        $rela_user=$r['rela_user'];
                        $rela_codigo=$r['rela_codigo'];
                        $rela_moviles=$r['rela_moviles'];
                        $rela_medicos=$r['rela_medicos'];
                        $hora_salida=$r['hora_salida'];
                        $hora_llegada=$r['hora_llegada'];
                        $desde_despacho=$r['desde_despacho'];
                        $hasta_despacho=$r['hasta_despacho'];
                        $hora_llamada=$r['hora_llamada'];
                        $hora_finalizacion=$r['hora_finalizacion'];
                        $no_afiliado=$r['no_afiliado'];
                        


                        $sql = mysqli_query($con, "select numero from moviles where Id_movil=$rela_moviles");
                        if($c=mysqli_fetch_array($sql)) {
                            $numero=$c['numero'];
                           
                        }
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

                            $sql = mysqli_query($con, "select numero_afiliado,apellido_afiliado,nombre_afiliado from sys_afiliados where id_afiliado=$rela_afiliado");
                            if($c=mysqli_fetch_array($sql)) {
                                $apellido_afiliado=$c['apellido_afiliado'];
                                $nombre_afiliado=$c['nombre_afiliado'];
                                $numero_afiliado=$c['numero_afiliado'];
                                $nombre_completo=$apellido_afiliado . ' ' .  $nombre_afiliado;
                            }

                        }
                    }

                            $sql = mysqli_query($con, "select codigo from codigos where Id_codigo=$rela_codigo");
                            if($c=mysqli_fetch_array($sql)) {
                                $codigo=$c['codigo'];
                               
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
                    <input type="hidden" value="<?php echo $id_despacho;?>" id="id_despacho<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $fecha_despacho;?>" id="fecha_despacho<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $nombre_apellido_medico;?>" id="socio<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $hora_salida;?>" id="hora_salida<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $hora_llegada;?>" id="hora_llegada<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $hora_finalizacion;?>" id="hora_finalizacion<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $socio;?>" id="fecha_despacho<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $socio;?>" id="fecha_despacho<?php echo $id_despacho;?>">
                    <input type="hidden" value="<?php echo $socio;?>" id="fecha_despacho<?php echo $id_despacho;?>">
                   
                    <tr class="even pointer">

                  
                    <td width="30" ><?php echo $id_despacho; ?></td>
                    <td width="30" ><?php echo $username; ?></td>
                    <td ><?php echo $fecha_despacho; ?></td>
                    <td ><?php echo $nombre_apellido_medico; ?></td>
                    <td > <?php if($codigo == "1000"){
                    echo '<font color="red">1000</font>';}
                    if($codigo == "2000"){
                    echo '<font color="yellow">2000</font>';}
                    if($codigo == "3000"){
                    echo '<font color="green">3000</font>';}
                    if($codigo == "4000"){
                    echo '<font>4000</font>';}
                    if($codigo == "5000"){
                    echo '<font>5000</font>';}
                    if($codigo == "6000"){
                    echo '<font>6000</font>';}
                    if($codigo == "7000"){
                    echo '<font>7000</font>';}
                    if($codigo == "9000"){
                    echo '<font>9000</font>';} ?> </td>
                    <td ><?php echo $socio; ?></td>
                    <td ><?php echo $no_afiliado; ?></td>
                    <td ><?php if($no_afiliado=="" && $nombre_completo!=="") {echo $nombre_completo;} ?></td>
                    <td ><?php echo $desde_despacho; ?></td>
                    <td ><?php echo $hasta_despacho; ?></td>
                    <td ><?php echo $hora_llamada; ?></td>
                    <td ><?php echo $hora_salida; ?></td>
                    <td ><?php echo $hora_llegada; ?></td>
                    <td ><?php echo $hora_finalizacion; ?></td>
                    <td ><?php echo $numero; ?></td>
                    
                        <td ><span class="pull-right">
                        
                        <a href="#" class='btn btn-<?php if($hora_finalizacion=="" || $hora_finalizacion=="00:00:00"){echo "danger";} else if($hora_finalizacion!=="" && $hora_finalizacion!=="00:00:00") {echo "success";}?>' title='Editar Horario' onclick="obtener_datos('<?php echo $id_despacho;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-time "></i></a> 
                    <?php if($hora_finalizacion==""){
    echo  " <a href='#' class='btn btn-default' title='Editar Despacho' onclick='datos_sin_guardar($id_despacho);' data-toggle='modal' data-target='.bs-example-modal-lg-udpd'><i class='glyphicon glyphicon-time '></i></a> 

            <a href='#' class='btn btn-default' title='Borrar Despacho' onclick='eliminar($id_despacho)'><i class='glyphicon glyphicon-trash'></i> </a></span></td>";
                     }

                    ?>
            
                    </tr>
            <?php
                } //end while
            ?>
                <tr>
               
                    <td colspan=16><span class="pull-right">
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