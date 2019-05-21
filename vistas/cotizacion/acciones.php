<?php
include '../../modelo/conexion.php';
session_start();
$user = $_SESSION['k_username'];
switch ($_GET['sw']){
    case 1:
        $tex = $_GET['tex'];
        $query = mysql_query("insert into observaciones_cotizacion (texto, por) values ('$tex','$user') ") or die(mysql_error());
         echo $query;

        break;
    case 2:
        $query = mysql_query("select * from observaciones_cotizacion where estado=0 ");
        
        while($r = mysql_fetch_array($query)){
            echo '<tr><td><textarea id="text_1'.$r[0].'"  rows=5 onchange="cambiar_texto('.$r[0].');">'.$r[1].'</textarea></td>'
                    . '<td><button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="salvar_up('.$r[0].');">Seleccionar</button> <button  onclick="borrar_texto('.$r[0].');" class="btn btn-danger" > x</button><br> Ult. Modificacion: '.$r[3].' por '.$r[4].'</td>';
        }
        break;
    case 3:
        $id = $_GET['id'];
        $tex = $_GET['tex'];
        
        mysql_query("update observaciones_cotizacion set texto='$tex', por='$user' where id='$id' ");
        break;
    case 4:
        $id = $_GET['id'];
        mysql_query("update observaciones_cotizacion set estado='1', por='$user' where id='$id' ");
        break;
    case 5:
        $query = mysql_query("select * from politicas where id_pol=1 ");
        $p = mysql_fetch_row($query);
        echo $p[1];
        break;
    case 6:
        $id = $_GET['id'];
        $query = mysql_query("select * from comentarios where id_cotizacion='$id' order by id_com desc ");
        
        while($r = mysql_fetch_row($query)){
            echo '<tr><td>'.$r[1].' <button  onclick="borrar_com('.$r[0].','.$id.');"> x</button><br> Reg: '.$r[3].' por '.$r[4].'</td>'
                    . '<tr><td>=========================================================================';
        }
        break;
        case 7:
        $tex = $_GET['tex'];
             $id = $_GET['id'];
        $query = mysql_query("insert into comentarios (textos_com, id_cotizacion, registrado_com) values ('$tex','$id','$user') ") or die(mysql_error());
         echo $query;
          $id = $_GET['id'];
          mysql_query("update cotizaciones set cont_item=cont_item+'1' where id_cotizacion='$id' ");
         
         
         
        break;
    case 8:
        $id = $_GET['id'];
        mysql_query("delete from comentarios where id_com='$id' ");
        break;
    case 9:
        $cod = $_GET['codigo'];
        
        $result = mysql_query("SELECT * FROM referencias a,grupos_referencia b  where b.modulo like 'Rieles'  and a.referencia=b.referencia   group by a.referencia order by b.modulo asc  ");
        echo '<ul>';
        while($f = mysql_fetch_array($result)){
            $des = "'".$f[2]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionar_riel('.$f[0].','.$des.')">  '.$f[2].'</li>';
            }
         $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionar_riel(0,'.$des.')">N/A</li>';
        break;
        case 10:
        $cod = $_GET['codigo'];
        
        $result = mysql_query("SELECT * FROM referencias a,grupos_referencia b  where b.modulo like 'Alfajia'  and a.referencia=b.referencia   group by a.referencia order by b.modulo asc  ");
        echo '<ul>';
        while($f = mysql_fetch_array($result)){
            $des = "'".$f[2]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionar_alfa('.$f[0].','.$des.')">  '.$f[2].'</li>';
            }
         $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionar_alfa(0,'.$des.')">N/A</li>';
        break;
        case 11:
        $cod = $_GET['codigo'];
        
        $result = mysql_query("SELECT * FROM receta_kits where modulo like 'Cierres' and estado=0 ");
        echo '<ul>';
        while($f = mysql_fetch_array($result)){
            $des = "'".$f[1]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionar_cierre('.$f[0].','.$des.')">  '.$f[1].'</li>';
            }
         $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionar_cierre(0,'.$des.')">N/A</li>';
        break;
        case 12:
        $cod = $_GET['codigo'];
        
        $result = mysql_query("SELECT * FROM receta_kits where modulo like 'Rodajas' and estado=0 ");
        echo '<ul>';
        while($f = mysql_fetch_array($result)){
            $des = "'".$f[1]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionar_roda('.$f[0].','.$des.')">  '.$f[1].'</li>';
            }
         $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionar_roda(0,'.$des.')">N/A</li>';
        break;

    
}


