<?php 
    class general{
        function mostrarOrden($op,$cot,$cli){
            include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    $sq = "SELECT * FROM orden_produccion  where  id_orden=".$op;
    $fil =mysqli_fetch_array(mysqli_query($conexion,$sq)); 
    $congelado= $fil["congelado"]; 
    $reposicion= $fil["id_reposicion"]; 
          $opf= $fil["opf"];  

 $request=mysqli_query($conexion,"SELECT *, (a.producto) as producto FROM producto a, cotizaciones c, orden_detalle e, procesos_activos f where  e.anula='0' and f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.id_referencia=a.id_p  and f.id_op=".$op." and e.parte_otro=0 group by f.barra ");
   
     
if($request){
//    parte del aluminio
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="3%">'.'Items'.'</th>'; 
              $table = $table.'<th width="3%">'.'Ped'.'</th>'; 
              $table = $table.'<th width="5%">'.'Cod. Barra'.'</th>'; 
              $table = $table.'<th width="25%">'.'Descripcion del Producto'.'</th>';
              $table = $table.'<th width="7%">'.'Diseño'.'</th>'; 
              $table = $table.'<th width="7%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cierres'.'</th>';
              $table = $table.'<th width="4%">'.'Esp Vid (mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho (mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto (mm)'.'</th>';
              $table = $table.'<th width="4%">'.'Ordenado (Und)'.'</th>';
              $table = $table.'<th>'.'Traz.'.'</th>';
              $table = $table.'<th>'.'Sticker'.'</th>';
              $table = $table.'<th>DT`S</th>';
              $table = $table.'<th>Anular</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        $total2=0;
        $ta2 =0;
        $cont =0;
        $sqlt = "SELECT count(*) FROM orden_detalle where estado_op=1 and codigo=".$op." ";
        $filat =mysqli_fetch_array(mysqli_query($conexion,$sqlt));
        $max= $filat["count(*)"];
        $n = mysqli_num_rows($request);
	      while($row=mysqli_fetch_array($request))
      	{
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
            $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
           
            if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
              
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
              }
              } 
            }  
    if($row["cod_traz"]==''){
        $r = 'No se selecciono ninguna trazabilidad';
    }else{
        $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz"];                     
        $result=  mysqli_query($conexion,$consulta);

    while($fila=  mysqli_fetch_array($result)){
        $proceso=$fila['nombre_proceso'];
    } 
    if(isset($proceso)){$r = $proceso; }else{ $r ='las areas seleccionadas no existen en la base de datos';}
    }         

             if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].', Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            
            $cont = $cont + 1;
            $suma2 = $row["valor_c"];
            $a = $suma2 * $mult2;
