<link rel="stylesheet" type="text/css" href="../resources/screen.css" />
<meta content="30" http-equiv="REFRESH"  charset="utf-8"/>
<article class="module width_full">
    <center>
<font color="Red"><h2>Procesos de todas las areas </h2></font>
</center>
    </article>
     <?php
 if(isset($_GET['prod'])){
     ?>
    <form name="form1" class="" action="<?php echo '../vistas/?id=areas_vi&orden='.$_GET['orden'].'&prod='.$_GET['prod'].'&editar';  ?>" method="post" enctype="multipart/form-data">
    <?php
 if($_SESSION['admin']=='Si'){
include "../modelo/conexion.php";
$consulta1='select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$_GET['prod'].' order by a.orden asc ';                     
$result1=  mysqli_query($conexion,$consulta1);
echo '<select name="paso">';
echo '<option value="">Seleccione el area</option>';
while($fila1=  mysqli_fetch_array($result1)){
$valor1=$fila1['orden'];
$area=$fila1['nombre_subpro'];
echo '<option value="'.$valor1.'">'.$area.'</option>';
}
echo '<option value="0">Terminar Proceso</option></select><input type="submit" value="Editar Pasos">  <br>';
echo '<font color="red">En caso de reproceso por favor editelos aqui</font>';
 }}
 ?>
    </form>
 <?php
include "../modelo/conexion.php";
if(isset($_GET['prod'])){
    $consulta= 'select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$_GET['prod'].' order by a.orden asc ';  
}else{
    $consulta= "SELECT * FROM subproceso where sede_sub='Acero'";  
}                    
$result=  mysqli_query($conexion,$consulta);
while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$area=$fila['nombre_subpro'];



$numero = $valor1+1;
echo ' ';

?>
<div class="row-fluid">
  <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Area de <?php echo $area.', #'.$numero; ?></h4>
                              
                            </header>
  
                            <section class="body">
                                <div class="body-inner no-padding">
                                   <table class="table table-bordered table-striped table-hover" id="">
                                         <tr><td>


<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
if(isset($_GET['orden_produccion'])){
    $request=mysqli_query($conexion,'select a.*, b.*, c.*, f.* from procesos_activos a, pt_procesos b, orden_detalle c, proceso d, subproceso e, orden_produccion f where f.id_orden=c.codigo and a.id_orden_d=c.id_orden_d and b.id_proceso=c.id_proceso and b.orden=a.paso and b.id_proceso=d.id_proceso and b.orden=a.paso and e.id_subpro='.$valor1.' and b.id_subpro='.$valor1.' and f.numero='.$_GET['orden_produccion'].'');

}else{
if(isset($_GET['orden'])){
    $request=mysqli_query($conexion,'select a.*, b.*, c.*, f.* from procesos_activos a, pt_procesos b, orden_detalle c, proceso d, subproceso e, orden_produccion f where f.id_orden=c.codigo and a.id_orden_d=c.id_orden_d and b.id_proceso=c.id_proceso and b.orden=a.paso and b.id_proceso=d.id_proceso and b.orden=a.paso and e.id_subpro='.$valor1.' and b.id_subpro='.$valor1.' and a.barra='.$_GET['orden'].'');

}else{
    $request=mysqli_query($conexion,'select a.*, b.*, c.*, f.* from procesos_activos a, pt_procesos b, orden_detalle c, proceso d, subproceso e, orden_produccion f where f.id_orden=c.codigo and a.id_orden_d=c.id_orden_d and b.id_proceso=c.id_proceso and b.orden=a.paso and b.id_proceso=d.id_proceso and b.orden=a.paso and e.id_subpro='.$valor1.' and b.id_subpro='.$valor1.'');

}}
if($request){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
             
               $table = $table.'<th>'.'Paso'.'</th>';
             
              $table = $table.'<th>'.'O.P'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
              
              
              
             $table = $table.'<th>'.'Llegada'.'</th>';
             $table = $table.'<th>'.'Tiempo transcurrido'.'</th>';
             $table = $table.'<th>'.'Producto'.'</th>';
              $table = $table.'<th>'.'Medidas'.'</th>';
             $table = $table.'<th>'.'Grupo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $c=0;
	while($row=mysqli_fetch_array($request))
	{      
           $rangos = mysqli_query($conexion,"select * from asignacion_grupo a, grupo b where a.id_g=b.id_g and a.id_area=".$valor1." and b.id_g=".$row['usuario']." ");
           $r = mysqli_fetch_array($rangos);
                $c = $c + 1;
                        date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('H:i:s',time() - 3600*date('I'));
                  $fi = $row["fecha_llegada"].' '.$row["hora_llegada"];
                 $fe = date("Y-m-d").' '.$hora;
        $tiempo = calcula_tiempo($fi,$fe);
               if($row["estado"]=='U'){$led='<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]=='P'){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]==''){$led='<img src="../imagenes/amarillo.gif" alt="ver" height="10px" width="10px">';}
                 if($row["estado"]=='E'){$led='<img src="../imagenes/advertencia.png" alt="ver" height="10px" width="10px">';}
                if($row["estado"]=='Terminado'){$led='<img src="../imagenes/term.gif" alt="ver" height="10px" width="10px">';}
		$table = $table.'<tr><td>'.$row['paso'].' '.$led.'</td><td>'.$row["id_op"].'</a></td>'
                        . '<td>'.$row["barra_item"].'</a></td><td>'.$row["item"].'/'.$row["cant_ordenada"].'</a></td>
                    </td> <td>'.$row["fecha_llegada"].' <font color="blue">('.$row["hora_llegada"].')</font></td>'
                        . '<td>'.$tiempo.'</font></td><td>'.$row["producto"].'</a></td>'
                        . '<td>'.$row["medida1"].'X'.$row["medida2"].'</a></td><td>'.$r['name'].'</a></td>
                       </tr>';    
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        echo 'Total de Productos en el area :'.$c;
}
   
?>
       </td></tr> </table> 
                                </div>
                            </section>
                        </div>

<?php
    

echo ' ';
?>

                   
<?php  }  ?>
  <?php  
               if(isset($_GET['editar'])){
               date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fe = date("Y-m-d").' '.$hora;
                     if($_POST['paso']==0){$estado = 'Terminado';}else{$estado = '';}
                    $sql = "UPDATE `procesos_activos` SET `paso` =".$_POST['paso'].", llegada='".$fe."' WHERE `barra` = ".$_GET['orden'].";";
                    mysqli_query($conexion,$sql);
                    echo '<script lanquage="javascript">alert("El producto a sido editado, se ha hecho reproceso '.$_POST['paso'].' ");location.href="../vistas/?id=areas_vi&orden='.$_GET['orden'].'&prod='.$_GET['prod'].'"</script>'; 
                   
               }
               
               
               ?> 
	


