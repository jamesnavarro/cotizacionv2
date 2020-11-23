<?php 
session_start();
include '../modelo/conexion.php';  ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
	 $('#tabla').dataTable();
});
        
        </script>
</head>
<body>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Descomponer Vidrios</h4>

                            </header>

                            <section id="collapse1" class="body collapse in">                      
                                <div class="body-inner">
                                   
                            <div class="tabbable" style="margin-bottom: 25px;">

                        

                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

     <table class="table table-bordered table-striped table-hover" id="">

             <thead >
              <tr bgcolor="#D1EEF0">
              <th width="3%">Items</th>
              <th width="3%">Ped</th>
              <th width="5%">Cod. Barra</th> 
              <th width="25%">Vidrios de la Ventana ó Fachada</th>
              <th width="7%">Diseño</th>
              <th width="7%">Color Vid</th>
              <th class="hidden-phone">Cierres</th>
              <th class="hidden-phone">Ancho (mm)</th>
              <th class="hidden-phone">Alto (mm)</th>
              <th class="hidden-phone">M<sup>2</sup></th>
              <th width="4%">Ordenado (Und)</th>
              <th width="4%">Mas</th>
              </tr>
             </thead>
<?PHP
 $request=mysqli_query($conexion,"SELECT *, (a.producto) as producto FROM producto a, cotizaciones c, orden_detalle e, procesos_activos f where e.parte_otro=1 and e.anula='0' and f.id_orden_d=e.id_orden_d  and c.traz_vid=a.id_p  and c.id_cot=".$_GET["cot"]." and e.codigo=".$_GET['op']." and e.id_orden_d=".$_GET["linea"]."  group by f.id_orden_d union "
         . "SELECT *, (a.producto) as producto FROM producto a, cotizaciones c, orden_detalle e, procesos_activos f where e.parte_otro=1 and e.anula='0' and f.id_orden_d=e.id_orden_d  and c.traz_vid=a.id_p  and c.id_cot=".$_GET["cot"]." and e.codigo=".$_GET['op']." and e.descomponer=".$_GET["linea"]."  group by f.id_orden_d");

          $sqlt = "SELECT count(*) FROM orden_detalle where estado_op=1 and codigo=".$_GET['op']." ";
        $filat =mysqli_fetch_array(mysqli_query($conexion,$sqlt));
        $max= $filat["count(*)"];
        
        $c = 0;$cont = 0;$id=0; $mm = 0; $mx=0;$ca=0;
	while($row=mysqli_fetch_array($request))
	{
           $id=$row["id_producto"];
           
            if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
              }
              } 
            }
                
               $s3p = "SELECT * FROM producto where id_p=".$row["id_producto"]." ";
                $fi3p =mysqli_fetch_array(mysqli_query($conexion,$s3p));
                $pro= $fi3p["producto"];
  if($row["cod_traz"]==''){
      $r = 'No se selecciono ninguna trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz"];                     
$result=  mysqli_query($conexion,$consulta);

while($fila=  mysqli_fetch_array($result)){
  $proceso=$fila['nombre_proceso'];
    
} 
if(isset($proceso)){$r = $proceso; }else{ $r ='Las areas seleccionadas no existen en la base de datos';}
  }         

             if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].', Boq:'.$row["boq"];}else{$d1 = ''.$row["color_ta"];}
            
            $cont = $cont + 1;
                    $suma2 = $row["valor_c"];
            $a = $suma2 / $mult2;
