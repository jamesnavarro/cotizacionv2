<script>
    function eliminar_prod(idcotizacion,cotizacion,cliente,mas){
        var por = $('#por').val();
        var pagina = $('#pagina').val();
        var tipocliente = $('#tipo_cli').val();
        var eliminar = confirm('Desea Eliminar Items?')
        if(eliminar){
            $.ajax({    
                type: 'GET',
                data: 'idcotizacion='+idcotizacion+'&cotizacion='+cotizacion+'&cliente='+cliente+'&mas='+mas+'&por='+por+'&pagina='+pagina+'&tipocliente='+tipocliente,
                url: '../modelo/eliminar_items2.php'
                
            });
            
            location.href=('../vistas/?id=add_acc&cot='+cotizacion+'&cli='+cliente+'&mas='+mas+'&por='+por+'&pagina='+pagina+'&tipo_cli='+tipocliente)
        }else{
            return false;
        }
    }
     function copiar(id_item,id_cot, cli){
                
            var con = confirm("Desea copiar este items?");
            if(con){
                var can = prompt("Cantidad a copiar");
                if(can===''){
                    alert("Debes digitar la cantidad a copiar");
                    return false;
                }
                $("#"+id_item+"").attr("disabled", true);
                
                $.ajax({
                        type: 'GET',
                        data: 'cli='+cli+'&copy='+id_item+'&cot='+id_cot+'&can='+can,
                        url: '../vistas/form/copiar_items_comp.php',
                        success: function(data){
    			alert(data);
                        location.reload();
    		        }
                });
                  
            }
    }
    $(document).ready(function(){
    $("#ancho_max").change(function(){
            var an = $("#an_max").val();
            var ancho = $("#ancho_max").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg").val("El ancho es mayor al standar "+an);
                $("#ancho_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg").val('');
                 $("#ancho_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto_max").change(function(){
            var an = $("#al_max").val();
            var ancho = $("#alto_max").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg2").val("El alto es mayor al standar "+an);
                 $("#alto_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg2").val('');
                 $("#alto_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#ancho2").change(function(){
            var an = $("#an_max2").val();
            var ancho = $("#ancho2").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg3").val("El ancho es mayor al standar "+an);
                $("#ancho2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg3").val('');
                 $("#ancho2").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto2").change(function(){
            var an = $("#al_max2").val();
            var ancho = $("#alto2").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg4").val("El alto es mayor al standar "+an);
                 $("#alto2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg4").val('');
                  $("#alto2").attr("style", "border-color:black;width: 70px;");
            }
        });
    });
</script>
<?php 
 if(isset($_GET['up_1'])){
 $sql21 = "SELECT * FROM referencia_acce where id_ref_acce=".$_GET['up_1'];
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $ref= $fila21["num_ref"];
            $des= $fila21["descripcion_a"];
            $cod= $fila21["codigo"];
            $cos= $fila21["costo_a"];
        
 }
?>  
<input type="hidden" id="por" value="<?php echo $_GET['por'] ?>">
<input type="hidden" id="pagina" value="<?php echo $_GET['pagina'] ?>">
<input type="hidden" id="tipo_cli" value="<?php echo $_GET['tipo_cli'] ?>">
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
                                <h4 class="title">Elementos Adicionaes de la Estructura</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               <?php     if($estado=='En proceso'){  ?>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span> Elementos</a></li>
                                    <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Elemento </a></li>
                                  
                               </ul><?php } ?>
                                <div class="tab-content">
                                    <div class="tab-pane <?php if(isset($_GET['up_a'])){}else{echo 'active';}  ?>" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                       
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                           <?php 
    
if(isset($_GET['cot'])){ 
 $request=mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['mas']."");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th>'.'Copiar'.'</th>';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="5%">'.'# O.P'.'</th>'; 
               $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="25%">'.'Producto'.'</th>';
              $table = $table.'<th width="7%">'.'Observacion.'.'</th>'; 
              $table = $table.'<th width="7%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cierres'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Espesor Vid.'.'</th>';
              
               $table = $table.'<th class="hidden-phone">'.'Ancho.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Alto.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Precio Und.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Precio Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'%'.'</th>';
              
           
               
               $table = $table.'<th>'.'Edit'.'</th>';
                $table = $table.'<th>'.'Elim'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $ta2 =0;
        $cont =0;
	while($row=mysql_fetch_array($request))
	{
           
            $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult2= $fi3["p"]/100;
                
               $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio_sub']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
  if($row["cod_traz_sub"]==''){
      $r = 'No se selecciono ninguna trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz_sub"];                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
  $proceso=$fila['nombre_proceso'];
    
} 
if(isset($proceso)){$r = $proceso; }else{ $r ='Las areas seleccionadas no existen en la base de datos';}
  }         
             if($row["linea_cot_sub"]=='Vidrio'){$d1 = 'Per:'.$row["per_sub"].', Boq:'.$row["boq_sub"];}else{$d1 = 'Color Alum:'.$row["color_ta_sub"];}
            
            $cont = $cont + 1;
                    $suma2 = $row["valor_c_sub"];
            $a = $suma2 / $mult2;
          
            $b = $a ;
            $descpor = $b *$row["desc_sub"]/100;
            $b = $b - $descpor;
            $ta2 = $ta2 + $b;
             if($estado=='En proceso'){ 
                  $copiar = '<button type="button" id="'.$row["id_cotizacion"].'" onclick="copiar('.$row["id_cotizacion_sub"].','.$_GET["cot"].','.$_GET["cli"].');"><img src="../imagenes/copiar.png"></button>';
                 $editar2 = '<a href="../vistas/?id=add_acc&up_a='.$row["id_cotizacion_sub"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'&mas='.$_GET["mas"].'&por='.$_GET["por"].'&pagina='.$_GET["pagina"].'&tipo_cli='.$_GET['tipo_cli'].'"><img src="../imagenes/modificar.png"></a>';
                 $borrar2 = '<img src="../imagenes/eliminar.png" style="cursor:pointer" onclick="eliminar_prod('.$row["id_cotizacion_sub"].','.$_GET["cot"].','.$_GET["cli"].','.$_GET["mas"].')">';
             }else {
                 $editar2 = '';
                 $borrar2 = '';
                 $copiar = '';
             }
   $ver = '<a href="../vistas/?id=ver_pro&l='.$row["imagen_sub"].'&per='.$row["per_sub"].'&boq='.$row["boq_sub"].''
           . '&ref='.$row["id_referencia_sub"].'&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion_sub"].''
           . '&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].'&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c_sub"].''
           . '&alto='.$row["alto_c_sub"].'&cant='.$row["cantidad_c_sub"].'&vidrio='.$fv["color_v"].'('.$fv["espesor_v"].'mm)'
           . '&id_v='.$row["id_vidrio_sub"].'&id_v2='.$row["id_vidrio_sub2"].'&id_v3='.$row["id_vidrio_sub3"].'&id_v4='.$row["id_vidrio_sub4"].'&id_v5='.$row["id_vidrio_sub5"].'&lado=Derecho&compuesto=1&id_v6='.$row["id_vidrio_sub6"].''
                                   . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
           . '&cuerpo='.$row["cuerpo_sub"].'&hojas='.$row["hojas_sub"].'&ins='.$row["install"].'&por='.$row["porcentaje_mp_sub"].''
           . '&v='.$row["verticales"].'&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'">';
           $pu = ($b)/$row["cantidad_c_sub"];
            $table = $table.'<tr><td>'.$copiar.'</td><td width="5%">'.$cont.'</a></td><td width="5%">'.$row["id_cot_sub"].'</a></td>'
                    . '<td width="7%">'.$row['codigo'].'</font></td>'
                    . '<td width="25%">'.$ver.' '.$row['producto'].'<br>'.$row['descripcion_rollo'].'</td>'
                    . '<td width="7%">'.$d1.'</a></td><td width="7%">'.$fv["color_v"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cierre_sub"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$fv["espesor_v"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["ancho_c_sub"].' (mm)</font></td>'
                    . '<td class="hidden-phone">'.$row["alto_c_sub"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_c_sub"].' (Und)<font></a></td>'
                    . '<td class="hidden-phone">$'.number_format($pu).'</font></td>'
                    . '<td class="hidden-phone">$'.number_format($b).'</font></td>'
                    . '<td class="hidden-phone">'.$row["porcentaje_sub"].'-'.$row["desc_sub"].'%</font></td>'
                   
                    . '<td>'.$editar2.'</td>'
                 
                    . '<td>'.$borrar2.'</td></tr>';   
          
		
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h4> SUBTOTAL: $'.number_format($ta2).'</h4></FONT></div>';} 
      echo '<div align="right"><FONT color="red"><h4>+ ____________________</h4></FONT></div>';
      if(isset($ta)){$ta=$ta;}else{$ta=0;}
       echo '<div align="right"><FONT color="red"><h4> TOTAL : $'.number_format($ta2+$ta).'</h4></FONT></div>';
} 
}  
 ?>
                                          
                                         
                                </div>
                            </section>
                 
                       
                      <!-- START Widget Collapse -->
                           </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
<?php
           if(isset($_GET['up_a'])){
            $sql21 = ("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_cotizacion_sub=".$_GET['up_a']."");
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $linea_cot= $fila21["linea_cot_sub"];
            $id_referencia= $fila21["id_p"];
            $producto= $fila21["producto"];
            $ancho_maximo= $fila21["ancho_maximo"];
            $alto_maximo= $fila21["alto_maximo"];
            $msg= $fila21["msg"];
            $msg2= $fila21["msg2"];
            $id_vidrio= $fila21["id_vidrio_sub"];
            $id_vidrio2= $fila21["id_vidrio_sub2"];
            $id_vidrio3= $fila21["id_vidrio_sub3"];
            $id_vidrio4= $fila21["id_vidrio_sub4"];
            $id_vidrio5= $fila21["id_vidrio_sub5"];
            $id_vidrio6= $fila21["id_vidrio_sub6"];
                
            $id2_vidrio= $fila21["id2_vidrio"];
            $id2_vidrio2= $fila21["id2_vidrio2"];
            $id2_vidrio3= $fila21["id2_vidrio3"];
            $id2_vidrio4= $fila21["id2_vidrio4"];
            $id2_vidrio5= $fila21["id2_vidrio5"];
            
            $id3_vidrio= $fila21["id3_vidrio"];
            $id3_vidrio2= $fila21["id3_vidrio2"];
            $id3_vidrio3= $fila21["id3_vidrio3"];
            $id3_vidrio4= $fila21["id3_vidrio4"];
            $id3_vidrio5= $fila21["id3_vidrio5"];
             $pelicula= $fila21["pelicula"];
             $pel= $fila21["rollo"];
            $id4_vidrio= $fila21["id4_vidrio"];
            $id4_vidrio2= $fila21["id4_vidrio2"];
            $id4_vidrio3= $fila21["id4_vidrio3"];
            $id4_vidrio4= $fila21["id4_vidrio4"];
            $id4_vidrio5= $fila21["id4_vidrio5"];
            $laminas= $fila21["laminas"];
            $laminas2= $fila21["laminas2"];
            $laminas3= $fila21["laminas3"];
            $laminas4= $fila21["laminas4"];
            $modulo= $fila21["modulo"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            $color_v = $fila21["color_v"].'- ('.$fila21["espesor_v"].')mm';
            $cierre_cot = $fila21["cierre_sub"];
            $ancho_cot= $fila21["ancho_c_sub"];
            $alto_cot= $fila21["alto_c_sub"];
            $lado= $fila21["imagen_sub"];
            $cantidad_cot= $fila21["cantidad_c_sub"];
            $por= $fila21["porcentaje_sub"];
            $por_mp= $fila21["porcentaje_mp_sub"];
            $color_ta= $fila21["color_ta_sub"];
            $cuerpo= $fila21["cuerpo_sub"];
            $hoja= $fila21["hojas_sub"];
            $desc= $fila21["desc_sub"];
            $obs= $fila21["observaciones_sub"];
              $vert= $fila21["verticales"];
              $hori= $fila21["horizontales"]; 
              $d1= $fila21["d1"];
              $duracion= $fila21["duracion"]; 
              $install= $fila21["install"];
              $traz_vid= $fila21["traz_vid"];
              $ubica= $fila21["ubicacion_c"];
              $aa= $fila21["ancho_abajo"]; 
              
              
                                           } 
                                               ?>
                                    </div>
                                    <div class="tab-pane <?php if(isset($_GET['up_a'])){echo 'active';}  ?>" id="tab6">
                                        <?php    if(!isset($_GET['up_a'])){  ?>
                                        <div class="row-fluid">
<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_a'])){echo '../modelo/cotizacion_sub.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&editar='.$_GET['up_a'].'&tipo_cli='.$_GET['tipo_cli'].'';}else{echo '../modelo/cotizacion_sub.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                           <section class="body">
                                <div class="body-inner">
                                    
                             
                                        <div class="row-fluid">
                                                  <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Guardar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                      Notificaciones: <input type="text" value="" name="msg" id="msg" readonly="false">
                                      <input type="text" value="" name="msg2" id="msg2" readonly="false">
                                     <hr>
                                                        <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td style="width:30%" >linea de produccion</td>
                                            <td><select name="linea" id="linea">
                                                    <?php if(isset($_GET['up_a'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `lineas`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         
                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                            <input type="hidden" name="pvi" value="<?php echo $pvi; ?>" id="pvi">
                                               <input type="hidden" name="pal" value="<?php echo $pal; ?>" id="pal">
                                               <input type="hidden" name="pac" value="<?php echo $pac; ?>" id="pac"></td>
                                            <td style="width:30%">Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                            <td rowspan="7" id="imagen"  style="width:40%">Imagen del producto</td>
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td><div id="busqueda"></div>
                                                <input name="a" type="hidden" readonly id="refer"  value=""><input name="b" readonly type="text" id="descr"  value="">
                                                <input type="hidden" readonly name="ref" id="codig" value="">
                                                <input type="hidden" readonly  id="an_max" value="">
                                                <input type="hidden" readonly  id="al_max" value="">
                                                </td>
                                            <td>Descuento de Precios:</td>
                                            <td> <select name="precio"  style="width: 80px;">
                                                    <option value="p1">p1</option>
                                                      <option value="p2">p2</option>
                                                         <option value="p3">p3</option>    
                                                      
                                                         
                                                    </select></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado"  id="select2_1" style="width: 100%;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                          <option value="">Seleccione</option>  
                                                       <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                </select></td>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="precio_mp" value="p1">
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <td>Trazabilidad del vidrio</td>
                                             <td id="vidrios"> 
                                                   <?php if(isset($_GET['up_a'])){
                                                       if($traz_vid==0){
                                                      
                                                            echo "<input type='hidden' name='traz_vid' id='valo1' value='".$traz_vid."'  required><input placeholder='Vidrio #1' type='text' name='xxx' id='valo2' value='Ya tiene'> ";

                                                       }else{
                                                        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid." ";
                                                        $res=  mysql_query($con);
                                                         while($f=  mysql_fetch_array($res)){
                                                        $idco=$f['id_p'];
                                                        $nombre1=$f['producto'];

                                                        }
                                                        $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid2." ";
                                                        $res2=  mysql_query($con2);
                                                         while($f2=  mysql_fetch_array($res2)){
                                                        $idco2=$f2['id_p'];
                                                        $nombre2=$f2['producto'];

                                                        }
                                                        $con3= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid3." ";
                                                        $res3=  mysql_query($con3);
                                                         while($f3=  mysql_fetch_array($res3)){
                                                        $idco3=$f3['id_p'];
                                                        $nombre3=$f3['producto'];

                                                        }
                                                        $con4= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid4." ";
                                                        $res4=  mysql_query($con4);
                                                         while($f4=  mysql_fetch_array($res4)){
                                                        $idco4=$f4['id_p'];
                                                        $nombre4=$f4['producto'];

                                                        }
                                                       }
//                                                       if($linea_cot!='Vidrio'){
//                                                           $con2= "SELECT * FROM `producto` where linea='Vidrio' ";
//                                                        $res=  mysql_query($con2);
//                                                         while($f=  mysql_fetch_array($res)){
//                                                        $idco=$f['id_p'];
//                                                        $nombre1=$f['producto'];
//                                                        echo '<option value="'.$idco.'">'.$nombre1.'</option>';
//                                                        }
//                                                       }
                                                       
                                                                  if($hoja ==0){
           echo "<input type='hidden' name='traz_vid' id='valo1' value='0'  required><input placeholder='Vidrio #1' type='text' name='xxx' id='valo2' value='Ya tiene'> ";

}
       if($hoja ==1){
           echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required><input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'> ";

    }
          if($hoja ==2){
           echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required><input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'> ";

           echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required><input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'> ";

    }
           if($hoja ==3){
            echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required><input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'> ";

            echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required><input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'> ";

           echo "<input type='hidden' name='traz_vid3' id='valo5' value='".$idco3."'  required><input type='text' name='xxx' value='".$nombre3."' placeholder='Vidrio #3' id='valo6'  required onclick='vidrio3()'> ";

}
           if($hoja ==4){
           echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required><input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'> ";

            echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required><input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'> ";

           echo "<input type='hidden' name='traz_vid3' id='valo5' value='".$idco3."'  required><input type='text' name='xxx' id='valo6' value='".$nombre3."' placeholder='Vidrio #3' required onclick='vidrio3()'> "; 

           echo "<input type='hidden' name='traz_vid4' id='valo7' value='".$idco4."'  required><input type='text' name='xxx' id='valo8' value='".$nombre4."' placeholder='Vidrio #4' required onclick='vidrio4()'> ";
           }
                                                   } ?>
                                                 </td>
                                            <td>Con descuento de:</td>
                                            <td id="descuento">  <select name="desc"  style="width: 60px;">
                                                       <option value="0">0</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5</option>
                                                       <option value="6">6</option>
                                                       <option value="7">7</option>
                                                       <option value="8">8</option>
                                                       <option value="9">9</option>
                                                       <option value="10">10</option>
                                                       <option value="11">11</option>
                                                       <option value="12">12</option>
                                                       <option value="13">13</option>
                                                       <option value="14">14</option>
                                                       <option value="15">15</option>
                                                       
                                                   </select>%</td>
                                            
                                        </tr>
                                        <tr>
                                            <td># Laminas</td>
                                            <td>
                                                 <div  id="lam"></div>
                                            <div  id="lam2"></div>
                                            <div  id="lam3"></div>
                                            <div  id="lam4"></div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td>Color y Espesor de vidrio</td>
                                             <td>
                                            <div  id="vid"></div>
                                            <div  id="vid2"></div>
                                            <div  id="vid3"></div>
                                            <div  id="vid4"></div>
                                            </td>
                                            <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Pelicula Laminado</td>
                                            <td>
                                                <select id="pel" name="pel">
                                                    <option value="">Seleccione</option>
                                                     <?php         
                                                           $query= "SELECT * FROM `referencias` where id_referencia in ('1107','1764','1765','1766','1870','1876') ";                     
                                                            $resul=  mysql_query($query);
                                                            while($fila=  mysql_fetch_array($resul)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor3=$fila['descripcion'];
                                                            $costo=$fila['costo_mt'];
                       
                                                            echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option>";
                                                            }
                                                           
                                                            ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td id="alum"> <select name="alum"  required>
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up_a'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td id="cierre"><select name="cierre"  required>
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `cierres`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cierre'];
                                                           
                                                        
                                                         
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up_a'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="3" id="areas">trazabilidad</td>
                                        </tr>
                                        
                                            <div id="hoja"> <input type="hidden" name="hoja" value=""></div>
                                            
                                        <tr>
                                            <td>Medidas n</td>
                                            <td><input type="text" name="ancho" id="ancho_max" value="<?php if(isset($_GET['up_a'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required> X 
                                                <input type="text" name="alto" id="alto_max" value="<?php if(isset($_GET['up_a'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
                                                <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$pelicula."'>".$pelicula."</option>";} ?>
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" name="cant" value="<?php if(isset($_GET['up_a'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
                                            <td>Si tiene Cuerpo fijo o rejilas por favor digite la medida</td>
                                            <td><input type="text" name="cuerpo"  value="0"></td>
                                           
                                        </tr>
                                         
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td><input type="text" name="ancho_abajo" value="0"></td>
                                            <td></td>
                                            <td></td>
                                          <td rowspan="3" id="areas_vid">trazabilidad</td>
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td>Verticales<input type="text" name="vert" value=""  style="width: 70px;">
                                                
                                            </td>
                                            <td>Horizontales</td>
                                            <td><input type="text" name="hori" value=""  style="width: 70px;"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> <input type="checkbox" name="d1"   value="1">Automatico</td>
                                            <td></td><td></td>
                                        </tr>
                                    </table>
                                        </div> 

                                    
                                    
                                    
                                    
                                    
                                        
                                    <div class="control-group"></div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                        <?php   }else{  ?>
                               <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_a'])){echo '../modelo/cotizacion_sub.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&editar='.$_GET['up_a'].'&tipo_cli='.$_GET['tipo_cli'].'';}else{echo '../modelo/cotizacion_sub.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                               <section class="body">
                                <div class="body-inner">
                                    
                             
                                        
                                        <div class="row-fluid">
                                                    <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Guardar Cambios</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                      Notificaciones: <input type="text" value="<?php echo $msg ?>" name="msg" id="msg3" readonly="false"> <input type="text" value="<?php echo $msg2 ?>" name="msg2" id="msg4" readonly="false">
                                     <hr>
                                 <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td>linea de produccion</td>
                                            <td><select name="linea" id="linea">
                                                    <?php if(isset($_GET['up_a'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `lineas`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         
                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        <?php echo '<option value="'.$install.'">'.$install.'</option>';    ?>
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                            <td rowspan="6" id="imagen">Imagen del producto</td>
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td><div id="busqueda"><a href="../vistas/lista_productos.php?linea=<?php echo $linea_cot; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <img src="../imagenes/pop.png"> Busqueda Avanzada</a></div>
                                                <input name="a" type="hidden" readonly id="refer"  value="<?php echo $fila21["referencia_p"]; ?>"><input name="b" readonly type="text" id="descr"  value="<?php echo $producto; ?>">
                                                <input type="hidden" readonly name="ref" id="codig" value="<?php echo $id_referencia; ?>">
                                                <input type="hidden" readonly  id="an_max2" value="<?php echo $ancho_maximo ?>">
                                                <input type="hidden" readonly  id="al_max2" value="<?php echo $alto_maximo; ?>">
                                               </td>
                                            <td>Precios:</td>
                                            <td> <select name="precio"  style="width: 80px;">
                                                        <?php echo '<option value="'.$por.'">'.$por.'</option>'; ?>
                                                         <option value="p3">p3</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p1">p1</option>
                                                    </select></td>
                                           
                                        </tr>
                                       <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado"  id="select2_1" style="width: 100%;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                          <option value="">Seleccione</option>  
                                                       <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                </select></td>
                                            <td>Precio Materia Prima</td>
                                            <td><select name="precio_mp"  style="width: 80px;" readonly>
                                                        <?php echo '<option value="'.$por_mp.'">'.$por_mp.'</option>'; ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                        </tr>
                                            </td>
                                         
                                            
                                        </tr>  
                                        <tr>
                                            <td>Trazabilidad del vidrio</td>
                                             <td id="vidrios"> 
                                                   <?php if(isset($_GET['up_a'])){
                                                       if($traz_vid==0){
                                                      
                                                            echo "<input type='hidden' name='traz_vid' id='valo1' value='".$traz_vid."'  required>"
                                                                    . "<input placeholder='Vidrio #1' type='text' name='xxx' id='valo2' value='Ya tiene' required  onclick='vidrio()'>"
                                                                    . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

                                                       }else{
                                                        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid." ";
                                                        $res=  mysql_query($con);
                                                         while($f=  mysql_fetch_array($res)){
                                                        $idco=$f['id_p'];
                                                        $nombre1=$f['producto'];

                                                        }
                                                        $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid2." ";
                                                        $res2=  mysql_query($con2);
                                                         while($f2=  mysql_fetch_array($res2)){
                                                        $idco2=$f2['id_p'];
                                                        $nombre2=$f2['producto'];

                                                        }
                                                         if($modulo ==0 || $modulo==1){
           echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required>"
                   . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'>"
                   . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

    }else{
           echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required><input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'> ";

           echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required><input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'> ";
     echo "<select name='modulo' required>";
       echo "<option value='".$modulo."'>Seleccionado modulo ".$modulo."</option>";
        for($x=1; $x<=$hoja; $x=$x+1){
            
            echo "<option value='".$x."'>".$x."</option>";
        }
       echo "</select>";
    }
                                                       }

                                                      
      
                                                   } ?>
                                                 </td>
                                            <td>Con descuento de:</td>
                                            <td id="descuento">  <select name="desc"  style="width: 60px;">
                                                    <?php echo '<option value="'.$desc.'">'.$desc.'</option>';  ?>
                                                       <option value="0">0</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5</option>
                                                       <option value="6">6</option>
                                                       <option value="7">7</option>
                                                       <option value="8">8</option>
                                                       <option value="9">9</option>
                                                       <option value="10">10</option>
                                                       <option value="11">11</option>
                                                       <option value="12">12</option>
                                                       <option value="13">13</option>
                                                       <option value="14">14</option>
                                                       <option value="15">15</option>
                                                       
                                                   </select>%</td>
                                            
                                        </tr>
                                        <tr>
                                            <td># Laminas</td>
                                              <td> 
                                                <div  id="lam">
                                                    <?php if(isset($_GET['up_a'])){ 
                                                        if($laminas!=0){  ?>
                                                     <select name="laminas"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$laminas.'">'.$laminas.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php }else{echo '<input type="text" name="laminas" value="0">';}?>
                                                </div>
                                                <div  id="lam2">
                                                    <?php if($laminas2!=0){  ?>
                                                     <select name="laminas2"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$laminas2.'">'.$laminas2.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam3">
                                                    <?php if($laminas3!=0){  ?>
                                                     <select name="laminas3"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$laminas3.'">'.$laminas3.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                     
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam4">
                                                    <?php if($laminas4!=0){  ?>
                                                     <select name="laminas4"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up_a'])){echo '<option value="'.$laminas4.'">'.$laminas4.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        
                                                </select>
                                                    <?php }} ?>
                                                </div>
                                           </td>
                                            <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up_a'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor de vidrio</td>
                                             <td>
                                                <div  id="vid">
                                                    <?php
                                                    if($laminas==0) {  
                                                    
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='0' required><input type='text' name='xxx' id='valor1' value='No tiene vidrio'  required>";
                                                        
                                                    }
                                                     }
                                                    if($laminas>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='".$id_vidrio."' required><input type='text' name='xxx' id='valor1' value='".$color_v."'  required onclick='atencion()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid2' id='valor4' value='".$id_vidrio2."' required><input type='text' name='xxx' id='valor3' value='".$color_v2."'  required onclick='atencion2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid3' id='valor6' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor5' value='".$color_v3."'  required onclick='atencion3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid4' id='valor8' value='".$id_vidrio4."' required><input type='text' name='xxx' id='valor7' value='".$color_v4."'  required onclick='atencion4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid5' id='valor10' value='".$id_vidrio5."' required><input type='text' name='xxx' id='valor9' value='".$color_v5."'  required onclick='atencion5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor12' value='".$id_vidrio6."' required><input type='text' name='xxx' id='valor11' value='".$color_v6."'  required onclick='atencion6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                            <div  id="vid2">
                                                <?php if($laminas2>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd' id='valor22' value='".$id2_vidrio."' required><input type='text' name='xxx' id='valor21' value='".$color_v."'  required onclick='atenciond()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas2>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd2' id='valor24' value='".$id2_vidrio2."' required><input type='text' name='xxx' id='valor23' value='".$color_v2."'  required onclick='atenciond2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd3' id='valor26' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor25' value='".$color_v3."'  required onclick='atenciond3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd4' id='valor28' value='".$id2_vidrio4."' required><input type='text' name='xxx' id='valor27' value='".$color_v4."'  required onclick='atenciond4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas2>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd5' id='valor210' value='".$id2_vidrio5."' required><input type='text' name='xxx' id='valor29' value='".$color_v5."'  required onclick='atenciond5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas2>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidd6' id='valor212' value='".$id2_vidrio6."' required><input type='text' name='xxx' id='valor211' value='".$color_v6."'  required onclick='atenciond6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?></div>
                                                <div  id="vid3">
                                                     <?php if($laminas3>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt' id='valor32' value='".$id3_vidrio."' required><input type='text' name='xxx' id='valor31' value='".$color_v."'  required onclick='atenciont()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas3>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt2' id='valor34' value='".$id3_vidrio2."' required><input type='text' name='xxx' id='valor33' value='".$color_v2."'  required onclick='atenciont2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt3' id='valor36' value='".$id3_vidrio3."' required><input type='text' name='xxx' id='valor35' value='".$color_v3."'  required onclick='atenciont3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt4' id='valor38' value='".$id3_vidrio4."' required><input type='text' name='xxx' id='valor37' value='".$color_v4."'  required onclick='atenciont4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas3>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt5' id='valor310' value='".$id3_vidrio5."' required><input type='text' name='xxx' id='valor39' value='".$color_v5."'  required onclick='atenciont5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas3>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidt6' id='valor312' value='".$id3_vidrio6."' required><input type='text' name='xxx' id='valor311' value='".$color_v6."'  required onclick='atenciont6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                <div  id="vid4">
                                                     <?php if($laminas4>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidc' id='valor42' value='".$id4_vidrio."' required><input type='text' name='xxx' id='valor41' value='".$color_v."'  required onclick='atencionc()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas4>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidc2' id='valor44' value='".$id4_vidrio2."' required><input type='text' name='xxx' id='valor43' value='".$color_v2."'  required onclick='atencionc2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidc3' id='valor46' value='".$id4_vidrio3."' required><input type='text' name='xxx' id='valor45' value='".$color_v3."'  required onclick='atencionc3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidc4' id='valor48' value='".$id4_vidrio4."' required><input type='text' name='xxx' id='valor47' value='".$color_v4."'  required onclick='atencionc4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas4>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vidc5' id='valor410' value='".$id4_vidrio5."' required><input type='text' name='xxx' id='valor49' value='".$color_v5."'  required onclick='atencionc5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas4>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up_a'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor412' value='".$id4_vidrio6."' required><input type='text' name='xxx' id='valor411' value='".$color_v6."'  required onclick='atencion6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                </td>
                                            <td></td>
                                            <td> </td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Pelicula Laminado</td>
                                            <td>
                                                <select id="pel" name="pel">
                                                    <?php if(isset($_GET['up_a'])){
                                                        $query2= "SELECT * FROM `referencias` where id_referencia in ($pel) ";                     
                                                            $resul2=  mysql_query($query2);
                                                            $f = mysql_fetch_array($resul2);
                                                            $valor1=$f['id_referencia'];
                                                            $valor2=$f['codigo'];
                                                            $valor3=$f['descripcion'];
                                                            $costo=$f['costo_mt'];
                                                         echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option><option value=''>.:Seleccione</option>";
                                                            
                                                        
                                                    }else{
                                                        echo "<option value=''>.:Seleccione</option>"; 
                                                    
                                                    } ?>
                                                     <?php         
                                                           $query= "SELECT * FROM `referencias` where id_referencia in ('1107','1764','1765','1766','1870','1876') ";                     
                                                            $resul=  mysql_query($query);
                                                            while($fila=  mysql_fetch_array($resul)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor3=$fila['descripcion'];
                                                            $costo=$fila['costo_mt'];
                                                            echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option>";
                                                            }
                                                           
                                                            ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td> <select name="alum"  required>
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up_a'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td><select name="cierre"  required>
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `cierres`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cierre'];
                                                           
                                                        
                                                         
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up_a'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="3" id="areas">trazabilidad 1</td>
                                        </tr>
                                        <tr>
                                            <td># de Modulos</td>
                                            <td id="hoja"> <input type="text" name="hoja" value="<?php  echo $hoja; ?>"></td>
                                            <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up_a'])){echo $ubica;} ?></textarea></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Medidas</td>
                                            <td><input type="text" name="ancho" id="ancho2" value="<?php if(isset($_GET['up_a'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required> X
                                                <input type="text" name="alto" id="alto2" value="<?php if(isset($_GET['up_a'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
                                            <td>Si tiene Cuerpo fijo o rejilas por favor digite la medida</td>
                                            <td><input type="text" name="cuerpo" value="<?php if(isset($_GET['up_a'])){echo $cuerpo;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" name="cant" value="<?php if(isset($_GET['up_a'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
                                           <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <?php if(isset($_GET['up_a'])){echo "<option value='".$pelicula."'>".$pelicula."</option>";} ?>
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                           
                                        </tr>
                                
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td> <input type="text" name="ancho_abajo" value="<?php if(isset($_GET['up_a'])){echo $aa;} ?>"  style="width: 70px;"  placeholder="Alto en mm" required></td>
                                            <td></td> <td></td>
                                          <td rowspan="3" id="areas_vid">trazabilidad</td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td><input type="text" name="vert" value="<?php echo $vert; ?>" placeholder="Verticales"  style="width: 70px;"> X 
                                                <input type="text" name="hori" value="<?php echo $hori; ?>" placeholder="Horizontales" style="width: 70px;">
                                                
                                            </td>
                                            <td><input type="checkbox" name="d1"  <?php if($d1!='0'){echo 'checked';}  ?> value="1">Automatico</td>
                                            <td></td>
                                            
                                        </tr>
                                        
                                    </table>
                                        </div><br>
                                    </fieldset>
                                    
                                    
                                    
                                    
                                    
                                        
                                    <div class="control-group"></div>
                            </section></form>
                               
                                        <?php }  ?>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div><?php
 
// if(isset($_GET['del'])){
//$sql = "DELETE FROM cotizaciones_sub WHERE id_cotizacion_sub=".$_GET['del']."";
//mysql_query($sql, $conexion);
//            $request=mysql_query("SELECT * FROM producto a,  cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['mas']."");
//     
//if($request){
//        $ta2 =0;
//        $cont =0;
//	while($row=mysql_fetch_array($request))
//	{
//           
//            $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
//                $fi3 =mysql_fetch_array(mysql_query($s3));
//                $mult2= $fi3["p"]/100;
//                
//        
//            $cont = $cont + 1;
//            $suma = $row["valor_c_sub"]+$row["costo_v"];
//            $a = $suma * $mult2;
//            $b = $a + $suma;
//            $ta2 = $ta2 + $b;
//            $pu = ($b)/$row["cantidad_c_sub"];       
//	} 
//} 
////echo 'xxxxx'.$ta2;
//$sql3 = "UPDATE `cotizaciones` SET `precio_adicional`='".$ta2."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
//mysql_query($sql3, $conexion);
//echo "<script language='javascript' type='text/javascript'>";
//echo "location.href='../vistas/?id=add_acc&cot=".$_GET['cot']."&cli=".$_GET['cli']."&mas=".$_GET['mas']."&por=".$_GET['por']."&pagina=".$_GET['pagina']."&tipo_cli=".$_GET['tipo_cli']."'";
//echo "</script>";
//}
