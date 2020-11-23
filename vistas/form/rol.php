<?php 
$request=mysqli_query($conexion,'select count(*) from roles');
if($request){
	$request = mysqli_fetch_row($request);
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
 if(isset($_GET['up_1'])){
 $sql21 = "SELECT * FROM roles where id_roles=".$_GET['up_1'];
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
   
            $p1= $fila21["nombre"];
            $p2= $fila21["descripcion"];
     
 }
?> 
<script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

                                <h4 class="title">Roles </h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse2" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span> Roles</a></li>

                                    <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar</a></li>
                                        
                                

                                  

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

<?php
if(isset($_GET['up_1'])){ ?>
            <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/rol.php?editar='.$_GET['up_1'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                        
                                          
                                               
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Nombre del Rol</label>

                                            <div class="controls"><input type="text" name="rol" value="<?php if(isset($_GET['up_1'])){echo $p1;} ?>" class="span2" placeholder="Digite el espesor" required></div>
                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Descripcion</label>

                                               <div class="controls"><textarea name="descr"><?php if(isset($_GET['up_1'])){echo $p2;} ?></textarea></div>
                                            <label></label><div class="controls"> </div>    
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar Cambios';} ?></button>

                                        <a href="../vistas/?id=temple"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>                
 <?php }else{
if($page>1){?>
	<a href="../vistas/?id=rol&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=rol&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=rol&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=rol&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
      ?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;


 $request=mysqli_query($conexion,"SELECT * FROM roles ".$limit);
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';  
              $table = $table.'<th width="20%">'.'Rol'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
               $table = $table.'<th width="10%">'.'Modificado por'.'</th>';
                $table = $table.'<th width="20%">'.'Registro'.'</th>';
               
              $table = $table.'<th width="5%">Editar</th>'; 
              $table = $table.'<th width="5%">Eliminar</th>'; 
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{    
            $table = $table.'<tr><td width="5%">'.$row["id_roles"].'</td>'
                    . '<td  width="20%"><a href="../vistas/?id=rol&codigo='.$row["id_roles"].'"">'.$row["nombre_r"].'<font></a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>'
                    . '<td width="10%">'.$row['modificado_por'].'</font></td>'
                    . '<td width="20%">'.$row['fecha_modificacion'].'</font></td>'
                    . '<td  width="5%"><a href="../vistas/?id=rol&up_1='.$row["id_roles"].'""><img src="../imagenes/modificar.png"> </a></td>'
                    . '<td  width="5%"><a href="../vistas/?id=rol&del='.$row["id_roles"].'""><img src="../imagenes/eliminar.png"> </a></td></tr>';   
           
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
} 
 }   
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/rol.php?codigo='.$_GET['codigo'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                     <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                        
                                          
                                               
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Nombre del Rol</label>

                                            <div class="controls"><input type="text" name="rol" value="<?php if(isset($_GET['up_1'])){echo $p1;} ?>" class="span2" placeholder="Digite el espesor" required></div>
                                            <label></label><div class="controls"> </div>
                                               <label class="control-label">Descripcion</label>

                                               <div class="controls"><textarea name="descr"><?php if(isset($_GET['up_1'])){echo $p2;} ?></textarea></div>
                                            <label></label><div class="controls"> </div>    
                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar Cambios';} ?></button>

                                        <a href="../vistas/?id=rol"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<?php  if(isset($_GET['codigo'])){ 
    
     $sql21 = "SELECT * FROM roles where id_roles=".$_GET["codigo"]." ";
            $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
   
            $name= $fila21["nombre_r"];
            $p2= $fila21["descripcion"];
            
    include "../modelo/conexion.php";
    $consulta= "select count(*) from roles_accion where id_roles=".$_GET["codigo"]." and area='COTIZACION'";                     
    $result=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result)){
    $c=$fila['count(*)'];
   
    }if($c==0){echo '<h4><font color="red">No se ha Agregado ninguna configuracion para el rol de  '.$name.'</font></h4>';}else{echo '<h4><font color="blue">Editar Los Roles de '.$name.'</h4></font>';}
    ?>
<article class="module width_full">
                    <form  name="insertar" action="<?php if($c==0){echo '../modelo/roles.php?codigo='.$_GET['codigo'].'';}else{echo '../modelo/editar_roles.php?editar='.$_GET['codigo'].'';} ?>" method="post" enctype="multipart/form-data" >
                    <br><hr>
                                            <input type="submit" name="enviar" value="Guardar" class="alt_btn">
                                            <a href="../vistas/roles.php?eliminar=<?php echo ($id_ro); ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
                                            <i>"En este modulo puede configurar todos los privilegios del rol seleccionado, aqui puede habilitar y des-habilitar"</i>
                                        <hr><br>
                    <table class="table table-bordered table-striped table-hover" id="">
							
                        <thead>
                               <tr bgcolor="#D1EEF0">
                                   <th>Modulo</th>
                                   <th>Acceso</th>
                                   <th>Eliminar</th>
                                   <th>Editar</th>
                                   <th>Exportar</th>
                                   <th>Aprobar</th>
                                   <th>Crear</th>
                                   <th>Ver</th>
                                   
                               </tr>
                        </thead> 
                        <tr>
                            <th><label name="Empresa" value="Empresa" >Cotizaciones</label></th>
<td>
<select name="acceso"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Cotizacion' and area='COTIZACION'";                     
    $result=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result)){
    $acceso=$fila['acceso'];
    $eliminar=$fila['eliminar'];
    $editar=$fila['editar'];
    $exportar=$fila['exportar'];
    $importar=$fila['importar'];
    $listar=$fila['listar'];
    $ver=$fila['ver'];
   
    }
    ?>
  <?php if(isset($acceso)){echo"<option value='".$acceso."'>".$acceso."</option>";} ?>
