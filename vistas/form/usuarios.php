 <?php require '../modelo/conexion.php';
 if(isset($_GET['cod'])){
     $sql='select a.*,(c.nombre) as empresa,b.nombre_r from usuarios a, roles b,inf_empresa c where a.id_roles=b.id_roles and a.id_empresa = c.id_emp and a.id_user="'.$_GET['cod'].'"';
     $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
     $u_usuario= $fil["usuario"];  
     $u_password= $fil["password"];  
     $u_cedula= $fil["cedula"];    
     $u_email= $fil["email"];  
     $u_administrador= $fil["administrador"];  
     $u_nombre= $fil["nombre"];   
     $u_apellido= $fil["apellido"];    
     $u_estado= $fil["estado"];   
     $u_cargo= $fil["cargo"];    
     $u_area= $fil["area"]; 
     $id_empresa= $fil["id_empresa"]; 
     $empresa= $fil["empresa"]; 
     $u_telefono= $fil["telefono"];  
     $u_celular= $fil["celular"];    
     $u_direccion= $fil["direccion"]; 
     $u_ciudad= $fil["ciudad"];      
     $u_municipio= $fil["municipio"];    
     $u_sede= $fil["sede"];     
     $id_rol= $fil["id_roles"];     
     $roles= $fil["nombre_r"];     
     }  ?>
