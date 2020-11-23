<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script>
$(function () {
    mostrarCot(1);
    $("#cot").change(function(){
        mostrarCot(1);
    });
    $("#nom").change(function(){
        mostrarCot(1);
    });
    $("#obr").change(function(){
        mostrarCot(1);
    });
    $("#reg").change(function(){
        mostrarCot(1);
    });
     $("#se").change(function(){
        mostrarCot(1);
    });
    $("#estado").change(function(){
        mostrarCot(1);
    });
    $("#valorp").change(function(){
        mostrarCot(1);
    });
     $("#desdef").change(function(){
        mostrarCot(1);
    });
     $("#hastaf").change(function(){
        mostrarCot(1);
    });
});
</script>
<script>
	function mostrarCot(page) {
		cot = $("#cot").val();
		nom = $("#nom").val();
		obr = $("#obr").val();
		reg = $("#reg").val();
                ana = $("#se").val();
                est = $("#estado").val();
                valor = $("#valorp").val();
                dsd = $("#desdef").val();
                hsta = $("#hastaf").val();
                console.log(dsd,hsta);
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("../buscadores/buscar_1.php", {cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est,valor:valor,dsdd:dsd,hstaa:hsta}, function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
	}
        
        function seguir(cot){
             window.open('../vistas/seguimientos/index.php?cotis='+cot,'seg1','width=1000,height=600');  
        }
        
</script>
        <?php
	function dias_transcurridos($fecha_i, $fecha_f) {
		$dias	= (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
		$dias 	= abs($dias);
		$dias   = floor($dias);
		return $dias;
	}
        ?>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                         <header>

                                <h4 class="title">Cotizaciones Realizadas <span id="load"></span></h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
                                            <!-- Normal Tabs -->
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                                       <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            <section class="body">
                                <div class="body-inner no-padding">
<?php
if(isset($_GET['pasar'])){
    $re=mysqli_query($conexion,"SELECT * FROM cotizacion ");
    $v = 0;
    while($r=mysqli_fetch_array($re))
	{
          
$sql='select * from cont_terceros where id_cliente="'.$r['id_cliente'].'" and tipo="'.$r['tipo'].'" ';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id= $fil["id_ter"];
          
            $v +=1;
            $sql2 = "UPDATE `cotizacion` SET `id_tercero`='".$id."' WHERE `id_cliente`='".$r['id_cliente']."' and tipo='".$r['tipo']."' ;";
            mysqli_query($conexion,$sql2) or die (mysqli_error());

        }
             echo '<script lanquage="javascript">alert("Se ha agregado a la lista de tercero '.$v.'");location.href="../vistas/?id=lista_cot&estado=En proceso"</script>'; 

}else{
?>

	<table class="table table-bordered table-striped table-hover" >
            
          
            
            <tr>
                <td style="text-align: right">Numero...</td>
                <td><input type="text" id="cot" autofocus autocomplete="off" class="span6" placeholder="#" value=""></td>
                 <td style="text-align: right">Nombre cliente...</td>
                 <td><input type="text"  autocomplete="off" class="span9" id="nom" placeholder="Nombre del cliente" value=""></td>
                 <td style="text-align: right">Nombre de la obra...</td>
                 <td><input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value=""></td>
            </tr>
            
            <tr>
               
                <td style="text-align: right">Analista... </td> <td> <select id="se" name="numero" class="span10" required>
				<?php
					if (isset($_GET['cot'])) {
						echo "<option value='" . $reg . "'>" . $reg . "</option>";
					} else {
						echo "<option value=''>Analistas</option>";
				}
      $consulta= "SELECT * FROM `usuarios` where cargo='Presupuesto' order by nombre";   
      $result=  mysqli_query($conexion,$consulta);        echo"<option value='ADMIN'>ADMIN</option>";  
      while($fila=  mysqli_fetch_array($result)){       
          $valor3=$fila['usuario'];  
          $valor4=$fila['nombre'].' '.$fila['apellido'];   
   
          echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
          }                                                       
          ?>       
                            </select> </td>
             
                            <td style="text-align: right"> Asesores... </td> <td><select id="reg" name="numero" class="span9" required>
				<?php
					
				echo "<option value=''>Seleccione</option>";
					
                                $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                                $result2=  mysqli_query($conexion,$consulta2);       
                                echo"<option value='ADMIN'>ADMIN</option>";  
                                while($fila=  mysqli_fetch_array($result2)){       
                                    $valor3=$fila['usuario'];  
                                    $valor4=$fila['nombre'].' '.$fila['apellido'];   
   
                                echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                }                                                       
          ?>       
                            </select></td>
                            <td style="text-align: right">Estado... </td> <td> <select id="estado" name="estado" class="span14" required>
<option value="">Seleccione Estado</option>
<option value="En proceso">En proceso</option>
<option value="Pedido por aprobar">Pedido por aprobar</option>
<option value="Aprobado">Aprobado</option>
                    </select> </td>
            </tr>
            
           <tr>
               <td style="text-align: right"> desde...  </td><td> <input type="date" class="span10" id="desdef" value=""></td>
                <td style="text-align: right"> Hasta... </td><td><input type="date" id="hastaf" class="span9" value=""></td>
                <td style="text-align: right"> mayor a...  </td><td><input type="number" id="valorp"  class="span10" placeholder="Filtrar Ventas superiores a ...."></td>
            </tr>
            
            
            
            
            
		<tr bgcolor="#D1EEF0">
			<th width="5%"></th>
			<th width="20%"></th>
			<th width="20%"></th>
		<th>
			
                       
 
                           </th>
                    <th>
    
               </th>       
               <th>
    
               </th><th><img src="../images/buscar.png" Style="cursor: pointer" id="buscador"></th>
              </tr>
</table>
                                    <br>
                                    <div id="cotizacione"  class="table-responsive">
			<?php
				//include "../buscadores/buscar_1.php";
			?>
		</div>
    <?php } ?>
                </div>
                </section>
               </div>
              </div>
             </div>
           </div>
         </div><!--/ Normal Tabs -->
        </div>
     </section>
    </div>
   </div>
  </section>
</div>
<?php
if(isset($_GET['abrir'])){ 
    include "../modelo/conexion.php";
  

    mysqli_query($conexion,"update cotizacion set estado='En proceso', ultimo_estado='".$_GET['ultimo']."' where id_cot='".$_GET['abrir']."'");
    
    mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`,registro)"
            . " VALUES (NULL, 'Cotizacion abierta por ".$_SESSION['k_username']." ultmo estado ".$_GET['ultimo']." ', '".$_SESSION['k_username']."', 'Cotizacion', '".$_GET['abrir']."','$fecha_hoy')");
    
    echo '<script>alert("Se habilito la cotizacion con exito.  ");location.href="../vistas/?id=lista_cot";</script>';
    
}
if(isset($_GET['trasladar'])){
    $tras = mysqli_query($conexion,"select * from cotizacion");
    while($d = mysqli_fetch_array($tras)){
        $result = mysqli_query($conexion,"select * from cont_terceros where id_ter=".$d['id_tercero']." ");
        $c= mysqli_fetch_array($result);
        $clie = 658;
        $sqlx = "UPDATE `cotizacion` SET  nom_temp='".$c['nom_ter']."',cod_temp='".$c['cod_ter']."', id_tercero='658' WHERE `id_cot` = ".$d['id_cot']." and `nom_temp` = '';";           
        mysqli_query($conexion,$sqlx);
        echo '<script>alert("Traslado con exito");location.href="../vistas/?id=lista_cot";</script>';
    }
}