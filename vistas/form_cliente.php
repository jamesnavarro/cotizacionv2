<?php 
include "../modelo/conexion.php";
$request=mysql_query('select count(*) from clientes');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 20;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
	<title>sistema Integral</title>
        <script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/contacto.php","miventana","width=500,height=410,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 

function cerrar() {window.close();}
	
	 
   
</script>
<script language="javascript" type="text/javascript">
function pasar(){
    window.opener.dato(document.getElementById('datos7').value,
    document.getElementById('datos8').value,
    document.getElementById('datos5').value,
    document.getElementById('datos6').value,
     document.getElementById('datos9').value);
    window.close();
}
</script>
      
    </head>
    <body  onload="javascript:pasar();">
        
        <article class="module width_full">
			<header><h3>Busqueda de Clientes</h3></header>
                        <?php if(isset($_GET['cod'])){
                     
                     $request=mysql_query("select * from clientes WHERE id_cli=".$_GET['cod']);
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>nombre seleccionado :'.$row["nombre_cli"];
          
              $nnn = $row["nombre_cli"];
              $ii = $row["id_cli"];
              $tel = $row["telefono_cli"];
              $dir = $row["direccion_cli"];
              $email = $row["email"];
           ?>
        

<input type="text" name="datos7" id="datos7" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos8" id="datos8" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos5" readonly value="<?php echo $tel ?>" />
<input type="text" name="datos6" id="datos6" readonly value="<?php echo $dir ?>" />
<input type="text" name="datos9" id="datos9" readonly value="<?php echo $email ?>" />
<a href="#" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }}else{ ?>
                    
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                    
                                    
                                                        
				     <br><br></fieldset><br>
                                     </form>
                                    <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/form_cliente.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/form_cliente.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/form_cliente.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/form_cliente.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["nombre"])){
$nom =$_POST["nombre"];
$tel =$_POST["telefono"];
$dir =$_POST["direccion"];
$use =$_POST["user"];
$pro =$_POST["propietario"];
$dep =$_POST["departamento"];
$mun =$_POST["municipio"];
$tip =$_POST["tipo"];

if($nom =='' && $tel =='' && $dir =='' && $use =='' && $pro =='' && $dep =='' && $mun =='' && $tip ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery('select * from sis_empresa  where cliente="Si" order by id_empresa asc '.$limit);
}

if($nom !='' || $tel !='' || $dir !='' || $use !='' || $pro !='' || $dep !='' || $mun !='' || $tip !=''){
$request=mysql_query("select * from sis_empresa WHERE cliente='Si' and nombre_emp LIKE '%".$nom."%' and tel_oficina_emp LIKE '%".$tel."%' and direccione_emp LIKE '%".$dir."%' and departameto_emp LIKE '%".$dep."%' and municipio_emp LIKE '%".$mun."%' and tipo_emp LIKE '%".$tip."%' and rips LIKE '%".$use."%' order by id_empresa asc ".$limit);}
}
else{
$request=mysql_query('select * from clientes '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Rips'.'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Ciudad'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Usuario'.'</th>';
         
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
          
          
           
          
           
           
           $table = $table.'<tr><td>'.$row['id_cli'].'</font></td><td><a href="../vistas/form_cliente.php?cod='.$row["id_cli"].'">'.$row["nombre_cli"].'<font></a></td></td><td>'.$row['cedu_nit'].'</font></td>
               <td>'.$row["telefono_cli"].'</font></td><td>'.$row["direccion_cli"].'</font></td><td>'.$row['tipo_cli'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Reunion Eliminada");location.href="../vistas/mostrar_empresas.php"</script>'; 
    }
    
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>

    </body>
</html>
