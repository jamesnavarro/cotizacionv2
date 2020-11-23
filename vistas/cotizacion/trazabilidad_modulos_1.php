<?php
$total_costo_vidrio = 0;
$total_despe_vidrio = 0;
//$peso_vidrio = 0;
//echo '<script>alert("vidrio id_vidrio='.$idvidrio.' ");</script>';
        if($id_vidrio!=0){
                          //$idvidrio = $id_vidrio; // espesor del vidrio
                          //if($termo1!=0){$traz_vid=$termo1;}
                          $idtraz = $traz_vid;    // trazabilidad del vidrio
                          $cantidad = $cant_item;
                          //echo 'vi:'.$idtraz;
                          $m2 = $metro_t; // metros totales
                          include 'trazabilidad_vidrio.php';
                            $total_costo_vidrio += $totalv1sp;
                            $total_despe_vidrio += $totalv1;
                            $peso_vidrio +=$peso;

                 }
             
         if($id_vidrio2!=0){
              //$idvidrio = $id_vidrio2; // espesor del vidrio
              if($termo2!=0){$idtraz=$termo2;}else{$idtraz = $traz_vid;}
              //$idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              $idvidrio = $idvidrio2;
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }
         if($id_vidrio3!=0){
              //$idvidrio = $id_vidrio3; // espesor del vidrio
               if($termo3!=0){$idtraz=$termo3;}else{$idtraz = $traz_vid;}
              //$idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              $idvidrio = $idvidrio3;
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }
         if($id_vidrio4!=0){
              //$idvidrio = $id_vidrio4; // espesor del vidrio
              if($termo4!=0){$idtraz=$termo4;}else{$idtraz = $traz_vid;}
              //$idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              $idvidrio = $idvidrio4;
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }

