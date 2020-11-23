<?php
include '../../modelo/conexion.php';
?>
  <table style="width: 95%" class="table table-hover">
  <tr class="table-hover">
        <th style="background-color: #4E8CCF;color:white" nowrap>Listado de todas las versiones</th> 
  </tr>
    <?php
    $cons = mysqli_query($conexion,"select numero_cotizacion from cotizacion where id_cot='".$_GET['rad']."' ");
    $c = mysqli_fetch_array($cons);
    $result = mysqli_query($conexion,"select id_cot, version, costo_total from cotizacion where numero_cotizacion='".$c[0]."' order by version desc ");//45897
    while($r = mysqli_fetch_row($result)){
        $cot = $r[0];
        echo '<tr><td><center><b>Cot No. '.$c[0].'.'.$r[1].'</b> <img src="../../imagenes/imp.png"  onclick="cot('.$cot.');" style="cursor:pointer"> </center> </td>';
        $query = mysqli_query($conexion,"SELECT * FROM  seguimientos  where id_s = ".$cot." order by id_seguimiento desc ");
        
        $cont = 0;
        while ($fila = mysqli_fetch_array($query)){
            $cont += 1;
              $obs="'".$fila['observacion']."'";
              echo '<tr>' 
              . '<td>'.$fila['observacion'].'<br>Reg:'.$fila['fecha_registros'].'&nbsp;&nbsp;'.'<img onclick="editar_s('.$_GET['rad'].','.$fila['id_seguimiento'].','.$obs.');" src="../../imagenes/modificar.png">'.'</td>';
        }
        if($cont==0){
            echo '<tr><td><font color="red"><b>Esta version no tiene seguimiento </b><img src="../../imagenes/cambiar.png" onclick="seguir('.$cot.');" style="cursor:pointer"></font>'
                    . '';
             $consulta = mysqli_query($conexion,"select borrador, estado_cot_s, nombre_obra, count(id_s) from seguimientos_cot where id_relacion='$cot' ");
            $se = mysqli_fetch_row($consulta);
            if($se[3]>0){
                $esta = "'".$se[1]."'";
                $obra = "'".$se[2]."'";
                echo '<tr><td style="text-align:right"><b>Valor Cot $</b> '.number_format($r[2]).' | <b>Agregar</b> <img src="../../imagenes/list1_add.png" onclick="segui_nuevo('.$cot.')">';
                echo '| <b>Visualizar</b> <input type="checkbox" id="verseg'.$cot.'" '.$che.' onclick="actualizar('.$cot.')">';
                echo '| <b>Estado</b>: ('.$se[1].') <img src="../../imagenes/up.png" onclick="verseg('.$cot.','.$esta.','.$obra.')" data-toggle="modal" data-target="#myModal3">';
                }
        }else{
            $segui = mysqli_query($conexion,"select borrador, estado_cot_s, nombre_obra from seguimientos_cot where id_relacion='$cot' ");
            $se = mysqli_fetch_array($segui);
            if($se[0]==0){
                $che = 'checked';
            }else{
                $che = '';  
            }
            
            $esta = "'".$se[1]."'";
            $obra = "'".$se[2]."'";
            echo '<tr><td style="text-align:right"><b>Valor Cot $</b> '.number_format($r[2]).' | <b>Agregar</b> <img src="../../imagenes/list1_add.png" onclick="segui_nuevo('.$cot.')">';
            echo '| <b>Visualizar</b> <input type="checkbox" id="verseg'.$cot.'" '.$che.' onclick="actualizar('.$cot.')">';
            echo '| <b>Estado</b>: ('.$se[1].') <img src="../../imagenes/up.png" onclick="verseg('.$cot.','.$esta.','.$obra.')" data-toggle="modal" data-target="#myModal3">';
            
        }
    }
    
    
  ?>
  </table> 
