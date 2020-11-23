<?php
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
</head>
<body>
    
       
                               
                                   
                                        <table>
                                            <tr>
                                                <td colspan=""></td>
                                            </tr>
                                        </table>
                                        Id Cot:<input type="text" disabled id="cot" value="<?php echo $_GET['cot']; ?>">
                                            
<?php
 require '../modelo/conexion.php';
 
 $resu = mysqli_query($conexion,"select * from cotizacion where id_cot = '".$_GET['cot']."' ");
 $c = mysqli_fetch_array($resu);
 $num = $c['numero_cotizacion'].'.'.$c['version'];
 
 $solicitudes = mysqli_query($conexion,"select * from solicitudes_diseno where id_cot='".$_GET['cot']."' ");
 $s = mysqli_fetch_array($solicitudes);
 if($s[0]){
     $disabled = 'disabled';
 }else{
     $disabled = '';
 }
       ?>
                    <br><hr>
                     <div>
                
                            <b> Solicitud de Compra </b><span id="msg"></span>
                             <table style="width:100%">
                                 <tr>
                                     <td>Cotizacion</td>
                                     <td><input type="text" id="cotizacion" value="<?php echo $num; ?>" disabled></td>
                                     <td>Fecha de Registro</td>
                                     <td><input type="text" id="fecha" value="<?php echo date("Y-m-d") ?>" disabled></td>
                                     <td rowspan="3"> 
                                        <button onclick="imp(<?php echo $_GET['cot']; ?>);" id="imp" style="width: 70px;height: 70px" >Imp. Excel</button> 
                                        <button onclick="pdfx(<?php echo $s[0]; ?>);" id="pdf" style="width: 70px;height: 70px" >Imp. PDF</button></td>
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
                                                <th>CANT REQUERIDA</th>
                                                <th>CODIGO</th>
                                                <th>DADO</th>
                                                <th>DESCRICION</th>
                                                <th>MEDIDA</th>
                                                <th>COLOR</th>
                                                 <th>REFERENCIA</th>
                                                <th>PESO(KG)</th>
                                                 <th>AREA</th>
                                                 <th>OPCION</th>
                                            </tr></thead>
                                           <tbody id="mostrar_items_compra">
                                               <?php
                                             $cot = $_GET['cot'];
        $query = mysqli_query($conexion,"select * from  solicitudes_items where id_cotizacion='$cot'");
        $iten = 0;
        $pesot=0;
        $areat=0;
        while($m = mysqli_fetch_array($query)){
            $iten += 1;
            if($m['codigo']=='0'){
               $btn = ''; 
               $peso=0;
               $area=0;
               $di = '';
               $dado='';
            }else{
            $result = mysqli_query($conexion,"select * from  referencias where codigo='".$m['codigo']."'");
            $p = mysqli_fetch_array($result);
               $peso = ($p['peso']*$m['cantidad_sc']);
               $area = ($p['area']*$m['cantidad_sc']);
                $di = 'disabled';
                $dado=$p['dado'];
              $btn = '<img src="../imagenes/pop.png" style="cursor:pointer" onclick="formulario('.$m['codigo'].')">';
            }
               $pesot += $peso;
               $areat += $area;
               $string = substr($m['descripcion_sc'],0,-7);
            $desc = utf8_decode($string);
            $descripcion = str_replace(array("?"),"ñ",$desc);
            echo '<tr>'
            . '<td style="text-align:center">'.$iten.'</td>'
            . '<td style="text-align:center">'.$m['cantidad_sc'].'</td>'
            . '<td> <input type="text" '.$di.' id="c'.$m['id_si'].'" value="'.$m['codigo'].'" style="width:50%"> '.$btn.'</td>'
            . '<td><input type="text" '.$di.' id="d'.$m['id_si'].'" value="'.$dado.'" style="width:50%"></td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$m['perfil_sc'].'</td>'
            . '<td>'.$m['color_sc'].'</td>'
            . '<td>'.$m['referencia_sc'].'</td>'
            . '<td>'.$peso.' Kg</td>'
            . '<td>'.$area.' M<sup>2</td>'
            . '<td><button onclick="actualizar('.$m['id_si'].');">Up</button> </td>';
        }
         echo '<tr>'
            . '<td style="text-align:center"><input type="text" value="'.$iten.'" id="item" style="width:40px"></td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center"><input type="text" value="'.$pesot.'" id="pesot" style="width:40px"></td>'
            . '<td style="text-align:center"><input type="text" value="'.$areat.'" id="areat" style="width:40px"></td>'
            . '<td style="text-align:center"></td>';
         ?>
                                           </tbody> 
                                        </table>  
                        </div>
                                       
                                  
   
</body>
</html>