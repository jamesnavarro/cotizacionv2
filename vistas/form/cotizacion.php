<?php
 require '../modelo/conexion.php';

  if(isset($_GET['cot'])){
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
        
 }
 if(isset($_GET['ok'])){

     include '../modelo/conexion.php'; 
 $sql = "UPDATE `cotizaciones` SET `aprobado` = '1' WHERE `id_cot` = ".$_GET['cot']."";
 mysqli_query($conexion,$sql);

echo '<script lanquage="javascript">alert("Se ha aprobado la cotizacion");location.href="../vistas/?id=new_cot&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 

}

 if(isset($_GET['ped'])){
 
            
            $sql = "SELECT * FROM cotizacion where id_cot=".$_GET['cot']."";
            $fila2 =mysqli_fetch_array(mysqli_query($conexion,$sql));
            $estado= $fila2["estado"];
            $orden= $fila2["orden"];
            $ubicacion= $fila2["ubicacion"];
            $obra= $fila2["obra"];
            $id_cliente= $fila2["id_cliente"];
            $asesor= $fila2["registrado"];
            $responsable= $fila2["responsable"];
            $tel_obra= $fila2["tel_responsable"];
            $ciudad_obra= $fila2["ciudad"];
            
            if($estado!="Ordenado"){
                include '../modelo/conexion.php';
                $sql210 = "SELECT max(orden) FROM cotizacion";
                $fila210 =mysqli_fetch_array(mysqli_query($conexion,$sql210));
                $op= $fila210["max(orden)"] + 1;
                $sql8 = "UPDATE `cotizacion` SET `estado` = 'Ordenado', orden=".$op." WHERE `id_cot` = ".$_GET['cot']."";
                mysqli_query($conexion,$sql8);
                
                $f1 = date("Y-m-d");
                $fi = date("Y-m-d");
                $ff = date("Y-m-d");
                
                
                $sqlo = "INSERT INTO `orden_produccion`(`sede_op`,`proyecto`, `numero`, `fecha_registro`, `fecha_i`, `fecha_f`, `id_cliente`, `estado_o`)";
                $sqlo.= "VALUES ('Vidrio','".$obra."', '".$op."', '".$f1."', '".$fi."', '".$ff."', '".$id_cliente."', 'En proceso')";
                mysqli_query($conexion,$sqlo);
                
            }
        
            
            $sqlx = "SELECT * FROM cotizacion a, clientes b where a.id_cliente=b.id_cli and a.id_cot=".$_GET['cot'];
            $filax =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $orden_px= $filax["orden"];
            
             $sql21 = "SELECT max(num_pedido) FROM cotizaciones where id_cot=".$_GET['cot'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $p= $fila21["max(num_pedido)"] + 1;
 
 $sql = "UPDATE `cotizaciones` SET `estado_c` = 'Pedido', num_pedido=".$p.", orden=".$orden_px." WHERE `id_cot` = ".$_GET['cot']."";
 mysqli_query($conexion,$sql);
 
  

echo '<script lanquage="javascript">alert("Se ha generado el pedido");location.href="../vistas/?id=new_cot&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 

}

 if(isset($_GET['up'])){
 $sql21 = "SELECT * FROM cotizaciones a, producto b where a.id_referencia=b.id_p and  a.id_cotizacion=".$_GET['up'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
            $id_cot= $fila21["id_cot"];
            $id_referencia= $fila21["id_referencia"];
            $id_vidrio= $fila21["id_vidrio"];
            $cierre= $fila21["cierre"];
            $ancho_c= $fila21["ancho_c"];
            $alto_c= $fila21["alto_c"];
      
       
        
 }
 ?>
<script language='javascript'>
function cliente()
{
catPaises = window.open('../vistas/form_cliente.php', 'contacto', 'width=500,height=600');
}
function enfermedad()
{
catPaises = window.open('../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');
}

</script>
<script language="javascript" type="text/javascript">
function dato(val7, val8, val5, val6, val9, val10, val11, val12){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
     document.getElementById('valor5').value = val5;
    document.getElementById('valor6').value = val6;
    document.getElementById('valor9').value = val9;
    document.getElementById('valor10').value = val10;
    document.getElementById('valor11').value = val11;
    document.getElementById('valor12').value = val12;
}

</script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                            <section class="body">
                                
                                
                                <div class="control-group">
                                     <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../vistas/?id=new_cot&consultar'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                                         <header><h4 class="title"><?php if(isset($_GET['cot'])){if($orden_p!=0){echo 'ORDEN No. '.$orden_p;}else{if(isset($_GET['cot'])){echo 'Cotizacion No.'. $_GET['cot'];}else{echo 'Generar Cotizacion de Producto';} }}else{echo 'Generar Cotizacion de Producto';} ?></h4></header>
                                         
                                         <div class="body-inner">
                                             
                                    <fieldset style="width:95%; float:center; margin: 2% 2% 2% 2%;">
                                       <br> 
                                       <table align="center">
                                       <tr>
                                       <td colspan="4" align="center"  bgcolor= "#C9EAB5" >Informacion del Cliente</td>
                                       </tr>
                                      <tr>
                                      <td>Nombre del Cliente:</td>
                                      <td><select  name="id_cli"  id="select2_3" required>
                                                        <option value="">..Seleccione el cliente..</option>
                                                         <?php
                                                           require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `clientes`";                     
                                                           $result=  mysqli_query($conexion,$consulta);
                                                           while($fila=  mysqli_fetch_array($result)){
                                                           $valor1=$fila['id_cli'];
                                                           $valor2=$fila['nombre_cli'];
                                                           $valor3=$fila['cedu_nit'];
                                                           echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                           }
                                                           ?>
                                                           </select>
</td>
<td>Cedula / Nit.</td>
<td  id="cedula"><input type="text" name="cedu"  <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?>   value="<?php  if(isset($_GET['cot'])){echo $nit;}  ?>"></td>
</tr>

<tr>
<td>Direccion del cliente:</td>
<td id='direccion'><input type="text" name="dir" id="valor6" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?>  value="<?php  if(isset($_GET['cot'])){echo $dir;}  ?>"></td>
<td>Telefono :</td>
<td id='telefono'><input type="text" name="tel" id="valor5" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $tel;}  ?>"></td>
</tr>
<tr>
    <td>Nombre del Contacto:</td>
    <td id='contacto'><input type="text" name="contacto" id="valor11" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $contacto;}  ?>"></td>
    <td>Telefono del Contacto:</td>
    <td id='tel_cont'><input type="text" name="te" id="valor12" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $tc;}  ?>"></td>
