<?php 
$request=mysqli_query($conexion,'select count(*) from sis_empresa');
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
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Empresas</h4>

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

<a href="../vistas/?id=empresas&pasar">Pasar a clientes</a>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

if(isset($_GET['pasar'])){
    $re=mysqli_query($conexion,"SELECT * FROM sis_empresa ");
    $v = 0;
    while($r=mysqli_fetch_array($re))
	{
        $v +=1;
            $sql = "INSERT INTO cont_terceros (especial,fuente,ica,iva,cree,cod_ter,nom_ter,doc_ter,digiver_ter,dir_ter,telfijo_ter,telmovil_ter,ciudad_ter,pais_ter,fecnac_ter,correo_ter,cont_ter,creado,tipo,id_cliente,fecha_registro)";
            $sql.= "VALUES ('0','0','0','0','0','".$r['nit_emp']."','".$r['nombre_emp']."','NIT','0','".$r['direccionr_emp']."','".$r['tel_oficina_emp']."','".$r['celular_emp']."','08001','0169','0000-00-00','".$r['email1_emp']."','".$r['propietario_emp']."','".$r['usuario']."','Empresarial','".$r['id_empresa']."','".date("Y-m-d")."') ";
            mysqli_query($conexion,$sql) or die (mysqli_error());

        }
             echo '<script lanquage="javascript">alert("Se ha agregado a la lista de tercero '.$v.'");location.href="../vistas/?id=empresas"</script>'; 

}

   
if(isset($_POST['empresa']) || isset($_POST['ciudad']) || isset($_POST['user'])){
   
    
    

    $request=mysqli_query($conexion,"SELECT * FROM sis_empresa where nombre_emp like '%".$_POST['empresa']."%' and municipio_emp like '%".$_POST['ciudad']."%' and usuario like '%".$_POST['user']."%'");
}else{
$request=mysqli_query($conexion,"SELECT * FROM sis_empresa ");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="30%">'.'Nombre de la empresa'.'</th>'; 
              $table = $table.'<th width="20%">'.'Propietario'.'</th>';
              $table = $table.'<th width="10%">'.'Ciudad'.'</th>';
              $table = $table.'<th width="7%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="7%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
                if($editar_emp == 'Habilitado'){
                    $up = '<a href="../vistas/?id=empresa&cod='.$row["id_empresa"].'"><img src="../imagenes/modificar.png"></a>';
                }else{
                    $up = '';
                }    
        
                if($eliminar_emp == 'Habilitado'){
                    $del = '<a href="../vistas/?id=empresas&del='.$row["id_empresa"].'"><img src="../imagenes/eliminar.png"></a>';
                }else{
                    $del = '';
                }  
        
                if($ver_emp == 'Habilitado'){
                    $ver = '<a href="../vistas/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$row['nombre_emp'].'</a>';
                }else{
                    $ver = $row['nombre_emp'];
                }  
                
                $table = $table.'<tr>
                <td width="30%">'.$ver.'</td> 
                <td width="20%">'.$row['propietario_emp'].'<font></a></td>
                <td width="10%">'.$row["municipio_emp"].'<font></a></td>
                <td width="7%">'.$row["tel_oficina_emp"].'</font></td><td width="7%">'.$row["celular_emp"].'</font></td><td class="hidden-phone">'.$row["usuario"].'</font></td>
                <td>'.$up.'</td>
                <td>'.$del.'</td>'
                . '</tr>';   
      
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

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($eliminar_emp!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=empresas"</script>'; 
}else{
$sql = "DELETE FROM sis_empresa WHERE id_empresa=".$_GET['del']." and usuario='".$_SESSION['k_username']."'";
mysqli_query($conexion,$sql);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=empresas'";
echo "</script>";
}
 }
?>