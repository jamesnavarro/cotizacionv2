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
                <td colspan="5">Perfil asociado <?php echo $_GET['perfil'] ?></td>
            </tr>
            <tr>
                <td>Items</td>
                <td>Producto</td>
                <td>Codigo</td>
                <td>Ver</td>
            </tr>
<?php 
    include '../modelo/conexion.php';
    
    $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b where  a.id_p=b.id_p and b.id_ref_alum=".$_GET["id_refe"]." group by a.id_p ");

    while($datos = mysqli_fetch_array($request)){
    
?>

            <tr>
                <td><?php echo $datos['id_p']; ?></td>
                <td><?php echo $datos['producto']; ?></td>
                <td><?php echo $datos['codigo']; ?></td>
                <td><a href="../vistas/?id=add_cot&cod=<?php echo $datos['id_p']; ?>" ><?php echo $datos['id_p']; ?></a></td>

            </tr>
<?php 
    } 
?>
        </table>
    </body>
</html>