//          echo number_format($a).'<br>';
//          echo number_format($row["precio_adicional"]).'<br>';
            $b = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor = $b *$row["desc"]/100;
            $b = $b - $descpor;

            $pu = ($b)/$row["cantidad_c"];
            
          
            $pr = $row["cantidad_c"]-$row["cant_restante"];

          if($row["especial"]==1){
                 
                }else{
       }
             if($row["linea_cot"]=='Vidrio'){
                $traz = '<a href="../vistas/?id=areas_vi&orden='.$row["barra"].'&prod='.$row["traz_vid"].'">';
            }else{
                $traz = '<a href="../vistas/?id=areas_al&orden='.$row["barra"].'&prod='.$row["traz_vid"].'">';
            }
            ?><?php
          
            if($max!=0){
                $y = 1;
            }else{
                $y = '';
            }
  $mt = ($row["medida1"]/1000) * ($row["medida2"]/1000) * $row["cant_ordenada"];
  if($row["descomponer"]==0){
  $mm = 0;
  $mx =  (($mt));
  }else{
      $mm += ($row["mt2"]);
  }
          if($row["medida4"]!=0 && $c==0){$aa = '&aa='.$row["medida4"];}else{$aa = '';}
          $ca =$row['cant_ordenada'];
                ?>
                        <tr><td width="3%"><?php echo $row["id_cotizacion"] ?></a></td>
                        <td width="3%"><?php echo $row["orden"] ?></a></td>
                        <td width="5%"><?php echo $row['barra'] ?></font></td>
                        <td width="25%"><?php echo $pro ?></a></td>
                        <td width="7%"><?php echo $d1 ?></a></td><td width="7%"><?php echo $row["color"] ?><font></a></td>
                        <td class="hidden-phone"><?php echo $row["cierre"] ?><font></a></td>
                       <td class="hidden-phone"><input type="text"  name="anch" disabled value="<?php echo number_format($row["medida1"]) ?>" style="width:40px"></td>
                       <td class="hidden-phone"><input type="text"  name="alt" disabled value="<?php echo number_format($row["medida2"]) ?>" style="width:40px"></td>
                       <td class="hidden-phone"><input type="text"  name="m2" disabled value="<?php echo number_format($mt,2,',','.') ?>" style="width:40px"></td>
                       <td width="4%"><input type="text" name="cantidad" disabled value="<?php echo number_format($row['cant_ordenada']) ?>" style="width:20px"></td>
                       <td></td>
                        </tr>  
         
		
              
          <?php     $c = $c + 1;
	 } ?>
             <form  action="" method="post"> 
                        <tr><td width="3%"><input type="hidden" readonly  name="linea"  value="<?php echo $_GET["linea"] ?>" style="width:40px"></td>
                            <td width="3%"><input type="hidden"  name="op" readonly value="<?php echo $_GET["op"] ?>" style="width:40px"></td>
                        <td width="5%"><input type="hidden"  name="cot" readonly value="<?php echo $_GET["cot"] ?>" style="width:40px"></td>
                        <td width="25%"><?php echo $pro ?></a></td>
                        <td width="7%"><?php echo $d1 ?></a></td><td width="7%"><?php echo $row["color"] ?><font></a></td>
                        <td class="hidden-phone"><?php echo $row["cierre"] ?><font></a></td>
                       <td class="hidden-phone"><input type="text"  name="ancho" required value="<?php echo number_format($row["medida1"]) ?>" style="width:40px"></td>
                       <td class="hidden-phone"><input type="text"  name="alto" required value="<?php echo number_format($row["medida2"]) ?>" style="width:40px"></td>
                       <td class="hidden-phone"><input type="text"  name="mt" readonly value="<?php echo number_format(($mx-$mm),2,'.','.') ?>" style="width:40px"></td>
                       <td width="4%"><input type="text" name="cantidad" required value="<?php echo number_format($ca) ?>" style="width:20px"></td>
                       <td><button type="submit" class="btn btn-primary" name="add">+</button></td>
                        </tr> 
                         </form>
	</table>

                            </section>

                        </div>

                    </div>

                                    </div>


                                </div>

                            </div><!--/ Normal Tabs -->

                                </div>

                            </section>

                        </div>

                    </div>

                            </section></div>