<?php if($acceso!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$eliminar."'>".$eliminar."</option>";} ?>

<?php if($eliminar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$editar."'>".$editar."</option>";} ?>

<?php if($editar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$exportar."'>".$exportar."</option>";} ?>

<?php if($exportar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$importar."'>".$importar."</option>";} ?>

<?php if($importar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$listar."'>".$listar."</option>";} ?>

<?php if($listar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver"  style="width:120px;">
    <?php if(isset($acceso)){echo"<option value='".$ver."'>".$ver."</option>";} ?>

<?php if($ver!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="contacto" value="Contactos">Productos</label></th>
                            <td>
<select name="acceso1"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta1= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Productos' and area='COTIZACION'";                     
    $result1=  mysqli_query($conexion,$consulta1);
    while($fila1=  mysqli_fetch_array($result1)){
    $acceso1=$fila1['acceso'];
    $eliminar1=$fila1['eliminar'];
    $editar1=$fila1['editar'];
    $exportar1=$fila1['exportar'];
    $importar1=$fila1['importar'];
    $listar1=$fila1['listar'];
    $ver1=$fila1['ver'];
  
    }
    ?>
  <?php if(isset($acceso1)){echo"<option value='".$acceso1."'>".$acceso1."</option>";} ?>
<?php if($acceso1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$eliminar1."'>".$eliminar1."</option>";} ?>

<?php if($eliminar1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$editar1."'>".$editar1."</option>";} ?>

<?php if($editar1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$exportar1."'>".$exportar1."</option>";} ?>

<?php if($exportar1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$importar1."'>".$importar1."</option>";} ?>

<?php if($importar1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$listar1."'>".$listar1."</option>";} ?>

<?php if($listar1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver1"  style="width:120px;">
    <?php if(isset($acceso1)){echo"<option value='".$ver1."'>".$ver1."</option>";} ?>

<?php if($ver1!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver1!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Tareas" value="Tareas">Contactos</label></th>
                            <td>
<select name="acceso2"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta2= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Contactos' and area='CRM'";                     
    $result2=  mysqli_query($conexion,$consulta2);
    while($fila2=  mysqli_fetch_array($result2)){
    $acceso2=$fila2['acceso'];
    $eliminar2=$fila2['eliminar'];
    $editar2=$fila2['editar'];
    $exportar2=$fila2['exportar'];
    $importar2=$fila2['importar'];
    $listar2=$fila2['listar'];
    $ver2=$fila2['ver'];
    
    }
 
    ?>
  <?php if(isset($acceso2)){echo"<option value='".$acceso2."'>".$acceso2."</option>";} ?>
<?php if($acceso2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$eliminar2."'>".$eliminar2."</option>";} ?>

<?php if($eliminar2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$editar2."'>".$editar2."</option>";} ?>

<?php if($editar2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$exportar2."'>".$exportar2."</option>";} ?>

<?php if($exportar2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$importar2."'>".$importar2."</option>";} ?>

<?php if($importar2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$listar2."'>".$listar2."</option>";} ?>

<?php if($listar2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver2"  style="width:120px;">
    <?php if(isset($acceso2)){echo"<option value='".$ver2."'>".$ver2."</option>";} ?>

<?php if($ver2!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver2!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Tareas" value="Tareas">Empresas</label></th>
                            <td>
<select name="acceso22"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta22= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Empresas' and area='CRM'";                     
    $result22=  mysqli_query($conexion,$consulta22);
    while($fila22=  mysqli_fetch_array($result22)){
    $acceso22=$fila22['acceso'];
    $eliminar22=$fila22['eliminar'];
    $editar22=$fila22['editar'];
    $exportar22=$fila22['exportar'];
    $importar22=$fila22['importar'];
    $listar22=$fila22['listar'];
    $ver22=$fila22['ver'];
    
    }
 
    ?>
  <?php if(isset($acceso22)){echo"<option value='".$acceso22."'>".$acceso22."</option>";} ?>
<?php if($acceso22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$eliminar22."'>".$eliminar22."</option>";} ?>

<?php if($eliminar22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$editar22."'>".$editar22."</option>";} ?>

<?php if($editar22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$exportar22."'>".$exportar22."</option>";} ?>

<?php if($exportar22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$importar22."'>".$importar22."</option>";} ?>

<?php if($importar22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$listar22."'>".$listar22."</option>";} ?>

<?php if($listar22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver22"  style="width:120px;">
    <?php if(isset($acceso22)){echo"<option value='".$ver22."'>".$ver22."</option>";} ?>

<?php if($ver22!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver22!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Llamadas" value="Llamadas">Estadisticas</label></th>
                            <td>
<select name="acceso3"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta3= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Estadisticas'  and area='COTIZACION'";                     
    $result3=  mysqli_query($conexion,$consulta3);
    while($fila=  mysqli_fetch_array($result3)){
    $acceso3=$fila['acceso'];
    $eliminar3=$fila['eliminar'];
    $editar3=$fila['editar'];
    $exportar3=$fila['exportar'];
    $importar3=$fila['importar'];
    $listar3=$fila['listar'];
    $ver3=$fila['ver'];
   
    }
    ?>
  <?php if(isset($acceso3)){echo"<option value='".$acceso3."'>".$acceso3."</option>";} ?>
<?php if($acceso3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$eliminar3."'>".$eliminar3."</option>";} ?>

<?php if($liminar3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($liminar3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$editar3."'>".$editar3."</option>";} ?>

<?php if($editar3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$exportar3."'>".$exportar3."</option>";} ?>

<?php if($exportar3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$importar3."'>".$importar3."</option>";} ?>

<?php if($importar3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$listar3."'>".$listar3."</option>";} ?>

<?php if($listar3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver3"  style="width:120px;">
    <?php if(isset($acceso3)){echo"<option value='".$ver3."'>".$ver3."</option>";} ?>

<?php if($ver3!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver3!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Materiales</label></th>
                            <td>
<select name="acceso4"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Materiales' and area='COTIZACION'";                     
    $result4=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result4)){
    $acceso4=$fila['acceso'];
    $eliminar4=$fila['eliminar'];
    $editar4=$fila['editar'];
    $exportar4=$fila['exportar'];
    $importar4=$fila['importar'];
    $listar4=$fila['listar'];
    $ver4=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso4)){echo"<option value='".$acceso4."'>".$acceso4."</option>";} ?>
<?php if($acceso4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$eliminar4."'>".$eliminar4."</option>";} ?>

<?php if($eliminar4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$editar4."'>".$editar4."</option>";} ?>

<?php if($editar4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$exportar4."'>".$exportar4."</option>";} ?>

<?php if($exportar4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$importar4."'>".$importar4."</option>";} ?>

<?php if($importar4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$listar4."'>".$listar4."</option>";} ?>

<?php if($listar4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver4"  style="width:120px;">
    <?php if(isset($acceso4)){echo"<option value='".$ver4."'>".$ver4."</option>";} ?>

<?php if($ver4!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver4!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Notas" value="Notas">Configuracion</label></th>
                            <td>
<select name="acceso5"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Configuracion' and area='COTIZACION'";                     
    $result5=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result5)){
    $acceso5=$fila['acceso'];
    $eliminar5=$fila['eliminar'];
    $editar5=$fila['editar'];
    $exportar5=$fila['exportar'];
    $importar5=$fila['importar'];
    $listar5=$fila['listar'];
    $ver5=$fila['ver'];
   
    }
    ?>
  <?php if(isset($acceso5)){echo"<option value='".$acceso5."'>".$acceso5."</option>";} ?>
<?php if($acceso5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$eliminar5."'>".$eliminar5."</option>";} ?>

<?php if($eliminar5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$editar5."'>".$editar5."</option>";} ?>

<?php if($editar5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$exportar5."'>".$exportar5."</option>";} ?>

<?php if($exportar5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$importar5."'>".$importar5."</option>";} ?>

<?php if($importar5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$listar5."'>".$listar5."</option>";} ?>

<?php if($listar5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver5"  style="width:120px;">
    <?php if(isset($acceso5)){echo"<option value='".$ver5."'>".$ver5."</option>";} ?>

<?php if($ver5!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver5!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Campañas" value="Campañas">Pedidos</label></th>
                            <td>
<select name="acceso6"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Pedidos' and area='COTIZACION'";                     
    $result6=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result6)){
    $acceso6=$fila['acceso'];
    $eliminar6=$fila['eliminar'];
    $editar6=$fila['editar'];
    $exportar6=$fila['exportar'];
    $importar6=$fila['importar'];
    $listar6=$fila['listar'];
    $ver6=$fila['ver'];
  
    }
    ?>
  <?php if(isset($acceso6)){echo"<option value='".$acceso6."'>".$acceso6."</option>";} ?>
<?php if($acceso6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$eliminar6."'>".$eliminar6."</option>";} ?>

<?php if($eliminar6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$editar6."'>".$editar6."</option>";} ?>

<?php if($editar6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$exportar6."'>".$exportar6."</option>";} ?>

<?php if($exportar6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$importar6."'>".$importar6."</option>";} ?>

<?php if($importar6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$listar6."'>".$listar6."</option>";} ?>

<?php if($listar6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver6"  style="width:120px;">
    <?php if(isset($acceso6)){echo"<option value='".$ver6."'>".$ver6."</option>";} ?>

<?php if($ver6!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver6!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Proyectos" value="Proyectos">Orden de Produccion</label></th>
                            <td>
<select name="acceso7"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Orden de Produccion' and area='COTIZACION'";                     
    $result7=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result7)){
    $acceso7=$fila['acceso'];
    $eliminar7=$fila['eliminar'];
    $editar7=$fila['editar'];
    $exportar7=$fila['exportar'];
    $importar7=$fila['importar'];
    $listar7=$fila['listar'];
    $ver7=$fila['ver'];
    
    }
    ?>
  <?php if(isset($acceso7)){echo"<option value='".$acceso7."'>".$acceso7."</option>";} ?>
<?php if($acceso7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$eliminar7."'>".$eliminar7."</option>";} ?>

<?php if($eliminar7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$editar7."'>".$editar7."</option>";} ?>

<?php if($editar7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$exportar7."'>".$exportar7."</option>";} ?>

<?php if($exportar7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$importar7."'>".$importar7."</option>";} ?>

<?php if($importar7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$listar7."'>".$listar7."</option>";} ?>

<?php if($listar7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver7"  style="width:120px;">
    <?php if(isset($acceso7)){echo"<option value='".$ver7."'>".$ver7."</option>";} ?>

<?php if($ver7!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver7!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Incidencias" value="incidencias">OP Retenidas</label></th>
                            <td>
<select name="acceso8"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='OP Retenidas' and area='COTIZACION'";                     
    $result8=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result8)){
    $acceso8=$fila['acceso'];
    $eliminar8=$fila['eliminar'];
    $editar8=$fila['editar'];
    $exportar8=$fila['exportar'];
    $importar8=$fila['importar'];
    $listar8=$fila['listar'];
    $ver8=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso8)){echo"<option value='".$acceso8."'>".$acceso8."</option>";} ?>
<?php if($acceso8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$eliminar8."'>".$eliminar8."</option>";} ?>

<?php if($eliminar8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$editar8."'>".$editar8."</option>";} ?>

<?php if($editar8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$exportar8."'>".$exportar8."</option>";} ?>

<?php if($exportar8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$importar8."'>".$importar8."</option>";} ?>

<?php if($importar8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$listar8."'>".$listar8."</option>";} ?>

<?php if($listar8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver8"  style="width:120px;">
    <?php if(isset($acceso8)){echo"<option value='".$ver8."'>".$ver8."</option>";} ?>

<?php if($ver8!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver8!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Casos" value="Casos">OP Remision</label></th>
                            <td>
<select name="acceso9"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='OP Remision' and area='COTIZACION'";                     
    $result9=  mysqli_query($conexion,$consulta);
    while($fila=  mysqli_fetch_array($result9)){
    $acceso9=$fila['acceso'];
    $eliminar9=$fila['eliminar'];
    $editar9=$fila['editar'];
    $exportar9=$fila['exportar'];
    $importar9=$fila['importar'];
    $listar9=$fila['listar'];
    $ver9=$fila['ver'];

    }
    ?>
  <?php if(isset($acceso9)){echo"<option value='".$acceso9."'>".$acceso9."</option>";} ?>
<?php if($acceso9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar9"  style="width:120px;">
    <?php if(isset($acceso9)){echo"<option value='".$eliminar9."'>".$eliminar9."</option>";} ?>

<?php if($eliminar9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar9"  style="width:120px;">
    <?php if(isset($acceso9)){echo"<option value='".$editar9."'>".$editar9."</option>";} ?>

<?php if($editar9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar9"  style="width:120px;">
    <?php if(isset($acceso9)){echo"<option value='".$exportar9."'>".$exportar9."</option>";} ?>

<?php if($exportar9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar9"  style="width:120px;">
    <?php if(isset($acceso9)){echo"<option value='".$importar9."'>".$importar9."</option>";} ?>

<?php if($importar9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar9"  style="width:120px;">
    <?php if(isset($listar9)){echo"<option value='".$listar9."'>".$listar9."</option>";} ?>

<?php if($listar9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver9"  style="width:120px;">
    <?php if(isset($ver9)){echo"<option value='".$ver9."'>".$ver9."</option>";} ?>

<?php if($ver9!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver9!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                            <tr>
                            <th><label name="Empresa" value="Empresa" >Fletes</label></th>
<td>
<select name="acceso10"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta10= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Fletes' and area='COTIZACION'";                     
    $result10=  mysqli_query($conexion,$consulta10);
    while($fila=  mysqli_fetch_array($result10)){
    $acceso10=$fila['acceso'];
    $eliminar10=$fila['eliminar'];
    $editar10=$fila['editar'];
    $exportar10=$fila['exportar'];
    $importar10=$fila['importar'];
    $listar10=$fila['listar'];
    $ver10=$fila['ver'];
   
    }
    ?>
  <?php if(isset($acceso10)){echo"<option value='".$acceso10."'>".$acceso10."</option>";} ?>
<?php if($acceso10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$eliminar10."'>".$eliminar10."</option>";} ?>

<?php if($eliminar10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$editar10."'>".$editar10."</option>";} ?>

<?php if($editar10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$exportar10."'>".$exportar10."</option>";} ?>

<?php if($exportar10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$importar10."'>".$importar10."</option>";} ?>

<?php if($importar10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$listar10."'>".$listar10."</option>";} ?>

<?php if($listar10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver10"  style="width:120px;">
    <?php if(isset($acceso10)){echo"<option value='".$ver10."'>".$ver10."</option>";} ?>

<?php if($ver10!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver10!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
              
                        <tr>
                            <th><label name="Tareas" value="Tareas">Vehiculos</label></th>
                            <td>
<select name="acceso11"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta11= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Vehiculos' and area='COTIZACION'";                     
    $result11=  mysqli_query($conexion,$consulta11);
    while($fila2=  mysqli_fetch_array($result11)){
    $acceso11=$fila2['acceso'];
    $eliminar11=$fila2['eliminar'];
    $editar11=$fila2['editar'];
    $exportar11=$fila2['exportar'];
    $importar11=$fila2['importar'];
    $listar11=$fila2['listar'];
    $ver11=$fila2['ver'];
    
    }
 
    ?>
  <?php if(isset($acceso11)){echo"<option value='".$acceso11."'>".$acceso11."</option>";} ?>
<?php if($acceso11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$eliminar11."'>".$eliminar11."</option>";} ?>

<?php if($eliminar11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$editar11."'>".$editar11."</option>";} ?>

<?php if($editar11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$exportar11."'>".$exportar11."</option>";} ?>

<?php if($exportar11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$importar11."'>".$importar11."</option>";} ?>

<?php if($importar11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$listar11."'>".$listar11."</option>";} ?>

<?php if($listar11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver11"  style="width:120px;">
    <?php if(isset($acceso11)){echo"<option value='".$ver11."'>".$ver11."</option>";} ?>

<?php if($ver11!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver11!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Llamadas" value="Llamadas">Hojas de Vida</label></th>
                            <td>
<select name="acceso12"  style="width:120px;">
    <?php
    include "../modelo/conexion.php";
    $consulta12= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Hojas' and area='COTIZACION'";                     
    $result12=  mysqli_query($conexion,$consulta12);
    while($fila=  mysqli_fetch_array($result12)){
    $acceso12=$fila['acceso'];
    $eliminar12=$fila['eliminar'];
    $editar12=$fila['editar'];
    $exportar12=$fila['exportar'];
    $importar12=$fila['importar'];
    $listar12=$fila['listar'];
    $ver12=$fila['ver'];
   
    }
    ?>
  <?php if(isset($acceso12)){echo"<option value='".$acceso12."'>".$acceso12."</option>";} ?>
<?php if($acceso12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$eliminar12."'>".$eliminar12."</option>";} ?>

<?php if($eliminar12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$editar12."'>".$editar12."</option>";} ?>

<?php if($editar12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$exportar12."'>".$exportar12."</option>";} ?>

<?php if($exportar12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$importar12."'>".$importar12."</option>";} ?>

<?php if($importar12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$listar12."'>".$listar12."</option>";} ?>

<?php if($listar12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver12"  style="width:120px;">
    <?php if(isset($acceso12)){echo"<option value='".$ver12."'>".$ver12."</option>";} ?>

<?php if($ver12!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver12!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Control Trafico</label></th>
                            <td>
<select name="acceso13"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta13= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='trafico' and area='COTIZACION'";                     
    $result13=  mysqli_query($conexion,$consulta13);
    while($fila=  mysqli_fetch_array($result13)){
    $acceso13=$fila['acceso'];
    $eliminar13=$fila['eliminar'];
    $editar13=$fila['editar'];
    $exportar13=$fila['exportar'];
    $importar13=$fila['importar'];
    $listar13=$fila['listar'];
    $ver13=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso13)){echo"<option value='".$acceso13."'>".$acceso13."</option>";} ?>
<?php if($acceso13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$eliminar13."'>".$eliminar13."</option>";} ?>

<?php if($eliminar13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$editar13."'>".$editar13."</option>";} ?>

<?php if($editar13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$exportar13."'>".$exportar13."</option>";} ?>

<?php if($exportar13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$importar13."'>".$importar13."</option>";} ?>

<?php if($importar13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$listar13."'>".$listar13."</option>";} ?>

<?php if($listar13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver13"  style="width:120px;">
    <?php if(isset($acceso13)){echo"<option value='".$ver13."'>".$ver13."</option>";} ?>

<?php if($ver13!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver13!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Inventario</label></th>
                            <td>
<select name="acceso14"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta14= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Inventario' and area='COTIZACION'";                     
    $result14=  mysqli_query($conexion,$consulta14);
    while($fila=  mysqli_fetch_array($result14)){
    $acceso_inv=$fila['acceso'];
    $eliminar_inv=$fila['eliminar'];
    $editar_inv=$fila['editar'];
    $exportar_inv=$fila['exportar'];
    $importar_inv=$fila['importar'];
    $listar_inv=$fila['listar'];
    $ver_inv=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_inv)){echo"<option value='".$acceso_inv."'>".$acceso_inv."</option>";} ?>
<?php if($acceso_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$eliminar_inv."'>".$eliminar_inv."</option>";} ?>

<?php if($eliminar_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$editar_inv."'>".$editar_inv."</option>";} ?>

<?php if($editar_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$exportar_inv."'>".$exportar_inv."</option>";} ?>

<?php if($exportar_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$importar_inv."'>".$importar_inv."</option>";} ?>

<?php if($importar_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$listar_inv."'>".$listar_inv."</option>";} ?>

<?php if($listar_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver14"  style="width:120px;">
    <?php if(isset($acceso_inv)){echo"<option value='".$ver_inv."'>".$ver_inv."</option>";} ?>

<?php if($ver_inv!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_inv!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Compras</label></th>
                            <td>
<select name="acceso15"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta15= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Compras' and area='COTIZACION'";                     
    $result15=  mysqli_query($conexion,$consulta15);
    while($fila=  mysqli_fetch_array($result15)){
    $acceso_com=$fila['acceso'];
    $eliminar_com=$fila['eliminar'];
    $editar_com=$fila['editar'];
    $exportar_com=$fila['exportar'];
    $importar_com=$fila['importar'];
    $listar_com=$fila['listar'];
    $ver_com=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_com)){echo"<option value='".$acceso_com."'>".$acceso_com."</option>";} ?>
<?php if($acceso_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$eliminar_com."'>".$eliminar_com."</option>";} ?>

<?php if($eliminar_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$editar_com."'>".$editar_com."</option>";} ?>

<?php if($editar_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$exportar_com."'>".$exportar_com."</option>";} ?>

<?php if($exportar_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$importar_com."'>".$importar_com."</option>";} ?>

<?php if($importar_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$listar_com."'>".$listar_com."</option>";} ?>

<?php if($listar_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver15"  style="width:120px;">
    <?php if(isset($acceso_com)){echo"<option value='".$ver_com."'>".$ver_com."</option>";} ?>

<?php if($ver_com!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_com!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Proveedores</label></th>
                            <td>
<select name="acceso16"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta16= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Proveedores' and area='COTIZACION'";                     
    $result16=  mysqli_query($conexion,$consulta16);
    while($fila=  mysqli_fetch_array($result16)){
    $acceso_prov=$fila['acceso'];
    $eliminar_prov=$fila['eliminar'];
    $editar_prov=$fila['editar'];
    $exportar_prov=$fila['exportar'];
    $importar_prov=$fila['importar'];
    $listar_prov=$fila['listar'];
    $ver_prov=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_prov)){echo"<option value='".$acceso_prov."'>".$acceso_prov."</option>";} ?>
<?php if($acceso_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$eliminar_prov."'>".$eliminar_prov."</option>";} ?>

<?php if($eliminar_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$editar_prov."'>".$editar_prov."</option>";} ?>

<?php if($editar_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$exportar_prov."'>".$exportar_prov."</option>";} ?>

<?php if($exportar_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$importar_prov."'>".$importar_prov."</option>";} ?>

<?php if($importar_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$listar_prov."'>".$listar_prov."</option>";} ?>

<?php if($listar_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver16"  style="width:120px;">
    <?php if(isset($acceso_prov)){echo"<option value='".$ver_prov."'>".$ver_prov."</option>";} ?>

<?php if($ver_prov!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_prov!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Facturacion</label></th>
                            <td>
<select name="acceso17"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta17= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Facturacion' and area='COTIZACION'";                     
    $result17=  mysqli_query($conexion,$consulta17);
    while($fila=  mysqli_fetch_array($result17)){
    $acceso_fact=$fila['acceso'];
    $eliminar_fact=$fila['eliminar'];
    $editar_fact=$fila['editar'];
    $exportar_fact=$fila['exportar'];
    $importar_fact=$fila['importar'];
    $listar_fact=$fila['listar'];
    $ver_fact=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_fact)){echo"<option value='".$acceso_fact."'>".$acceso_fact."</option>";} ?>
<?php if($acceso_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$eliminar_fact."'>".$eliminar_fact."</option>";} ?>

<?php if($eliminar_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$editar_fact."'>".$editar_fact."</option>";} ?>

<?php if($editar_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$exportar_fact."'>".$exportar_fact."</option>";} ?>

<?php if($exportar_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$importar_fact."'>".$importar_fact."</option>";} ?>

<?php if($importar_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$listar_fact."'>".$listar_fact."</option>";} ?>

<?php if($listar_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver17"  style="width:120px;">
    <?php if(isset($acceso_fact)){echo"<option value='".$ver_fact."'>".$ver_fact."</option>";} ?>

<?php if($ver_fact!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_fact!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
<tr>
                            <th><label name="Reuniones" value="Reuniones">Tareas</label></th>
                            <td>
<select name="acceso18"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta18= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Tareas' and area='CRM'";                     
    $result18=  mysqli_query($conexion,$consulta18);
    while($fila=  mysqli_fetch_array($result18)){
    $acceso_tar=$fila['acceso'];
    $eliminar_tar=$fila['eliminar'];
    $editar_tar=$fila['editar'];
    $exportar_tar=$fila['exportar'];
    $importar_tar=$fila['importar'];
    $listar_tar=$fila['listar'];
    $ver_tar=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_tar)){echo"<option value='".$acceso_tar."'>".$acceso_tar."</option>";} ?>
<?php if($acceso_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$eliminar_tar."'>".$eliminar_tar."</option>";} ?>

<?php if($eliminar_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$editar_tar."'>".$editar_tar."</option>";} ?>

<?php if($editar_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$exportar_tar."'>".$exportar_tar."</option>";} ?>

<?php if($exportar_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$importar_tar."'>".$importar_tar."</option>";} ?>

<?php if($importar_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$listar_tar."'>".$listar_tar."</option>";} ?>

<?php if($listar_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver18"  style="width:120px;">
    <?php if(isset($acceso_tar)){echo"<option value='".$ver_tar."'>".$ver_tar."</option>";} ?>

<?php if($ver_tar!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_tar!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
<tr>
                            <th><label name="Reuniones" value="Reuniones">Llamadas</label></th>
                            <td>
<select name="acceso19"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta19= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Llamadas' and area='CRM'";                     
    $result19=  mysqli_query($conexion,$consulta19);
    while($fila=  mysqli_fetch_array($result19)){
    $acceso_lla=$fila['acceso'];
    $eliminar_lla=$fila['eliminar'];
    $editar_lla=$fila['editar'];
    $exportar_lla=$fila['exportar'];
    $importar_lla=$fila['importar'];
    $listar_lla=$fila['listar'];
    $ver_lla=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_lla)){echo"<option value='".$acceso_lla."'>".$acceso_lla."</option>";} ?>
<?php if($acceso_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$eliminar_lla."'>".$eliminar_lla."</option>";} ?>

<?php if($eliminar_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$editar_lla."'>".$editar_lla."</option>";} ?>

<?php if($editar_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$exportar_lla."'>".$exportar_lla."</option>";} ?>

<?php if($exportar_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$importar_lla."'>".$importar_lla."</option>";} ?>

<?php if($importar_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$listar_lla."'>".$listar_lla."</option>";} ?>

<?php if($listar_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver19"  style="width:120px;">
    <?php if(isset($acceso_lla)){echo"<option value='".$ver_lla."'>".$ver_lla."</option>";} ?>

<?php if($ver_lla!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_lla!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Reuniones</label></th>
                            <td>
<select name="acceso20"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta20= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Reuniones' and area='CRM'";                     
    $result20=  mysqli_query($conexion,$consulta20);
    while($fila=  mysqli_fetch_array($result20)){
    $acceso_reu=$fila['acceso'];
    $eliminar_reu=$fila['eliminar'];
    $editar_reu=$fila['editar'];
    $exportar_reu=$fila['exportar'];
    $importar_reu=$fila['importar'];
    $listar_reu=$fila['listar'];
    $ver_reu=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_reu)){echo"<option value='".$acceso_reu."'>".$acceso_reu."</option>";} ?>
<?php if($acceso_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$eliminar_reu."'>".$eliminar_reu."</option>";} ?>

<?php if($eliminar_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$editar_reu."'>".$editar_reu."</option>";} ?>

<?php if($editar_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$exportar_reu."'>".$exportar_reu."</option>";} ?>

<?php if($exportar_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$importar_reu."'>".$importar_reu."</option>";} ?>

<?php if($importar_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$listar_reu."'>".$listar_reu."</option>";} ?>

<?php if($listar_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver20"  style="width:120px;">
    <?php if(isset($acceso_reu)){echo"<option value='".$ver_reu."'>".$ver_reu."</option>";} ?>

<?php if($ver_reu!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_reu!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Notas</label></th>
                            <td>
<select name="acceso21"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta21= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Notas' and area='CRM'";                     
    $result21=  mysqli_query($conexion,$consulta21);
    while($fila=  mysqli_fetch_array($result21)){
    $acceso_not=$fila['acceso'];
    $eliminar_not=$fila['eliminar'];
    $editar_not=$fila['editar'];
    $exportar_not=$fila['exportar'];
    $importar_not=$fila['importar'];
    $listar_not=$fila['listar'];
    $ver_not=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_not)){echo"<option value='".$acceso_not."'>".$acceso_not."</option>";} ?>
<?php if($acceso_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$eliminar_not."'>".$eliminar_not."</option>";} ?>

<?php if($eliminar_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$editar_not."'>".$editar_not."</option>";} ?>

<?php if($editar_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$exportar_not."'>".$exportar_not."</option>";} ?>

<?php if($exportar_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$importar_not."'>".$importar_not."</option>";} ?>

<?php if($importar_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$listar_not."'>".$listar_not."</option>";} ?>

<?php if($listar_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver21"  style="width:120px;">
    <?php if(isset($acceso_not)){echo"<option value='".$ver_not."'>".$ver_not."</option>";} ?>

<?php if($ver_not!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_not!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Solicitudes</label></th>
                            <td>
<select name="acceso23"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta23= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Solicitudes' and area='COTIZACION'";                     
    $result23=  mysqli_query($conexion,$consulta23);
    while($fila=  mysqli_fetch_array($result23)){
    $acceso_sol=$fila['acceso'];
    $eliminar_sol=$fila['eliminar'];
    $editar_sol=$fila['editar'];
    $exportar_sol=$fila['exportar'];
    $importar_sol=$fila['importar'];
    $listar_sol=$fila['listar'];
    $ver_sol=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_sol)){echo"<option value='".$acceso_sol."'>".$acceso_sol."</option>";} ?>
<?php if($acceso_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$eliminar_sol."'>".$eliminar_sol."</option>";} ?>

<?php if($eliminar_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$editar_sol."'>".$editar_sol."</option>";} ?>

<?php if($editar_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$exportar_sol."'>".$exportar_sol."</option>";} ?>

<?php if($exportar_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$importar_sol."'>".$importar_sol."</option>";} ?>

<?php if($importar_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$listar_sol."'>".$listar_sol."</option>";} ?>

<?php if($listar_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver23"  style="width:120px;">
    <?php if(isset($acceso_sol)){echo"<option value='".$ver_sol."'>".$ver_sol."</option>";} ?>

<?php if($ver_sol!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_sol!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Gestiones</label></th>
                            <td>
<select name="acceso24"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta24= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Gestiones' and area='COTIZACION'";                     
    $result24=  mysqli_query($conexion,$consulta24);
    while($fila=  mysqli_fetch_array($result24)){
    $acceso_ges=$fila['acceso'];
    $eliminar_ges=$fila['eliminar'];
    $editar_ges=$fila['editar'];
    $exportar_ges=$fila['exportar'];
    $importar_ges=$fila['importar'];
    $listar_ges=$fila['listar'];
    $ver_ges=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_ges)){echo"<option value='".$acceso_ges."'>".$acceso_ges."</option>";} ?>
<?php if($acceso_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$eliminar_ges."'>".$eliminar_ges."</option>";} ?>

<?php if($eliminar_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$editar_ges."'>".$editar_ges."</option>";} ?>

<?php if($editar_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$exportar_ges."'>".$exportar_ges."</option>";} ?>

<?php if($exportar_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$importar_ges."'>".$importar_ges."</option>";} ?>

<?php if($importar_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$listar_ges."'>".$listar_ges."</option>";} ?>

<?php if($listar_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver24"  style="width:120px;">
    <?php if(isset($acceso_ges)){echo"<option value='".$ver_ges."'>".$ver_ges."</option>";} ?>

<?php if($ver_ges!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_ges!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
                        
                        <tr>
                            <th><label name="Reuniones" value="Reuniones">Orden De Compra</label></th>
                            <td>
<select name="acceso25"  style="width:120px;">
 <?php
    include "../modelo/conexion.php";
    $consulta25= "select * from roles_accion where id_roles=".$_GET["codigo"]." and modulo='Orden de Compra' and area='COTIZACION'";                     
    $result25=  mysqli_query($conexion,$consulta25);
    while($fila=  mysqli_fetch_array($result25)){
    $acceso_oc=$fila['acceso'];
    $eliminar_oc=$fila['eliminar'];
    $editar_oc=$fila['editar'];
    $exportar_oc=$fila['exportar'];
    $importar_oc=$fila['importar'];
    $listar_oc=$fila['listar'];
    $ver_oc=$fila['ver'];
 
    }
    ?>
  <?php if(isset($acceso_oc)){echo"<option value='".$acceso_oc."'>".$acceso_oc."</option>";} ?>
<?php if($acceso_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($acceso_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="eliminar25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$eliminar_oc."'>".$eliminar_oc."</option>";} ?>

<?php if($eliminar_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($eliminar_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="editar25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$editar_oc."'>".$editar_oc."</option>";} ?>

<?php if($editar_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($editar_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="exportar25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$exportar_oc."'>".$exportar_oc."</option>";} ?>

<?php if($exportar_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($exportar_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="importar25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$importar_oc."'>".$importar_oc."</option>";} ?>

<?php if($importar_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($importar_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="listar25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$listar_oc."'>".$listar_oc."</option>";} ?>

<?php if($listar_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($listar_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>
<td>
<select name="ver25"  style="width:120px;">
    <?php if(isset($acceso_oc)){echo"<option value='".$ver_oc."'>".$ver_oc."</option>";} ?>

<?php if($ver_oc!='Habilitado'){ ?><option value="Habilitado">Habilitado</option><?php } ?>
<?php if($ver_oc!='No Habilitado'){ ?><option value="No Habilitado">No Habilitado</option><?php } ?>
</select>
</td>

                        </tr>
</table>
                    </form>
                    
                </article>
                               <br><br><br>
     <?php }
 
 if(isset($_GET['del_1'])){
$sql = "DELETE FROM referencia_alum WHERE id_ref_alum=".$_GET['del_1']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_per'";
echo "</script>";
}
                              
                                