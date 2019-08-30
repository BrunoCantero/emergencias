<?php
    $title ="ADHERENTES | ";
    include "head.php";
    include "sidebar.php"; 
?>
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_adherente.php");
                        include("modal/upd_adherente.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Adherentes</h2>
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
                                <label for="q" class="col-md-2 control-label">Nombre/DNI</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Ingrese su busqueda" onkeyup='load(1);'>
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

<script type="text/javascript" src="js/adherentes.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_adherente.php",
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

// success

$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/upd_adherente.php",
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

    function obtener_datos(id_afiliado_adherente){
            var nombre_adherente = $("#nombre_adherente"+id_afiliado_adherente).val();
            var dni_adherente = $("#dni_adherente"+id_afiliado_adherente).val();
            var fecha_nacimiento_adherente = $("#fecha_nacimiento_adherente"+id_afiliado_adherente).val();
            var sexo_adherente = $("#sexo_adherente"+id_afiliado_adherente).val();
            var rela_afiliado = $("#rela_afiliado"+id_afiliado_adherente).val();
            var patologias_adherente = $("#patologias_adherente"+id_afiliado_adherente).val();
            $("#mod_id").val(id_afiliado_adherente);
            $("#mod_nombre_adherente").val(nombre_adherente);
            $("#mod_dni_adherente").val(dni_adherente);
            $("#mod_rela_afiliado").val(rela_afiliado);
            $("#mod_fecha_nacimiento_adherente").val(fecha_nacimiento_adherente);
            $("#mod_patologias_adherente").val(patologias_adherente);
            $("#mod_sexo_adherente").val(sexo_adherente);
        }
       

       //solucion al select2 
         $.fn.modal.Constructor.prototype.enforceFocus = function () {

$('#rela_afiliado').select2({
    minimumInputLength: 2

         });   
$('#mod_rela_afiliado').select2({
    minimumInputLength: 2

         });  
   };



</script>