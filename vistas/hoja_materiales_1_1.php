<?php
if (isset($_GET['exportar'])){
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=desglose".date("Y-m-d H:m:s").".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",true);
}
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>HOJA DE MARTERIALES*</title>
        <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../vistas/desglose/funciones.js?v=2.2" type="text/javascript"></script>
    <script> 
        $(function() {
            mostrar(<?php echo $_GET['cot']; ?>);
        });
        
        </script>
        <style>  
           .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #2A2D2E;font-size: 12px;border-bottom: 1px solid #36393B;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
        #scroll {
            width:628px;
            height:315px;
            background:url(../Images/contenido.jpg);
            overflow:auto;
       }
        </style>
</head>
<body>
    <div id="otros" class="tabcontent">
   <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#alux"><h6><B>Desglose de Aluminio</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#vidx" onclick="mostrar_desglose()"><h6><B>Desglose Resumido</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#accx" onclick="desglose_final()"><h6><B>Desglose Final</B></h6></a></li>
                     <li id="marcar2"><a data-toggle="tab" href="#solicitud" onclick="lista_desglose_accesorios()"><h6><B>Solicitud Compra</B></h6></a></li>
            </ul>  
        <div class="tab-content">
                 <div id="alux" class="tab-pane fade in active">
                               
                                   
                                        <table>
                                            <tr>
                                                <td colspan=""></td>
                                            </tr>
                                        </table>
                                        Id Cot:<input type="text" disabled id="cot" value="<?php echo $_GET['cot']; ?>">
                                        <div class="datagrid"> 
                                            <div style="text-align:right">
                                                <button onclick="procesar()">Procesar DT..</button>
                                            </div>
<?php
 require '../modelo/conexion.php';
 
 
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
             
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Peso'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida T'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfiles'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Check'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              $tac1 =0;
              
              
            
            
              $table = $table.'<tbody id="mostrar_items"></tbody></table>';
              echo $table; 
       ?>
                    <br><hr>
                 
                                        <?php
       echo '<a href="../vistas/imprimir_desglose.php?cot='.$_GET['cot'].'&exportar">Exportar a excel</a>';
   
                                       ?>
                                  
   </div>   
                </div>
            <div id="vidx" class="tab-pane fade in">
                <?php

 
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
                    
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              
              $table = $table.'<th width="10%">'.'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="vermodal()">medida</button>'.'</th>';
             
              $table = $table.'<th class="hidden-phone">'.'Cantidad T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida T'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfiles'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.' </th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

            
              $table = $table.'<tbody id="mostrar_desglose"></tbody></table>';
              echo $table; 
       ?>
            </div>
            <div id="accx" class="tab-pane fade in" style="padding: 15px 15px 15px 15px;">
                <div style="width:970px; height:600px; overflow: scroll;">
                    <a href="../vistas/hoja_materiales_1.php?cot=<?php echo $_GET['cot'] ?>&excel">Descargar en Excel</a>
               <?php
       
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
              
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Acabado Perfil'.'</th>';     
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Tipo (Item)'.'</th>';
              $table = $table.'<th width="10%">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad Requerida'.' </th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              
              $table = $table.'<th width="10%">'.'Peso'.'</th>';
              $table = $table.'<th width="10%">'.'Peso Total'.'</th>';
              $table = $table.'<th width="10%">'.'Perimetro'.'</th>';
              $table = $table.'<th width="10%">'.'Area Total'.'</th>';
              $table = $table.'<th width="10%">'.'Rendimiento P|A'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad  P|A'.'</th>';              
              $table = $table.'<th width="10%">'.'Valor  P|A'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Alumino'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total  P|A'.'</th>';
              
              $table = $table.'<th class="hidden-phone">'.'Cantidad T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida T'.' </th>';
              
    
              $table = $table.'</tr>';
              $table = $table.'</thead>';

            
              $table = $table.'<tbody id="mostrar_final"></tbody></table>';
              echo $table; 
       ?>
            </div>
                 </div>
            <div id="solicitud" class="tab-pane fade in">
                <br>
                <div>
                
                            <b> Solicitud de Compra </b><span id="msg"></span>
                             <table style="width:100%">
                                 <tr>
                                     <td>Cotizacion</td>
                                     <td><input type="text" id="cotizacion" value="<?php echo $num; ?>" disabled></td>
                                     <td>Fecha de Registro</td>
                                     <td><input type="text" id="fecha" value="<?php echo date("Y-m-d") ?>" disabled></td>
                                     <td rowspan="3"> <button onclick="savesc();" style="width: 70px;height: 70px" <?php echo $disabled; ?>>Guardar</button> 
                                         <button onclick="imp(<?php echo $_GET['cot']; ?>);" id="imp" style="width: 70px;height: 70px" >Imp Res.</button> 
                                         <button onclick="impd(<?php echo $_GET['cot']; ?>);" id="impd" style="width: 70px;height: 70px" >Imp Det.</button></td>
                                 </tr>
                                 <tr>
                                     <td>Solicitante</td>
                                     <td><input type="text" id="user" value="<?php echo $_SESSION['nombre'] ?>" disabled></td>
                                     <td>Solicitud No.</td>
                                     <td><input type="text" id="sol" value="<?php echo $s[0]; ?>" disabled></td>
                                 </tr>
                                 <tr>
                                     <td colspan="4"><textarea id="obs" style="width: 97%" placeholder="Observaciones" <?php echo $disabled; ?>><?php echo $s[8]; ?></textarea></td>
                                 </tr>
                             </table>
                             <table class="table table-bordered table-striped table-hover" id="tabla2" style="width:100%">
                                           <thead><tr bgcolor="#D1EEF0">
                                                <th>ITEMS</th>
                                                <th>SISTEMA</th>
                                               
                                                <th>REFERENCIA</th>
                                                <th>DESCRICION</th>
                                                <th>PERTENECE</th>
                                                 <th>CANT</th>
                                                <th>MEDIDA</th>
                                                <th>COLOR</th>
                                                 <th>CODIGO</th>
                                                <th>PESO(KG)</th>
                                                 <th>AREA</th>
                                                 <th>OPCION</th>
                                            </tr></thead>
                                           <tbody id="mostrar_solicitud">
                                            
                                           </tbody> 
                                        </table>  
                        </div>
            </div>
            </div>
    </div>
