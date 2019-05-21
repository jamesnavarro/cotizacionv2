<?php
if (isset($_GET['exportar'])){
//header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//header("Content-type:   application/x-msexcel; charset=utf-8");
//header("Content-Disposition: attachment; filename=desglose".date("Y-m-d H:m:s").".xls"); 
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Cache-Control: private",true);
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
    <title>HOJA DE MARTERIALES</title>
        <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
<!--    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"> Base Theme Color 
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"> Boxed Background 
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">-->

    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../vistas/solicitudes/funciones.js" type="text/javascript"></script>
    <script> 
        $(function() {
            mostrar(<?php echo $_GET['cot']; ?>);
        });
        </script>
        <style>  
           .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #2A2D2E;font-size: 12px;border-bottom: 1px solid #36393B;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }</style>
</head>
<body>
    
       
                               
                                   
                                        <table>
                                            <tr>
                                                <td colspan=""></td>
                                            </tr>
                                        </table>
                                      
                                        <div class="datagrid">                                    
<?php
 require '../modelo/conexion.php';
 
 $resu = mysql_query("select numero_cotizacion,version,obra from cotizacion where id_cot = '".$_GET['cot']."' ");
  
 $c = mysql_fetch_array($resu);
 $num = $c['numero_cotizacion'].'.'.$c['version'];
 $obra = $c['obra']; 
  
 $reques=mysql_query("SELECT * FROM producto a, cotizaciones c, desgloses d, referencias e where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and d.id_referencia=e.id_referencia and a.id_p=d.id_producto and c.estado_item='Aprobado' ORDER BY e.referencia, c.cantidad_c ASC");
 //$reques=mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and estado_item='Aprobado' ORDER BY c.fila ASC ");
  
              $table = '<p><center>Nombre de la Obra: '.$obra.' <br> DESGLOSE DE ALUMINIOS AGRUPADOS - COTIZACION '.$num.' </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="2%">'.'Item'.'</th>';
              $table = $table.'<th  width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="15%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Segmentos'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant Totales'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.' </th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              $tac1 =0;
	while($row=mysql_fetch_array($reques))
	{
            
                  //parte principal del producto.......................
                  //$tac1 +=1;
                  $idcot = $row['id_cotizacion'];
                  $idpro = $row['id_referencia'];
                  $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                  $fv =mysql_fetch_array(mysql_query($cons_vi));
                  $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                  $fv2 =mysql_fetch_array(mysql_query($cons_vi2));
                  $_GET['l']= $row["imagen"]; $_GET['mod']= $row["modulo"];$_GET['per']= $row["per"]; $_GET['boq']= $row["boq"];
                  $_GET['ref']= $row["id_referencia"]; $_GET['idcot']= $row["id_cotizacion"]; $_GET['tv']= $row["traz_vid"];$_GET['tv2']= $row["traz_vid2"];$_GET['tv3']= $row["traz_vid3"];$_GET['tv4']= $row["traz_vid4"];
                  $_GET['aa']= $row["ancho_abajo"];$_GET['ancho']= $row["ancho_c"];$_GET['alto']= $row["alto_c"];
                  $_GET['cant']= $row["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
                  $_GET['id_v']= $row["id_vidrio"];$_GET['id_v2']= $row["id_vidrio2"];$_GET['id_v3']= $row["id_vidrio3"];
                  $_GET['id_v4']= $row["id_vidrio4"]; $_GET['id_v5']= $row["id_vidrio5"];$_GET['id_v6']= $row["id_vidrio6"];         
                  $_GET['id2_v']= $row["id2_vidrio"];$_GET['id2_v2']= $row["id2_vidrio2"];$_GET['id2_v3']= $row["id2_vidrio3"];
                  $_GET['id2_v4']= $row["id2_vidrio4"]; $_GET['id2_v5']= $row["id2_vidrio5"];$_GET['id2_v6']=  0;   
                  $_GET['id3_v']= $row["id3_vidrio"];$_GET['id3_v2']= $row["id3_vidrio2"];$_GET['id3_v3']= $row["id3_vidrio3"];
                  $_GET['id3_v4']= $row["id3_vidrio4"]; $_GET['id3_v5']= $row["id3_vidrio5"];$_GET['id3_v6']= 0;       
                  $_GET['id4_v']= $row["id4_vidrio"];$_GET['id4_v2']= $row["id4_vidrio2"];$_GET['id4_v3']= $row["id4_vidrio3"];
                  $_GET['id4_v4']= $row["id4_vidrio4"]; $_GET['id4_v5']= $row["id4_vidrio5"];$_GET['id4_v6']= 0;
                  $_GET['cuerpo']= $row["cuerpo"]; $_GET['hojas']= $row["hojas"];$_GET['ins']= $row["install"];$_GET['por']= $row["porcentaje_mp"];
                  $color= $row["color_ta"];  $_GET['v']= $row["verticales"]; $_GET['h']= $row["horizontales"]; $_GET['d1']= $row["d1"];$_GET['dias']= $row["duracion"];

                        $ancho= $_GET['ancho'];$aa= $_GET['aa'];
                        $alto= $_GET['alto'];
                        $altura= $_GET["cuerpo"];
                        $altura_ventana = $_GET['alto']-$_GET['cuerpo'];

                        $altura_v_c =$_GET['alto']- $altura;

             $tac1 +=1; 
            if($row['lado']=='Horizontal'){
                if($row['medida_des']==3){$med = $anchura;}
                if($row['medida_des']==4){$med = $anchura_v_c;}
                if($row['medida_des']==6){$med = $_GET['ancho'];}
            
            }else{
                if($row['medida_des']==1){$med = $altura;}
                if($row['medida_des']==2){$med = $altura_v_c;}
                if($row['medida_des']==5){$med = $_GET['alto'];}
            }
            if($med>7100){
                $dec = intval($med / 7100);
               $lon = 7100;
               $can_seg2 = round($med /$lon);
               
               $cp = ($row["cantidad"]*$_GET['cant']) * $can_seg2;
            }else{
               $dec = intval(7100 / $med);
               $lon = $med * $dec + 100;
               $can_seg = intval($lon / $med);
               $cp = ($row["cantidad"]*$_GET['cant']) / $can_seg;
            }
            $medx = round($lon,-2);
            if($medx<4200){
                $style = 'background:red;';
            }else{
                $style= '';
            }

            $table = $table.'<tr>'
                    . '<td  width="2%" style="text-align:center">'.$tac1.'</td>'
                    . '<td  width="10%" style="text-align:center">'.$row['codigo'].'</td>'
                    . '<td width="30%">'.utf8_decode($row['descripcion']).'</td>'
                    . '<td width="10%">'.$row['referencia'].''
                     . '<td width="15%">'.$color.'</td>'
                    . '<td width="10%">'.$row['dado'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$med.' mm</td>'
                    . '<td width="10%" style="text-align:center">'.$_GET['ancho'].'</td>'
                    . '<td width="10%" style="text-align:center">'.$_GET['alto'].'</td>'
                    . '<td width="10%" style="text-align:center">'.$_GET['cant'].'</td>'
                    . '<td width="10%" style="text-align:center">'.$row["cantidad"].'</td>'
                    . '<td width="10%" style="text-align:center">'.ceil($cp).'</td>'
                    . '<td width="10%">'.round($lon,-2).'</td>'
                    . ''
//                    . '<td><a href="javascript:void(0)" onclick="up_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Editar</button></a></td>'
                    . '</tr>';   
 
            }
       //pegar aqui codigo eliminado
            
                    	$table = $table.'</table>';
       echo $table; 
       ?>
                                  
   </div>   
</body>
</html>