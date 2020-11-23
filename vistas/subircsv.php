<?php
include '../modelo/conexion.php';
if(isset($_POST["action"])){
if ($_POST["action"] == "upload") {
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "../files/".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
        echo $status;
}
$fila = 0;
$fp = fopen($destino, "r");
while (!feof($fp)) 
    { //leo el fichero de a un renglon por vez 27844 version 5 a 6 
    $fila++;
    $data = explode(";", fgets($fp));
if($data[0]!=''){
    $ref = $data[0];
    $peso = $data[1];
    $peri = $data[2];
   
    $sql = "UPDATE referencias SET peso='".$peso."',area='".$peri."' WHERE referencia='".$ref."' and grupo='Perfileria' ";
    mysqli_query($conexion,$sql);
    
    $sql2 = "UPDATE conf_referencias SET peso='".$peso."',area='".$peri."' WHERE referencia='".$ref."' and id_linea_ref='1' ";
    mysqli_query($conexion,$sql2);
       
}
echo $ref.' - '.$peso.' - '.$peri.' <br>';
}

//cerramos el fichero
//fclose($csv);
//
//if($co=='01002'){echo $codigo.'<br>'.$pt.'<br>'.$precio.'<br>';
//}
echo 'Cargado con exitos';
}
echo '<a href="../files/borrar.php?arc='.$archivo.'">regresar</a>';
      //echo '<script lanquage="javascript">alert("Se han cargados los archivos exitosamente");location.href="index.php"</script>';
		