//             echo number_format($row["valor_c"]).' <br>';
//          echo number_format($mult2).'<br>';
            $b = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor = $b * $row["desc"]/100;
            $b = $b - $descpor;
          
            if($row["aprobado"]==1){
            $ch = '<IMG src="../images/autorizacion.png" ALT="Aprobado">';}else{
            $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["     cli"].'">Aprobar</a>';  
                                }
            $pu = ($b)/$row["cantidad_c"];
            $pr = $row["cantidad_c"]-$row["cant_restante"];
            
            $c= $row['cant_ordenada'];
            $in = 'readonly';
            $an = $row['medida1'];
            $al= $row['medida2'];
           
            if($row["id_prod_cambio"]!=0){
            $name = mysqli_query($conexion,"select * from producto where id_p=".$row["id_prod_cambio"]." ");
            $r = mysqli_fetch_array($name);
            $nombre = $r['producto'];
            $ref = $row["id_prod_cambio"];
                }else{
                    $nombre = $row['producto'];
                    $ref = $row["id_producto"];
                }
                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                
          if($row["especial"]==1){
                }
            if($row["linea_cot"]=='Vidrio'){
                $traz = '<a href="javascript:void(0);"  onClick="trazabilidad('.$row["barra"].','.$ref.')">';
            }else{
                $traz = '<a href="javascript:void(0);" onClick="trazabilidadv('.$row["barra"].','.$ref.')">';
            }

            if($max!=0){
                $y = 1;
            }else{
                $y = '';
            }
        if($congelado==0){
            //$anu ='<a href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'&c='.$c.'&anular='.$al.'&rel='.$row["relacionado"].'&o='.$row["id_orden_d"].' "><img src="../imagenes/no.png"></a>';
            $anu = '<input type="checkbox" id="quitar'.$cont.'" value="1">';
            
        }else{
            $anu = '';
        }
        
                $ta2 = $ta2 + ($pu*$c);
                
                
                $table = $table.'<tr><td width="3%">('.$cont.'/'.$n.')</td>
                        <td width="3%">'.$row["orden"].'</a></td>
                        <td width="5%">'.$row['barra'].'</font></td>
                        <td width="25%">'.$nombre.' '.$d1.'</a></td>
                        <td width="7%">'.$row['lado'].'</a></td><td width="7%">'.$fv["color_v"].'<font></a></td>
                        <td class="hidden-phone">'.$row["cierre"].'<font></a></td>
                        <td width="4%">'.$fv["espesor_v"].'</td>
                        <td class="hidden-phone"><input type="text" '.$in.' name="ancho" required value="'.$an.'" style="width:40px"></td>
                            <td class="hidden-phone"><input type="text" '.$in.' name="alto" required value="'.$al.'" style="width:40px"></td>
                   
                                <td width="4%"><input type="text" '.$in.' name="cantidad" required value="'.$c.'" id="cm'.$cont.'" style="width:20px"></td>
                       <td>'.$traz.'<button type="button"><img src="../imagenes/lupa.png" alt="ver" height="20px" width="20px"> Traz.</button></a></td>
                        <td><a target="_blank" href="../2/ex.php?u='.$row['ubic'].'&cot='.$cot.'&orden='.$op.'&cant='.$row['cant_ordenada'].'&cod_barra='.$row['barra'].'&laminas='.$row['laminas'].'&r='.$reposicion.'&opf='.$opf.'"><button type="button"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"> Stk</button></a></td>'
                    . '<td><a target="_blank" href="../vistas/print_dt.php?l='.$row["lado"].''
                        . '&ubic='.$row["ubic"].'&mod='.$row["modulo"].'&dan='.$row["des_ancho"].'&dal='.$row["des_alto"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$cot.'&idcot='.$row["relacionado"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$an.'&alto='.$al.''
                        . '&cant='.$row['cant_ordenada'].'&vidrio='.$fv["color_v"].'('.$fv["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].'&id2_v6=0'
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].'&id3_v6=0'
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].'&id4_v6=0'
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&v='.$row["verticales"].'&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&r='.$reposicion.'&opf='.$opf.'&dd=('.$cont.'/'.$n.')"><button type="button"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"> DT</button></a></td>'
                    
                    . '<td>'.$anu.'</td>
                        </tr>'; ?>
<input type="hidden" value="<?php echo $row["relacionado"] ?>" id="rel<?php echo $cont ?>"> 
<input type="hidden" value="<?php echo $row["id_orden_d"] ?>" id="orden<?php echo $cont ?>"> 
<input type="hidden" value="<?php echo $c ?>" id="c"> 
    <?php  
            }


	$table = $table.'</table>';
        
	echo $table; echo '<hr>';
        ?>
            
<input type="hidden" value="<?php echo $cont ?>" id="contd"> 
        <?php
         $request=mysqli_query($conexion,"SELECT *, (a.producto) as producto FROM producto a, cotizaciones c, orden_detalle e, procesos_activos f where e.parte_otro=1 and e.anula='0' and f.id_orden_d=e.id_orden_d  and c.traz_vid=a.id_p  and c.id_cot=".$_GET["cot"]." and e.codigo=".$_GET['op']."  group by f.id_orden_d");

     
