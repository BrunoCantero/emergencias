<?php
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from sys_afiliados_adherentes where id_afiliado_adherente='".$id_del."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM sys_afiliados_adherentes WHERE id_afiliado_adherente='".$id_del."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
    <?php 
        }else{
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
         $aColumns = array('nombre_adherente','dni_adherente');//Columnas de busqueda
         $sTable = "sys_afiliados_adherentes";
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
        $sWhere.=" order by nombre_adherente desc";
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
        $reload = './adherentes.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">N° </th>
                        <th class="column-title">Adherente </th>
                        <th class="column-title">Titular </th>
                        <th class="column-title">Dni </th>
                        <th class="column-title">Fecha nacimiento </th>
                        <th class="column-title">Sexo </th>
                        <th class="column-title">Patologias </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id_afiliado_adherente=$r['id_afiliado_adherente'];
                            $nombre_adherente=$r['nombre_adherente'];
                            $rela_afiliado=$r['rela_afiliado'];
                            $patologias_adherente=$r['patologias_adherente'];
                            $sexo_adherente=$r['sexo_adherente'];
                            $dni_adherente=$r['dni_adherente'];
                            $fecha_nacimiento_adherente=$r['fecha_nacimiento_adherente'];

                            $sql = mysqli_query($con, "select numero_afiliado,apellido_afiliado,nombre_afiliado from sys_afiliados where id_afiliado=$rela_afiliado");
                            if($c=mysqli_fetch_array($sql)) {
                                $apellido_afiliado=$c['apellido_afiliado'];
                                $nombre_afiliado=$c['nombre_afiliado'];
                                $numero_afiliado=$c['numero_afiliado'];
                                $nombre_completo=$apellido_afiliado . ' ' .  $nombre_afiliado;

                            }

                ?>
                    <input type="hidden" value="<?php echo $id_afiliado_adherente;?>" id="id<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $patologias_adherente;?>" id="patologias_adherente<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $rela_afiliado;?>" id="rela_afiliado<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $sexo_adherente;?>" id="sexo_adherente<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $nombre_adherente;?>" id="nombre_adherente<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $dni_adherente;?>" id="dni_adherente<?php echo $id_afiliado_adherente;?>">
                    <input type="hidden" value="<?php echo $fecha_nacimiento_adherente;?>" id="fecha_nacimiento_adherente<?php echo $id_afiliado_adherente;?>">


                    <tr class="even pointer">
                         <td width="100" align="left"><?php echo $numero_afiliado;?></td>
                        <td style="width: 200px"><?php echo $nombre_adherente;?></td>
                        <td><?php echo $nombre_completo;?></td>
                        <td><?php echo $dni_adherente;?></td>
                        <td><?php echo date('d/m/Y', strtotime($fecha_nacimiento_adherente));?></td>
                        <td><?php if($sexo_adherente=="1"){
                            echo "M";} 
                                 elseif($sexo_adherente=="0"){echo "F";}?></td>
                        <td><?php echo $patologias_adherente;?></td>
                       

                        <td style="width: 150px"><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id_afiliado_adherente;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id_afiliado_adherente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=8><span class="pull-right">
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