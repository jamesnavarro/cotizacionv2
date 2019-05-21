<?php 
require '../modelo/conexion.php'; 
if(isset($_GET['cod'])){ $sql='select * from clientes where id_cli="'.$_GET['cod'].'"'; $fil = mysql_fetch_array(mysql_query($sql)); $id_p= $fil["id_cli"];
$nombre= $fil["nombre_cli"]; 
$cedu_nit= $fil["cedu_nit"];
$tipo_cli= $fil["tipo_cli"]; 
$direccion_cli= $fil["direccion_cli"];
$Departamento= $fil["Departamento"];
$Municipio= $fil["Municipio"];
$telefono_cli= $fil["telefono_cli"];
$email= $fil["email"];  
$contacto= $fil["contacto"];
$contacto_tel= $fil["tel_contacto"]; }  
?>
<div class="row-fluid">
    <!-- START Form Wizard -->
    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/clientes.php?editar='.$_GET['cod'].'';}else{echo '../modelo/clientes.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
        <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Cliente';}else{echo 'Crear Cliente';} ?></h4></header>
        <section class="body">               
            <div class="body-inner"> 
                <div class="control-group">
                    <div class="controls">
                        <div class="row-fluid">
                            <div class="span4">
                                <input type="text" name="nombre" value="<?php if(isset($_GET['cod'])){echo $nombre;} ?>"  placeholder="Digite el nombre completo ó la Razón social" required class="span12">
                                <span class="help-block">Nombre del Cliente</span>
                            </div>
                            <div class="span4">
                             <input type="text"   name="documento" value="<?php if(isset($_GET['cod'])){echo $cedu_nit;} ?>" placeholder="Digite la cedula o el nit" required class="span12">
                             <span class="help-block">C.C ó NIT</span> 
                            </div>  
                        </div>   
                    </div>   
                    <label></label><div class="controls"> </div> 
                    <div class="controls">
                        <select name="tipo"  required  class="span4"> 
               <?php if(isset($_GET['cod'])){echo "<option value='".$tipo_cli."'>".$tipo_cli."</option>";}else{echo "<option value=''>Seleccione tipo de cliente </option>";} ?> 
                            <option value="Ocasional">Ocasional</option>
                            <option value="Frecuente">Frecuente</option>
                            <option value="Fiel">Fiel</option>
                        </select>
                        <span class="help-block">Tipo de Cliente</span></div>
                        <label></label><div class="controls"> </div>
                        <label></label><div class="controls"> </div>
                        <div class="controls">
                            <input type="text" name="direccion"  class="span6" value="<?php if(isset($_GET['cod'])){echo $direccion_cli;} ?>"  placeholder="Digite la direccion del cliente" required>
                            <span class="help-block">Dirección</span>
                        </div>
                        
 <div class="controls">
     <div class="row-fluid">
      <div class="span4">
       <select name="departamento" id="ciudad"  class="span12">
                 <?php if(isset($_GET['cod'])){echo "<option value='".$Departamento."'>".$Departamento."</option>";}else{echo "<option value=''>..Seleccione el producto</option>"; } ?> 
                  <?php  $consulta= "SELECT * FROM `departamentos` group by nombre_dep"; $result=  mysql_query($consulta); while($fila=  mysql_fetch_array($result))
                         {
                     $valor1=$fila['cod_dep'];
                     $valor2=$fila['nombre_dep'];
                     echo"<option value='".$valor2."'>".$valor2."</option>";
                     } ?>         
         </select> 
          <span class="help-block">Departamento</span>
      </div>  
        <div class="span4">
            <select name="municipio"  id="municipio"  class="span12">
            <?php if(isset($_GET['cod'])){echo "<option value='".$Municipio."'>".$Municipio."</option>";}else{echo "<option value=''>Seleccione.. </option>";} ?>  
            </select> <span class="help-block">Municipio</span></div>  
     </div>
 </div>   
 <div class="controls"> 
     <div class="row-fluid"> 
         <div class="span4"> 
             <input type="text" name="telefono" value="<?php if(isset($_GET['cod'])){echo $telefono_cli;} ?>"  placeholder="Digite el telefono o el celular" required class="span12">
             <span class="help-block">Telefono / Celular</span>  
         </div>  
         <div class="span4">
             <input type="text" name="mail" value="<?php if(isset($_GET['cod'])){echo $email;} ?>"  placeholder="Digite el e-mail del cliente" required class="span12">
             <span class="help-block">Email</span>  
         </div>  
     </div> 
 </div>  
  <div class="controls">
      <div class="row-fluid">                                                
          <div class="span4">  
              <input type="text" name="contacto" value="<?php if(isset($_GET['cod'])){echo $contacto;} ?>"  placeholder="Digite el nombre del contacto" required class="span12">
              <span class="help-block">Nombre del Contacto</span> 
          </div>  
          <div class="span4"> 
              <input type="text" name="tel_contacto" value="<?php if(isset($_GET['cod'])){echo $contacto_tel;} ?>"  placeholder="Digite el telefono del contacto" required class="span12">
              <span class="help-block">Telefono o Movil del Contacto</span> 
          </div>   
      </div>   
  </div>  
 <!-- Form Action -->    
 <div class="form-actions"> 
     <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Agregar';} ?></button>   
     <button type="button" class="btn">Cancelar</button>
 </div><!--/ Form Action -->
 </div> 
            </div>
        </section>
    </form>
