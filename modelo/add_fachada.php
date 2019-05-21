<?php
// ya insertada la cotizacion se consulta el ulimo registro de la cotizacion
$m = "SELECT max(id_cotizacion) as p FROM cotizaciones";
                $fia =mysql_fetch_array(mysql_query($m));
                $a = $fia["p"];
//se consulta la referencia seleccionada 
$request_ac=mysql_query("SELECT * FROM item_fachada a, referencias b where a.id_ref=b.id_referencia and id_producto=".$ref);
    while($row=mysql_fetch_array($request_ac))
	{     
            $id_f = $row['id_f'];
            
            $sql = "INSERT INTO `item_fachada_c` (`id_cot`, `id_referencia`, `id_fac`, `cantidad_g`, `costo_g`)";
            $sql.= "VALUES ('".$a."', '".$ref."', '".$id_f."', '0', '0')";
            mysql_query($sql, $conexion);
 
            $request_1=mysql_query("SELECT * FROM item_fachada_rep a, referencias b  where b.id_referencia=a.id_referencia and a.id_ver=".$id_f);
            while($row1=mysql_fetch_array($request_1))
	{      
            $id_fr = $row1['id_fr'];
             
           $sql1 = "INSERT INTO `item_fachada_c1` (`id_cot`, `id_c1`)";
            $sql1.= "VALUES ('".$a."', '".$id_fr."')";
            mysql_query($sql1, $conexion);
		
               
	}
           
         $request_2=mysql_query("SELECT * FROM item_fachada_vid a, referencias b  where b.id_referencia=a.id_referencia and a.id_ver=".$id_f);
            while($row2=mysql_fetch_array($request_2))
	{      
            $id_fr2 = $row2['id_fr'];
             
           $sql1 = "INSERT INTO `item_fachada_c2` (`id_cot`, `id_c1`)";
            $sql1.= "VALUES ('".$a."', '".$id_fr2."')";
            mysql_query($sql1, $conexion);
		
               
	}
		
               
	}

