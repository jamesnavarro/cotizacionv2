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
                                    <li class="divider">Menu Principal</li>
                                    <!--/ END Menu Divider -->

                                    <!-- START Menu -->
                                   
                                    <!--/ END Menu -->

                                    <!-- START Menu -->
                                    <li class="accordion-group  active">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu2">
                                            <span class="icon iconm-cart-add"></span>
                                            <span class="text">Cotizacion</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu2" class="<?php  if($_GET['id']=='new_cot' || $_GET['id']=='lista_cot'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li ><a href="../vistas/?id=new_cot"><span class="icon icone-angle-right"></span>Nueva Cotizacion</a></li>
                                             <li class=""><a href="../vistas/?id=lista_cot"><span class="icon icone-angle-right"></span>Cotizaciones</a></li>
                                            
                                           
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <!--/ END Menu -->

                                    <!-- START Menu -->
                                    <li class="accordion-group">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu3">
                                            <span class="icon iconm-clipboard-3"></span>
                                            <span class="text">Presupuesto</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu3" class="<?php  if($_GET['id']=='lista' || $_GET['id']=='add_cot' || $_GET['id']=='add_acc' || $_GET['id']=='add_per' || $_GET['id']=='add_vid' || $_GET['id']=='add_gastos'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=lista"><span class="icon icone-angle-right"></span>Listado de Productos</a></li>
                                            <li class=""><a href="../vistas/?id=add_cot"><span class="icon icone-angle-right"></span>Crear Producto</a></li>
                                            
                                          
                                            <li class=""><a href="../vistas/?id=add_per"><span class="icon icone-angle-right"></span>Lista de Materiales</a></li>
                                           
                                            <li class=""><a href="../vistas/?id=add_gastos"><span class="icon icone-angle-right"></span> Gastos Administrativos</a></li>
                                            <li class=""><a href="../vistas/?id=add_mo"><span class="icon icone-angle-right"></span> Gastos Mano de obra y maq.</a></li>
                                            <li class=""><a href="../vistas/?id=add_otro"><span class="icon icone-angle-right"></span>Otros Gastos</a></li>
                                           <li class=""><a href="../vistas/?id=color"><span class="icon icone-angle-right"></span>Colores de productos</a></li>
                                        
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                 
                                    <!--/ END Menu -->
                                     <li class="accordion-group  active">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu4">
                                            <span class="icon iconm-user-plus-2"></span>
                                            <span class="text">Clientes</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu4" class="<?php  if($_GET['id']=='new_cli' || $_GET['id']=='lista_cli'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=new_cli"><span class="icon icone-angle-right"></span>Nuevo Clientes</a></li>
                                            <li class=""><a href="../vistas/?id=lista_cli"><span class="icon icone-angle-right"></span>Lista de Clientes</a></li>
                                            
                                           
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group active">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu8">
                                            <span class="icon iconm-bars"></span>
                                            <span class="text">Estadisticas de produccion</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu8" class="<?php  if($_GET['id']=='stad'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            
                                            <li class=""><a href="../vistas/?id=stad"><span class="icon icone-angle-right"></span> Estadisticas</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu6">
                                            <span class="icon iconm-address-book"></span>
                                            <span class="text">Actividades</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu6" class="<?php  if($_GET['id']=='reunion' || $_GET['id']=='llamada' || $_GET['id']=='Actividad'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=llamada"><span class="icon icone-angle-right"></span> Llamadas</a></li>
                                            <li class=""><a href="../vistas/?id=reunion"><span class="icon icone-angle-right"></span> Reuniones</a></li>
                                            <li class=""><a href="../vistas/?id=Actividad"><span class="icon icone-angle-right"></span> Actividades</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                     <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu7">
                                            <span class="icon iconm-briefcase-3"></span>
                                            <span class="text">Casos / Incidencias</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu7" class="collapse ">
                                            <li class=""><a href="../vistas/?id=casos"><span class="icon icone-angle-right"></span> Casos</a></li>
                                            <li class=""><a href="../vistas/?id=incidencias"><span class="icon icone-angle-right"></span> Incidencias</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu10">
                                            <span class="icon iconm-tools"></span>
                                            <span class="text">Configuraciones</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu10" class="collapse ">
                                            <li class=""><a href="../vistas/?id=porcentajes"><span class="icon icone-angle-right"></span> Porcentajes</a></li>
                                            <li class=""><a href="../vistas/?id=lineas"><span class="icon icone-angle-right"></span> Lineas y Sublineas</a></li>
                                            <li class=""><a href="../vistas/?id=precios"><span class="icon icone-angle-right"></span> Lista de Precios</a></li>
                                            <li class=""><a href="../vistas/?id=precios_area"><span class="icon icone-angle-right"></span> Precios x Areas</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu11">
                                            <span class="icon icon-adjust"></span>
                                            <span class="text">Administrador</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu11" class="collapse ">
                                            <li class=""><a href="../vistas/?id=user"><span class="icon icone-angle-right"></span> Nuevo Asesor</a></li>
                                            <li class=""><a href="../vistas/?id=list_user"><span class="icon icone-angle-right"></span> Lista de Asesores</a></li>
                                            
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <!-- START Menu Divider -->
                                    <li class="divider">Fin Menu</li>
                                    <!--/ END Menu Divider -->
                                </ul>
                                        <h5>
                                             <?php  if($_GET['id']=='new_cot' && isset($_GET['cot'])){ 
                                                 
                                                 
                                            $s = "SELECT * FROM aiu";
                                            $fi =mysqli_fetch_array(mysqli_query($conexion,$s));
                                            $por_aiu= $fi["por_aiu"];
                                            
                                            
                                        
                                            
       $sql21 = "SELECT * FROM cotizacion a, clientes b where a.id_cliente=b.id_cli and a.id_cot=".$_GET['cot'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $nombre= $fila21["nombre_cli"];
            $dir= $fila21["direccion_cli"];
            $tel= $fila21["telefono_cli"];
            $nit= $fila21["cedu_nit"];
            $mun= $fila21["Municipio"];
            $id= $fila21["id_cot"];
            $email= $fila21["email"];
            $obra= $fila21["obra"];
            $ubicacion= $fila21["ubicacion"];
            $linea= $fila21["linea"];
            $orden_p= $fila21["orden"];
            $estado= $fila21["estado"];
            $contacto= $fila21["contacto"];
            $tc= $fila21["tel_contacto"];
            $asesor= $fila21["registrado"];
            $responsable= $fila21["responsable"];
             $tel_responsable= $fila21["tel_responsable"];
              $ciudad= $fila21["ciudad"];
              $costo_total= $fila21["costo_total"];
              $costo_instalacion= $fila21["costo_instalacion"];
              $descuento= $fila21["descuento"]; 
              
              $aiu= $fila21["aiu"]; 
              $instalacion= $fila21["instalacion"]; 
              if($fila21["precio"]!='px'){
              if($fila21["precio"]==''){$precio = 'p3';}else{$precio= $fila21["precio"]; }
                                            $s2 = "SELECT (".$precio.") as p FROM porcentajes where grupo='Otros'";
                                            $fi2 =mysqli_fetch_array(mysqli_query($conexion,$s2));
              $multiplicador= $fi2["p"]/100;
              }else{
                  $precio= $fila21["precio"];
                $multiplicador= 1;  
              }                    
$request=mysqli_query($conexion,"SELECT * FROM producto a, clientes b, cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio and c.id_cliente=b.id_cli and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]);  

        $total2=0;
        $tatt =0;
        $cont =0;
        
	while($row=mysqli_fetch_array($request))
	{         
             $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='total'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult3= $fi3["p"]/100;
                
                $suma22 = $row["valor_c"];
                
            $a = $suma22 / $mult3;
            
            $b1 = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor2 = $b1 *$row["desc"]/100;
            $b1 = $b1 -$descpor2;
           
            $cont = $cont + 1;
            $tatt = $tatt + $b1;
            
           
        } 
    
        $tp = $tatt * $multiplicador;
        $tax = $tp + $tatt;
        if($aiu=='Si'){
            $x = $por_aiu/100;
            $f = $tatt * $x;
        $tatt = $f + $tatt;
        }else{
            $x =1;
        $tatt = $tatt;
        }
        
              
             
                           ?>
                                            <form  action="<?php echo '../vistas/?id=new_cot&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&add'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                                                <center>
                                            <table style="background:#E5F0FB; ">
                                               
                                                <tr>
                                                    <td>AIU</td>
                                                    <td><select name="aiu"  style="width: 80px;">
                                                             <?php echo '<option value="'.$aiu.'">'.$aiu.'</option>';
                                                             if($aiu=='Si'){echo '<option value="No">No</option>';}else{echo '<option value="Si">Si</option>';}
                                                             ?>
                                                            
                                                            
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Precios</td>
                                                    <td><select name="precio"  style="width: 80px;">
                                                            <?php echo '<option value="'.$precio.'">'.$precio.'</option>';
                                                            if($precio=='p3'){echo '<option value="p2">p2</option><option value="p1">p1</option>';}else{if($precio=='p2'){echo '<option value="p3">p3</option><option value="p1">p1</option>';}else{echo '<option value="p3">p3</option>
                                                            <option value="p2">p2</option>';}}
                                                                ?>
                                                            
                                                            
                                                            
                                                        </select></td>
                                                </tr>
<!--                                                <tr>
                                                    <td>Precio Neto :</td>
                                                    <td><input type="text" name="pn" value="<?php echo number_format($tax); ?>" style="width: 80px;" readonly></td>
                                                </tr>-->
                                                <tr>
                                                    <td>Descuento :</td>
                                                    <td><input type="text" name="desc" value="<?php echo $descuento; ?>" style="width: 20px;">%</td>
                                                </tr>
                                                 <tr>
                                                    <td>Instalacion ?</td>
                                                    <td><select name="instalacion"  style="width: 80px;">
                                                            <?php echo '<option value="'.$instalacion.'">'.$instalacion.'</option>';
                                                            if($instalacion=='Si'){echo '<option value="No">No</option>';}else{echo '<option value="Si">Si</option>';}
                                                            ?>
                                                            
                                                            
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Descuento de  :</td>
                                                    <td><input type="text" name="ins" value="<?php if($t1==0){echo number_format($t1);}else{echo '-'.number_format($t1);} ?>" style="width:80px;" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Subtotal :</td>
                                                    <td><input type="text" name="st" value="<?php echo number_format($tt); ?>" style="width: 80px;"  readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Iva 16% :</td>
                                                    <td><input type="text" name="iva" value="<?php echo number_format($ni); ?>" style="width: 80px;"  readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Total :</td>
                                                    <td><input type="hidden" name="gt" value="<?php echo $tax + $ni; ?>" style="width: 80px;"  readonly>$ <?php echo number_format($tt + $ni); ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" value="Guardar"></td>
                                                </tr>
                                                
                                                
                                                
                                            </table></center>
                                            </form>
                                        <?php  }
                                        if($_GET['id']=='precios'){
                                            if(isset($_GET['edi'])){
                                             $sql = "UPDATE `aiu` SET por_aiu='".$_POST['aiu']."' WHERE `id_aiu` = ".$_GET['edi']."";
                                            mysqli_query($conexion,$sql);}
                                            $sql21 = "SELECT * FROM aiu";
                                            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
                                            $aiu= $fila21["por_aiu"];
                                            $id_aiu= $fila21["id_aiu"];
                                            ?>
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
                                            
                                            <?php
                                             }
                                        
                                        
                                        ?></h5>
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