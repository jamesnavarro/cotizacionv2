<?php if(isset($_GET['cod'])){require '../modelo/consultar_empresa.php'; } ?>
<div class="row-fluid">           
    <!-- START Form Wizard -->    
    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/empresa_add.php?editar='.$_GET['cod'].'';}else{echo '../modelo/empresa_add.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">     
        <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar empresa';}else{echo 'Agregar nueva empresa';} ?></h4></header>         
        <section class="body">        
            <div class="body-inner">  
                <div class="alert">      
                    <b>I. &nbsp; &nbsp; INFORMACION DE LA EMPRESA</b>  
                </div>                       
                <div class="control-group">         
                    <label class="control-label">Nombre</label>        
                    <div class="controls">
                        <input type="text" name="nombre_emp" value="<?php if(isset($_GET['cod'])){echo $nombre_emp;} ?>" class="span6" placeholder="razon social" required>
                    </div>     
                    <label></label><div class="controls"> </div>  
                    <label class="control-label">Web</label>   
                    <div class="controls"><input type="text" name="web"   value="<?php if(isset($_GET['cod'])){echo $nombre_emp;} ?>" class="span6" placeholder="" static required></div>  
                    <label></label><div class="controls"> </div>    
                    <label class="control-label">Nombre comercial</label>    
                    <div class="controls"><input type="text" name="simbolo" value="<?php if(isset($_GET['cod'])){echo $simbolo;} ?>" class="span6" placeholder=" " ></div>    
                    <label></label><div class="controls"> </div>    
                    <label class="control-label">miembro de</label>     
                    <div class="controls"><input type="text" name="miembro" value="<?php if(isset($_GET['cod'])){echo $miembro;} ?>" class="span6" placeholder=" "></div>  
                    <label></label><div class="controls"> </div> 
                    <label class="control-label">Propietario</label>  
                    <div class="controls"><input type="text" name="propietario" value="<?php if(isset($_GET['cod'])){echo $propietario;} ?>" class="span6" placeholder=" " ></div>  
                    <label class="control-label">Descuento en Vidrio %:</label>  
                    <div class="controls"><input type="text" name="porcvi" value="<?php if(isset($_GET['cod'])){echo $pvi;} ?>" class="span2" placeholder="Porcentaje especial" ></div>  
                     <label class="control-label">Descuento en Aluminio %:</label>  
                    <div class="controls"><input type="text" name="porcal" value="<?php if(isset($_GET['cod'])){echo $pal;} ?>" class="span2" placeholder="Porcentaje especial" ></div> 
                     <label class="control-label">Descuento en Acero %:</label>  
                    <div class="controls"><input type="text" name="porcac" value="<?php if(isset($_GET['cod'])){echo $pac;} ?>" class="span2" placeholder="Porcentaje especial" ></div> 
                    <label></label><div class="controls"> </div>  
                    <label class="control-label">Industria</label>    
                    <div class="controls"><select name="industria" class="span6">    
                                           
   <?php if(isset($_GET['cod'])){echo '<option value="'.$industria.'">'.$industria.'</option>';}else{echo '<option value=" ">Seleccione.. </option>';} ?>    
                            <option value="Metales">Metales</option>    
                            <option value="Tecnologia">Tecnologia</option>    
                            <option value="Industrial">Industrial</option>   
                            <option value="Salud">Salud</option>           
                            <option value="Comercial">Comercial</option>      
                            <option value="Textil">Textil</option>     
                            <option value="Bancaria">Bancaria</option> 
                            <option value="Construccion">Construccion</option>   
                            <option value="Educacion">Educacion</option>         
                            <option value="Entretenimiento">Entretenimiento</option>  
                            <option value="Gobierno">Gobierno</option>     
                            <option value="Seguros">Seguros</option>                 
                            <option value="Ingenieria">Ingenieria</option> 
                            <option value="Vehiculos">Vehiculos</option>       
                        </select></div>                          
                    <label></label><div class="controls"> </div>     
                    <label class="control-label">Tipo</label>        
                    <div class="controls"><select name="tipo" class="span6">     
                                                <?php if(isset($_GET['cod'])){echo '<option value="'.$tipo.'">'.$tipo.'</option>';}else{echo '<option value=" ">Seleccione.. </option>';} ?> 
                            <option value="Analista">Analista</option>      
                            <option value="Competidor">Competidor</option> 
                            <option value="Cliente">Cliente</option>   
                            <option value="Integrador">Integrador</option>        
                            <option value="Inversor">Inversor</option>          
                            <option value="Partner">Partner</option>         
                            <option value="Prensa">Prensa</option>         
                            <option value="Prospecto">Prospecto</option>      
                            <option value="Revendedor">Revendedor</option>   
                            <option value="Otro">Otro</option>   
                        </select></div>   
                    <label></label><div class="controls"> </div><label class="control-label">Asignado a</label>         
                    <div class="controls"><select name="area" class="span2" id="area">     
                         <?php                        
                         if(isset($_GET['cod'])){echo '<option value="'.$area_act.'">'.$area_act.'</option>';}else{echo '<option value="">..Area..</option>';} 
                         require '../modelo/conexion.php';  
                         $consulta= "SELECT * FROM `areas`";       
                         $result=  mysqli_query($conexion,$consulta);     
                         while($fila=  mysqli_fetch_array($result)){   
                             $area=$fila['area'];             
                             echo"<option value='".$area."'>".$area."</option>";  
                             }         
                             ?>        
                        </select>         
                        <select name="usuario" class="span2" id="user">    
                          <?php            
                          if(isset($_GET['cod'])){echo '<option value="'.$usuario.'">'.$usuario.'</option>';}
                          else{echo '<option value="'.$_SESSION['k_username'].'">'.$_SESSION['k_username'].'</option>';}  
                          $consulta2= "SELECT * FROM `usuarios`";  
                          $result2=  mysqli_query($conexion,$consulta2);  
                          while($fila2=  mysqli_fetch_array($result2)){   
                              $usuario=$fila2['usuario'];       
                              echo"<option value='".$usuario."'>".$usuario."</option>";  
                              }               
                              ?>                
                        </select>               
                    </div>                       
                    <label></label><div class="controls"> </div>    
                </div>                                
                <div class="control-group">                        
                    <label class="control-label">Telefono oficina</label>        
                    <div class="controls">
                        <input type="text" name="telefono_emp" value="<?php if(isset($_GET['cod'])){echo $te1;} ?>" class="span6" placeholder="razon social" required></div> 
                    <label></label><div class="controls"> </div>      
                    <label class="control-label">fax oficina</label> 
                    <div class="controls"><input type="text" name="fax_emp"   value="<?php if(isset($_GET['cod'])){echo $fax1;} ?>" class="span6" placeholder="" ></div> 
                    <label></label><div class="controls"> </div>  
                    <label class="control-label">Celular</label>  
                    <div class="controls"><input type="text" name="celular_emp" value="<?php if(isset($_GET['cod'])){echo $cel_emp;} ?>" class="span6" placeholder=" " ></div> 
                    <label></label><div class="controls"> </div>           
                    <label class="control-label">Emplados</label>         
                    <div class="controls"><input type="text" name="empleado" value="<?php if(isset($_GET['cod'])){echo $empleados;} ?>" class="span6" placeholder=" " ></div>    
                    <label></label><div class="controls"> </div>  
                    <label class="control-label">Puntaje</label>   
                    <div class="controls"><select name="puntaje" class="span6">     
                                                 <?php if(isset($_GET['cod']))
                                                     {echo '<option value="'.$puntaje.'">'.$puntaje.'</option>';}else{echo '<option value=" ">de 1 al 10</option> ';} ?>  
                            <option value="1">1</option>          
                            <option value="2">2</option>      
                            <option value="3">3</option>     
                            <option value="4">4</option>   
                            <option value="5">5</option>  
                            <option value="6">6</option>  
                            
                            <option value="7">7</option>   
                            <option value="8">8</option>   
                            <option value="8">9</option>    
                            <option value="10">10</option>  
                        </select></div> 
                    <label></label><div class="controls"> </div>   
                    <label class="control-label">Nit</label>     
                    <div class="controls"><input type="text" name="nit" value="<?php if(isset($_GET['cod'])){echo $nit;} ?>" class="span6" placeholder=" " ></div>  
                    <label></label><div class="controls"> </div>          
                    <label class="control-label">Ingresos</label>      
                    <div class="controls"><input type="text" name="ingreso" value="<?php if(isset($_GET['cod'])){echo $ingre;} ?>" class="span6" placeholder=" " ></div>           
                    <label></label><div class="controls"> </div>  
                </div>                                     
                <div class="alert">        
                    <b>II. &nbsp; &nbsp; DIRECCIONES  </b>    
                </div>                 
                <div class="control-group">          
                    <label class="control-label">Departamento</label>  
                    <div class="controls">               
                        <select name="departamento_emp" id="ciudad"  class="span4">       
                                             <?php if(isset($_GET['cod'])){echo "<option value='".$depa."'>".$depa."</option>";}else{echo "<option value=''>..Seleccione </option>"; } ?>
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
                    <label></label><div class="controls"> </div>   
                    <label class="control-label">Municipio</label> 
                    <div class="controls"><select name="municipio_emp"  id="municipio"  class="span4">       
                                          <?php if(isset($_GET['cod'])){echo "<option value='".$munici."'>".$munici."</option>";}else{echo "<option value=''>Seleccione.. </option>";} ?> 
                        </select></div>     
                    <label></label><div class="controls"> </div>    
                    <label class="control-label">Direccion de Facturacion</label>    
                    <div class="controls"><textarea name="direccion_emp" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $dire1;} ?></textarea></div>   
                    <label></label><div class="controls"> </div>    
                    <label class="control-label">Direccion del Envio</label>
                    <div class="controls"><textarea name="direccion_emp1" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $dire2;} ?></textarea></div>    
                    <label></label><div class="controls"> </div> 
                </div>                     
                <div class="alert">            
                    <b>III. &nbsp; &nbsp; DIRECCION(es) de Mail</b>     
                </div>                                   
                <div class="control-group">                        
                    <label class="control-label">Email empresarial</label>   
                    <div class="controls"><input type="text" name="email_emp1" value="<?php if(isset($_GET['cod'])){echo $emai1;} ?>" class="span6" placeholder=" " required></div>  
                    <label></label><div class="controls"> </div> 
                    <label class="control-label">Email Personal</label>  
                    <div class="controls"><input type="text" name="email_emp2" value="<?php if(isset($_GET['cod'])){echo $emai2;} ?>" class="span6" placeholder=" "></div>   
                    <label></label><div class="controls"> </div>                                                                                      
                    <label class="control-label">Email Adicional</label>   
                    <div class="controls"><input type="text" name="email_emp3" value="<?php if(isset($_GET['cod'])){echo $emai3;} ?>" class="span6" placeholder=" "></div>   
                    <label></label><div class="controls"> </div>            
                    <label class="control-label">Informacion Adicional</label> 
                    <div class="controls"><textarea name="inf_emp" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $info;} ?></textarea></div>    
                    <label></label><div class="controls"> </div>     
                </div>                               
                <div class="form-actions">           
                                                      
               <?php if(isset($_GET['cod'])){                          
                   if($editar_emp=='Habilitado'){                      
                       echo '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';   
                       }else{                                            
                           echo '<button type="button" class="btn btn-primary">No tiene acceso para editar</button>';   
                           }                                                                                 
                           }else{          
                               echo '<button type="submit" class="btn btn-primary">Guardar</button>';    
                               } ?>                              
                    <a href="../vistas/?id=empresas"><button type="button" class="btn">Cancelar</button></a>   
                </div><!--/ Form Action -->                      
            </div>                            </section>           
    </form>                        <!--/ END Form Wizard -->         
</div>