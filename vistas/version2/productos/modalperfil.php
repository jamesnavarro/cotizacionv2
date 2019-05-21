 <?php require '../../../modelo/conexion.php'; ?>
<div class="modal fade" id="Formularioaluminio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-dialog">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>AGREGAR ALUMINIO</b></h4>
        </div>
          
        <div class="modal-body">
            <div class="control-group">
                                            <table>
                                                <tr>
                                                    <td>Codigo del Perfil</td>
                                                    <td><select  name="ref" id="select2_1">
                                                   
                                                                   
                                                                   <?php if(isset($_GET['up_1'])){echo '<option value="'.$id_r_a.'">'.$codigo_a.'</option>';}
                                                                       
                                                            $consulta= "SELECT * FROM `referencias` where grupo in ('Perfileria','Perfileria Acero')";                    
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
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
                                                            $request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_v){

        $total2=0;
	while($row=mysql_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
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
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            
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
      
        </div>
           </div>
         </div>
        </div>  
