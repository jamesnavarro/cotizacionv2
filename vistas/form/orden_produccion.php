<?php require '../modelo/conexion.php';  if(isset($_GET['cot'])){            $sq = "SELECT * FROM orden_produccion  where  id_orden=".$_GET['op'];            $fil =mysql_fetch_array(mysql_query($sq));               $congelado= $fil["congelado"];               $opf= $fil["opf"];               $sql21 = "SELECT * FROM cotizacion where id_cot=".$_GET['cot'];            $fila21 =mysql_fetch_array(mysql_query($sql21));              $id= $fila21["id_cot"];            $tipo= $fila21["tipo"];            $obra= $fila21["obra"];            $ubicacion= $fila21["ubicacion"];            $linea= $fila21["linea"];            $orden_p= $fila21["orden"];            $estado= $fila21["estado"];            $id_cliente= $fila21["id_tercero"];            $asesor= $fila21["registrado"];            $responsable= $fila21["responsable"];             $tel_responsable= $fila21["tel_responsable"];              $ciudad= $fila21["ciudad"];              $costo_total= $fila21["costo_total"];              $costo_instalacion= $fila21["costo_instalacion"];              $descuento= $fila21["descuento"];              $fecha= $fila21["fecha_reg_c"];$tipo= $fila21["tipo"];                           $con= "SELECT * FROM `cont_terceros` where id_ter=".$id_cliente."";    $res=  mysql_query($con);    while($f=  mysql_fetch_array($res)){       $doc=$f['doc_ter'];    $direccion=$f['dir_ter'];    $telefono_cli=$f['telfijo_ter'];    $contacto=$f['nom_ter'];    $tel_cont=$f['telmovil_ter'];    $email=$f['correo_ter'];    $propietario =$f['cont_ter'];    }            } if(isset($_GET['ok'])){     include '../modelo/conexion.php';  $sql = "UPDATE `cotizaciones` SET `aprobado` = '1' WHERE `id_cot` = ".$_GET['cot'].""; mysql_query($sql, $conexion);echo '<script lanquage="javascript">alert("Se ha aprobado la cotizacion");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; } if(isset($_GET['ped'])){                         $sql = "SELECT * FROM cotizacion where id_cot=".$_GET['cot']."";            $fila2 =mysql_fetch_array(mysql_query($sql));            $estado= $fila2["estado"];            $orden= $fila2["orden"];            $ubicacion= $fila2["ubicacion"];            $obra= $fila2["obra"];            $id_cliente= $fila2["id_cliente"];            $asesor= $fila2["registrado"];            $responsable= $fila2["responsable"];            $tel_obra= $fila2["tel_responsable"];            $ciudad_obra= $fila2["ciudad"];             $fecha= $fila2["fecha_reg_c"];                        if($estado!="Ordenado"){                include '../modelo/conexion.php';                $sql210 = "SELECT max(orden) FROM cotizacion";                $fila210 =mysql_fetch_array(mysql_query($sql210));                $op= $fila210["max(orden)"] + 1;                $sql8 = "UPDATE `cotizacion` SET `estado` = 'Ordenado', orden=".$op." WHERE `id_cot` = ".$_GET['cot']."";                mysql_query($sql8, $conexion);                                $f1 = date("Y-m-d");                $fi = date("Y-m-d");                $ff = date("Y-m-d");                                                $sqlo = "INSERT INTO `orden_produccion`(`sede_op`,`proyecto`, `numero`, `fecha_registro`, `fecha_i`, `fecha_f`, `id_cliente`, `estado_o`)";                $sqlo.= "VALUES ('Vidrio','".$obra."', '".$op."', '".$f1."', '".$fi."', '".$ff."', '".$id_cliente."', 'En proceso')";                mysql_query($sqlo);                            }                                $sqlx = "SELECT * FROM cotizacion a, clientes b where a.id_cliente=b.id_cli and a.id_cot=".$_GET['cot'];            $filax =mysql_fetch_array(mysql_query($sqlx));            $orden_px= $filax["orden"];                         $sql21 = "SELECT max(num_pedido) FROM cotizaciones where id_cot=".$_GET['cot'];            $fila21 =mysql_fetch_array(mysql_query($sql21));            $p= $fila21["max(num_pedido)"] + 1;  $sql = "UPDATE `cotizaciones` SET `estado_c` = 'Pedido', num_pedido=".$p.", orden=".$orden_px." WHERE `id_cot` = ".$_GET['cot'].""; mysql_query($sql, $conexion);   echo '<script lanquage="javascript">alert("Se ha generado el pedido");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; } if(isset($_GET['op'])){ $sql21 = "SELECT * FROM orden_produccion a, usuarios b where a.generado_user=b.id_user and a.id_orden=".$_GET['op'];            $fila21 =mysql_fetch_array(mysql_query($sql21));            $fechaop = $fila21["fecha_registro"];            $generado = $fila21["nombre"].' '.$fila21["apellido"];            $id_rep = $fila21["id_reposicion"];     } ?><script language='javascript'>function cliente(){catPaises = window.open('../vistas/form_cliente.php', 'contacto', 'width=500,height=600');}function enfermedad(){catPaises = window.open('../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');}</script><script language="javascript" type="text/javascript">function dato(val7, val8, val5, val6, val9, val10, val11, val12){    document.getElementById('valor7').value = val7;    document.getElementById('valor8').value = val8;    document.getElementById('valor5').value = val5;    document.getElementById('valor6').value = val6;    document.getElementById('valor9').value = val9;    document.getElementById('valor10').value = val10;    document.getElementById('valor11').value = val11;    document.getElementById('valor12').value = val12;}</script><div class="row-fluid">                        <!-- START Form Wizard -->                            <section class="body">                                                                                                <div class="control-group">                                     <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../vistas/?id=new_fac&consultar'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                         <header><h4 class="title"><?php if(isset($_GET['cot'])){if($orden_p!=0){echo 'Orden de Produccion. '.$_GET['op'];}else{if(isset($_GET['cot'])){echo 'Cotizacion No.'. $_GET['cot'];}else{echo 'Generar Cotizacion de Producto';} }}else{echo 'Generar Cotizacion de Producto';} ?></h4></header>                                                                                  <div class="body-inner">                                                                           <table class="table table-bordered table-striped table-hover" id="">                                                                                       <tr><td><b>Fecha de Registro O.P: <?php  if(isset($_GET['cot'])){echo $fechaop;}  ?></b></td><td><b>Fecha de Pedido : <?php  if(isset($_GET['cot'])){echo $fecha;}  ?></b></td></tr>                                            <tr><th colspan="4" align="center"  bgcolor= "" >Informacion del Cliente</th></tr><tr><td></td><td></td>  <th bgcolor="yellow"><?php if(isset($_GET['cot'])){if($estado=='Cotizado'){echo 'Cotizacion No.'; }else{echo 'Pedido No.';}} ?></th>  <th style="background: yellow;"><?php if(isset($_GET['cot'])){if($estado=='Cotizado'){echo $_GET['cot']; }else{echo $orden_p;}} ?></th></tr><tr><td>Nombre del Cliente:</td><td>                                                                   <?php if(isset($_GET['cot'])){        echo $contacto;} ?>    </td><td>Cedula / Nit.</td><td  id="cedula"><?php  if(isset($_GET['cot'])){echo $doc;}  ?></td></tr><tr><td>Direccion del cliente:</td><td id='direccion'><?php  if(isset($_GET['cot'])){echo $direccion;}  ?></td><td>Telefono :</td><td id='telefono'><?php  if(isset($_GET['cot'])){echo $telefono_cli;}  ?></td></tr><tr>    <td>Nombre del Contacto:</td>    <td id='contacto'><?php  if(isset($_GET['cot'])){echo $propietario;}  ?></td>    <td>Telefono del Contacto:</td>    <td id='tel_cont'><?php  if(isset($_GET['cot'])){echo $tel_cont;}  ?></td></tr><tr>    <td>Correo Electronico </td>    <td id='email'><?php  if(isset($_GET['cot'])){echo $email;}  ?></td>    <td>O.P. Fom <font color='red'><?php echo $opf; ?></font></td>    <td></td></tr><tr>    <th colspan="4" align="center"  bgcolor= "" >Informacion de la Obra</th></tr><tr>    <td>Nombre de la obra:</td>    <td><?php  if(isset($_GET['cot'])){echo $obra;}  ?></td>    <td>Telefono:</td>    <td><?php  if(isset($_GET['cot'])){echo $tel_responsable;}  ?></td></tr><tr>    <td>ubicacion de la obra:</td>    <td><?php  if(isset($_GET['cot'])){echo $ubicacion;}  ?></td>    <td>Ciudad: </td>    <td><?php  if(isset($_GET['cot'])){echo $ciudad;}  ?></td></tr><tr>    <td>Encargado de la Obra:</td>    <td><?php  if(isset($_GET['cot'])){echo $responsable;}  ?></td>    <td>Asesor: </td>    <td><?php  if(isset($_GET['cot'])){echo $asesor;}else{echo $_SESSION['k_username'];}  ?></td></tr><b>Orden de Prducción Generada Por: <?php echo $generado; ?></b></table>                                                                                                                                                        <!-- Form Action -->                                                                         </form><br>                                    <?php                                    if(isset($_GET['consultar'])){                                            $sql = "INSERT INTO `cotizacion` (`instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`id_cliente`, `registrado`, `estado`, `obra`, `ubicacion`, `linea`)";                                            $sql.= "VALUES ('Si','p1','No','".$_POST['encargado']."','".$_POST['tel_o']."','".$_POST['ciudad_obra']."','".$_POST['id_cli']."', '".$_SESSION['k_username']."', 'Cotizado', '".$_POST['obra']."', '".$_POST['ubicacion']."', 'Aluminio')";                                            mysql_query($sql, $conexion);                                            $status = "ok";                                            $sql21 = "SELECT max(id_cot) FROM cotizacion";                                            $fila21 =mysql_fetch_array(mysql_query($sql21));                                            $max= $fila21["max(id_cot)"];                                            echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=new_fac&cot=".$max."&cli=".$_POST['id_cli']."'";echo "</script>";                                    }                           if(isset($_GET['cot'])){         ?>                                                                                           <?php } ?>                                                                  </section>                                                <!--/ END Form Wizard -->                    </div>                      <?php if(isset($_GET['consultar'])){ ?>                                        <?php require '../modelo/conexion.php'; if(isset($_GET['consultar']) || isset($_GET['cod'])){ $sql='select * from producto where id_p="'.$_POST["ref"].'"'; $fil =mysql_fetch_array(mysql_query($sql));        $id_p= $fil["id_p"];        $producto= $fil["producto"];        $tipo= $fil["tipo"];        $codigo= $fil["codigo"];        $variable= $fil["tipo_vidrio"];        $color_v= $fil["color_vidrio"];        $color_a= $fil["color_alu"];        $ancho= $fil["ancho"];        $alto= $fil["alto"]; } ?><?php } ?>                                          <div class="control-group"><!--                                        <div class="alert">                                            <button type="button" class="close" data-dismiss="alert">×</button>                                       <?phpif(isset($_GET['consultar'])){$total = $ta + $tv + $tac;echo "El valor total de los insumos son: $".number_format($total);} if(isset($_GET['del'])){ $sql = "DELETE FROM cotizaciones WHERE id_cotizacion=".$_GET['del'].""; mysql_query($sql, $conexion); echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=new_fac&cot=".$_GET['cot']."&cli=".$_GET['cli']."'";echo "</script>";}?>                                                </div>-->                                    </div>     <?php if(isset($_GET['cot'])){           include '../vistas/form/generar_orden_produccion.php'; }?>                                          <br>     <br>    <br>   