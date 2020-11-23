<html>
    <head>
        <title>Historial</title>
        <style>
            .tabla{
                width: 100%;
                text-align: center;
                border: 1px solid black
            }
        </style>
    </head>
    <body>
        <table rules="all" class="tabla">
            <tr bgcolor="#D1EEF0">
                <td colspan="6">Historial de Actualizacion de Dolar</td>
            </tr>
            <tr>
                <td>Id</td>
                <td>Fecha de Ingreso</td>
                <td>Dolar</td>
                <td>Precio USD</td>
                <td>Precio COP.</td>
           
                <td>Actualizado Por:</td>
            </tr>
<?php 
    include '../../modelo/conexion.php';
    if(isset($_GET['tipo'])){
        $tipo = ' ';
    }else{
        $tipo = 'and categoria="Vidrio" ';
    }
    $query = "SELECT *, a.precio as pd FROM dolar_actual a,dolar_relaciones_vidrio b where a.id_actual = b.id_dolar and b.id_referencia = '".$_GET['id']."' $tipo ";
    $res = mysqli_query($conexion,$query);
    
    while($datos = mysqli_fetch_array($res)){
    
    $precio = $datos['precio_dolar'];
    $precio2 = $datos['precio_actual'];
      $precio3 = $datos['precio_act_fom'];
    $fecha = $datos['fecha'];
    $ingresado = $datos['modificado'];
?>

            <tr>
                <td><?php echo $datos['id_dolar']; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo $datos['pd']; ?></td>
                <td><?php echo '$'.number_format($precio,2); ?></td>
                <td><?php echo '$'.number_format($precio2); ?></td>
         
                <td><?php echo $ingresado; ?></td>
            </tr>
<?php 
    } 
?>
        </table>
    </body>
</html>
