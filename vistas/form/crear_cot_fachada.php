<?php
 require '../modelo/conexion.php';
 if(isset($_GET['cod'])){
 $sql='select * from producto where id_p="'.$_GET['cod'].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
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

                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/producto_f_1.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto_f_1.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

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
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
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
<td>Ancho</td>
<td><input type="text" name="ancho"  value="<?php if(isset($_GET['cod'])){echo $ancho;}else{echo "1000";} ?>"  placeholder=" " required class="span10"> (mm)</td>
</tr>
<tr>
    
<td>Nombre del Producto</td>
<td><input type="text"  name="producto" title="<?php if(isset($_GET['cod'])){echo $producto;} ?>" value="<?php if(isset($_GET['cod'])){echo $producto;} ?>"  placeholder=" " required></td>
<td>Alto</td>
<td><input type="text" name="alto"  value="<?php if(isset($_GET['cod'])){echo $alto;}else{echo "1000";} ?>"  placeholder=" " required class="span10"> (mm)</td>
</tr>
<tr>
    <td>Referencia</td>
    <td><input type="text"  name="referencia" value="<?php if(isset($_GET['cod'])){echo $referencia;} ?>"  placeholder="" required></td>
    <td></td>
    <td></td>
</tr>
<tr <?php if(isset($_GET['cod'])){  }else{echo 'id="resultado"';} ?> bgcolor= "#00FFFF">
<?php  if(isset($_GET['cod']) && $linea=='Aluminio'){  ?>
<td>Altura Cuerpo Fijo ó de la Rejilla  (mm)</td>
<td><input type="text" name="altura"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura;}else{echo '0';} ?>"  required></td>
<td>Altura Ventana Corrediza  (mm)</td>
<td><input type="text" name="altura_v_c"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura_v_c;} ?>" readonly> # Hojas: <input type="text" style="width:20%;" name="hoja"  value="<?php if(isset($_GET['cod'])){echo $hoja;} ?>" ></td>
<?php  } ?>
</tr>
                                            </table></center><br><button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button>

                                        <a href="../vistas/?id=add_cot"><button type="button" class="btn">Cancelar</button></a></fieldset>

                                    
                                </div>
                                  
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                      <?php if(isset($_GET['cod'])){
                          if($linea!='Vidrio'){
                          ?>    
<!--Modulo de Perfiles-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Reparto de Aluminio</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse2" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Perfiles</a></li>

                                    <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Perfil</a></li>

                                  

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
    
    $sql='select * from producto_rep_alu a, referencias b where a.id_ref_alum=b.id_referencia and a.id_r_a="'.$_GET["up_1"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_a= $fil["id_referencia"];
$codigo_a= $fil["codigo"];
$referencia_a= $fil["referencia"];
$desc= $fil["descripcion"];
$lado= $fil["lado"];
$descuento= $fil["descuento"];
$cantidad= $fil["cantidad"];
$signo= $fil["signo"];
$var= $fil["variable"];
$check= $fil["medida_r_a"];
if($lado=='Vertical'){
    $m = 'Alto';
}else{
    $m = 'Ancho';
}
    ?>
<!--form for edit-->

              <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_1'])){echo '../modelo/reparto_a.php?id_p='.$_GET['cod'].'&editar='.$_GET['up_1'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
 <section class="body">

                              
                                <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
                                    
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Codigo del Perfil</td>
                                                    <td><select  name="ref" id="select2_1">
                                                   
                                                                   
                                                                   <?php if(isset($_GET['up_1'])){echo '<option value="'.$id_r_a.'">'.$codigo_a.'</option>';}
                                                                       require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `referencias` where grupo='Perfileria'";                    
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valorxx=$fila['id_referencia'];
                                                            $valor1=$fila['codigo'];
                                                     
                                                           
                                                            

                                                            echo"<option value=".$valorxx.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                                    <td><span class="label label-info">Montura adicional (Cuerpo Fijo)</span></td>
                                                    <td> (Medidas del Producto : <?php echo 'Alto :'.$alto. ' Ancho'.$ancho; ?>)</td>
                                                </tr>
                                                <tr>
                                                    <td>Referencia</td>
                                                    <td><select name="descr" id="ref1">
                                                        <?php  echo '<option value="'.$desc.'">'.$desc.'<option>'; ?>
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                    <td>Descripcion</td>
                                                    <td><select name="referecia" id="ref2">
                                                        <?php  echo '<option value="'.$referencia_a.'">'.$referencia_a.'<option>'; ?>
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el lado</td>
                                                    <td><select name="lado" id="lado" class="span6" required> 
                                                 <?php if(isset($_GET['up_1'])){echo '<option value="'.$lado.'">'.$lado.'</option>';}  ?>
                                                <option value="Vertical">Vertical</option> 
                                                <option value="Horizontal">Horizontal</option> 
                                               
                                     
                                                 
                                                  
                                          </select></td>
                                                    <td align="right">Altura Ventana Corrediza</td>
                                                    <td><input type="radio" name="b" <?php if($check=='1'){echo 'checked';} ?> value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (mm)</td>
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_1'])){echo $cantidad;} ?>" class="span6" placeholder="Digite la cantidad de perfil" required></td>
                                                    <td align="right">Altura Cuerpo fijo</td>
                                                    <td><input type="radio" name="b" <?php if($check=='2'){echo 'checked';} ?> value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (mm)</td>
                                                </tr>
                                                <tr>
                                                    <td>Formula para el perfil</td>
                                                    <td> <select name="vc" id="lado_r" style="width: 80px;">
                                              <?php if(isset($_GET['up_1'])){echo '<option value="'.$m.'">'.$m.'</option>';}  ?>
                                             </select>&nbsp;<input type="number"  style="width: 40px;" name="descuento" value="<?php echo $descuento;  ?>"  placeholder="Digite la medidad a restar" required>
                                                <select name="signo" style="width: 40px;">
                                                    <?php if(isset($_GET['up_1'])){echo '<option value="'.$signo.'">'.$signo.'</option>';}  ?>
                                                       <option value="/">/</option>
                                                       <option value="+">+</option>
                                                       <option value="-">-</option>
                                                       <option value="*">*</option>
                                                </select>&nbsp;<input type="number" name="variable" value="<?php echo $var;  ?>" style="width: 40px;"></td>
                                                    <td align="right">Ninguno</td>
                                                    <td><input type="radio" name="b" <?php if($check == '0'){echo 'checked';} ?> value="0">0 (mm)</td>
                                                </tr>
                                            </table>
                                        
                                            
                                                  <label></label><div class="controls"> Digite la formula: por Ej: (Ancho + 7) / 2</div>
                                             

                                               <div class="controls">
                                                   </div>
                                               
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <a href="../vistas/?id=add_cot&cod=<?php echo $_GET['cod'] ?>"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>
                                </fieldset>
                            </section>
                        
                          

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                        
                                    
   
                                    <?php
}else{
if(isset($_GET['cod'])){
    


$request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." order by b.lado, b.id_r_a");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
            $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'cant. perfiles'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
               $table = $table.'<th width="20%">'.'medida.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Precio Total.'.'</th>';

              $table = $table.'<th></th>';
              $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;
	while($row=mysqli_fetch_array($request))
	{    
            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $al = ($altura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']>2){
                        //codigo-------------------------------
                        
                        $al = ($tv+$row["descuento"])+ $row['variable'];
                    }else{
                    
                     if($row['lado']!="Vertical"){
                $al = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($alto+$row["descuento"])+ $row['variable'];
                }}
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $al = ($altura_v_c+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $al = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $al = ($alto+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $al = ($altura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $al = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $al = ($alto+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $al = ($altura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']>2){
                        //codigo-------------------------------
                           require '../modelo/conexion.php';
                         $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=".$row['medida_r_a']." and b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_v2){

        $total2=0;
	while($rowx=mysqli_fetch_array($request_v2))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$rowx["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
            }
            
            $tv1 = $al + $rowx['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$rowx["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
            }else{
                if($fil_al['signo']=='/'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }
            
            $tv2 = $al2 + $rowx['var2'];
          
		
               
	} 
	
        
	
}

                        
                        $al = ($tv1+$row["descuento"])+ $row['variable'];
                    }else{
                       if($row['lado']!="Vertical"){
                $al = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($alto+$row["descuento"])/ $row['variable'];
            }
                }}
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al2 = ($alto+$row["descuento"]);
            }else{
                $al2 = ($ancho+$row["descuento"]);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al2)/$row["medida"];  
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
            $table = $table.'<tr><td width="10%">'.$row['codigo'].'</a></td><td width="40%">'.$row['descripcion'].'</a></td><td width="10%">'.$row['referencia'].'</font></td><td width="10%">'.$row['lado'].'</a></td><td width="10%">'.$row["medida"].' mm<font></a></td>
               <td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td><td width="10%">'.$row["cantidad"].'<font></a></td><td width="20%">'.$al.' mm<font></a></td>
                   <td class="hidden-phone">'.$row["cantidad"].'</font></td><td class="hidden-phone">$'.number_format($al*$row["costo_mt"]/$n).'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_1='.$row["id_r_a"].'">Editar</a></td><td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_1='.$row["id_r_a"].'">Eliminar</a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
} }}
   
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

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_a.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_a.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                              
                                <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
                                    
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Codigo del Perfil</td>
                                                    <td><select  name="ref" id="select2_1">
                                                    <option value=''>Seleccione Perfil...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `referencias` where grupo='Perfileria'";                    
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valorxx=$fila['id_referencia'];
                                                            $valor1=$fila['codigo'];
                                                     
                                                           
                                                            

                                                            echo"<option value=".$valorxx.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                                    <td><span class="label label-info">Montura adicional (Cuerpo Fijo)</span></td>
                                                    <td> (Medidas del Producto : <?php echo 'Alto :'.$alto. ' Ancho'.$ancho; ?>)</td>
                                                </tr>
                                                <tr>
                                                    <td>Referencia</td>
                                                    <td><select name="descr" id="ref1">
                                                        
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                    <td>Descripcion</td>
                                                    <td><select name="referecia" id="ref2">
                                                        
                                                        </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el lado</td>
                                                    <td><select name="lado" id="lado" class="span6" required> 
                                                <option value="">Seleccione.. </option> 
                                                <option value="Vertical">Vertical</option> 
                                                <option value="Horizontal">Horizontal</option> 
                                               
                                     
                                                 
                                                  
                                          </select></td>
                                                    <td align="right">Variable Adicional</td>
                                                    <td><select name="b">
                                                            <option value="0">Ninguno</option> 
                                                            <option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                                                            <option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                                                            <?php
                                                                       require '../modelo/conexion.php';
                                                            $request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_v){

        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
            }
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
            }else{
                if($fil_al['signo']=='/'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }
            
            $tv2 = $al2 + $row['var2'];
            echo"<option value='".$row['id_ref_vid']."'>(".$tv." mm) ".$row['descripcion']."</option>";
		
               
	} 
	
        
	
}

                                                            
                                                            
                                                           
                                                           
                                                            ?>
                                                        </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>Cantidad</td>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la cantidad de perfil" required></td>
                                                    <td align="right"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Formula para el perfil</td>
                                                    <td> <select name="vc" id="lado_r" style="width: 80px;">
                                              
                                             </select>&nbsp;<input type="number"  style="width: 40px;" name="descuento" value="0"  placeholder="Digite la medidad a restar" required>
                                                <select name="signo" style="width: 40px;">
                                                       <option value="/">/</option>
                                                       <option value="+">+</option>
                                                       <option value="-">-</option>
                                                       <option value="*">*</option>
                                                </select>&nbsp;<input type="number" name="variable" value="1" style="width: 40px;"></td>
                                                    <td align="right"></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        
                                            
                                                  <label></label><div class="controls"> Digite la formula: por Ej: (Ancho + 7) / 2</div>
                                             

                                               <div class="controls">
                                                   </div>
                                               
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

                                </div>
                                </fieldset>
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
<!--Fin Modulo de Perfiles--> 

