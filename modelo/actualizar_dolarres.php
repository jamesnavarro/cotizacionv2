<?php
include 'conexion.php';
session_start();
	$precio = $_GET['dolar'];
        mysqli_query($conexion,"insert into dolar_actual (precio,modificado) values ('$precio','".$_SESSION['k_username']."') ");
        $dolarmax = mysqli_insert_id($conexion);

// se hace la consulta del ultimo dolar
        
//        $query1 = mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1");
//        $qa = mysqli_fetch_array($query1);
        
        //mysqli_query($conexion,"insert into dolares (precio_dolar,fecha_reg_dolar,ingresado_por,lma,prima,precio_actual) select '$precio','".date("Y-m-d")."','".$_SESSION['k_username']."',lma,prima,precio_actual from dolares order by id_dolar desc limit 1 ");
        //nuevo id generado
        //$idnew = mysqli_insert_id($conexion); 
        
        //se consulta todas las referencias
        $query2 = mysqli_query($conexion,"select * from referencias where grupo not in ('Vidrio') ");
        while($q = mysqli_fetch_array($query2)){
            $costo = $q['costo_mt'];
            $grupo = $q['grupo'];
            $codigo = $q['codigo']; 
            $id_referencia = $q['id_referencia'];
            $precio_dolar = $costo / $precio;
            mysqli_query($conexion,"insert into dolar_relaciones_vidrio (id_dolar,id_referencia,precio_actual,precio_act_fom,cod_ref,precio_dolar,categoria)"
                                           . " values('$dolarmax','$id_referencia','$costo','$costo','$codigo','$precio_dolar','$grupo')");
            
            mysqli_query($conexion,"update referencias set costo_usd='$precio_dolar' where id_referencia='$id_referencia' ");
//            mysqli_query($conexion,"update dolar_relaciones set categoria='$grupo' where id_referencia='$id_referencia' "); ··#
        }
        
        $query3 = mysqli_query($conexion,"select * from tipo_vidrio ");
        while($q = mysqli_fetch_array($query3)){
            $costo = $q['costo_v'];
            $grupo = 'Vidrio';
            $id_referencia = $q['id_vidrio'];
            $codigo = $q['codigo_vid'];
            $precio_dolar = $costo / $precio;
            mysqli_query($conexion,"insert into dolar_relaciones_vidrio (id_dolar,id_referencia,precio_actual,precio_act_fom,cod_ref,precio_dolar,categoria)"
                                           . "values ( '$dolarmax','$id_referencia','$costo','$costo','$codigo','$precio_dolar','$grupo' ) ");
            
            mysqli_query($conexion,"update tipo_vidrio set costo_usd='$precio_dolar' where id_vidrio='$id_referencia' ");
            //mysqli_query($conexion,"update dolar_relaciones_vidrio set categoria='$grupo' where id_referencia='$id_referencia' ");
        }
        
        
        