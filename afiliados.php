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
                        include("modal/new_afiliado.php");
                        include("modal/upd_afiliado.php");
                        include("modal/view_afiliado.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>afiliados</h2>
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
                                    <label for="q" class="col-md-2 control-label">Nombre /Apellido /DNI /N° Afiliado</label>
                                     <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Ingrese su busqueda" onkeyup='load(1);'>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">estado
                           <span class="required">*</span> </label>
                            <div class="col-md-1 col-sm-1 col-xs-1">
                                <select class="form-control" id="b" onkeyup='load(1);' >
                                    <option selected=""  value="">-- Selecciona --</option>
                                      <?php foreach($statuses as $st):?>
                                        <option value="<?php echo $st['status_id'];?>"><?php echo $st['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
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

<script type="text/javascript" src="js/afiliados.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_afiliado.php",
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
            url: "action/updafiliados.php",
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

    function obtener_datos(id_afiliado){
        var nombre_afiliado = $("#nombre_afiliado"+id_afiliado).val();
        var apellido_afiliado = $("#apellido_afiliado"+id_afiliado).val();
        var fecha_nacimiento_afiliado = $("#fecha_nacimiento_afiliado"+id_afiliado).val();
        var observaciones_afiliado = $("#observaciones_afiliado"+id_afiliado).val();
        var patologias_afiliado = $("#patologias_afiliado"+id_afiliado).val();
        var numero_afiliado = $("#numero_afiliado"+id_afiliado).val();
        var numero_documento_afiliado = $("#numero_documento_afiliado"+id_afiliado).val();
        var telefono_afiliado = $("#telefono_afiliado"+id_afiliado).val();
        var precio_plan = $("#precio_plan"+id_afiliado).val();
        var direccion_afiliado = $("#direccion_afiliado"+id_afiliado).val();
        var rela_planes = $("#rela_planes"+id_afiliado).val();
        var rela_tipo_cobro = $("#rela_tipo_cobro"+id_afiliado).val();
        var obrasocial_afiliado = $("#obrasocial_afiliado"+id_afiliado).val();
        var status_id = $("#status_id"+id_afiliado).val();


            $("#mod_id").val(id_afiliado);
            $("#mod_nombre_afiliado").val(nombre_afiliado);
            $("#mod_apellido_afiliado").val(apellido_afiliado);
            $("#mod_numero_afiliado").val(numero_afiliado);
            $("#mod_fecha_nacimiento_afiliado").val(fecha_nacimiento_afiliado);
            $("#mod_numero_documento_afiliado").val(numero_documento_afiliado);
            $("#mod_telefono_afiliado").val(telefono_afiliado);
            $("#mod_precio_plan").val(precio_plan);
            $("#mod_direccion_afiliado").val(direccion_afiliado);
            $("#mod_observaciones_afiliado").val(observaciones_afiliado);
            $("#mod_patologias_afiliado").val(patologias_afiliado);
            $("#mod_obrasocial_afiliado").val(obrasocial_afiliado);
            $("#mod_rela_planes").val(rela_planes);
            $("#mod_rela_tipo_cobro").val(rela_tipo_cobro);
            $("#mod_status_id").val(status_id);


           
        }

     function view_afiliado(id_afiliado){
        var view_nombre_afiliado = $("#nombre_afiliado"+id_afiliado).val();
        var view_apellido_afiliado = $("#apellido_afiliado"+id_afiliado).val();
        var view_fecha_nacimiento_afiliado = $("#fecha_nacimiento_afiliado"+id_afiliado).val();
        var view_observaciones_afiliado = $("#observaciones_afiliado"+id_afiliado).val();
        var view_patologias_afiliado = $("#patologias_afiliado"+id_afiliado).val();
        var view_numero_afiliado = $("#numero_afiliado"+id_afiliado).val();
        var view_numero_documento_afiliado = $("#numero_documento_afiliado"+id_afiliado).val();
        var view_telefono_afiliado = $("#telefono_afiliado"+id_afiliado).val();
        var view_precio_plan = $("#precio_plan"+id_afiliado).val();
        var view_direccion_afiliado = $("#direccion_afiliado"+id_afiliado).val();
        var view_rela_planes = $("#rela_planes"+id_afiliado).val();
        var view_rela_tipo_cobro = $("#rela_tipo_cobro"+id_afiliado).val();
        var view_obrasocial_afiliado = $("#obrasocial_afiliado"+id_afiliado).val();
        var view_status_id = $("#status_id"+id_afiliado).val();


            $("#view_id").val(id_afiliado);
            $("#view_nombre_afiliado").val(view_nombre_afiliado);
            $("#view_apellido_afiliado").val(view_apellido_afiliado);
            $("#view_numero_afiliado").val(view_numero_afiliado);
            $("#view_fecha_nacimiento_afiliado").val(view_fecha_nacimiento_afiliado);
            $("#view_numero_documento_afiliado").val(view_numero_documento_afiliado);
            $("#view_telefono_afiliado").val(view_telefono_afiliado);
            $("#view_precio_plan").val(view_precio_plan);
            $("#view_direccion_afiliado").val(view_direccion_afiliado);
            $("#view_observaciones_afiliado").val(view_observaciones_afiliado);
            $("#view_patologias_afiliado").val(view_patologias_afiliado);
            $("#view_obrasocial_afiliado").val(view_obrasocial_afiliado);
            $("#view_rela_planes").val(view_rela_planes);
            $("#view_rela_tipo_cobro").val(view_rela_tipo_cobro);
            $("#view_status_id").val(view_status_id);
        }

        function obtener_adherentes(){
          var id = $("#id_afiliado").val();
          $.ajax({
            url: "view_details.php",
            type: "post",
            data: id
        });
    }
            

</script>