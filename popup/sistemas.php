<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Sistemas</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/sistemas/funciones.js?v=1.1"></script>
<script language="javascript" type="text/javascript">
    
function pasar(sis){
    var ide = $('#in').val();
    var c = confirm("Esta seguro de actualizar esta referencia  al sistema agregado = "+sis+" ? ");
        if(c){
            window.opener.pasar_sistema(ide,sis);
            window.close();
        }
}
</script>
       
</head>
<body>
    <div>
        <h3>Lista de Sistemas</h3>
    </div>

<?php
include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysqli_query($conexion,'SELECT * FROM sistemas WHERE id_sistema="'.$_GET['codigo'].'"');
     while($row2=mysqli_fetch_array($request2))
	{     
              $a = $row2["id_sistema"];
              $b = $row2["nombre_sistema"];

           ?>

    <input type="text" name="alm1" id="id_ref" readonly value="<?php echo $a ?>" />
    <input type="text" name="alm1" id="ref" readonly value="<?php echo $b ?>" />

<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }

        }else{
         include '../modelo/conexion.php';
         ?>
Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Codigo o Descripcion"><input type="text" id="in" value="<?php echo $_GET['id'] ?>" disabled><br>

<div class="datagrid" id="empleados">
    <?php        include '../popup/sistemas/mostrar_tabla.php';  ?>
            
            
       </div>
                  
        <?php } ?>                    
</body>
</html>

         

                              
                                