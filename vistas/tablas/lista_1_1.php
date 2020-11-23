<?php 
$request=mysqli_query($conexion,'select count(*) from usuarios');
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
?>  
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Usuarios</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                              <!-- Help Text -->
                              <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Buscar usuario por nombre, cargo o por cedula</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <input  class="span8"  name="nombre" placeholder="Busqueda por Nombre , usuario, area" id="select2_1">
                                             
                                                </div>
                                            
                                              
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Usuarios</a></li>

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
if($page>1){?>
	<a href="../vistas/?id=list_user&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=list_user&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=list_user&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=list_user&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['nombre'])){

    $request=mysqli_query($conexion,"SELECT a.*,(b.nombre) as empresa FROM usuarios a,inf_empresa b where a.id_empresa = b.id_emp and CONCAT(a.nombre, ' ',a.apellido, ' ',a.usuario) like '%".$_POST['nombre']."%'");
}else{
$request=mysqli_query($conexion,"SELECT a.*,(b.nombre) as empresa FROM usuarios a,inf_empresa b where a.id_empresa = b.id_emp ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="10%">'.'Cedula'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre Completo'.'</th>';
              $table = $table.'<th width="5%">'.'Admin del sistema'.'</th>';
              $table = $table.'<th width="10%">'.'Telefono'.'</th>';
              $table = $table.'<th width="10%">'.'Empresa'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cargo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Area.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Correo.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Fecha Reg..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
              $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=user&cod='.$row['id_user'].'">'.$row['id_user'].'</a></td>'
                    . '<td width="10%">'.$row['cedula'].'</font></td>'
                    . '<td width="20%"><a href="../vistas/?id=user&cod='.$row['id_user'].'">'.strtoupper($row["nombre"].' '.$row["apellido"]).'<font></a></td>'
                    . '<td width="5%">'.$row["administrador"].'<font></a></td>'
                    . '<td width="10%">'.$row["telefono"].'<font></a></td>
               <td width="10%">'.$row["empresa"].'</font></td>
               <td class="hidden-phone">'.$row["cargo"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["area"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["email"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["estado"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["ingreso"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["usuario"].'</font></td>'
                    . '<td> <a href="../vistas/?id=list_user&del='.$row["id_user"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
      
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

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

                        <!-- START Form Wizard -->

                     <?php 
   

 $request=mysqli_query($conexion,"SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");
    
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th width="20%">'.'Nombre del Cliente'.'</th>';             
              $table = $table.'<th width="40%">'.'Direccion'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Prestamo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>
               <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}

       
                       ?>456
                       

                        <!--/ END Form Wizard -->

                    </div>

                                    </div>

                                    

                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($_GET['del']==1){
          echo '<script lanquage="javascript">alert("Este Usuario no se puede Eliminar");location.href="../vistas/?id=list_user"</script>'; 
     }else{
       $sql = "DELETE FROM usuarios WHERE id_user=".$_GET['del']."";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=list_user'";
echo "</script>";  
     }

}

?>