<!--Modulo de Vidrio -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Reparto de vidrios</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse3" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span>Vidrios</a></li>

                                    <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Vidrio</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab5">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
if(isset($_GET['up_2'])){ 
   
     $sql='select * from producto_rep_vid a, referencias b where a.id_ref_vid=b.id_referencia and a.id_r_v="'.$_GET["up_2"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_v= $fil["id_referencia"];
$desc_v= $fil["descripcion"];
$ancho_v= $fil["ancho_v"];
$alto_v= $fil["alto_v"];
$var1= $fil["var1"];
$var2= $fil["var2"];
$seleccionado= $fil["seleccionado"];
$cantidad_v= $fil["cantidad_v"];
  

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_ancho= $fil_an["id_r_a"];
            $descripcion_ancho= $fil_an["descripcion"];
            
            $sqlxa=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$alto_v."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlxa));
            $id_alto= $fil_al["id_r_a"];
            $descripcion_alto= $fil_al["descripcion"];
?>
      <div class="tab-pane" id="tab6">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_2'])){echo '../modelo/reparto_v.php?id_p='.$_GET['cod'].'&editar='.$_GET['up_2'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <fieldset style="width:95%; float:center; margin: 3% 3% 3% 3%;">
                                    <span class="label label-info">Editar Valores de Medidas del Vidrio</span>
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_v" class="span11" required>
                                                                 <?php
                                                            echo"<option value='".$id_r_v."'>".$desc_v."</option>";
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrieria'";                    
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                       
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                         <label></label><div class="controls"> </div>
                                               <label class="control-label">Ancho (mm)</label>

                                            <div class="controls"> <select name="ancho_v" class="span8" required>
                                                                   <?php
                                                                     echo"<option value='".$id_ancho."'>".$descripcion_ancho.")</option>";
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                            
                                                            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al2 = ($alto+$row["descuento"]);
            }else{
                $al2 = ($ancho+$row["descuento"]);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al2)/$row["medida"];
            $formato = number_format($numero,1,',','.');

                                                            echo"<option value='".$valor1_an."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv" value="<?php echo $var1  ?>" style="width: 80px;"></div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span8" required>
                                                                  <?php
                                                                    echo"<option value='".$id_alto."'>".$descripcion_alto.")</option>";
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                            
                                                            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al2 = ($alto+$row["descuento"]);
            }else{
                $al2 = ($ancho+$row["descuento"]);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al2)/$row["medida"];
            $formato = number_format($numero,1,',','.');

                                                            echo"<option value='".$valor1_al."'>".$valor2." (".$alv.")</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv2" value="<?php echo $var2  ?>" style="width: 80px;"></div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php echo $cantidad_v ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                            
                                             
                                           
                                   