</div>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   n>  
</form> <!--/ END Form Wizard --> 
</div>                               
 <?php if(isset($_GET['cod'])){$request=mysql_query('select count(*) from cotizacion where id_cliente='.$_GET['cod']);if($request){ $request = mysql_fetch_row($request); $num_items = $request[0];}else{ $num_items = 0;}$rows_by_page = 10;$last_page = ceil($num_items/$rows_by_page);if(isset($_GET['page'])){ $page = $_GET['page'];}else{	$page = 1;}?> 
            <div class="row-fluid">     
                <!-- START Form Wizard -->    
                <!-- START Widget Collapse -->     
                <section class="body">  
                    <div class="body-inner"> 
                        <div class="span12 widget dark stacked">   
                            <header><h4 class="title">Cotizaciones Realizadas por Cliente</h4>  <!-- START Toolbar -->
                                <ul class="toolbar pull-left"> 
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li> 
                                </ul>   
                                <!--/ END Toolbar -->   
                            </header>         
                            <section id="collapse1" class="body collapse in">   
                                <div class="body-inner"> 
                                    <!-- Normal Tabs -->  
                                    <div class="tabbable" style="margin-bottom: 25px;"> 
                                        <ul class="nav nav-tabs"> 
                                            <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Cotizaciones</a></li>  
                                        </ul>  
                                        <div class="tab-content"> 
                                            <div class="tab-pane active" id="tab1"> 
                                                <!-- START Row -->    
                                                <div class="row-fluid">  
                                                    <!-- START Datatable 2 --> 
                                                    <div class="span12 widget lime">   
                                                        <section class="body">   
                                                            <div class="body-inner no-padding">  
                                                              <?phpif($page>1){?>
                                                                <a href="../vistas/?id=lista_cot&page=1"><img src="../images/a1.png"></a>
                                                                <a href="../vistas/?id=lista_cot&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a><?php}else{ ?><img src="../images/ant.png"><?php}?>(Pagina <?php echo $page;?> de <?php echo $last_page;?>)<?phpif($page<$last_page){?>
                                                                <a href="../vistas/?id=lista_cot&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>	
                                                                <a href="../vistas/?id=lista_cot&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a><?php}else{	?><img src="../images/nex.png">  <?php}?><?php
//Esta es la cadena limit que anexaremos a nuestra consulta$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
//  $request=mysql_query("SELECT * FROM cotizacion a, clientes c where  a.id_cliente=c.id_cli and a.id_cliente='".$_GET['cod']."' ".$limit); 
//          if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';  
//                     $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">'; 
//                                  $table = $table.'<th width="5%">'.'Cotizacion No.'.'</th>';  
//                                  $table = $table.'<th width="40%">'.'Cliente'.'</th>';  
//                                  $table = $table.'<th width="40%">'.'Nombre de la Obra'.'</th>';  
//                                  $table = $table.'<th width="30%">'.'Fecha Registro'.'</th>'; 
//                                  $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>'; 
//                                  $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';  
//                                  $table = $table.'</tr>';  
//                                  $table = $table.'</thead>';	 
//   //Por cada resultado pintamos una linea  
//                                  $total2=0;	
//                                  while($row=mysql_fetch_array($request)) { 
//                                  $table = $table.'<tr><td width="5%"><a href="../vistas/?id=new_cot&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$row['id_cot'].'</a></td><td width="10%">'.$row['nombre_cli'].'</font></td><td width="30%">'.$row["obra"].'<font></a></td><td width="30%">'.$row["fecha_reg_c"].'<font></a></td> <td class="hidden-phone">'.$row["estado"].'</font></td><td class="hidden-phone">'.$row["registrado"].'</font></td></tr>'; 	} $table = $table.'</table>'; echo $table;  } ?>  
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
                <?php  $request= mysql_query("SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");  
                if($request){
// echo'<hr>'; $table = '<table class="table table-bordered table-striped table-hover" id="">';  $table = $table.'<thead >';  $table = $table.'<tr BGCOLOR="#E3EC7E">';  $table = $table.'<th width="20%">'.'Nombre del Cliente'.'</th>';  $table = $table.'<th width="40%">'.'Direccion'.'</th>'; $table = $table.'<th width="10%">'.'Valor Prestamo'.'</th>'; $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>'; $table = $table.'</tr>'; $table = $table.'</thead>'; //Por cada resultado pintamos una linea  $total2=0;	while($row=mysql_fetch_array($request))	{  $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>  <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>'; }  $table = $table.'</table>'; echo $table;  }  }  
                    
                }
 }
?>
                                                    <!--/ END Form Wizard -->  
                                                </div>  
                                            </div>                                                                    
                                        </div>                          
                                    </div><!--/ Normal Tabs --> 
                                </div>  
                            </section> 
                        </div>   <!--  Insumos--> 
                    </div> 
                </section>
            </div>
   