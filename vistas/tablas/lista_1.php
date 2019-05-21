<?php 
$request=mysql_query('select count(*) from clientes');
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
?> 
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Mantenimiento de Creación de Ventanas</h4>

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
                                <br>
                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Clientes</a></li>

                                  
                                

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->
  <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="row-fluid">
                                        <center> <select class="span4" id="select2_3" name="nombre">
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
                                            <input type="text" name="fecha"  class="span2"  placeholder="# de documento">
                                            <select name="user" class="span2">
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
                                            </select><input type="submit" class="btn" name="Buscar" value="Buscar"></center>
                                    </div></form><br>
                    <div class="row-fluid">
                        

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

 <?php
if($page>1){?>
	<a href="../vistas/?id=lista_cli&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=lista_cli&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=lista_cli&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=lista_cli&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){

    $request=mysql_query("SELECT * FROM clientes  where nombre_cli like '%".$_POST['nombre']."%' and cedu_nit like '%".$_POST['fecha']."%' and registrado_por like '%".$_POST['user']."%'");
}else{
$request=mysql_query("SELECT * FROM clientes ".$limit);
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
             $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Items'.'</th>'; 
              $table = $table.'<th width="10%">'.'Doc. No.'.'</th>';
              $table = $table.'<th width="30%">'.'Nombre del cliente'.'</th>';
              $table = $table.'<th width="10%">'.'Telefono'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Direccion'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="10%"><a href="../vistas/?id=new_cli&cod='.$row['id_cli'].'">'.$row['id_cli'].'</a></td><td width="10%">'.$row["cedu_nit"].'<font></a></td><td width="30%"><a href="../vistas/?id=new_cli&cod='.$row['id_cli'].'">'.$row['nombre_cli'].'</a></td><td width="10%">'.$row["telefono_cli"].'<font></a></td>
               <td class="hidden-phone">'.$row["direccion_cli"].'</font></td><td class="hidden-phone">'.$row["registrado_por"].'</font></td></tr>';   
           
		
               
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
              $table = $table.'<tr bgcolor="#D1EEF0">';
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