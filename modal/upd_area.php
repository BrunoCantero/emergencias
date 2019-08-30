    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Area</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd">
                        <div id="result2"></div>
                        <input type="hidden" id="mod_id" name="mod_id">
                       <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">fecha alta <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 ">
                              <input name="mod_fecha_alta_area" id="mod_fecha_alta_area"  class="form-control col-md-7 col-xs-12" required type="date" value=" ">
                            </div>
                        </div>                   
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre/Razón Social<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" required name="mod_razon_social_area" id="mod_razon_social_area" class="form-control" placeholder="">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categoría
                           <span class="required">*</span> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="mod_rela_categoria" id="mod_rela_categoria" >
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($categorias as $ca):?>
                                        <option value="<?php echo $ca['id_categoria']; ?>"><?php echo $ca['nombre_categoria']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                     <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cuit<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" required name="mod_cuit_area" id="mod_cuit_area" class="form-control" placeholder="Cuit">
                            </div>
                    </div>
                     <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titular o responsable<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text"  name="mod_titular_area" id="mod_titular_area" class="form-control" placeholder="Titular o responsable">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Domicilio<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea  required name="mod_domicilio_area" id="mod_domicilio_area" class="form-control" placeholder="Dirección"></textarea>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle de servicios<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea  required name="mod_detalles_area" id="mod_detalles_area" class="form-control" placeholder="Detalle o descripción del servicio"></textarea>
                            </div>
                    </div>
                     <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Precio a Facturar<span class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="text" required name="mod_precio_facturar_area" id="mod_precio_facturar_area" class="form-control" placeholder="">
                            </div>
                    </div>
                     <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" required name="mod_telefono_area" id="mod_telefono_area" class="form-control" placeholder="">
                            </div>
                    </div>
                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo Electrónico<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="email" required name="mod_email_area" id="mod_email_area" class="form-control" placeholder="">
                            </div>
                    </div>   
                  <!--  <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Documento</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="file"  id="archivo_adjunto"  accept=".doc" >
                            </div>
                    </div> 
                    --> 
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-9">
                                <select class="form-control" name="mod_status_id" id="mod_status_id" >
                                  <?php foreach($statuses as $st):?>
                                    <option value="<?php echo $st['id']; ?>"><?php echo $st['name']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->