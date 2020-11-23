<?php
require('code39.php');
$pdf=new PDF_Code39();
$cont=13;
$ct = $_GET['cant'] * $_GET['laminas'];
$conexion = mysqli_connect("localhost", "root", "20031123003");
mysqli_select_db("virtuald_templadosa");
for($i=1;$i<=$ct;$i++){

$pdf->AddPage('P',array(120,32)); 


$consulta= "select * from orden_produccion a WHERE id_orden=".$_GET["orden"]."";
$result=  mysqli_query($conexion,$consulta);
while($fila=  mysqli_fetch_array($result)){
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
if($fila['tipo_cli']=='Empresarial'){
              $sql='select * from sis_empresa where id_empresa="'.$fila['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

$nombre= $fil["nombre_emp"];
          }else{
              $sql3='select * from sis_contacto where id_contacto="'.$fila['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql3));
$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];

          }
}
$sql21 = "SELECT a.*, b.* FROM orden_detalle a, producto b where a.id_proceso=b.id_p and a.codigo='".$_GET["orden"]."' and a.id_proceso=".$_GET["pro"]." ";
        $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
        $medida1= $fila21["medida1"];
        $medida2= $fila21["medida2"];
        $medida3= $fila21["medida3"];
        $descripcion= $fila21["descripcion"];
        $color= $fila21["color"];
        $name= $fila21["producto"];
       
          $sql22 = "SELECT * FROM cotizacion where id_cot='".$_GET["cot"]."'";
        $fila22 =mysqli_fetch_array(mysqli_query($conexion,$sql22));
        $obra= $fila22["obra"];

//$pdf->SetFont('Arial','B',8);
//$pdf->Cell(4,-10,$nombre.' (Fecha:'.$fecha_registro.'), Cant:('.$i.'/'.$_GET['cant'].'), Lam:'.$_GET['laminas'],0,12);
//$pdf->Cell(4,4,'(Medidas: '.$_GET['an'].' mm x '.$_GET['al'].' ,'.$color.' )  O.P :'.$numero,0,12);
//$pdf->Cell(4,7,' (Desc: '.$observaciones.')',0,10);
//$pdf->Cell(4,0,' ('.$name.')',2,10);
//$pdf->Code39(12,$cont,$_GET['cod_barra'],1.4,12);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(4,-10,strtoupper($obra).' '.$nombre.' ',0,12);
$pdf->Cell(4,4,'TEMPLADO S.A           ('.$i.'/'.$_GET['cant'].')               O.P :'.$numero.'                         '.$fecha_registro.'',0,12);
$pdf->Cell(4,7.5,''.$_GET['an'].' x '.$_GET['al'].' - '.$color.' - Lam:'.$_GET['laminas'].'      PE:'.$_GET['p'].' BQ:'.$_GET['b'],0,10);
$pdf->Cell(4,0,''.$_GET['d'],2,10);
$pdf->Code39(12,$cont,$_GET['cod_barra'].$i,1,6);
//$pdf->Code39(12,$cont,72280700,1.4,12);

//$pdf->SetFont('Arial','B',8);
//$pdf->Cell(72,-10,strtoupper($obra).' '.$nombre.' ',0,18,'R');
//$pdf->Cell(87,4,'TEMPLADO S.A           ('.$i.'/'.$_GET['cant'].')               O.P :'.$numero.'                         '.$fecha_registro.'',0,13,'R');
//$pdf->Cell(66,7,''.$_GET['an'].' x '.$_GET['al'].' ,'.$color.'   lam:'.$_GET['laminas'].'           '.$_GET['u'].'',0,12,'R');
//$pdf->Cell(92,0,''.$name.'',2,12,'R');
//$pdf->Code39(12,$cont,$_GET['cod_barra'],1,6);
 

}

 $pdf->Output();


?>


