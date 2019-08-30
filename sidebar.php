      <?php

if ($rela_perfil=="1"){
   echo $sidebar1='    
   <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="afiliados.php"><i class="fa fa-male"></i> Afiliados</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="adherentes.php"><i class="fa fa-user-plus"></i> Afiliados Adherentes</a>
                    </li>
                    <li class="<?php if(isset($active4)){echo $active4;}?>">
                        <a href="areasprotegidas.php"><i class="fa fa-university"></i> Areas Protegidas</a>
                    </li>

                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="despachos.php"><i class="fa fa-ambulance "></i> Despachos</a>
                    </li>
                    <li class="<?php if(isset($active6)){echo $active6;}?>">
                        <a href="atencion_base.php"><i class="fa fa-hospital-o "></i> Atenciones en Base</a>
                    </li>
                    <li class="<?php if(isset($active7)){echo $active7;}?>">
                    <a href="reporte_atenciones.php"><i class="fa fa-hospital-o "></i> Reporte de Atenciones</a>
                </li>
                   
                 <li class=""><a><i class="fa fa-area-chart"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" >
                    
                <li class="<?php if(isset($active8)){echo $active8;}?>">
                    <a href="reports.php"><i class="fa fa-file"></i> Reporte de Servicios</a>
                </li>
                <li  class="<?php if(isset($active9)){echo $active9;}?>"><a href="estadisticaDespachos/estadisticas_operativas.php" target="_blank"><i class="fa fa-area-chart"></i>Reporte Operativo</a></li>
                    
                </li>
                </ul>
                </li>

                    <li class="<?php if(isset($active10)){echo $active10;}?>">
                        <a href="users.php"><i class="fa fa-users"></i> Usuarios</a>
                    </li>

                   

                     </ul>
                </div>
            </div><!-- /sidebar menu -->
    </div>
</div> ';


}
elseif($rela_perfil=="2")
{

echo $sidebar1='<div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
<div class="menu_section">
    <ul class="nav side-menu">

        <li class="<?php if(isset($active1)){echo $active1;}?>">
            <a href="afiliados.php"><i class="fa fa-male"></i> Afiliados</a>
        </li>

        <li class="<?php if(isset($active2)){echo $active2;}?>">
            <a href="adherentes.php"><i class="fa fa-list-alt"></i> Afiliados Adherentes</a>
        </li>
        <li class="<?php if(isset($active3)){echo $active3;}?>">
            <a href="atencion_base.php"><i class="fa fa-hospital-o "></i> Atenciones en Base</a>
        </li>
        <li class="<?php if(isset($active4)){echo $active4;}?>">
            <a href="reporte_atenciones.php"><i class="fa fa-hospital-o "></i> Reporte de Atenciones</a>
        </li>
       

    </ul>
</div>
</div><!-- /sidebar menu -->
</div>
</div>
';

}
elseif ($rela_perfil=="3"){
   echo $sidebar1='    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="afiliados.php"><i class="fa fa-male"></i> Afiliados</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="adherentes.php"><i class="fa fa-user-plus"></i> Afiliados Adherentes</a>
                    </li>
                    <li class="<?php if(isset($active4)){echo $active4;}?>">
                        <a href="areasprotegidas.php"><i class="fa fa-university"></i> Areas Protegidas</a>
                    </li>

                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="despachos.php"><i class="fa fa-ambulance "></i> Despachos</a>
                    </li>
                    <li class="<?php if(isset($active6)){echo $active6;}?>">
                        <a href="base.php"><i class="fa fa-hospital-o "></i> Base</a>
                    </li>
                    <li class="<?php if(isset($active7)){echo $active7;}?>">
                        <a href="reports.php"><i class="fa fa-area-chart"></i> Reportes</a>
                    </li>

                   

                   

                </ul>
            </div>
        </div><!-- /sidebar menu -->
    </div>
</div> ';


}
elseif ($rela_perfil=="4"){
   echo $sidebar1='    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                   
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="despachos.php"><i class="fa fa-ambulance "></i> Despachos</a>
                        </li>

                        <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="afiliados.php"><i class="fa fa-male"></i> Afiliados</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="adherentes.php"><i class="fa fa-user-plus"></i> Afiliados Adherentes</a>
                    </li>
                 

                   

                   

                </ul>
            </div>
        </div><!-- /sidebar menu -->
    </div>
</div> ';


}


     ?>

    <div class="top_nav"><!-- top navigation -->
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/profiles/<?php echo $profile_pic;?>" alt=""><?php echo $name;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="dashboard.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
                            <li><a href="action/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- /top navigation -->    