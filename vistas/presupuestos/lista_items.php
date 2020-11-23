<?php
include "../../modelo/conexion.php";
    $page= $_GET['page'];
    if($_GET['pag']=='undefined'){
        $pag= 20; 
    }else{
       $pag= $_GET['pag']; 
    }
    if($_GET['buscar']=='undefined'){
        $buscar= '';
    }else{
       $buscar= ' AND CONCAT(tip) LIKE "%'.$_GET['buscar'].'%" '; 
    }
    //37339372.27119596
    $estado = $_GET['est'];
            $request = mysqli_query($conexion,"SELECT count(id_cot) FROM cotizaciones where id_cot= ".$_GET["cot"]." $buscar and id_compuesto=0 ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = $pag;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
      $query =mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p $buscar AND  c.id_cot = " . $_GET["cot"] . " and c.id_compuesto=0 ORDER BY c.fila ASC ".$limit);

                if($page>1){?>
                        <img src="../images/a1.png"  onclick="mostrar_tabla_items(<?php echo $_GET['cot'] ?>,<?php echo $_GET['cli'] ?>,1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="mostrar_tabla_items(<?php echo $_GET['cot'] ?>,<?php echo $_GET['cli'] ?>,<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_tabla_items(<?php echo $_GET['cot'] ?>,<?php echo $_GET['cli'] ?>,<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_tabla_items(<?php echo $_GET['cot'] ?>,<?php echo $_GET['cli'] ?>,<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                 echo '';

  $table = "";
if($query){

       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th>'.'Copy</th>';
              $table = $table.'<th width="2%">'.'Tipo'.'</th>'; 
              $table = $table.'<th width="2%">'.'#'.'</th>'; 
              $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="25%">'.'Producto'.'</th>';
              $table = $table.'<th width="9%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. <br>Total.'.'</th>';
              if($estado=='Aprobado'){$table = $table.'<th class="hidden-phone">'.'Cant. Pendiente'.'</th>';}
              $table = $table.'<th width="15%" style="text-align:center">Valores</th>';
              $table = $table.'<th class="hidden-phone">'.'%.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Mas'.'</th>';
              $table = $table.'<th>'.'Upd.'.'</th>';
              $table = $table.'<th><button type="button" onclick="quitar_items();"><img src="../imagenes/eliminar.png"></button></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysqli_fetch_array($query))
	{    

                //SE ADICIONA PORCENTAJES FIJOS DE DESCUENTO
//                                        $por_general = mysqli_query($conexion,"select (" . $row["porcentaje"] . ") FROM porcentaje_general ");
//                                        $pg = mysqli_fetch_row($por_general);
//                                        $gen_desc = $pg[0] / 100;
                                        
                                        
//            $comp=mysqli_query($conexion,"SELECT count(*) FROM cotizaciones_sub  where id_producto_cot=".$row["id_cotizacion"]."");
//            $cm1 = mysqli_fetch_array($comp);
            $d = 0; // se quito esta parte de consulta de cantidad de compuesto monty 1
//            if($row['cancompuesto']==''){
            $ac =mysqli_query($conexion,"SELECT  count(id_cot) FROM referencia_acce  where id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysqli_fetch_array($ac);
            $mt = $cm['count(id_cot)'];
            
              $ak =mysqli_query($conexion,"SELECT count(id_prod_mas) FROM cotizaciones_kit  where id_prod_mas=".$row["id_cotizacion"]." and comp='1'  ");
            $ck = mysqli_fetch_array($ak);
            $mtk = $ck['count(id_prod_mas)'];
            
            $as =mysqli_query($conexion,"SELECT count(id_cot_mas) FROM cotizaciones_servicios  where id_cot_mas=".$row["id_cotizacion"]." ");
            $cs = mysqli_fetch_array($as);
            $mts = $cs['count(id_cot_mas)'];
            
            $asn =mysqli_query($conexion,"SELECT count(id_cot) FROM cotizaciones  where id_compuesto=".$row["id_cotizacion"]." ");
            $csn = mysqli_fetch_array($asn); 
            $cop = $csn['count(id_cot)'];
            $t = $d + $mt + $mtk + $mts +$cop;
//            mysqli_query($conexion,"UPDATE `cotizaciones` SET `cancompuesto`='".$t."'  WHERE `id_cotizacion` = ".$row["id_cotizacion"].";");
//            }else{
//                $t = $row['cancompuesto'];
//            }

            $pad = 0; // SE QUITO LAS CONSULTAS DE LOS COMPUESTOS DELMONTY 1 
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           if($row['poralu']!=0){
               $a = $row['precio_item'];
               $version = '<b>Cotizador V 2.0</b>';
           }else{
               $s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = '".$row["linea_cot"]."'";
                $fi3 = mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult = $fi3["p"] / 100;
                if($row['id_referencia']==1633){
                   $a = $tk;
                }else{
                   $a = ($row["valor_c"] / $mult) + $pad  + $tk;
                }
                $version = '<b>Cotizador V 1.0</b>';
           }
           
           

            
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio' || $row["linea_cot"]=='VIDRIO'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
          
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            // modificar de este lado
                                
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
           
                     if($estado=='En proceso'){ 
                         $img_delx ='<input type="checkbox" name="item" id="'.$row["id_cotizacion"].'" value="">';
            $up = '&up='.$row["id_cotizacion"].'';
            if($eliminar_cot=='Habilitado'){$del = '&del='.$row["id_cotizacion"].'&v='.$cont;}else{$del = '';}
            $img_up = '<button type="button"><img src="../imagenes/modificar.png"></button>'; 
            
            //$img_del ='<button type="button"  onclick="eliminar_prod('.$row['id_cotizacion'].','.$_GET['cot'].','.$_GET['cli'].')"><img src="../imagenes/eliminar.png" style="cursor:pointer"></button>';
            $copiar = '<button type="button" id="'.$row["id_cotizacion"].'" onclick="copiar('.$row["id_cotizacion"].','.$_GET["cot"].','.$_GET["cli"].');"><img src="../imagenes/copiar.png"></button>';
                     }else{
                $up = '';$del = '';$img_up = ''; $img_delx =''; $copiar ='';
            }
         if($crear_ped=='Habilitado'){$add = '';}else{$add = '';}
     $con2= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysqli_query($conexion,$con2);
while($f8=  mysqli_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];
}
if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysqli_query($conexion,$con22);
while($f8r=  mysqli_fetch_array($res22)){
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysqli_query($conexion,$con23);
while($f8=  mysqli_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];
}}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysqli_query($conexion,$con24);
while($f8=  mysqli_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];
}}
 $cons_vi = mysqli_query($conexion,"SELECT color_v,espesor_v FROM tipo_vidrio where id_vidrio IN (".$row['id_vidrio'].",".$row['id_vidrio2'].",".$row['id_vidrio3'].",".$row['id_vidrio4'].",".$row['id_vidrio5'].",".$row['id2_vidrio'].",".$row['id2_vidrio2'].",".$row['id2_vidrio3'].",".$row['id2_vidrio4'].") ");
 $v1=''; 
 $esp = '';
 while($fv1 =mysqli_fetch_array($cons_vi)){
                    $v1 = $v1.$fv1['color_v'].'+';
                    $esp = $fv1['espesor_v'];
                }

             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.' - '.$nombr;
            }else{
                if($esp!='' && $row['producto']!=$nombr){
                 $vi = $v1.' '.$nombr;
                }else{
                 $vi = $v1;
                }
            }
                      
               if($row['cont_item']!='0'){
                $stilon = 'style="background-color:green;" title="¡Este item tiene notas!" ';
            
             }else{
                $stilon = '';
             
              }
                

               
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                  $sql21 = "SELECT descripcion_mo FROM referencia_mo where id_ref_mo=99 ";
                  $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
                    if($row['pelicula']=='Una Cara'){
                        $peli = ', + '.$fila21['descripcion_mo'];
                     }else{
                       $peli = ', + '.$fila21['descripcion_mo'].' ambos lados';
                      }
                   }
                 $iva3 = $ptt * ($sel_iva/100);
                 $tota = $ptt + $iva3;
                 $pdlr = "select precio_dolar from dolares where id_dolar=".$row['id_dolar']."  ";
                 $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
                 $precio_actual= $fia["precio_dolar"];
                
                if($row["valor_temp"]==0){
                    $w = '';
                }else{
                     $w = '<img src="../imagenes/warning.png" title="Advertencia tiene Precios ingresado manualmente">';
                }
               
                $ref='';
                $noti='';
                $noti2='';
                if($row['id_referencia']==1633){$ref='<p style="color: red;"><b>HUACAL</b></p>';}else{$ref='<input type="hidden" id="it'.$row["id_cotizacion"].'" value="'.$tip.'"> '.$row['producto'].' '.$peli.', '.$row['observaciones'].', '.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].' '.$noti.''.$noti2.' <br>'.$row["descripcion_rollo"].'<br>Se Cotizó con el Dollar a: $ '.$precio_actual.' '
                        . '<button type="button" '.$stilon.' onclick="com('.$row["id_cotizacion"].')"> <b>?</b> </button> <a href="../vistas/?id=ver_dt&item='.$row["id_cotizacion"].'" target="_blank">DT</a>';}
                if($row['msg']!=''){$noti='<br><b> <font color="red">'.$row['msg'].' </b>';}else{$noti='';}
                if($row['msg2']!=''){$noti2='<br><b> <font color="red">'.$row['msg2'].' </b>';}else{$noti2='';}
                if($estado=='Aprobado'){$pen = '<td class="hidden-phone"><div align="center"><font color="red">'.$row["cant_restante"].'</font></td>';}else{$pen = '';}
                if($row["estado_item"]=='Anulado'){$apro = '<font color="red">Item No Aprobado</font>';}else{ $apro=''; }
                
                $table = $table.'<tr>'
. '<td> '.$copiar. ' '.$w.'</td>'
. '<td width="2%">'.$tip.'</td><td width="2%">'.$tip2.'</td>
<td width="7%">'.$row['codigo'].'</font></td>
<td width="25%">'.$ref.'<input type="checkbox" name="item2" id="'.$row["id_cotizacion"].'" value="" checked disabled>
    '.$apro.'</td>                     
<td width="9%">'.$vi.'</td>
<td class="hidden-phone"><div align="center">'.$row["ancho_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["alto_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>'.$pen.'
<td class="hidden-phone"><div align="center"> 
'.$version.'
<table style="font-size:13px">
<tr><td><b>Precio Und. $</b></td><td style="text-align:right">'.number_format($pu).'</td>
<tr><td><b>Descuento $</b></td><td style="text-align:right">'.number_format($descpor).'</td>
<tr><td><b>Precio + Desc $</b></td><td style="text-align:right">'.number_format($pudt).'</td>
<tr><td><b>Precio Total $</a></b></td><td style="text-align:right">'.number_format($ptt).'</td>
<tr><td><b> Total+Iva $</b></td>'
                    . '<td style="text-align:right"><font color="red">'.number_format($tota).'</font>
                        <input type="hidden" id="ver'.$row["id_cotizacion"].'" value=""></td>
</table>
</td>

<td class="hidden-phone">'.number_format($row["desc"],2,',','').'</a></td>'
. '<td><a title="Aqui puede adicionar alguna estructura o un material" href="../vistas/?id=add_acc&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'&mas='.$row["id_cotizacion"].'&por='.$row["porcentaje_mp"].'&pagina=new_fac&tipo_cli='.$tipo.'""><button type="button"><img src="../imagenes/puzzle_3.png">(<font color="red">'.$t.'</font>)</button></a></td>'
. '<td><a href="../vistas/?id=new_fac&cot='.$_GET["cot"].'&cli='.$_GET["cli"].''.$up.'""  target="_blank">'.$img_up.'</a></td>
<td> '.$img_delx.'</td></tr>';   
       
	} 
	$table = $table.'</table>';
       }
	echo $table.'<br><hr>';
        
        ///  --------------------------------------------servicios-----------------------------------------
        //<h5>TOTAL COT.: $'.number_format($tacot).'</h5>
echo 'Item Totales: <input type="number" id="cantidad_total" value="'.$cont.'" disabled style="width:50px">';
        echo '<hr>';
        if($cont!=0){
     echo '<div align="right"><FONT color="red"></FONT></div>'
             . '<input type="hidden" id="tobk" value="'.$tacot.'">';} 
    
