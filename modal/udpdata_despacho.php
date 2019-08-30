    <!-- Modal -->


    <div class="modal fade bs-example-modal-lg-udpd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-pencil"></i> Asignar horario despacho</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd2" name="upd2">
                        <div id="result3"></div>
                        <input type="hidden" name="mod_id" id="mod_id">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">hora salida 
                            </label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <input name="mod_hora_salida" id="mod_hora_salida"  class="form-control col-md-7 col-xs-12" type="time" >
                          </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">hora llegada 
                            </label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <input name="mod_hora_llegada" id="mod_hora_llegada" class="form-control col-md-7 col-xs-12"  type="time" >
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">hora finalización
                            </label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <input name="mod_hora_finalizacion" id="mod_hora_finalizacion" class="form-control col-md-7 col-xs-12"  type="time" >
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