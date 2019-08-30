<?php

$afiliados_rela = mysqli_query($con, "select id_afiliado,numero_afiliado,apellido_afiliado,nombre_afiliado from sys_afiliados");


?>

    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Nuevo Adherente</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Adherente</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Titular
                           <span class="required">*</span> </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control " id="rela_afiliado" style="width:100%" name="rela_afiliado" >
                                     <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($afiliados_rela as $ar):?>
                                        <option value="<?php echo $ar['id_afiliado']; ?>"><?php echo $ar['numero_afiliado']; ?> - <?php echo $ar['apellido_afiliado']; ?> <?php echo $ar['nombre_afiliado']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos/Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" required name="nombre_adherente" class="form-control" placeholder="Apellido y Nombre del adherente">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">fecha nacimiento <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 ">
                              <input name="fecha_nacimiento_adherente" class="form-control col-md-7 col-xs-12" required type="date" value=" <?php echo  $fecha=date("m-d-Y"); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">N° DNI<span class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <input type="text" name="dni_adherente" class="form-control" placeholder="" >
                            </div>
                        </div>
                       <div class=" form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6" for="first-name">Sexo
                            </label>
                          <div class="col-md-2 col-sm-2 col-xs-12">

                            <select class="form-control" required name="sexo_adherente">
                                    <option value="" selected></option>
                                    <option value="1" >M</option>
                                    <option value="0" >F</option>  
                            </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Patologías <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="patologias_adherente" class="date-picker form-control col-md-7 col-xs-12" required></textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
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


