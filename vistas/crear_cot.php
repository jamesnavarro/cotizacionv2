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
        $anchura_v_c= $fil["ancho_v_c"];
        $anchura= $fil["ancho_adicional"];
        $ruta= $fil["ruta"];$ruta2= $fil["ruta2"];
        $per= $fil["perforacion"];
        $boq= $fil["boquete"];
        $referencia= $fil["referencia_p"];
        $aprobado= $fil["aprobado"];
        $laminas= $fil["laminas"];
         $hoja= $fil["hoja"];$kit= $fil["kit"];
         if($kit==0){$k = 'No';}else{$k= 'Si';}
 }
if(isset($_GET['aprobar'])){
    if($_GET['aprobar']==0){
         $sql = "UPDATE `producto` SET `aprobado`='1' WHERE `id_p` = ".$_GET["cod"].";";
    }else{
         $sql = "UPDATE `producto` SET `aprobado`='0' WHERE `id_p` = ".$_GET["cod"].";";
    }
   mysqli_query($conexion,$sql);
     echo '<script lanquage="javascript">alert("Se ha Modificado la DT");location.href="../vistas/?id=add_cot&cod='.$_GET["cod"].'"</script>'; 

}
?>
<script>
function sel(c){
formu=document.forms['formulario'];
caracteres=c.length;
if(caracteres!=0){
for (x=0;x<formu['ref_mo'].options.length;x++){
if(formu['ref_mo'].options[x].value.slice(0,caracteres)==c){
formu['ref_mo'].selectedIndex=x;
formu['ref_mo'].style.visibility="visible";
break;
}else{
formu['ref_mo'].style.visibility="hidden";
}
}
}else{
formu['ref_mo'].style.visibility="hidden";

}
}
</script>
<?php 
if(isset($_GET['cod'])){
$atras = $_GET['cod']-1;
$next = $_GET['cod']+1;
echo '<a href="../vistas/?id=add_cot&cod='.$atras.'"><img src="../images/a1.png"></a>';
echo '<i>'.$producto.'</i>';
echo '<a href="../vistas/?id=add_cot&cod='.$next.'"><img src="../images/p11.png"></a>';
}
?>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/producto.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                            <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Producto';}else{echo 'Crear Producto';} ?></h4></header>

                            <section class="body">

                                <div class="body-inner">
                                  
                                        <center>   
