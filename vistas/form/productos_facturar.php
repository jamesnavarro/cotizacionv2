<?php  if(isset($_GET['cot'])){ $sql21 = "SELECT * FROM cotizacion where id_cot=".$_GET['cot'];            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));              $id= $fila21["id_cot"];            $tipo= $fila21["tipo"];            $obra= $fila21["obra"];            $ubicacion= $fila21["ubicacion"];            $linea= $fila21["linea"];            $orden_p= $fila21["orden"];            $estado= $fila21["estado"];            $id_cliente= $fila21["id_cliente"];            $asesor= $fila21["registrado"];            $responsable= $fila21["responsable"];             $tel_responsable= $fila21["tel_responsable"];              $ciudad= $fila21["ciudad"];              $costo_total= $fila21["costo_total"];              $costo_instalacion= $fila21["costo_instalacion"];              $descuento= $fila21["descuento"];              $fecha= $fila21["fecha_reg_c"];$tipo= $fila21["tipo"];              if($tipo=='Empresarial'){                       $con= "SELECT * FROM `sis_empresa` where id_empresa=".$id_cliente."";    $res=  mysqli_query($conexion,$con);    while($f=  mysqli_fetch_array($res)){       $doc=$f['nit_emp'];    $direccion=$f['direccionr_emp'];    $telefono_cli=$f['tel_oficina_emp'];    $contacto=$f['nombre_emp'];    $tel_cont=$f['celular_emp'];    $email=$f['email1_emp'];    $propietario =$f['propietario_emp'];    }              }else{       $con= "SELECT * FROM `sis_contacto` where id_contacto=".$id_cliente."";    $res=  mysqli_query($conexion,$con);    while($f=  mysqli_fetch_array($res)){    $doc=$f['cedula_cont'];    $direccion=$f['direccionf'];    $telefono_cli=$f['tel_oficina'];    $contacto=$f['nombre_cont'].' '.$f['apellido_cont'];    $tel_cont=$f['celular'];    $email=$f['email1'];    $propietario ='';    }              }         }?><div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                        <header>                                <h4 class="title">Remisionar Pedido : <?php echo $_GET['ped']  ?></h4>                                                    </header>                             <section id="collapse1" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                                            <div class="tab-content">                                    <div class="tab-pane active" id="tab3">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime"><?php  $res = "SELECT * FROM cotizacion a where  a.estado='Ordenado' and orden=".$_GET['ped']."  ";$fila21 =mysqli_fetch_array(mysqli_query($conexion,$res));$id_cliente= $fila21["id_cliente"];                    if($fila21['tipo']=='Personal'){                            $sql='select * from sis_contacto where id_contacto="'.$fila21['id_cliente'].'"';$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];$dir= $fil["direccionf"];$tel= $fil["tel_oficina"];$nit= $fil["cedula_cont"];$mun= $fil["municipio"];$email= $fil["email1"];          }else{              $sql='select * from sis_empresa where id_empresa="'.$fila21['id_cliente'].'"';$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));$nombre= $fil["nombre_emp"];$dir= $fil["direccionr_emp"];$tel= $fil["tel_oficina_emp"];$nit= $fil["nit_emp"];$mun= $fil["municipio_emp"];$email= $fil["email1_emp"];          }?>                                                      <section class="body">                                <div class="body-inner no-padding">                                   <table class="table table-bordered table-striped table-hover" id="">                                        <tr>                                            <th>Nombre del Cliente :</th>                                            <td><?php echo $nombre; ?></td>                                            <th>Cedula :</th>                                            <td><?php echo $nit; ?></td>                                        </tr>                                        <tr>                                            <th>Direccion :</th>                                            <td><?php echo $dir; ?></td>                                            <th>Nombre de la Obra</th>                                            <td><?php echo $fila21["obra"] ?></td>                                        </tr>                                        <tr>                                            <th>Telefono :</th>                                            <td><?php echo $tel; ?></td>                                            <th>Asesor de Venta :</th>                                            <td><?php echo $fila21["registrado"] ?></td>                                        </tr>                                    </table><form name="buscarA" action="<?php echo '../vistas/?id=facturar&ped='.$_GET['ped'].'&cot='.$_GET['cot'].'' ?>&fact" method="post" enctype="multipart/form-data">                                    <?php $request=mysqli_query($conexion,"SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido, (c.porcentaje) as p1, sum(g.cantidad_aprobada) as su FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f, pa_aprobados g where g.estado_apro='Remisionar' and f.barra=g.barra and  e.parte_otro='0' and f.id_op=".$_GET['cot']." and f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido'  and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p group by g.barra");  if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="3%">'.'O.P'.'</th>';                     $table = $table.'<th width="3%">'.'Ped'.'</th>';                $table = $table.'<th width="3%">'.'Codigo'.'</th>';                $table = $table.'<th width="5%">'.'Referencia'.'</th>';               $table = $table.'<th width="25%">'.'Descripcion del Producto'.'</th>';                         $table = $table.'<th width="7%">'.'Medidas (mm)'.'</th>';                           $table = $table.'<th width="4%">'.'Esp Vid (mm)'.'</th>';                          $table = $table.'<th  width="4%">'.'Cant Ordenadas'.'</th>';                              $table = $table.'<th width="4%">'.'Cant Aprobadas'.'</th>';                 $table = $table.'<th width="4%">'.'Cant Remisionadas'.'</th>';                  $table = $table.'<th  width="4%">'.'Sin Remisionar'.'</th>';                 $table = $table.'<th width="4%">'.'Cant. a Remisionar'.'</th>';                  $table = $table.'<th width="4%">'.'Precio Und'.'</th>';                   $table = $table.'<th width="4%">'.'Total'.'</th>';                $table = $table.'<th  width="4%">'.'Seleccionar.'.'</th>';             $table = $table.'<th  width="4%">'.'Fecha de aprobacion.'.'</th>';                  $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;        $ta2 =0;        $cont =0;        $comi=0;        	while($row=mysqli_fetch_array($request))	{  if($row["linea_cot"]=='Aluminio'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Aluminio'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;            }else{               if($row["linea_cot"]=='Vidrio'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Vidrio'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;               }else{                if($row["linea_cot"]=='Fachada'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Fachada'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;               }else{                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Acero'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;              }              }             }                               $cont = $cont + 1;                    $suma2 = $row["valor_c"];            $a = $suma2 / $mult2;            $b = $a + $row["precio_adicional"]+$row["precio_material"];            $descpor = $b *$row["desc"]/100;            $b = $b - $descpor;            $ta2 = $ta2 + $b;            if($row["aprobado"]==1){                                $ch = '<IMG src="../images/autorizacion.png" ALT="Aprobado">';}else{                                  $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">Aprobar</a>';                                  }                            $sap = "SELECT sum(cantidad_aprobada) FROM pa_aprobados where barra=".$row["barra"]." ";                $fiap =mysqli_fetch_array(mysqli_query($conexion,$sap));                $cp= $fiap["sum(cantidad_aprobada)"];                if($cp==''){                    $ctt = $row['cant_ordenada'] - 0;                }else{                    $ctt = $row['cant_ordenada'] - $cp;                }                             $s3 = "SELECT sum(cantidad_despachada) FROM pa_remisionados where barra=".$row["barra"]." ";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $m= $fi3["sum(cantidad_despachada)"];                    $ctt = $cp - $m;    $pu = ($b)/$row["cantidad_c"];            $ct = $pu *  $ctt;            if($row['install']=='Si'){                $co = $ct * 0.03;                $comi = $comi + $co;                $table = $table.'<input type="hidden" style="width:70px;height:18px;" name="comi'.$cont.'" value="'.$co.'">';            }else{                $co = $ct * 0.01;                $comi = $comi + $co;                $table = $table.'<input type="hidden" style="width:70px;height:18px;" name="comi'.$cont.'" value="'.$co.'">';            }               $total2 += $ct;                if($row["remision"]==0){$check = '<input type="checkbox" checked name="valor'.$cont.'" value="'.$row["barra"].'" >';}else{$check='';}            $table = $table.'<tr><td width="3%">'.$row["co"].'</a></td>                        <td width="3%">'.$row["pedido"].'</a></td><td width="3%">'.$row["barra"].'</a></td>                        <td width="5%">'.$row['referencia_p'].'</font></td>                        <td width="25%">'.$row['prod'].'</a></td>                        <td width="7%">'.$row['medida1'].'x'.$row['medida2'].'</a></td>                          <td width="4%">'.$row["espesor_v"].'</td>                        <td  width="4%"><font color="black">'.$row['cantidad_c'].'</font></td>                            <td  width="4%"><font color="purple">'.$cp.'</font></td>                                                   <td width="4%"><input type="hidden" style="width:70px;height:18px;" name="ordenada'.$cont.'" value="'.$row['cant_ordenada'].'"><font color="green">'.$m.'</font></td>'                    . '<td  width="4%"><input type="hidden" style="width:70px;height:18px;" name="sinentregada'.$cont.'" value="'.$ctt.'"><font color="red">'.$ctt.'</font></td>                                    <td width="4%"><input type="text" style="width:40px;height:15px;" name="remisionar'.$cont.'" value="'.$ctt.'" required></td>'                    . '<td width="4%"><input type="hidden" style="width:70px;height:18px;" name="precio'.$cont.'" value="'.number_format($pu, 0, '.', '').'">'.number_format($pu).'</td><td width="4%">'.number_format($ct).'</td>                        <td  width="4%">'.$check.'</td><td  width="4%"><font color="red">'.$row['registro'].'</a></td>                                                                       </tr>';               		} 	$table = $table.'</table>';	echo $table;  } ?>                                    <table>                <tr>                    <td><label><i>Total $: </i><?php echo number_format($total2); ?></label> <input type="text" name="cant"  style="width:20px;height:20px;" readonly value="<?php echo $cont; ?>">                      <?php if($crear_rem=='Habilitado'){ ?>  <input type="submit" name="buscar" value="Despachar" class="alt_btn">  <?php  } ?>                    </td>                                   </tr>                            </table>                                      </form>      <form name="buscarA" action="<?php echo '../vistas/?id=facturar&ped='.$_GET['ped'].'&cot='.$_GET['cot'].'' ?>&remision" method="post" enctype="multipart/form-data">                                        Nota :<input type="text" style="width:90%;height:18px;" name="obs" value=""><?php$request=mysqli_query($conexion,"SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido, (c.porcentaje) as p1 FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f, pa_remisionados g where f.barra=g.barra and f.id_op=".$_GET['cot']." and f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p group by g.id_pa_rem ");     if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="3%">'.'O.P'.'</th>';                     $table = $table.'<th width="3%">'.'Ped'.'</th>';                $table = $table.'<th width="3%">'.'Codigo'.'</th>';                $table = $table.'<th width="5%">'.'Referencia'.'</th>';               $table = $table.'<th width="25%">'.'Descripcion del Producto'.'</th>';                         $table = $table.'<th width="7%">'.'Medidas (mm)'.'</th>';                           $table = $table.'<th width="4%">'.'Esp Vid (mm)'.'</th>';                                        $table = $table.'<th  width="4%">'.'Cant a Remisionar'.'</th>';                                                  $table = $table.'<th width="4%">'.'Precio Und'.'</th>';                   $table = $table.'<th width="4%">'.'Total'.'</th>';                $table = $table.'<th  width="4%">'.'Seleccionar.'.'</th>';               $table = $table.'<th  width="4%">'.'Remision #'.'</th>';                  $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;        $ta2 =0;        $cont =0;        $comi=0;        	while($row=mysqli_fetch_array($request))	{  if($row["linea_cot"]=='Aluminio'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Aluminio'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;            }else{               if($row["linea_cot"]=='Vidrio'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Vidrio'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;               }else{                if($row["linea_cot"]=='Fachada'){                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Fachada'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;               }else{                $s3 = "SELECT (".$row["p1"].") as p FROM porcentajes where area_por='Acero'";                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));                $mult2= $fi3["p"]/100;              }              }             }                               $cont = $cont + 1;                    $suma2 = $row["valor_c"];            $a = $suma2 / $mult2;//          echo number_format($a).'<br>';//          echo number_format($row["precio_adicional"]).'<br>';            $b = $a + $row["precio_adicional"]+$row["precio_material"];            $descpor = $b *$row["desc"]/100;            $b = $b - $descpor;            $ta2 = $ta2 + $b;            if($row["aprobado"]==1){                                $ch = '<IMG src="../images/autorizacion.png" ALT="Aprobado">';}else{                                  $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">Aprobar</a>';                                  }            $pu = ($b)/$row["cantidad_c"];            $ct = $pu *  $row['cantidad_despachada'];            if($row['install']=='Si'){                $co = $ct * 0.03;                $comi = $comi + $co;                $table = $table.'<input type="hidden" style="width:70px;height:18px;" name="comi'.$cont.'" value="'.$co.'">';            }else{                $co = $ct * 0.01;                $comi = $comi + $co;                $table = $table.'<input type="hidden" style="width:70px;height:18px;" name="comi'.$cont.'" value="'.$co.'">';            }                if($row["factura"]==0){$check = '<input type="checkbox" name="valor'.$cont.'" value="'.$row["id_pa_rem"].'" >';}else{$check='';}            $table = $table.'<tr><td width="3%">'.$row["co"].'</a></td>                        <td width="3%">'.$row["pedido"].'</a></td><td width="3%">'.$row["barra"].'</a></td>                        <td width="5%">'.$row['referencia_p'].'</font></td>                        <td width="25%">'.$row['prod'].'</a></td>                        <td width="7%">'.$row['medida1'].'x'.$row['medida2'].'</a></td>                                            <td width="4%">'.$row["espesor_v"].'</td>                            <td  width="4%"><input type="hidden" style="width:70px;height:18px;" name="ca'.$cont.'" value="'.$row['cantidad_despachada'].'">'.$row['cantidad_despachada'].'</td>'                    . '<td width="4%"><input type="hidden" style="width:70px;height:18px;" name="precio'.$cont.'" value="'.number_format($pu, 0, '.', '').'">'.number_format($pu).'</td><td width="4%">'.number_format($ct).'</td>                        <td  width="4%">'.$check.'</td>                        <td  width="4%">'.$row['factura'].'</td>                                                </tr>';               		} 	$table = $table.'</table>';        	echo $table;  } ?>                                    <table>                <tr>                    <td><label><i>Total de Ordenes: </i></label> <input type="text" name="cantr"  style="width:20px;height:20px;" readonly value="<?php echo $cont; ?>">                      <?php if($crear_rem=='Habilitado'){ ?>  <input type="submit" name="buscar" value="Remisionar" class="alt_btn">  <?php  } ?>                    </td>                                   </tr>                            </table>                                      </form>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                             </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div>     <?phpfunction valorEnLetras($x) { if ($x<0) { $signo = "menos ";} else      { $signo = "";} $x = abs ($x); $C1 = $x; $G6 = floor($x/(1000000));  // 7 y mas $E7 = floor($x/(100000)); $G7 = $E7-$G6*10;   // 6 $E8 = floor($x/1000); $G8 = $E8-$E7*100;   // 5 y 4 $E9 = floor($x/100); $G9 = $E9-$E8*10;  //  3 $E10 = floor($x); $G10 = $E10-$E9*100;  // 2 y 1 $G11 = round(($x-$E10)*100,0);  // Decimales ////////////////////// $H6 = unidades($G6); if($G7==1 AND $G8==0) { $H7 = "Cien "; } else {    $H7 = decenas($G7); } $H8 = unidades($G8); if($G9==1 AND $G10==0) { $H9 = "Cien "; } else {    $H9 = decenas($G9); } $H10 = unidades($G10); if($G11 < 10) { $H11 = "0".$G11; } else { $H11 = $G11; } /////////////////////////////     if($G6==0) { $I6=" "; } elseif($G6==1) { $I6="Millon "; }          else { $I6="Millones "; }           if ($G8==0 AND $G7==0) { $I8=" "; }          else { $I8="Mil "; }           $I10 = "Pesos "; $I11 = "ML. "; $C3 = $signo.$H6.$I6.$H7.$H8.$I8.$H9.$H10.$I10.$I11; return $C3; //Retornar el resultado } function unidades($u) {     if ($u==0)  {$ru = " ";} elseif ($u==1)  {$ru = "Un ";} elseif ($u==2)  {$ru = "Dos ";} elseif ($u==3)  {$ru = "Tres ";} elseif ($u==4)  {$ru = "Cuatro ";} elseif ($u==5)  {$ru = "Cinco ";} elseif ($u==6)  {$ru = "Seis ";} elseif ($u==7)  {$ru = "Siete ";} elseif ($u==8)  {$ru = "Ocho ";} elseif ($u==9)  {$ru = "Nueve ";} elseif ($u==10) {$ru = "Diez ";} elseif ($u==11) {$ru = "Once ";} elseif ($u==12) {$ru = "Doce ";} elseif ($u==13) {$ru = "Trece ";} elseif ($u==14) {$ru = "Catorce ";} elseif ($u==15) {$ru = "Quince ";} elseif ($u==16) {$ru = "Dieciseis ";} elseif ($u==17) {$ru = "Decisiete ";} elseif ($u==18) {$ru = "Dieciocho ";} elseif ($u==19) {$ru = "Diecinueve ";} elseif ($u==20) {$ru = "Veinte ";} elseif ($u==21) {$ru = "Veintiun ";} elseif ($u==22) {$ru = "Veintidos ";} elseif ($u==23) {$ru = "Veintitres ";} elseif ($u==24) {$ru = "Veinticuatro ";} elseif ($u==25) {$ru = "Veinticinco ";} elseif ($u==26) {$ru = "Veintiseis ";} elseif ($u==27) {$ru = "Veintisiente ";} elseif ($u==28) {$ru = "Veintiocho ";} elseif ($u==29) {$ru = "Veintinueve ";} elseif ($u==30) {$ru = "Treinta ";} elseif ($u==31) {$ru = "Treintayun ";} elseif ($u==32) {$ru = "Treintaydos ";} elseif ($u==33) {$ru = "Treintaytres ";} elseif ($u==34) {$ru = "Treintaycuatro ";} elseif ($u==35) {$ru = "Treintaycinco ";} elseif ($u==36) {$ru = "Treintayseis ";} elseif ($u==37) {$ru = "Treintaysiete ";} elseif ($u==38) {$ru = "Treintayocho ";} elseif ($u==39) {$ru = "Treintaynueve ";} elseif ($u==40) {$ru = "Cuarenta ";} elseif ($u==41) {$ru = "Cuarentayun ";} elseif ($u==42) {$ru = "Cuarentaydos ";} elseif ($u==43) {$ru = "Cuarentaytres ";} elseif ($u==44) {$ru = "Cuarentaycuatro ";} elseif ($u==45) {$ru = "Cuarentaycinco ";} elseif ($u==46) {$ru = "Cuarentayseis ";} elseif ($u==47) {$ru = "Cuarentaysiete ";} elseif ($u==48) {$ru = "Cuarentayocho ";} elseif ($u==49) {$ru = "Cuarentaynueve ";} elseif ($u==50) {$ru = "Cincuenta ";} elseif ($u==51) {$ru = "Cincuentayun ";} elseif ($u==52) {$ru = "Cincuentaydos ";} elseif ($u==53) {$ru = "Cincuentaytres ";} elseif ($u==54) {$ru = "Cincuentaycuatro ";} elseif ($u==55) {$ru = "Cincuentaycinco ";} elseif ($u==56) {$ru = "Cincuentayseis ";} elseif ($u==57) {$ru = "Cincuentaysiete ";} elseif ($u==58) {$ru = "Cincuentayocho ";} elseif ($u==59) {$ru = "Cincuentaynueve ";} elseif ($u==60) {$ru = "Sesenta ";} elseif ($u==61) {$ru = "Sesentayun ";} elseif ($u==62) {$ru = "Sesentaydos ";} elseif ($u==63) {$ru = "Sesentaytres ";} elseif ($u==64) {$ru = "Sesentaycuatro ";} elseif ($u==65) {$ru = "Sesentaycinco ";} elseif ($u==66) {$ru = "Sesentayseis ";} elseif ($u==67) {$ru = "Sesentaysiete ";} elseif ($u==68) {$ru = "Sesentayocho ";} elseif ($u==69) {$ru = "Sesentaynueve ";} elseif ($u==70) {$ru = "Setenta ";} elseif ($u==71) {$ru = "Setentayun ";} elseif ($u==72) {$ru = "Setentaydos ";} elseif ($u==73) {$ru = "Setentaytres ";} elseif ($u==74) {$ru = "Setentaycuatro ";} elseif ($u==75) {$ru = "Setentaycinco ";} elseif ($u==76) {$ru = "Setentayseis ";} elseif ($u==77) {$ru = "Setentaysiete ";} elseif ($u==78) {$ru = "Setentayocho ";} elseif ($u==79) {$ru = "Setentaynueve ";} elseif ($u==80) {$ru = "Ochenta ";} elseif ($u==81) {$ru = "Ochentayun ";} elseif ($u==82) {$ru = "Ochentaydos ";} elseif ($u==83) {$ru = "Ochentaytres ";} elseif ($u==84) {$ru = "Ochentaycuatro ";} elseif ($u==85) {$ru = "Ochentaycinco ";} elseif ($u==86) {$ru = "Ochentayseis ";} elseif ($u==87) {$ru = "Ochentaysiete ";} elseif ($u==88) {$ru = "Ochentayocho ";} elseif ($u==89) {$ru = "Ochentaynueve ";} elseif ($u==90) {$ru = "Noventa ";} elseif ($u==91) {$ru = "Noventayun ";} elseif ($u==92) {$ru = "Noventaydos ";} elseif ($u==93) {$ru = "Noventaytres ";} elseif ($u==94) {$ru = "Noventaycuatro ";} elseif ($u==95) {$ru = "Noventaycinco ";} elseif ($u==96) {$ru = "Noventayseis ";} elseif ($u==97) {$ru = "Noventaysiete ";} elseif ($u==98) {$ru = "Noventayocho ";} else            {$ru = "Noventaynueve ";} return $ru; //Retornar el resultado } function decenas($d) {     if ($d==0)  {$rd = "";} elseif ($d==1)  {$rd = "Ciento ";} elseif ($d==2)  {$rd = "Doscientos ";} elseif ($d==3)  {$rd = "Trescientos ";} elseif ($d==4)  {$rd = "Cuatrocientos ";} elseif ($d==5)  {$rd = "Quinientos ";} elseif ($d==6)  {$rd = "Seiscientos ";} elseif ($d==7)  {$rd = "Setecientos ";} elseif ($d==8)  {$rd = "Ochocientos ";} else            {$rd = "Novecientos ";} return $rd; //Retornar el resultado }if(isset($_GET['fact'])){    if(isset($_POST["cant"]))    {        $n = $_POST["cant"];        $total = 0;        for($x=1; $x<=$n; $x=$x+1){            if(isset($_POST["valor$x"])){                include "../modelo/conexion.php";                if($_POST["remisionar$x"] > $_POST["sinentregada$x"]){                     echo '<script lanquage="javascript">alert("La cantidad a despachar es mayor a la que hay");location.href="../vistas/?id=facturar&ped='.$_GET['ped'].'&cot='.$_GET['cot'].'"</script>';                }else{                                      $restante =   $_POST["ordenada$x"] -  $_POST["sinentregada$x"];                        $insu = "UPDATE `procesos_activos` SET  estado_2='', precio_cobrado='".$_POST["precio$x"]."', cant_entregada='".$_POST["sinentregada$x"]."', cant_restante='".$restante."' WHERE  `barra`='".$_POST["valor$x"]."'";                        mysqli_query($conexion,$insu);                                                $s = $_POST["precio$x"] * $_POST["ordenada$x"];                        $total = $total + $s;                                                                        $sqld = "INSERT INTO `pa_remisionados`(`barra`,`cantidad_despachada`,`estado_desp`)";                        $sqld.= "VALUES ('".$_POST["valor$x"]."','".$_POST["remisionar$x"]."', 'Despachado')";                        mysqli_query($conexion,$sqld);                                 echo 'El Items No. :'.$_POST["valor$x"].' ha sido Despachada, El No. de Remision es :'.$factura.'<br>';                        }                                    }             echo '<script lanquage="javascript">alert("Se ha despachado para remisionar");location.href="../vistas/?id=facturar&ped='.$_GET['ped'].'&cot='.$_GET['cot'].'"</script>';        }                          }    }    if(isset($_GET['remision'])){             include "../modelo/conexion.php";$sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas";$fila1 =mysqli_fetch_array(mysqli_query($conexion,$sql1));$factura = $fila1["id_inc"]+1;  if(isset($_POST["cantr"]))    {        $n = $_POST["cantr"];        $total = 0;$cc=0;        for($x=1; $x<=$n; $x=$x+1){            if(isset($_POST["valor$x"])){                include "../modelo/conexion.php";                                                                             $insu = "UPDATE `pa_remisionados` SET  estado_desp='Facturado', factura='".$factura."' WHERE  `id_pa_rem`='".$_POST["valor$x"]."'";                        mysqli_query($conexion,$insu);                        $s = $_POST["precio$x"] * $_POST["ca$x"];                        $total = $total + $s;                        $cc = $cc + $_POST["comi$x"];         echo 'El Items No. :'.$_POST["valor$x"].' ha sido Despachada, El No. de Remision es :'.$factura.', '.$_POST["remisionar$x"].','.$_POST["ordenada$x"].'<br>';                                                            }                    }                          }        if($total!=0){$cambio = valorEnLetras($total);         $forma_pago = '30 DIAS';        $meses = '1';        $pago_pendiente = 'Si';                $copagos = 0;        $fecha_reg= date("Y-m-d H:i:s");       $com = $total * 0.01;              	$sql = "INSERT INTO `facturas`(`copagos`,`letras`,`fechai`, `fechaf`,`numero_factura`, `id_cliente`, `forma_pago`, `meses`, `pago_pendiente`, `total`, `fecha_registro`, `detalle`, `descuento`, `tipo_cliente`, `numero_pedido`, `cotizacion`, `registrado_por`, `asesor`, `comision`)";        $sql.= "VALUES ('".$copagos."','".$cambio."','".$fecha."', '".$fecha_reg."','".$factura."', '".$id_cliente."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$total."', '".$fecha_reg."', '".$_POST['obs']."', '".$descuento."', '".$tipo."', '".$_GET['ped']."', '".$_GET['cot']."', '".$_SESSION['nombre']."', '".$fila21["registrado"]."', '".$cc."')";	mysqli_query($conexion,$sql);}     echo '<script lanquage="javascript">alert("Se ha Remisionado los items seleccionados, Factura #'.$factura.' ");location.href="../vistas/?id=facturar&ped='.$_GET['ped'].'&cot='.$_GET['cot'].'"</script>';}