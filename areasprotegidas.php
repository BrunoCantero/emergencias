<?php
    $title ="AREAS PROTEGIDAS | ";
    include "head.php";
    include "sidebar.php"; 
?>
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_area.php");
                        include("modal/upd_area.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Areas Protegidas</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- Form search -->
                        <form class="form-horizontal" role="form" id="ingresos">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre del area" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>     
                        <!-- end Form search -->


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

<script type="text/javascript" src="js/areas_protegidas.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_area.php",
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
        $("div.alert").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
    });
})

// success

$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_area.php",
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

    function obtener_datos(id_area_protegida){
            var fecha_alta_area_mod = $("#fecha_alta_area_mod"+id_area_protegida).val();
            var razon_social_area = $("#razon_social_area"+id_area_protegida).val();
            var rela_categoria = $("#rela_categoria"+id_area_protegida).val();
            var cuit_area = $("#cuit_area"+id_area_protegida).val();
            var titular_area = $("#titular_area"+id_area_protegida).val();
            var domicilio_area = $("#domicilio_area"+id_area_protegida).val();
            var detalles_area = $("#detalles_area"+id_area_protegida).val();
            var precio_facturar_area = $("#precio_facturar_area"+id_area_protegida).val();
            var telefono_area = $("#telefono_area"+id_area_protegida).val();
            var email_area = $("#email_area"+id_area_protegida).val();
            var status_id = $("#status_id"+id_area_protegida).val();
            
            $("#mod_id").val(id_area_protegida);
            $("#mod_fecha_alta_area").val(fecha_alta_area_mod);
            $("#mod_razon_social_area").val(razon_social_area);
            $("#mod_rela_categoria").val(rela_categoria);
            $("#mod_cuit_area").val(cuit_area);
            $("#mod_titular_area").val(titular_area);
            $("#mod_domicilio_area").val(domicilio_area);
            $("#mod_detalles_area").val(detalles_area);
            $("#mod_precio_facturar_area").val(precio_facturar_area);
            $("#mod_telefono_area").val(telefono_area);
            $("#mod_email_area").val(email_area);
            $("#mod_status_id").val(status_id);
        }


</script>