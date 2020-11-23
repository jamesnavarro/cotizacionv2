<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
include '../modelo/conexion.php';
$consulta = mysqli_query($conexion,"select * from cotizaciones a, producto b where a.id_referencia=b.id_p and a.id_cotizacion=".$_GET['id']." ");
$row = mysqli_fetch_array($consulta);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="file" name="imagen" value="">
            <input type="submit" value="Cambiar" name="in">
        </form>
                <fieldset>
            <legend>Imagen Original</legend>
            <?php
             list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
                     if($row["al"]==0){$pi2= $alto;}else{$pi2= $row["al"];}
                 echo '<img src="../producto/'.$row["ruta"].'"  width="'.$pi1.'px"  height="'.$pi2.'px">';
            ?>
                </fieldset>
        <fieldset>
            <legend>Imagen Adicional</legend>
            <?php 
            
                            if($row["imagen_mas"]!=''){
                    $fi = '../adicionales/'.$row["imagen_mas"];
                    list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                    
                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
                     if($row["al"]==0){$pi2= $alto;}else{$pi2= $row["al"];}
                    $img = '<img src="../adicionales/'.$row["imagen_mas"].'" width="'.$pi1.'px" height="'.$pi2.'px">';
                }else{
                    
               $img = '<img src="../img/pattern.png" width="35px" height="35px">';}
echo $img;

            ?>
            <a href="../vistas/imagen.php?id=<?php echo $_GET['id'] ?>&del"><img src="../imagenes/eliminar.png"></a>
        </fieldset>
    </body>
</html>
<?php
if(isset($_POST['in'])){
                $rutaEnServidor='adicionales';
            $rutaTemporal=$_FILES["imagen"]["tmp_name"];
             $nombreImagen=$_FILES["imagen"]["name"];
             //imagen 2
          
             
            if($nombreImagen==''){
                $rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
                $rutaDestino2=$nombreImagen;
            }else{
                 $rutaDestino='../'.$rutaEnServidor.'/'.$_POST["id"].''.$nombreImagen;
                 $rutaDestino2=$_POST["id"].''.$nombreImagen;
            }
            move_uploaded_file($rutaTemporal,$rutaDestino);
            if($rutaDestino2!=''){$ruta = "`imagen_mas`='".$rutaDestino2."'";}else{$ruta="";}
            
                  $sql = "UPDATE `cotizaciones` SET $ruta  WHERE `id_cotizacion` = ".$_POST["id"].";";
                  mysqli_query($conexion,$sql);
                  echo '<script language="javascript">alert("Se cambio exitosamente");location.href="../vistas/imagen.php?id='.$_POST['id'].' ";window.opener.document.location.reload();</script>';
}
if(isset($_GET['del'])){
     $sql = "UPDATE `cotizaciones` SET imagen_mas=''  WHERE `id_cotizacion` = ".$_GET["id"].";";
                  mysqli_query($conexion,$sql);
    echo '<script language="javascript">alert("Se Elimino la imagen");location.href="../vistas/imagen.php?id='.$_GET['id'].' ";window.opener.document.location.reload();</script>';

}