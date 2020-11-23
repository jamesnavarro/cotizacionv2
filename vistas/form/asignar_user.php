<?php 
$request=mysqli_query($conexion,'select count(*) from asignacion');
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$sql21 = "SELECT * FROM subproceso a, grupo b where a.id_subpro=b.id_area and id_g=".$_GET['cod'];
$fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
$grupo= $fila21["name"]; $area= $fila21["nombre_subpro"];$sede_area= $fila21["sede_sub"];
?>  
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Nombre del Grupo:  "<i><?php echo $grupo; ?></i>"  del area de  "<i><?php echo $area; ?> </i>"  </h4>

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

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/asignacion_al_grupo.php?cod='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Asignar Usuario a esta Area</label>

                                               <div class="controls">
                                                   <select name="user" required id="select2_1">
                                                       <option value="">Seleccione</option>
                                                       <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios` where area='Produccion'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['cedula'].' '.$fila['nombre'].' '.$fila['apellido'];
                                                         
                                                         

                                                            echo"<option value=".$fila['id_user'].">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                   </select>
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                             
                                             

                                            
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary">Agregar</button>

                                        <a href="../vistas/?id=grupo"><button type="button" class="btn">Cancelar</button></a>

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
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

$request_ac=mysqli_query($conexion,"SELECT * FROM subproceso a, grupo b, grupo_det c, usuarios d where d.id_user=c.id_user and b.id_g=c.id_g and a.id_subpro=b.id_area and b.id_g=".$_GET['cod']." ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="25%">'.'Nombre'.'</th>';             
              $table = $table.'<th width="20%">'.'Usuario'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th width="15%">'.'Fecha de Modificacion'.'</th>';
              $table = $table.'<th width="10%">'.'Cargo'.'</th>';
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
              $table = $table.'<th width="5%">'.'Estado'.'</th>';
               $table = $table.'<th width="5%">'.'Trabajos'.'</th>';
              $table = $table.'<th width="5%">'.'Activos'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
                $t = $t +1;
                if($row['est']==0){$im = '<img src="../imagenes/ok.png">';$e = 'yes';}else{$im = '<img src="../imagenes/cancelar.png">';$e = 'no';}
                if($sede_area=='Vidrio'){
                    $work = '<a href="../vistas/?id=trabajos_realizados&user='.$row['id_user'].'&cod='.$_GET['cod'].'"><img src="../images/empresas.png"></a>';
                }else{
                    $work = '<a href="../vistas/?id=trabajos_realizados_otro&user='.$row['id_user'].'&cod='.$_GET['cod'].'"><img src="../images/empresas.png"></a>';
                }
                $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="25%">'.$row['nombre'].' '.$row['apellido'].'</a></td>'
                    . '<td width="20%">'.$row['usuario'].'</font></td>'
                    . '<td width="10%">'.$row['fecha_ingreso'].'</font></td>'
                  . '<td width="15%">'.$row['fecha_mod'].'</font><td width="15%">'.$row['cargo'].'</font></td><td width="15%">'.$row['ingresado_por'].'</font></td><td width="5%">'.$im.'</font></td>'
                    . '<td width="5%">'.$work.' </td>'
                    . '<td width="5%"><a href="../vistas/?id=add_user&'.$e.'='.$row['id_gd'].'&cod='.$_GET['cod'].'"><img src="../imagenes/modificar.png"></a> </td></tr>';   
           
		
               
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
$sql = "UPDATE grupo_det SET est=1   WHERE id_gd=".$_GET['yes']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_user&cod=".$_GET['cod']." '";
echo "</script>";
}
   if(isset($_GET['no'])){
$sql = "UPDATE grupo_det SET est=0  WHERE id_gd=".$_GET['no']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_user&cod=".$_GET['cod']." '";
echo "</script>";
}                     