<table class="table table-bordered table-striped table-hover">
    <tr>
        <td colspan="2">
            <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                <label class="control-label">Diseño Derecha</label>
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                    <img src="<?php if(isset($_GET['cod'])){echo '../producto/'.$ruta;} ?>">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                <span class="btn btn-file">
                    <span class="fileupload-new">Seleccione La Imagen</span>
                    <span class="fileupload-exists">Cambiar</span>
                    <?php if(isset($_GET['cod'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?>
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
            </div>
        </td>
        <td colspan="2">
            <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                <label class="control-label">Diseño Izquierdo</label>
                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                    <img src="<?php if(isset($_GET['cod'])){echo '../producto/'.$ruta2;} ?>">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                <span class="btn btn-file">
                    <span class="fileupload-new">Seleccione La Imagen</span>
                    <span class="fileupload-exists">Cambiar</span>
                    <?php if(isset($_GET['cod'])){echo '<input name="imagen2" type="file" value="'.$ruta2.'" />';}else{echo '<input name="imagen2" type="file" value="" />';} ?>
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
            </div>
        </td>
    </tr>
    <tr>
        <td>Linea</td>
        <td>
            <select name="tipo_p"  required id="linea_p">
                <?php if(isset($_GET['cod'])){echo "<option value='".$linea."'>".$linea."</option>";}else{echo "<option value=''>.:Seleccione la linea:.</option>"; } ?>
                    <?php
                        require '../modelo/conexion.php';
                        $consulta= "SELECT * FROM `lineas`";                     
                        $result=  mysqli_query($conexion,$consulta);
                        while($fila=  mysqli_fetch_array($result)){
                            $valor1=$fila['id_linea'];
                            $valor3=$fila['linea'];
                            echo"<option value='".$valor3."'>".$valor3."</option>";
                        }
                    ?>
            </select>
        </td>
        <td>Estado</td>
        <td>
            <?php 
            if(isset($aprobado)){
            if($_SESSION['k_username']=='admin'){
                
                if($aprobado==0){
                    echo '<button><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/no.png"> Sin Aprobar</a></button>';
                }else{
                    echo '<button><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&aprobar='.$aprobado.'"><img src="../imagenes/ok.png"> Aprobado</a></button>';
                }
            }else{
                if($aprobado==0){
                    echo '<img src="../imagenes/no.png"> Sin Aprobar';
                }else{
                    echo '<img src="../imagenes/ok.png"> Aprobado';
                }
            } } ?>
            <input type="hidden" name="tipo_v" value="<?php if(isset($_GET['cod'])){echo $tipo_v;}else{echo '1';} ?>"  class="span10" placeholder="Digite el porcentaje de ganacia" readonly>
        </td>
    </tr>
    <tr>
        <td>Codigo del Producto</td>
        <td>
            <input type="text"  name="codigo" value="<?php if(isset($_GET['cod'])){echo $codigo;} ?>" class="span6" placeholder="Digite el codigo o referencia del producto" required>
        </td>
        <td>Ancho</td>
        <td>
            <input type="text" name="ancho"  value="<?php if(isset($_GET['cod'])){echo $ancho;}else{echo "1000";} ?>"  placeholder=" " required class="span6"> (mm)
        </td>
    </tr>
<tr>
    
<td>Nombre del Producto</td>
<td><input type="text"  name="producto" title="<?php if(isset($_GET['cod'])){echo $producto;} ?>" value="<?php if(isset($_GET['cod'])){echo $producto;} ?>"  placeholder=" " required></td>
<td>Alto</td>
<td><input type="text" name="alto"  value="<?php if(isset($_GET['cod'])){echo $alto;}else{echo "1000";} ?>"  placeholder=" " required class="span6"> (mm)</td>
</tr>
<tr>
    <td>Referencia</td>
    <td><input type="text"  name="referencia" value="<?php if(isset($_GET['cod'])){echo $referencia;} ?>"  placeholder="" required></td>
    <td>Es un Kit?</td>
    <td><select name="kit" style="width:60px">
            <?php  if(isset($_GET['cod'])){ echo"<option value='".$kit."'>".$k."</option>";}  ?>
            <option value="0">No</option><option value="1">Si</option>
        </select></td>
</tr>
<tr>
    <td>Perforaciones</td>
    <td><input type="text"  name="per" value="<?php if(isset($_GET['cod'])){echo $per;} ?>"  placeholder=""  class="span4"></td>
    <td>Boquetes</td>
    <td><input type="text"  name="boq" value="<?php if(isset($_GET['cod'])){echo $boq;} ?>"  placeholder=""  class="span4"></td>
</tr>
<tr <?php if(isset($_GET['cod'])){  }else{echo 'id="resultado"';} ?>>
<?php  if(isset($_GET['cod'])){  ?>
<td>Altura Cuerpo Fijo ó de la Rejilla  (mm)</td>
<td><input type="text" name="altura"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $altura;}else{echo '0';} ?>"  required>  </td>
<td>Altura Ventana Corrediza  (mm)</td>
<td><input type="text" name="altura_v_c"  style="width:20%;" readonly  value="<?php if(isset($_GET['cod'])){echo $altura_v_c;} ?>" > # Modulos: <input type="text" style="width:20%;" name="hoja"  value="<?php if(isset($_GET['cod'])){echo $hoja;} ?>" ></td>
<?php  } ?>
</tr>
<tr>
<?php  if(isset($_GET['cod'])){  ?>
<td>Ancho C.F </td>
<td><input type="text" name="anchura"  style="width:20%;"   value="<?php if(isset($_GET['cod'])){echo $anchura;}else{echo '0';} ?>"  required></td>
<td>Ancho Ventana Corrediza  (mm)</td>
<td><input type="text" name="anchura_v_c"  style="width:20%;" readonly  value="<?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?>" ></td>
</tr>
<tr>
    <td>Laminas</td>
    <td>
        <input type="text" name="laminas"  style="width:20%;"  value="<?php if(isset($_GET['cod'])){echo $laminas;} ?>" >
    </td>
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
//                          if($linea!='Vidrio'){
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
                                     <li class=""><a href="#tab3" data-toggle="tab"><span class="icon icone-pencil"></span> Desglose de aluminio</a></li>
                                     <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Desglose</a></li>
                                  

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
$check= $fil["medida_r_a"];$check2= $fil["division"];
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
                                                            $valor2p=$fila['descripcion'];
                                                           
                                                            $valor3p=$fila['referencia'];

                                                            echo"<option value=".$valorxx.">".$valor1."-".$valor2p."-".$valor3p."</option>";
                                                            
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
                                                    <td>Sin divisiones
                                                    	<select name="sin_div" class="span6">
                                                    		<option value="">Seleccione..</option>
                                                    		<?php if ($check2 == '1') { ?>
                                                    			<option value="1" selected>Si</option>
                                                    			<option value="0">No</option>
                                                    		<?php
                                                    		} else { ?>
                                                    			<option value="1">Si</option>
                                                    			<option value="0" selected>No</option>
                                                    		<?php
                                                    		} ?>
                                                    	</select>
                                                    	<!--<input type="checkbox" name="sin_div" <?php if($check2=='1'){echo 'checked';} ?> value="1" />-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Seleccione el lado</td>
                                                    <td><select name="lado" id="lado" class="span6" required> 
                                                 <?php if(isset($_GET['up_1'])){echo '<option value="'.$lado.'">'.$lado.'</option>';}  ?>
                                                <option value="Vertical">Vertical</option> 
                                                <option value="Horizontal">Horizontal</option> 
                                               
                                     
                                                 
                                                  
                                          </select></td>
                                                    <td align="right">Variable adicional</td>
                                                    <td>
                                                        <select name="b">
                                                            <?php if($check==0){ ?><option value="0">Ninguno</option>  <?php }  ?>  
                                                            <?php if($check==2){ ?><option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option> <?php }  ?>
                                                            <?php if($check==1){ ?><option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option><?php }  ?>
                                                            <?php if($check==3){ ?><option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option><?php }  ?>
                                                            <?php if($check==4){ ?><option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option><?php }  ?>
                                                            <option value="0">Ninguno</option> 
                                                            <option value="2"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                                                            <option value="1"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                                                             <option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                                                            <option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
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
                       if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                       if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                       if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                       if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                       if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                       if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
                      if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+$fil_al['variable'];
                }else{
                       if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                      if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                      if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                       if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
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
                      if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
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
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_1'])){echo $cantidad;} ?>" class="span6" placeholder="Digite la cantidad de perfil" required></td>
                                                    <td align="right"></td>
                                                    <td></td>
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
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla2">';

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

              $table = $table.'<th>Editar</th>';
              $table = $table.'<th>Eliminar</th>';
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
                       if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                        if($row['medida_r_a']==4){
                    $al = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                        if($row['lado']!="Vertical"){
                        $al = ($ancho+$row["descuento"])+ $row['variable'];
                        }else{
                            $al = ($alto+$row["descuento"])+ $row['variable'];
                         }
                }
                }
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
                       if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                        if($row['medida_r_a']==4){
                    $al = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                        if($row['lado']!="Vertical"){
                        $al = ($ancho+$row["descuento"])- $row['variable'];
                        }else{
                            $al = ($alto+$row["descuento"])- $row['variable'];
                         }
                }
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
                       if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                        if($row['medida_r_a']==4){
                    $al = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                        if($row['lado']!="Vertical"){
                        $al = ($ancho+$row["descuento"])* $row['variable'];
                        }else{
                            $al = ($alto+$row["descuento"])* $row['variable'];
                         }
                }
                }
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
                    if($row['medida_r_a']>4)
                        {
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                     if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                      if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['lado']!="Vertical"){
                        $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
                    }else{
                        $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
                    }
                }
                }
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
                      if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
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
                        if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                      if($row['medida_r_a']==4){
                    $al = ($anchura_v_c+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $al = ($ancho+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($alto+$row["descuento"])/ $row['variable'];
            }
                    }
                    }
                    
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
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
            $table = $table.'<tr><td width="10%">'.$row['codigo'].'</a></td><td width="40%">'.$row['descripcion'].'</a></td><td width="10%">'.$row['referencia'].'</font></td><td width="10%">'.$row['lado'].'</a></td><td width="10%">'.$row["medida"].' mm<font></a></td>
               <td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td><td width="10%">'.$row["cantidad"].'<font></a></td><td width="20%">'.number_format($al).' mm<font></a></td>
                   <td class="hidden-phone">'.$row["cantidad"].'</font></td><td class="hidden-phone">$'.number_format($al*$row["costo_mt"]/$n).'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_1='.$row["id_r_a"].'"><button>Editar</button></a></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_1='.$row["id_r_a"].'"><button>Eliminar</button></a></td></tr>';   
           
		
               
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
                                                            $valor1=$fila['codigo'];$valor2p=$fila['descripcion'];
                                                     $valor2r=$fila['referencia'];
                                                           
                                                            

                                                            echo"<option value=".$valorxx.">".$valor1." ".$valor2p." (".$valor2r.")</option>";
                                                            
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
                                                    <td>Sin divisiones
                                                    	<!--<input type="checkbox" name="sin_div" value="1">-->
                                                    	<select name="sin_div" class="span6">
                                                    		<option value="">Seleccione..</option>
                                                    		<option value="1">Si</option>
                                                    		<option value="0">No</option>
                                                    	</select>
                                                    </td>
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
                                                             <option value="3"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                                                            <option value="4"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                      if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                      if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                      if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                      if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])*$fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
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
<div class="tab-pane" id="tab3">
    <div class="row-fluid">
        <fieldset style="width:95%; float:center;margin-right: 3%;margin-left: 3%; margin-top: 3%; margin-bottom: 3%;">
            <legend>Desglose de Aluminio</legend>
            <table>
                <tr>
                    <td>Id Producto</td>
                    <td><input type="text" id="prod" value="<?php echo $_GET['cod']; ?>"></td>
                </tr>
                <tr>
                    <td>Referencia</td>
                    <td><input type="text" id="id_ref" value=""> <input type="text" id="ref" value=""></td>
                </tr>
                <tr>
                    <td>Lado</td>
                            <td><select id="ladod">
                                    <option value="Horizontal">Horizontal</option>
                                    <option value="Vertical">Vertical</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Cantidad</td>
                    <td><input type="text" id="can" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button onclick="desglose();" class="btn btn-primary"> Agregar </button> <button onclick="limpiar();" class="btn btn-danger"> Limpiar </button></td>
                </tr>
            </table>
        </fieldset>
    </div>
    </div>
