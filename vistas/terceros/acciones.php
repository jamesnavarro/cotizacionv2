<?php
include('../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
      
    case 1:
        $codigo=$_GET['cedula'];
        $verificacion=$_GET['ver'];
        $nombre=$_GET['nombre'];
        $documento=$_GET['tipo'];
        $direccion=$_GET['direccion'];
        $departamento=$_GET['ciudad'];
        $municipio=$_GET['municipio'];
        $fijo=$_GET['telefono'];
        $movil=$_GET['celular'];
        $correo=$_GET['ema'];
        $contacto=$_GET['contacto'];         
        $desv=$_GET['desv'];
        if($desv=='true'){
            $desv= '-30';
        }else{
            $desv= '0';
        }
        $clint_ase=$_GET['clint_ase'];
        $idc=$_GET['idc'];        

        if ($idc==''){
             $sql = "INSERT INTO cont_terceros (pvi,cod_ter, nom_ter, doc_ter, digiver_ter, dir_ter, telfijo_ter, telmovil_ter, ciudad_ter, municipio_ter, correo_ter, cont_ter, vendedor)";
             $sql .= "VALUES ('".$desv."','" . $codigo . "','" . $nombre . "','" . $documento . "','" . $verificacion . "','" . $direccion . "','" . $fijo . "','" . $movil . "','" . $departamento . "','" . $municipio . "','" . $correo . "','" . $contacto . "','" . $clint_ase . "')";
             $ver = mysql_query($sql) or die (mysql_error());
             $id = mysql_insert_id();
             
             $msg = 'Se guardo con exito '.$ver;
        }else{
            $sql = "UPDATE `cont_terceros` SET `pvi` = '" . $desv . "',`nom_ter` = '" . $nombre . "', `digiver_ter` = '" . $verificacion . "', `doc_ter` = '" . $documento . "', `dir_ter` = '" . $direccion . "', `telfijo_ter` = '" . $fijo . "' ,`telmovil_ter` = '" . $movil . "', `ciudad_ter` = '" . $departamento . "', `municipio_ter` = '" . $municipio . "', `correo_ter` = '" . $correo . "', `cont_ter` = '" . $contacto . "', `vendedor` = '" . $clint_ase . "' WHERE `id_ter` = '" . $idc . "';";
	    mysql_query($sql) or die (mysql_error()); 
            $msg = 'Se edito con exito';
            $id = $idc;
        }
        $p = array();
        $p[0] = $msg;
        $p[1] = $id;
        echo json_encode($p);
   
      
        break;
    case 2:
                $sql='select * from cont_terceros where cod_ter = "'.$_GET['cedula'].'"';
        $fil =mysql_fetch_array(mysql_query($sql));
         $p = array();
            $p[0]= $fil["cod_ter"];
            $p[1]= strtoupper($fil["nom_ter"]);
            $p[2] = $fil['doc_ter'];
            $p[3] = $fil['digiver_ter'];
            $p[4] = $fil['dir_ter'];
            $p[5] = $fil['telfijo_ter'];
            $p[6] = $fil['telmovil_ter'];
            $p[7] = $fil['ciudad_ter'];
            $p[8] = $fil['municipio_ter'];
            $p[9] = $fil['pais_ter'];
            $p[10] = $fil['fecnac_ter'];
            $p[11] = $fil['correo_ter'];
            $p[12] = $fil['cont_ter'];
            $p[13] = $fil['estado_ter'];
            $p[14] = $fil['especial'];
            $p[15] = $fil['fuente'];
            $p[16] = $fil['ica'];
            $p[17] = $fil['iva'];
            $p[18] = $fil['cree'];
            $p[19] = $fil['pal'];
            $p[20] = $fil['pvi'];
            $p[21] = $fil['pac'];
            $p[22] = $fil['vendedor'];
            $p[23] = $fil['id_ter'];
            $p[24] = $fil['vendedor'];
            echo json_encode($p);
        break;
        case 3:
             $consulta2= "SELECT * FROM `departamentos` where nombre_dep like '".$_GET['dep']."%'  ";  
                                                        $result2=  mysql_query($consulta2);
                                                         echo "<option value='".$municipio."'>".$municipio."</option>";
                                                        while($fila=  mysql_fetch_array($result2)){                 
                                                            $valor1=$fila['cod_mun'];      
                                                            $valor2=$fila['nombre_mun'];      
                                                            echo"<option value='".$valor2."'>".$valor1."- ".$valor2."</option>";   
                                                        }
        
        break;
        
      
}

