<?php
    //session_start();
    //$obras_sociales =mysqli_query($con, "select * from obras_sociales");
    $statuses =mysqli_query($con, "select * from status");
    $tipo_doc =mysqli_query($con, "select * from sys_tipo_doc");
    $medio_pago =mysqli_query($con, "select * from sys_tipo_cobro");
    $planes =mysqli_query($con, "select * from sys_planes");


?>
 <?php  

$id=$_SESSION['user_id'];
    $query_user=mysqli_query($con,"SELECT * from user where id=$id");
   while( $row_user=mysqli_fetch_array($query_user)){
     $rela_perfil = $row_user['rela_perfil'];
   }
if($rela_perfil=="1" || $rela_perfil=="3")
{
 echo $button_agregar=" <div> <!-- Modal -->
        <button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg-add\"><i class=\"fa fa-plus-circle\"></i> Agregar Afiliado</button>
    </div>   ";
}
elseif($rela_perfil=="2")
{


}
  ?> 
    
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Afiliado</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre/Apellido<span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="nombre_afiliado" class="form-control" placeholder="Nombre" >
                            </div>
                             <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="apellido_afiliado" class="form-control" placeholder="Apellido" >
                            </div>

                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Nro Afiliado<span class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="number" name="numero_afiliado" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doc Tipo
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="rela_tipo_doc" >
                                      <?php foreach($tipo_doc as $p):?>
                                        <option value="<?php echo $p['id_tipo_doc']; ?>"><?php echo $p['descripcion']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="number" name="numero_documento_afiliado" class="form-control" placeholder="numero" >
                            </div>
                        </div>
                         <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">fecha nacimiento <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 ">
                              <input name="fecha_nacimiento_afiliado" class="form-control col-md-7 col-xs-12" required type="date" value=" <?php echo  $fecha=date("m-d-Y"); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Plan
                           <span class="required">*</span> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="rela_planes" >
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($planes as $p):?>
                                        <option value="<?php echo $p['Id_planes']; ?>"><?php echo $p['nombre_plan']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Precio<span class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="text" name="precio_plan" class="form-control" placeholder="0.00" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="direccion_afiliado" class="form-control" placeholder="Direccion" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="observaciones_afiliado" class="form-control col-md-7 col-xs-12"  placeholder="Observaciones"></textarea>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Patologias<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="patologias_afiliado" class="form-control" placeholder="Patologias" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Medio de pago
                           <span class="required">*</span> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="rela_tipo_cobro" >
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($medio_pago as $mp):?>
                                        <option value="<?php echo $mp['Id_tipo_cobro'];?>"><?php echo $mp['descripcion_cobro']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono/celular<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="telefono_afiliado" class="form-control" placeholder="Numero" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Obra social<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="obrasocial_afiliado" class="form-control" placeholder="obra social" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="status_id" >
                                  <?php foreach($statuses as $st):?>
                                    <option value="<?php echo $st['id']; ?>"><?php echo $st['name']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                     <!--   <div class="form-group">
                            <span class="btn btn-my-button btn-file ">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                            Subir foto de afiliado: <input type="file" name="imagen_afiliado">
                            </form>
                        </span>
                        <div id="respuesta"></div>
                        </div> 
                       -->
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->