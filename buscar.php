<?php

session_start();
include "../modelo/conexion.php";
include "../modelo/consultar_permisos.php";
function interval_date($init,$finish)
{
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo = "Hace " . floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo = "Hace " . floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo = "Hace " . floor($diferencia/3600) . " horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo = "Hace " . floor($diferencia/86400) . " días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo = "Hace " . floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo = "Hace " . floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }
    return $tiempo;
}
function interval_date2($init,$finish)
{
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo =  floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo =  floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo =  floor($diferencia/3600) . " horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo =  floor($diferencia/86400) . " días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo =  floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo =  floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }
    return $tiempo;
}
if (isset($_POST["cot"])) { 

}	?>
            
<table class="table table-bordered table-striped table-hover" id="">
    <thead >
            <tr BGCOLOR="#C3D9FF">
               <th width="5%">Ver</th>
              <th width="5%">Cotizacion No.</th> 
              <th width="5%">Documento</th>
              <th width="15%">Cliente</th>
              <th width="10%">Nombre de la Obra</th>
              <th width="10%">Fecha Registro</th>
              <th width="10%">Ultima Modificacion</th>
               <th width="10%">Ultima Impresion</th>
                <th width="10%">Guardado</th>
                <th width="5%">Tiempo de Cotizacion</th>
               <th width="10%">Responsables</th>
              <th class="hidden-phone">Estado</th>
              <th class="hidden-phone">Copiar</th>
             <th class="hidden-phone">Version</th>
    <th class="hidden-phone">Abrir</th>
              </tr>
             </thead>
<?php
if($_POST['cot']!=''){ 
    $cot = ' and a.numero_cotizacion='.$_POST['cot'].''; 

}else{
    $cot = ' and concat(b.nom_ter," ",a.nom_temp) like "%'.$_POST['nom'].'%" '; 
    
}
if($_POST['obr']!=''){ $obr = ' and a.obra like "%'.$_POST['obr'].'%" '; }else{$obr = ''; }
if($_POST['reg']!=''){ $reg = ' and a.grabado="'.$_POST['reg'].'"'; }else{$reg = ''; }




if($_POST['cot']==''  && $_POST['nom']=='' && $_POST['obr']==''&& $_POST['reg']=='' ){
    $request=mysql_query("SELECT * FROM cotizacion a, cont_terceros b where a.id_tercero=b.id_ter order by a.numero_cotizacion desc LIMIT 30 ");
}else{
$request=mysql_query("SELECT * FROM cotizacion a, cont_terceros b where a.id_tercero=b.id_ter $cot $obr $reg");
}
while($row=mysql_fetch_array($request))
	{       
              $sql='select * from cont_terceros where id_ter="'.$row['id_tercero'].'"';
$fil =mysql_fetch_array(mysql_query($sql));

if($row["nom_temp"]==''){
    $nombre= $fil["nom_ter"];
    $documento = $fil["cod_ter"];
}else{
    $nombre= $row["nom_temp"].'<sup><font color="red">(temp)</font></sup>';
    $documento = $row["cod_temp"];
}
          if($row["estado"]=='Ordenado'){
              $est = '<font color="red">';
              $v = '';
          }else{
              $est = '<font color="blue">';
              $v = '<button type="button"><img  width=20 heigth=20 src="../imagenes/version.png"></button>';
          }
          if($row["copia"]==0){
              $c = '';
          }else{
              $c = $row["copia"];
          }
          $tiempo1 = interval_date($row['fecha_modificacion'],$fecha_hoy);
          if($row["impresion"]=='0000-00-00 00:00:00'){
              $tiempo2 = '<font color="red">'.$row['impresion'].'</font><br>Sin Imprimir';
          }else{
              
              $tiempos = interval_date($row['impresion'],$fecha_hoy);
             $tiempo2 = '<font color="green">'.$row['impresion'].'</font><br>'.$tiempos;
              
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo3 = '<font color="red">'.$row['fecha_guardado'].'</font><br>Sin Guardar';
              $led = '<img src="../imagenes/ledrojo.gif"> ';
          }else{
              $tiempos3 = interval_date($row['fecha_guardado'],$fecha_hoy);
                $tiempo3 = '<font color="green">'.$row['fecha_guardado'].'</font><br>'.$tiempos3;
              $led = '<img src="../imagenes/ok.png">';
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo33 = 'Sin Guardar';
           
          }else{
              $tiempo33 = interval_date2($row['fecha_reg_c'],$row['fecha_guardado']);
              
      
          }
          if($row['id_cot']=='Personal'){
              $link = '<a href="../vistas/?id=ver_contacto&cod='.$row['id_cliente'].'">';
          }else{
              $link = '<a href="../vistas/?id=ver_empresa&cod='.$row['id_cliente'].'">';
          }
          if($ver_cot=='Habilitado'){$ver='<img src="../imagenes/view.png">';}else{$ver='';}
          if($row["estado"]=='En proceso'){
              $copy = '<a title="Copiar Cotizacion" href="../modelo/copiar_cotizacion.php?cod='.$row['id_cot'].'"><button type="button"><img width=20 heigth=20 src="../imagenes/copy.png"></button></a>';
          }else{
              if($_SESSION["admin"]=='Si'){
                       $copy = '<a title="Copiar Cotizacion" href="../modelo/copiar_cotizacion.php?cod='.$row['id_cot'].'"><button type="button"><img width=20 heigth=20 src="../imagenes/copy.png"></button></a>';
         
              }else{
                  $copy = '';
              }
               
          }
                    if($row["estado"]=='Pedido por aprobar'){
              if($_SESSION['admin']=='Si'){
              $open = '<button type="button"><img src="../imagenes/up.png"></button>';
              }else{
                  $open = '';
              }
          }else{
              $open = '';
          }
?>
<tr>
    <td width="5%"><a href="../vistas/?id=new_fac&cot=<?php echo $row['id_cot'].'&cli='.$row['id_tercero'] ?>"><button type="button"><?php echo $ver ?></button></a></td>
<td width="5%"><?php echo $row['numero_cotizacion'].'.'.$row["version"] ?></a></td>
<td width="5%"><?php echo $documento ?></a> </td>
<td width="15%"><?php echo strtoupper ($nombre) ?></a> </td>
<td width="10%"><?php echo strtoupper ($row["obra"]) ?><font></a></td>
<td width="10%"><?php echo $row["fecha_reg_c"] ?><font></a></td>
<td width="10%"><?php echo $row["fecha_modificacion"].'<br>'.$tiempo1 ?></a></td>
<td width="10%"><?php echo $tiempo2 ?></td>
<td width="10%"><?php echo $tiempo3 ?></td>
<td width="10%"><?php echo $led.' '.$tiempo33 ?></td>
<td class="hidden-phone"><?php echo 'Reg: '.strtoupper ($row["grabado"]).'<br>Asesor: '.strtoupper ($row["registrado"]) ?></td>
<td class="hidden-phone"><?php echo $est.''.$row["estado"] ?></font></td>
<td class="hidden-phone"><?php echo $copy ?></td>
<td class="hidden-phone"><a title="Sacar Version de  Cotizacion" href="../modelo/version_cotizacion.php?cod=<?php echo $row['id_cot'] ?>"><?php echo $v ?></a></td>
 <td class="hidden-phone"><a title="Abrir Cotizacion" href="../vistas/?id=lista_cot&abrir=<?php echo $row['id_cot'].'' ?>"><?php echo $open; ?></a></td>
  </tr>   <?php } ?>
</table>