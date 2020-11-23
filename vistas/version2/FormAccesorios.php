<?php
 require '../../modelo/conexion.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Accesorios</title>
            <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/style.css?v=1.6"> 
    <link rel="stylesheet" href="../../css/custom.css">

    <script src="../../assets/modernizr/js/modernizr-2.6.2.min.js"></script>

    <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script>
    
    function calcularacc(){
                var ancho = window.opener.$("#ancho").val();
                var alto = window.opener.$("#alto").val();
                var altura = window.opener.$("#altura").val();
                var anchura = window.opener.$("#anchura").val();
                var altura_v_c = window.opener.$("#altura_v_c").val();
                var anchura_v_c = window.opener.$("#anchura_v_c").val();

                
                var calcular = $("#perimetro").val();
                var can = $("#acc_can").val();
                var med = $("#acc_med").val();
                var rej = $("#acc_rej").val();
                var metro = $("#acc_metro").val();
                var lado = $("#acc_lado").val();
                var mul = $("#acc_mul").val();
                var amb = $("#acc_ambos").val();
                var par = $("#acc_para").val();
                var yes = $("#acc_yes").val();
                var fija = $("#fija").val();
                var cod = $("#cod").val();
                    $.ajax({
            type:'GET',
            data:'ancho='+ancho+'&alto='+alto+'&altura='+altura+'&anchura='+anchura+'&altura_v_c='+altura_v_c+'&anchura_v_c='+anchura_v_c+'\
            &calcular='+calcular+'&fija='+fija+'&can='+can+'&med='+med+'&rej='+rej+'&metro='+metro+'\
            &lado='+lado+'&mul='+mul+'&amb='+amb+'&par='+par+'&yes='+yes+'&cod='+cod+'&sw=0',
            url:'calculos_accesorios.php',
            success : function(d){
                console.log(d);
                $("#acc_res").val(d);
              
            }
        });
                
                
}
    </script>
    </head>
    <body>
         
      <form  action="<?php echo '../../modelo/reparto_acc.php?id_p='.$_GET['cod'].''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
       <div class="modal-body">
                    
                                            <table>
                                                <tr>
                                                    <td >Id</td>
                                                    <td>  <input  type="number" name="acc_id" id="acc_id"  class="span6"  value="" placeholder="" readonly></td>
                                                     <td>  <input  type="number" name="acc_id" id="cod"  class="span6" placeholder="" readonly value="<?php echo $_GET['cod'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Digite el Codigo</td>
                                                    <td colspan="1">
<!--                                                        <input type="text" id="acc_idref" onclick="BuscarAccesorios()"> -->
                                                        <select  name="ref_ac"  id="select2_4" required  onclick="BuscarAccesorios()" style="width:150px">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                      
                                                           $consulta= "SELECT * FROM `referencias`";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['descripcion'];
                                                            $valor3=$fila['codigo'].'-'.$fila['descripcion'].'-'.$fila['referencia'];
                                                           

                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select>
                                                    </td>
                                                    <td>
                                                        <select name="color_acc" class="span6" required id="acc_col"> 
                                                <?php
                                                                  
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysqli_query($conexion,$consulta6);
                                                            while($fila=  mysqli_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                
                                                 
                                                  
                                          </select>
                                                    </td>   
                                                        
                                                </tr>
                                                
                                                <tr>
                                                    <td>Calcular</td>
                                                    <td>
                                                        <select name="cal" class="span6" id="perimetro" required> 
                                                            <option value="">Ninguno</option> 
                                                              <option value="Und">Und</option>
                                                            <option value="ML">ML</option>
                                                            <option value="M2">M2</option>
                                                            <option value="Kg">Kg</option>
                                                        </select>
                                                    </td>
                                                      <td>Medida Fija <select name="fija" class="span6" id="fija" required> 
                                                            <option value="0">No</option> 
                                                             <option value="1">Si</option>
                                                           </select></td>
                                                      <td>
                                                          
                                                      </td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Digite la Cantidad</td>
                                                    <td id="cantidad"><input type="text" name="cant_acc" id="acc_can" value="" class="span6" placeholder=" " required></td>
                                                    <td> Medida=<input type="number" name="med" id="acc_med"  class="span6"  value="" placeholder="En Milimetros" required> Solo para perfiles</td>
                                                    
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Calculo por rejillas</td>
                                                    <td><select name="can_rej" class="span8" required id="acc_rej">
                                                           <?php
                                                                   echo ' <option value="0">1</option>';
                                                                    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['cod']);
                                                                     while($row=mysqli_fetch_array($request_v2))
                                                                     {
                                                                        echo ' <option value="'.$row['id_r_rej'].'">'.$row['descripcion'].'</option>';
                                                                     }
                                                            ?>
                                                           </select> 
                                                    </td>
                                                    <td><i>Para calcular los tornillos de las rejillas por favor seleccione la rejila, de lo contrario dejelo en 1.</i></td>
                                                </tr>
                                                 <tr>
                                                    <td>Por Cada </td>
                                                    <td><input type="text" name="metros" id="acc_metro" style="width:50px;" value="1000" class="span6" placeholder=" " required >(mm) <i>" se asignaran la cantidad  de accesorios digitadas"</i></td>
                                                      <td>, Lleva este parametro? 
                                                          <select name="yes" id="acc_yes">
                                                              <?php echo '<option value="'.$yes.'">'.$yes.'</option>'; ?>
                                                              <option value="Si">Si</option>
                                                               <option value="No">No</option>
                                                          </select></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                 <tr>
                                                    <td>En el Lado </td>
                                                    <td><select name="lado" style="width:80px;" id="acc_lado">
                                                             <option value="Vertical">Vertical</option>
                                                            <option value="Horizontal">Horizontal</option>
                                                            
                                                        </select> <i>" En este lado se aplicara la formula"</i></td>
                                                      <td>Multiplica por Horizontales | Verticales
                                                          <select name="mul" style="width:60px" id="acc_mul">
                                                             <option value="No">No</option>
                                                             <option value="Si">Si</option>
                                                               
                                                          </select> X 
                                                          <input type="number" name="ambos" value="1" class="span6" id="acc_ambos"  style="width:60px"></td>
                                                      <td></td>
                                                        
                                                </tr>
                                                <tr>
                                                    <td>Para :</td>
                                                    <td><select name="para" class="span8" required id="acc_para">  
                                                            <option value="">Seleccione uno</option>
                                                <option value="Fabricacion">Fabricacion</option> 
                                                <option value="Instalacion">Instalacion</option> 

                                          </select></td>
                                          <td><button type="button" onclick="calcularacc()">resultado</button> <input type="text" name="res" value="" class="span6" id="acc_res"  style="width:60px" disabled></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Observacion</b>
                                                    </td>
                                                    <td colspan="2"><textarea id="acc_obs" name="acc_obs" class="form-control" style="width:  290px;" placeholder=""></textarea></td>
                                                </tr>
                                            </table>
                                           
                                             
                                           
               </div>

      <!-- Modal footer -->
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>                

                        </form>
     
    </body>
</html>
