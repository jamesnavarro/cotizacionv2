<?php
 require '../../modelo/conexion.php';

$altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
$altura = $_GET['altura'];// altura cuerpo fijo
$anchura = $_GET['anchura']; //ancho cuerpo fijo
$anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
$ancho = $_GET['ancho'];
$alto = $_GET['alto'];
$rej = $_GET['rej'];
$lado = $_GET['lado'];
$mul = $_GET['mul'];
$amb = $_GET['amb'];
$par = $_GET['par'];
$yes = $_GET['yes'];
$fija = $_GET['fija'];
$metro = $_GET['metro'];
$med = $_GET['med'];
$can = $_GET['can'];
$calcular = $_GET['calcular'];
$cod = $_GET['cod'];
if($rej!=0){
            $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$cod." and b.id_r_rej=".$rej." ");
            $rt = 0;
            $rowz=mysqli_fetch_array($request_v2);
            
            if($rowz["id_referencia_med"]=='90001'){
                $al = $alto;
            }else if($rowz["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowz["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowz["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$cod." and b.id_r_a=".$rowz["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                include '../../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }
            
            $cant_rej = ($al / $rowz['var3']) * $rowz['multiplo'];
       
            }else{
               $cant_rej = 1;
            }
            if($lado=='Vertical'){
                 $canfach = $vert = 1;
                 $ambos_alto = $amb * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
                 
             }else{
                 $canfach = $hori = 1;
                 $ambos_alto = 0;
                 $ambos_ancho = $amb * ($ancho / 1000)*$hori;
             }
             if($mul=='Si'){
                 $canfach = $canfach  ;
                 $ambos = $amb;
             }else{
                 $canfach = 1;
                 $ambos = 1;
             }
             
             if($fija==1){
                 if($lado=='Vertical'){
                    $medidalado = ($alto/1000);
                 }else{
                    $medidalado = ($ancho/1000);
                 }
                 if($yes=='Si'){
                    $metro = $metro;
                    $res = $can*($medidalado/$metro)*$med*$ambos;
                 }else{
                    $metro = 1;
                     $res = $can*($med/1000);
                 }
                 //$res = $med;
                 
             }else{
                if($calcular=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$can + $ambos_alto +$ambos_ancho;
                }else{
                   if($calcular=='M2'){
                         $res = (($ancho / 1000)) * (($alto/1000))* $can*$canfach;
                   }else{
                    if($yes=='Si'){
                        if($lado=='Vertical'){
                            $res = (($can*$alto) /$metro)*$canfach*$ambos;
                        }else{
                            $res = (($can*$ancho) / $metro)*$canfach*$ambos;
                        }             
                    }else{
                         $res = $can*$canfach*$ambos;//*
                    }            
               }} 
             }
             
             if($med!=1){
                 $m = 1;
             }else{
                 $m = $med;

             }
             $taa = $cant_rej * $res;
            echo $taa;