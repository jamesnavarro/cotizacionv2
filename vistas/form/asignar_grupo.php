<?php 
$request=mysql_query('select count(*) from asignacion');
if($request){
	$request = mysql_fetch_row($request);
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
$fila21 =mysql_fetch_array(mysql_query($sql21));
 $area= $fila21["nombre_subpro"]; $sede= $fila21["sede_sub"];
?>  
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">ASIGNACION DE GRUPOS AL AREA DE  "<i><?php echo $area; ?> </i>"  </h4>

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

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/asignacion_al_grupo_1.php?cod='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Asignar Grupos</label>

                                               <div class="controls">
                                                   <select name="grupo" required>
                                                       <option value="">Seleccione</option>
                                                       <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `grupo` where sede='".$sede."' and id_area=".$_GET['cod']." ";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['name'];
                                                         
                                                         

                                                            echo"<option value=".$fila['id_g'].">".$valor1."</option>";
                                                            
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

$request_ac=mysql_query("SELECT * FROM subproceso a, asignacion_grupo b, grupo c where c.id_g=b.id_g and a.id_subpro=b.id_area and b.id_area=".$_GET['cod']." ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="25%">'.'Nombre de Grupo'.'</th>';             
              $table = $table.'<th width="10%">'.'Sede'.'</th>';
              $table = $table.'<th width="15%">'.'Fecha de Modificacion'.'</th>';
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
              $table = $table.'<th width="5%">'.'Estado'.'</th>';
               $table = $table.'<th width="5%">'.'Trabajos'.'</th>';
              $table = $table.'<th width="5%">'.'Activos'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
        
	while($row=mysql_fetch_array($request_ac))
	{       
                $t = $t +1;
                if($row['est']==0){$im = '<img src="../imagenes/ok.png">';$e = 'yes';}else{$im = '<img src="../imagenes/cancelar.png">';$e = 'no';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="25%">'.$row['name'].'</a></td>'
               
                    . '<td width="10%">'.$row['sede'].'</font></td>'
                  . '<td width="15%">'.$row['registro'].'</font></td><td width="15%">'.$row['por'].'</font></td><td width="5%">'.$im.'</font></td>'
                    . '<td width="5%"><a href="../vistas/?id=trabajos_realizados_grupo&grupo='.$row['id_asig_grupo'].'"><img src="../images/empresas.png"></a> </td>'
                    . '<td width="5%"><a href="../vistas/?id=add_grupo&'.$e.'='.$row['id_asig_grupo'].'&cod='.$_GET['cod'].'"><img src="../imagenes/modificar.png"></a> </td></tr>';   
           
		
               
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
$sql = "UPDATE asignacion_grupo SET est=1   WHERE id_asig_grupo=".$_GET['yes']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_grupo&cod=".$_GET['cod']." '";
echo "</script>";
}
   if(isset($_GET['no'])){
$sql = "UPDATE asignacion_grupo SET est=0  WHERE id_asig_grupo=".$_GET['no']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_grupo&cod=".$_GET['cod']." '";
echo "</script>";
}                     