if($request){
//    echo'<hr>';
    ?>
              <input type="hidden" id="opx" value="<?php echo $op ?>">
              <input type="hidden" id="cotx" value="<?php echo $cot ?>">
              <input type="hidden" id="clix" value="<?php echo $cli ?>">
              <table class="table table-bordered table-striped table-hover" id="">
              <thead >
              <tr BGCOLOR="#C3D9FF">
              <th width="3%">Items</th>
              <th width="3%">Ped</th>
              <th width="5%">Cod. Barra</th> 
              <th width="5%">Codigo</th> 
              <th width="25%">Vidrios de la Ventana ó Fachada</th>
              <th width="7%">Diseño</th>
              <th width="7%">Color Vid</th>
              <th class="hidden-phone">Cierres</th>
              <th class="hidden-phone">Ancho (mm)</th>
              <th class="hidden-phone">Alto (mm)</th>
              <th width="4%">Ordenado (Und)</th>
              <th>Traz</th>
              <th>Sticker</th>
              <th>Descomponer</th>
              <th>Anular</th>
              </tr>
              </thead>
<?PHP
          $sqlt = "SELECT count(*) FROM orden_detalle where estado_op=1 and codigo=".$_GET['op']." ";
        $filat =mysqli_fetch_array(mysqli_query($conexion,$sqlt));
        $max= $filat["count(*)"];
        
        $cont2 = 0;
        $c = 0;
            ?>
            
             <?php
	while($row=mysqli_fetch_array($request))
	{
            $cont2 = $cont2 + 1;
            $sql211 = "SELECT * FROM orden_detalle where codigo=".$_GET['op']." and relacionado=".$row["id_cotizacion"]." and id_orden_d=".$row["id_orden_d"]." ";
            $fila211 =mysqli_fetch_array(mysqli_query($conexion,$sql211));
            $m1= $fila211["medida1"];
            $m2= $fila211["medida2"];
            $c= $fila211["cant_ordenada"];
            $x= $fila211["estado_op"];
            if($c==""){
                $in = '';
                $boton = '<button type="submit"><img src="../imagenes/guardar.jpg"></button>';
                $an = $row['ancho_c'];
                $al= $row['alto_c'];
            }else{
                $in = 'readonly';
                $boton = '<img src="../imagenes/ok.png">';
                $an = $m1;
                $al= $m2;
            }
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
           
            if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
              }
              } 
            }
                
               $s3p = "SELECT * FROM producto where id_p=".$row["id_producto"]." ";
                $fi3p =mysqli_fetch_array(mysqli_query($conexion,$s3p));
                $pro= $fi3p["producto"];$codigo= $fi3p["codigo"];
  if($row["cod_traz"]==''){
      $r = 'No se selecciono ninguna trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz"];                     
$result=  mysqli_query($conexion,$consulta);

while($fila=  mysqli_fetch_array($result)){
  $proceso=$fila['nombre_proceso'];
    
} 
if(isset($proceso)){$r = $proceso; }else{ $r ='Las areas seleccionadas no existen en la base de datos';}
  }         

             if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].', Boq:'.$row["boq"];}else{$d1 = ''.$row["color_ta"];}
            
            $cont = $cont + 1;
                    $suma2 = $row["valor_c"];
            $a = $suma2 / $mult2;
