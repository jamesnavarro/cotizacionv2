<header>
    <script type="text/javascript">
        var int=self.setInterval("refresh()",30000);
        function refresh()
        {
                location.reload(true);
        }
</script>
</header>
<div class="container-fluid">
                    <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Page/Section header -->
                        <div class="span12">
                            <div class="page-header line1">
                                <h4>MI AREA DE PRODUCCION<small><a href="../vistas/?id=registros">Mis registros de trabajo</a></small></h4>
                            </div>
                        </div>
                        <!--/ END Page/Section header -->
                    </div>
                    <!--/ END Row -->
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
include "../modelo/conexion.php";
if(!isset($_GET['sig'])){
$consulta= "SELECT * FROM subproceso a, grupo b, grupo_det c, usuarios d where d.id_user=c.id_user and b.id_g=c.id_g and a.id_subpro=b.id_area and d.id_user=".$_SESSION['id_user'];                     
}else{
$consulta= "SELECT * FROM subproceso a, grupo b, grupo_det c, usuarios d where d.id_user=c.id_user and b.id_g=c.id_g and a.id_subpro=b.id_area and d.cedula=".$_GET['sig'];                     

}
$result=  mysqli_query($conexion,$consulta);

while($fila=  mysqli_fetch_array($result)){
$id_area=$fila['id_subpro'];
$area=$fila['nombre_subpro'];
$numero = $id_area;
$group=$fila['id_g'];

?>
 

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title"><?php  echo $area.' '.$id_area.' '.$group.' '  ?></h4>

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


                                <div class="tab-content">

                                    <div class="" id="tab3">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

<?php
echo $group;
if(isset($_GET['sig'])){
$request_ac=mysqli_query($conexion,'select *, (select opf from orden_produccion g where g.id_orden=e.id_op) as opfx from producto a, subproceso b, pt_procesos c, orden_detalle d, procesos_activos e where e.usuario='.$group.' and e.save=1 and a.id_p=c.id_proceso and c.id_subpro=b.id_subpro  and b.id_subpro='.$id_area.' and  a.id_p=d.id_producto and d.id_orden_d=e.id_orden_d and e.paso=c.orden');
}else{
$request_ac=mysqli_query($conexion,'select *, (select opf from orden_produccion g where g.id_orden=e.id_op) as opfx from producto a, subproceso b, pt_procesos c, orden_detalle d, procesos_activos e where e.usuario!=0 and e.save=1 and a.id_p=c.id_proceso and c.id_subpro=b.id_subpro  and b.id_subpro='.$id_area.' and  a.id_p=d.id_producto and d.id_orden_d=e.id_orden_d and e.paso=c.orden');
//$request_ac=mysqli_query($conexion,'select a.*, b.*, c.*, f.* from procesos_activos a, pt_procesos b, orden_detalle c, proceso d, subproceso e, orden_produccion f where f.id_orden=c.codigo and a.id_orden_d=c.id_orden_d and b.id_proceso=c.id_proceso and b.orden=a.paso and b.id_proceso=d.id_proceso and b.orden=a.paso and e.id_subpro='.$id_area.' and b.id_subpro='.$id_area.' group by a.id_orden_d');
}  
if($request_ac){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';           
               $table = $table.'<th>'.'Paso'.'</th>';  
              $table = $table.'<th>'.'O.P'.'</th>';
               $table = $table.'<th>'.'O.P.F'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Cantidad Total'.'</th>';
             $table = $table.'<th>'.'Llegada'.'</th>';
             $table = $table.'<th>'.'Tiempo Transcurrido'.'</th>';
             $table = $table.'<th>'.'Producto'.'</th>';  
                $table = $table.'<th>'.'Medidas'.'</th>'; 
                 $table = $table.'<th>'.'Asigando a'.'</th>'; 
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $c=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
                $c = $c + 1;
                $minuit = strtotime("00:00:00"); 
                $hora1=$row["hora_in"]; 
                $timestamp1 = strtotime($hora1)-$minuit; 

                $hora2=$row["tiempo_esp"]; 
                $timestamp2 = strtotime($hora2)-$minuit; 

                $SUMA=$timestamp1+$timestamp2+$minuit; 
                $h = date("H:i:s",$SUMA);
                
                 date_default_timezone_set("America/Bogota" ) ; 
                 $hora = date('H:i:s',time() - 3600*date('I'));
                  $fi = $row["llegada"];
                 $fe = date("Y-m-d").' '.$hora;
                 $tiempo = calcula_tiempo($fi,$fe);
        
               if($row["estado"]=='Terminado'){$led='<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]=='P'){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]==''){$led='<img src="../imagenes/amarillo.gif" alt="ver" height="10px" width="10px">';}
                 if($row["estado"]=='E'){$led='<img src="../imagenes/advertencia.png" alt="ver" height="10px" width="10px">';}
               $rangos = mysqli_query($conexion,"select * from asignacion_grupo a, grupo b where a.id_g=b.id_g and a.id_area=".$id_area." and b.id_g=".$row['usuario']." ");
           $r = mysqli_fetch_array($rangos);
          	$table = $table.'<tr><td>'.$row['paso'].' '.$led.'</td><td>'.$row["id_op"].'</a></td><td>'.$row["opfx"].'</td>'
                        . '<td>'.$row["barra_item"].'</a></td><td>'.$row["cant_ordenada"].'</a></td>
                    
</td> <td>'.$row["fecha_llegada"].' <font color="blue">('.$row["hora_llegada"].')</font></td>'
                        . '<td>'.$tiempo.'</td><td>'.$row["producto"].'</a></td><td>'.$row["medida1"].'X'.$row["medida2"].'</td>
                       <td>'.$r['name'].'</td></tr>';
               
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

                                  
<?php
}
?>
       </div>                <!-- START Row -->
                    
                </div>      <!--/ END Row -->
                    <!-- START Row -->
               <?php  
               if(isset($_GET['next'])){
                   
                   
                   
               }
               
               
               ?>   
              
                <!--/ END Content -->
