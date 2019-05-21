<?php
 require '../modelo/conexion.php';
 if(isset($_GET['cod'])){
 $sql='select * from producto where id_p="'.$_GET['cod'].'"';
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

                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/producto_f.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto_f.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Producto';}else{echo 'Crear Producto';} ?></h4></header>

                            <section class="body">

                                <div class="body-inner">
                                    <fieldset style="width:95%; float:center; margin-right: 3%;margin-left: 3%; margin-bottom: 3%;margin-top: 3%;">
                                        <center>   <table>
<tr>
<td rowspan="5"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Subir Imagen</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;"><img src="<?php if(isset($_GET['cod'])){echo '../producto/'.$ruta;} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span><span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['cod'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></td>
<td>Linea</td>
<td><select name="tipo_p"  required id="linea_p">
                                                    <?php if(isset($_GET['cod'])){echo "<option value='".$linea."'>".$linea."</option>";} ?>
                                                                   
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
<td><input type="hidden" name="tipo_v" value="<?php if(isset($_GET['cod'])){echo $tipo_v;}else{echo '1';} ?>"  class="span10" placeholder="Digite el porcentaje de ganacia" readonly></td>
</tr>
<tr>
<td>Codigo del Producto</td>
<td><input type="text"  name="codigo" value="<?php if(isset($_GET['cod'])){echo $codigo;} ?>" class="span6" placeholder="Digite el codigo o referencia del producto" required></td>
<td></td>
<td><input type="hidden" name="ancho"  value="<?php if(isset($_GET['cod'])){echo $ancho;}else{echo "1000";} ?>"  placeholder=" " required class="span10"></td>
</tr>
<tr>
    
<td>Nombre del Producto</td>
<td><input type="text"  name="producto" title="<?php if(isset($_GET['cod'])){echo $producto;} ?>" value="<?php if(isset($_GET['cod'])){echo $producto;} ?>"  placeholder=" " required></td>
<td></td>
<td><input type="hidden" name="alto"  value="<?php if(isset($_GET['cod'])){echo $alto;}else{echo "1000";} ?>"  placeholder=" " required class="span10"> </td>
</tr>
<tr>
    <td>Referencia</td>
    <td><input type="text"  name="referencia" value="<?php if(isset($_GET['cod'])){echo $referencia;} ?>"  placeholder="" required></td>
    <td></td>
    <td></td>
</tr>
<!--<tr <?php if(isset($_GET['cod'])){  }else{echo 'id="resultado"';} ?> bgcolor= "#00FFFF">
<?php  if(isset($_GET['cod']) && $linea=='Aluminio'){  ?>
<td>Altura Cuerpo Fijo ó de la Rejilla  (mm)</td>
<td><input type="text" name="altura"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura;}else{echo '0';} ?>"  required></td>
<td>Altura Ventana Corrediza  (mm)</td>
<td><input type="text" name="altura_v_c"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura_v_c;} ?>" readonly> # Hojas: <input type="text" style="width:20%;" name="hoja"  value="<?php if(isset($_GET['cod'])){echo $hoja;} ?>" ></td>
<?php  } ?>
</tr>-->
                                            </table></center><br><button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <a href="../vistas/?id=add_cot"><button type="button" class="btn">Cancelar</button></a></fieldset>

                                    
                                </div>
                                  
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
  <?php if(isset($_GET['cod'])){  ?>
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

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span> Items</a></li>

                                    <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Items</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab3">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   if(isset($_GET['up_5']))
              {
            $sql='SELECT * FROM item_fachada a, referencias b where a.id_ref=b.id_referencia and id_f="'.$_GET["up_5"].'" and id_producto="'.$_GET["cod"].'"';
$fil =mysql_fetch_array(mysql_query($sql));
$id_ref= $fil["id_ref"];
$descripcion= $fil["descripcion"];
$grupo= $fil["grupo"];


       ?>
                <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/reparto_fac.php?cod='.$_GET['cod'].'&editar='.$_GET['up_5'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Grupo</td>
                                                    <td><select name="grupo"  required id="grupo">
                                                            <?php echo '<option value="'.$grupo.'">'.$grupo.'</option>'; ?>
                                                            
                                                            <option value="Perfileria">Perfileria</option>
                                                            <option value="Vidrieria">Vidrieria</option>
                                                            <option value="Accesorios">Accesorios</option>
                                                 
                                                            <option value="Fachada">Otros Gastos</option>
                                                            
                                                               </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="select2_1" required style="width: 300px;">
                                                                   <?php echo '<option value="'.$id_ref.'">'.$descripcion.'</option>'; ?>
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                     
                                    
                                    <?php
   }else{

$request_ac=mysql_query("SELECT * FROM item_fachada a, referencias b where a.id_ref=b.id_referencia and id_producto=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Items'.'</th>';             
              $table = $table.'<th width="30%">'.'Grupo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripicion de Concepto'.'</th>'; 
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
                $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $cont=0;
	while($row=mysql_fetch_array($request_ac))
	{     
            $cont = $cont + 1;
 
            $table = $table.'<tr><td width="10%">'.$cont.'</td>
                <td width="30%">'.$row['grupo'].'</td>
                    <td width="40%">'.$row['descripcion'].'</td>
                        <td><a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&up_5='.$row["id_f"].'"><img src="../imagenes/modificar.png"></a> </td><td> <a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&ver='.$row["id_f"].'"><img src="../imagenes/ojo.png"></a></td>
                            <td> <a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&del_4='.$row["id_f"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab4">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_fac.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_fac.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Grupo</td>
                                                    <td><select name="grupo"  required id="grupo">
                                                            <option value="">Seleccione el grupo</option>
                                                            <option value="Perfileria">Perfileria</option>
                                                            <option value="Vidrieria">Vidrieria</option>
                                                            <option value="Accesorios">Accesorios</option>
                                                 
                                                            <option value="Fachada">Otros Gastos</option>
                                                            
                                                               </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="select2_1" required style="width: 300px;">
                                                                   <option value="">..Seleccione..</option>
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
  <?php }if(isset($_GET['ver'])){  ?>
<!--Modulo de reparto de fachada -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Detalles del Reparto de la Fachada</h4>

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

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab14" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab15" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab14">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   if(isset($_GET['up'])){
         $sql='SELECT * FROM item_fachada_rep a, referencias b  where b.id_referencia=a.id_referencia and a.id_ver="'.$_GET["ver"].'" and id_fr="'.$_GET["up"].'"';
$fil =mysql_fetch_array(mysql_query($sql));
$id_ref= $fil["id_referencia"];
$descripcion= $fil["descripcion"];
$cant= $fil["cant"];
$unidad= $fil["unidad"];
$valor= $fil["valor"];
$tipo= $fil["tipo"];
$grupo= $fil["grupo"];
       
     ?>
       <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/fachada_rep.php?cod='.$_GET['cod'].'&ver='.$_GET['ver'].'&editar='.$_GET['up'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                           <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Grupo</td>
                                                    <td><select name="grupo"  required id="grupo2">
                                                        
                                                            <?php echo ' <option value="'.$grupo.'">'.$grupo.'</option>'; ?>
                                                            <option value="Perfileria">Perfileria</option>
<!--                                                            <option value="Vidrieria">Vidrieria</option>-->
                                                            <option value="Accesorios">Accesorios</option>
                                                 
                                                            <option value="Fachada">Otros Gastos</option>
                                                            
                                                               </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="select2_2" required style="width: 300px;">
                                                                  <?php echo ' <option value="'.$id_ref.'">'.$descripcion.'</option>'; ?>
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                     <td><input type="text" name="cant" value="<?php echo $cant ?>" style="width: 60px;"></td>
                                                               <td>  Undidad</td>
                                                               <td><select name="unidad"  style="width: 120px;" required> 
                                               
                                         <?php echo ' <option value="'.$unidad.'">'.$unidad.'</option>'; ?>
                                                         
                                                <option value="Und">Unid</option>
                                                <option value="M2">M2</option>
                                                <option value="ML">ML</option>
                                                <option value="Kg">Kg</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Costo $</td>
                                                     <td id="costo"><input type="text" name="costo" value="<?php echo $valor ?>" style="width: 60px;"></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Ver</td>
                                                     <td><select name="tipo"  style="width: 120px;" id="perimetro" required> 
                                                 <?php echo ' <option value="'.$tipo.'">'.$tipo.'</option>'; ?>
                                                <option value="Dinamico">Dinamico</option>
                                       <option value="Estatico">Estatico</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                              
                                    
                                    
   <?php }else{

$request_ac=mysql_query("SELECT * FROM item_fachada_rep a, referencias b  where b.id_referencia=a.id_referencia and a.id_ver=".$_GET['ver']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th width="5%">Items</th>';
              $table = $table.'<th width="5%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Cant.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo'.'</th>';
                $table = $table.'<th width="10%">'.'Tipo'.'</th>';
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $to2=0;
	while($row=mysql_fetch_array($request_ac))
	{    $to2= $to2 + 1;   
        
            $table = $table.'<tr><td width="5%">'.$to2.'</a></td><td width="5%">'.$row['referencia'].'</font></td><td width="40%">'.$row['descripcion'].'</font></td><td width="5%"> '.$row["cant"].' '.$row["unidad"].'</td>
                <td width="10%"> '.$row["valor"].'</td><td width="10%"> '.$row["tipo"].'</td>
                        <td><a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&up='.$row["id_fr"].'&ver='.$_GET['ver'].'"><img src="../imagenes/modificar.png"></a></font></td>
                            <td><a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&del_3='.$row["id_fr"].'&ver='.$_GET['ver'].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab15">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/fachada_rep.php?cod='.$_GET['cod'].'&ver='.$_GET['ver'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                           <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Grupo</td>
                                                    <td><select name="grupo"  required id="grupo2">
                                                            
                                                            <option value="">Seleccione</option>
                                                            <option value="Perfileria">Perfileria</option>
<!--                                                            <option value="Vidrieria">Vidrieria</option>-->
                                                            <option value="Accesorios">Accesorios</option>
                                                 
                                                            <option value="Fachada">Otros Gastos</option>
                                                            
                                                               </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="select2_2" required style="width: 300px;">
                                                                  
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                     <td><input type="text" name="cant" value="1" style="width: 60px;"></td>
                                                               <td>  Undidad</td>
                                                               <td><select name="unidad"  style="width: 120px;" required> 
                                               
                                         
                                                <option value="Und">Unid</option>
                                                <option value="M2">M2</option>
                                                <option value="ML">ML</option>
                                                <option value="Kg">Kg</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Costo $</td>
                                                     <td id="costo"><input type="text" name="costo" value="" style="width: 60px;"></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Ver</td>
                                                     <td><select name="tipo"  style="width: 120px;" id="perimetro" required> 
                                                
                                                <option value="Dinamico">Dinamico</option>
                                       <option value="Estatico">Estatico</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
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

                                <h4 class="title">Detalles del Reparto de Vidrio de la Fachada</h4>

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

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span> Items</a></li>

                                    <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Items</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   if(isset($_GET['up_1'])){
         $sql='SELECT * FROM item_fachada_vid a, tipo_vidrio b  where b.id_vidrio=a.id_referencia and a.id_ver="'.$_GET["ver"].'" and id_fr="'.$_GET["up_1"].'"';
$fil =mysql_fetch_array(mysql_query($sql));
$id_ref= $fil["id_vidrio"];
$descripcion= $fil["color_v"];
$cant= $fil["cant"];
$unidad= $fil["unidad"];
$valor= $fil["valor"];
$tipo= $fil["tipo"];

       
     ?>
       <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/fachada_vid.php?cod='.$_GET['cod'].'&ver='.$_GET['ver'].'&editar='.$_GET['up_1'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                           <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="select2_2" required style="width: 300px;">
                                                                  <?php echo ' <option value="'.$id_ref.'">'.$descripcion.'</option>'; ?>
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                     <td><input type="text" name="cant" value="<?php echo $cant ?>" style="width: 60px;"></td>
                                                               <td>  Undidad</td>
                                                               <td><select name="unidad"  style="width: 120px;" required> 
                                               
                                         <?php echo ' <option value="'.$unidad.'">'.$unidad.'</option>'; ?>
                                                         
                                                <option value="Und">Unid</option>
                                                <option value="M2">M2</option>
                                                <option value="ML">ML</option>
                                                <option value="Kg">Kg</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Costo $</td>
                                                     <td id="costo"><input type="text" name="costo" value="<?php echo $valor ?>" style="width: 60px;"></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Ver</td>
                                                     <td><select name="tipo"  style="width: 120px;" id="perimetro" required> 
                                                 <?php echo ' <option value="'.$tipo.'">'.$tipo.'</option>'; ?>
                                                <option value="Dinamico">Dinamico</option>
                                       <option value="Estatico">Estatico</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                              
                                    
                                    
   <?php }else{

$request_ac=mysql_query("SELECT * FROM item_fachada_vid a, tipo_vidrio b  where b.id_vidrio=a.id_referencia and a.id_ver=".$_GET['ver']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th width="5%">Items</th>';
              $table = $table.'<th width="5%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Cant.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo'.'</th>';
                $table = $table.'<th width="10%">'.'Tipo'.'</th>';
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $to2=0;
	while($row=mysql_fetch_array($request_ac))
	{    $to2= $to2 + 1;   
        
            $table = $table.'<tr><td width="5%">'.$to2.'</a></td><td width="5%">'.$row['referencia_vid'].'</font></td><td width="40%">'.$row['color_v'].'</font></td><td width="5%"> '.$row["cant"].' '.$row["unidad"].'</td>
                <td width="10%"> '.$row["valor"].'</td><td width="10%"> '.$row["tipo"].'</td>
                        <td><a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&up_1='.$row["id_fr"].'&ver='.$_GET['ver'].'"><img src="../imagenes/modificar.png"></a></font></td>
                            <td><a href="../vistas/?id=add_fac&cod='.$_GET['cod'].'&del='.$row["id_fr"].'&ver='.$_GET['ver'].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
   }}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/fachada_vid.php?cod='.$_GET['cod'].'&ver='.$_GET['ver'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                           <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                               
                                                <tr>
                                                    <td>Digite el Nombre del Producto</td>
                                                     <td>  <select  name="producto"  id="vidrio" required style="width: 300px;">
                                                                  <?php
                                                                  echo"<option value=''>Seleccione el Vidrio</option>";
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `tipo_vidrio`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_vidrio'];
                                                            $valor2=$fila['color_v'];
                                                           
                                                           

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                         
                                                               </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                     <td><input type="text" name="cant" value="1" style="width: 60px;"></td>
                                                               <td>  Undidad</td>
                                                               <td><select name="unidad"  style="width: 120px;" required> 
                                               <option value="M2">M2</option>
                                                </select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Costo $</td>
                                                     <td id="costov"><input type="text" name="costo" value="" style="width: 60px;"></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Ver</td>
                                                     <td><select name="tipo"  style="width: 120px;" id="perimetro" required> 
                                                
                                                <option value="Dinamico">Dinamico</option>
                                       <option value="Estatico">Estatico</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                               <td></td>
                                                               <td></td>
                                                        
                                                </tr>
                                              
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
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
<!--Fin Modulo de Accesorio -->


                                    <?php 
if(isset($_GET['del_4'])){
$sql = "DELETE FROM item_fachada WHERE id_f=".$_GET['del_4']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fac&cod=".$_GET['cod']."'";
echo "</script>";
}

if(isset($_GET['del_3'])){
$sql = "DELETE FROM item_fachada_rep WHERE id_fr=".$_GET['del_3']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fac&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del'])){
$sql = "DELETE FROM item_fachada_vid WHERE id_fr=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fac&cod=".$_GET['cod']."'";
echo "</script>";
}