<div class="tab-pane" id="tab4">
    <div class="row-fluid">
        <?php
        $request=mysqli_query($conexion,"SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_producto=".$_GET['cod']." ");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla2">';

             $table = $table.'<thead >';
            $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'cant. perfiles'.'</th>';
              $table = $table.'<th>Editar</th>';
              $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;
	while($row=mysqli_fetch_array($request))
	{    
            
            
            $table = $table.'<tr>'
                    . '<td width="10%">'.$row['codigo'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</td>'
                    . '<td width="10%">'.$row['referencia'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$row["medida"].' mm</td>
               <td class="hidden-phone">'.  number_format($numero,1,',','.').'</td>'
                    . '<td width="10%">'.$row["cantidad"].'<font></a></td>'
                    . '<td width="20%">'.number_format($al).' mm</td>
                   <td class="hidden-phone">'.$row["cantidad"].'</td>'
                    . '<td class="hidden-phone">$'.number_format($al*$row["costo_mt"]/$n).'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_1='.$row["id_r_a"].'"><button>Editar</button></a></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_1='.$row["id_r_a"].'"><button>Eliminar</button></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
        
        
        ?>
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
$ancho_v2= $fil["ancho_v2"];
$alto_v2= $fil["alto_v2"];
$var1= $fil["var1"];
$var2= $fil["var2"];
$divisor= $fil["divisor"];
$divisor_alto= $fil["divisor_alto"];
$seleccionado= $fil["seleccionado"];
$cantidad_v= $fil["cantidad_v"];
  $si= $fil["utilizar"];$cp= $fil["cp"];$ddesc= $fil["desc"];$pertenece= $fil["pertenece"];

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_ancho= $fil_an["id_r_a"];
            $descripcion_ancho= $fil_an["descripcion"];
            
            $sqlxa=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$alto_v."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlxa));
            $id_alto= $fil_al["id_r_a"];
            $descripcion_alto= $fil_al["descripcion"];
            
             $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v2."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
            $id_ancho2= $fil_an2["id_r_a"];
            $descripcion_ancho2= $fil_an2["descripcion"];
            
            $sqlxa2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$alto_v2."");
            $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlxa2));
            $id_alto2= $fil_al2["id_r_a"];
            $descripcion_alto2= $fil_al2["descripcion"];
            
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
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrios'";                    
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

                                            <div class="controls"> <select name="ancho_v" class="span4" required>
                                                                   <?php
                                                                   if($id_ancho==0){
                                                                       echo"<option value='0'>Ancho</option>";
                                                                   }else{
                                                                       echo"<option value='".$id_ancho."'>".$descripcion_ancho."</option>";
                                                                   }
                                                                     
                                                          
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                             echo"<option value='0'>Ancho</option>";
                                                            ?>
                                                </select>- <select name="ancho_v2" class="span4" required>
                                                                   <?php
                                                                   if($id_ancho2==""){echo"<option value='0'>0</option>";}else{
                                                                       echo"<option value='".$id_ancho2."'>".$descripcion_ancho2."</option>";
                                                                   }
                                                                     
                                                          
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/$row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                            
                                                            }echo"<option value='0'>0</option>";
                                                            ?>
                                                </select> +/- <input type="number" name="dv" value="<?php echo $var1  ?>" style="width: 40px;"> / <input type="number" name="divisor" value="<?php echo $divisor  ?>" style="width: 40px;">
                                            <select name="si" style="width:140px">
                                                     <?php if($si==1){
                                                         echo '<option value="1">Utilizar Ancho</option>'
                                                         . '<option value="0">No Utilizar Ancho</option>';
                                                         
                                                     }else{
                                                echo '<option value="0">No Utilizar Ancho</option><option value="1">Utilizar Ancho</option>';
                                            } ?></select></div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span4" required>
                                                                  <?php
                                                                  if($id_alto==0){
                                                                       echo"<option value='0'>Alto</option>";
                                                                   }else{
                                                                       echo"<option value='".$id_alto."'>".$descripcion_alto."</option>";
                                                                   }
                                                                       require '../modelo/conexion.php';
                                                           $consulta2= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result2=  mysqli_query($conexion,$consulta2);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result2)){
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                            echo"<option value='0'>Alto</option>";
                                                            ?>
                                                </select> - 
                                                <select name="desc" class="span2" required>
                                                    <?php
                                                     if($ddesc==0){echo"<option value='0'>0</option><option value='1'>Alto</option>";}else{
                                                                       echo"<option value='1'>Alto</option><option value='0'>0</option>";
                                                                   }
                                                    ?>
                                                 
                                                </select>
                                                - <select name="alto_v2" class="span2" required>
                                                                  <?php
                                                                  if($id_alto2==""){echo"<option value='0'>0</option>";}else{
                                                                       echo"<option value='".$id_alto2."'>".$descripcion_alto2."</option>";
                                                                   }
                                                                 
                                                          
                                                                       require '../modelo/conexion.php';
                                                           $consulta3= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                                            $result3=  mysqli_query($conexion,$consulta3);
                                                            $ta = 0;
                                                            while($row=  mysqli_fetch_array($result3)){
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                            echo"<option value='0'>0</option>";
                                                            ?>
                                                </select> +/- <input type="number" name="dv2" value="<?php echo $var2  ?>" style="width: 40px;"> /
                                                <input type="number" name="divisor_alto" value="<?php echo $divisor_alto  ?>" style="width: 40px;">
                                                - <select name="acp" style="width:140px">
                                                     <?php if($cp==1){
                                                         echo '<option value="1">+ Alto cf</option><option value="-1">- Alto cf</option>'
                                                         . '<option value="0">No Utilizar Alto cp</option>';
                                                         
                                                     }else{
                                                         if($cp=='-1'){
                                                         echo '<option value="-1">- Alto cf</option><option value="1">+ Alto cf</option>'
                                                         . '<option value="0">No Utilizar Alto cp</option>';
                                                         
                                                               }else{
                                                            echo '<option value="0">No Utilizar Alto cf</option><option value="1">Utilizar Alto cf</option>';
                                                             } 
                                                           
                                                             } 
                                            ?></select>
                                            </div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php echo $cantidad_v ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                                 
                                        <label></label><div class="controls"> </div>
                                               <label class="control-label">Pertenece al modulo</label>

                                               <div class="controls">
                                                   <select name="pertenece">
                                                       <?php
                                                       echo '<option value="'.$pertenece.'">'.$pertenece.'</option>';
                                                       for($x=1; $x<=$hoja; $x=$x+1){
                                                           echo '<option value="'.$x.'">'.$x.'</option>';
                                                           
                                                       }
                                                       
                                                       ?>
                                                   </select>
                                               </div>
                                        </div>
                                             
                                           

                           
<!--
                                        <span class="label label-info">Montura adicional del producto</span>-->
                                        <div class="control-group">
                                              
<!--                                             
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
                                            Form Action -->

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
               $table = $table.'<th class="hidden-phone">'.'Modulo'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            if($row["ancho_v"]==0){
                 if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{
                
            
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
//            echo $row["ancho_v2"]. 'x'. $row["alto_v2"].'<br>';
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
            } 
            }
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
            }
            
            
            if($row["alto_v"]==0){
                $al2= $alto;
            }else{
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/$fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }}
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }
            //------------------------------------------------------------------------------------------------------------------------------------ part 2---------------
            if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])+ $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an2['signo']=='-'){
                 if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])- $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an2['signo']=='*'){
                   if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])* $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an2['signo']=='/'){
                 if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])/ $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            }else{
               
                $al22 = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                   if($fil_al2['medida_r_a']==4){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])+ $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_al2['signo']=='-'){
                 if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])-$fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                   if($fil_al2['medida_r_a']==4){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])- $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al2['signo']=='*'){
                  if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                   if($fil_al2['medida_r_a']==4){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])* $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al2['signo']=='/'){
                 if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                   if($fil_al2['medida_r_a']==4){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])/ $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            }else{
               
                $al2x = 0;
            }
             $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']) / $row['divisor_alto'];
              
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
            }else{
                $n = 0;
                $an2 = $tv;
            }
             if($row['cp']==1){
                $cf = $altura;
              
            }else{
                if($row['cp']==-1){
                $cf = - $altura;
              
            }else{
                $cf = 0;
              
            }
              
            }
            if($row['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alto;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx + $cf - $dess;
            }else{
                $nx = 0;
                $all = $tv2  + $cf - $dess;
            }

         
            
            
            $table = $table.'<tr><td width="10%">'.$row['codigo'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion'].'</font></td>'
                    . '<td width="10%">'.$row['referencia'].'</a></td>
                       <td class="hidden-phone">'.number_format($an2).'</font></td>'
                    . '<td class="hidden-phone">'.$all.'</font></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_v"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_v"]*$row["costo_mt"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["pertenece"].'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_2='.$row["id_r_v"].'"><button><img src="../imagenes/modificar.png"></button></a></td>'
                    . '<td>  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_2='.$row["id_r_v"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Vidrios'";                     
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

                                            <div class="controls"> <select name="ancho_v" class="span4" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <option value="0">Ancho</option>
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                </select> - <select name="ancho_v2" class="span4" required>
                                                                   <option value="0">0</option>
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                </select> +/- <input type="number" name="dv" value="0" style="width: 40px;"> / <input type="number" name="divisor" value="1" style="width: 40px;">
                                            <select name="si" style="width:140px">
                                                     <?php if($si==1){
                                                         echo '<option value="1">Utilizar Ancho</option>'
                                                         . '<option value="0">No Utilizar Ancho</option>';
                                                         
                                                     }else{
                                                echo '<option value="0">No Utilizar Ancho</option><option value="1">Utilizar Ancho</option>';
                                            } ?></select>
                                            </div>
                                               <label></label><div class="controls"> </div>
                                                     <label></label><div class="controls"> </div>
                                               <label class="control-label">Alto (mm)</label>

                                            <div class="controls"><select name="alto_v" class="span4" required>
                                                                   <option value="">..Seleccione la referencia del vidrio..</option>
                                                                   <option value="0">Alto</option>
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                </select> -
                                                
                                                <select name="desc" class="span2" required>
                                                    <option value="0">0</option>
                                                    <option value="1">Alto</option>
                                                </select> -
                                                <select name="alto_v2" class="span2" required>
                                                                   <option value="0">0</option>
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                </select> +/- <input type="number" name="dv2" value="0" style="width: 40px;"> / 
                                                <input type="number" name="divisor_alto" value="1" style="width: 40px;">
                                            - <select name="acp" style="width:140px">
                                                     <?php 
                                                echo '<option value="0">No Utilizar Alto cf</option>'
                                                     . '<option value="1">+ Alto cf</option>'
                                                        . '<option value="-1">- Alto cf</option>';
                                             ?></select></div>
                                                                               
                                           

                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Cantidad (Und)</label>

                                            <div class="controls"><input type="text" name="cant_v" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder="Digite la cantidad de vidrios" required></div>
                                            
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Pertenece al modulo</label>

                                               <div class="controls">
                                                   <select name="pertenece">
                                                       <?php
                                                       for($x=1; $x<=$hoja; $x=$x+1){
                                                           echo '<option value="'.$x.'">'.$x.'</option>';
                                                           
                                                       }
                                                       
                                                       ?>
                                                   </select>
                                               </div>
                                           
                                   
Por favor sea lo mas exacto en la medida de la hoja de vidrio de la ventana
                                </div>

<!--                                        <center><span class="label label-info">Montura adicional del producto</span></center>-->
                                        <div class="control-group">
                                              
                                             
<!--                                            <h4><label>Si el Producto tiene una montura adicional seleccione algun valor, sino dejelo en 0</label><div class="controls"> </div>
                                            </h4><div class="controls"> 
                                               Altura Cuerpo fijo <?php echo $altura; ?><input type="radio" name="op1" value="1">
                                            </div>  <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                               Altura Ventana Corrediza <?php echo $altura_v_c; ?><input type="radio" name="op1" value="2">
                                            </div> <label></label><div class="controls"> </div>
                                             <div class="controls"> 
                                                Ninguno <input type="radio" checked name="op1" value="0">
                                            </div> 
                                         <label></label><div class="controls"> </div>-->
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
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Detalles de la ventana con rejillas</h4>

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

                                    <li class="active"><a href="#tab12" data-toggle="tab"><span class="icon icone-eye-open"></span>Rejillas</a></li>

                                    <li class=""><a href="#tab13" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Rejilla</a></li>

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab12">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
if(isset($_GET['up_3'])){ 
   
     $sql='select * from producto_rep_rej a, referencias b where a.id_referencia=b.id_referencia and a.id_r_rej="'.$_GET["up_3"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id_r_v= $fil["id_referencia"];
$desc_v= $fil["descripcion"];
$ref_v= $fil["referencia"];
$codigo_v= $fil["codigo"];
$ancho_v= $fil["id_referencia_med"];
$medida_rej= $fil["medida_rej"];
$var1= $fil["var3"];
$varr= $fil["varr"];
 $en= $fil["en"];
  $por= $fil["multiplo"];

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$ancho_v."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_ancho= $fil_an["id_r_a"];
            $descripcion_ancho= $fil_an["descripcion"];
            

?>
                          <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_rej.php?id_p='.$_GET['cod'].'&editar='.$_GET['up_3'].'';}else{echo '../modelo/reparto_rej.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <table>
                                    <tr>
                                        <td>Seleccione referencia</td>
                                        <td> <select name="ref_rej" class="span11"  id="select2_2">
                                                                   
                                                                   <?php
                                                                   echo '<option value="'.$id_r_v.'">'.$codigo_v.'</option>';
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Perfileria'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor2d=$fila['descripcion'];
                                                            $valor2r=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."-".$valor2d."-".$valor2r."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                               <td><select name="" id="b">
                                                                   <?php echo '<option value="">'.$desc_v.'</option>'; ?>
                                                                   </select></td>
                                                               <td><select name="" id="c" style="width: 80px;"><?php echo '<option value="">'.$ref_v.'</option>'; ?></select></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Calcular Cant. de Rejillas</td>
                                        <td> <select name="perfil_med" class="span8" required>
                                                                   <?php
                                                                   
                                                                   echo ' <option value="'.$id_ancho.'">'.$descripcion_ancho.'</option>';
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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
                                                </select> / <input type="number" name="var3" value="<?php echo $var1;  ?>" style="width: 80px;">
                                        </td>
                                        <td>* <input type="number" name="multiplo" value="<?php echo $por;  ?>" style="width: 80px;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Medida del perfil (mm) edi</td>
                                        <td><select name="med_rej">
                                                      
                                                            
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/$fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
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
            if($medida_rej == '0'){
                echo "<option value='0'>Ancho de producto</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
            if($medida_rej == 999999){
                echo "<option value='999999'>Alto de producto</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
              if($medida_rej == 999998){
                echo "<option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
             if($medida_rej == 999997){
                echo "<option value='999997'>Alto Ventana Corrediza</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
             if($medida_rej == 999996){
                echo "<option value='999996'>Ancho Ventana Corrediza</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
             if($medida_rej == 999995){
                echo "<option value='999995'>Ancho C.F</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option><option value='999997'>Alto Ventana Corrediza</option>";
            }else{
                echo "<option value='".$row['id_r_v']."'>(".$row['id_r_v']." mm) ".$row['descripcion']."</option><option value='0'>Ancho de producto</option><option value='999999'>Alto de producto</option><option value='999998'>Alto Cuerpo Fijo de producto</option>";
            }}}}
            
            }
            
            }
            
		
               
	} 
	
        
	
}

?>
                                                <option value='0'>Ancho de producto</option>
                                                <option value='999995'>Ancho C.F </option>
                                                <option value='999996'>Ancho Ventana Corrediza</option>
   </select> -/+ <input type="number" name="varr" value="<?php echo $varr;  ?>" style="width: 80px;"> / <input type="number" name="en" value="<?php echo $en;  ?>" style="width: 80px;">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </table>
                                  
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <a href="../vistas/?id=add_cot&cod=<?php echo $_GET['cod'] ?>"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->
</fieldset>
                  
                                 
                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>                                  
<?php
}else{
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
    
     
if($request_v){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'referencia'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Rejillas'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Valor'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
            } 
            }
         
                $al2 = ($alto+$fil_an["descuento"]);
          // calculo de del ancho de la rejilla
      $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            if($fil_anrej['signo']=='+'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                      if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_anrej['signo']=='-'){
             if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                      if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_anrej['signo']=='*'){
                  if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                      if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_anrej['signo']=='/'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                      if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            if($fil_anrej['lado']=="Vertical"){
                $al2 = ($alto+$fil_anrej["descuento"]);
            }else{
                $al2 = ($ancho+$fil_anrej["descuento"]);
            }
            
            $tvR = $alr + $col['var1'];


         }
              
             
                
            
            $tv2 = ($al / $row['var3']) * $row['multiplo'];
            if($row["medida_rej"]==0){
                $medrej = ($ancho + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                $medrej = ($alto + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999998){
                $medrej = ($altura + $row["varr"]) / $row["en"]; 
            }else{
                 if($row["medida_rej"]==999997){
                $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                 if($row["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                 if($row["medida_rej"]==999995){
                $medrej = ($anchura + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            } 
            } 
            } 
            } 
            } 
            }
          
            $numero = ($row["medida_rej"]*$tv2)/$row["medida"];
            $table = $table.'<tr>'
                    . '<td width="10%">'.$row['codigo'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion'].'</a></td>'
                    . '<td width="10%">'.$row['referencia'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]/1000).'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_3='.$row["id_r_rej"].'"><button><img src="../imagenes/modificar.png"></button></a> </td>'
                    . '<td> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_8='.$row["id_r_rej"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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

                                    <div class="tab-pane" id="tab13">

                                        <div class="row-fluid">

                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_rej.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_rej.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <table></table>
                                    <legend>Detalles de Rejillas</legend>
                                        <div class="control-group">
                                              
                                             <table>
                                    <tr>
                                        <td>Seleccione referencia</td>
                                        <td> <select name="ref_rej" class="span11" id="select2_2">
                                                                   
                                                                   <?php
                                                                   echo '<option value="'.$id_r_v.'">'.$desc_v.'</option>';
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencias` where grupo='Perfileria'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor2d=$fila['descripcion'];
                                                            $valor2r=$fila['referencia'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."-".$valor2d."-".$valor2r."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                               <td><select name="" id="b"></select></td>
                                                               <td><select name="" id="c" style="width: 80px;"></select></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Calcular Cant. de Rejillas</td>
                                        <td> <select name="perfil_med" class="span8" required>
                                                                   <?php
                                                                   
                                                                   echo ' <option value="'.$id_ancho.'">'.$descripcion_ancho.'</option>';
                                                                       require '../modelo/conexion.php';
                                                           $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where c.grupo='Perfileria' and b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])+ $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])+ $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])- $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])- $row['variable'];
            }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $alv = ($ancho+$row["descuento"])* $row['variable'];
            }else{
                $alv = ($alto+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                    if($row['medida_r_a']==3){
                    $alv = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==4){
                    $alv = ($anchura_v_c+$row["descuento"])/ $row['variable'];
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

                                                            echo"<option value='".$valor1_an."'>".$valor2." (".$alv.")(".$valor1_an.")</option>";
                                                            
                                                            }
                                                            ?>
                                                </select> / <input type="number" name="var3" value="1" style="width: 80px;">
                                        </td>
                                        <td>* <input type="number" name="multiplo" value="1" style="width: 80px;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Medida del perfil (mm)</td>
                                        <td><select name="med_rej">
                                                            <option value="0">Ancho de producto</option> 
                                                            <option value="999999">Alto de producto</option> 
                                                            <option value="999998">Alto Cuerpo Fijo de producto</option> 
                                                            <option value="999997">Alto Ventana Corrediza</option> 
                                                            <?php
                                                                       require '../modelo/conexion.php';
                                                            $request_vw=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_vw){

        $total2=0;
	while($row=mysqli_fetch_array($request_vw))
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_v_c+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/$fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
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
            echo"<option value='".$row['id_r_v']."'>(".$tv." mm) ".$row['descripcion']."-".$row['id_r_v']."</option>";
		
               
	} 
	
        
	
}

                                                            ?>
                                                            <option value='999995'>Ancho C.F </option>
                                                <option value='999996'>Ancho Ventana Corrediza</option>
                                                        </select> -/+ <input type="number" name="varr" value="" style="width: 80px;"> / <input type="number" name="en" value="1" style="width: 80px;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </table>
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->
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
<!--Fin Modulo de regillas -->
                         



                         
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
$valor= $fil["valor_f"];
$yes= $fil["yes"];$cj= $fil["can_rej"];
$lado= $fil["lado"];$grupo= $fil["grupo"];$med= $fil["med"];$valor= $fil["valor_f"];
if($cal_name=='ML'){$cal = 'Perimetro ML';}else{if($cal_name=='Und'){$cal = 'Por Unidad';}else{$cal = 'Por Galon';}}

$rejilla = mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_rej=".$cj." ");
$cd = mysqli_fetch_array($rejilla);
$des_rej = $cd['descripcion'];

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
                                                           $consulta= "SELECT * FROM `referencias`  group by codigo";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'].'-'.$fila['descripcion'].'-'.$fila['referencia'];
                                                           

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
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td><select name="cal" class="span6" id="perimetro" required> 
                                                <?php  echo '<option value="'.$cal_name.'">'.$cal.'</option>'; ?>
                                         
                                                <option value="Und">Und</option>
                                                <option value="ML">ML</option>
                                                <option value="M2">M2</option>
                                                <option value="Kg">Kg</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                     <td><input type="text" name="cant_acc" value="<?php if(isset($_GET['up_5'])){echo $cantida_ac; } ?>" class="span6" placeholder=" " required></td>
                                                      <td><?php if($grupo=='Perfileria'){ echo 'Medida=<input type="number" name="med" value="'.$med.'" class="span3" placeholder=" " required> Valor de Fabricacion=<input type="number" name="valor" value="'.$valor.'" class="span3" placeholder=" " required>'; }else{echo 'Medida=<input type="hidden" name="med" value="1" class="span6" placeholder=" " required><input type="hidden" name="valor" value="1" class="span3" placeholder=" " required>'; } ?></td>
                                                       <td><select name="can_rej" class="span4" required>
                                                                   <?php
                                                                   if($des_rej==''){echo ' <option value="0">1</option>';}else{echo ' <option value="'.$cj.'">'.$des_rej.'</option>';}
                                                                   
                                                                       require '../modelo/conexion.php';
                                                           $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            while($row=mysqli_fetch_array($request_v2))
                                                            {
                                                               echo ' <option value="'.$row['id_r_rej'].'">'.$row['descripcion'].'</option>';
                                                            }
                                                            ?>
                                                           </select> <i>Para calcular los tornillos de las rejillas por favor seleccione la rejila, de lo contrario dejelo en 1.</i></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" style="width:50px;" value="<?php if(isset($_GET['up_5'])){echo $metro; } ?>" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro?</td>
                                                      <td>
                                                          <select name="yes">
                                                              <?php echo '<option value="'.$yes.'">'.$yes.'</option>'; ?>
                                                              <option value="Si">Si</option>
                                                               <option value="No">No</option>
                                                          </select></td>
                                                        
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

$request_ac=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." order by b.para ");
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Referencia'.'</th>'; 
               $table = $table.'<th width="7%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="7%">'.'Color'.'</th>';
              $table = $table.'<th  width="5%">'.'Variante'.'</th>';
              $table = $table.'<th width="5%">'.'Cant x MT'.'</th>';
              $table = $table.'<th width="7%">'.'Costo Fab'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
               $table = $table.'<th>Editar</th>';
               $table = $table.'<th>Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{     
            ///----------------------------------------
            if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])*$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
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
            } 
            }
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
       
}}else{
            $cant_rej = 1;
        }

            //----------------------------------------
             if($tipo=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$alto) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $hoja * 2 * $row["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$alto) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($res)*$m).' ML';
                 $valor = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($res).' '.$row["calcular"].'';
                 $valor = 'No aplica' ;
                 $a = '' ;
             }
             $taa = $cant_rej * $res;
            $table = $table.'<tr><td width="5%">'.$row['codigo'].'</td><td width="30%">'.$row['descripcion'].'</td><td width="5%">'.$row['referencia'].'</td><td width="7%">'.$row['lado'].'</td><td width="7%">'.$row["color_acc"].'<font></a></td><td width="5%">'.$row["yes"].'<font></a></td>
               <td width="5%">'.$taa.' '.$row["calcular"].'</font></td><td width="7%">'.$valor.'</font></td><td class="hidden-phone">'.$row["para"].'</font></td>'
                    . '<td><a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&up_5='.$row["id_r_ac"].'"><button><img src="../imagenes/modificar.png"></button></a> </td><td> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_4='.$row["id_r_ac"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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
                                                           $consulta= "SELECT * FROM `referencias`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'].'-'.$fila['descripcion'].'-'.$fila['referencia'];
                                                           

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
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td><select name="cal" class="span6" id="perimetro" required> 
                                                <option value="">Ninguno</option> 
                                                  <option value="Und">Und</option>
                                                <option value="ML">ML</option>
                                                <option value="M2">M2</option>
                                                <option value="Kg">Kg</option>
                                                
                                     
                                                 
                                                  
                                          </select></td>
                                                      <td></td>
                                                       <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                    <td id="cantidad"><input type="text" name="cant_acc" value="<?php if(isset($_GET['cod'])){} ?>" class="span6" placeholder=" " required></td>
                                                      <td id="medida"></td>
                                                       <td><select name="can_rej" class="span8" required>
                                                                   <?php
                                                                   
                                                                   echo ' <option value="0">1</option>';
                                                                       require '../modelo/conexion.php';
                                                           $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            while($row=mysqli_fetch_array($request_v2))
                                                            {
                                                               echo ' <option value="'.$row['id_r_rej'].'">'.$row['descripcion'].'</option>';
                                                            }
                                                            ?>
                                                           </select> <i>Para calcular los tornillos de las rejillas por favor seleccione la rejila, de lo contrario dejelo en 1.</i></td>
                                                        
                                                </tr>
                                                 <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" style="width:50px;" value="1000" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro? <select name="yes">
                                                              <?php echo '<option value="'.$yes.'">'.$yes.'</option>'; ?>
                                                              <option value="Si">Si</option>
                                                               <option value="No">No</option>
                                                          </select></td>
                                                      <td></td>
                                                        
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
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_ma'].'</font></td><td width="10%"> '.$row["porcentaje_ma"].' %<font></a></td>
               '
                    . '<td  width="10%">  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_3='.$row["id_rep_ma"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td><td width="10%">'.$row['descripcion_mo'].'</font></td><td width="10%"> '.$row["instalacion"].'<font></a></td><td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td  width="10%">  <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_5='.$row["id_rep_mo"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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

                                            <form name="formulario" class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/reparto_mo.php?id_p='.$_GET['cod'].'';}else{echo '../modelo/reparto_mo.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione mano de obra</label>
                                            <div class="controls"> 
                                               
                                               <select name="ref_mo" >
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
                                          <a href="../vistas/checkeds_manoobra.php?cod=<?php echo $_GET['cod'].''; ?>" title="Seleccionar materiales por cantidad" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/check.png"> Agregar Multiples</a><br> 
                                                                                        
                                           

                                           
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
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td  width="10%"> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_6='.$row["id_rep_ad"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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
                                              
                                             <label class="control-label">Seleccione los gastos administrativos</label>
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
                                             <a href="../vistas/checkeds_gastos.php?cod=<?php echo $_GET['cod'].''; ?>" title="Seleccionar materiales por cantidad" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/check.png"> Agregar Multiples</a><br> 
                                           
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
               $table = $table.'<th width="10%">Eliminar</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 
            $table = $table.'<tr><td width="20%">'.$row['referencia_ot'].'</a></td><td width="10%">'.$row['descripcion_ot'].'</font></td><td width="10%"> '.$row["cantidad_ot"].' Und<font></a></td><td width="10%">$ '.$row["valor_ot"].' <font></a></td>
               <td  width="10%"> <a href="../vistas/?id=add_cot&cod='.$_GET['cod'].'&del_7='.$row["id_r_ot"].'"><button><img src="../imagenes/eliminar.png"></button></a></font></td></tr>';   
           
		
               
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
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_2'])){
$sql = "DELETE FROM producto_rep_vid WHERE id_r_v=".$_GET['del_2']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_3'])){
$sql = "DELETE FROM producto_rep_ma WHERE id_rep_ma=".$_GET['del_3']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_4'])){
$sql = "DELETE FROM producto_rep_acc WHERE id_r_ac=".$_GET['del_4']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_5'])){
$sql = "DELETE FROM producto_rep_mo WHERE id_rep_mo=".$_GET['del_5']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_6'])){
$sql = "DELETE FROM producto_rep_ad WHERE id_rep_ad=".$_GET['del_6']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
if(isset($_GET['del_7'])){
$sql = "DELETE FROM producto_rep_otro WHERE id_r_ot=".$_GET['del_7']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
 if(isset($_GET['del_8'])){
$sql = "DELETE FROM producto_rep_rej WHERE id_r_rej=".$_GET['del_8']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}
 if(isset($_GET['del_db'])){
$sql = "DELETE FROM vidrios_divisiones WHERE id_db=".$_GET['del_db']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_cot&cod=".$_GET['cod']."'";
echo "</script>";
}