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
                <td>Actualizado Por:</td>
            </tr>
<?php 
    include '../../modelo/conexion.php';
    
    $query = "SELECT * FROM dolar_actual order by id_actual desc ";
    $res = mysqli_query($conexion,$query);
    
    while($datos = mysqli_fetch_array($res)){
    
    $precio = $datos['precio'];

    $fecha = $datos['fecha'];
    $ingresado = $datos['modificado'];
?>

            <tr>
                <td><?php echo $datos['id_actual']; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo number_format($precio,2); ?></td>

         
                <td><?php echo $ingresado; ?></td>
            </tr>
<?php 
    } 
?>
        </table>
    </body>
</html>
