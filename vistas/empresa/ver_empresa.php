<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_empresa.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Informacion de la Empresa</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre de la Empresa:</b><?php  echo $nombre_emp;  ?></li>
                                                <li><b>Nit :</b><?php  echo $nit;  ?></li>
                                                <li><b>Web:</b><?php  echo $web_empe;  ?></li>
                                                <li><b>Simbolo :</b><?php  echo $simbolo;  ?> </li>
                                                <li><b>Propietario :</b><?php  echo $propietario;  ?></li>
                                                <li><b>Industria :</b><?php  echo $industria;  ?></li>
                                                 <li><b>Tipo :</b><?php  echo $tipo;  ?></li>
                                                 <li><b>Empleados:</b><?php  echo $empleados;  ?></li>
                                                 <li><b>Rating:</b><?php  echo $puntaje;  ?></li>
                                                 <li><b>Ingresos :</b><?php  echo $ingre;  ?></li>
                                                  <li><b>Modificado :</b><?php  echo $registr_mo;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Asinado a:</b><?php  echo $usuario;  ?></li>
                                                <li><b>Direccion de Facturacion:</b><?php  echo $dire1;  ?></li>
                                                <li><b>Direccion de Envio:</b><?php  echo $dire2;  ?></li>
                                                <li><b>Telefeno oficina:</b><?php  echo $te1;  ?></li>
                                                <li><b>Fax:</b><?php  echo $fax1;  ?></li>
                                                <li><b>Celular:</b><?php  echo $cel_emp;  ?></li>
                                                
                                                <li><b>Email Principal :</b><?php  echo $emai1;  ?></li>
                                                <li><b>Email Personal:</b><?php  echo $emai2;  ?></li>
                                                <li><b>Email Adicional:</b><?php  echo $emai3;  ?></li>
                                                <li><b>Fecha Registro:</b><?php  echo $registr;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>% de Descuento en Vidrio </b>: <font color="red"><?php  echo $pvi.'%';  ?></font></li>
                                                <li><b>% de Descuento en Aluminio</b>: <font color="red"><?php  echo $pal.'%';  ?></font></li>
                                                <li><b>% de Descuento en Acero</b>: <font color="red"><?php  echo $pac.'%';  ?></font></li>
                                                <li><b>Detalle </b>:<?php  echo $info;  ?></li>
                                                
                                                <?php 
                                                    if($editar_emp == 'Habilitado'){ ?>
                                                        <a href="../vistas/?id=empresa&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                    <?php }else{}
                                                    
                                                    if($eliminar_emp== 'Habilitado'){ ?>
                                                        <a href="../vistas/?id=empresas&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                                    <?php }else{}
                                                ?>
                                                
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/empresa.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
<?php
 if(isset($_GET['cod'])){
//require '../vistas/empresa/actividades.php';
//require '../vistas/empresa/soporte.php';
//require '../vistas/empresa/otros.php';
 }
  
                                if(isset($_GET['cod'])){
$request=mysqli_query($conexion,"SELECT * FROM cotizacion a, sis_empresa c where  a.id_cliente=c.id_empresa and a.id_cliente='".$_GET['cod']."'");
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
   
$request=mysqli_query($conexion,"SELECT * FROM cotizacion a, sis_empresa c where  a.id_cliente=c.id_empresa and a.id_cliente='".$_GET['cod']."' ".$limit);
    
     
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
 
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=new_fac&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$row['id_cot'].'</a></td><td width="10%">'.$row['nombre_emp'].'</font></td><td width="30%">'.$row["obra"].'<font></a></td><td width="30%">'.$row["fecha_reg_c"].'<font></a></td>
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
   
 $request=mysqli_query($conexion,"SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");
    
     
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