</body>
</html>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Calcular Perfil</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="contenido">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
if(isset($_GET['excel'])){
    $delimiter = ";";
    $filename = "Desglose" . date('Y-m-dHis') . ".csv";
    //creamos el archivo csv
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ITEM', 'REFERENCIA', 'DESCRIPCION', 'ACABADO DEL PERFIL', 'COLOR PERFIL', 'TIPO','MEDIDA','CANT REQUERIDA','DADO','PESO UND','PESO TOTAL','PERIMETRO UND','AREA TOTAL','RENDIMIENTO P|A','CANTIDAD P|A','VALOR P|A','VALOR ALUMINIO','VALOR TOTAL P|A');
    fputcsv($f, $fields, $delimiter);
    
    $reques=mysqli_query($conexion,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.referencia order by a.referencia asc  ");
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
                     $medtotal = $rowp['med'];
                     $canper = $rowp['med']/$rowp['perfil'];
                   
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*$canper;
                     $codigo = $ref.'-'.$rowp['color'].substr($rowp['perfil'],0,2);
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area'];
                     }
                     if($rowp['color']=='01'){
                         $crudo = 'ANONIZADO';
                     }else{
                         $crudo = 'CRUDO';
                     }
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
                     echo '<tr style="background:'.$color.'">'
                             . '<td>'.$contador.'</td>'
                            
                             . '<td>'.$rowp['referencia'].'</td>'
                             . '<td>'.$codigo.'</td>'
                             . '<td>'.$rowp['descripcion'].'</td>'
                             . '<td>'.$crudo.'</td>'
                             . '<td>'.$rc[0].'</td>'
                             . '<td>'.$ventana.'</td>'
                             . '<td>'.$rowp['perfil'].'</td>'
                              . '<td>'.ceil($canper).'</td>'
                             . '<td>'.$rowp['dado'].'</td>'
                            
                             . '<td>'.number_format($rowp['peso'],2).' Kg</td>'
                             . '<td>'.number_format($pst,2).' Kg</td>'
                             . '<td>'.$area.'</td>'
                             . '<td>'.$areat.'</td>'
                             . '<td>'.$rendimiento.'</td>'
                             . '<td>'.number_format($canpin,2).'</td>'
                             . '<td>'.number_format($vc).'</td>'
                             . '<td>'.number_format($valor_aluminio).'</td>'
                             . '<td>'.number_format($costo_total_pintura).'</td>'
                             
                             . '<td>'.$rowp['can'].'</td>'
                             . '<td>'.$medtotal.'</td>';
                         $lineData = array($contador, $rowp['referencia'], $codigo,$rowp['descripcion'], $crudo, $rc[0], $ventana,
                         $rowp['perfil'],ceil($canper) , $rowp['dado'] ,number_format($rowp['peso'],2) ,number_format($pst,2),$area,$areat,$rendimiento,
                         number_format($canpin,2),number_format($vc),number_format($valor_aluminio),number_format($costo_total_pintura));
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
}