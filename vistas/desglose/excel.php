<?php
  include('../modelo/conexion.php');
$delimiter = ";";
    $filename = "Desglose" . date('Y-m-dHis') . ".csv";
    //creamos el archivo csv
    $f = fopen('php://memory', 'w'); 
    
    
    //set column headers
    $fields = array('ITEM','CANT REQUERIDA', 'REFERENCIA', 'CODIGO', 'DESCRIPCION', 'ACABADO DEL PERFIL', 'COLOR PERFIL', 'TIPO','MEDIDA','DADO','PESO UND','PESO TOTAL','PERIMETRO UND','AREA TOTAL','RENDIMIENTO '.$pin,'CANTIDAD PA','VALOR '.$pin,'VALOR ALUMINIO','VALOR TOTAL '.$pin.'','OBSERVACIONES');
    fputcsv($f, $fields, $delimiter);
    
    $reques=mysqli_query($conexion,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where a.linea='Perfileria' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.referencia, a.perfil order by b.sistema asc ");
                $contador=0;
                $ref = '';
                $sw=0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     if($ref!=$rowp['referencia']){
                         if($sw==0){
                           $color='#F3EFEE'; //1
                           $sw=1;
                        }else{
                            $color='#C6C5C5'; //0
                            $sw=0;
                        }
                     }else{
                         if($sw==0){
                           $color='#C6C5C5'; //1
                           $sw=0;
                        }else{
                            $color='#F3EFEE'; //0
                            $sw=1;
                        }
                     }
                     
                     $ref = $rowp['referencia'];
                     $medres = mysqli_query($conexion,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' ");
                     $md = mysqli_fetch_array($medres);
                     $medtotal = $md['med'];
                     $canper = $md['med']/$rowp['perfil'];
                   
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*ceil($canper);
                    
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area']/1000;
                     }
                     if($rowp['color']=='01'){
                         $crudo = 'ANONIZADO';
                         $codcolor = '01';
                     }else{
                         $crudo = 'CRUDO';
                         $codcolor = '00';
                     }
                     $codigo = $ref.'-'.$codcolor.substr($rowp['perfil'],0,2);
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                     $resultc = mysqli_query($conexion,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
                     
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($conexion,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    
                    $costo_total_pintura = $canpin * $vc;
                    
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    
                    $queryma = mysqli_query($conexion,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                     $mystring = $rowp['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowp['descripcion'].' '.$rowp['perfil'].'MM' ;
                    } else {
                        $descripcion = substr($rowp['descripcion'],0,-6).' '.$rowp['perfil'].'MM';
                    }
                    if($contador==1){
                           $lineData1 = array($rowp['sistema']);
                           fputcsv($f, $lineData1, $delimiter);
                        }
                    if($sistema!=$rowp['sistema']){
                         $lineData2 = array($rowp['sistema']);
                           fputcsv($f, $lineData2, $delimiter);
                     }
                     
                      $sistema = $rowp['sistema'];
                         $lineData = array($contador,ceil($canper) , $rowp['referencia'], $codigo,$descripcion, $crudo, $rc[0], substr($ventana,0,-1),
                         $rowp['perfil'], $rowp['dado'] ,number_format($rowp['peso'],2) ,number_format($pst,2),number_format($area,2),number_format($areat,2),number_format($rendimiento,2),
                         number_format($canpin,2),($vc),number_format($valor_aluminio),number_format($costo_total_pintura), $rowp['observaciones']);
                         fputcsv($f, $lineData, $delimiter);

                 }
                 //move back to beginning of file
    fseek($f, 0);
//    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
    exit; 

