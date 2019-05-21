<?php
   $request=mysql_query("SELECT * FROM producto a, cotizaciones c, cotizacion b where b.id_cot=c.id_cot and c.id_referencia=a.id_p and b.registrado like '%".$ciu['usuario']."%' ");
  
if($request){
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysql_fetch_array($request))
	{    
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
           
            $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$row["id_cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($sub=mysql_fetch_array($compu)){
          $costo_sp += $sub['valor_sp'] *$sub['cantidad_c_sub'];
          $costo_fom_sp += $sub['valor_fom_sp']*$sub['cantidad_c_sub'];
          $costo_mp += $sub['valor_c_sub']*$sub['cantidad_c_sub'];
          $costo_fom_mp += $sub['valor_fom_sub']*$sub['cantidad_c_sub'];
    }
            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           $a = ((($row["valor_c"] + $tk)) + $pad) / $mult ;
           
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;


            $iva3 = $ptt * 0.16;
            $tota = $ptt + $iva3;

                
	}     
} 

