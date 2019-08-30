<?php
    $title ="Despachos | ";
    include "head.php";
    include "sidebar.php";
?>
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_despacho.php");
                        include("modal/upd_despacho.php");
                        include("modal/udpdata_despacho.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Despachos </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form search -->
                        <form class="form-horizontal" role="form" id="category_expence">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">Nº</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="q" placeholder="Nº" onkeyup='load(1);'>
                                </div>
                               <!-- <div class="col-md-1">
                                    <input type="date" class="form-control" id="date" onkeyup='load_date(1);'>
                                </div>
                                -->
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>    
                        <!-- end form search -->

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

<script type="text/javascript" src="js/despachos.js"></script>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/add_despacho.php",
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
            url: "action/upd_despacho.php",
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

    function obtener_datos(id_despacho){
        var hora_salida = $("#hora_salida"+id_despacho).val();
        var hora_llegada = $("#hora_llegada"+id_despacho).val();
        var hora_finalizacion = $("#hora_finalizacion"+id_despacho).val();
        $("#mod_id").val(id_despacho);
        $("#mod_hora_salida").val(hora_salida);
        $("#mod_hora_llegada").val(hora_llegada);
        $("#mod_hora_finalizacion").val(hora_finalizacion);

        if(hora_finalizacion!=="" && hora_finalizacion!=="00:00:00" ){
        alert('no puedes editar un Despacho finalizado');
    return     location.reload();
 ;
    }
        }
       
    //solucion al select2 
         $.fn.modal.Constructor.prototype.enforceFocus = function () {
            $('#rela_afiliado').select2({
    minimumInputLength: 2
    
    

         });  
         $('#rela_adherente').select2({
    minimumInputLength: 2

         });  
        }

        
        
        
    var var_hora = setInterval(setear_hora, 1000);
    function setear_hora() {
    var d = new Date();
    ("#hora_salida").val(d.toLocaleTimeString()) ;
    console.log(d.toLocaleTimeString());
    }





        $('.modal').on('hidden.bs.modal', function(){
    location.reload();
 });
</script>