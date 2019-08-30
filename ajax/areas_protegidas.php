
<?php
    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from sys_areas_protegidas where id_area_protegida='".$id_del."'");
        $count=mysqli_num_rows($query);
            if ($delete1=mysqli_query($con,"DELETE FROM sys_areas_protegidas WHERE id_area_protegida='".$id_del."'")){
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
         $aColumns = array('razon_social_area','cuit_area','titular_area');//Columnas de busqueda
         $sTable = "sys_areas_protegidas";
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
        $sWhere.=" order by id_area_protegida desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './areasprotegidas.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Fecha Alta </th>
                        <th class="column-title">Razón Social </th>
                        <th class="column-title">Cuit </th>
                        <th class="column-title">Titular </th>
                        <th class="column-title">Categoría </th>
                        <th class="column-title">Activo? </th>
                        <th class="column-title">Precio a Facturar </th>
                        <th class="column-title">Telefono </th>
                        <th class="column-title">Domicilio </th>
                        <th class="column-title">Email </th>
                        <th class="column-title">Adjunto </th>
                        <th class="column-title no-link last "><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id_area_protegida=$r['id_area_protegida'];
                            $fecha_alta_area=date('d/m/Y', strtotime($r['fecha_alta_area']));
                            $razon_social_area=$r['razon_social_area'];
                            $rela_categoria=$r['rela_categoria'];
                            $cuit_area=$r['cuit_area'];
                            $titular_area=$r['titular_area'];
                            $domicilio_area=$r['domicilio_area'];
                            $telefono_area=$r['telefono_area'];
                            $email_area=$r['email_area'];
                            $status_id=$r['status_id'];
                            $archivo_adjunto=$r['archivo_adjunto'];
                            $precio_facturar_area=round($r['precio_facturar_area'],2);
                            $detalles_area=$r['detalles_area'];
                            $fecha_alta_area_mod=$r['fecha_alta_area'];

                           // $description=$r['description'];

                             $sql = mysqli_query($con, "select * from sys_categorias where id_categoria=$rela_categoria");
                          if($c=mysqli_fetch_array($sql)) {
                          $nombre_categoria=$c['nombre_categoria'];
                           }
                ?>
                    <input type="hidden" value="<?php echo $id_area_protegida;?>" id="id_area_protegida<?php echo $id_area_protegida;?>">
                    <input type="hidden" value="<?php echo $razon_social_area;?>" id="razon_social_area<?php echo $id_area_protegida;?>">
                    <input type="hidden" value="<?php echo $fecha_alta_area;?>" id="fecha_alta_area<?php echo $id_area_protegida;?>">
                  
                    <input type="hidden" value="<?php echo $rela_categoria;?>" id="rela_categoria<?php echo $id_area_protegida;?>">
                    
                    <input type="hidden" value="<?php echo $cuit_area;?>" id="cuit_area<?php echo $id_area_protegida;?>">

                    <input type="hidden" value="<?php echo $titular_area;?>" id="titular_area<?php echo $id_area_protegida;?>">

                    <input type="hidden" value="<?php echo $domicilio_area;?>" id="domicilio_area<?php echo $id_area_protegida;?>">

                    <input type="hidden" value="<?php echo $telefono_area;?>" id="telefono_area<?php echo $id_area_protegida;?>">

                    <input type="hidden" value="<?php echo $email_area;?>" id="email_area<?php echo $id_area_protegida;?>">
                   
                    <input type="hidden" value="<?php echo $detalles_area;?>" id="detalles_area<?php echo $id_area_protegida;?>">

                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id_area_protegida;?>">
                   
                    <input type="hidden" value="<?php echo $precio_facturar_area;?>" id="precio_facturar_area<?php echo $id_area_protegida;?>">
                    <input type="hidden" value="<?php echo $fecha_alta_area_mod;?>" id="fecha_alta_area_mod<?php echo $id_area_protegida;?>">



                    <tr class="even pointer">
                        <td ><?php echo $fecha_alta_area;?></td>
                        <td ><?php echo $razon_social_area;?></td>
                        <td ><?php echo $cuit_area;?></td>
                        <td ><?php echo $titular_area;?></td>
                        <td ><?php echo $nombre_categoria;?></td>
<td  ><a <?php if($status_id=="2"){echo " class=\"glyphicon glyphicon-remove \" style=\"color:#FF0000;\" width=\"15\" height=\"15\"";}else{echo "class=\"glyphicon glyphicon-ok\" style=\"color:#4b44ff;\" ";}?> >  </td>
                        <td ><?php echo $precio_facturar_area;?></td>
                        <td ><?php echo $telefono_area;?></td>
                        <td ><?php echo $domicilio_area;?></td>
                        <td ><?php echo $email_area;?></td>

                        <td ><a href="<?php echo $archivo_adjunto;?>" disabled class='btn btn-default' ><i class="fa fa-file-word-o"></i></a> 
                        </td>
                        
                        <td style="width: 150px"><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id_area_protegida;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id_area_protegida; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=12><span class="pull-right">
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