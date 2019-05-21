<?php
 require '../modelo/conexion.php';
 if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["tipo"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $fil["ancho"];
        $alto= $fil["alto"];
        $linea= $fil["linea"];
        $altura= $fil["med_adicional"];
        $altura_v_c= $fil["altura_v_c"];
        $ruta= $fil["ruta"];
        $referencia= $fil["referencia_p"];
         $hoja= $fil["hoja"];
 }

?>

<div class="row-fluid">

                        <!-- START Form Wizard -->

                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['ref'])){echo '../modelo/producto.php?editar='.$_GET['ref'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <header><h4 class="title"><?php if(isset($_GET['ref'])){echo 'Editar Producto';}else{echo 'Crear Producto';} ?></h4></header>

                            <section class="body">

                                <div class="body-inner">
                                    <fieldset style="width:95%; float:center; margin-right: 3%;margin-left: 3%; margin-bottom: 3%;margin-top: 3%;">
                                        <center>   <table>
<tr>
<td rowspan="5"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Subir Imagene</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;"><img src="<?php if(isset($_GET['ref'])){if($ruta==''){echo '../producto/no.jpg';}else{echo '../producto/'.$ruta;}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span><span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['ref'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></td>
<td>Linea</td>
<td><select name="tipo_p"  required id="linea_p">
                                                    <?php if(isset($_GET['ref'])){echo "<option value='".$linea."'>".$linea."</option>";} ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `lineas` where linea='Fachada'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         

                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
<td></td>
<td><input type="hidden" name="tipo_v" value="<?php if(isset($_GET['ref'])){echo $tipo_v;}else{echo '1';} ?>"  class="span10" placeholder="Digite el porcentaje de ganacia" readonly></td>
</tr>
<tr>
<td>Codigo del Producto</td>
<td><input type="text"  name="codigo" value="<?php if(isset($_GET['ref'])){echo $codigo;} ?>" class="span6" placeholder="Digite el codigo o referencia del producto" required></td>
<td></td>
<td><input type="hidden" name="ancho"  value="<?php if(isset($_GET['ref'])){echo $ancho;}else{echo "1000";} ?>"  placeholder=" " required class="span10"></td>
</tr>
<tr>
    
<td>Nombre del Producto</td>
<td><input type="text"  name="producto" title="<?php if(isset($_GET['ref'])){echo $producto;} ?>" value="<?php if(isset($_GET['ref'])){echo $producto;} ?>"  placeholder=" " required></td>
<td></td>
<td><input type="hidden" name="alto"  value="<?php if(isset($_GET['ref'])){echo $alto;}else{echo "1000";} ?>"  placeholder=" " required class="span10"> </td>
</tr>
<tr>
    <td>Referencia</td>
    <td><input type="text"  name="referencia" value="<?php if(isset($_GET['ref'])){echo $referencia;} ?>"  placeholder="" required></td>
    <td></td>
    <td></td>
</tr>
<!--<tr <?php if(isset($_GET['ref'])){  }else{echo 'id="resultado"';} ?> bgcolor= "#00FFFF">
<?php  if(isset($_GET['ref']) && $linea=='Aluminio'){  ?>
<td>Altura Cuerpo Fijo ó de la Rejilla  (mm)</td>
<td><input type="text" name="altura"  style="width:20%;"   value="<?php if(isset($_GET['ref'])){echo $altura;}else{echo '0';} ?>"  required></td>
<td>Altura Ventana Corrediza  (mm)</td>
<td><input type="text" name="altura_v_c"  style="width:20%;"   value="<?php if(isset($_GET['ref'])){echo $altura_v_c;} ?>" readonly> # Hojas: <input type="text" style="width:20%;" name="hoja"  value="<?php if(isset($_GET['ref'])){echo $hoja;} ?>" ></td>
<?php  } ?>
</tr>-->
                                            </table></center><br>

                                        <a href="<?php echo '../vistas/?id=new_cot&cot='.$_GET['ped'].'&cli='.$_GET['cli'].''; ?>"><button type="button" class="btn">Regresar</button></a></fieldset>

                                    
                                </div>
                                  
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>

 <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Reparto de la fachada</h4>

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


                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab3">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php

$request_ac=mysql_query("SELECT * FROM item_fachada a, referencias b, item_fachada_c c where c.id_fac=a.id_f and a.id_ref=b.id_referencia and id_producto=".$_GET['ref']." and id_cot=".$_GET['cot']."");
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Items'.'</th>';             
              $table = $table.'<th width="10%">'.'Grupo'.'</th>';
              $table = $table.'<th width="60%">'.'Descripicion de Concepto'.'</th>'; 
               $table = $table.'<th>Cantidad</th>';
                $table = $table.'<th>Valor Total</th>';
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
    
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $cont=0;
        $gtotal =0;
	while($row=mysql_fetch_array($request_ac))
	{     
            $cont = $cont + 1;
            $gtotal = $gtotal + $row["costo_g"];
             $table = $table.'<form  action="../vistas/?id=ver_fac&ref='.$_GET['ref'].'&cot='.$_GET['cot'].'&add1='.$row["id_c1"].'&cli='.$_GET["cli"].'&ped='.$_GET["ped"].'" method="post" id="" enctype="multipart/form-data">';
                       
          
 
            $table = $table.'<tr><td width="10%">'.$cont.'</td>
                <td width="10%">'.$row['grupo'].'</td>
                    <td width="60%">'.$row['descripcion'].'</td>
                        <td><input type="text" name="cant1" value="'.$row["cantidad_g"].'" style="width:40px; height:10px;"></td>
                        <td><input type="text" name="vt1" value="'.$row["costo_g"].'" style="width:60px; height:10px;" readonly></td>
                        <td><button type="submit" style="height:22px;"><img src="../imagenes/modificar.png"></button></td><td> <a href="../vistas/?id=ver_fac&ref='.$_GET['ref'].'&ver='.$row["id_f"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'&ped='.$_GET["ped"].'"><img src="../imagenes/ojo.png"></a></td>
                            </tr>';   
          
           
       $table = $table.'</form>';
         
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->
 <h4 align="right"  style="background-color:yellow;"><?php  echo 'Gran Total:'.  number_format($gtotal); ?></h4>
                                    </div>                 
  

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
 <?php 
 if(isset($_GET['ver'])){ 
                                        
$sql="SELECT * FROM item_fachada a, referencias b, item_fachada_c c where a.id_f=c.id_fac and a.id_ref=b.id_referencia and a.id_f=".$_GET['ver']." and id_producto=".$_GET['ref'];
$fil =mysql_fetch_array(mysql_query($sql));

$producto= $fil["descripcion"];
$cantidad_g= $fil["cantidad_g"];
                                        
                                        ?>
<!--Modulo de reparto de fachada -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Detalles del       <i>"(<?php echo $producto ?>)"</i></h4>

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

                                

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab14">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 


$request_ac=mysql_query("SELECT * FROM item_fachada_rep a, referencias b, item_fachada_c1 c  where c.id_c1=a.id_fr and  b.id_referencia=a.id_referencia and a.id_ver=".$_GET['ver']."  and id_cot=".$_GET['cot']."");
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th width="5%">Items</th>';
              $table = $table.'<th width="5%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Cant.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo Und'.'</th>';
                $table = $table.'<th width="10%">'.'Tipo'.'</th>';
                 $table = $table.'<th>Cantidad</th>';
                 $table = $table.'<th>C. Total</th>';
                 $table = $table.'<th>Valor Total</th>';
               $table = $table.'<th></th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $to2=0;
        $t1 =0;
	while($row=mysql_fetch_array($request_ac))
	{    $to2= $to2 + 1;   
        $table = $table.'<form  action="../vistas/?id=ver_fac&ref='.$_GET['ref'].'&cot='.$_GET['cot'].'&add2='.$row["id_fr"].'&ver='.$_GET['ver'].'&cli='.$_GET["cli"].'&ped='.$_GET["ped"].'" method="post" id="" enctype="multipart/form-data">';
                    if($row["tipo"]=='Estatico'){$ca = $row["cant"]; $read = 'readonly';}else{$ca = $row["cantidad_1"];$read = '';}
                $t = $cantidad_g * $ca * $row["cant"];
                $cs = $t * $row["valor"];
                $t1 = $t1 + $cs;
                 
            $table = $table.'<tr><td width="5%">'.$to2.'</a></td><td width="5%">'.$row['referencia'].'</font></td><td width="40%">'.$row['descripcion'].'</font></td><td width="5%"> '.$row["cant"].' '.$row["unidad"].'</td>
                <td width="10%"> '.$row["valor"].'</td><td width="10%"> '.$row["tipo"].'</td>
                    <td><input type="text" name="cant2" value="'.$ca.'" style="width:40px; height:10px;" '.$read.'></td>
                    <td><input type="text" name="ctotal2" value="'.$t.'" style="width:40px; height:10px;" readonly></td>
                    <td><input type="text" name="t2" value="'.$cs.'" style="width:60px; height:10px;" readonly></td>
                        <td><button type="submit" style="height:22px;"><img src="../imagenes/modificar.png"></button></td>
                           </tr>';   
           
		  $table = $table.'</form>';  
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }
  
 ?>
                                </div>

                            </section>

                        </div>
                        <h4 align="right"><?php  echo 'SubTotal:'.$t1; ?></h4>
                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>


                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div> 
                               
                               <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Detalles del <i>"(<?php echo $producto ?>)"</i></h4>

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

                                

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 


$request_ac=mysql_query("SELECT * FROM item_fachada_vid a, tipo_vidrio b, item_fachada_c2 c  where a.id_fr=c.id_c1 and b.id_vidrio=a.id_referencia and a.id_ver=".$_GET['ver']."  and id_cot=".$_GET['cot']."");
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th width="5%">Items</th>';
              $table = $table.'<th width="5%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Cant.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo Und'.'</th>';
                $table = $table.'<th width="10%">'.'Tipo'.'</th>';
                 $table = $table.'<th>Cantidad</th>';
                 $table = $table.'<th>C. Total</th>';
                 $table = $table.'<th>Valor Total</th>';
               $table = $table.'<th></th>';
               
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $to2=0;
        $t2=0;
	while($row=mysql_fetch_array($request_ac))
	{    
            $table = $table.'<form  action="../vistas/?id=ver_fac&ref='.$_GET['ref'].'&cot='.$_GET['cot'].'&add3='.$row["id_fr"].'&ver='.$_GET['ver'].'&cli='.$_GET["cli"].'&ped='.$_GET["ped"].'" method="post" id="" enctype="multipart/form-data">';
                   if($row["tipo"]=='Estatico'){$ca = $row["cant"]; $read = 'readonly';}else{$ca = $row["cantidad_1"];$read = '';}
        $to2= $to2 + 1;   
        $t = $cantidad_g * $ca * $row["cant"];
                $cs = $t * $row["valor"];
                $t2 = $t2 + $cs;
              
            $table = $table.'<tr><td width="5%">'.$to2.'</a></td><td width="5%">'.$row['referencia_vid'].'</font></td><td width="40%">'.$row['color_v'].'</font></td><td width="5%"> '.$row["cant"].' '.$row["unidad"].'</td>
                <td width="10%"> '.$row["valor"].'</td><td width="10%"> '.$row["tipo"].'</td>
                    <td><input type="text" name="cant3" value="'.$ca.'" style="width:40px; height:10px;" '.$read.'></td>
                    <td><input type="text" name="ctotal3" value="'.$t.'" style="width:40px; height:10px;" readonly></td>
                    <td><input type="text" name="t3" value="'.$cs.'" style="width:60px; height:10px;" readonly></td>
                        <td><button type="submit" style="height:22px;"><img src="../imagenes/modificar.png"></button></td>
                            </tr>';   
           
		 $table = $table.'</form>';  
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }
 ?>
                                </div>

                            </section>

                        </div>
<h4 align="right"><?php 
$g =$t2+$t1;
echo 'SubTotal:'.$t2.'<br>';
echo '_______________________<br>';
echo 'Total por Items: $ '.number_format($g);

?></h4>
                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                          

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div> 
                               <?php } ?>
                               <br><br>
<?php
include '../vistas/form/calcular_fachada.php';