Por favor sea lo mas exacto en la medida de la hoja de vidrio de la ventana
                                </div>

                                        <span class="label label-info">Montura adicional del producto</span>
                                        <div class="control-group">
                                              
                                             
                                            <h4><label>Si el Producto tiene una montura adicional seleccione algun valor, sino dejelo en 0</label><div class="controls"> </div>
                                            </h4><div class="controls"> 
                                               Altura Cuerpo fijo <?php echo $altura; ?><input type="radio" <?php if($seleccionado==1){echo 'checked';} ?> name="op1" value="1">
                                            </div>  <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                               Altura Ventana Corrediza <?php echo $altura_v_c; ?><input type="radio" <?php if($seleccionado==2){echo 'checked';} ?> name="op1" value="2">
                                            </div> <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                                Ninguno <input type="radio" checked name="op1" <?php if($seleccionado==0){echo 'checked';} ?> value="0">
                                            </div> 
                                         <label></label><div class="controls"> </div>
                                           <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->
                                   

                                </div>
</fieldset>
                               
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>
                                    <?php
}else{
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_v){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
$table = $table.'<th width="10%">'.'Referencia'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Ancho'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Valor'.'</th>';
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
            }
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
            }else{
                if($fil_al['signo']=='/'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }
            
            $tv2 = $al2 + $row['var2'];
            $table = $table.'<tr><td width="10%">'.$row['codigo'].'</a></td><td width="10%">'.$row['descripcion'].'</font></td><td width="10%">'.$row['referencia'].'</a></td>
               <td class="hidden-phone">'.$tv.'</font></td><td class="hidden-phone">'.$tv2.'</font></td><td class="hidden-phone">'.$row["cantidad_v"].'</font></td><td class="hidden-phone">'.$row["cantidad_v"]*$row["costo_mt"].'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_2='.$row["id_r_v"].'"><img src="../imagenes/modificar.png"></a></td><td>  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_2='.$row["id_r_v"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
}
}
 ?></div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab6">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_v.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_v.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <fieldset style="width:95%; float:center; margin: 3% 3% 3% 3%;">
                                    <center><span class="label label-info">Medidas del Vidrio</span></center>
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_v" class="span11" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrieria'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                          
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                         <label></label><div class="controls"> </div>
                                               <label class="control-label">Ancho (mm)</label>

                                            <div class="controls"> <select name="ancho_v" class="span8" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_an = $row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                            
                                                            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al2 = ($alto+$row["descuento"]);
            }else{
                $al2 = ($ancho+$row["descuento"]);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al2)/$row["medida"];
            $formato = number_format($numero,1,',','.');

                                                            echo"<option value='".$valor1_an."'>(".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv" value="0" style="width: 80px;"></div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span8" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result)){
                                                            $valor1_al=$row['id_r_a'];
                                                            $valor2=$row['descripcion'];
                                                            $valor3=$row['lado'];
                                                            $descuento=$row['descuento'];
                                                            $medida_1=$row['medida_r_a'];
                                                            
                                                            
                                                            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $alv = ($altura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $alv = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al2 = ($alto+$row["descuento"]);
            }else{
                $al2 = ($ancho+$row["descuento"]);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]/$n);
            $numero = ($row["cantidad"]*$al2)/$row["medida"];
            $formato = number_format($numero,1,',','.');

                                                            echo"<option value='".$valor1_al."'> (".$alv." mm) ".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> +/- <input type="number" name="dv2" value="0" style="width: 80px;"></div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                            
                                             
                                           
                                   
