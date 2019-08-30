<?php
    $title ="detalle de afiliados | ";
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
                            <h2>detalle de afiliados</h2>
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
            $id = $_GET['id'];

            $sql_cab = mysqli_query($con, "select * from sys_afiliados where id_afiliado=$id");
            if($row=mysqli_fetch_array($sql_cab)) {

                $nombre_afiliado=$row['nombre_afiliado'] . ' ' . $row['apellido_afiliado'];
                $numero_afiliad=$row['numero_afiliado'];
            }
?>

<div class="container">
<strong>Numero Afiliado :</strong> <?php echo $numero_afiliad; ?>       <strong> Titular: </strong>  <?php echo $nombre_afiliado; ?> 
  <h2>Adherentes</h2>
  <p></p>            
  <table class="table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Patologias</th>
      </tr>
    </thead>
<?php         
            $sql = mysqli_query($con, "select * from sys_afiliados_adherentes inner join sys_afiliados on id_afiliado=rela_afiliado where rela_afiliado=$id");
                            while($c=mysqli_fetch_array($sql)) {
                                $nombre_adherente = $c['nombre_adherente'];
                                $dni_adherente = $c['dni_adherente'];
                                $patologia_adherente = $c['patologias_adherente'];
                            
?>
    <tbody>
    <div>
      <tr class="even pointer">
        <td><?php echo $nombre_adherente; ?></td>
        <td><?php echo $dni_adherente; ?></td>
        <td><?php echo $patologia_adherente; ?></td>
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
