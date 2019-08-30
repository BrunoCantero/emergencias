<?php
    $title ="Afiliados | ";
    include "head.php";
    include "sidebar.php";
?>

    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_atencion.php");
                        //include("modal/upd_atencion.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Atenciones en Base</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form seach -->
                        <form class="form-horizontal" role="form" id="afiliados">
                                <div class="form-group row">
                                    <label for="q" class="col-md-2 control-label">Nombre Particular /N° Atencion</label>
                                     <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Ingrese su busqueda" onkeyup='load(1);'>
                                    </div>
                                    <!--<label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">estado
                           <span class="required">*</span> </label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <select class="form-control" id="b" onkeyup='load(1);' >
                                    <option selected=""  value="">-- Selecciona --</option>
                                      <?php foreach($statuses as $st):?>
                                        <option value="<?php echo $st['status_id'];?>"><?php echo $st['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>-->
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar
                                    </button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>
                
                        <!-- end form seach -->


                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
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

<script type="text/javascript" src="js/atenciones_base.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_atencion.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
  $('.modal').on('hidden.bs.modal', function(){ 
        $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
        $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
    });

})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_atencion.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

$.fn.modal.Constructor.prototype.enforceFocus = function () {
            $('#rela_afiliado').select2({
    minimumInputLength: 2
    
    

         });  
         $('#rela_adherente').select2({
    minimumInputLength: 2

         });  
        }


$('.modal').on('hidden.bs.modal', function(){
    location.reload();
 });
</script>