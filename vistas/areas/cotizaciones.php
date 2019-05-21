<?php 
$request=mysql_query('select count(*) from cotizacion where estado="Cotizado"');
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
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Cotizaciones Realizadas</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                              <!-- Help Text -->
                              <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Buscar Cotizacion por cliente, asesor y por fecha</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <select  class="span8"  name="nombre" id="select2_1">
                                                 <option value=''>Seleccione el nombre del cliente...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `clientes`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['nombre_cli'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                    <select  name="user"  class="span8"   id="select2_2">
                                                    <option value=''>Usuarios...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['usuario'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                                </div>
                                                <div class="span4">
                                                    <input type="text" name="fecha"  class="span8"  id="datepicker2"  placeholder="fecha de cotizacion">
                                                    <input type="submit" class="btn" name="Buscar" value="Buscar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php
if($page>1){?>
	<a href="../vistas/?id=lista_cot&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=lista_cot&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=lista_cot&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=lista_cot&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){
    $fecha = $_POST['fecha'];
    $aa = substr($fecha, -4); 
    $dd = substr($fecha,  -7, -5); 
    $mm = substr($fecha, 0, -8); 
    if($_POST['fecha']!=''){$fecha = $aa.'-'.$mm.'-'.$dd;}
    

    $request=mysql_query("SELECT * FROM cotizacion a where  a.estado='Cotizado'  and a.id_cliente like '%".$_POST['nombre']."%' and a.fecha_reg_c like '%".$fecha."%' and a.registrado like '%".$_POST['user']."%'");
}else{
$request=mysql_query("SELECT * FROM cotizacion a where a.estado='Cotizado' ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Cotizacion No.'.'</th>';             
              $table = $table.'<th width="30%">'.'Cliente'.'</th>';
              $table = $table.'<th width="30%">'.'Nombre de la Obra'.'</th>';
              $table = $table.'<th width="15%">'.'Fecha Registro'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Asesor Ejec.'.'</th>';

              $table = $table.'<th class="hidden-phone">Ver</th>';

              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
          if($row['tipo']=='Empresarial'){
              $sql='select * from sis_empresa where id_empresa="'.$row['id_cliente'].'"';
$fil =mysql_fetch_array(mysql_query($sql));

$nombre= $fil["nombre_emp"];
          }else{
              $sql='select * from sis_contacto where id_contacto="'.$row['id_cliente'].'"';
$fil =mysql_fetch_array(mysql_query($sql));
$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];

          }
          if($ver_cot=='Habilitado'){$ver='<img src="../imagenes/ojo.png">';}else{$ver='';}
            $table = $table.'<tr><td width="5%">'.$row['id_cot'].'</a></td><td width="30%">'.$nombre.'</a></td><td width="30%">'.$row["obra"].'<font></a></td><td width="15%">'.$row["fecha_reg_c"].'<font></a></td>
               <td class="hidden-phone">'.$row["estado"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["registrado"].'</font></td>'
             
                    . '<td class="hidden-phone"><a href="../vistas/?id=new_fac&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$ver.'</a></td></tr>';   
           
		
               
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

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

                        <!-- START Form Wizard -->

                     <?php 
   

 $request=mysql_query("SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");
    
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th width="20%">'.'Nombre del Cliente'.'</th>';             
              $table = $table.'<th width="40%">'.'Direccion'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Prestamo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>
               <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}

       
                       ?>456
                       

                        <!--/ END Form Wizard -->

                    </div>

                                    </div>

                                    

                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>