//          echo number_format($a).'<br>';
//          echo number_format($row["precio_adicional"]).'<br>';
            $b = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor = $b *$row["desc"]/100;
            $b = $b - $descpor;
            
            if($row["aprobado"]==1){
                                $ch = '<IMG src="../images/autorizacion.png" ALT="Aprobado">';}else{
                                  $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">Aprobar</a>';  
                                }
            $pu = ($b)/$row["cantidad_c"];
            
            $pr = $row["cantidad_c"]-$row["cant_restante"];

          if($row["especial"]==1){
                 if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_producto"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                 }else{ $ver = ''; }
                }
                
            

          
            if($max!=0){
                $y = 1;
            }else{
                $y = '';
            }
        if($congelado==0){
            $c=0;
            //$anu ='<a href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'&c=0&anular='.$al.'&rel='.$row["relacionado"].'&o='.$row["id_orden_d"].' "><img src="../imagenes/no.png"></a>';
            $anu = '<input type="checkbox" id="quitarv'.$cont2.'" value="1">';
            
        }else{
            $anu ='';
        }
          if($row["medida4"]!=0 && $c==0){$aa = '&aa='.$row["medida4"];}else{$aa = '';}
          if($row["imprimir"]==0){
              $st = '<img src="../imagenes/imp.png" alt="ver" height="20px" width="20px">';
               if($row["linea_cot"]=='Vidrio'){
                $traz = '<a href="javascript:void(0);" onClick="trazabilidadv('.$row["barra"].','.$row["traz_vid"].')">';
            }else{
                $traz = '<a href="javascript:void(0);" onClick="trazabilidadv('.$row["barra"].','.$row["traz_vid"].')">';
            }
          }else{
              $st = '';
              $traz = '';
          }
          if($row["descomponer"]==0){$ds = '<img src="../imagenes/b_move.png">';}else{$ds = '';}
              
          ?>
                        <tr>
                            <td width="3%"><?php echo $row["id_cotizacion"] ?></a>
                        </td>
                        <td width="3%"><?php echo $row["orden"] ?></a></td>
                        <td width="5%"><?php echo $row['barra'] ?></font></td>
                            <td width="5%"><?php echo $codigo ?></font></td>
                        <td width="25%"><?php echo $pro ?></a></td>
                        <td width="7%"><?php echo $d1 ?></a></td><td width="7%"><?php echo $row["color"] ?><font></a></td>
                        <td class="hidden-phone"><?php echo $row["cierre"] ?><font></a></td>
                       <td class="hidden-phone"><input type="text" <?php echo $in ?> name="ancho" required value="<?php echo number_format($row["medida1"]) ?>" style="width:40px"></td>
                       <td class="hidden-phone"><input type="text" <?php echo $in ?> name="alto" required value="<?php echo number_format($row["medida2"]) ?>" style="width:40px"></td>
                       <td width="4%"><input type="text" <?php echo $in ?> name="cantidad" required value="<?php echo $row['cant_ordenada'] ?>" style="width:20px"></td>
                       <td><?php echo $traz ?><button type="button"><img src="../imagenes/lupa.png" alt="ver" height="20px" width="20px"> Traz.</button></a></td>
                        <td><a target="_blank" href="<?php echo '../2/sticker_vid.php?d='.$row['producto'].'&p='.$row['per'].'&b='.$row['boq'].'&u='.$row['ubic'].'&cot='.$_GET['cot'].'&orden='.$_GET['op'].'&pro='.$row['id_proceso'].'&cant='.$row['cant_ordenada'].'&cod_barra='.$row['barra'].'&laminas='.$row['laminas'].'&an='.$row["medida1"].'&al='.$row["medida2"].''.$aa.'&r='.$reposicion.'&opf='.$opf.' ' ?>"><button type="button"><?php echo $st ?>Stk. Vid</button></a></td>
                        <td><a href="../vistas/dividir.php?linea=<?php echo $row["id_orden_d"].'&op='.$_GET["op"].'&cot='.$_GET["cot"]; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <button type="button"><?php echo $ds ?> Partes</button></a></td>
                        <td><?php echo $anu ?></td>
                        </tr>  
                        <input type="hidden" value="<?php echo $row["relacionado"] ?>" id="rel2<?php echo $cont2 ?>"> 
                        <input type="hidden" value="<?php echo $row["id_orden_d"] ?>" id="orden2<?php echo $cont2 ?>"> 
<input type="hidden" value="<?php echo $c ?>" id="c2"> 
            
          <?php     $c = $c + 1;
	 } ?>
	</table>

