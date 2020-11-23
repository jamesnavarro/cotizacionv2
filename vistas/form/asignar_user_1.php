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
$sql21 = "SELECT * FROM subproceso where id_subpro=".$_GET['cod'];
$fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
$area= $fila21["nombre_subpro"];
?>  
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Usuarios asignados en el area de "<i><?php echo $area; ?></i>"  </h4>

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

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/asignacion.php?cod='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Asignar Usuario a esta Area</label>

                                               <div class="controls">
                                                   <select name="user" required>
                                                       <option value="">Seleccione</option>
                                                       <?php
                                                          require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios` where area='Produccion'";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['nombre'].' '.$fila['apellido'];
                                                         
                                                         

                                                            echo"<option value=".$fila['id_user'].">".$valor1."</option>";
                                                            
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
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

$request_ac=mysqli_query($conexion,"SELECT * FROM asignacion a, usuarios b where a.id_user=b.id_user and a.id_area=".$_GET['cod']." ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="40%">'.'Nombre'.'</th>';             
              $table = $table.'<th width="20%">'.'Usuario'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
              $table = $table.'<th width="10%">'.'Borrar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
                $t = $t +1;
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="40%">'.$row['nombre'].' '.$row['apellido'].'</a></td>'
                    . '<td width="20%">'.$row['usuario'].'</font></td>'
                    . '<td width="10%">'.$row['registro'].'</font></td>'
                  . '<td width="10%">'.$row['por'].'</font></td>'
                    . '<td width="10%"><a href="../vistas/?id=add_user&delU='.$row['id_asig'].'"><img src="../imagenes/eliminar.png"></a> </td></tr>';   
           
		
               
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
 if(isset($_GET['delU'])){
$sql = "DELETE FROM asignacion WHERE id_asig=".$_GET['delU']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=precios_area'";
echo "</script>";
}
                        