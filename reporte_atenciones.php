<?php
    $title ="Reportes | ";
    include "head.php";
    include "sidebar.php";

    $searchAfiliados = mysqli_query($con, "select * from sys_afiliados");
    $searchAdherentes = mysqli_query($con, "select * from sys_afiliados_adherentes");
    $search = mysqli_query($con,  "select * from priority");
    $statuses = mysqli_query($con, "select * from status");
   
?>  


    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reporte de Atenciones</h2>
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
                                  <input type="date" name="fecha_atencion_desde" value="<?php if(isset($_GET["fecha_atencion_desde"]) && $_GET["fecha_atencion_desde"]!=""){ echo $_GET["fecha_atencion_desde"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">HASTA</span>
                                  <input type="date" name="fecha_atencion_hasta" value="<?php if(isset($_GET["fecha_atencion_hasta"]) && $_GET["fecha_atencion_hasta"]!=""){ echo $_GET["fecha_atencion_hasta"]; } ?>" class="form-control" placeholder="Palabra clave">
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
                        <th>Recepcionista</th>
                        <th>Afiliado</th>
                        <th>Particular</th>
                        <th>Fecha</th>
                        <th>Hora</th>

                        </thead>


 <?php 
            //evitamos undefined index
            if(!isset($_GET['rela_afiliado']) && !isset($_GET['fecha_atencion_desde']) &&  !isset($_GET['fecha_atencion_hasta'])){

                echo' <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> No hay datos para mostrar!
                </div>';

            }
            //buscamos atenciones de un afiliado en especifico en un rango de fechas
           else if ($_GET['rela_afiliado']!="" && $_GET['fecha_atencion_desde']!="" && $_GET['fecha_atencion_hasta']!=""){
                $rela_afiliado = $_GET['rela_afiliado'];
                $fecha_atencion_desde = $_GET['fecha_atencion_desde'];
                $fecha_atencion_hasta = $_GET['fecha_atencion_hasta'];
          echo  $sql_r ="select * from sys_atenciones_base inner join sys_afiliados on id_afiliado=rela_afiliado inner join user on id=rela_user where rela_afiliado='$rela_afiliado' and fecha_atencion between '$fecha_atencion_desde' and '$fecha_atencion_hasta' ORDER BY id_atencion DESC ";
            $res = $con->query($sql_r);
            $count_servicios = 0;
            $count_servicios = mysqli_num_rows($res);
            echo " <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Cantidad de Atenciones Realizados: $count_servicios</strong> 
            </div>  ";
             while( $row=mysqli_fetch_array($res))  {
                $nombre_afiliado = $row['nombre_afiliado'];
                $apellido_afiliado = $row['apellido_afiliado'];
                $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado;
                $fecha_atencion_db = $row['fecha_atencion'];              
                $hora_atencion = $row['hora_atencion'];              
                $no_afiliado = $row['no_afiliado'];              
                           
                $nombre_recepcionista = $row['name'];              
?>
    <tbody>
                <tr class="even pointer">
                <td><?php echo $nombre_recepcionista; ?></td>
                <td><?php echo $nombre_completo; ?></td>
                <td><?php echo $no_afiliado; ?></td>
                <td><?php echo date('d/m/Y',strtotime($fecha_atencion_db)); ?></td>
                <td><?php echo date('H:i:s',strtotime($hora_atencion)); ?></td>
                </tr>
<?php  
                
                }//end while
            } //end if
            // si no se selecciona afiliado buscar todos los despachos por fecha
            else if($_GET['rela_afiliado']=="" && $_GET['rela_adherente']=="" && $_GET['fecha_atencion_desde']!="" && $_GET['fecha_atencion_hasta']!=""){
                $fecha_atencion_desde = $_GET['fecha_atencion_desde'];
                $fecha_atencion_hasta = $_GET['fecha_atencion_hasta'];
                    $sql_r ="select * from sys_atenciones_base inner join user on id=rela_user where fecha_atencion between '$fecha_atencion_desde' and '$fecha_atencion_hasta' ORDER BY id_atencion DESC";
                            $res = $con->query($sql_r);
                            $count_servicios = 0;
                            $count_servicios = mysqli_num_rows ($res);
                                    echo " <div class='alert alert-success alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <strong>Cantidad de Atenciones Realizadas: $count_servicios</strong> 
                                </div>  ";

             while( $row=mysqli_fetch_array($res))  {
                
                $fecha_atencion_db = $row['fecha_atencion'];              
                $nombre_recepcionista = $row['name'];
                $rela_afiliado = $row['rela_afiliado'];
                $rela_adherente = $row['rela_adherente'];
                $no_afiliado = $row['no_afiliado'];
                $hora_atencion = $row['hora_atencion'];

                if($rela_afiliado!="" && $rela_adherente==""){
                    // 
                          $nombre_completo="";
                          $sql = mysqli_query($con, "select nombre_afiliado, apellido_afiliado from sys_afiliados where id_afiliado=$rela_afiliado");
                          if($c=mysqli_fetch_array($sql)) {
                            $nombre_afiliado=$c['nombre_afiliado'];
                            $apellido_afiliado=$c['apellido_afiliado'];
                            $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado .' '. "(Titular)";
                        }
      
                      }
                elseif($rela_adherente!="" && $rela_afiliado==""){
              // 
                    $nombre_completo="";
                    $sql = mysqli_query($con, "select nombre_adherente from sys_afiliados_adherentes where id_afiliado_adherente=$rela_adherente");
                    if($c=mysqli_fetch_array($sql)) {
                        $nombre_adherente=$c['nombre_adherente'];
                        $nombre_completo = $nombre_adherente .  ' '  .  "(Adherente)";
                    }

                }
                else if ($rela_adherente=="" && $rela_afiliado=="" && $no_afiliado!=="")
                {
                    $nombre_completo="";
                    
                }
              
     ?>
                           <tbody>
            <tr class="even pointer">
        <td><?php echo $nombre_recepcionista; ?></td>
        <td><?php echo $nombre_completo; ?></td>
        <td><?php echo $no_afiliado; ?></td>
        <td><?php echo date('d/m/Y',strtotime($fecha_atencion_db)); ?></td>
        <td><?php echo date('H:i:s',strtotime($hora_atencion)); ?></td>
                </tr>
  <?php
             } //end second while
     } //end second if
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
