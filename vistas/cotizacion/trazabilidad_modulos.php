<?php
$total_costo_vidrio = 0;
$total_despe_vidrio = 0;
$peso_vidrio = 0;
        if($id_vidrio!=0){
                          $idvidrio = $id_vidrio; // espesor del vidrio
                          $idtraz = $traz_vid;    // trazabilidad del vidrio
                          $cantidad = $cant_item;
                          $m2 = $metro_t; // metros totales
                          include 'trazabilidad_vidrio.php';
                            $total_costo_vidrio += $totalv1sp;
                            $total_despe_vidrio += $totalv1;
                            $peso_vidrio +=$peso;

                 }
         if($id_vidrio2!=0){
              $idvidrio = $id_vidrio2; // espesor del vidrio
              $idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }
         if($id_vidrio3!=0){
              $idvidrio = $id_vidrio3; // espesor del vidrio
              $idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }
         if($id_vidrio4!=0){
              $idvidrio = $id_vidrio4; // espesor del vidrio
              $idtraz = $traz_vid;    // trazabilidad del vidrio
              $cantidad = $cant_item;
              $m2 = $metro_t; // metros totales
              include 'trazabilidad_vidrio.php';
                $total_costo_vidrio += $totalv1sp;
                $total_despe_vidrio += $totalv1;
                $peso_vidrio +=$peso;
         }

