<?php

include "../modelo/conexion.php";

 $sql = "SELECT * FROM detalle_pago where id_prestamo='".$_GET['cod']."'";
        $fila21 =mysql_fetch_array(mysql_query($sql));
        $user= $fila21["user_reg_"]; 
        


unlink($user.".txt");
$ar = fopen($user.".txt","a")or
        die("error");
$req=("SELECT * FROM detalle_pago where id_prestamo='".$_GET['cod']."'");
    $request=  mysql_query($req);
 $ar = fopen($user.".txt","a")or
        die("error");
fputs($ar,'{"aaData":['); 
fputs($ar,chr(13).chr(10));
fclose($ar);
    while($row=mysql_fetch_array($request))
	{     

$ar = fopen($user.".txt","a")or
        die("error");
fputs($ar,"[");       
fputs($ar,'"'.$row['saldo1'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['abono_int'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['abono_cap'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['saldo_dif'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['valor_p'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['fecha_p'].'"');
fputs($ar,",");
fputs($ar,'"'.$row['registrado'].'"');
fputs($ar,"],");
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
    $ar = fopen($user.".txt","a")or
        die("error");
fputs($ar,'["fin","fin","fin","fin","fin","fin","fin"]]}'); 
fputs($ar,chr(13).chr(10));
fclose($ar);

?>