</tr>
<tr>
    <td>Correo Electronico </td>
    <td id='email'><input type="text" name="email" id="valor9" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $email;}  ?>"></td>
    <td bgcolor="yellow">Cotizacion No.</td>
    <td bgcolor="yellow"><?php if(isset($_GET['cot'])){echo $_GET['cot']; } ?></td>
</tr>
<tr>
    <td colspan="4" align="center"  bgcolor= "#C9EAB5" >Informacion de la Obra</td>
</tr>
<tr>
    <td>Nombre de la obra:</td>
    <td><input type="text" name="obra" id="valor6" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?>  value="<?php  if(isset($_GET['cot'])){echo $obra;}  ?>"></td>
    <td>Telefono:</td>
    <td><input type="text" name="tel_o"  <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $tel_responsable;}  ?>"></td>
</tr>
<tr>
    <td>ubicacion de la obra:</td>
    <td><input type="text" name="ubicacion" id="valor5" <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $ubicacion;}  ?>"></td>
    <td>Ciudad: </td>
    <td><input type="text" name="ciudad_obra"  <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $ciudad;}  ?>"></td>
</tr>
<tr>
    <td>Encargado de la Obra:</td>
    <td><input type="text" name="encargado"  <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $responsable;}  ?>"></td>
    <td>Asesor: </td>
    <td><input type="text" name="asesor"  <?php  if(isset($_GET['cot'])){echo 'readonly';}  ?> value="<?php  if(isset($_GET['cot'])){echo $asesor;}else{echo $_SESSION['k_username'];}  ?>"></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td> <?php if(isset($_GET['cot'])){echo '<a href="../vistas/?id=new_cot"><button type="button" class="btn">Nueva Cotizacion</button></a>';}else{echo '<button type="submit" class="btn btn-primary">Generar Cotizacion</button>';} ?>
</td>
<tr>
</table>
                                       
                                       </fieldset>
                                  
                                       
                                           
                                    <!-- Form Action -->

                                    
                                     </form><br>
                                    <?php
                                    if(isset($_GET['consultar'])){
                                            $sql = "INSERT INTO `cotizacion` (`instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`id_cliente`, `registrado`, `estado`, `obra`, `ubicacion`, `linea`)";
                                            $sql.= "VALUES ('Si','p1','No','".$_POST['encargado']."','".$_POST['tel_o']."','".$_POST['ciudad_obra']."','".$_POST['id_cli']."', '".$_SESSION['k_username']."', 'Cotizado', '".$_POST['obra']."', '".$_POST['ubicacion']."', 'Aluminio')";
                                            mysqli_query($conexion,$sql);

                                            $status = "ok";

                                            $sql21 = "SELECT max(id_cot) FROM cotizacion";
                                            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
                                            $max= $fila21["max(id_cot)"];
                                            
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=new_cot&cot=".$max."&cli=".$_POST['id_cli']."'";
echo "</script>";

                                    }
                           if(isset($_GET['cot'])){         ?>
                                
                                
                           <?php } ?> 
                                     

                            </section>

                        

                        <!--/ END Form Wizard -->

                    </div>
                      <?php if(isset($_GET['consultar'])){ ?>          
                              <?php

 require '../modelo/conexion.php';

 if(isset($_GET['consultar']) || isset($_GET['cod'])){

 $sql='select * from producto where id_p="'.$_POST["ref"].'"';

 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["tipo"];
        $codigo= $fil["codigo"];
        $variable= $fil["tipo_vidrio"];
        $color_v= $fil["color_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $fil["ancho"];
        $alto= $fil["alto"];

 }

 ?>
<?php } ?>
                               
          

 <div class="control-group">
<!--                                        <div class="alert">
                                            <button type="button" class="close" data-dismiss="alert">Ã—</button>
                                       
<?php
if(isset($_GET['consultar'])){
$total = $ta + $tv + $tac;
echo "El valor total de los insumos son: $".number_format($total);

} 
if(isset($_GET['del'])){
 $sql = "DELETE FROM cotizaciones WHERE id_cotizacion=".$_GET['del']."";
 mysqli_query($conexion,$sql);
 echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=new_cot&cot=".$_GET['cot']."&cli=".$_GET['cli']."'";
echo "</script>";
}

?> 
                                               </div>-->
                                    </div>
     <?php if(isset($_GET['cot'])){ 
     
          include '../vistas/form/generar_orden_cot.php'; 
     include '../vistas/form/generar_orden.php'; }
?> 
                                