<?php
    $title ="Reportes | ";
    include "head.php";
    include "sidebar.php";

    $searchAfiliados = mysqli_query($con, "select * from sys_afiliados");
    $searchAdherentes = mysqli_query($con, "select * from sys_afiliados_adherentes");
    $search = mysqli_query($con,  "select * from priority");
    $statuses = mysqli_query($con, "select * from status");
    $kinds = mysqli_query($con, "select * from kind");
   
?>  
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reporte de Servicios</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <!-- form search -->
                        <form class="form-horizontal" role="form">
                            <input type="hidden" name="view" value="reports">
                            <div class="form-group">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                    <select name="rela_afiliado" id="rela_afiliado" class="form-control">
                                    <option value="">AFILIADO</option>
                                      <?php foreach($searchAfiliados as $p):?>
                                        <option value="<?php echo $p['id_afiliado']; ?>" <?php if(isset($_GET["id_afiliado"]) && $_GET["id_afiliado"]==$p['id_afiliado']){ echo "selected"; } ?>><?php echo $p['nombre_afiliado'] .' '. $p['apellido_afiliado']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                    <select name="rela_adherente" id="rela_adherente" class="form-control">
                                    <option value="">ADHERENTE</option>
                                      <?php foreach($searchAdherentes as $ad):?>
                                        <option value="<?php echo $ad['id_afiliado_adherente']; ?>" <?php if(isset($_GET["id_afiliado_adherente"]) && $_GET["id_afiliado_adherente"]==$ad['id_afiliado_adherente']){ echo "selected"; } ?>><?php echo $ad['nombre_adherente']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">DESDE</span>
                                  <input type="date" name="fecha_despacho_desde" value="<?php if(isset($_GET["fecha_despacho_desde"]) && $_GET["fecha_despacho_desde"]!=""){ echo $_GET["fecha_despacho_desde"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">HASTA</span>
                                  <input type="date" name="fecha_despacho_hasta" value="<?php if(isset($_GET["fecha_despacho_hasta"]) && $_GET["fecha_despacho_hasta"]!=""){ echo $_GET["fecha_despacho_hasta"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-primary btn-block">Procesar</button>
                                </div>
                            </div>
                        </form>
                        <!-- end form search -->
                        <?php
 


        
                        ?>
                        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                        <th>Despachante</th>
                        <th>Afiliado</th>
                        <th>codigo</th>
                        <th>Fecha de servicio</th>
                        <th>traslado desde</th>
                        <th>traslado hasta</th>
                        </thead>

 <?php 
            //evitamos undefined index
            if(!isset($_GET['rela_afiliado']) && !isset($_GET['fecha_despacho_desde']) &&  !isset($_GET['fecha_despacho_hasta'])){

                echo' <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> No hay datos para mostrar!
                </div>';

            }
            //buscamos despachos de un afiliado en especifico en un rango de fechas
           else if ($_GET['rela_afiliado']!="" && $_GET['fecha_despacho_desde']!="" && $_GET['fecha_despacho_hasta']!=""){
                $rela_afiliado = $_GET['rela_afiliado'];
                $fecha_despacho_desde = $_GET['fecha_despacho_desde'];
                $fecha_despacho_hasta = $_GET['fecha_despacho_hasta'];
            $sql_r ="select * from sys_despachos inner join sys_afiliados on id_afiliado=rela_afiliado inner join user on id=rela_user inner join codigos on Id_codigo=rela_codigo where rela_afiliado='$rela_afiliado' and fecha_despacho between '$fecha_despacho_desde' and '$fecha_despacho_hasta' ORDER BY id_despacho DESC ";
            $res = $con->query($sql_r);
            $count_servicios = 0;
            $count_servicios = mysqli_num_rows($res);
            echo " <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Cantidad de Servicios Realizados: $count_servicios</strong> 
            </div>  ";
             while( $row=mysqli_fetch_array($res))  {
                $nombre_afiliado = $row['nombre_afiliado'];
                $apellido_afiliado = $row['apellido_afiliado'];
                $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado;
                $fecha_despacho_db = $row['fecha_despacho'];              
                $desde_despacho = $row['desde_despacho'];              
                $hasta_despacho = $row['hasta_despacho'];              
                $nombre_despachante = $row['name'];  
                $codigo = $row['codigo'];  
?>
    <tbody>
                <tr class="even pointer">
                <td><?php echo $nombre_despachante; ?></td>
                <td><?php echo $nombre_completo; ?></td>
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
                    echo '<font>9000</font>';} ?> </td>                <td><?php echo date('d/m/Y',strtotime($fecha_despacho_db)); ?></td>
                <td><?php   echo $desde_despacho; ?></td>
                <td><?php   echo $hasta_despacho; ?></td>
                </tr>
<?php  
                
                }//end while
            } //end if
            // si no se selecciona afiliado buscar todos los despachos por fecha
            else if($_GET['rela_afiliado']=="" && $_GET['rela_adherente']=="" && $_GET['fecha_despacho_desde']!="" && $_GET['fecha_despacho_hasta']!=""){
                $fecha_despacho_desde = $_GET['fecha_despacho_desde'];
                $fecha_despacho_hasta = $_GET['fecha_despacho_hasta'];
            $sql_r ="select * from sys_despachos inner join user on id=rela_user inner join codigos on Id_codigo=rela_codigo where fecha_despacho between '$fecha_despacho_desde' and '$fecha_despacho_hasta' ORDER BY id_despacho DESC";
            $res = $con->query($sql_r);
            $count_servicios = 0;
            $count_servicios = mysqli_num_rows ($res);
            echo " <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Cantidad de Servicios Realizados: $count_servicios</strong> 
            </div>  ";

             while( $row=mysqli_fetch_array($res))  {
                
                $fecha_despacho_db = $row['fecha_despacho'];              
                $fecha_despacho_db = $row['fecha_despacho'];              
                $desde_despacho = $row['desde_despacho'];              
                $hasta_despacho = $row['hasta_despacho']; 
                $nombre_despachante = $row['name'];
                $rela_afiliado = $row['rela_afiliado'];
                $rela_adherente = $row['rela_adherente'];
                $codigo = $row['codigo'];
                $nombre_completo="";
                $no_afiliado = $row['no_afiliado'];            

                if($rela_adherente!="" && $rela_afiliado==""){
                    // 
                          $sql = mysqli_query($con, "select nombre_adherente from sys_afiliados_adherentes where id_afiliado_adherente=$rela_adherente");
                          $c=mysqli_fetch_array($sql);
                          $nombre_completo=$c['nombre_adherente'];
                }

                else if($rela_afiliado!="" && $rela_adherente==""){
                    // 
                          $sql = mysqli_query($con, "select nombre_afiliado, apellido_afiliado from sys_afiliados where id_afiliado=$rela_afiliado");
                            $c=mysqli_fetch_array($sql);
                            $nombre_afiliado=$c['nombre_afiliado'];
                            $apellido_afiliado=$c['apellido_afiliado'];
                            $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado;
                
                 }
                 else if ($rela_afiliado=="" && $rela_adherente=="" && $no_afiliado!=""){

                          $nombre_completo = "[NO AFILIADO]" . ' ' .  $no_afiliado;
                 }

     ?>
                           <tbody>
            <tr class="even pointer">
        <td><?php echo $nombre_despachante; ?></td>
        <td><?php echo $nombre_completo; ?></td>
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
        <td><?php echo date('d/m/Y',strtotime($fecha_despacho_db)); ?></td>
        <td><?php echo $desde_despacho; ?></td>
        <td><?php echo $hasta_despacho; ?></td>
                </tr>
  <?php
             } //end second while
     } //end second if
  

     //controlamos cada adherente
        else if($_GET['rela_adherente']!="" && $_GET['fecha_despacho_desde']!="" && $_GET['fecha_despacho_hasta']!=""){
            
            $fecha_despacho_desde = $_GET['fecha_despacho_desde'];
            $fecha_despacho_hasta = $_GET['fecha_despacho_hasta'];
            $rela_adherente = $_GET['rela_adherente'];
            $sql_r ="select * from sys_despachos left outer join sys_afiliados_adherentes on id_afiliado_adherente=rela_adherente inner join user on id=rela_user inner join codigos on Id_codigo=rela_codigo where rela_adherente='$rela_adherente' and fecha_despacho between '$fecha_despacho_desde' and '$fecha_despacho_hasta' ORDER BY id_despacho DESC";
            $res = $con->query($sql_r);
            $count_servicios = 0;
            $count_servicios = mysqli_num_rows ($res);
            echo " <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Cantidad de Servicios Realizados: $count_servicios</strong> 
            </div>  ";

                while( $row=mysqli_fetch_array($res))  {
                    
                    $fecha_despacho_db = $row['fecha_despacho'];              
                    $fecha_despacho_db = $row['fecha_despacho'];              
                    $desde_despacho = $row['desde_despacho'];              
                    $hasta_despacho = $row['hasta_despacho']; 
                    $nombre_despachante = $row['name'];
                    $rela_adherente = $row['rela_adherente'];
                    $codigo = $row['codigo'];
                    $nombre_completo="";

                    if($rela_adherente!=""){
                        // 
                            $sql = mysqli_query($con, "select nombre_adherente from sys_afiliados_adherentes where id_afiliado_adherente=$rela_adherente");
                            $c=mysqli_fetch_array($sql);
                            $nombre_completo=$c['nombre_adherente'];
                    }

     ?>
                           <tbody>
            <tr class="even pointer">
        <td><?php echo $nombre_despachante; ?></td>
        <td><?php echo $nombre_completo; ?></td>
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
        <td><?php echo date('d/m/Y',strtotime($fecha_despacho_db)); ?></td>
        <td><?php echo $desde_despacho; ?></td>
        <td><?php echo $hasta_despacho; ?></td>
                </tr>
  <?php
             } //end second while
     } //end third if
     ?> 
      
     </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
<script>

$('#rela_afiliado').select2({
    minimumInputLength: 2

         });   
$('#rela_adherente').select2({
    minimumInputLength: 2

         });   


</script>
