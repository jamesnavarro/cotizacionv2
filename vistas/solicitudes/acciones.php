<?php
include '../../modelo/conexion.php';
session_start();
switch ($_GET['sw']){
    case 1:
        $sistema = $_GET['sistema'];
        $v = $_GET['v'];
        $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $can = $_GET['can'];
        $per = $_GET['per'];
        $item = $_GET['item'];
        $des = $_GET['des'];
        $user = $_SESSION['k_username'];
        $color = $_GET['color'];
        $idcot = $_GET['idcot'];
        $idpro = $_GET['idpro'];
        $result = mysql_query("select count(*), codigo from referencias where referencia='$ref' and medida='$per' ");
        $r = mysql_fetch_array($result);
        $cod = $r[1];
        if($r[0]==0){
                     $query = mysql_query("insert into solicitudes_items (items,sistema,id_producto,id_cot_items,referencia_sc,descripcion_sc, codigo, color_sc, cantidad_sc, perfil_sc, id_cotizacion, registrado)"
                    . "values ('$v','$sistema','$idpro','$idcot','$ref', '$des', '', '$color','$can', '$per', '$cot', '$user') ");
                 echo 'insert';
           
        }else{
                     $query = mysql_query("insert into solicitudes_items (items,sistema,id_producto,id_cot_items,referencia_sc,descripcion_sc, codigo, color_sc, cantidad_sc, perfil_sc, id_cotizacion, registrado)"
                    . "values ('$v','$sistema','$idpro','$idcot','$ref', '$des', '$cod', '$color','$can', '$per', '$cot', '$user') ");
                echo 'insert';

        }
        
        break;
    case 2:
        $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $can = $_GET['can'];
        $per = $_GET['per'];
        $item = $_GET['item'];
        mysql_query("delete from solicitudes_items  where id_si='".$n[1]."' ");
         
        break;
    case 3:
        $cot = $_GET['cot'];
        $query = mysql_query("select *, sum(cantidad_sc) as cant from  solicitudes_items where id_cotizacion='$cot' group by referencia_sc, perfil_sc order by sistema,referencia_sc, perfil_sc asc ");
        $iten = 0;
        $pesot=0;
        $areat=0;
        $co = 0;
        $vidrios = '';
        $sistema = '';
        $v = '';
        $re='';
        while($m = mysql_fetch_array($query)){
            $iten += 1;
            if($m['codigo']=='0'){
               $btn = ''; 
               $peso=0;
               $area=0;
            }else{
            $result = mysql_query("select peso,area from  referencias where codigo='".$m['codigo']."'");
            $p = mysql_fetch_array($result);
               $peso = ($p['peso']*$m['cantidad_sc']);
               $area = ($p['area']*$m['cantidad_sc']);
              $btn = '<img src="../imagenes/pop.png" style="cursor:pointer" onclick="formulario('.$m['codigo'].')">';
            }
               $pesot += $peso;
               $areat += $area;
               if($m['mix']!=0){
                    $mix = '<b> <font color="red"> Mix </font> </b>';
               }else{
                     $mix = '';
               }
               if($re!=$m['referencia_sc']){
                         echo  '<tr style="background:#C6C6C3;height:2px"><td></td><td></td><td></td><td></td><td style="text-align:center"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'; 
               }
               $re=$m['referencia_sc'];
               if($sistema!=$m['sistema']){
         
                   echo  '<tr style="background:#F2F966;"><td>-</td><td>-</td><td>-</td><td>-</td><td style="text-align:center"><b>Sistema '.$m['sistema'].' </b></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>'; 
               }
               $queru = mysql_query("select items from  solicitudes_items where id_cotizacion='$cot' and sistema='".$m['sistema']."' and perfil_sc=".$m['perfil_sc']." and referencia_sc='".$m['referencia_sc']."' group by items ");
                   $ti='';
                   while($vt = mysql_fetch_array($queru)){
                       $ti = $ti.' '.$vt[0].', ';
                   }
               $sistema=$m['sistema'];
               
               $co = $m['id_cot_items'];
               $idp = $m['id_producto'];
               $cadena_de_texto = $m['descripcion_sc'];
            $cadena_buscada   = 'MM';
            $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
            if ($posicion_coincidencia === false) {
                $cadena = $m['descripcion_sc'];
            }ELSE{
                $cadena = substr($m['descripcion_sc'], 0,-6).' '.$m['perfil_sc'].'MM';
            }
            echo '<tr>'
            . '<td style="text-align:center">'.$iten.'</td>'
            . '<td style="text-align:center">'.$m['sistema'].'</td>'
            . '<td>'.$btn.' '.$m['codigo'].'</td>'
            . '<td>'.$cadena.'</td>'
            . '<td>'.$ti.'</td><td style="text-align:center">'.$m['cant'].'</td>'
            . '<td><input type="hidden" id="medsta'.$m['id_si'].'" value="'.$m['perfil_sc'].'" disabled>
            <input type="number" id="med'.$m['id_si'].'" value="'.$m['perfil_sc'].'" style="width:60px" onchange="editar_perfil('.$m['id_si'].','.$cot.');"></td>'
            . '<td>'.$m['color_sc'].'</td>'
            . '<td><input type="text" id="ref'.$m['id_si'].'" value="'.$m['referencia_sc'].'" style="width:60px" disabled></td>'
            . '<td>'.$peso.' Kg</td>'
            . '<td>'.$area.' M<sup>2</td>'
            . '<td><button onclick="del('.$m['id_si'].');">-</button> </td>';
        }
       
        echo '<tr>'
            . '<td style="text-align:center"><input type="text" value="'.$iten.'" id="item" style="width:40px"></td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center"><input type="text" value="'.$pesot.'" id="pesot" style="width:40px"></td>'
            . '<td style="text-align:center"><input type="text" value="'.$areat.'" id="areat" style="width:40px"></td>'
            . '<td style="text-align:center"></td>';
        $vervid = mysql_query("SELECT a.id_vidrio, traz_vid, ancho_c, alto_c,sum((ancho_c/1000)*(alto_c/1000)) as mt , color_v, producto FROM cotizaciones a, tipo_vidrio b, producto c where a.id_vidrio=b.id_vidrio and a.traz_vid=c.id_p and a.id_cot=$cot and a.estado_item='Aprobado' group by a.id_vidrio, a.traz_vid");
        $vp = '';$num=0;
        $idv = '';
        $mtt = 0;
        while($vd = mysql_fetch_array($vervid)){
             
            
                $num++;
               
                $vp = $vp.'Vidrio '.$num.':  '.$vd[5].' '.$vd[6].' '.number_format($vd[4],2,',','').'<br>';
                      echo '<tr>'
            . '<td style="text-align:center">Vidrio '.$num.'</td>'
            . '<td style="text-align:center"  colspan="3">'.$vd[5].'</td>'
            . '<td style="text-align:left" colspan="5">'.$vd[6].'</td>'
            . '<td style="text-align:center">'.number_format($vd[4],2,',','').'</td>'
            . '';
        }
        
        break;
    case 4:
       
             $request2=mysql_query('SELECT * FROM referencias WHERE codigo="'.$_GET['cod'].'"');
             $row2=mysql_fetch_array($request2); 
             $p = array();
              $p[0] = $row2["id_referencia"];
              $p[1] = $row2["descripcion"];
              $p[2] = $row2["referencia"];
              $p[3] = $row2["codigo"];
              $p[4] = $row2["dado"];
              $p[5] = $row2["medida"];
              echo json_encode($p);
              exit();
        break;
    case 5:
        $cod = $_GET['cod'];
        $peso = $_GET['peso'];
        $area = $_GET['area'];
        mysql_query("update referencias set peso='$peso', area='$area' where codigo='$cod' ");
        
        break;
    case 6:
        $id = $_GET['id'];
        mysql_query("delete from solicitudes_items  where id_si='".$id."' ");
        break;
    case 7:
        $cot = $_GET['cot'];
        $peso = $_GET['peso'];
        $area = $_GET['area'];
        $idcot = $_GET['idcot'];
        $obs = $_GET['obs'];
        $user = $_GET['user'];
        $sol = $_GET['sol'];
        $fecha=date("Y-m-d");
        if($sol==''){
            mysql_query("insert into solicitudes_diseno (numero_cotizacion, id_cot, solicitado, peso_total, area_total, fecha_registro, estado_sol, obs)"
                    . " values('$cot','$idcot','$user','$peso','$area','$fecha','Solicitado','$obs')");
            $ma = mysql_query("select max(id_sc) from solicitudes_diseno ");
            $m = mysql_fetch_array($ma);
            $s = $m[0];
            mysql_query("update cotizacion set id_sc='$s' where id_cot='$idcot' ");
            mysql_query("update solicitudes_items set id_sc='$s' where id_cotizacion='$idcot' and id_sc=0 ");
        }else{
            mysql_query("update solicitudes_diseno set obs='$obs' where id_sc='$sol' ");
            $s = $sol;
        }
        echo $s;
        break;
        case 8:
        $cod = $_GET['cod'];
        $id = $_GET['id'];
        mysql_query("update solicitudes_items set codigo='$cod' where id_si='$id' ");
        
        break;
    case 9:

         $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $can = $_GET['can'];
        $per = $_GET['per'];
        $item = $_GET['item'];
        $des = $_GET['des'];
        $user = $_SESSION['k_username'];
        $color = $_GET['color'];
        $result = mysql_query("select count(*), codigo, perfil_sc, cantidad_sc,referencia_sc from solicitudes_items where referencia_sc='$ref' and mix!=0 ");
        $r = mysql_fetch_array($result);
        $cod = $r[1];
        if($r[0]==0){
                 $p = array();
                 $p[0] = $r[0];
                 echo json_encode($p);
                 exit(); 
            }else{
              $p = array();
              $p[0] = $r[0];
              $p[1] = $r[1];
              $p[2] = $r[2];
              $p[3] = $r[3];
              $p[4] = $r["referencia_sc"];
              echo json_encode($p);
              exit(); 
            }
        break;
    case 10:

        echo 'quito';

        break;

        case 11:
           $cot = $_GET['cot'];
           $ref = $_GET['ref'];
           $can = $_GET['can'];
           $per = $_GET['per'];
           $item=$_GET['item'];
           $des = $_GET['des'];
           $user = $_SESSION['k_username'];
           $color = $_GET['color'];
        
                     $query = mysql_query("insert into solicitudes_items (referencia_sc,descripcion_sc, codigo, color_sc, cantidad_sc, perfil_sc, id_cotizacion, registrado, mix)"
                    . "values ('$ref', '$des', '', '$color','$can', '$per', '$cot', '$user','1') ") or die(mysql_error());
     
        break;
        case 12:
           $cot = $_GET['cot'];
           $ref = $_GET['ref'];
           $can = $_GET['can'];
           $per = $_GET['per'];
           $item = $_GET['item'];
           $des = $_GET['des'];
           $user = $_SESSION['k_username'];
           $color = $_GET['color'];
           $result = mysql_query("select codigo from referencias where referencia='$ref' and medida='$per' ");
           $r = mysql_fetch_array($result);
           $cod = $r[0];
           $update = mysql_query("update solicitudes_items set cantidad_sc='$can', perfil_sc='$per', codigo='$cod' where id_cotizacion='$cot' and referencia_sc='$ref' and mix!=0 ");
        break;
        case 13:
           $cot = $_GET['cot'];
           $ref = $_GET['ref'];
           $can = $_GET['can'];
           $per = $_GET['per'];
           $item = $_GET['item'];
           $des = $_GET['des'];
           $user = $_SESSION['k_username'];
           $color = $_GET['color'];
           $result = mysql_query("select codigo from referencias where referencia='$ref' and medida='$per' ");
           $r = mysql_fetch_array($result);
           $cod = $r[0];
           $update = mysql_query("update solicitudes_items set cantidad_sc='$can', perfil_sc=perfil_sc-'$per', codigo='$cod' where id_cotizacion='$cot' and referencia_sc='$ref' and mix!=0 ");

           mysql_query("delete from solicitudes_items where perfil_sc=0 ");
        break;
         case 14:
           $per = $_GET['per'];
           $persta = $_GET['persta'];
           $ref = $_GET['ref'];
           $id = $_GET['id'];
           $cot = $_GET['cot'];
           $result = mysql_query("select count(*), codigo from referencias where referencia='$ref' and medida='$per' ");
        $r = mysql_fetch_array($result);
        $cod = $r[1];
        if($r[0]==0){
                     $query = mysql_query("update solicitudes_items set perfil_sc='$per',codigo='' where referencia_sc='$ref' and perfil_sc='$persta' and id_cotizacion='$cot' ") or die(mysql_error());
                 //echo $query;
           
        }else{
                    $query = mysql_query("update solicitudes_items set perfil_sc='$per',codigo='$cod' where  referencia_sc='$ref' and perfil_sc='$persta' and id_cotizacion='$cot' ") or die(mysql_error());
               //echo $query;

        }
        echo "sta=".$persta." ref=".$ref." cot=".$cot;
         break;
    
}