<input type="hidden" value="<?php echo $cont2 ?>" id="conta">   
        <hr>
        <?php
} 
  
} 
    }
        
    function listaproductos($op,$cot,$cli){
        $_GET["cot"] = $cot;
        $_GET["op"] = $op;
        $_GET["cli"] = $cli;
        
        $sq = "SELECT * FROM orden_produccion  where  id_orden=".$op;
        $fil =mysqli_fetch_array(mysqli_query($conexion,$sq)); 
            $congelado= $fil["congelado"]; 
            $reposicion= $fil["id_reposicion"]; 
            $opf= $fil["opf"];   
       
        $request = mysqli_query($conexion,"select * from reposiciones where id_reposicion=".$reposicion." ");
        $r = mysqli_fetch_array($request);
            if(isset($_POST['producto'])){
                $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where  c.id_referencia=a.id_p  and c.id_cot=".$_GET["cot"]." and c.id_cotizacion=".$_POST['producto']." ");
            }else{
                $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where  c.id_referencia=a.id_p  and c.id_cot=".$_GET["cot"]);  
            }   
if($request){ ?>
                                            
    <table class="table table-bordered table-striped table-hover" id="">
        <thead>
            <tr BGCOLOR="#C3D9FF">
                <th width="3%">Items</th>
                <th width="3%">Ped</th>
                <th width="5%">Ref</th>
                <th width="25%">Descripcion del Producto</th>
                <th width="7%">Diseño</th>
                <th width="7%">Ubicacion</th>
                <th width="4%">Esp Vid (mm)</th>
                <th class="hidden-phone">Ancho (mm)</th>
                <th class="hidden-phone">Alto (mm)</th>
                <th width="4%">Cant Ped (Und)</th>
                <th width="4%">Cant Produ (Und)</th>
                <th width="4%">Cant Pend (Und)</th>
                <th width="4%">Cant Ordenar (Und)</th>
                <th><div align="center"><img src="../imagenes/ok.png"></div></th>
            </tr>
	</thead>
     <?php   
	//Por cada resultado pintamos una linea
        $total2=0;
        $ta2 =0;
        $cont =0;
        
        $sqlt = "SELECT count(*) FROM orden_detalle where estado_op=1 and codigo=".$_GET['op']." ";
        $filat =mysqli_fetch_array(mysqli_query($conexion,$sqlt));
        $max= $filat["count(*)"];
        
        
	while($row=mysqli_fetch_array($request))
	{
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir3));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
           if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
              }
              } 
            }
                
               
  if($row["cod_traz"]==''){
      $r = 'No has seleccionado la trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz"];                     
    $result=  mysqli_query($conexion,$consulta);

while($fila=  mysqli_fetch_array($result)){
  $proceso=$fila['nombre_proceso'];
    
} 
if(isset($proceso)){$r = $proceso; }else{ $r ='Las areas seleccionadas no existen en la base de datos';}
  }         

             if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].', Boq:'.$row["boq"];}else{$d1 = 'Color Aluminio:'.$row["color_ta"];}
            
            $cont = $cont + 1;
            $suma2 = $row["valor_c"];
            $a = $suma2 / $mult2;
