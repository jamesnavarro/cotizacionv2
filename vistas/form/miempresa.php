 <?php 
 if(isset($_GET['empre'])){
     $consulta= "select * from inf_empresa";
    $result=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result)){
        $id_emp=  $fila['id_emp']; 
        $nombre=$fila['nombre'];
        $resolucion=$fila['resolucion'];
        $fechaRes=$fila['fechaRes'];
        $regimen=$fila['regimen'];
        $prop=$fila['gerente'];
        $ni=$fila['nit_emp'];
        $facti=$fila['factura_inicial'];
        $factf=$fila['factura_final'];
        $te1=$fila['telefono_1'];
        $fax1=$fila['telefono_2'];
        $cel_emp=$fila['telefono_3'];
        $depa=$fila['dapartamento'];
        $munici=$fila['municipio'];
        $dire1=$fila['direccion'];
        $emai1=$fila['email'];
        $info=$fila['inf'];$ruta=$fila['logo'];
    }
 }
    
?> 
    <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
      <section class="body">
       <div class="body-inner">
          <div class="span12 widget dark stacked">
           <header>
             <h4 class="title"><?php if (isset($_GET['up'])){
                 echo 'Actualizar Datos De La Empresa';}else{
                 echo 'Informacion De La Empresa';} ?></h4>
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
                                   
                                  
                                    <div class="tab-pane active" id="tab4">
                                        <div class="row-fluid">
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($id_emp)){echo '../modelo/insertar_empresa.php?editar='.$id_emp.'';}else{echo '../modelo/insertar_empresa.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                   <div class="control-group">
                                       <input type="hidden" name="cod" value="<?php if(isset($id_emp)){echo $id_emp; } ?>" class="span6" placeholder="">
                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Nombre de la Empresa</label>
                                               <div class="controls">
                                                   <input type="text" name="empresa" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $nombre;} ?>" class="span6" placeholder="" required></div>
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">NIT </label>
                                              <div class="controls"><input type="text" name="nit" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $ni;} ?>" class="span6" placeholder="" required></div>
                                               <label></label><div class="controls"> </div>
                                           
                                                <label></label><div class="controls"> </div>
                                               <label class="control-label">Direccion </label>
                                               <div class="controls"><input type="text" name="direccion" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $dire1;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                                <label></label><div class="controls"> </div>
                                               <label class="control-label">Departamento </label>
                                               <div class="controls"><select name="departamento_emp" id="depa" style="width:25%;">	
                                                        <?php 
                                                            if(isset($_GET['empre'])){
                                                                echo "<option value='".$depa."'>".$depa."</option>";
                                                            }else{
                                                                echo "<option value=''>Seleccione Departamento..</option>"; 
                                                            } 
                                                            ?>    
                                                        <?php      
                                                            $consulta= "SELECT * FROM `departamentos` group by nombre_dep";  
                                                            $result=  mysqli_query($conexion,$consulta);                                
                                                            while($fila=  mysqli_fetch_array($result)){                 
                                                                $valor1=$fila['cod_dep'];      
                                                                $valor2=$fila['nombre_dep'];      
                                                                echo"<option value='".$valor2."'>".$valor2."</option>";   
                                                            }                                                            
                                                        ?> 
                                                            
                                                            
                                               </select></div>
                                               <label></label><div class="controls"></div>
                                               <label></label><div class="controls"></div>
                                               <label class="control-label">Municipio </label>
                                               <div class="controls"><select name="municipio_emp" id="muni" style="width:25%;">
                                                    <?php if(isset($_GET['empre'])){
                                                        echo "<option value='".$munici."'>".$munici."</option>";
                                                    }else{
                                                        echo "<option value=''>Seleccione.. </option>";
                                                    }
                                                    ?> 
                                                        <option value="">Seleccione uno</option>
                                                        </select></div>
                                               <label></label><div class="controls"> </div>
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Telefono fijo</label>
                                               <div class="controls"><input type="text" name="telefono1" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $te1;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Telefono fax</label>
                                               <div class="controls"><input type="text" name="telefono2" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $fax1;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Telefono Celular </label>
                                               <div class="controls"><input type="text" name="telefono3" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $cel_emp;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                              
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Email </label>
                                               <div class="controls"><input type="text" name="email" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $emai1;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Resolucion </label>
                                               <div class="controls"><input type="text" name="resolucion" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $resolucion;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                                <label class="control-label">Fecha de Resolucion</label>
                                               <div class="controls"><input type="text" id="datepicker1" name="fechaRes"  value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $fechaRes;} ?>" class="span2" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Regimen </label>
                                               <div class="controls"><input type="text" name="regimen" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $regimen;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Informacion Adicional </label>
                                               <div class="controls"><input type="text" name="info" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $info;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Rango de facturacion Inicial </label>
                                               <div class="controls"><input type="text" name="fi" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $facti;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Rango de facturacion Final </label>
                                               <div class="controls"><input type="text" name="ff" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $factf;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                               <label></label><div class="controls"> </div>
                                               <label class="control-label">Gerente</label>
                                               <div class="controls"><input type="text" name="gerente" id="" value="<?php if(isset($_GET['nuevo'])){echo ''; }else{ echo $prop;} ?>" class="span6" placeholder=""></div>
                                               <label></label><div class="controls"> </div>
                                                <div class="controls"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;"><img src="<?php if(isset($id_emp)){if($ruta!=''){echo '../logo/'.$ruta;}else{echo '../producto/no.jpg';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span><span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['cod'])){echo '<input name="imagen" type="file" value="'.$ruta.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></div>
                                               
                                                </div>
                           
                                    <!-- Form Action -->
                                    <br>
                                    <div class="form-actions">
<?php if(isset($_GET['up'])){   ?>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
<?php   }else{
    if(isset($_GET['empre'])){ ?>
    <a href="../vistas/?id=lista_empresa&nuevo"><button type="button" class="btn btn-primary">Nuevo</button></a>
<?php   }else{ ?>
    <button type="submit" class="btn btn-primary">Agregar</button>
<?php   }   }   ?>
                                        
                                        <a href="../vistas/?id=lista_empresa"> <button type="button" class="btn">Cancelar</button> </a>
                                    </div><!--/ Form Action -->
                               
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
<?php
 if(isset($_GET['del'])){
$sql = "DELETE FROM productos WHERE id_producto=".$_GET['del']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=producto'";
echo "</script>";
}
     


