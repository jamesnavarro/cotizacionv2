<?php
include 'modelo/conexioni.php';
include 'modelo/conexion.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <ul>
            
                <?php
                  $result = mysqli_query($con, "select * from producto where ok=1 ");
                  while ($row = mysqli_fetch_array($result)) {
                       $cod = $row[3];
                       
                      $busqueda = mysql_query("select count(codigo) from producto where codigo='$cod' ");
                      $b = mysql_fetch_array($busqueda);
                      if($b[0]==0){
                          //insertar producto principal
                          $sql = "INSERT INTO `producto` (`ancho_maximo`,`alto_maximo`,`modificado`,`registrado_por`,`registro`, `ruta2`, `perforacion`, `boquete`, `kit`, `hoja`, `referencia_p`, `ruta`, `ancho_v_c`, `altura_v_c`,`ancho_adicional`, `med_adicional`, `producto`, `linea`, `codigo`, `tipo_vidrio`, `color_alu`, `ancho`, `alto`, `laminas`, `sistemas`)";
                          $sql.= "VALUES ('".$row['ancho_maximo']."','".$row['alto_maximo']."','JORGE.RODRIGUEZ','JORGE.RODRIGUEZ','".date('Y-m-d')."','".$row['ruta']."', '0', '0', '0', '".$row['hoja']."', '', '".$row['ruta']."', '".$row['ancho_v_c']."', '".$row['altura_v_c']."','".$row['ancho_adicional']."','".$row['med_adicional']."', '".$row['producto']."', 'Aluminio', '".$row['codigo']."',  '', '', '".$row['ancho']."', '".$row['alto']."', '".$row['laminas']."', '".$row['sistemas']."')";
                          mysql_query($sql, $conexion);
                          $id = mysql_insert_id(); // maximo id
                          
                          $ok ='green';
                      }else{
                          
                          $ok ='red';
                      }
                      echo '<li><font color="'.$ok.'">'.$row[3].' '.$row[1].'</font>';
                     if($b[0]==0){
                      $resultper = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Principal' order by lado desc ");
                      echo '<ul>';
                      echo '<li>-----------------------------perfiles-----------------------------------------</li>';
                       while($f = mysqli_fetch_array($resultper)){
                           echo '<li>'.$f[2].'-'.$f[3].'</li>';
                           // insertar perfiles del producto
                           
                           $result_perfil = mysql_query("SELECT id_referencia FROM `referencias` where referencia='".$f['referencia']."' group by referencia");
                           $rp = mysql_fetch_array($result_perfil);
                           $ref = $rp[0];
                           
                           $signo = $f['ope2'];
                           if($signo=='n'){
                               $signo='-';
                           }
                           if($f['lado']=='Ancho'){
                               $lado = 'Horinzontal';
                           }  else {
                               $lado = 'Vertical';
                           }
                           if($f['ope1']=='-'){
                               $de = '-'.$f['var1'];
                           }else{
                               $de = $f['var1'];
                           }
                           if($f['lado_ref']=='ancho'){
                               $me = '0';
                           }elseif($f['lado_ref']=='alto'){
                               $me = '0';
                           }elseif($f['lado_ref']=='Anchovc'){
                               $me = '3';
                           }elseif($f['lado_ref']=='Altovc'){
                               $me = '1';
                           }elseif($f['lado_ref']=='Altomrej'){
                               $me = '2';
                           }else{
                               $me = '4';
                           }
                          
                           $sql2 = "INSERT INTO `producto_rep_alu` (`division`, `signo`, `variable`, `id_ref_alum`, `lado`, `medida_r_a`, `descuento`, `cantidad`, `id_p`)";
                                                $sql2.= "VALUES ('0', '".$signo."', '".$f['var2']."','".$ref."', '".$lado."', '".$me."',  '".$de."', '".$f['cantidad']."', '".$id."')";
                           $error = mysql_query($sql2, $conexion) or die(mysql_error());
                           
                        }
                        echo '</ul>';
                        
                        
                        $resultf = mysqli_query($con, "select * FROM recetas  WHERE modulo='Accesorios' AND codigo_ref='$cod' and insumo='Principal' order by para asc ");
                         echo '<ul>';
                         echo '<li>-----------------------------accesorios-----------------------------------------</li>';
                        while($r = mysqli_fetch_array($resultf)){
                            echo '<li>'.$r[2].'-'.$r[3].'</li>';
                            $result_acc = mysql_query("SELECT id_referencia FROM `referencias` where codigo='".$r['codigo_pro']."' group by referencia");
                           $ra = mysql_fetch_array($result_acc);
                           $ref = $ra[0];
                            
                             $sql3 = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
                             $sql3.= "VALUES ('1','0', '1', '".$r['lado']."', '".$r['metro']."', '".$r['yes']."','".$r['calcular']."', '".$r['para']."', '".$ref."', 'N/A', '".$r['cantidad']."', '".$id."')";
                              mysql_query($sql3, $conexion);
                        }
                        echo '</ul>';
                        echo '</li>';
                     }
                  }
                    ?>
            
        </ul>
        
    </body>
</html>
