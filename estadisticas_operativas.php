<?php
    $title ="grafico de barra | ";
    include "head.php";
    include "sidebar.php";
    
?>

    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Estadísticas Operativas</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <style>
                            .caja{
                                margin: auto;
                                max-width: 250px;
                                padding: 20px;
                                border: 1px solid #BDBDBD;
                            }
                            .caja select{
                                width: 100%;
                                font-size: 16px;
                                padding: 5px;
                            }
                            .resultados{
                                margin: auto;
                                margin-top: 40px;
                                width: 1000px;
                            }
                        </style>
                        <body> 
                            <div class="caja">
                                <select onChange="mostrarResultados(this.value);">
                                    <?php
                                        for($i=2018;$i<2030;$i++){
                                            if($i == 2018){
                                                echo '<option value="" selected>Seleccionar Año</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="resultados"><canvas id="grafico"></canvas></div>
                        <script>
                                $(document).ready(mostrarResultados(2019));  
                                    function mostrarResultados(year){
                                        $('.resultados').html('<canvas id="grafico"></canvas>');
                                        $.ajax({
                                            type: 'POST',
                                            url: 'estadisticaDespachos/php/procesar.php',
                                            data: 'year='+year,
                                            dataType: 'JSON',
                                            success:function(response){
                                                var Datos = {
                                                        labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                                        datasets : [
                                                            {
                                                                fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                                                strokeColor : 'rgba(57,194,112,0.8)', //COLOR DEL BORDE DE LAS BARRAS
                                                                highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                                                highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                                                data : response
                                                            }
                                                        ]
                                                    }
                                                var contexto = document.getElementById('grafico').getContext('2d');
                                                window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                                                Barra.clear();
                                            }
                                        });
                                        return false;
                                    }
                                    
                        </script>
                        </body>
                        
                       
                       <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

                       <? include "footer.php"; ?>