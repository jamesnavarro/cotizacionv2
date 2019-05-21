<?php
require('code39.php');
$pdf=new PDF_Code39();
$cont=13;
for($i=1;$i<=$_GET['cant'];$i++){
for($j=1;$j<=$_GET['piezas'];$j++){
$pdf->AddPage('P',array(120,32)); 

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("templados", $conexion);
$consulta= "select a.*, b.* from orden_produccion a, clientes b WHERE a.id_cliente=b.id_cli and a.id_orden=".$_GET["orden"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_orden=$fila['id_orden'];
$ref=$fila['ref'];
$proyecto=$fila['proyecto'];
$numero=$fila['numero'];
$referencia=$fila['referencia'];
$fecha_registro=$fila['fecha_registro'];
$fecha_i=$fila['fecha_i'];
$fecha_f=$fila['fecha_f'];
$id_cliente=$fila['id_cliente'];
$observaciones=$fila['observaciones'];
$nombre_cli=$fila['nombre_cli'];
}
$sql21 = "SELECT a.*, b.* FROM orden_detalle a, proceso b where a.id_proceso=b.id_proceso and a.codigo='".$_GET["cod_barra"]."'";
        $fila21 =mysql_fetch_array(mysql_query($sql21));
        $medida1= $fila21["medida1"]/1000;
        $medida2= $fila21["medida2"]/1000;
        $medida3= $fila21["medida3"]/1000;
        $descripcion= $fila21["descripcion"];
        $color= $fila21["color"];
        $name= $fila21["nombre_proceso"];
       

$pdf->SetFont('Times','',9);
$pdf->Cell(4,-10,$nombre_cli.'',0,12);
$pdf->Cell(4,4,'O.P :'.$numero. '    Pieza:('.$_GET['piezas'].'/'.$j.')  (Fecha:'.$fecha_registro.')',0,12);
$pdf->Cell(4,7,' (Desc: '.$descripcion.')',0,10);
$pdf->Cell(4,0,' (Prod: '.$name.')',2,10);
$pdf->Code39(12,$cont,$_GET['cod_barra'].''.$i,1,12);

 
}
}

 $pdf->Output();


?>


