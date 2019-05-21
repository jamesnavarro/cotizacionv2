
<div class="modal fade" id="ModalRejillas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario de Rejillas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table>
                <tr>
                    <td>Id Producto</td>
                    <td><input type="text" id="cod" disabled value="<?php echo $_GET['cod']; ?>" style="width: 100%;"></td>
                <tr>
                <tr>
                    <td>Id</td>
                    <td><input type="text" id="idrefe" disabled value="" style="width: 100%;"></td>
                <tr>
                    
                    <td><button onclick="BuscarReferencia()">Codigo</button> </td>
                    <td><input type="text" id="refrej" disabled style="width: 180px;">
                        </td>
                   <tr>
                    <td>Descripcion</td>
                    <td><input type="text" id="b" disabled style="width: 100%;"></td>
                    <tr>
                    <td>Referencia</td>
                    <td><input type="text" id="c" disabled style="width: 100%;"></td>
                </tr>
                <tr>
                    <td>Calcular Cant. de Rejillas</td>
                    <td> 
                        
                        <select name="perfil_med" id="perfil_med"  style="width: 80px;" required onchange="sacar_medida_perfil()">
                                               <?php
                                             
                                               echo ' <option value="">Seleccione</option>';
                                                   require '../../../modelo/conexion.php';
                                       $consulta= ("SELECT * FROM producto a, producto_rep_alu b, referencias c where c.grupo='Perfileria' and b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);                     
                                        $result=  mysql_query($consulta);
                                        $ta = 0;
                                        while($row=  mysql_fetch_array($result)){
                                        $valor1_an = $row['id_r_a'];
                                        $valor2=$row['descripcion'];
                                        $valor3=$row['lado'];
                                        $descuento=$row['descuento'];
                                        $medida_1=$row['medida_r_a'];
                                        $nw_medida = $row['medida_r_a'];
                                        $nw_lado = $row['lado'];
                                        $nw_var1 = $row['descuento'];
                                        $nw_ope = $row['signo'];
                                        $nw_var2 = $row['variable'];
                                        $nw_cant = $row['cantidad'];
                                        $nw_div = $row['division'];
                                        $altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
                                        $altura = $_GET['altura'];// altura cuerpo fijo
                                        $anchura = $_GET['anchura']; //ancho cuerpo fijo
                                        $anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
                                        $ancho = $_GET['ancho'];
                                        $alto = $_GET['alto'];

                                        include 'formula_perfil.php';
                                        $alv = $med_perfil;

                                                            echo"<option value='".$valor1_an."'>(".$alv.") ".$valor2." </option>";
                                                            
                                                            }
                                                            ?>
                             <option disabled>----------------------</option>
                             <option value="90002"><?php if(isset($_GET['cod'])){echo $altura;} ?> (Altura Cuerpo fijo)</option>
                             <option value="90001"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> (Altura Ventana Corrediza)</option>
                             <option value="90003"><?php if(isset($_GET['cod'])){echo $anchura;} ?> (Ancho Cuerpo fijo)</option>
                             <option value="90004"><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?> (Ancho Ventana Corrediza)</option>
                </select> 
                        <input type="text" id="medp" value="" style="width: 30px;" disabled>
                        / <input type="text" name="var3" id="var3" value="1" style="width: 30px;">
                                        * <input type="text" name="multiplo"  id="multiplo" value="1" style="width: 30px;">
                   
                <button onclick="cal_can_rej()">=</button>
                <input type="text"  id="res_can_rej" value="" disabled style="width: 30px;">
                 </td>
                                    </tr>
                                    <tr>
                                        <td>Medida del perfil (mm)</td>
                                        <td>
                                            <select name="med_rej" id="med_rej" style="width: 80px;" onchange="sacar_medida_perfil2()">
                                                <option value="">Seleccione</option>            
                                                <option value="999994"><?php if(isset($_GET['cod'])){echo $ancho;} ?> Ancho de producto</option> 
                                                            <option value="999999"><?php if(isset($_GET['cod'])){echo $alto;} ?> Alto de producto</option> 
                                                            <option value="999998"><?php if(isset($_GET['cod'])){echo $altura;} ?> Alto Cuerpo Fijo de producto</option> 
                                                            <option value="999997"><?php if(isset($_GET['cod'])){echo $altura_v_c;} ?> Alto Ventana Corrediza</option> 
                                                            <?php
                                                            $request_vw=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                            if($request_vw){

                                                            $total2=0;
                                                            while($row=mysql_fetch_array($request_vw))
                                                            {      
                                                                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["ancho_v"]."");
                                                                $fil_an =mysql_fetch_array(mysql_query($sqlx));
                                                                $id_p= $fil_an["id_p"];

                                                                 $nw_medida = $fil_an['medida_r_a'];
                                                                $nw_lado = $fil_an['lado'];
                                                                $nw_var1 = $fil_an['descuento'];
                                                                $nw_ope = $fil_an['signo'];
                                                                $nw_var2 = $fil_an['variable'];
                                                                $nw_cant = $fil_an['cantidad'];
                                                                $nw_div = $fil_an['division'];
                                                                $altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
                                                                $altura = $_GET['altura'];// altura cuerpo fijo
                                                                $anchura = $_GET['anchura']; //ancho cuerpo fijo
                                                                $anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
                                                                $ancho = $_GET['ancho'];
                                                                $alto = $_GET['alto'];

                                                                include 'formula_perfil.php';
                                                                $al = $med_perfil;

                                                                $tv = $al + $row['var1'];

                                                                 $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']." and b.id_r_a=".$row["alto_v"]."");
                                                                $fil_al =mysql_fetch_array(mysql_query($sqlw));

                                                                 $nw_medida = $fil_al['medida_r_a'];
                                                                $nw_lado = $fil_al['lado'];
                                                                $nw_var1 = $fil_al['descuento'];
                                                                $nw_ope = $fil_al['signo'];
                                                                $nw_var2 = $fil_al['variable'];
                                                                $nw_cant = $fil_al['cantidad'];
                                                                $nw_div = $fil_al['division'];
                                                                $altura_v_c = $_GET['altura_v_c']; // altura ventana corrediza
                                                                $altura = $_GET['altura'];// altura cuerpo fijo
                                                                $anchura = $_GET['anchura']; //ancho cuerpo fijo
                                                                $anchura_v_c = $_GET['anchura_v_c']; // ancho ventana corrediza;
                                                                $ancho = $_GET['ancho'];
                                                                $alto = $_GET['alto'];

                                                                include 'formula_perfil.php';
                                                                $al2 = $med_perfil;
                                                                $tv2 = $al2 + $row['var2'];
                                                                echo"<option value='".$row['id_r_v']."'>(".$tv." mm) ".$row['descripcion']."-".$row['id_r_v']."</option>";      
                                                            } 	
                                                    }
?>
                                                            <option value='999995'><?php if(isset($_GET['cod'])){echo $anchura;} ?>Ancho C.F </option>
                                                            <option value='999996'><?php if(isset($_GET['cod'])){echo $anchura_v_c;} ?>Ancho Ventana Corrediza</option>
                                            </select>
                                            <input type="text" id="medm" value="" style="width: 30px;">-/+ 
                                            
                                            <input type="text" name="varr" id="varr" value="" style="width: 30px;"> /
                                            <input type="text" name="en" id="en" value="1" style="width: 30px;">
                                            <button onclick="cal_med_rej()">=</button>
                                            <input type="text"  id="res_med_rej" value="" disabled style="width: 40px;">
                                        </td>
                 </tr>
              </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="LimpiarRejilla()">Close</button>
        <button type="button" class="btn btn-danger" onclick="LimpiarRejilla()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="SaveRejillas()">Save changes</button>
      </div>
    </div>
  </div>
</div>   