<script> 
   function sala_ventas(){
       window.open("../vistas/sala_ventas.php","Forma","width=1400px, height=600px");
   }  
      function ver_cotizacion(cot){
       window.open("../vistas/sala_ventas.php?c="+cot,"Forma","width=1300px, height=600px");
   }
   function pre_grupos_ref(){
         window.open("../vistas/version2/grupos_referencias/index.php","grupos","width= 800px , height=550px");
}
</script>
<aside id="sidebar">
                <!-- START Sidebar Content -->
                <div class="sidebar-content">
                   
                    <!-- START Tab Content -->
                    <div class="tab-content">
                        <!-- START Tab Pane(menu) -->
                        <div class="tab-pane active" id="tab-menu">
                                    <!-- START Sidebar Menu -->
                            <nav id="nav" class="accordion">
                                <ul id="navigation">
                                    <!-- START Menu Divider -->
                                   
                                    <!--/ END Menu Divider -->

                                    <!-- START Menu -->
                                   
                                    <!--/ END Menu -->

                                    <!-- START Menu -->
                                    <?php  if($_SESSION['area']!='Produccion'){  ?>
                                     <li class="divider">
                                        <a  href="/principal/vistas/">
                                        <span class="icon icon-home"></span>  <span class="text">Pagina Principal</span>
                                        </a>
                                    </li>
                                    <li class="accordion-group">
                                        <?php if($crear_cot=='Habilitado'){ ?>
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu2">
                                            <span class="icon iconm-cart-add"></span>
                                            <span class="text">Cotizacion </span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu2" class="<?php  if($_GET['id']=='lista_cot' ||$_GET['id']=='new_fac' ||$_GET['id']=='tiempo'||$_GET['id']=='tiempo_asesores'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li><a href="../vistas/?id=new_fac"><span class="icon icone-angle-right"></span>Nueva Cotizacion</a></li>
                                            <li><a href="javascript:void(0);" onclick="sala_ventas();"><span class="icon icone-angle-right"></span>Sala de Ventas</a></li>
                                            <li class=""><a href="../vistas/?id=lista_cot&estado=En proceso"><span class="icon icone-angle-right"></span>Cotizaciones</a></li>
                                            <li class=""><a href="../vistas/?id=cot_aprobadas"><span class="icon icone-angle-right"></span>Cotizaciones Aprobadas</a></li>
                                            <li class=""><a href="../vistas/?id=tiempo"><span class="icon icone-angle-right"></span> Reporte Cot. Presupuesto</a></li>
                                            <li class=""><a href="../vistas/?id=tiempo_asesores"><span class="icon icone-angle-right"></span> Reporte Cot. Asesores</a></li>   
                                            <li class=""><a href="../vistas/reportes/" target="_blank"><span class="icon icone-angle-right"></span> Reporte de Ventas</a></li>   
                                        </ul>
                                        <?php } ?>
                                        <!--/ END Submenu Menu -->
                                    </li>


                                    <!--/ END Menu -->
                                    <?php if($crear_conf=='Habilitado'){ ?>
                                    <!-- START Menu -->
                                    <li class="accordion-group">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu3">
                                            <span class="icon iconm-clipboard-3"></span>
                                            <span class="text">Presupuesto</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <?php
                                        $sin = mysql_query("select count(*) from producto where aprobado=0");
                                        $sip = mysql_fetch_array($sin);
                                        ?>
                                        <ul id="submenu3" class="<?php  if($_GET['id']=='lista_anuladas' ||$_GET['id']=='lista_ok' ||$_GET['id']=='lista' || $_GET['id']=='add_cot' || $_GET['id']=='lista_sa' || $_GET['id']=='add_fachada' || $_GET['id']=='lineas' || $_GET['id']=='add_fac'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=nuevo_producto"><span class="icon icone-angle-right"></span>Nuevo Producto</a></li>
                                            <li class=""><a href="../vistas/?id=lista"><span class="icon icone-angle-right"></span>Listado de Productos 1</a></li>
                                            <li class=""><a href="../vistas/?id=lista_ok"><span class="icon icone-angle-right"></span>Listado de Productos 2</a></li>
                                            <li class=""><a href="../vistas/?id=lista_anuladas"><span class="icon icone-angle-right"></span>Productos Anulados</a></li>
                                            <li class=""><a href="../vistas/?id=lista_sa"><span class="icon icone-angle-right"></span>Productos Sin Aprobar <font color="red">(<?php  echo $sip['count(*)']; ?>)</font></a></li>
                                            <li class=""><a href="../vistas/?id=add_cot"><span class="icon icone-angle-right"></span>Crear Producto</a></li>
                                            <li class=""><a href="../vistas/?id=add_fac"><span class="icon icone-angle-right"></span>Crear Fachada Especial</a></li>
                                            <li class=""><a href="../vistas/?id=add_fachada"><span class="icon icone-angle-right"></span>Crear Fachada Normal</a></li>
                                            <li class=""><a href="../vistas/?id=lineas"><span class="icon icone-angle-right"></span> Lineas y Sublineas</a></li>

                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <?php } ?>

                                    <li class="accordion-group">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu8">
                                            <span class="icon iconm-bars"></span>
                                            <span class="text">Reportes</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu8" class="<?php  if($_GET['id']=='tiempo'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            
                                            <li class=""><a href="../vistas/?id=tiempo"><span class="icon icone-angle-right"></span> Gestion de Tiempo</a></li>
                                                <li class=""><a href="../vistas/?id=liquidados"><span class="icon icone-angle-right"></span> Liquidacion de Trabajos</a></li>
                                       
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                   
                                     <?php if($crear_conf=='Habilitado'){ ?>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu10">
                                            <span class="icon iconm-tools"></span>
                                            <span class="text">Configuracion</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu10" class="<?php  if($_GET['id']=='conf_kits' ||$_GET['id']=='md' || $_GET['id'] == 'maq' || $_GET['id']=='porcentajes' || $_GET['id']=='add_per' || $_GET['id']=='temple' || $_GET['id']=='add_gastos' || $_GET['id']=='add_mo' || $_GET['id']=='add_otro' || $_GET['id']=='precios' || $_GET['id']=='precios_area' || $_GET['id']=='color'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=porcentajes"><span class="icon icone-angle-right"></span> Porcentajes</a></li>
                                             <li class=""><a href="../vistas/?id=temple"><span class="icon icone-angle-right"></span> Servicio Temple</a></li>
                                            <li class=""><a href="../vistas/?id=add_gastos"><span class="icon icone-angle-right"></span> Gastos Administrativos</a></li>
                                            <li class=""><a href="../vistas/?id=add_mo"><span class="icon icone-angle-right"></span> Gastos Mano de obra y maq.</a></li>
                                            <li class=""><a href="../vistas/?id=add_otro"><span class="icon icone-angle-right"></span>Otros Gastos</a></li>
<!--                                            <li class=""><a href="../vistas/?id=precios"><span class="icon icone-angle-right"></span> Lista de Precios</a></li>-->
                                            <li class=""><a href="../vistas/?id=precios_area"><span class="icon icone-angle-right"></span> Precios x Areas</a></li>
                                            <li class=""><a href="../vistas/?id=color"><span class="icon icone-angle-right"></span>Color de Alum. y Vidrios</a></li>
                                            <li class=""><a href="../vistas/?id=add_per"><span class="icon icone-angle-right"></span>Lista de Materiales</a></li>
                                            <li class=""><a href="../vistas/?id=sincronizar"><span class="icon icone-angle-right"></span>Sinc Materiales de Fom</a></li>
                                            <li class=""><a href="#" onclick="pre_grupos_ref();"><span class="icon icone-angle-right"></span>Rejillas y Alfajias</a></li>
                                            <li class=""><a href="../vistas/?id=conf_kits"><span class="icon icone-angle-right"></span>Configuracion de Kits</a></li>
                                            <li class=""><a href="../vistas/?id=servicios"><span class="icon icone-angle-right"></span>Lista de Servicios</a></li>
                                            <li class=""><a href="../vistas/?id=md"><span class="icon icone-angle-right"></span>Mantenimiento Dollar</a></li>
                                            <li class=""><a href="../vistas/?id=costos"><span class="icon icone-angle-right"></span>Parametros de costos</a></li>
                                            <li class=""><a href="../vistas/?id=comision"><span class="icon icone-angle-right"></span>Tabla de comisiones</a></li>
                                            <li class=""><a href="../vistas/?id=categorias"><span class="icon icone-angle-right"></span>Categoria de costos</a></li>
                                            <li class=""><a href="../vistas/?id=sistemas"><span class="icon icone-angle-right"></span>Sistemas</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                     <?php } ?>

                                    <?php 
                                           if($_SESSION['k_username']=='admin'){
                                               $rex=mysql_query("SELECT count(*) FROM requerimientos where estado!='Solucionado' ");
                                           }else{
                                               $rex=mysql_query("SELECT count(*) FROM requerimientos where estado!='Solucionado' and usuario='".$_SESSION['k_username']."' ");
                                           }
                                           
                                           $t = mysql_fetch_array($rex);
                                           $y = $t['count(*)']
                                          ?>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu112">
                                            <span class="icon icon-adjust"></span>
                                            <span class="text">Soporte en linea</span>
                                            <span class="arrow icone-caret-down"><?php echo '<font color="red">('.$y.')</font>' ?></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu112" class="collapse ">
                                          
                                            <li class=""><a href="../vistas/?id=soporte"><span class="icon icone-angle-right"></span> Lista de Requerimientos</a> </li>
                           
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <!-- START Menu Divider -->
                                    <li class="divider">Fin Menu</li>
                                    <!--/ END Menu Divider -->
                                </ul>

                                        <h5>
                                             <?php  if($_GET['id']=='precios'){
                                            if(isset($_GET['edi'])){
                                             $sql = "UPDATE `aiu` SET por_aiu='".$_POST['aiu']."' WHERE `id_aiu` = ".$_GET['edi']."";
                                            mysql_query($sql, $conexion);}
                                            $sql21 = "SELECT * FROM aiu";
                                            $fila21 =mysql_fetch_array(mysql_query($sql21));
                                            $aiu= $fila21["por_aiu"];
                                            $id_aiu= $fila21["id_aiu"];
                                            ?>
                                               <?php  if($editar_conf=='Habilitado'){ ?>
                                            <form  action="<?php echo '../vistas/?id=precios&edi='.$id_aiu.''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                                                <table>
                                                    <tr>
                                                    <td>Porcentaje del AIU</td>
                                                    <td><input type="text" name="aiu" value="<?php echo $aiu; ?>" style="width: 40px;">%</td>
                                                </tr>
                                                    
                                                    <tr>
                                                    <td></td>
                                                    <td><input type="submit" value="Guardar"></td>
                                                </tr>
                                                
                                                </table>
                                            
                                            </form>
                                            <br>
                                               <?php  }if($importar_conf=='Habilitado'){ ?>
                                            <form action="../vistas/subircsv.php" method="post" enctype="multipart/form-data">
                                                
      <input name="archivo" type="file" class="casilla" id="archivo" size="35" required/>
      <input name="enviar" type="submit" class="boton" id="enviar" value="Cargar Precios" />
      	 <br> 
          <input name="action" type="hidden" value="upload" />
	</form>
                                            <?php
                                            }
                                             }
                                        
                                        
                                        ?></h5>
                                 <?php 
                                 include '../vistas/usuarios_online.php';
                                 }
                                    if($_SESSION['area']=='Produccion'){
                                        if(!isset($_GET['sig'])){
                                    ?>
                                 <div align="center">
                                 <form name="formulario1" action="../vistas/?id=mi_area&next_c" method="post" enctype="multipart/form-data" onsubmit="return confirmation()">
        <div><input type="image" width='30px' heigth='30px' src="../imagenes/user.png" alt="Submit Form" />
           
          
            <br> <br><input name="carnet" autofocus  value="" size="15" class="tex"  type="number" placeholder="Numero de Carnet"  style="width: 130px;" required></div>
        <br>
                <h5><font color="red">Pase su Carnet por el lector</font></h5> 
       </form></div>
                                        <?php } else{ ?>   
                                 <div align="center">
                                     <form name="formulario1" action="../vistas/?id=mi_area&next" method="post" enctype="multipart/form-data" onsubmit="return confirmation()">
                                         <div>
            <input type="image" width='80px' heigth='90px' src="../imagenes/codigo.png" alt="Submit Form" />
            <br><?php if(isset($_GET["producto"])){if($_POST['producto']=='Producto'){echo'<font color="red">Por Favor Pase el Lector<font>';}else{echo'Por Favor Pase el Lector';}} ?>
           <br>
           <input name="Ubicacion"  value="" size="15" class="tex"  type="text"  style="width: 130px;" Placeholder="Ubicacion del producto">
           <br> <br><input name="producto" autofocus required value="" type="text" placeholder="Codigo de barra de O.P"  style="width: 130px;">
          
                                         </div>
        <br>
        <table>
            <tr>
                <td><font color="red"> Pasar Toda la O.P </font></td><td> <input type="checkbox" name="todos" value="1"></td>
            </tr>
        </table>
       
        <input name="obrero" value="<?php echo $_GET['sig']   ?>" size="15"  type="hidden">
                
       </form>
                                 </div>
                                <h5><font color="red">Nota : Si estas en el area de "DESPACHO", por favor digita el numero de ubicacion, de lo contrario dejalo en blanco</font></h5>
                                    <?php }} ?>  
                            </nav>
                            <!--/ END Sidebar Menu -->
                        </div>
                        <!--/ END Tab Pane(menu) -->

                        <!-- START Tab Pane(overview) -->
                        
                        <!--/ END Tab Pane(overview) -->
                    </div>
                    <!--/ END Tab Content -->
                </div>
          <!--/ END Sidebar Content -->
 </aside>