Por favor sea lo mas exacto en la medida de la hoja de vidrio de la ventana
                                </div>

                                        <center><span class="label label-info">Montura adicional del producto</span></center>
                                        <div class="control-group">
                                              
                                             
                                            <h4><label>Si el Producto tiene una montura adicional seleccione algun valor, sino dejelo en 0</label><div class="controls"> </div>
                                            </h4><div class="controls"> 
                                               Altura Cuerpo fijo <?php echo $altura; ?><input type="radio" name="op1" value="1">
                                            </div>  <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                               Altura Ventana Corrediza <?php echo $altura_v_c; ?><input type="radio" name="op1" value="2">
                                            </div> <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                                Ninguno <input type="radio" checked name="op1" value="0">
                                            </div> 
                                         <label></label><div class="controls"> </div>
                                         <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->
                                   

                                </div>
</fieldset>
                                
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
<!--Fin Modulo de Vidrio -->
<!--Modulo de regillas -->
                      
<!--Fin Modulo de regillas -->
                          <?php  }  ?>
 <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">LISTADO DE ACCESORIOS PARA FABRICACIÓN E INSTALACION</h4>

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

                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span>Accesorios</a></li>

                                    <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Accesorio</a></li>

                                  

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
   if(isset($_GET['up_5'])){
            $sql='select * from producto_rep_acc a, referencias b where a.id_ref_acc=b.id_referencia and a.id_r_ac="'.$_GET["up_5"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_ac= $fil["id_referencia"];
$desc_ac= $fil["descripcion"];
$ref_ac= $fil["referencia"];
$codigo_ac= $fil["codigo"];
$cantida_ac= $fil["cantidad_acc"];
$color_ac= $fil["color_acc"];
$para= $fil["para"];
$cal_name= $fil["calcular"];
$metro= $fil["metro"];
$yes= $fil["yes"];
$lado= $fil["lado"];
if($cal_name=='ML'){$cal = 'Perimetro ML';}else{if($cal_name=='Und'){$cal = 'Por Unidad';}else{$cal = 'Por Galon';}}
       ?>
                <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/reparto_acc.php?cod='.$_GET['cod'].'&editar='.$_GET['up_5'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Digite el Codigo</td>
                                                     <td>  <select  name="ref_ac"  id="select2_3" required>
                                                                  <?php  echo '<option value="'.$id_r_ac.'">'.$codigo_ac.'</option>'; ?>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Accesorios'  group by codigo";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'];
                                                           

                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                               <td><select name="" id="d"><?php  echo '<option value="'.$id_r_ac.'">'.$desc_ac.'</option>'; ?></select></td>
                                                               <td><select name="" id="e" style="width: 80px;"><?php  echo '<option value="'.$id_r_ac.'">'.$ref_ac.'</option>'; ?></select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el color</td>
                                                     <td><select name="color_acc" class="span6" required> 
                                                             <?php  echo '<option value="'.$color_ac.'">'.$color_ac.'</option>'; ?>
                                                <option value="">Ninguno</option> 
                                                <option value="Natural">Natural</option> 
                                                <option value="Acero">Acero</option> 
                                                <option value="Plastico">Plastico</option> 
                                                <option value="Negro">Negro</option> 
                                                <option value="Gris">Gris</option> 
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td><select name="cal" class="span6" id="perimetro" required> 
                                                <?php  echo '<option value="'.$cal_name.'">'.$cal.'</option>'; ?>
                                         
                                                <option value="Und">Por Unidad</option>
                                                <option value="ML">Perimetro ML</option>
                                                <option value="GL">Galon</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                     <td><input type="text" name="cant_acc" value="<?php if(isset($_GET['up_5'])){echo $cantida_ac; } ?>" class="span6" placeholder=" " required></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" style="width:50px;" value="<?php if(isset($_GET['up_5'])){echo $metro; } ?>" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro?</td>
                                                      <td><div><input type="radio" <?php if($yes =='Si'){echo 'checked'; } ?> name="yes" value="Si" required> Si </div><div><input type="radio" <?php if($yes =='No'){echo 'checked'; } ?> name="yes" value="No"> No</div></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>En el Lado </td>
                                                    <td><select name="lado" style="width:80px;">
                                                            <?php echo '<option value="'.$lado.'">'.$lado.'</option> '; ?>
                                                            <option value="Vertical">Vertical</option>
                                                            <option value="Horizontal">Horizontal</option>
                                                          
                                                        </select> <i>" En este lado se aplicara la formula"</i></td>
                                                      <td></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                  <tr>
                                                    <td>Para :</td>
                                                    <td><select name="para" class="span8" required>
                                                            <?php echo '<option value="'.$para.'">'.$para.'</option> '; ?>
                                                <option value="Fabricacion">Fabricacion</option> 
                                                <option value="Instalacion">Instalacion</option> 

                                          </select></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                           
                                             
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <a href="../vistas/?id=add_cot&cod=<?php echo $_GET['cod'] ?>"> <button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                     
                                    
                                    <?php
   }else{

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>'; 
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Und. Variante'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant x MT'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
               $table = $table.'<th></th>';
               $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{     
            
            if($row['calcular']=='ML'){
               $rs = $hoja * 2 ;
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                $res = $row["cantidad_acc"];
            }
 
            $table = $table.'<tr><td width="10%">'.$row['codigo'].'</td><td width="40%">'.$row['descripcion'].'</td><td width="10%">'.$row['codigo'].'</td><td width="10%">'.$row["color_acc"].'<font></a></td><td width="10%">'.$row["yes"].'<font></a></td>
               <td class="hidden-phone">'.$res.' '.$row["calcular"].'</font></td><td class="hidden-phone">'.$row["para"].'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_5='.$row["id_r_ac"].'"><img src="../imagenes/modificar.png"></a> </td><td> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_4='.$row["id_r_ac"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_acc.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_acc.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Digite el Codigo</td>
                                                     <td>  <select  name="ref_ac"  id="select2_3" required>
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Accesorios'  group by codigo";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'];
                                                           

                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                               <td><select name="" id="d"></select></td>
                                                               <td><select name="" id="e" style="width: 80px;"></select></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el color</td>
                                                     <td><select name="color_acc" class="span6" required> 
                                                <option value="">Ninguno</option> 
                                                <option value="Natural">Natural</option> 
                                                <option value="Acero">Acero</option> 
                                                <option value="Plastico">Plastico</option> 
                                                <option value="Negro">Negro</option> 
                                                <option value="Gris">Gris</option> 
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td><select name="cal" class="span6" id="perimetro" required> 
                                                <option value="">Ninguno</option> 
                                                 <option value="Und">Por Unidad</option>
                                                <option value="ML">Perimetro ML</option>
                                                <option value="GL">Por Galon</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                    <td id="cantidad"><input type="text" name="cant_acc" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                 <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" style="width:50px;" value="1000" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro?</td>
                                                      <td><div><input type="radio" name="yes"  value="Si" required> Si </div><div><input type="radio" name="yes" value="No"> No</div></td>
                                                        
                                                </tr>
                                                 <tr>
                                                    <td>En el Lado </td>
                                                    <td><select name="lado" style="width:80px;">
                                                             <option value="Vertical">Vertical</option>
                                                            <option value="Horizontal">Horizontal</option>
                                                            
                                                        </select> <i>" En este lado se aplicara la formula"</i></td>
                                                      <td></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Para :</td>
                                                    <td><select name="para" class="span8" required> 
                                                            <option value="">Seleccione uno</option>
                                                <option value="Fabricacion">Fabricacion</option> 
                                                <option value="Instalacion">Instalacion</option> 

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
<!--Modulo de Accesorio -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Gastos de maquina</h4>

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
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%"></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_ma'].'</font></td><td width="10%"> '.$row["porcentaje_ma"].' %<font></a></td>
               '
                    . '<td  width="10%">  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_3='.$row["id_rep_ma"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                    </div>

                                    <div class="tab-pane" id="tab15">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_ma.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_ma.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione la maquina</label>
                                            <div class="controls"> 
                                               <select name="ref_ma" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_ma`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ma'];
                                                            $valor2=$fila['descripcion_ma'];
                                                            $valor3=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
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
<!--Fin Modulo de Accesorio -->

<!--Gasto de Maquina-->
                            
<!--Fin Gasto de Maquina-->    

<!--Gasto de mano de obra-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Mano de Obra por Producto</h4>

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

                                    <li class="active"><a href="#tab7" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab8" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab7">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion?'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
               $table = $table.'<th width="10%"></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_mo'].'</font></td><td width="10%"> '.$row["instalacion"].'<font></a></td><td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td  width="10%">  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_5='.$row["id_rep_mo"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                    </div>

                                    <div class="tab-pane" id="tab8">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_mo.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_mo.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione mano de obra</label>
                                            <div class="controls"> 
                                               <select name="ref_mo" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_mo`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_mo'];
                                                            $valor2=$fila['descripcion_mo'];
                                                            $valor3=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
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
<!--Fin Gasto de mano de obra-->

<!--Gasto administrativo-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Gastos Administrativo y Utilidad</h4>

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

                                    <li class="active"><a href="#tab9" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab10" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab9">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%"></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td  width="10%"> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_6='.$row["id_rep_ad"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                    </div>

                                    <div class="tab-pane" id="tab10">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_ad.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_ad.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione mano de obra</label>
                                            <div class="controls"> 
                                               <select name="ref_ad" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_admin`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ad'];
                                                            $valor2=$fila['descripcion_ad'];
                                                            $valor3=$fila['referencia_ad'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
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
<!--Fin Gasto administrativo-->
<!--Otros GASTOS-->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Otros Gastos</h4>

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

                                    <li class="active"><a href="#tab16" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="#tab17" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab16">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor'.'</th>';
               $table = $table.'<th width="10%"></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ot'].'</a></td><td width="10%">'.$row['descripcion_ot'].'</font></td><td width="10%"> '.$row["cantidad_ot"].' Und<font></a></td><td width="10%">$ '.$row["valor_ot"].' <font></a></td>
               <td  width="10%"> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_7='.$row["id_r_ot"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                    </div>

                                    <div class="tab-pane" id="tab17">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_otro.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_otro.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione referencia</label>
                                            <div class="controls"> 
                                               <select name="ref_ot" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_otro`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ot'];
                                                            $valor2=$fila['descripcion_ot'];
                                                            $valor3=$fila['referencia_ot'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                             
                                               <label></label><div class="controls"> </div>
                                               
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
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
<!--Fin Gasto administrativo-->
<?php }
if(isset($_GET['del_1'])){
$sql = "DELETE FROM producto_rep_alu WHERE id_r_a=".$_GET['del_1']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_2'])){
$sql = "DELETE FROM producto_rep_vid WHERE id_r_v=".$_GET['del_2']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_3'])){
$sql = "DELETE FROM producto_rep_ma WHERE id_rep_ma=".$_GET['del_3']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_4'])){
$sql = "DELETE FROM producto_rep_acc WHERE id_r_ac=".$_GET['del_4']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_5'])){
$sql = "DELETE FROM producto_rep_mo WHERE id_rep_mo=".$_GET['del_5']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_6'])){
$sql = "DELETE FROM producto_rep_ad WHERE id_rep_ad=".$_GET['del_6']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_7'])){
$sql = "DELETE FROM producto_rep_otro WHERE id_r_ot=".$_GET['del_7']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}
 if(isset($_GET['del_8'])){
$sql = "DELETE FROM producto_rep_rej WHERE id_r_rej=".$_GET['del_8']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_fachada&cod=".$_GET['cod']."'";
echo "</script>";
}