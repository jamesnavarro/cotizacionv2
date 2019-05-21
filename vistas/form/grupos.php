<?php 
if(isset($_GET['cod'])){
    $query = mysql_query("SELECT * FROM subproceso a, grupo b, pagos c where b.id_pago=c.id_pago and a.id_subpro=b.id_area and b.id_g=".$_GET['cod']." ");
    $res = mysql_fetch_array($query);
}
?>  
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">CREAR GRUPO </h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="" style="margin-bottom: 25px;">

                              

                                <div class="tab-content">
<div class="" id="tab4">

                                        <div class="row-fluid">

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/crear_grupo.php?editar='.$_GET['cod'].' ';}else{ echo '../modelo/crear_grupo.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                               <label class="control-label">Nombre de Grupo</label>

                                               <div class="controls">
                                                   <input type="text" name="grupo" value="<?php  if(isset($_GET['cod'])){ echo $res['name'];}   ?>" placeholder="Nombre del grupo" class="span12">
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Asignar Area</label>

                                               <div class="controls">
                                                   <select name="area" required>
                                                     
                                                       <?php
                                                        if(isset($_GET['cod'])){echo '<option value="'.$res['id_subpro'].'">'.$res['nombre_subpro'].'</option>';}else{echo '<option value="">Seleccione</option>';}
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `subproceso`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['nombre_subpro'];
                                                         
                                                         

                                                            echo"<option value=".$fila['id_subpro'].">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                   </select>
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Asignar Metodo de Pago</label>

                                               <div class="controls">
                                                   <select name="pago" required>
                                          
                                                       <?php
                                                         if(isset($_GET['cod'])){echo '<option value="'.$res['id_pago'].'">'.$res['desc_pago'].'</option>';}else{echo '<option value="">Seleccione</option>';}
                                                       
                                                                       require '../modelo/conexion.php';
                                                           $consulta2= "SELECT * FROM `pagos`";                     
                                                            $result2=  mysql_query($consulta2);
                                                            while($fila=  mysql_fetch_array($result2)){
                                                            $valor1=$fila['desc_pago'];
                                                         
                                                         

                                                            echo"<option value=".$fila['id_pago'].">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                   </select>
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                             

                                            
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary">Agregar</button>

                                        <a href="../vistas/?id=precios_area"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>
                                    <div class="" id="tab3">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">


<?php

$request_ac=mysql_query("SELECT * FROM subproceso a, grupo b, pagos c where b.id_pago=c.id_pago and a.id_subpro=b.id_area ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="20%">'.'Nombre del Grupo'.'</th>';             
              $table = $table.'<th width="20%">'.'Area Relacionada'.'</th>';
               $table = $table.'<th width="20%">'.'Metodo de Pago'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
                $table = $table.'<th width="5%">'.'Grupos'.'</th>';
                 $table = $table.'<th width="5%">'.'Editar'.'</th>';
              $table = $table.'<th width="5%">'.'Estado'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysql_fetch_array($request_ac))
	{           if($row['estado_gr']==0){$im = '<img src="../imagenes/ok.png">';$e = 'yes';}else{$im = '<img src="../imagenes/cancelar.png">';$e = 'no';}
              if($crear_conf=='Habilitado'){$add='<img src="../imagenes/empleado.png">';}else{$add='';}
                  if($crear_conf=='Habilitado'){$up='<img src="../imagenes/modificar.png">';}else{$up='';}
                $t = $t +1;
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="20%">'.$row['name'].'</a></td>'
                    . '<td width="20%">'.$row['nombre_subpro'].'</font></td>'
                    . '<td width="20%">'.$row['desc_pago'].'</font></td>'
                    . '<td width="10%">'.$row['fecha_reg'].'</font></td>'
                  . '<td width="10%">'.$row['register'].'</font></td>'
                    . '<td width="5%"><a href="../vistas/?id=add_user&cod='.$row['id_g'].'">'.$add.'</a> </td>'
                    . '<td width="5%"><a href="../vistas/?id=grupo&cod='.$row['id_g'].'">'.$up.'</a> </td>'
                    . '<td width="5%"><a href="../vistas/?id=grupo&'.$e.'='.$row['id_g'].'">'.$im.'</a> </td></tr>';   
           
		
               
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

                                    

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<?php
 if(isset($_GET['yes'])){
$sql = "UPDATE grupo SET estado_gr=1 WHERE id_g=".$_GET['yes']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=grupo'";
echo "</script>";
}

 if(isset($_GET['no'])){
$sql = "UPDATE grupo SET estado_gr=0 WHERE id_g=".$_GET['no']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=grupo'";
echo "</script>";
}
                        