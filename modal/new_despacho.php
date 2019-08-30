<?php
    $moviles =mysqli_query($con, "select * from moviles");
    $codigos =mysqli_query($con, "select * from codigos");
    $afiliados_rela =mysqli_query($con, "select * from sys_planes inner join sys_afiliados on rela_planes=Id_planes ");
    $adherentes_rela =mysqli_query($con, "select * from sys_afiliados_adherentes inner join sys_afiliados on rela_afiliado=id_afiliado inner join sys_planes on rela_planes=Id_planes");
    $medicos_rela =mysqli_query($con, "select id_medico,nombre_apellido_medico from sys_medicos");

    $user_id = $_SESSION['user_id'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar despacho</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo despacho</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">despachante
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="rela_user" >
                                        <option value="<?php echo $_SESSION['user_id']; ?>"><?php echo $name; ?></option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                             
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">fecha <span class="required">*</span>
                            </label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <input  name="fecha_despacho"  value='<?php  echo $hoy= date("d-m-Y"); ?>' disabled readonly class="form-control col-md-7 col-xs-12" required  >
                          </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">hora llamada <span class="required">*</span>
                            </label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <input name="hora_llamada" value="<?php echo $now= date("H:i"); ?>" disabled  readonly class="form-control col-md-7 col-xs-12" required type="time">
                          </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Afiliado Titular
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control " id="rela_afiliado" style="width:100%" name="rela_afiliado" >
                                     <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($afiliados_rela as $ar):?>
                                        <option value="<?php echo $ar['id_afiliado']; ?>"><?php echo $ar['nombre_plan']; ?> - <?php echo $ar['apellido_afiliado']; ?> <?php echo $ar['nombre_afiliado']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Adherente
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control " id="rela_adherente" style="width:100%" name="rela_adherente" >
                                     <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($adherentes_rela as $p):?>
                                        <option value="<?php echo $p['id_afiliado_adherente']; ?>"><?php echo $p['nombre_plan']; ?> - <?php echo $p['nombre_adherente']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Socio
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-4">
                              <input name="socio"  class="form-control col-md-7 col-xs-12"  type="text" placeholder="socio">
                         
                              </div>
                        </div>
                        <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">No Afiliado
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-4">
                              <input name="no_afiliado"  class="form-control col-md-7 col-xs-12"  type="text" placeholder="Particuar o no afiliado">
                         
                              </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">codigo
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="rela_codigo" >
                                      <?php foreach($codigos as $c):?>
                                        <option value="<?php echo $c['Id_codigo']; ?>"><?php echo $c['codigo']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">movil
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="rela_moviles" id="rela_moviles" >
                                      <?php foreach($moviles as $m):?>
                                        <option value="<?php echo $m['Id_movil']; ?>"><?php echo $m['numero']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Medico 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="rela_medicos"  >
                                      <?php foreach($medicos_rela as $p):?>
                                        <option value="<?php echo $p['id_medico']; ?>"><?php echo $p['nombre_apellido_medico']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        
                        
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">desde <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-10">
                              <input name="desde_despacho"  class="form-control col-md-7 col-xs-12" required type="text" placeholder="desde">
                         </div>
                        </div>
                        <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">hasta <span class="required">*</span>
                              </label>
                           <div class="col-md-9 col-sm-9 col-xs-10">
                              <input name="hasta_despacho" class="form-control col-md-7 col-xs-12" required type="text" placeholder="hasta">
                         
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