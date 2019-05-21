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
                <td>Precio del Dolar</td>
                <td>Precio Lista</td>
                <td>Precio Contable</td>
                <td>Actualizado Por:</td>
            </tr>
<?php 
    include '../modelo/conexion.php';
    
    $query = "SELECT * FROM dolares a,dolar_relaciones b where a.id_dolar = b.id_dolar and b.id_referencia = '".$_GET['id_refe']."' ";
    $res = mysql_query($query);
    
    while($datos = mysql_fetch_array($res)){
    
    $precio = $datos['precio_dolar'];
    $precio2 = $datos['precio_actual'];
      $precio3 = $datos['precio_act_fom'];
    $fecha = $datos['fecha_reg_dolar'];
    $ingresado = $datos['ingresado_por'];
?>

            <tr>
                <td><?php echo $datos['id_dolar']; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo '$'.number_format($precio); ?></td>
                <td><?php echo '$'.number_format($precio2); ?></td>
                <td><?php echo '$'.number_format($precio3); ?></td>
                <td><?php echo $ingresado; ?></td>
            </tr>
<?php 
    } 
?>
        </table>
    </body>
</html>

