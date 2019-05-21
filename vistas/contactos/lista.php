<?php 
$request=mysql_query('select count(*) from sis_contacto  where tipo="Contactado"');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de contactos</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                           
                                
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                    <a href="../vistas/?id=contactos&pasar">Pasar a clientes</a>
<?php

if(isset($_GET['pasar'])){
    $re=mysql_query("SELECT * FROM sis_contacto where tipo='Contactado' ");
    $v = 0;
    while($r=mysql_fetch_array($re))
	{
        $v +=1;
            $sql = "INSERT INTO cont_terceros (especial,fuente,ica,iva,cree,cod_ter,nom_ter,doc_ter,digiver_ter,dir_ter,telfijo_ter,telmovil_ter,ciudad_ter,pais_ter,fecnac_ter,correo_ter,cont_ter,creado,tipo,id_cliente,fecha_registro)";
            $sql.= "VALUES ('0','0','0','0','0','".$r['cedula_cont']."','".$r['nombre_cont']." ".$r['apellido_cont']."','CC','0','".$r['direccionf']."','".$r['tel_oficina']."','".$r['celular']."','08001','0169','".$r['fecha']."','".$r['email1']."','".$r['nombre_asistente']."','".$r['usuario']."','Personal','".$r['id_contacto']."','".date("Y-m-d")."') ";
            mysql_query($sql) or die (mysql_error());

        }
             echo '<script lanquage="javascript">alert("Se ha agregado a la lista de tercero '.$v.'");location.href="../vistas/?id=contactos"</script>'; 

}
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['empresa']) || isset($_POST['nombre']) || isset($_POST['user'])){
   
    
    

    $request=mysql_query("SELECT * FROM sis_contacto where tipo='Contactado' and  municipio like '%".$_POST['empresa']."%' and nombre_cont like '%".$_POST['nombre']."%' and usuario like '%".$_POST['user']."%'");
}else{
$request=mysql_query("SELECT * FROM sis_contacto where tipo='Contactado' ");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="30%">'.'Nombre de Contacto'.'</th>'; 
              $table = $table.'<th width="10%">'.'Cargo'.'</th>';
              $table = $table.'<th width="20%">'.'Empresa'.'</th>';
              $table = $table.'<th width="10%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="10%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            if($row['id_empresa']==0){
     $idempresa='';
$empresa='';
 }else{
     
     
$consulta2= "select * from sis_empresa WHERE  id_empresa=".$row['id_empresa']."";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
}}
        if($editar_con == 'Habilitado'){
            $up = '<a href="../vistas/?id=contacto&cod='.$row['id_contacto'].'"><img src="../imagenes/modificar.png"></a>';
        }else{
            $up = '';
        }    
        
        if($eliminar_con == 'Habilitado'){
            $del = '<a href="../vistas/?id=contactos&del='.$row['id_contacto'].'"><img src="../imagenes/eliminar.png"></a>';
        }else{
            $del = '';
        }  
        
        if($ver_con == 'Habilitado'){
            $ver = '<a href="../vistas/?id=ver_contacto&cod='.$row['id_contacto'].'">'.$row['nombre_cont'].' '.$row['apellido_cont'].'</a>';
        }else{
            $ver = $row['nombre_cont'].' '.$row['apellido_cont'];
        }  
        
            $table = $table.'<tr>
                <td width="30%">'.$ver.'</td> 
                <td width="10%">'.$row['cargo'].'<font></a></td>
                    <td width="20%"><a href="../vistas/?id=ver_empresa&cod='.$idempresa.'">'.$empresa.'<font></a></td>
               <td class="hidden-phone">'.$row["tel_oficina"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["usuario"].'</font></td>
                            <td>'.$up.'</td>
                                <td>'.$del.'</td></tr>';   
      
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}
?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>


                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($eliminar_con!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=contactos"</script>'; 
}else{
$sql = "DELETE FROM sis_contacto WHERE id_contacto=".$_GET['del']."  and usuario='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=contactos'";
echo "</script>";
}
 }
?>