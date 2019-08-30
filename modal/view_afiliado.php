<?php
    $projects =mysqli_query($con, "select * from project");
    $priorities =mysqli_query($con, "select * from priority");
    $statuses =mysqli_query($con, "select * from status");
    $kinds =mysqli_query($con, "select * from kind");
    $categories =mysqli_query($con, "select * from category");

    /*$select_upd=mysqli_query($con,"select * from sys_afiliados where id_afiliado=$id")
     if($row=mysqli_fetch_array($select_upd)) {
            $id_afiliado=$row['id_afiliado'];
            $fecha_creacion=date('d/m/Y', strtotime($r['fecha_creacion']));
            $nombre_afiliado=$row['nombre_afiliado'];
            $apellido_afiliado=$row['apellido_afiliado'];
            $nombre_completo=$nombre_afiliado . ' ' .  $apellido_afiliado;
            $obrasocial_afiliado=$row['obrasocial_afiliado'];
            $telefono_afiliado=$row['telefono_afiliado'];
            $numero_afiliado=$row['numero_afiliado'];
            $numero_documento_afiliado=$row['numero_documento_afiliado'];
            $fecha_nacimiento_afiliado=$row['fecha_nacimiento_afiliado'];
            $observaciones_afiliado=$row['observaciones_afiliado'];
            $direccion_afiliado=$row['direccion_afiliado'];
            $rela_planes=$row['rela_planes'];
            $rela_tipo_cobro=$row['rela_tipo_cobro'];
            $status_id=$row['status_id'];
            $precio_plan=$row['precio_plan'];
            $patologias_afiliado=$row['patologias_afiliado'];
        }
        */
?>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                  <h4 class="modal-title" id="myModalLabel">Ver Afiliado</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="view" name="view">
                        <div id="resultl3"></div>
                          <input type="hidden" id="view_id" disabled name="view_id">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre/Apellido<span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="view_nombre_afiliado" id="view_nombre_afiliado" disabled class="form-control" >
                            </div>
                             <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="text" name="view_apellido_afiliado" id="view_apellido_afiliado" disabled class="form-control"  >
                            </div>

                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Nro Afiliado<span class="required" >*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="number" name="view_numero_afiliado" disabled id="view_numero_afiliado" readonly class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doc Tipo
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" disabled name="view_rela_tipo_doc"  >
                                      <?php foreach($tipo_doc as $p):?>
                                        <option value="<?php echo $p['id_tipo_doc']; ?>"><?php echo $p['descripcion']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                              <input type="number" name="view_numero_documento_afiliado" disabled  id="view_numero_documento_afiliado" class="form-control" >
                            </div>
                        </div>
                         <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">fecha nacimiento <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <input name="view_fecha_nacimiento_afiliado" disabled id="view_fecha_nacimiento_afiliado" class="form-control col-md-7 col-xs-12" required type="date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Plan
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="view_rela_planes" disabled id="view_rela_planes" >
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($planes as $p):?>
                                        <option value="<?php echo $p['Id_planes']; ?>"><?php echo $p['nombre_plan']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Precio<span  class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="text" name="view_precio_plan" id="view_precio_plan" disabled class="form-control"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="view_direccion_afiliado" id="view_direccion_afiliado" disabled class="form-control"  value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="view_observaciones_afiliado" type="textarea" id="view_observaciones_afiliado" disabled class="form-control col-md-7 col-xs-12"  ></textarea>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Patologias<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="view_patologias_afiliado" id="view_patologias_afiliado" disabled class="form-control"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Medio de pago
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="view_rela_tipo_cobro" disabled id="view_rela_tipo_cobro" >
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
                              <input type="number" name="view_telefono_afiliado" id="view_telefono_afiliado" disabled class="form-control" placeholder="Numero" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Obra social<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="view_obrasocial_afiliado"  id="view_obrasocial_afiliado" disabled class="form-control" placeholder="obra social" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="view_status_id" disabled id="view_status_id"  >
                                    <option selected="" value="">-- Selecciona --</option>
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
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->