//          echo number_format($a).'<br>';
//          echo number_format($row["precio_adicional"]).'<br>';
            $b = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor = $b *$row["desc"]/100;
            $b = $b - $descpor;
            
            if($row["aprobado"]==1){
                                $ch = '<IMG src="../images/autorizacion.png" ALT="Aprobado">';}else{
                                $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">Aprobar</a>';  
                                }
            $pu = ($b)/$row["cantidad_c"];
            
            $up = '&ord='.$row["id_cotizacion"].'';
            $del = '&del='.$row["id_cotizacion"].'';
            $pr = $row["cantidad_c"]-$row["cant_restante"];
            
             $sql211 = "SELECT * FROM orden_detalle where codigo=".$_GET['op']." and relacionado=".$row["id_cotizacion"]." ";
            $fila211 =mysqli_fetch_array(mysqli_query($conexion,$sql211));
            $m1= $fila211["medida1"];
            $m2= $fila211["medida2"];
            $c= $fila211["cant_ordenada"];
            $x= $fila211["estado_op"];
           
                $in = '';

                $boton = '<button type="button"  onclick="add_orden('.$cont.')"><img src="../imagenes/down.png"></button>';
                $an = $row['ancho_c'];
                $al= $row['alto_c'];
          
             if($row["especial"]==1){
                 if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_referencia"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                 }else{ $ver = ''; }
                }else{ 
                    // 27 jueves  4404914   
            $ver = '<a href="../vistas/?id=ver_pro&l='.$row["imagen"].'&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&v='.$row["verticales"].'&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'">';
                  } 
                    
        if($congelado==0 && $reposicion==0){
            ?>
         <?php
            if($max!=0){
                $y = 1;
            }else{
                $y = '';
            }
         if($row["imagen"]=='Derecho'){
              $select = '<select name="lado'.$cont.'" id="lado'.$cont.'" style="width:85px"><option value="Derecho">Derecho</option><option value="Izquierdo">Izquierdo</option></select>';
         }else{
              $select = '<select name="lado'.$cont.'" id="lado'.$cont.'" style="width:85px"><option value="Izquierdo">Izquierdo</option><option value="Derecho">Derecho</option></select>';
         }
         
          
                $ta2 = $ta2 + ($pu*$c);
                if($row["cant_restante"]!=0){ 
                    if($row["linea"]=='Vidrio' || $row["linea"]=='VIDRIO'){
                        $read = '';
                    }else{
                        $read = 'readonly';
                    }
                    ?>
            <tr>
                <td width="3%"><?php echo $cont ?></a></td>
                <td width="3%"><?php echo $row["orden"] ?></a></td>
                <td width="5%"><?php echo $row['codigo'] ?></font></td>
                <td width="25%"><?php echo $ver.''.$row['producto'].', Vidrio:'.$fv1["color_v"].', Cierre:'.$row["cierre"].' '.$d1 ?></a><br>
                <input type="text"  name="id" required value="0" style="width:40px">
                <a href="../vistas/productos.php?cot=<?php echo $row["linea_cot"] ?>" target="_blank" onClick="window.open(this.href, this.target, width=400,height=300); return false;"><img src="../imagenes/check.png"></a></td>
                <td width="7%"><?php echo $select ?></td>
                <td width="7%">
                    <input type="text" <?php echo $in ?> name="ubicacion" id="ubicacion<?php echo $cont ?>" required value="<?php echo $row["ubicacion_c"] ?>" style="width:100px">
                </td>
                <td width="4%"><div align="center"><?php echo $fv1["espesor_v"]; ?></div></td>
                <td class="hidden-phone">
                    <input type="text" <?php echo $in ?> autocomplete="off"  name="ancho" id="ancho<?php echo $cont ?>" required value="<?php echo $an ?>" style="width:40px"><br>
                    <input type="hidden"  name="ancho1" id="ancho1<?php echo $cont ?>"  required value="<?php echo $an ?>" style="width:40px">
                    <input type="text"  name="anchod" id="anchod<?php echo $cont ?>" <?php echo $read ?> required value="<?php echo $an ?>" style="width:40px"><b><font color="red">i</font></b>
                </td>
                <td class="hidden-phone">
                    <input type="text" <?php echo $in ?> name="alto" id="alto<?php echo $cont ?>" required value="<?php echo $al ?>" style="width:40px"><br>
                    <input type="hidden"  name="alto1" autocomplete="off"  id="alto1<?php echo $cont ?>"  required value="<?php echo $al ?>" style="width:40px">
                    <input type="text"  name="altod" autocomplete="off"  id="altod<?php echo $cont ?>" <?php echo $read ?> required value="<?php echo $al ?>" style="width:40px"><b><font color="red">i</font></b>
                </td>
                <td width="4%"><div align="center"><?php echo $row["cantidad_c"] ?></div></td>
                <td width="4%"><div align="center"><?php echo $pr ?></div></td>
                <td width="4%" id="cant_rest<?php echo $cont ?>"><div align="center"><?php echo $row["cant_restante"] ?></div></td>
                <td width="4%">
                    <input type="text" autocomplete="off" <?php echo $in ?> name="cantidad" id="cantidad<?php echo $cont ?>" required value="" style="width:20px"></td>
                <td><div align="center"><?php echo $boton ?> <input type="hidden" id="ord<?php echo $cont ?>" value="<?php echo $row['id_cotizacion']; ?>"></div></td>
            </tr> 
            
           
            <input type="hidden" id="id_r<?php echo $cont ?>" value="<?php echo $row['id_referencia']; ?>">
            <?php }  }  }  ?>
            <input type="hidden" value="<?php echo $cont ?>" id="y">
            <input type="hidden" id="cot" value="<?php echo $_GET['cot']; ?>">
            <input type="hidden" id="cli" value="<?php echo $_GET['cli']; ?>">
            <input type="hidden" id="op" value="<?php echo $_GET['op']; ?>">
    </table>
       <?php
                          
} 

    }
    
}
    
?>

