<script src="../js/funciones.js" type="text/javascript"></script>
<script src="../js/buscadores.js" type="text/javascript"></script>
<?php

    include '../clases/clases.php'; 
    include '../modelo/conexion.php';
    
    $clases = new general;
    $pagina = $_GET['pagina'];
    $id_cotizacion = $_GET['idcoti'];
    $cotizacion = $_GET['cotizacion2'];
    $cliente = $_GET['cliente2'];
    $pvi = $_GET['pvi2'];
    $pal = $_GET['pal2'];
    $pac = $_GET['pac2'];
    
            $sql21 = ("SELECT * FROM producto a, cotizaciones c where   c.id_referencia=a.id_p and c.id_cot=".$cotizacion." and c.id_cotizacion=".$id_cotizacion."");
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $linea_cot= $fila21["linea_cot"];
            $id_referencia= $fila21["id_p"];
            $producto= $fila21["producto"];
            $id_vidrio= $fila21["id_vidrio"];
            $id_vidrio2= $fila21["id_vidrio2"];
            $id_vidrio3= $fila21["id_vidrio3"];
            $id_vidrio4= $fila21["id_vidrio4"];
            $id_vidrio5= $fila21["id_vidrio5"];
            $id_vidrio6= $fila21["id_vidrio6"];
            $pelicula= $fila21["pelicula"];
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
            $id4_vidrio= $fila21["id4_vidrio"];
            $id4_vidrio2= $fila21["id4_vidrio2"];
            $id4_vidrio3= $fila21["id4_vidrio3"];
            $id4_vidrio4= $fila21["id4_vidrio4"];
            $id4_vidrio5= $fila21["id4_vidrio5"];
            $lado= $fila21["imagen"];
            $ladomm= $fila21["lado"];
            $laminas= $fila21["laminas"];
            $laminas2= $fila21["laminas2"];
            $laminas3= $fila21["laminas3"];
            $laminas4= $fila21["laminas4"];
            $traz_vid= $fila21["traz_vid"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            $cierre_cot = $fila21["cierre"];
            $ancho_cot= $fila21["ancho_c"];
            $aa= $fila21["ancho_abajo"];
            $alto_cot= $fila21["alto_c"];
            $ancho_temp= $fila21["ancho_temp"];
            $alto_temp= $fila21["alto_temp"];
            $cantidad_cot= $fila21["cantidad_c"];
            $por= $fila21["porcentaje"];
            $por_mp= $fila21["porcentaje_mp"];
            $ruta= $fila21["ruta"];
            $ruta2= $fila21["ruta2"];
            $color_ta= $fila21["color_ta"];
            $cuerpo= $fila21["cuerpo"];
            $tip= $fila21["tip"];
            $hoja= $fila21["hojas"];
            $desc= $fila21["desc"];
            $per= $fila21["per"];
            $boq= $fila21["boq"];
            $install= $fila21["install"];
            $obs= $fila21["observaciones"];
            $obs2= $fila21["observaciones2"];
            $modulo= $fila21["modulo"];
            $vert= $fila21["verticales"];
            $ubica= $fila21["ubicacion_c"];
            $adicional= $fila21["imagen_mas"];
            $hori= $fila21["horizontales"]; 
            $d1= $fila21["d1"];
            $duracion= $fila21["duracion"];
                if($pvi==0 && $pal==0 && $pac==0){
                    $ppp =' <select name="desc" id="descx" style="width: 60px;" id="descuento">
                        <option value="'.$desc.'">'.$desc.'</option>
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
                    </select>';
                }else{
                    if($linea_cot=='Vidrio'){
                        $ppp = '<input type="text" name="desc" id="descx" value="'.$pvi.'" style="width: 70px;" >';
                    }else{
                        if($linea_cot=='Aluminio'){
                            $ppp = '<input type="text" name="desc" id="descx" value="'.$pal.'" style="width: 70px;" >';
                        }else{
                            $ppp = '<input type="text" name="desc" id="descx" value="'.$pac.'" style="width: 70px;" >';
                        }
                    }   
                }   
    $cons = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
    $pd = $cons['precio_dolar'];
                                               ?>
<label>Precio Dollar: $<?php echo $pd ?></label>
<input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" id="id_dolarx" style="width:40px;" >
<input type="hidden" value="<?php echo $cliente ?>" id="clientex" style="width:40px;">
<input type="hidden" value="<?php echo $cotizacion ?>" id="cotizacionx" style="width:40px;" >  
<input type="hidden" value="<?php echo $id_cotizacion ?>" id="id_cotizacionx" style="width:40px;" > 

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
                        $consulta2= "SELECT * FROM `lineas`";                     
                        $result2=  mysqli_query($conexion,$consulta2);
                        while($fila=  mysqli_fetch_array($result2)){
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
        <td rowspan="4" id="imagenx"  style="width:30%"  align="center">Imagen del producto 
            <?php 
            if($lado=='Derecho'){
                echo '<img src="../producto/'.$ruta.'" width=120px heigth=120px>';
            }else{
                if($ruta2==''){
                    echo '<img src="../producto/no.jpg" width=120px heigth=120px>';
                }else{
                echo '<img src="../producto/'.$ruta2.'" width=120px heigth=120px>';
                }
            } ?></td>

    </tr>
    <tr>
        <td>Referencia del producto</td>
        <td>
        <div id="busquedax">
            <a href="../vistas/lista_productos2.php?linea=<?php echo $linea_cot; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <img src="../imagenes/pop.png"> Busqueda Avanzada</a>
        </div>
            <input name="a" type="hidden" readonly id="referx"  value="<?php echo $fila21["referencia_p"]; ?>">
            <input name="b" readonly type="text" id="descrx"  value="<?php echo $producto; ?>">
            <input type="hidden" readonly name="ref" id="codigx" value="<?php echo $id_referencia; ?>">
        </td>
        <td>Precios:</td>
        <td> 
            <select name="precio" id="preciox" style="width: 80px;">
                <?php echo '<option value="'.$por.'">'.$por.'</option>'; ?>
                <option value="p3">p3</option>    
                <option value="p2">p2</option>
                <option value="p1">p1</option>
            </select>
        </td>

    </tr>
    <tr>
        <td>Sentido</td>
           <td><select name="lado" id="ladox" style="width: 100%;" required>                                                       
                    <?php   echo '<option value="'.$lado.'">'.$lado.'</option>';  ?>                                                      
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
        <td>Trazabilidad del vidrio

        </td>
        <td id="vidriosx"> 
            <?php
                   if($traz_vid==0){

                        echo "<input type='text'  name='traz_vid' id='valo1x' value='".$traz_vid."'  required>"
                                . "<input placeholder='Vidrio #1' autocomplete='off' type='text' name='xxx' id='valo2x' value='Ya tiene'>"
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
                   $con23= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid3." ";
                    $res23=  mysqli_query($conexion,$con23);
                     while($f2=  mysqli_fetch_array($res23)){
                    $idco3=$f2['id_p'];
                    $nombre3=$f2['producto'];

                    }
                    $con24= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid4." ";
                    $res24=  mysqli_query($conexion,$con24);
                     while($f2=  mysqli_fetch_array($res24)){
                    $idco4=$f2['id_p'];
                    $nombre4=$f2['producto'];

                    }
            if($hoja >=1){
            echo "<input type='hidden' name='traz_vid' id='valo1x' value='".$idco."'  required>"
            . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2x'  required onclick='vidrio12()'><br> ";

            }if($hoja >=2){
            echo "<input type='hidden' name='traz_vid2' id='valo3x' value='".$idco2."'  required>"
            . "<input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4x'  required onclick='vidrio24()'><br> ";

            }if($hoja >=3){
            echo "<input type='hidden' name='traz_vid3' id='valo5x' value='".$idco3."'  required>"
            . "<input type='text' placeholder='Vidrio #2' value='".$nombre3."' name='xxx' id='valo6x'  required onclick='vidrio36()'><br> ";

            }if($hoja >=4){
            echo "<input type='hidden' name='traz_vid4' id='valo7x' value='".$idco4."'  required>"
            . "<input type='text' placeholder='Vidrio #2' value='".$nombre4."' name='xxx' id='valo8x'  required onclick='vidrio48()'><br> ";

            }
                   }



               ?>
             </td>
        <td>Con descuento de:</td>
        <td><?php  echo $ppp;  ?></td>

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
        <td>Tipo: </td>
        <td><input type="text" name="tip" id="tipx" autocomplete="off" value="<?php if(isset($_GET['idcoti'])){echo $tip;} ?>" placeholder="ej: PV-1"></td>
        <td rowspan="3"><form id="subida">
<table>
	<tr>
    	<td><input type="file" id="foto" name="foto" accept="image/jpeg"/></td>
    </tr>
    <tr>
        <td><input type="submit" value="+"/></td>
    </tr>
</table>
</form>
  <div class="fotos" id="fotosx">
      <?php
      if($adicional!=''){
          echo '<img src="../adicionales/'.$adicional.'">';
          echo '<input type="text" id="serie" value="'.$adicional.'"> <button onclick="lim()">-</button>';
      }

  ?></div>
        </td>
    </tr>
    <tr>
        <td>Color y Espesor de vidrio</td>
        <td>
            <div id="vidx">
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
                            . "<input type='text' name='xxx' id='valor1x' value='".$color_v."'  required onclick='atencion12()'><br>";

                }
                 }  
                 if($laminas>=2) { 
                $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio2;
                $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid2' id='valor4x' value='".$id_vidrio2."' required>"
                            . "<input type='text' name='xxx' id='valor3x' value='".$color_v2."'  required onclick='atencion24()'><br>";

                }
                  } 
                  if($laminas>=3) { 
                $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio3;
                $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid3' id='valor6x' value='".$id_vidrio3."' required>"
                            . "<input type='text' name='xxx' id='valor5x' value='".$color_v3."'  required onclick='atencion36()'><br>";

                }
                  } 
                  if($laminas>=4) {   
                $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio4;
                $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid4' id='valor8x' value='".$id_vidrio4."' required>"
                            . "<input type='text' name='xxx' id='valor7x' value='".$color_v4."'  required onclick='atencion48()'><br>";

                }
                  }  
                  if($laminas>=5) {  
                $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio5;
                $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid5' id='valor10x' value='".$id_vidrio5."' required>"
                            . "<input type='text' name='xxx' id='valor9x' value='".$color_v5."'  required onclick='atencion510()'><br>";

                }
                 } 
                 if($laminas>=6) {  
                $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio6;
                $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid6' id='valor12x' value='".$id_vidrio6."' required>"
                            . "<input type='text' name='xxx' id='valor11x' value='".$color_v6."'  required onclick='atencion612()'><br>";

                }

                        ?>


                <?php }  ?>
            </div>
        <div  id="vid2x">
            <?php if($laminas2>=1) {  
                $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio;
                $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd' id='valor22x' value='".$id2_vidrio."' required>"
                            . "<input type='text' name='xxx' id='valor21x' value='".$color_v."'  required onclick='atenciond12()'><br>";

                }
                 }  
                 if($laminas2>=2) { 
                $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio2;
                $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd2' id='valor24x' value='".$id2_vidrio2."' required>"
                            . "<input type='text' name='xxx' id='valor23x' value='".$color_v2."'  required onclick='atenciond24()'><br>";

                }
                  } 
                  if($laminas2>=3) { 
                $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio3;
                $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd3' id='valor26x' value='".$id_vidrio3."' required>"
                            . "<input type='text' name='xxx' id='valor25x' value='".$color_v3."'  required onclick='atenciond36()'><br>";

                }
                  } 
                  if($laminas2>=4) {   
                $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio4;
                $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd4' id='valor28x' value='".$id2_vidrio4."' required>"
                            . "<input type='text' name='xxx' id='valor27x' value='".$color_v4."'  required onclick='atenciond48()'><br>";

                }
                  }  
                  if($laminas2>=5) {  
                $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio5;
                $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd5' id='valor210x' value='".$id2_vidrio5."' required>"
                            . "<input type='text' name='xxx' id='valor29x' value='".$color_v5."'  required onclick='atenciond510()'><br>";

                }
                 } 
                 if($laminas2>=6) {  
                $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio6;
                $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidd6' id='valor212x' value='".$id2_vidrio6."' required>"
                            . "<input type='text' name='xxx' id='valor211x' value='".$color_v6."'  required onclick='atenciond612()'><br>";

                }

                        ?>


                <?php }  ?></div>
            <div  id="vid3x">
                 <?php if($laminas3>=1) {  
                $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio;
                $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt' id='valor32x' value='".$id3_vidrio."' required>"
                            . "<input type='text' name='xxx' id='valor31x' value='".$color_v."'  required onclick='atenciont12()'><br>";

                }
                 }  
                 if($laminas3>=2) { 
                $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio2;
                $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt2' id='valor34x' value='".$id3_vidrio2."' required>"
                            . "<input type='text' name='xxx' id='valor33x' value='".$color_v2."'  required onclick='atenciont24()'><br>";

                }
                  } 
                  if($laminas3>=3) { 
                $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio3;
                $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt3' id='valor36x' value='".$id3_vidrio3."' required>"
                            . "<input type='text' name='xxx' id='valor35x' value='".$color_v3."'  required onclick='atenciont36()'><br>";

                }
                  } 
                  if($laminas3>=4) {   
                $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio4;
                $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt4' id='valor38x' value='".$id3_vidrio4."' required>"
                            . "<input type='text' name='xxx' id='valor37x' value='".$color_v4."'  required onclick='atenciont48()'><br>";

                }
                  }  
                  if($laminas3>=5) {  
                $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio5;
                $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt5' id='valor310x' value='".$id3_vidrio5."' required>"
                            . "<input type='text' name='xxx' id='valor39x' value='".$color_v5."'  required onclick='atenciont510()'><br>";

                }
                 } 
                 if($laminas3>=6) {  
                $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio6;
                $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidt6' id='valor312x' value='".$id3_vidrio6."' required>"
                            . "<input type='text' name='xxx' id='valor311x' value='".$color_v6."'  required onclick='atenciont612()'><br>";

                }

                        ?>


                <?php }  ?>
            </div>
            <div  id="vid4x">
                 <?php if($laminas4>=1) {  
                $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio;
                $fila =mysqli_fetch_array(mysqli_query($conexion,$sql));
                $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidc' id='valor42x' value='".$id4_vidrio."' required>"
                            . "<input type='text' name='xxx' id='valor41x' value='".$color_v."'  required onclick='atencionc12()'><br>";

                }
                 }  
                 if($laminas4>=2) { 
                $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio2;
                $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
                $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidc2' id='valor44' value='".$id4_vidrio2."' required>"
                            . "<input type='text' name='xxx' id='valor43' value='".$color_v2."'  required onclick='atencionc24()'><br>";

                }
                  } 
                  if($laminas4>=3) { 
                $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio3;
                $fila3 =mysqli_fetch_array(mysqli_query($conexion,$sql3));
                $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidc3' id='valor46x' value='".$id4_vidrio3."' required>"
                            . "<input type='text' name='xxx' id='valor45x' value='".$color_v3."'  required onclick='atencionc36()'><br>";

                }
                  } 
                  if($laminas4>=4) {   
                $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio4;
                $fila4 =mysqli_fetch_array(mysqli_query($conexion,$sql4));
                $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidc4' id='valor48' value='".$id4_vidrio4."' required>"
                            . "<input type='text' name='xxx' id='valor47' value='".$color_v4."'  required onclick='atencionc48()'><br>";

                }
                  }  
                  if($laminas4>=5) {  
                $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio5;
                $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vidc5' id='valor410x' value='".$id4_vidrio5."' required>"
                            . "<input type='text' name='xxx' id='valor49x' value='".$color_v5."'  required onclick='atencionc510()'><br>";

                }
                 } 
                 if($laminas4>=6) {  
                $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio6;
                $fila6 =mysqli_fetch_array(mysqli_query($conexion,$sql6));
                $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                if(isset($_GET['idcoti'])){

                    echo "<input type='hidden' name='vid6' id='valor412x' value='".$id4_vidrio6."' required>"
                            . "<input type='text' name='xxx' id='valor411x' value='".$color_v6."'  required onclick='atencion612()'><br>";

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
        <td id="res_alumx"> 
            <select name="alum" id="alumx" required>
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
        <td><input  type="number" id="duracionx" name="duracion" style="width: 80px;" value="<?php if(isset($_GET['idcoti'])){echo $duracion;} ?>" placeholder=""> dias</td>

    </tr>
    <tr>
        <td>Tiene cierre?</td>
        <td id="res_cierrex">
            <select name="cierre" id="cierrex" required>
                <?php if(isset($_GET['idcoti'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>

                        <?php
                            require '../modelo/conexion.php';
                        $consulta= "SELECT * FROM `tipo_aluminio`";                     
                        $result=  mysqli_query($conexion,$consulta);
                        while($fila=  mysqli_fetch_array($result)){
                        $valor1=$fila['color_a'];



                        echo"<option value='".$valor1."'>".$valor1."</option>";

                        }

                        ?>
            </select>
        </td>
        <td>Observaciones</td>
        <td>
            <textarea name="descripcion" id="descripcionx" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['idcoti'])){echo $obs;} ?></textarea></td>
        <td rowspan="7" id="areasx"><?php
if (isset($_GET['idcoti'])) {
if($linea_cot!='Vidrio'){
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$id_referencia.'"';                     
$result=  mysqli_query($conexion,$consulta);
$cont = 0;
echo '<ul><li>Seleccione el Area de trazabilidad<br>';
while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$cont= $cont + 1;
if($valor1==4){
$input = '<input type="number" name="per" value="'.$per.'" style="width:40px">';
}else{
$input = '';
}
if($valor1==5){
$input2 = '<input type="number" name="boq" value="'.$boq.'" style="width:40px">';
}else{
$input2 = '';
}
echo "<input type='checkbox' checked name='cod$cont' value='".$valor1."'> - ".$valor1."- ".$valor2." ".$input." ".$input2."<br>";
}
echo '</ul></li>';
}}
?></td>
    </tr>
        <div id="hoja"> 
            <input type="hidden" name="hoja" id="hojax" value="<?php  echo $hoja; ?>"></div>

    <tr>
        <td>Medidas </td>
        <td><input type="text" autocomplete="off" name="ancho" id="anchox" value="<?php if(isset($_GET['idcoti'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required>
         X <input type="text" name="alto" id="altox" autocomplete="off" value="<?php if(isset($_GET['idcoti'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required></td>
        <td>Alto Cuerpo Fijo</td>
        <td><input type="text" autocomplete="off" name="cuerpo" id="cuerpox" value="<?php if(isset($_GET['idcoti'])){echo $cuerpo;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>

    </tr>
    <tr>
        <td>Cantidad</td>
        <td><input type="text" name="cant" id="cantx" autocomplete="off" value="<?php if(isset($_GET['idcoti'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
       <td>Ancho Cuerpo Fijo</td>
       <td><input type="text" autocomplete="off" name="ladomm" id="ladommx" value="<?php if(isset($_GET['idcoti'])){echo $ladomm;} ?>" style="width: 70px;"  placeholder="Lado" required></td>

    </tr>
    <tr>
        <td>Medidas Totales con Compuestos</td>
        <td><input type="text" name="ancho_temp" id="ancho_tempx" autocomplete="off" value="<?php if(isset($_GET['idcoti'])){echo $ancho_temp;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required>
            X <input type="text" name="alto_temp" id="alto_tempx" autocomplete="off" value="<?php if(isset($_GET['idcoti'])){echo $alto_temp;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>
<td>Lleva Pelicula ?</td>
        <td>
            <select name="pelicula" id="peliculax">
                <?php if(isset($_GET['idcoti'])){echo "<option value='".$pelicula."'>".$pelicula."</option>";} ?>
                <option value="No Aplica">No Aplica</option>
                <option value="Una Cara">Una Cara</option>
                <option value="Doble Cara">Doble Cara</option>
            </select>
        </td>

    </tr>
    <tr>
        <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
        <td> <input type="text" autocomplete="off" name="ancho_abajo" id="ancho_abajox" value="<?php if(isset($_GET['idcoti'])){echo $aa;} ?>"  style="width: 70px;"  placeholder="Alto en mm" required></td>
        <td>Observaciones adicionales:</td>
        <td><textarea name="obs2" id="obs2x" placeholder="Observacion adicional"><?php if(isset($_GET['idcoti'])){echo $obs2;} ?></textarea></td>

        </td>
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
        <td> <input type="checkbox" name="d1" id="d1xx"  <?php if($d1!='0'){echo 'checked';}  ?> value="1">Automatico <?php echo $d1  ?></td>
        <td></td><td></td>
    </tr>
</table>

<div class="modal-footer">

    <button type="button" id="editar_prod" data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Editar</button>

    <button type="button" id="cancelar" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>

</div>

