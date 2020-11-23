<?php
include "../modelo/conexion.php";
@unlink("gestion_de_tiempo.csv");//xlsx
$ar = @fopen("gestion_de_tiempo.csv","a")or
        die("error");

if(isset($_POST['cadena'])){
    if($_POST['fecha1']=='' && $_POST['fecha2']==''){
  $req5="SELECT a.tipo, a.id_cot, a.copia,  a.numero_cotizacion, a.version, a.obra, a.fecha_reg_c, a.fecha_modificacion, a.impresion, a.fecha_guardado, a.grabado, a.registrado, a.id_cliente, a.estado, a.presupuesto   FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_POST['cadena']."%' and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%' and a.grabado  like '%".$_POST['presupuesto']."%'  and a.estado like '".$_POST['estado']."%'  union"
          . " SELECT a.tipo, a.id_cot, a.copia, a.numero_cotizacion, a.version, a.obra, a.fecha_reg_c, a.fecha_modificacion, a.impresion, a.fecha_guardado, a.grabado, a.registrado, a.id_cliente, a.estado, a.presupuesto FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_POST['cadena']."%'  and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%'  and a.grabado  like '%".$_POST['presupuesto']."%' and a.estado like '".$_POST['estado']."%'";
    }else{
         $req5="SELECT a.tipo, a.id_cot, a.copia,  a.numero_cotizacion, a.version, a.obra, a.fecha_reg_c, a.fecha_modificacion, a.impresion, a.fecha_guardado, a.grabado, a.registrado, a.id_cliente, a.estado, a.presupuesto   FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_POST['cadena']."%' and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%' and a.grabado  like '%".$_POST['presupuesto']."%'  and a.estado like '".$_POST['estado']."%' and a.fecha_reg_c between '".$_POST['fecha1']."' and '".$_POST['fecha2']."'  union"
          . " SELECT a.tipo, a.id_cot, a.copia, a.numero_cotizacion, a.version, a.obra, a.fecha_reg_c, a.fecha_modificacion, a.impresion, a.fecha_guardado, a.grabado, a.registrado, a.id_cliente, a.estado, a.presupuesto FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_POST['cadena']."%'  and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%'  and a.grabado  like '%".$_POST['presupuesto']."%' and a.estado like '".$_POST['estado']."%'  and a.fecha_reg_c between '".$_POST['fecha1']."' and '".$_POST['fecha2']."'";
    }
  
    }
    $request5= mysqli_query($conexion,$req5);
    $c1=0;

fputs($ar,"# Cot.");
fputs($ar,";");
fputs($ar,"Documento");
fputs($ar,";");
fputs($ar,"Cliente");
fputs($ar,";");
fputs($ar,"Obra");
fputs($ar,";");
fputs($ar,"Fecha Registro");
fputs($ar,";");
fputs($ar,"Ultima Modificacion");
fputs($ar,";");
fputs($ar,"Ultima Impresion");
fputs($ar,";");
fputs($ar,"Guardado");
fputs($ar,";");
fputs($ar,"Tiempo");
fputs($ar,";");
fputs($ar,"Registrado por");
fputs($ar,";");
fputs($ar,"Asesor");
fputs($ar,";");
fputs($ar,"Estado");
fputs($ar,chr(13).chr(10));
fclose($ar);
 $tacot = 0;$can = 0; $gt = 0; $tr = 0;$con = 0;
    while($row=mysqli_fetch_array($request5))
	{     
//------------------------------------------------------------------------------
        if($row['tipo']=='Empresarial'){
              $sql='select * from sis_empresa where id_empresa="'.$row['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

$nombre= $fil["nombre_emp"];$documento = $fil["nit_emp"];
          }else{
              $sql='select * from sis_contacto where id_contacto="'.$row['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];$documento = $fil["cedula_cont"];

          }
          if($row["estado"]=='Ordenado'){
              $est = '<font color="red">';
              $v = '';
          }else{
              $est = '<font color="blue">';
              $v = '<img  width=20 heigth=20 src="../imagenes/version.png">';
          }
          if($row["copia"]==0){
              $c = '';
          }else{
              $c = $row["copia"];
          }
          $tiempo1 = interval_date($row['fecha_modificacion'],$fecha_hoy);
          if($row["impresion"]=='0000-00-00 00:00:00'){
              $tiempo2 = $row['impresion'].' - Sin Imprimir';
          }else{
              
              $tiempos = interval_date($row['impresion'],$fecha_hoy);
             $tiempo2 = $row['impresion'].' '.$tiempos;
              
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo3 = $row['fecha_guardado'].' - Sin Guardar';
       
          }else{
              $tiempos3 = interval_date($row['fecha_guardado'],$fecha_hoy);
                $tiempo3 = $row['fecha_guardado'].' '.$tiempos3;
             
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo33 = 'Sin Guardar';
           
          }else{
              $tiempo33 = interval_date2($row['fecha_reg_c'],$row['fecha_guardado']);
              
      
          }
//------------------------------------------------------------------------------        
            
$ar = fopen("gestion_de_tiempo.csv","a")or
        die("error");
$c1=$c1+1;

        if($c1==0){

        }else{

fputs($ar,$row['numero_cotizacion'].'.'.$row["version"]);
fputs($ar,";");
fputs($ar,utf8_decode($documento));
fputs($ar,";");
fputs($ar,$nombre);
fputs($ar,";");
fputs($ar,utf8_decode($row["obra"]));
fputs($ar,";");
fputs($ar,$row["fecha_reg_c"]);
fputs($ar,";");
fputs($ar,$row["fecha_modificacion"]);
fputs($ar,";");
fputs($ar,$tiempo2);
fputs($ar,";");
fputs($ar,$tiempo3);
fputs($ar,";");
fputs($ar,$tiempo33);
fputs($ar,";");
fputs($ar,$row["grabado"]);
fputs($ar,";");
fputs($ar,$row["registrado"]);
fputs($ar,";");
fputs($ar,$row["estado"]);
fputs($ar,chr(13).chr(10));
fclose($ar);
        }}
       
        echo '<a href="../vistas/?id=lista_cot&download_gestion" ><img src="../imagenes/file_excel.png" title="Descargar Archivo"> Exportar</a> <br>';
     
?>

