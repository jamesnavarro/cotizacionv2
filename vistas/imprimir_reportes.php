<?php
include "../modelo/conexion.php";
@unlink("reporte.csv");//xlsx
$ar = @fopen("reporte.csv","a")or
        die("error Prueba 1");
$req5=("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.tip asc ");

    $request5=  mysql_query($req5);
    $c1=0;

fputs($ar,"Tipo");
fputs($ar,";");
fputs($ar,"Descripcion");
fputs($ar,";");
fputs($ar,"Ancho X Alto");
fputs($ar,";");
fputs($ar,"Vidrio");
fputs($ar,";");
fputs($ar,"Cantidad");
fputs($ar,";");
fputs($ar,"V.Unidad");
fputs($ar,";");
fputs($ar,"V. Total");
fputs($ar,";");
fputs($ar,"Total+Iva");
fputs($ar,chr(13).chr(10));
fclose($ar);
 $tacot = 0;$can = 0; $gt = 0; $tr = 0;$con = 0;
    while($row=mysql_fetch_array($request5))
	{     
//------------------------------------------------------------------------------
        $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
                
                
                
                if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
                }else{
                if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
                }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
                }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
                }
                } 
            }
            $comp=mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysql_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysql_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysql_fetch_array($ak);
            $mtk = $ck['count(*)'];
            
               $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysql_fetch_array($compu)){
 
          $costo_sp += $fila['valor_sp'] *$fila['cantidad_c_sub'];
          $costo_fom_sp += $fila['valor_fom_sp']*$fila['cantidad_c_sub'];
          $costo_mp += $fila['valor_c_sub']*$fila['cantidad_c_sub'];
          $costo_fom_mp += $fila['valor_fom_sub']*$fila['cantidad_c_sub'];
    }
            $t = $d + $mt + $mtk;
            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           $a = ((($row["valor_c"] + $tk)) + $pad) / $mult ;
            
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $con = $con + 1;
            
      
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
        
            $tacot = $tacot + $ptt;
            
           $tr += $pu;
      
            $iva3 = $ptt * 0.16;
            $tota = $ptt + $iva3;
            $gt += $tota;
            $desc = ''.$row['producto'].', '.$m.','.$d1.'';
//------------------------------------------------------------------------------        
            
$ar = fopen("reporte.csv","a")or
        die("error Prueba 2");
$c1=$c1+1;
$can += $row["cantidad_c"];
        if($c1==0){

        }else{

fputs($ar,$row['tip']);
fputs($ar,";");
fputs($ar,utf8_decode($desc));
fputs($ar,";");
fputs($ar,$row['ancho_c'].'x'.$row['alto_c']);
fputs($ar,";");
fputs($ar,utf8_decode($fv["color_v"]));
fputs($ar,";");
fputs($ar,$row["cantidad_c"]);
fputs($ar,";");
fputs($ar,number_format($pu));
fputs($ar,";");
fputs($ar,number_format($ptt));
fputs($ar,";");
fputs($ar,number_format($tota));
fputs($ar,chr(13).chr(10));
fclose($ar);
        }}
        $ar = @fopen("reporte.csv","a")or
        die("error Prueba 3");
fputs($ar,"");
fputs($ar,";");
fputs($ar,"");
fputs($ar,";");
fputs($ar,"");
fputs($ar,";");
fputs($ar,"Totales :");
fputs($ar,";");
fputs($ar,number_format($can));
fputs($ar,";");
fputs($ar,number_format($tr));
fputs($ar,";");
fputs($ar,number_format($tacot));
fputs($ar,";");
fputs($ar,number_format($gt));
fputs($ar,chr(13).chr(10));
fclose($ar);

     
?>

