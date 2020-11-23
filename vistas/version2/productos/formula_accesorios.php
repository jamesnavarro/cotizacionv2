<?php

if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
            $id_p= $fil_an["id_p"];
             $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; //ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
             if($row["lado"]=='Vertical'){
                 $canfach = $vert;
                 $ambos_alto = $row["ambos"] * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
                 
             }else{
                 $canfach = $hori;
                 $ambos_alto = 0;
                 $ambos_ancho = $row["ambos"] * ($ancho / 1000)*$hori;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach  ;
                 $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                 $ambos = $row["ambos"];
             }
             //formula para calcular medida fijas
             if($row['fija']==1){
                 $res = $row["cantidad_acc"]*($row["med"]/1000);
             }else{
                if($row['calcular']=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
                }else{
                   if($row['calcular']=='M2'){
                         $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"]*$canfach;
                   }else{
                    if($row["yes"]=='Si'){
                        if($row["lado"]=='Vertical'){
                            $res = (($row["cantidad_acc"]*$alto) / $row["metro"])*$canfach*$ambos;
                        }else{
                            $res = (($row["cantidad_acc"]*$ancho) / $row["metro"])*$canfach*$ambos;
                        }             
                    }else{
                         $res = $row["cantidad_acc"]*$canfach*$ambos;
                    }            
               }} 
             }//se  quito }