<?php
if(isset($_POST['add'])){

       $tm2 = ($_POST["ancho"]/1000) * ($_POST["alto"]/1000) * $_POST["cantidad"];
       $y = $_POST["mt"];
       if($tm2>$y){
             echo '<script lanquage="javascript">alert("Estas medidas superan los metros cuadrados faltantes '.$tm2.' > '.$y.' ");location.href="../vistas/dividir.php?linea='.$_POST['linea'].'&op='.$_POST['op'].'&cot='.$_POST['cot'].' ";</script>'; 
       
       }else{
         $sq = "SELECT * FROM `orden_detalle` WHERE id_orden_d='".$_POST['linea']."'";
        $fil =mysqli_fetch_array(mysqli_query($conexion,$sq));

        
        $sql211 = "SELECT max(item_unico) FROM orden_detalle where id_op=".$fil["id_op"]."";
        $fila211 =mysqli_fetch_array(mysqli_query($conexion,$sql211));
        $maxei= $fila211["max(item_unico)"]+1;
        $producto = 'Especificacion #'.$maxei;
        
        $sql = "INSERT INTO `orden_detalle`(`mt2`,`descomponer`, `parte_otro`, `id_prod_cambio`, `lado`, `ubic`, `estado_op`, `id_producto`, `relacionado`, `sede_od`, `asignado`,"
                . "`descripcion`,`codigo`, `item_unico`, `producto_od`, `cantidad`, `cant_ordenada`, `medida1`, `medida2`, `medida3`, `color`,  `id_proceso`,`id_op`)";
        $sql.= "VALUES ('".$tm2."','".$_POST['linea']."','".$fil["parte_otro"]."','".$fil["id_prod_cambio"]."', '".$fil["lado"]."', '".$fil["ubic"]."','1', '".$fil["id_producto"]."', '".$fil["relacionado"]."', '".$fil["sede_od"]."', '".$fil["asignado"]."',"
                . "'".$fil["descripcion"]."', '".$fil["codigo"]."', '".$maxei."', '".$producto."', '".$fil["cantidad"]."', '".$_POST["cantidad"]."', '".$_POST["ancho"]."', '".$_POST["alto"]."', '".$fil["medida3"]."', '".$fil["color"]."', '".$fil["id_proceso"]."', '".$fil["id_op"]."')";
        mysqli_query($conexion,$sql);
        
        $sqlt = "SELECT max(id_orden_d) FROM orden_detalle";
        $filat =mysqli_fetch_array(mysqli_query($conexion,$sqlt));
        $max= $filat["max(id_orden_d)"];
        
        $n = $_POST["cantidad"];
        $por = 100 / $n;
        $paso=1;
        
        $n = $_POST['cantidad'];
        for($x=1; $x<=$n; $x=$x+1){ 
            
        $user = 0;
       $barra = $fil["relacionado"].''.$maxei;
        $it = $barra.$x;
        
       $cc = $fil["codigo"].$x;
        $sql1 = "INSERT INTO `procesos_activos`(`barra_item`, `area_proceso`, `barra`, `paso`, `paso_maq`, `id_op`, `id_orden_d`, `item`, `codigo`, `porcentaje`, `hora_in`, `fecha_in`, `fecha_llegada`, `hora_llegada`, `llegada`, `usuario`)";
        $sql1.= "VALUES ('".$it."', 'Vidrio', '".$barra."','".$paso."','0','".$fil["codigo"]."', '".$max."', '".$x."', '".$cc."', '".$por."', '".date("H:i:s")."', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("H:i:s")."', '".date("Y-m-d H:i:s")."', '".$user."')";
        mysqli_query($conexion,$sql1); 
       
        }
        $sq = "SELECT count(*) FROM `procesos_activos` WHERE id_op=".$fil["codigo"]."";
        $filt =mysqli_fetch_array(mysqli_query($conexion,$sq));
        $cony= $filt["count(*)"];
        
        $t = 100 / $cony;
         $sql3 = "UPDATE `procesos_activos` SET `por_global`='".$t."' WHERE id_op=".$fil["codigo"].";";
         mysqli_query($conexion,$sql3);
         
         $sql3 = "UPDATE `orden_detalle` SET `imprimir`='1' WHERE id_orden_d=".$_POST["linea"].";";
         mysqli_query($conexion,$sql3);
         
          echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();";
echo "</script>";
        
    echo "<script language='javascript' type='text/javascript'>window.opener.document.location.reload();";
echo "location.href='../vistas/dividir.php?linea=".$_POST["linea"]."&cot=".$_POST["cot"]."&op=".$_POST["op"]."'";
echo "</script>";

}}


?>
     <?php require '../vistas/script.php';  ?>
</body>
</html>