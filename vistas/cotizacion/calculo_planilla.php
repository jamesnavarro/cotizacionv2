<?php
//include '../../../modelo/conexioni.php';
session_start();
$total_costo = $costo_total_item_desp;
$utilidad_gen = 15;
 
    $query = mysql_query("SELECT * FROM costos ");

    $encabezado = '';
    $c = 0;
    $cont=0;
    $porcentajes_totales = 0;
    $td = '';
     $suma_por =0;
     $suma_pvbi = 0;
     $sub_total_base = 0;
     $totales_operador_1 = $total_costo;
     $por_comisiones = 0;
     $total_transporte = 0;
     $total_utilidad = 0;
     $suma_comision = 0;
     $repo = 0;
     $comi = 0;
    while ($fila = mysql_fetch_array($query)){
        $cont ++;
        //1 . linea de codigo para mostrar el encabezado de la lista
        //$t = ($precio_base * $por)/100;
        
        $idc = $fila['id_cos'];
    
        $porci = $fila['porcentaje'];// esta variable esta gueardada en aluvmix con porcentaje_items
        
        
        if ( $fila['variabletres']== 'Si'){
            $total_transporte += $porci/100;
        }else{
            $total_transporte +=0;
        }
        if ($idc== 8){
            $repo = $porci;
        }
        if ( $fila['variabledos']== 'Si'){
            $total_utilidad += $porci/100;
        }else{
            $total_utilidad +=0;
        }
        
        if($encabezado == $fila['categoria_costos']){
            $c = 0; 
        }else{
            if($c==0){
               
                if($cont!=1){
                        
    $total_operador_1 = $total_costo * ($porcentajes_totales/100);
    $total_operador_2 = $total_costo * ($porcentajes_totales/100);
    
    $totales_operador_1 += $total_operador_2;
    
                  $porcentajes_totales = 0;
                }else{
                    $td='';
                } 
            }
            
            $c ++;
           
        }
        $porcentajes_totales += $porci;
        //1. ____----------------------------------------------------
        //esta linea de codigo es para habilitar y deshabilitar las cajas de textos
        if ( $fila['suma_toral']== 'No'){
            $disabled='disabled';
        }else{
            $disabled='';
        }
        if ( $fila['edita_valor']== 'No'){
            $disabled_valor='disabled';
        }else{
            $disabled_valor='';
        }
        if ( $fila['variabledos']== 'No'){
            $x='x';
        }else{
            $x='';
        }
        if ( $fila['suma_porcentaje']== 'Si'){
            $no = '*';
            $suma_por +=$porci;
        }else{
            $suma_por +=0;
            $no = '';
        }
         $costo_pviv = $total_costo * $porci;
         if ( $fila['variabletres']== 'Si'){
            $s='>';
            $suma_pvbi += $porci;
           
            $sub_total_base += $costo_pviv;
        }else{
            $s='';
            $suma_pvbi += 0;
            $sub_total_base += 0;
        }
        if ( $fila['variableuno']== 'Si'){
            $co='c';
            $p_com = ($porci/100) * 1.1;
            $por_comisiones += $p_com;
            $suma_comision += $porci;
            
        }else{
            $p_com = 0;
            $co='';
            $por_comisiones += 0;
            $suma_comision += 0;
        }
         if ( $fila['categoria_costos']== 'Comisiones'){
             $comi += $porci;
         }else{
             $comi += 0;
         }
        
        $operador_1 = $total_costo * ($porci/100);
        //fin ----------------------------------------------------------------------precio_base_1
$precio_base = $total_costo / ((100-$suma_por) / 100);

$sub_precio_base_2 = $precio_base * 0.15;
$precio_base_2 = $sub_precio_base_2 + $precio_base;

$sub_suma_pvbi = ($suma_pvbi/100) * $precio_base;
$total__pvbi = $sub_suma_pvbi + $precio_base;

$sub_suma_pvbi_2 = ($suma_pvbi/100) * $precio_base;
$total__pvbi_2 = $sub_suma_pvbi_2 + $precio_base_2;

$ganancia_esperada_1 = $precio_base * (0 /100);
$ganancia_esperada_2 = $total__pvbi_2 * (($utilidad_gen/100) + 1);
$encabezado = $fila['categoria_costos'];

    }

    
  $ganancia_2 = ($utilidad_gen / 100);
