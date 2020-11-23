<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_contacto.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Informacion del Contacto</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre del contacto:</b><?php  echo $nombre.' '. $apellido;  ?></li>
                                                <b>Empresa </b>:<?php
                                                 $sql1 = "SELECT * FROM sis_empresa where id_empresa=".$idemp."";
                                                $fila1 =mysqli_fetch_array(mysqli_query($conexion,$sql1));
                                                $id_cliente = $fila1["id_empresa"];$nombre_cli = $fila1["nombre_emp"];
                                                 echo '<a href="../vistas/?id=ver_empresa&cod='.$id_cliente.'">'.$nombre_cli.'</a>';  ?>
                                                <li><b>Toma de Contacto:</b><?php  echo $toma;  ?></li>
                                                <li><b>Campaña :</b><?php  echo $camp;  ?> </li>
                                                <li><b>Cargo :</b><?php  echo $cargo;  ?></li>
                                                <li><b>Departamento :</b><?php  echo $departamento;  ?></li>
                                                 <b>Informa a :</b><?php echo '<a href="../vistas/?id=ver_contacto&cod='.$idinforma.'">'.$informa.'</a>'; ?>
                                                 
                                                 <li><b><?php  echo $llamar;  ?>llamar:</b></li>
                                                 <li><b>Asignado a :</b><?php  echo $user;  ?></li>
                                                 <li><b>Fecha de Modificacion:</b><?php  echo $registro_m;  ?></li>
                                                 
                                                 
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Telefeno oficina:</b><?php  echo $tel1;  ?></li>
                                                <li><b>Movil:</b><?php  echo $movil;  ?></li>
                                                <li><b>Telefono casa:</b><?php  echo $tel1;  ?></li>
                                                <li><b>Telefeno Alt.:</b><?php  echo $tel2;  ?></li>
                                                <li><b>Fax:</b><?php  echo $fax;  ?></li>
                                                <li><b>Fecha de Cumpleaño:</b><?php  echo $fecha;  ?></li>
                                                
                                                <li><b>Asistente :</b><?php  echo $asistente;  ?></li>
                                                <li><b>tel. asistente:</b><?php  echo $tel_asist;  ?></li>
                                                 <li><b>Direccion Alt.:</b><?php  echo $dir2;  ?></li>
                                                <li><b>Fecha de Registro:</b><?php  echo $registro;  ?></li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                 <li><b>Tipo de Contacto:</b><font color="blue"><?php  echo $tipo;  ?></font></li>
                                                 <li><b>Direccion Principal :</b><?php  echo $dir1;  ?></li>
                                                <li><b>Email </b>:<?php  echo $ema1;  ?></li>
                                                <li><b>% de Descuento en Vidrio </b>: <font color="red"><?php  echo $pvi.'%';  ?></font></li>
                                                <li><b>% de Descuento en Aluminio</b>: <font color="red"><?php  echo $pal.'%';  ?></font></li>
                                                <li><b>% de Descuento en Acero</b>: <font color="red"><?php  echo $pac.'%';  ?></font></li>
                                                <li><b>Detalle </b>:<?php  echo $inf;  ?></li>
                                                <?php
                                                    if($editar_con == 'Habilitado'){ ?>
                                                        <a href="../vistas/?id=contacto&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                    <?php }else{
                                                        
                                                    }
                                                    if($eliminar_con == 'Habilitado'){ ?>
                                                         <a href="../vistas/?id=contactos&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                                    <?php }else{
                                                        
                                                    }
                                                ?>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/contactos.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
 <?php
 if(isset($_GET['cod'])){
//require '../vistas/contactos/actividades.php';
//require '../vistas/contactos/soporte.php';
//require '../vistas/contactos/otros.php';
 }
  
                                if(isset($_GET['cod'])){
$request=mysqli_query($conexion,'select count(*) from cotizacion where id_cliente='.$_GET['cod']);
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
?>  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Cotizaciones Realizadas por Cliente</h4>
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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Cotizaciones</a></li>
                                  
                                  
                                </ul>
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
   
$request=mysqli_query($conexion,"SELECT * FROM cotizacion a, clientes c where  a.id_cliente=c.id_cli and a.id_cliente='".$_GET['cod']."' ".$limit);
    
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Cotizacion No.'.'</th>';             
              $table = $table.'<th width="40%">'.'Cliente'.'</th>';
              $table = $table.'<th width="40%">'.'Nombre de la Obra'.'</th>';
              $table = $table.'<th width="30%">'.'Fecha Registro'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=new_fac&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$row['id_cot'].'</a></td><td width="10%">'.$row['nombre_cli'].'</font></td><td width="30%">'.$row["obra"].'<font></a></td><td width="30%">'.$row["fecha_reg_c"].'<font></a></td>
               <td class="hidden-phone">'.$row["estado"].'</font></td><td class="hidden-phone">'.$row["registrado"].'</font></td></tr>';   
           
		
               
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
   
 $request=mysqli_query($conexion,"SELECT * FROM prestamo a, sis_contacto b where a.id_cliente=b.id_contacto");
    
     
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
	while($row=mysqli_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>
               <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
        
     
}
                                }
       
                       ?>
                       
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