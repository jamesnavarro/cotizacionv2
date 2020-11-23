<script src="../js/funciones2.js" type="text/javascript"></script>
<script src="../js/buscadores2.js" type="text/javascript"></script>
<?php

    include '../clases/clases2.php'; 
    include '../modelo/conexion.php';
    
    $clases = new general2;
    
    $por = $_GET['por'];
    $pagina = $_GET['pagina'];
    $mas = $_GET['mas'];
    $id_cotizacion = $_GET['idcoti'];
    $cotizacion = $_GET['cotizacion2'];
    $cliente = $_GET['cliente2'];
    $pvi = $_GET['pvi2'];
    $pal = $_GET['pal2'];
    $pac = $_GET['pac2'];
    
            $sql21 = ("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$cotizacion." and c.id_cotizacion_sub=".$id_cotizacion."");
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $linea_cot= $fila21["linea_cot_sub"];
            $id_referencia= $fila21["id_p"];
            $producto= $fila21["producto"];
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
            $ruta= $fila21["ruta"];
            $id3_vidrio= $fila21["id3_vidrio"];
            $id3_vidrio2= $fila21["id3_vidrio2"];
            $id3_vidrio3= $fila21["id3_vidrio3"];
            $id3_vidrio4= $fila21["id3_vidrio4"];
            $id3_vidrio5= $fila21["id3_vidrio5"];
            $pelicula= $fila21["pelicula"];
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
                                            
    $cons = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
    $pd = $cons['precio_dolar'];
                                               ?>
<label>Precio Dollar: $<?php echo $pd ?></label>
<input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" id="id_dolarx" style="width:40px;" >
<input type="hidden" value="<?php echo $cliente ?>" id="clientex" style="width:40px;">
<input type="hidden" value="<?php echo $cotizacion ?>" id="cotizacionx" style="width:40px;" >  
<input type="hidden" value="<?php echo $id_cotizacion ?>" id="id_cotizacionx" style="width:40px;" > 
<input type="hidden" value="<?php echo $mas ?>" name="mas" id="mas" style="width:40px;" >     
<input type="hidden" value="<?php echo $por ?>" id="porx" style="width:40px;" >    
<input type="hidden" value="<?php echo $pagina ?>" id="paginax" style="width:40px;" >  

<table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td>linea de produccion</td>
                                            <td><select name="linea" id="lineax">
                                                    <?php if(isset($_GET['idcoti'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `lineas`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         
                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Instalacion:</td>
                                            <td> <select name="install" id="installx" style="width: 80px;">
                                                        <?php echo '<option value="'.$install.'">'.$install.'</option>';    ?>
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                            <td rowspan="7" id="imagenx"><?php 
            if($lado=='Derecho'){
                echo '<img src="../producto/'.$ruta.'" width=120px heigth=120px>';
            }else{
                 echo '<img src="../producto/no.jpg" width=120px heigth=120px>';
                 
            } ?></td>
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td><div id="busquedax"><a href="../vistas/lista_productos2.php?linea=<?php echo $linea_cot; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <img src="../imagenes/pop.png"> Busqueda Avanzada</a></div>
                                                <input name="a" type="hidden" readonly id="referx"  value="<?php echo $fila21["referencia_p"]; ?>">
                                                <input name="b" readonly type="text" id="descrx"  value="<?php echo $producto; ?>">
                                                <input type="hidden" readonly name="ref" id="codigx" value="<?php echo $id_referencia; ?>">
                                                </td>
                                            <td>Precios:</td>
                                            <td> <select name="precio" id="preciox"  style="width: 80px;">
                                                        <?php echo '<option value="'.$por.'">'.$por.'</option>'; ?>
                                                         <option value="p3">p3</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p1">p1</option>
                                                    </select></td>
                                           
                                        </tr>
                                       
                                            </td>
                                         
                                            
                                        </tr> 
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado"  id="ladox"  style="width: 100%;" required>                                                       
                                                        <?php if(isset($_GET['idcoti'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                            
                                                       
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                </select></td>
                                                <td>Desperdicio de materia prima:</td>
                                            <td> <select name="precio_mp" id="precio_mpx" style="width: 80px;">
                                                        <?php echo '<option value="'.$por_mp.'">'.$por_mp.'</option>'; ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Trazabilidad del vidrio</td>
                                             <td id="vidriosx"> 
                                                   <?php if(isset($_GET['idcoti'])){
                                                       if($traz_vid==0){
                                                      
                                                            echo "<input type='hidden' name='traz_vid' id='valo1x' value='".$traz_vid."'  required>"
                                                                    . "<input placeholder='Vidrio #1' type='text' name='xxx' id='valo2x' value='Ya tiene' required  onclick='vidrio()'>"
                                                                    . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

                                                       }else{
                                                        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid." ";
                                                        $res=  mysqli_query($conexion,$con);
                                                         while($f=  mysqli_fetch_array($res)){
                                                        $idco=$f['id_p'];
                                                        $nombre1=$f['producto'];

                                                        }
                                                        $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid2." ";
                                                        $res2=  mysqli_query($conexion,$con2);
                                                         while($f2=  mysqli_fetch_array($res2)){
                                                        $idco2=$f2['id_p'];
                                                        $nombre2=$f2['producto'];

                                                        }
                                                         if($modulo ==0){
           echo "<input type='hidden' name='traz_vid' id='valo1x' value='".$idco."'  required>"
                   . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2x'  required onclick='vidrio()'>"
                   . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

    }else{
           echo "<input type='hidden' name='traz_vid' id='valo1x' value='".$idco."'  required>"
                   . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2x'  required onclick='vidrio()'> ";

           echo "<input type='hidden' name='traz_vid2' id='valo3x' value='".$idco2."'  required>"
                   . "<input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4x'  required onclick='vidrio2()'> ";
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
                                            <td id="descuento">  <select name="desc" id="descx" style="width: 60px;">
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
                                                <div  id="lamx">
                                                    <?php if(isset($_GET['idcoti'])){ 
                                                        if($laminas!=0){  ?>
                                                    <select name="laminas" id="laminax" style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['idcoti'])){echo '<option value="'.$laminas.'">'.$laminas.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php }else{echo '<input type="text" name="laminas" value="0">';}?>
                                                </div>
                                                <div  id="lam2x">
                                                    <?php if($laminas2!=0){  ?>
                                                    <select name="laminas2" id="lamina2x" style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['idcoti'])){echo '<option value="'.$laminas2.'">'.$laminas2.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam3x">
                                                    <?php if($laminas3!=0){  ?>
                                                    <select name="laminas3" id="lamina3x" style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['idcoti'])){echo '<option value="'.$laminas3.'">'.$laminas3.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                     
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam4x">
                                                    <?php if($laminas4!=0){  ?>
                                                    <select name="laminas4" id="lamina4x" style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['idcoti'])){echo '<option value="'.$laminas4.'">'.$laminas4.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        
                                                </select>
                                                    <?php }} ?>
                                                </div>
                                           </td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor de vidrio</td>
                                             <td>
                                                <div  id="vidx">
                                                    <?php
                                                    if($laminas==0) {  
                                                    
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2x' value='0' required>"
                                                        . "<input type='text' name='xxx' id='valor1x' value='No tiene vidrio'  required>";
                                                        
                                                    }
                                                     }
                                                    if($laminas>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
                                                    $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2x' value='".$id_vidrio."' required>"
                                                                . "<input type='text' name='xxx' id='valor1x' value='".$color_v."'  required onclick='atencion12()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio2;
                                                    $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid2' id='valor4x' value='".$id_vidrio2."' required>"
                                                                . "<input type='text' name='xxx' id='valor3x' value='".$color_v2."'  required onclick='atencion2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio3;
                                                    $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid3' id='valor6x' value='".$id_vidrio3."' required>"
                                                                . "<input type='text' name='xxx' id='valor5x' value='".$color_v3."'  required onclick='atencion3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio4;
                                                    $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid4' id='valor8x' value='".$id_vidrio4."' required>"
                                                                . "<input type='text' name='xxx' id='valor7x' value='".$color_v4."'  required onclick='atencion4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio5;
                                                    $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid5' id='valor10x' value='".$id_vidrio5."' required>"
                                                                . "<input type='text' name='xxx' id='valor9x' value='".$color_v5."'  required onclick='atencion5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio6;
                                                    $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor12x' value='".$id_vidrio6."' required>"
                                                                . "<input type='text' name='xxx' id='valor11x' value='".$color_v6."'  required onclick='atencion6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                            <div  id="vidx2">
                                                <?php if($laminas2>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio;
                                                    $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd' id='valor22x' value='".$id2_vidrio."' required>"
                                                                . "<input type='text' name='xxx' id='valor21x' value='".$color_v."'  required onclick='atenciond()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas2>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio2;
                                                    $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd2' id='valor24x' value='".$id2_vidrio2."' required>"
                                                                . "<input type='text' name='xxx' id='valor23x' value='".$color_v2."'  required onclick='atenciond2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio3;
                                                    $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd3' id='valor26x' value='".$id_vidrio3."' required>"
                                                                . "<input type='text' name='xxx' id='valor25x' value='".$color_v3."'  required onclick='atenciond3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio4;
                                                    $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd4' id='valor28x' value='".$id2_vidrio4."' required>"
                                                                . "<input type='text' name='xxx' id='valor27x' value='".$color_v4."'  required onclick='atenciond4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas2>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio5;
                                                    $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd5' id='valor210x' value='".$id2_vidrio5."' required>"
                                                                . "<input type='text' name='xxx' id='valor29x' value='".$color_v5."'  required onclick='atenciond5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas2>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio6;
                                                    $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidd6' id='valor212x' value='".$id2_vidrio6."' required>"
                                                                . "<input type='text' name='xxx' id='valor211x' value='".$color_v6."'  required onclick='atenciond6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?></div>
                                                <div  id="vidx3">
                                                     <?php if($laminas3>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio;
                                                    $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt' id='valor32x' value='".$id3_vidrio."' required>"
                                                                . "<input type='text' name='xxx' id='valor31x' value='".$color_v."'  required onclick='atenciont()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas3>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio2;
                                                    $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt2' id='valor34x' value='".$id3_vidrio2."' required>"
                                                                . "<input type='text' name='xxx' id='valor33x' value='".$color_v2."'  required onclick='atenciont2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio3;
                                                    $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt3' id='valor36x' value='".$id3_vidrio3."' required>"
                                                                . "<input type='text' name='xxx' id='valor35x' value='".$color_v3."'  required onclick='atenciont3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio4;
                                                    $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt4' id='valor38x' value='".$id3_vidrio4."' required>"
                                                                . "<input type='text' name='xxx' id='valor37x' value='".$color_v4."'  required onclick='atenciont4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas3>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio5;
                                                    $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt5' id='valor310x' value='".$id3_vidrio5."' required>"
                                                                . "<input type='text' name='xxx' id='valor39x' value='".$color_v5."'  required onclick='atenciont5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas3>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio6;
                                                    $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidt6' id='valor312x' value='".$id3_vidrio6."' required>"
                                                                . "<input type='text' name='xxx' id='valor311x' value='".$color_v6."'  required onclick='atenciont6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                <div  id="vidx4">
                                                     <?php if($laminas4>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio;
                                                    $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidc' id='valor42x' value='".$id4_vidrio."' required>"
                                                                . "<input type='text' name='xxx' id='valor41x' value='".$color_v."'  required onclick='atencionc()'>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas4>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio2;
                                                    $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidc2' id='valor44x' value='".$id4_vidrio2."' required>"
                                                                . "<input type='text' name='xxx' id='valor43x' value='".$color_v2."'  required onclick='atencionc2()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio3;
                                                    $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidc3' id='valor46x' value='".$id4_vidrio3."' required>"
                                                                . "<input type='text' name='xxx' id='valor45x' value='".$color_v3."'  required onclick='atencionc3()'>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio4;
                                                    $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidc4' id='valor48x' value='".$id4_vidrio4."' required>"
                                                                . "<input type='text' name='xxx' id='valor47x' value='".$color_v4."'  required onclick='atencionc4()'>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas4>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio5;
                                                    $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vidc5' id='valor410x' value='".$id4_vidrio5."' required>"
                                                                . "<input type='text' name='xxx' id='valor49x' value='".$color_v5."'  required onclick='atencionc5()'>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas4>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio6;
                                                    $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['idcoti'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor412x' value='".$id4_vidrio6."' required>"
                                                                . "<input type='text' name='xxx' id='valor411x' value='".$color_v6."'  required onclick='atencion6()'>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                </td>
                                           <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" id="ubicacionx" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['idcoti'])){echo $ubica;} ?></textarea></td>
                                           
                                            
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td> <select name="alum" id="alumx" required>
                                                    <?php if(isset($_GET['idcoti'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysqli_query($conexion,$consulta6);
                                                            while($fila=  mysqli_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" id="duracionx" style="width: 80px;" value="<?php if(isset($_GET['idcoti'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td><select name="cierre" id="cierrex" required>
                                                    <?php if(isset($_GET['idcoti'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `cierres`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['cierre'];
                                                           
                                                        
                                                         
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" id="descripcionx" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['idcoti'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="7" id="areas">trazabilidad</td>
                                        </tr>
                                        
                                            <div id="hoja"> <input type="hidden" name="hoja" id="hojax" value="<?php  echo $hoja; ?>"></div>
                                           
                                       
                                        <tr>
                                            <td>Medidas</td>
                                            <td><input type="text" name="ancho" id="anchox" value="<?php if(isset($_GET['idcoti'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required>
                                            X <input type="text" name="alto" id="altox" value="<?php if(isset($_GET['idcoti'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
                                            <td>Si tiene Cuerpo fijo o rejilas por favor digite la medida</td>
                                            <td><input type="text" name="cuerpo" id="cuerpox" value="<?php if(isset($_GET['idcoti'])){echo $cuerpo;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
                                           
                                        </tr>
                                        <tr>
                                           <td>Cantidad</td>
                                            <td><input type="text" name="cant" id="cantx" value="<?php if(isset($_GET['idcoti'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required> </td>
                                            
                                           <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula" id="peliculax">
                                                    <?php if(isset($_GET['idcoti'])){
                                                        echo "<option value='".$pelicula."'>".$pelicula."</option>";
                                                    } ?>
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td> <input type="text" name="ancho_abajo" id="ancho_abajox" value="<?php if(isset($_GET['idcoti'])){echo $aa;} ?>"  style="width: 70px;"  placeholder="Alto en mm" required></td>
                                            <td></td>
                                            <td></td>
                                 
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td>Verticales<input type="text" name="vert" id="vertx" value="<?php echo $vert; ?>"  style="width: 70px;">
                                                
                                            </td>
                                            <td>Horizontales</td>
                                            <td><input type="text" name="hori" id="horix" value="<?php echo $hori; ?>"  style="width: 70px;"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> <input type="checkbox" name="d1" id="d1x" <?php if($d1!='0'){echo 'checked';}  ?> value="1">Automatico</td>
                                            <td></td><td></td>
                                        </tr>
                                    </table>

<div class="modal-footer">

    <button type="button" id="editar_prod2" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>

