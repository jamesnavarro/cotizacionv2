<?php if(isset($_GET['cod'])){require '../modelo/consultar_contacto.php'; } ?><div class="row-fluid">  
    <!-- START Form Wizard -->                    
    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/contacto_add.php?editar='.$_GET['cod'].'';}else{echo '../modelo/contacto_add.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                        
        <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar empresa';}else{echo 'nuevo contacto';} ?></h4></header>      
        <section class="body">                                
            <div class="body-inner">      
                <div class="alert">                                          
                    <b>I. &nbsp; &nbsp; INFORMACION DEL CONTACTO</b>  
                </div>                                      
                <div class="control-group">           
                    <label class="control-label">Tipo de Contacto</label>    
                    <div class="controls"><select name="contacto" required> 
                                                                                                        <?php if(isset($_GET['cod'])){echo '<option value="'.$tipo.'">'.$tipo.'</option>';}else{echo '<option value="">Seleccione el tipo</option>';} ?>  
                            <option value="Potencial">Potencial</option>
                            <option value="Contactado">Contactado</option> 
                        </select>  
                        <label></label><div class="controls"> </div>  
                    </div>                                   
                    <div class="control-group">   
                        <label class="control-label">Nombre</label>  
                        <div class="controls"><input type="text" name="nombre" value="<?php if(isset($_GET['cod'])){echo $nombre;} ?>" class="span6" placeholder="" required></div> 
                        <label></label><div class="controls"> </div>    
                        <label class="control-label">Apellido</label>      
                        <div class="controls"><input type="text" name="apellido"   value="<?php if(isset($_GET['cod'])){echo $apellido;} ?>" class="span6" placeholder="" static required></div>     
                        <label></label><div class="controls"> </div>     
                         <label class="control-label">Cedula</label>      
                        <div class="controls"><input type="text" name="cedula"   value="<?php if(isset($_GET['cod'])){echo $cedula;} ?>" class="span6" placeholder="" static required></div>     
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">% en Vidrio</label>      
                        <div class="controls"><input type="text" name="pvi"   value="<?php if(isset($_GET['cod'])){echo $pvi;} ?>" class="span2" placeholder="Descuento de" static required>%</div>     
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">% en aluminio</label>      
                        <div class="controls"><input type="text" name="pal"   value="<?php if(isset($_GET['cod'])){echo $pal;} ?>" class="span2" placeholder="Descuento de" static required>%</div>     
                        <label></label><div class="controls"> </div>
                        <label class="control-label">% en Acero</label>      
                        <div class="controls"><input type="text" name="pac"   value="<?php if(isset($_GET['cod'])){echo $pac;} ?>" class="span2" placeholder="Descuento de" static required>%</div>     
                        <label></label><div class="controls"> </div> 
                        
                    </div>                                    
                    <div class="control-group">           
                        <label class="control-label">Empresa</label>     
                        <div class="controls"><select name="empresa" class="span4" id="select2_1">      
                        <?php                         
                        if(isset($_GET['cod'])){echo '<option value="'.$idempresa.'">'.$empresa.'</option>';}else{echo '<option value="">..Seleccione la empresa..</option>';}   
                        require '../modelo/conexion.php';    
                        $consulta= "SELECT * FROM `sis_empresa`"; 
                        $result=  mysql_query($consulta);     
                        while($fila=  mysql_fetch_array($result)){ 
                            $empre=$fila['nombre_emp'];      
                            $id_empre=$fila['id_empresa'];     
                            echo"<option value='".$id_empre."'>".$empre."</option>"; 
                            }                              
                            ?>                       
                            </select>              
                        </div><br></div>
                    <input type="hidden" name="toma_contacto"   value="" class="span2" placeholder=""> <input type="hidden" name="campaña"   value="" class="span2" placeholder="">
                    <div class="control-group">      
                       
                        <label></label><div class="controls">  
                        </div>       
                        <label class="control-label">Cargo</label> 
                        <div class="controls"><input type="text" name="cargo" value="<?php if(isset($_GET['cod'])){echo $cargo;} ?>" class="span6" placeholder=" " ></div>  
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">Departamento</label> 
                        <div class="controls"><input type="text" name="departamento1" value="<?php if(isset($_GET['cod'])){echo $departamento;} ?>" class="span6" placeholder=" "></div>  
                        <label></label><div class="controls"> </div>     
                    </div>          
                    <div class="control-group">             
                        <label class="control-label">Informa a</label>   
                        <div class="controls"> 
                            <select name="informa" class="span4"  id="select2_3"> 
                             <?php   
                             if(isset($_GET['cod'])){echo '<option value="'.$idinforma.'">'.$informa.'</option>';}else{echo '<option value="">..Seleccione el contacto que se va a informar..</option>';}  
                             require '../modelo/conexion.php';
                             $consulta= "SELECT * FROM `sis_contacto`"; 
                             $result=  mysql_query($consulta); 
                             while($fila=  mysql_fetch_array($result)){ 
                                 $name=$fila['nombre_cont'].' '.$fila['apellido_cont'];
                                 $id_name=$fila['id_contacto'];  
                                 echo"<option value='".$id_name."'>".$name."</option>";   
                                 
                                 
                             }                                                            ?>    
                            </select>       
                        </div><br>         
                    </div>         
                    <div class="control-group">     
                        <label class="control-label">Telefono oficina</label>    
                        <div class="controls"><input type="text" name="telefono" value="<?php if(isset($_GET['cod'])){echo $tel1;} ?>" class="span6" placeholder="" required></div>  
                        <label></label><div class="controls"> </div>    
                        <label class="control-label">fax oficina</label>      
                        <div class="controls"><input type="text" name="fax"   value="<?php if(isset($_GET['cod'])){echo $fax;} ?>" class="span6" placeholder="" ></div>     
                        <label></label><div class="controls"> </div>     
                        <label class="control-label">Celular</label>       
                        <div class="controls"><input type="text" name="celular" value="<?php if(isset($_GET['cod'])){echo $movil;} ?>" class="span6" placeholder=" " required></div> 
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">Telefono Residencia</label>  
                        <div class="controls"><input type="text" name="tel_casa" value="<?php if(isset($_GET['cod'])){echo $tel2;} ?>" class="span6" placeholder=" " ></div>    
                        <label></label><div class="controls"> </div>     
                        <label></label><div class="controls"> </div>      
                        <label class="control-label">Telefeno Alternativo</label>   
                        <div class="controls"><input type="text" name="tel_alt" value="<?php if(isset($_GET['cod'])){echo $tel3;} ?>" class="span6" placeholder=" " ></div>    
                        <label></label><div class="controls"> </div>     
                        <label class="control-label">Nombre del asistente</label>      
                        <div class="controls"><input type="text" name="asistente" value="<?php if(isset($_GET['cod'])){echo $asistente;} ?>" class="span6" placeholder=" "></div>       
                        <label></label><div class="controls"> </div>                                             <label class="control-label">Telefeno del asistente</label>  
                        
                        <div class="controls"><input type="text" name="tel_asistente" value="<?php if(isset($_GET['cod'])){echo $tel_asist;} ?>" class="span6" placeholder=" " ></div>  
                        <label></label><div class="controls"> </div> 
                    </div>              
                    <div class="control-group">     
                        <label></label><div class="controls"> </div> 
                        <input type="hidden" name="llamada"   value="" class="span2" placeholder=""> <input type="hidden" name="campaña"   value="" class="span2" placeholder="">
                        <label></label><div class="controls"> </div>      
                        <label class="control-label">Estado</label>   
                        <div class="controls"><select name="est" class="span6" required>     
                                            <?php if(isset($_GET['cod'])){echo '<option value="'.$estado.'">'.$estado.'</option>';}
                                            else{echo '<option value="">Seleccione</option> ';} ?>   
                                <option value="Activo">Activo</option>       
                                <option value="Noactivo">No activo</option>    
                            </select></div>  
                        <label></label><div class="controls"> </div><label class="control-label">Fecha de Cumpleaño</label>  
                        <div class="controls"><input name="fecha" type="text" value="<?php if(isset($_GET['cod'])){
                            echo $fecha;} ?>" id="datepicker1" placeholder=""><span class="help-block"></span>  
                        </div>                                           
                        <label></label><div class="controls"> </div>     
                        <label></label><div class="controls"> </div><label class="control-label">Asignado a</label>         
                        <div class="controls"><select name="area" class="span2" id="area">    
                          <?php                                                        
                          if(isset($_GET['cod'])){echo '<option value="'.$area_act.'">'.$area_act.'</option>';}else{echo '<option value="">..Area..</option>';}  
                          require '../modelo/conexion.php';         
                          $consulta= "SELECT * FROM `areas`";      
                          $result=  mysql_query($consulta);     
                          while($fila=  mysql_fetch_array($result)){   
                              $area=$fila['area'];
                              echo"<option value='".$area."'>".$area."</option>";
                              }                                                   
                              ?>                
                            </select>         
                            <select name="usuario" class="span2" id="user"> 
                             <?php          
                             if(isset($_GET['cod'])){echo '<option value="'.$user.'">'.$user.'</option>';}
                             else{echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';}   
                             $consulta2= "SELECT * FROM `usuarios`"; 
                             $result2=  mysql_query($consulta2);   
                             while($fila2=  mysql_fetch_array($result2)){   
                                 $usuario=$fila2['usuario'];    
                                 echo"<option value='".$usuario."'>".$usuario."</option>"; 
                                 }    
                                 ?>          
                            </select>        
                        </div>                   
                    </div>                               
                    <div class="alert">               
                        <b>II. &nbsp; &nbsp; DIRECCIONES  </b>  
                    </div>     
                    <div class="control-group">   
                        <label class="control-label">Departamento</label>   
                        <div class="controls"><select name="departamento" id="ciudad"  class="span4">    
                                                <?php if(isset($_GET['cod'])){echo "<option value='".$dep."'>".$dep."</option>";}else{
                                                    echo "<option value=''>..Seleccione </option>"; } ?>    
                                                                                                                            
      <?php
      $consulta= "SELECT * FROM `departamentos` group by nombre_dep";   
      $result=  mysql_query($consulta); 
      while($fila=  mysql_fetch_array($result)){       
          $valor1=$fila['cod_dep'];  
          $valor2=$fila['nombre_dep'];   
          echo"<option value='".$valor2."'>".$valor2."</option>";   
          }                                                       
          ?>       
                            </select></div>
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">Municipio</label>   
                        <div class="controls"><select name="municipio"  id="municipio"  class="span4">   
                                              <?php if(isset($_GET['cod'])){
                                                  echo "<option value='".$muni."'>".$muni."</option>";}else{echo "<option value=''>Seleccione.. </option>";}
                                                  ?>           
                            </select></div>  
                        <label></label><div class="controls"> </div>    
                        <label class="control-label">Direccion de Facturacion</label>     
                        <div class="controls"><textarea name="direccion1" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $dir1;} ?></textarea></div>  
                        <label></label><div class="controls"> </div>   
                        <label class="control-label">Direccion del Envio</label>  
                        <div class="controls"><textarea name="direccion2" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $dir2;} ?></textarea></div>   
                        <label></label><div class="controls"> </div>     
                    </div>           
                    <div class="alert">     
                        <b>III. &nbsp; &nbsp; DIRECCION(es) de Mail</b>      
                    </div>                                        <div class="control-group">   
                        <label class="control-label">Email empresarial</label>      
                        <div class="controls"><input type="text" name="email1" value="<?php if(isset($_GET['cod'])){echo $ema1;} ?>" class="span6" placeholder=" " required></div>     
                        <label></label><div class="controls"> </div> 
                        <label class="control-label">Email Personal</label>      
                        <div class="controls"><input type="text" name="email2" value="<?php if(isset($_GET['cod'])){echo $ema2;} ?>" class="span6" placeholder=" " ></div>     
                        <label></label><div class="controls"> </div>   
                        <label class="control-label">Email Adicionaol</label>  
                        <div class="controls"><input type="text" name="email3" value="<?php if(isset($_GET['cod'])){echo $ema3;} ?>" class="span6" placeholder=" " ></div>  
                        <label></label><div class="controls"> </div>    
                        <label class="control-label">Informacion Adicional</label>  
                        <div class="controls"><textarea name="info" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $inf;} ?></textarea></div>     
                        <label></label><div class="controls"> </div>     
                    </div>                     
                    <div class="form-actions">   
                        <?php if(isset($_GET['cod'])){   
                             if($editar_con=='Habilitado'){          
                                 echo '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';
                                 }else{       
                                     echo '<button type="button" class="btn btn-primary">No tiene acceso para editar</button>';  
                                     }   
                                     }else{       
                                         echo '<button type="submit" class="btn btn-primary">Guardar</button>';    
                                         } ?>          
                        <a href="../vistas/?id=contactos"><button type="button" class="btn">Cancelar</button></a>     
                    </div><!--/ Form Action -->  
                </div>                           
        </section>   
</form>                        <!--/ END Form Wizard -->             
</div>
            
            