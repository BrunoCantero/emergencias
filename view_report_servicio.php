<?php
    $title ="detalle de servicios | ";
    include "head.php";
    include "sidebar.php";
    
?>

    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>detalle de servicios</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form seach -->
                
                        
<?php
            $rela_afiliado = $_GET['rela_afiliado'];
            $fecha_despacho_desde = $_GET['fecha_despacho_desde'];
            $fecha_despacho_hasta = $_GET['fecha_despacho_hasta'];

            $sql_cab = mysqli_query($con, "select * from sys_afiliados where id_afiliado=$rela_afiliado");
            if($row=mysqli_fetch_array($sql_cab)) {

                $nombre_afiliado=$row['nombre_afiliado'] . ' ' . $row['apellido_afiliado'];
                $numero_afiliad=$row['numero_afiliado'];
            }
?>

<div class="container">
<strong>Numero Afiliado :</strong> <?php echo $numero_afiliad; ?>       <strong> Titular: </strong>  <?php echo $nombre_afiliado; ?> 
  <h2>Reporte de Servicios</h2>
  <p></p>            
  <table class="table">
    <thead>
      <tr>
        <th>Fecha Servicio</th>
        <th>Servicio desde</th>
        <th>Servicio desde</th>
      </tr>
    </thead>
<?php         
            $query ="select * from sys_despachos where rela_afiliado='$rela_afiliado' and fecha_despacho between '$fecha_despacho_desde' and '$fecha_despacho_hasta'";
            $result = $con->query($query);
            while($c=mysqli_fetch_array($result)) {
                                $fecha_despacho = $c['fecha_despacho'];
                                $desde_despacho = $c['desde_despacho'];
                                $hasta_despacho = $c['hasta_despacho'];
                            
?>
    <tbody>
    <div>
      <tr class="even pointer">
        <td><?php echo $fecha_despacho; ?></td>
        <td><?php echo $desde_despacho; ?></td>
        <td><?php echo $hasta_despacho; ?></td>
      </tr>
      
    
<?php
                            }
                            //end while
?>
        </tbody>
    </div>
  </table>
</div>
                        <!-- end form seach -->


                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
