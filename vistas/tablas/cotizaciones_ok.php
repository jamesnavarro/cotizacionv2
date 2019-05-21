<script>
$(function () {
    mostrarCotA(1);
    $("#cot").change(function(){
        mostrarCotA(1);
    });
    $("#nom").change(function(){
        mostrarCotA(1);
    });
    $("#obr").change(function(){
        mostrarCotA(1);
    });
    $("#reg").change(function(){
        mostrarCotA(1);
    });
     $("#se").change(function(){
        mostrarCotA(1);
    });
    $("#estado").change(function(){
        mostrarCotA(1);
    });
});
</script>
<script>
	function mostrarCotA(page) {
		cot = $("#cot").val();
		nom = $("#nom").val();
		obr = $("#obr").val();
		reg = $("#reg").val();
                ana = $("#se").val();
                est = $("#estado").val();
                $("#load").html('<img src="../images/load.gif"> Cargando...');
		$.post("../vistas/tablas/lista_aprobadas.php", {cot:cot, nom:nom, obr:obr, reg:reg, page:page,ana:ana,est:est}, function(data) {
			$("#cotizacione").html(data);
                        $("#load").html('');
		});
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

                                <h4 class="title">Cotizaciones Aprobadas <span id="load"></span></h4>

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

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            <section class="body">

                                <div class="body-inner no-padding">
                              
	<table class="table table-bordered table-striped table-hover" id="">
		<tr bgcolor="#D1EEF0">
			<th width="5%"><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="#" value=""></th>
			<th width="20%"><input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value=""></th>
			<th width="20%"><input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value=""></th>
			<th>
			   <select id="se" name="numero" class="span6" required>
				<?php
					if (isset($_GET['cot'])) {
						echo "<option value='" . $reg . "'>" . $reg . "</option>";
					} else {
						echo "<option value=''>Analistas</option>";
					}
                                        $consulta= "SELECT * FROM `usuarios` where cargo='Presupuesto' order by nombre";   
                                        $result=  mysql_query($consulta);        echo"<option value='ADMIN'>ADMIN</option>";  
                                        while($fila=  mysql_fetch_array($result)){       
                                        $valor3=$fila['usuario'];  
                                        $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                        echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                        }                                                       
                                        ?>       
                            </select>
                       
         <select id="reg" name="numero" class="span4" required>
				<?php
					if (isset($_GET['cot'])) {
						echo "<option value='" . $reg . "'>" . $reg . "</option>";
					} else {
						echo "<option value=''>Asesores</option>";
					}
                                        $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                                        $result2=  mysql_query($consulta2);        echo"<option value='ADMIN'>ADMIN</option>";  
                                        while($fila=  mysql_fetch_array($result2)){       
                                        $valor3=$fila['usuario'];  
                                        $valor4=$fila['nombre'].' '.$fila['apellido'];   
   
                                        echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                        }                                                       
                                  ?>       
          </select>
           </th>
               <th>
                  
   
    <img src="../images/buscar.png" Style="cursor: pointer" id="buscador">
              </th>
              </tr>

</table>
<select id="estado" name="estado" class="span4" disabled>
<option value="Aprobado">Aprobado</option>
</select>
		<div id="cotizacione">

		</div>

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
                            </section></div>
<?php
if(isset($_GET['abrir'])){
    mysql_query("update cotizacion set estado='En proceso' where id_cot='".$_GET['abrir']."'", $conexion);
    echo '<script>alert("Se habilito la cotizacion");location.href="../vistas/?id=lista_cot";</script>';
}
if(isset($_GET['trasladar'])){
    $tras = mysql_query("select * from cotizacion");
    while($d = mysql_fetch_array($tras)){
        $result = mysql_query("select * from cont_terceros where id_ter=".$d['id_tercero']." ");
        $c= mysql_fetch_array($result);
        $clie = 658;
        $sqlx = "UPDATE `cotizacion` SET  nom_temp='".$c['nom_ter']."',cod_temp='".$c['cod_ter']."', id_tercero='658' WHERE `id_cot` = ".$d['id_cot']." and `nom_temp` = '';";           
        mysql_query($sqlx, $conexion);
        echo '<script>alert("Traslado con exito");location.href="../vistas/?id=lista_cot";</script>';
    }
}