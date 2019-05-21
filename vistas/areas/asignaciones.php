
<link rel="stylesheet" type="text/css" href="../resources/screen.css" />
<article class="module width_full">
    <center>
<font color="Red"><h2>Master de Asignacion</h2></font>
</center>
        
         
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
     ?>

    </article>
 <?php
include "../modelo/conexion.php";
if(isset($_GET['prod'])){
    $consulta= 'select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$_GET['prod'].' order by a.orden asc ';  
}else{
    $consulta= "SELECT * FROM subproceso where id_subpro=".$_GET['area']."";  
}


$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$area=$fila['nombre_subpro'];



$numero = $valor1+1;
echo ' ';
?>
<div class="row-fluid">
     <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Area de <?php echo $area.', #'.$valor1; ?></h4>
                              
                            </header>
                            <section class="body">
                                <div class="body-inner no-padding">
    <form name="form1" class="" action="" method="post" enctype="multipart/form-data">
        <input type="text" name="op" placeholder="Digite el # Orden de Produccion">
        <input type="submit" name="buscar" value="Buscar"> 
        <input type="submit" name="todas" value="Mostrar Todas">

    </form>    
                                    <form name="form1" class="" action="" method="post" enctype="multipart/form-data">
                                        <input type="submit" name="enviar" value="Enviar a Produccir">
                                                Grupo 
        <select name="grupox">
            <option value="">Seleccione Grupo</option>
            <?php 
                $query = mysql_query("select * from asignacion_grupo a,grupo b where a.id_g=b.id_g and a.id_area=".$_GET['area']." ");
                while($datos = mysql_fetch_array($query)){ ?>
                    <option value="<?php echo $datos['id_g'] ?>"><?php echo $datos['id_g'].$datos['name'] ?></option>
                <?php }
            ?>
        </select>
                                   <table class="table table-bordered table-striped table-hover" id="">
                                         <tr><td>


<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

//Hacemos la consulta con nuestros resultados
if(isset($_POST['buscar'])){
    $request=mysql_query('select *, (select opf from orden_produccion g where g.id_orden=e.id_op) as opfx from producto a, subproceso b, pt_procesos c, orden_detalle d, procesos_activos e where d.imprimir=0 and  e.id_op='.$_POST['op'].' and d.anula=0 and e.save=1 and a.id_p=c.id_proceso and c.id_subpro=b.id_subpro  and b.id_subpro='.$valor1.' and  a.id_p=d.id_producto and d.id_orden_d=e.id_orden_d and e.paso=c.orden');

}else{
    $request=mysql_query('select *, (select opf from orden_produccion g where g.id_orden=e.id_op) as opfx from producto a, subproceso b, pt_procesos c, orden_detalle d, procesos_activos e where d.imprimir=0 and d.anula=0 and e.save=1 and a.id_p=c.id_proceso and c.id_subpro=b.id_subpro  and b.id_subpro='.$valor1.' and  a.id_p=d.id_producto and d.id_orden_d=e.id_orden_d and e.paso=c.orden');

}
if($request){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

           $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
             
               $table = $table.'<th>'.'Paso'.'</th>';
             
              $table = $table.'<th>'.'O.P'.'</th>';
              $table = $table.'<th>'.'O.P.F'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
             $table = $table.'<th>'.'Llegada'.'</th>';
             $table = $table.'<th>'.'Tiempo Trancurrido'.'</th>';
             $table = $table.'<th>'.'Producto'.'</th>';
                    $table = $table.'<th>'.'Medida'.'</th>';
            $table = $table.'<th>'.'Grupos<input type="checkbox" name="otro">'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $c=0;
	while($row=mysql_fetch_array($request))
	{      
           
                $c = $c + 1;
                        date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('H:i:s',time() - 3600*date('I'));
                  $fi = $row["fecha_llegada"].' '.$row["hora_llegada"];
                 $fe = date("Y-m-d").' '.$hora;
        $tiempo = calcula_tiempo($fi,$fe);
        if($row['usuario']==0){
         $rangos = mysql_query("select * from asignacion_grupo a, grupo b where a.id_g=b.id_g and a.id_area=".$_GET['area']." ");
                $ran = '<input type="checkbox" name="c'.$c.'" class="span12">';
                
                $ran = $ran.'<input type="hidden" name="id'.$c.'" value="'.$row['id_proceso'].'">';
        }else{
           $rangos = mysql_query("select * from asignacion_grupo a, grupo b where a.id_g=b.id_g and a.id_area=".$_GET['area']." and b.id_g=".$row['usuario']." ");
           $r = mysql_fetch_array($rangos);
            $ran = $r['name'].'<input type="hidden" name="grupo'.$c.'" value=""><input type="hidden" name="id'.$c.'" value="'.$row['id_proceso'].'">';
        }
               if($row["estado"]=='U'){$led='<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]=='P'){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}
                if($row["estado"]==''){$led='<img src="../imagenes/amarillo.gif" alt="ver" height="10px" width="10px">';}
                 if($row["estado"]=='E'){$led='<img src="../imagenes/advertencia.png" alt="ver" height="10px" width="10px">';}
                if($row["estado"]=='Terminado'){$led='<img src="../imagenes/term.png" alt="ver" height="10px" width="10px">';}
		$table = $table.'<tr><td>'.$row['paso'].' '.$led.'</td>'
                        . '<td>'.$row["id_op"].'</a></td><td>'.$row["opfx"].'</a></td>'
                        . '<td>'.$row["barra_item"].'</a></td>'
                        . '<td>'.$row["cant_ordenada"].'</a></td>
                           </td> <td>'.$row["fecha_llegada"].' <font color="blue">('.$row["hora_llegada"].')</font></td>'
                        . '<td>'.$tiempo.'</font></td>'
                        . '<td>'.$row["producto"].'</a></td>'
                        . '<td>'.$row["medida1"].'x'.$row["medida2"].'</a></td>'
                        . '<td>'.$ran.'</a></td>
                       </tr>';
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        echo 'Total de Productos en el area :'.$c;
}
   
?>
                                             </td></tr> </table> <input type="hidden" name="cant" value="<?php echo $c; ?>"><input type="submit" name="enviar" value="Enviar a Produccir"><br></form>
                                </div>
                            </section>
                        </div>

<?php
    

echo ' ';
?>

                   
<?php  }  ?>
<?php  
    if(isset($_POST['enviar'])){
        date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('H:i:s',time() - 3600*date('I'));
        $fe = date("Y-m-d").' '.$hora;
        $n = $_POST['cant'];
            for($x=1; $x<=$n;$x=$x+1){
                
                if (isset($_POST["c$x"])){
                    $sql = "UPDATE `procesos_activos` SET `usuario` ='".$_POST["grupox"]."', llegada='".$fe."' WHERE `id_proceso` = '".$_POST["id$x"]."';";
                    mysql_query($sql, $conexion);
                }
            }
            echo '<script lanquage="javascript">alert("Se han asignado los grupos al trabajo");location.href="../vistas/?id=asignar_area&area='.$_GET['area'].'"</script>'; 
    }
               
               
               ?> 
	


