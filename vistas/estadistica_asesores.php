<?php 
function calcula_tiempo($start_time, $end_time) { 
    $total_seconds = strtotime($end_time) - strtotime($start_time); 
    $horas              = floor ( $total_seconds / 3600 );
    $minutes            = ( ( $total_seconds / 60 ) % 60 );
    $seconds            = ( $total_seconds % 60 );
     
    $time['horas']      = str_pad( $horas, 2, "0", STR_PAD_LEFT );
    $time['minutes']    = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
    $time['seconds']    = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
     
    $time               = implode( ':', $time );
     
    return $time;
}
function dif($h1,$h2){
$h=((strtotime($h1)-strtotime($h2)))/3600;
$m=intval((($h)-intval($h))*60);
$s=intval((((($h)-intval($h))*60)-$m)*60);
return (intval($h)<10?'0'.intval($h):intval($h)).':'.($m<10?'0'.$m:$m).':'.($s<10?'0'.$s:$s);
}
$request=mysql_query('select count(*) from ordenes where estado_ord!="En proceso" and estado_ord!="Anulado"');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 30;

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

                                <h4 class="title">Generar Estadisticas para asesores</h4>

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
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                             <div class="span4">
                                                   <select  name="empresa"  class="span8"   id="select2_1">
                                                    <option value=''>Seleccione el Usuario</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT *, concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.registrado=b.usuario group by b.usuario order by nombre";
                                                                                    
                                                            $result=   mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor2=$fila['nombre_completo'];
                                                            $valor1=$fila['usuario'];
                                                         

                                                            echo"<option value=".$valor1.">".$valor2."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                              
                                                  <br><hr>
                                                    <input  name="fecha" type="text" required  id="datepicker1" placeholder="2014-01-30"> al <input  name="fecha2" required type="text"  id="datepicker2" placeholder="2014-12-30">
                                                    <input type="submit" class="btn" name="Buscar" value="Buscar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
                                 
                            <div class="" style="margin-bottom: 25px;">
                              

                       
                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->
