<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
        case 1:
            include 'perfiles.php'; 

            break;
             case 2:
                 $item = $_GET['item'];
                 $cod = $_GET['cod'];
                 $ref = $_GET['ref'];
                 $col = $_GET['col'];
                 $med = $_GET['med'];
                 $und = $_GET['und'];
                 $can = $_GET['can'];
                 $per = $_GET['per'];
                 $cot= $_GET['cot'];
                 $tipo= $_GET['tipo'];
                 $sis= $_GET['sis'];
                 $id= $_GET['id'];
                 $result = mysqli_query($conexion,"INSERT INTO `desgloses_material` (`numeroitem`,`id_cot`, `id_cot_item`, `referencia`, `codigo_pro`, `cantidad`, `medida`, `color`, `tipo`, `linea`, `usuario`, `perfil`, `canperfil`, `sistemaper`)"
                         . " VALUES ('$id','$cot', '$item', '$ref', '$cod', '$und', '$med', '$col', '$tipo', 'Perfileria', '".$_SESSION['k_username']."', '$per', '$can', '$sis'); ") ;
                 
                 echo '<img src="../images/autorizacion.png"> '.$result.' id:'.$id;
                
            break;
        
          case 2.1:
                 $item = $_GET['item'];
                 $idv = $_GET['idv'];
                 $col = $_GET['col'];
                 $esp = $_GET['esp'];
                 $pes = $_GET['pes'];
                 $area = $_GET['area'];
                 $cot= $_GET['cot'];
                 $id= $_GET['id'];
                 $result = mysqli_query($conexion,"INSERT INTO `desgloses_vidrios` (`numeroitem`,`id_cot`, `id_cot_item`, `referencia`, `espesor`, `linea`, `usuario`, `peso`, `area`)"
                    . " VALUES ('$id','$cot', '$item','$col', '$esp', 'Vidrio', '".$_SESSION['k_username']."', '$pes', '$area'); ") ;
                 echo '<img src="../images/autorizacion.png"> '.$result.' id:'.$id;
            break;
            case 3:
                $reques=mysqli_query($conexion,"SELECT *, medida, sum(medida*cantidad) as med, sum(cantidad) as can FROM desgloses_material  where linea='Perfileria' and id_cot=".$_GET["cot"]." and cantidad!=0 group by referencia, medida order by referencia asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $resnombre = mysqli_query($conexion,"select * from referencias where referencia='".$rowp['referencia']."' group by referencia ");
                     $name = mysqli_fetch_array($resnombre);
                     $contador++;
                     if($ref!=$rowp['referencia']){
                         if($sw==0){
                           $color='#F3EFEE'; //1
                           $sw=1;
                        }else{
                            $color='#C6C5C5'; //0
                            $sw=0;
                        }
                     }else{
                         if($sw==0){
                           $color='#C6C5C5'; //1
                           $sw=0;
                        }else{
                            $color='#F3EFEE'; //0
                            $sw=1;
                        }
                     }
                     $resultc = mysqli_query($conexion,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     $ref = $rowp['referencia'];
                     $medtotal = $rowp['med'];
                     $canper = ($rowp['med'])/($rowp['perfil']-100);
                     $referencia = "'".$rowp['referencia']."'";
                     $mystring = $name['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $name['descripcion'];
                    } else {
                        $descripcion = substr($name['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
                     echo '<tr style="background:'.$color.'">'
                             . '<td>'.$contador.'</td>'
                             . '<td><input type="text" id="refe'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['referencia'].'" disabled></td>'
                             . '<td>'.$descripcion.' '.$rowp['perfil'].'MM</td>'
                             . '<td><input type="text" id="sist'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$name['sistema'].'" onclick="cambiarsistema('.$rowp['id_desglose'].')"></td>'
                             . '<td>'.$rc[0].'</td>'
                             . '<td>'.$name['dado'].'</td>'
                             . '<td> <input type="checkbox" id="'.$rowp['id_desglose'].'" name="item" onclick="veri('.$referencia.')"> <input type="text" id="medi'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['medida'].'" disabled></td>'
                             . '<td>'.$rowp['can'].'</td>'
                             . '<td>'.$medtotal.'</td>'
                             . '<td><input type="text" id="perf'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['perfil'].'" onchange="cambiarperfil('.$rowp['id_desglose'].')"></td>'
                             . '<td>'.ceil($canper).'</td>';
                 }
            break;
            case 3.1:
                $reques=mysqli_query($conexion,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can,a.observaciones, b.id_referencia FROM desgloses_material a, referencias b where a.linea='Perfileria' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.referencia, a.perfil order by b.sistema asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                $ttppint=0;
                $cantidad_perfil = 0;
                $peso_total = 0;
                $area_total = 0;
                $peso_pintura = 0;
                $total_crudo = 0;
                $total_pintura = 0;
                $grantotal = 0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     
                     
                     
                 $medres = mysqli_query($conexion,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' ");
                 $md = mysqli_fetch_array($medres);
                 
                     $medtotal = $md['med'];
                     $canper = $md['med']/($rowp['perfil']-100);
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*ceil($canper);
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area']/1000;
                     }
                     if($rowp['color']=='01'){
                         $crudo = 'ANONIZADO';
                         $codcolor = '01';
                     }else{
                         $crudo = 'CRUDO';
                         $codcolor = '00';
                     }
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                     $resultc = mysqli_query($conexion,"select color_ta, id_dolar from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
                     
                     //--------- consultar precio referencia del presupuesto-------
                     
                     $pdlr = "select precio_actual from dolar_relaciones where id_referencia=".$rowp['id_referencia']." and id_dolar=".$rc['id_dolar']."  ";
                     $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
                     $precio_actual= $fia["precio_actual"];
        
                     
                     
                     //------------------------------------------------------------
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($conexion,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= ($fia4["rendimiento"]==0)? 1:$fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    $costo_total_pintura = $canpin * $vc;
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    $queryma = mysqli_query($conexion,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                    $mystring = $rowp['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowp['descripcion'];
                    } else {
                        $descripcion = substr($rowp['descripcion'],0,-6);
                    }
                    if($contador==1){
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                          
                        }
                    if($sistema!=$rowp['sistema']){
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                     }
                     if($rowp['user']==''){
                         $modi='';
                     }else{
                         $modi='<br> Modificado por: '.$rowp['user'].' el '.$rowp['fecmodifica'];
                     }
                    
                     $ref = $rowp['referencia'];
                     $refe = "'".$rowp['referencia']."'";
                     $sistema = $rowp['sistema'];
                     $codigo = $ref.'-'.$codcolor.substr($rowp['perfil'],0,2);
                     if($rowp['dado']=='RECT0101'){
                         $mos = $canper.' = '.$md['med'].'/'.($rowp['perfil']-100);
                     }else{
                          $mos = '*';
                     }
                     $ref = "'".$rowp['referencia']."'";
                     $perfil = "'".$rowp['perfil']."'";
                     $totpinalum = $valor_aluminio+$costo_total_pintura;
                     $ttppint += $totpinalum;
                     $cantidad_perfil += ceil($canper);
                     $peso_total += $pst;
                     $area_total += $areat;
                     $peso_pintura += $canpin;
                     $total_crudo += $valor_aluminio;
                     $total_pintura += $costo_total_pintura;
                     $medtotal = ceil($canper) * $rowp['perfil'];
                     
                     $precio_total = ($precio_actual * ($medtotal/1000))+$costo_total_pintura;
                     $grantotal += $precio_total; 
                     echo '<tr>'
                             . '<td>'.$contador.'</td>'
                            . '<td>'.ceil($canper).'</td>'
                             . '<td>'.$rowp['referencia'].'<button  data-toggle="modal" data-target="#ModalEditarX" onclick="verperfiles('.$refe.','.$rowp['perfil'].')">!</button></td>'
                             . '<td>'.$codigo.'</td>'
                             . '<td>'.$descripcion.' '.$rowp['perfil'].'MM '.$modi.'</td>'
                             . '<td>'.$crudo.'</td>'
                             . '<td>'.$rc[0].'</td>'
                             . '<td>'.substr($ventana,0,-1).'</td>'
                             . '<td>'.$rowp['perfil'].'</td>'
                             . '<td>'.$rowp['dado'].'</td>'
                             . '<td>'.number_format($rowp['peso'],3).' Kg <br>$ '.$rowp['costo_fom'].'</td>'
                             . '<td>'.number_format($pst,3).' Kg</td>'
                             . '<td>'.$area.'</td>'
                             . '<td>'.$areat.'</td>'
                             . '<td>'.$rendimiento.'</td>'
                             . '<td>'.$canpin.'</td>'
                             . '<td>'.number_format($vc).'</td>'
                             . '<td>'.number_format($valor_aluminio).'</td>'
                             . '<td>'.number_format($costo_total_pintura).'</td>'
                             . '<td>'.number_format($totpinalum).'</td>'
                             . '<td>'.number_format($precio_total).'</td>'
                             . '<td><input type="text" id="obs'.$contador.'" onchange="upobs('.$ref.','.$perfil.','.$rowp['id_cot'].','.$contador.')" value="'.$rowp['observaciones'].'"></td>';

                 }
                 echo '<tr style="background-color: yellow">'
                    . '<td></td>'
                    . '<td>'.$cantidad_perfil.'</td>'
                    . '<td colspan="9"><center>TOTALES</center></td>'
                    . '<td>'.number_format($peso_total,2).' Kg</td>'
                         . '<td></td>'
                         . '<td>'.number_format($area_total,2).'</td>'
                         . '<td></td>'
                         . '<td>'.number_format($peso_pintura,2).' Kg</td>'
                         . '<td></td>'
                         . '<td>'.number_format($total_crudo).'</td>'
                         . '<td>'.number_format($total_pintura).'</td>'
                         . '<td>'.number_format($ttppint).'</td>'
                         . '<td>'.number_format($grantotal).'</td><td>-</td>';
               
            break;
             case 4:
                 $ids = $_GET['ids'];
                $reques=mysqli_query($conexion,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where a.codigo_pro=b.codigo and a.id_desglose in ($ids) and cantidad!=0 group by a.referencia, a.medida order by b.sistema asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                echo '<table class="table table-bordered table-striped table-hover" id="tabla2">';
                $idg = '';
                $sistema = '';
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     $sw +=$rowp['medida'];
                     $ref = $rowp['referencia'];
                     $medtotal = $rowp['med'];
                     $canper = $rowp['med']/$rowp['perfil'];
                     $referencia = "'".$rowp['referencia']."'";
                     echo '<tr>'
                     . '<td>'.$contador.'</td>'
                     . '<td><input type="text" id="refe'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['referencia'].'" disabled></td>'
                     . '<td> <input type="checkbox" id="'.$rowp['id_desglose'].'" name="item" onclick="veri('.$referencia.')"> '.$rowp['medida'].'</td>'
                     . '<td>'.$rowp['perfil'].'</td>';
                     $idg = $idg.$rowp['id_desglose'].',';
                     $sistema = $rowp['sistema'];
                 }
                 $idg = $idg.'';
                 echo '<tr>'
                 . '<td><input type="hidden" id="idxx" style="width:80px;text-align:center" value="'.substr($idg, 0,-1).'" disabled></td>'
                 . '<td><input type="text" id="ref" style="width:80px;text-align:center" value="'.$ref.'" disabled></td>'
                 . '<td><input type="text" id="MT" style="width:80px;text-align:center" value="'.$sw.'" disabled> X '
                 . '<input type="text" id="vr" style="width:80px;text-align:center" value="1" onchange="multiplicar()"> = </td>'
                 . '<td><input type="text" id="pt" style="width:80px;text-align:center" value="'.$sw.'" disabled> <button onclick="updateperfil()">Up</button></td>';
               echo '</table>';
            break;
        case 5:
             $cot = $_GET['cot'];
             $ref = $_GET['ref'];
             $perfil = $_GET['perfil'];
             $med = $_GET['med'];
             $id = $_GET['id'];
             $sql = "update desgloses_material set perfil='$perfil' where id_cot='$cot' and referencia ='$ref' and medida='$med' ";
             $ver = mysqli_query($conexion,"update desgloses_material set perfil='$perfil' where id_cot='$cot' and referencia ='$ref' and medida='$med' ");
        if($ver){
            echo 'Se actualizo con exito';
        }else{
            echo 'Hubo un error al actualizar'. $sql;
        }
            break;
            case 6:
             $cot = $_GET['cot'];
             $ref = $_GET['ref'];
             $sis = $_GET['sis'];
             echo $sis;
             $ver = mysqli_query($conexion,"update referencias set sistema='$sis', modificado='".$_SESSION['k_username']."', fecha_modificado='".date("Y-m-d H:i:s")."'  where referencia='$ref'  ") ;
             if($ver){
                 echo 'Se ha actualizado con exito';
             }else{
                 echo 'Ocurrio un error y no se actualizo!';
             }
             break;
             case 7:
            $cot = $_GET['cot'];
            $query = mysqli_query($conexion,"select *, sum(area) as a, sum(peso) as p from desgloses_vidrios where id_cot='$cot' group by referencia  ");
            $c = 0;
            $gt = 0;
            while($fila = mysqli_fetch_array($query)){
                $c++;
                $pdlr2 = "select costo_v,codigo_vid from tipo_vidrio where color_v='".$fila['referencia']."'   ";
                     $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr2));
                     $precio_actual= $fia["costo_v"];
                     $tt = $precio_actual * ceil($fila['a']);
                     $gt += $tt;
                echo '<tr>'
                . '<td>'.$fia['codigo_vid'].'</td>'
                . '<td>'.$fila['referencia'].'</td>'
                . '<td>'.$fila['espesor'].'MM</td>'
                . '<td>'.ceil($fila['a']).' mt<sup>2</sup></td>'
                . '<td>'.number_format($fila['p'],2).' Kg</td>'
                . '<td>'.number_format($precio_actual).'</td>'
                . '<td>'.number_format($tt).'</td>';
            }
            echo '<tr>'
            . '<td colspan="6">Total</td>'
                    . '<td>'.number_format($gt).'</td>';
            //3157152500
            break;
             case 8:
                 $item = $_GET['item'];
                 $cod = $_GET['cod'];
                 $ref = $_GET['ref'];
                 $col = $_GET['col'];
                 $med = $_GET['med'];
                 $und = $_GET['und'];
                 $can = $_GET['can'];
                 $per = $_GET['per'];
                 $cot= $_GET['cot'];
                 $tipo= $_GET['tipo'];
                 $sis= $_GET['sis'];
                 $id= $_GET['id'];
                 $result = mysqli_query($conexion,"INSERT INTO `desgloses_material` (`numeroitem`,`id_cot`, `id_cot_item`, `referencia`, `codigo_pro`, `cantidad`, `medida`, `color`, `tipo`, `linea`, `usuario`, `perfil`, `canperfil`, `sistemaper`)"
                         . " VALUES ('$id','$cot', '$item', '$ref', '$cod', '$can', '$med', '$col', '$tipo', 'Accesorios', '".$_SESSION['k_username']."', '$per', '$can', '$sis'); ") ;
                 
                 echo '<img src="../images/autorizacion.png"> '.$result.' id:'.$id;
                 //echo $cod;
                
            break;
        case 9: 
                $reques=mysqli_query($conexion,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(cantidad) as can FROM desgloses_material a, referencias b where a.linea='Accesorios' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.codigo_pro order by a.referencia asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     if($ref!=$rowp['referencia']){
                         if($sw==0){
                           $color='#F3EFEE'; //1
                           $sw=1;
                        }else{
                            $color='#C6C5C5'; //0
                            $sw=0;
                        }
                     }else{
                         if($sw==0){
                           $color='#C6C5C5'; //1
                           $sw=0;
                        }else{
                            $color='#F3EFEE'; //0
                            $sw=1;
                        }
                     }
                     $ref = $rowp['referencia'];
                     $medtotal = $rowp['med'];
                     $canper = $rowp['med']/$rowp['perfil'];
                     $referencia = "'".$rowp['referencia']."'";
                     $descripcion = $rowp['descripcion'];
                     $cadena = $descripcion; 
                     $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
                     echo '<tr style="background:'.$color.'">'
                     . '<td>*'.$contador.'</td>'
                     . '<td><input type="text" id="codacc'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['codigo_pro'].'" disabled></td>'
                     . '<td><input type="text" id="refacc'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['referencia'].'" ></td>'
                     . '<td>'.$descripcion.'</td>'
                     . '<td><input type="text" id="colacc'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['color'].'" onchange="cambiarcolor('.$rowp['id_desglose'].')"></td>'
                     . '<td><input type="text" id="sisacc'.$rowp['id_desglose'].'" style="width:80px;text-align:center" value="'.$rowp['sistema'].'" onclick="cambiarsistema2('.$rowp['id_desglose'].')"></td>' 
                     . '<td>'.number_format($rowp['can']).' '.$rowp['und_medida'].'</td>';
                 }
            break;
        case 10:
              $cot = $_GET['cot'];
              $query = mysqli_query($conexion,"delete from desgloses_material where id_cot='$cot' and linea='Perfileria' ");
            break;
        case 10.5:
              $cot = $_GET['cot'];
              $query = mysqli_query($conexion,"delete from desgloses_material where id_cot='$cot' and linea='Accesorios' ");
            break;
        case 11:
              $cot = $_GET['usuario'];
              $pieces = explode(" ", $cot);
              $pieces[0]; 
              $pieces[1];
              if($pieces[1]==''){
                 $query = mysqli_query($conexion,"select email from usuarios where concat(nombre,' ',apellido) like '%".$pieces[0]."%'  ");
              }else{
                 $query = mysqli_query($conexion,"select email from usuarios where nombre like '%".$pieces[0]."%' AND apellido like '%".$pieces[1]."%' ");
                }
              $r = mysqli_fetch_array($query);
              echo $r[0];
            break;
            
            case 12:
              $cot = $_GET['cot'];
              $query = mysqli_query($conexion,"update desgloses_material set comprar='1', enviado='".$_SESSION['k_username']."' where id_cot='$cot' ") ;
              mysqli_query($conexion,"update cotizacion set comprar=1 where id_cot='$cot' ");
              if($query){
                  echo 'Se envio con exito'.mysqli_error($conexion);
              }else{
                  echo 'Error al procesar la informacion';
              }
              break;
        case 13:
            $cot = $_GET['cot'];
            $reques=mysqli_query($conexion,"SELECT * FROM desgloses_material  where linea='Perfileria' and id_cot=".$_GET["cot"]." and referencia='".$_GET["ref"]."' and perfil='".$_GET["med"]."' and cantidad!=0  ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                $medtot = 0;
                while($rowp=mysqli_fetch_array($reques)){
                     $resnombre = mysqli_query($conexion,"select * from referencias where referencia='".$rowp['referencia']."' group by referencia ");
                     $name = mysqli_fetch_array($resnombre);
                     $medtot += $rowp['medida'] * $rowp['cantidad'];
                echo '<tr>'
                        . '<td><input type="hidden" id="xcod'.$rowp['id_desglose'].'" value="'.$rowp['codigo_pro'].'" style="width:100px">'
                             . '<input type="text" id="xref'.$rowp['id_desglose'].'" value="'.$rowp['referencia'].'" style="width:100px"><button onclick="CambiarPerfil('.$rowp['id_desglose'].')">?</button></td>'
                        . '<td><input type="text" id="xdes'.$rowp['id_desglose'].'" value="'.$name['descripcion'].'" style="width:100%"></td>'
                        . '<td>'.$rowp['medida'].'</td>'
                        . '<td><input type="text" id="xcan'.$rowp['id_desglose'].'" value="'.$rowp['cantidad'].'" style="width:50px"></td>'
                        . '<td>'.$rowp['perfil'].'</td>'
                        . '<td>'.$rowp['tipo'].'</td>'
                        . '<td><button onclick="UpPerfil('.$rowp['id_desglose'].')">Editar</button></td>';  
                     }
                     $canp = $medtot / $_GET["med"];
                     echo '<tr><td colspan="2"></td><td colspan="3">Medida Total:'.$medtot.' / '.$_GET['med'].' = '.ceil($canp).' Perfiles<td>'; 
            break;
            
        case 14:
             $cot = $_GET['cot'];
             $id = $_GET['id'];
             $cod = $_GET['cod'];
             $ref = $_GET['ref'];
             $can = $_GET['can'];
             $query = mysqli_query($conexion,"update desgloses_material set codigo_pro='$cod' , referencia='$ref' , cantidad='$can',fecmodifica='".date("Y-m-d H:i:s")."',user='".$_SESSION['k_username']."' where id_desglose='$id' ") ;
             if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil';
              }
            break; 
            case 15:
            $cot = $_GET['cot'];
            $cod = $_GET['cod'];
            $ref = $_GET['ref']; 
            $per = $_GET['per'];
            $tip = $_GET['tip'];
            $reques=mysqli_query($conexion,"SELECT * FROM desgloses_material  where referencia like '".$ref."%' and tipo like '".$tip."%' and perfil like '".$per."%' and id_cot=".$cot." and codigo_pro like '".$cod."%'  ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                $medtot = 0;
                $tcan=0;$tcanp=0;
                while($rowp=mysqli_fetch_array($reques)){
                     $resnombre = mysqli_query($conexion,"select * from referencias where codigo='".$rowp['codigo_pro']."' group by referencia ");
                     $name = mysqli_fetch_array($resnombre);
                     $medtot += $rowp['medida'] * $rowp['cantidad'];
                     $tcan +=$rowp['cantidad'];$tcanp +=$rowp['canperfil']; 
                     $contador++;
                echo '<tr>'
                        . '<td><input type="text" id="upcod'.$rowp['id_desglose'].'" value="'.$rowp['codigo_pro'].'" style="width:100%" onclick="CambiarPerfil('.$rowp['id_desglose'].')">'
                        . '<td><input type="text" id="upref'.$rowp['id_desglose'].'" value="'.$rowp['referencia'].'" style="width:100%" onchange="updateref('.$rowp['id_desglose'].')"></td>'
                        . '<td><input type="text" id="updes'.$rowp['id_desglose'].'" value="'.$name['descripcion'].'" title="'.$name['descripcion'].'" style="width:100%" disabled></td>'
                        . '<td><input type="text" id="upmed'.$rowp['id_desglose'].'" value="'.$rowp['medida'].'" style="width:100%"  onchange="updateref('.$rowp['id_desglose'].')"></td>'
                        . '<td><input type="text" id="upcan'.$rowp['id_desglose'].'" value="'.$rowp['cantidad'].'" style="width:30px" onchange="updateref('.$rowp['id_desglose'].')"></td>'
                        . '<td><input type="text" id="upper'.$rowp['id_desglose'].'" value="'.$rowp['perfil'].'" style="width:100%" onchange="updateref('.$rowp['id_desglose'].')"></td>'
                         . '<td><input type="text" id="upcpe'.$rowp['id_desglose'].'" value="'.$rowp['canperfil'].'" style="width:30px" onchange="updateref('.$rowp['id_desglose'].')"></td>'
                        . '<td><input type="text" id="uptip'.$rowp['id_desglose'].'" value="'.$rowp['tipo'].'" style="width:100%" onchange="updateref('.$rowp['id_desglose'].')"></td>'
                        . '<td><button onclick="delper('.$rowp['id_desglose'].')">-</button>'
                        . '<td><button onclick="copyper('.$rowp['id_desglose'].')">C</button></td>';  
                     }
                 
                     echo '<tr><td colspan="2">Items '.$contador.'</td><td colspan="3">Cantidad Total:'.$tcan.'<td><td colspan="3"> '.$tcanp.' Perfiles</td>'; 
            break;
            case 16:
             $med = $_GET['med'];
             $id = $_GET['id'];
             $cod = $_GET['cod'];
             $ref = $_GET['ref'];
             $can = $_GET['can'];
             $per = $_GET['per'];
             $tip = $_GET['tip'];
             $cpe = $_GET['cpe'];
             $query = mysqli_query($conexion,"update desgloses_material set codigo_pro='$cod' , referencia='$ref' , cantidad='$can', medida='$med', perfil='$per', canperfil='$cpe', tipo='$tip',fecmodifica='".date("Y-m-d H:i:s")."',user='".$_SESSION['k_username']."' where id_desglose='$id' ") ;
             if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil'.$query;
              }
            break; 
             case 17:
              $id = $_GET['id'];
              $query = mysqli_query($conexion,"delete from desgloses_material where id_desglose='$id' ") ;
              echo 'Se ha eliminado con exito '.$query;
            break;
        case 18:
              $id = $_GET['id'];
              $query = mysqli_query($conexion,"INSERT INTO `desgloses_material` (`id_cot`, `id_cot_item`, `referencia`, `codigo_pro`, `cantidad`, `medida`, `color`, `tipo`, `linea`, `fecha_re`, `usuario`, `perfil`, `canperfil`, `sistemaper`, `numeroitem`, `comprar`, `enviado`, `existefom`, `codigo_sel`, `solicitud`, `precio`, `unidad`, `iva`, `cantidadperfil`, `fecmodifica`, `user`, `crear`, `cantdespachada`)"
                                                   . " select `id_cot`, `id_cot_item`, `referencia`, `codigo_pro`, `cantidad`, `medida`, `color`, `tipo`, `linea`, `fecha_re`, `usuario`, `perfil`, `canperfil`, `sistemaper`, `numeroitem`, `comprar`, `enviado`, `existefom`, `codigo_sel`, `solicitud`, `precio`, `unidad`, `iva`, `cantidadperfil`, `fecmodifica`, `user`, `crear`, `cantdespachada` from `desgloses_material` where id_desglose='$id' ") ;
              echo $query;
            break;
         case 19:
             $idcot = $_GET['idcot'];
             $desc = $_GET['desc'];
        
             $ver = mysqli_query($conexion,"update cotizaciones set descripcion_ingles='$desc'  where id_cotizacion='$idcot'  ") ;
             if($ver){
                 echo 'Se ha actualizado con exito';
             }else{
                 echo 'Ocurrio un error y no se actualizo!';
             }
             break;
             case 20:
             $id = $_GET['id'];

        
             $ver = mysqli_query($conexion,"SELECT * FROM `tipo_vidrio`  where id_vidrio='$id'  ") ;
             $f = mysqli_fetch_array($ver);
             $p = array();
             $p[0] = $f['color_v'];
             $p[1] = $f['espesor_v'];
             echo json_encode($p);
             
             break;
         case 21:
              $id = $_GET['cot'];
              $query = mysqli_query($conexion,"delete from desgloses_vidrios where id_cot='$id' ") ;
              echo 'Se ha eliminado con exito '.$query;
            break;
        case 22:
             $cot = $_GET['cot'];
             $ref = $_GET['ref'];
             $med = $_GET['med'];
             $obs = $_GET['obs'];

             $query = mysqli_query($conexion,"update desgloses_material set observaciones='$obs' where id_cot='$cot' and referencia='$ref' and perfil='$med'  ") ;
             if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil';
              }
            break;
            case 23:
             $idcot = $_GET['item'];
             $idvidrio = $_GET['idvidrio'];
             $tipo = $_GET['tipo'];
        
             $ver = mysqli_query($conexion,"update cotizaciones set tip='$tipo'  where id_cotizacion='$idcot'  ") ;
             $ver2 = mysqli_query($conexion,"update cotizaciones set tip='$tipo'  where id_compuesto='$idcot'  ") ;
             if($ver){
                 echo 'Se ha actualizado con exito '.$idcot.' el item '.$tipo.' ';
             }else{
                 echo 'Ocurrio un error y no se actualizo!';
             }
             break;
               case 24:
             $col = strtoupper($_GET['col']);
             $id = $_GET['id'];

             $query = mysqli_query($conexion,"update desgloses_material set color='$col',fecmodifica='".date("Y-m-d H:i:s")."',user='".$_SESSION['k_username']."' where id_desglose='$id' ") ;
             if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil';
              }
            break; 
            case 25:
          
             $idcot = $_GET['idcot'];
                $ref = $_GET['ref'];
                $linea = $_GET['linea'];

             $query = mysqli_query($conexion,"update desgloses_material set linea='$linea' where id_cot='$idcot' and referencia='$ref' ") ;
               // $query = mysqli_query($conexion,"CALL cambiar_linearef ($idcot,$ref) ") ;
             if($query){
                  echo 'Se ha editado con exito';
              }else{
                  echo 'Hubo un errro al editar el perfil'. mysqli_error($conexion);
              }
            break; 
}