<div class="row-fluid">   
    <!-- START Form Wizard -->                      
    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/usuario.php?editar='.$_GET['cod'].'';}else{echo '../modelo/usuario.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">       
        <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Usuario';}else{echo 'Nuevo Usuario';} ?></h4></header>  
        <div class="body-inner">       
            <br>                       
            <div class="alert">         
                <b>I. &nbsp; &nbsp; INFORMACION DEL USUARIO</b>   
            </div>                                
            <div class="control-group">           
                <label class="control-label">Usuario</label>   
                <div class="controls">  
                    <input type="text" name="user" value="<?php if(isset($_GET['cod'])){echo $u_usuario;} ?>" class="span4" placeholder="Digite el nombre del usuario" required>    
                    <input type="password" name="clave"  value=""  class="span2" placeholder="Generar Password">   
                </div>                                                                                      
                <label></label><div class="controls"> </div>           
                <label class="control-label">Nombres</label>             
                <div class="controls"><input type="text" name="nombre"  value="<?php if(isset($_GET['cod'])){echo $u_nombre;} ?>" class="span6" placeholder="Digite el primer y segundo nombre" static required></div>
                
                
                <label></label><div class="controls"> </div> 
                <label class="control-label">Apellidos</label>   
                <div class="controls"><input type="text" name="apellido" value="<?php if(isset($_GET['cod'])){echo $u_apellido;} ?>" class="span6" placeholder="Digite el primer y segundo apellido" required>                                                                                         </div>      
                <label></label><div class="controls"> </div>        
                <label class="control-label">Cedula</label>       
                <div class="controls"><input type="text" name="cedula" value="<?php if(isset($_GET['cod'])){echo $u_cedula;} ?>" class="span6" placeholder="Digite la cedula" >    
                </div>                                                                                         
                <label></label><div class="controls"> </div>                                
                <label class="control-label">Email</label>                                            
                <div class="controls"><input type="text" name="email" value="<?php if(isset($_GET['cod'])){echo $u_email;} ?>" class="span6" placeholder="Digite el email" required>  
                </div>
                <label></label><div class="controls"> </div>                                            
                <label class="control-label">Empresa</label>      
                <div class="controls">                                                
                    <select name="empresa">  
                    <?php 
                        if(isset($_GET['cod'])){
                            echo "<option value='".$id_empresa."'>".$empresa."</option>";
                        $consulta= "SELECT * FROM inf_empresa where id_emp <> '".$id_empresa."'";
                        }else{
                            echo "<option value=''>Seleccione Empresa</option>"; 
                        $consulta= "SELECT * FROM inf_empresa";
                        } 
                    ?>    
                    <?php      
                        $result=  mysqli_query($conexion,$consulta);                                
                            while($fila=  mysqli_fetch_array($result)){                 
                            $valor1=$fila['id_emp'];      
                            $valor2=$fila['nombre'];      
                            echo"<option value='".$valor1."'>".$valor2."</option>";   
                        }                                                            
                    ?>                                                
                    </select>   
                </div>   
                <label></label><div class="controls"> </div>                                            
                <label class="control-label">Administrador ?</label>      
                <div class="controls">                                                
                    <select name="admin">                                                    
                    <?php if(isset($_GET['cod'])){echo '<option value="'.$u_administrador.'">'.$u_administrador.'</option>';} ?>   
                        <option value="No">No</option>                                                    
                        <option value="Si">Si</option>                                                
                    </select>   
                </div>                                                                                     <label></label><div class="controls"> </div>                                         <label></label><div class="controls"> </div>     
                <label class="control-label">Roles</label>                                            <div class="controls">                                                <select name="rol" required>                          
                         <?php if(isset($_GET['cod'])){echo "<option value='".$id_rol."'>".$roles."</option>";}else{echo "<option value=''>.:Seleccione:.</option>"; } ?>           
                                                       <?php                                                                                                                       
                                                       include "../modelo/conexion.php";                                                           $consulta= "SELECT * FROM roles";   
                                                       $result=  mysqli_query($conexion,$consulta);                                                            while($fila=  mysqli_fetch_array($result)){    
                                                           $valor1=$fila['id_roles'];                                                            $valor2=$fila['nombre_r'];          
                                                           echo"<option value=".$valor1.">".$valor2."</option>";                                                                                                                        }
                                                           ?>                                                </select>                                                                                         </div>    
                <label></label><div class="controls"> </div>                                            <label class="control-label">Cargo</label>                                            <div class="controls">    
                    <select name="cargo" required>                                                   <?php if(isset($_GET['cod'])){echo "<option value='".$u_cargo."'>".$u_cargo."</option>";}else{echo "<option value=''>.:Seleccione:.</option>"; } ?>  
                                                                <?php                                                                                                                                       include "../modelo/conexion.php";    
                                                                $consulta= "SELECT * FROM cargos";                                                                                 $result=  mysqli_query($conexion,$consulta);   
                                                                while($fila=  mysqli_fetch_array($result)){                                                            $valor1=$fila['id_cargo'];    
                                                                $valor2=$fila['nombre_cargo'];                                                            echo"<option value=".$valor2.">".$valor2."</option>";   
                                                                }                                                            ?>                                                </select>    
                </div>                                                                                         <label></label><div class="controls"> </div>                                
                <label class="control-label">Area de Trabajado</label>                                            <div class="controls">                                               <select name="area" required>  
                                                 <?php if(isset($_GET['cod'])){echo "<option value='".$u_area."'>".$u_area."</option>";}else{echo "<option value=''>.:Seleccione:.</option>"; } ?>        
                                                          <?php                                                                                                                                       include "../modelo/conexion.php"; 
                                                          $consulta= "SELECT * FROM areas";                                                                                 $result=  mysqli_query($conexion,$consulta);        
                                                          
                                                          while($fila=  mysqli_fetch_array($result)){                                                            $valor1=$fila['id'];    
                                                          $valor2=$fila['area'];                                                            echo"<option value=".$valor2.">".$valor2."</option>";
                                                          }                                                            ?>                                                </select>        
                </div>                                            <label></label><div class="controls"> </div>                                            <label class="control-label">Telefono</label>   
                <div class="controls"><input type="text" name="telefono" value="<?php if(isset($_GET['cod'])){echo $u_telefono;} ?>" class="span6" placeholder=" " ></div>        
                <label></label><div class="controls"> </div>                                            <label class="control-label">Celular</label>          
                <div class="controls"><input type="text" name="celular" value="<?php if(isset($_GET['cod'])){echo $u_celular;} ?>" class="span6" placeholder=" "></div>  
                <label></label><div class="controls"> </div>                                                              </div>                               
            <div class="alert">                                             <b>II. &nbsp; &nbsp;DIRECCION PRINCIPAL</b>                                        </div>    
            <div class="control-group">                                                                                            <label class="control-label">Direccion</label>  
                <div class="controls"><textarea name="direccion" class="span6" rows="4"><?php if(isset($_GET['cod'])){echo $u_direccion;} ?></textarea></div>    
                <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Departamento</label>   
                <div class="controls"><select name="ciudad" id="ciudad"  class="span4">                   
                    <?php if(isset($_GET['cod'])){echo "<option value='".$u_ciudad."'>".$u_ciudad."</option>";}else{echo "<option value=''>..Seleccione</option>"; } ?>    
                                                                                                                                  <?php      
                                                                                                                                  $consulta= "SELECT * FROM `departamentos` group by nombre_dep";  
                                                                                                                                  $result=  mysqli_query($conexion,$consulta);                                
                                                                                                                                  while($fila=  mysqli_fetch_array($result)){                 
                                                                                                                                      $valor1=$fila['cod_dep'];      
                                                                                                                                      $valor2=$fila['nombre_dep'];      
                                                                                                                                      echo"<option value='".$valor2."'>".$valor2."</option>";   
                                                                                                                                      }                                                            ?>  
                    </select>       
                </div>                                           
                <label></label><div class="controls"> </div>   
                    <label class="control-label">Municipio</label> 
                    <div class="controls">
                        <select name="municipio"  id="municipio"  class="span4">   
                            
                                        <?php if(isset($_GET['cod'])){echo "<option value='".$u_municipio."'>".$u_municipio."</option>";}else{echo "<option value=''>Seleccione.. </option>";} ?>    
                            
                        </select>          
                    </div>                                                                  
            </div>    
            <div class="alert">     
                <b>III. &nbsp; &nbsp;OTROS DATOS </b> 
            </div>                            
            <div class="control-group">                                                                                                               
                
                <label class="control-label">Sede</label>      
                <div class="controls"><input type="text" name="sede" value="<?php if(isset($_GET['cod'])){echo $u_sede;} ?>" class="span6" placeholder=" " >  
                    
                </div>                                          
                <label class="control-label">Estado</label>      
                <div class="controls"><select name="estado">       
                        
      <?php if(isset($_GET['cod'])){echo '<option value="'.$u_estado.'">'.$u_estado.'</option>';} ?>  
                        <option value="Activo">Activo</option> 
                        
      <option value="No Activo">No Activo</option>  
                    </select>           
                </div> 
            </div>   
        </div>      
        <!-- Form Action -->     
        <div class="form-actions">
            
                <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar Cambios';}else{echo 'Guardar';} ?></button>                                  
                <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->          </form>  
                
</div>                                                          <!--/ END Form Wizard --></div><br><br>