<p></p>
                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                       

                            

                            <section class="body">
  
                                <div class="body-inner no-padding">
    
                                </div>

                            </section>

                     
  <div class="tabbable" style="margin-bottom: 25px;">
      <?php
      if(isset($_POST['almacen']) || isset($_POST['fecha'])){
//        include '../vistas/imprimir_reportes_2.php';
        }
        IF(isset($_POST['fecha'])!=''){
            $consulta= "SELECT * FROM `usuarios` where usuario like '%".$_POST['empresa']."%'";                     
        $result=  mysql_query($consulta);
        $fila=  mysql_fetch_array($result);
       $fecha = $_POST['fecha'].' 01:00:00';
    $fecha2 = $_POST['fecha2'].' 23:00:00';
      echo 'Rango de Fecha del: <font color="red">'.$fecha.' al '.$fecha2.'</font> Usuario: <font color="blue">'.$fila['nombre'].' '.$fila['apellido'].'</font><br>';
  }
      ?>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab7" data-toggle="tab"><span class="icon icone-bar-chart"></span> Cot. en proceso</a></li>
                                    <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-bar-chart"></span> Cot. por aprobar </a></li>
                                    <li class=""><a href="#tab5" data-toggle="tab"><span class="icon icone-bar-chart"></span> Cot. aprobadas </a></li>
                                     <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-bar-chart"></span> Estado de Rendimiento </a></li>
                                   <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-bar-chart"></span> Productos en general </a></li>
                                    <li class=""><a href="#tab3" data-toggle="tab"><span class="icon icone-bar-chart"></span> Por Lineas </a></li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab7">
                                             <table class="table table-bordered table-striped table-hover" id="tabla">
        <?php
        if(isset($_POST['fecha'])!=''){
            $ciudad = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo, b.usuario FROM cotizacion a, usuarios b where a.estado='En proceso' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario group by b.usuario order by count(*) desc");
        $consulta2= "SELECT count(*) FROM cotizacion a, usuarios b where  a.estado='En proceso' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario";                     
        $result=  mysql_query($consulta2);
        $fila=  mysql_fetch_array($result);
            
        }else{
            $ciudad = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo, b.usuario FROM cotizacion a, usuarios b where  a.estado='En proceso' and a.registrado=b.usuario group by b.usuario order by count(*) desc");
            $consulta2= "SELECT count(*) FROM `cotizacion` where estado='En proceso'";                     
        $result=  mysql_query($consulta2);
        $fila=  mysql_fetch_array($result);
        }
        echo '<tr><td width="5px">Items</td><td>Nombre del Usuario</td><td>Total Cotizado</td><td>Numero de Cotizaciones</td><td>Porcentaje de Rendimiento</td>';
        $c1 = 0;$p1 = 0;
        while($ciu = mysql_fetch_array($ciudad)){
            include '../vistas/total_cotizaciones.php';
            $c1 += $ciu['count(*)'];$p1 += 1;
            echo '<tr><td width="5px">'.$p1.'</td><td>'.strtoupper($ciu['nombre_completo']).'</td>';
            echo '<td>'.number_format($tacot).'</td><td>'.$ciu['count(*)'].'</td><td>'.number_format((($ciu['count(*)'] / $fila['count(*)']) * 100),2,',','.').' %</td></tr>';
        }
        echo '<tr><td></td><td><font color="red">TOTAL DE COTIZACIONES</font></td>';
        echo '<td><font color="red">'.number_format($c1).'</font></td></tr>';
        ?>
 
            
           
        </table>   
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                             <table class="table table-bordered table-striped table-hover" id="tabla">
        <?php
        if(isset($_POST['fecha'])!=''){

                $productos = mysql_query("(SELECT count(*), sum(cantidad_c), producto FROM producto a, cotizaciones c, cotizacion b where c.id_cot=b.id_cot and c.id_referencia=a.id_p  and b.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.registrado like '".$_POST['empresa']."%' group by id_p order by sum(cantidad_c) desc)");
        }else{
        $productos = mysql_query("(SELECT count(*), sum(cantidad_c), producto FROM producto a, cotizaciones c, cotizacion b where c.id_cot=b.id_cot and c.id_referencia=a.id_p  group by id_p order by sum(cantidad_c) desc)");
        }
        $c2 = 0;        $c3 = 0;

        $p2 = 0;
        echo '<tr><td width="5px">Item</td><td>Producto</td><td>Cantidades en Cotizaciones</td><td>Cantidad Totales</td>';
        while($pro = mysql_fetch_array($productos)){
         
            $c2 += $pro['count(*)']; $c3 += $pro['sum(cantidad_c)'];
            $p2 += 1;
            echo '<tr><td width="5px">'.$p2.'</td><td>'.strtoupper($pro['producto']).'</td>';
            echo '<td>'.$pro['count(*)'].'</td><td>'.$pro['sum(cantidad_c)'].'</td></tr>';
        }
        echo '<tr><td></td><td><font color="red">TOTAL DE PEDIDOS</font></td>';
        echo '<td><font color="red">'.number_format($c2).'</font></td>'
                . '<td><font color="red">'.number_format($c3).'</font></td></tr>';
        ?>
 
            
           
        </table>   
                                    </div>
                                     <div class="tab-pane" id="tab3">
                                             <table class="table table-bordered table-striped table-hover" id="tabla">
       <?php
        if(isset($_POST['fecha'])){

                $linea = mysql_query("(SELECT count(*), sum(cantidad_c), a.linea FROM producto a, cotizaciones c, cotizacion b where c.id_cot=b.id_cot and c.id_referencia=a.id_p  and b.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.registrado like '".$_POST['empresa']."%' group by a.linea order by sum(cantidad_c) desc)");
        }else{
        $linea = mysql_query("(SELECT count(*), sum(cantidad_c), a.linea FROM producto a, cotizaciones c, cotizacion b where c.id_cot=b.id_cot and c.id_referencia=a.id_p  group by a.linea order by sum(cantidad_c) desc)");
        }
        $l2 = 0;        $l3 = 0;

        $lp2 = 0;
        echo '<tr><td width="5px">Item</td><td>Producto</td><td>Cantidades en Cotizaciones</td><td>Cantidad Totales</td>';
        while($lin= mysql_fetch_array($linea)){
         
            $l2 += $lin['count(*)']; $l3 += $lin['sum(cantidad_c)'];
            $lp2 += 1;
            echo '<tr><td width="5px">'.$lp2.'</td><td>'.strtoupper($lin['linea']).'</td>';
            echo '<td>'.$lin['count(*)'].'</td><td>'.$lin['sum(cantidad_c)'].'</td></tr>';
        }
        echo '<tr><td></td><td><font color="red">TOTAL DE PEDIDOS</font></td>';
        echo '<td><font color="red">'.number_format($l2).'</font></td>'
                . '<td><font color="red">'.number_format($l3).'</font></td></tr>';
        ?>
 
 
            
           
        </table>   
                                    </div>
                                     <div class="tab-pane" id="tab4">
                                             <table class="table table-bordered table-striped table-hover" id="tabla">
         <?php
        if(isset($_POST['fecha'])){
            $por_aprobar = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.estado='Pedido por aprobar' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario group by b.usuario order by count(*) desc");
        $consulta21= "SELECT count(*) FROM cotizacion a, usuarios b where a.estado='Pedido por aprobar' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario";                     
        $result=  mysql_query($consulta21);
        $fila=  mysql_fetch_array($result);
            
        }else{
            $por_aprobar = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.estado='Pedido por aprobar' and a.registrado=b.usuario group by b.usuario order by count(*) desc");
            $consulta21= "SELECT count(*) FROM `cotizacion` where estado='Pedido por aprobar'";                     
        $result=  mysql_query($consulta21);
        $fila=  mysql_fetch_array($result);
        }
        echo '<tr><td width="5px">Items</td><td>Nombre del Usuario</td><td>Numero de Cotizaciones</td><td>Porcentaje de Rendimiento</td>';
        $c11 = 0;$p11 = 0;
        while($ciu = mysql_fetch_array($por_aprobar)){
            $c11 += $ciu['count(*)'];$p11 += 1;
            echo '<tr><td width="5px">'.$p11.'</td><td>'.strtoupper($ciu['nombre_completo']).'</td>';
            echo '<td>'.$ciu['count(*)'].'</td><td>'.number_format((($ciu['count(*)'] / $fila['count(*)']) * 100),2,',','.').' %</td></tr>';
        }
        echo '<tr><td></td><td><font color="red">TOTAL DE COTIZACIONES POR APROBAR</font></td>';
        echo '<td><font color="red">'.number_format($c11).'</font></td></tr>';
        ?>
 
 
            
           
        </table>   
                                    </div>
                                     <div class="tab-pane" id="tab5">
                                            <table class="table table-bordered table-striped table-hover" id="tabla">
          <?php
        if(isset($_POST['fecha'])){
            $aprobar = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.estado='Aprobado' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario group by b.usuario order by count(*) desc");
        $consulta21= "SELECT count(*) FROM cotizacion a, usuarios b where a.estado='Aprobado' and a.fecha_reg_c between '".$fecha."'  and '".$fecha2."' and b.usuario like '".$_POST['empresa']."%' and  a.registrado=b.usuario";                     
        $result=  mysql_query($consulta21);
        $fila=  mysql_fetch_array($result);
            
        }else{
            $aprobar = mysql_query("SELECT count(*), concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.estado='Aprobado' and a.registrado=b.usuario group by b.usuario order by count(*) desc");
            $consulta21= "SELECT count(*) FROM `cotizacion` where estado='Aprobado'";                     
        $result=  mysql_query($consulta21);
        $fila=  mysql_fetch_array($result);
        }
        echo '<tr><td width="5px">Items</td><td>Nombre del Usuario</td><td>Numero de Cotizaciones</td><td>Porcentaje de Rendimiento</td>';
        $c111 = 0;$p111 = 0;
        while($ciu = mysql_fetch_array($aprobar)){
            $c111 += $ciu['count(*)'];$p111 += 1;
            echo '<tr><td width="5px">'.$p111.'</td><td>'.strtoupper($ciu['nombre_completo']).'</td>';
            echo '<td>'.$ciu['count(*)'].'</td><td>'.number_format((($ciu['count(*)'] / $fila['count(*)']) * 100),2,',','.').' %</td></tr>';
        }
        echo '<tr><td></td><td><font color="red">TOTAL DE COTIZACIONES APROBADAS</font></td>';
        echo '<td><font color="red">'.number_format($c111).'</font></td></tr>';
        ?>
 
 
            
           
        </table>   
                                    </div>
                                     <div class="tab-pane" id="tab6">
                                             <table class="table table-bordered table-striped table-hover" id="tabla">
        <?php
        $est = $c1 + $c11 + $c111;
        $a = ($c1 / $est) * 100;
        $b = ($c11 / $est) * 100;
        $c = ($c111 / $est) * 100;
          
            echo '<tr><td width="5px">Item</td><td>Estado</td><td>Cantidad de Cotizaciones</td><td>Porcentaje</td></tr>';
            echo '<tr><td width="5px">1</td><td>En proceso</td><td>'.$c1.'</td><td>'.number_format($a,2,',','.').' %</td></tr>';
            echo '<tr><td width="5px">2</td><td>Pedido por Aprobar</td><td>'.$c11.'</td><td>'.number_format($b,2,',','.').' %</td></tr>';
            echo '<tr><td width="5px">3</td><td>Aprobadas</td><td>'.$c111.'</td><td>'.number_format($c,2,',','.').' %</td></tr>';
            echo '<tr><td width="5px"></td><td><font color="red">TOTAL DE COTIZACIONES</td><td><font color="red">'.$est.'</td><td></td></tr>';     

        
        ?>
 
            
           
        </table>   
                                    </div>
                                    </div>
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

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($_GET['del']==1){
          echo '<script lanquage="javascript">alert("Este Usuario no se puede Eliminar");location.href="../vistas/?id=list_user"</script>'; 
     }else{
       $sql = "DELETE FROM usuarios WHERE id_user=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=list_user'";
echo "</script>";  
     }

}
if(isset($_GET['ordenar'])){
    $sql = "UPDATE `ordenes` SET `estado_ord` = 'En proceso', paso=1 WHERE `id_orden` = ".$_GET['ordenar'].";";
                
                mysql_query($sql, $conexion);
                 echo '<script lanquage="javascript">alert("El pedido ha entrado a producion");location.href="../vistas/?id=pedidos"</script>'; 
}
if(isset($_GET['archivar'])){
    $sql = "UPDATE `ordenes` SET `estado_ord` = 'Archivado' WHERE `id_orden` = ".$_GET['archivar'].";";
                
                mysql_query($sql, $conexion);
                 echo '<script lanquage="javascript">alert("El pedido se ha archivado");location.href="../vistas/?id=pedidos"</script>'; 
}
?>