$precio_base =  $total_costo / ((100 - $suma_por)/100) ;  //precio base 1
$precio_base_2 = $precio_base * $ganancia_2;
$precio_base_2 = $precio_base + $precio_base_2;
// if($_SESSION['k_username']=='admin'){
//    echo '<script>alert("$precio_base '.$precio_base.'  ")</script>';
// }
//nueva formula 2018-------------------------------------------------------------

$rep = $precio_base * ($repo/100); //    var rep = base * (repo/100);
$costo = $precio_base + $rep; //    var costo = parseFloat(base) + parseFloat(rep);
$port = 1 - ((1-($comi/100)) / (($utilidad_gen/100)+1));//    var por = 1 - ((1-(comi/100)) / ((util/100)+1));
$precio = $costo / (1 - $port);//    var precio = costo / (1 - parseFloat(por));

// if($_SESSION['k_username']=='admin'){
//    echo '<script>alert("$precio '.$precio.'  ")</script>';
// }
//fin nueva formula----------------------------------------------------

 $pvbi_1 = ($precio_base * ($total_transporte)) + $precio_base;
$pvbi_2 = ($precio_base * ($total_transporte)) + $precio_base_2 ;
 $total_utilidad =   ($precio_base *  $total_utilidad);  
 $utilidad_neta = $precio_base_2 - $total_costo - $total_utilidad;  // Utilidad Neta del Proyecto

 $gan_2 = $pvbi_2 * $ganancia_2;
 // var precio_venta_total = parseFloat(precio_venta_base_2) + parseFloat(com) + parseFloat(ajuste_precio);
 //echo '<br>Precio base tt '.$precio_base_2.'<br>';
 $com = $precio_base_2 * ($suma_comision/100);
  //echo '<BR>cOMISION'.($com);
 $id=$suma_comision;
 $query4 = mysql_query("SELECT incremento FROM comisiones where comision<'$id' order by id_comision desc limit 1"); //consultA modificada por navabla
 $fila = mysql_fetch_array($query4);
$inc = $fila['incremento']/10; 

 //var t_ganancia = (precio_venta_base_2 * (incremento/100)) + parseFloat(gan_2);
 $t_ganancia = ($pvbi * $inc) + ($gan_2);
//  if($_SESSION['k_username']=='admin'){
//    echo '<script>alert("$t_ganancia '.$t_ganancia.' - $utilidad_neta '.$utilidad_neta.'   ")</script>';
// }
 $ajuste_precio = $t_ganancia - $utilidad_neta;
 $precio_venta_total = ($pvbi_2) + ($com) + $ajuste_precio;
// if($_SESSION['k_username']=='admin'){
//    echo '<script>alert("$pvbi_2 '.$pvbi_2.' + $com '.$com.' + $ajuste_precio '.$ajuste_precio.' = $precio_venta_total '.$precio_venta_total.'  ")</script>';
// }
 //$precio_venta_total = $precio;  // se agrego esta linea por motivo de la nueva formula
//echo $pvbi_2.' + '.$com.'+ '.$ajuste_precio.' UN: '.$t_ganancia.' - '.$utilidad_neta.'<br>';
//echo number_format($precio_venta_total,2,'.','');
//echo  $totdesacc .'+'.$totdesalu.'+'.$totdesvid.'+'.$totalespa.'+'.$suma_acc.'+'.$total_alum.'+'.$fabricacion.'+'.$instalacion.'+'.$poli;