<?php
@session_start();
include "../modelo/conexion.php";
include "../modelo/consultar_permisos.php";

            
    $con2= "SELECT * from cont_terceros where cod_ter = '".$_POST["elegido2"]."'";
    $res2=  mysqli_query($conexion,$con2);
    
       $f2=  mysqli_fetch_array($res2);
            $id = $f2['id_ter'];
            $codigo = $f2['cod_ter'];
            $descripcion = $f2['nom_ter'];
            $documento = $f2['doc_ter'];
            $verificacion = $f2['digiver_ter'];
            $direccion = $f2['dir_ter'];
            $fijo = $f2['telfijo_ter'];
            $movil = $f2['telmovil_ter'];
            $ciudad = $f2['ciudad_ter'];
            $pais = $f2['pais_ter'];
            $fecha_n = $f2['fecnac_ter'];
            $correo = $f2['correo_ter'];
            $contacto = $f2['cont_ter'];
            $estado = $f2['estado_ter'];
            $especial = $f2['especial'];
            $fuente = $f2['fuente'];
            $ica = $f2['ica'];
            $iva = $f2['iva'];
            $cree = $f2['cree'];
            $cliente = $f2['id_cliente'];
            $tipo = $f2['tipo'];
            $creado = $f2['creado'];
            $fecha_r = $f2['fecha_registro'];
            $pvi = $f2['pvi'];
            $pal = $f2['pal'];
            $pac = $f2['pac'];
        ?>
             
<!-- Nombre --> <input type="hidden" autocomplete="off" name="id" value="<?php echo $id;  ?>" readonly class="span2" placeholder="" maxlength="11" required>
                                             
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo de Verificacion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="verificacion" value="<?php echo $verificacion;  ?>" maxlength="1" class="span1" placeholder="" required>
                                            </div>
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre/Razon Social</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php echo $descripcion;  ?>" class="span4" placeholder="" required></div>
                                              <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Tipo de documento</label>
                                            <div class="controls">
                                                <select name="documento" id="lead_source" title='' tabindex="106" required >
                                                    <?php
                                                        if($documento=='CC'){
                                                        echo '<option label="" value="CC">Cédula de Ciudadanía</option>';               
                                                    }else if ($documento=='NIT'){
                                                        ECHO '<option label="" value="NIT">Nit</option>';
                                                    }else if ($documento=='PA'){
                                                        echo '<option label="" value="PA">Pasaporte</option>';
                                                    }
                                                    else if ($documento=='CE'){
                                                        echo '<option label="" value="CE">Cédula de Extrangería</option>';
                                                    }
                                                    ?>
                                                    <option label="" value="CC">Cédula de Ciudadanía</option>
                                                    <option label="" value="PA">Pasaporte</option>
                                                    <option label="" value="CE">Cédula de Extrangería</option>
                                                    <option label="" value="NIT">Nit</option>
                                                    
                                                    
                                                </select>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                             <label class="control-label">Direccion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="direccion" value="<?php echo $direccion;  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Telefono Fijo / Fax</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="fijo" value="<?php echo $fijo;  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Telefono Movil</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="movil" value="<?php echo $movil;  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Codigo de ciudad</label>
                                            <div class="controls">
                                                <select name="departamento" id="ciudad"  class="span4" required>                   
                                                    <?php 
                                                        if(isset($ciudad)){
                                                            $c = substr($ciudad, 0,2);
                                                            echo "<option value='".$c."'>".$c."</option>";
                                                        }else{
                                                            echo "<option value=''>..Seleccione Departamento</option>"; 
                                                        } 
                                                        ?>    
                                                    <?php      
                                                       $consulta= "SELECT * FROM `departamentos` group by nombre_dep";  
                                                        $result=  mysqli_query($conexion,$consulta);                                
                                                        while($fila=  mysqli_fetch_array($result)){                 
                                                            $valor1=$fila['cod_dep'];      
                                                            $valor2=$fila['nombre_dep'];      
                                                            echo"<option value='".$valor1."'>".$valor1."- ".$valor2."</option>";   
                                                        }                                                             
                                                    ?>  
                                                </select> 
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                            <label class="control-label">Municipio</label>  
                                            <div class="controls">
                                                <select name="municipio"  id="municipio"  class="span4">         
                                                    <?php if(isset($ciudad)){
                                                         $c = substr($ciudad, -3);
                                                        echo "<option value='".$c."'>".$c."</option>";
                                                    }else{
                                                        echo "<option value=''>Seleccione.. </option>";
                                                    }
                                                    ?>    
                                                </select> 
                                            </div>
                                            <label></label><div class="controls"> </div> 
                                             <label class="control-label">Pais</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pais" value="169" class="span2" placeholder="" readonly>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Fecha de Nacimiento</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="nacimiento" value="<?php echo $fecha_n;  ?>" class="span2" placeholder="" >
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Correo Electronico</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="correo" value="<?php echo $correo;  ?>" class="span2" placeholder="" >
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Contacto</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="contacto" value="<?php echo $contacto;  ?>" class="span2" placeholder="" >
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Aluminio</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pal" value="<?php echo $pal;  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Vidrio</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pvi" value="<?php echo $pvi;  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Acero</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pac" value="<?php echo $pac;  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                             <label></label><div class="controls"> </div>
                                           
                                                     
                                                  <div class="controls"> 
                                                     
                                                      <input type="checkbox" name="estado" <?php if($estado =='1'){echo 'checked';}   ?> value="1">
                                                     <label>Estado Inactivo</label>
                                                      <input type="checkbox" name="especial" <?php if($especial =='1'){echo 'checked';}   ?> value="1">
                                                     <label>Cliente Especial</label>
                                                      <input type="checkbox" name="fuente" <?php if($fuente =='1'){echo 'checked';}  ?> value="1">
                                                     <label>No aplica RETEFTE</label>
                                                      <input type="checkbox" name="ica" <?php  if($ica =='1'){echo 'checked';}   ?> value="1">
                                                     <label>Retencion ICA</label>
                                                      <input type="checkbox" name="iva" <?php  if($iva =='1'){echo 'checked';}  ?> value="1">
                                                     <label>Retencion IVA</label>
                                                     <input type="checkbox" name="cree" <?php  if($cree =='1'){echo 'checked';}  ?> value="1">
                                                     <label>Retencion CREE</label>
                                                     
                                                  </div>
                                                 
                                            
                                           
                                     <div class="form-actions">
                                      <?php
                                        if (isset($descripcion)){ ?>
                                            <button type="submit" class="btn btn-primary" name="editar">Editar</button>
                                        <?php }else{ ?>
                                            <button type="submit" class="btn btn-primary" name="guardar">Agregar</button>
                                        <?php }
                                        ?>
                                           
                                                <a href="../vistas/?id=terceros"><button type="button" class="btn">Cancelar</button></a>
                                    </div>

