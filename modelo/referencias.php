<?php
session_start();
require("conexion.php");
            $ref= $_POST["ref"];
            $descripcion= $_POST["desc"];
            $codigo= $_POST["codigo"];
            $valor= $_POST["valor"]; 
            $medida= $_POST["medida"];
            $can= $_POST["can"];
            $und_medida= $_POST["und"];
            $linea = $_POST["grupo"];
            $peso = $_POST["peso"]; 
            $aumento = $_POST["aumento"];
            $dado = $_POST["dado"];
            $max = $_POST["max"];
            $uti = $_POST["uti"];
            $ren = $_POST["rend"];
            $undren = $_POST["undren"];
            if(isset($_POST['dolar'])){
                $dolar = $_POST['dolar'];
            }else{
                $dolar = 1;
            }
            $id= $_POST["id"];
            $moneda = $_POST["moneda"];
            $valor3 = $_POST["valor3"];
            
            if($linea=='Perfileria'){
                $sq = "SELECT precio_actual FROM `dolares` order by id_dolar desc limit 1 ";
                $dr =mysqli_fetch_array(mysqli_query($conexion,$sq));
                $baseprecio = $dr[0];
                $valor2= $baseprecio;
            }else{
                $valor2= $_POST["valor"];
            }
        
        if($id!=''){

                $sql = "UPDATE `referencias` SET `moneda`='".$moneda."',"
                        . "`costo_usd`='".$valor3."',"
                        . "`max_desc`='".$max."',"
                        . "`utilidad`='".$uti."',"
                        . "`dado`='".$dado."',"
                        . "`act_dolar`='".$dolar."',"
                        . "`costo_fom`='".$_POST["valor2"]."',"
                        . " `aumento`='".$aumento."',"
                        . " `peso`='".$peso."',"
                        . "`grupo`='".$linea."',"
                        . " `referencia`='".$ref."',"
                        . "`descripcion`='".$descripcion."',"
                        . "`codigo`='".$codigo."',"
                        . "`costo_mt`='".$valor."',"
                        . "`medida`='".$medida."',"
                        . "`und_medida`='".$und_medida."',"
                        . "`cantidad_e`='".$can."',"
                        . "`rendimiento`='".$ren."',"
                        . "`undren`='".$undren."',"
                        . "`modificado`='".$_SESSION['k_username']."' WHERE `id_referencia` = ".$id.";";
                 mysqli_query($conexion,$sql);
                 
                 $ma = mysqli_fetch_array(mysqli_query($conexion,"select count(id_referencia) from dolar_relaciones where id_referencia='$id' "));
                 $existe = $ma[0];
                 if($existe==0){
                    $consultar = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
                    $pd = $consultar['precio_dolar'];
                    $if = $consultar['id_dolar'];

                    $sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
                    $sql3.= "VALUES ('".$if."','".$id."','".$valor."','".$valor2."','".$codigo."')";
                    mysqli_query($conexion,$sql3) ; 
                 }else{
                     $sql = "UPDATE `dolar_relaciones` SET `precio_act_fom`='".$valor2."',`precio_actual`='".$valor."' WHERE `id_referencia` = ".$id."  order by id_dr desc limit 1;";
                      mysqli_query($conexion,$sql);
                 }
                 
                 
                 
                 

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del Material");location.href="../vistas/?id=add_per"</script>'; 

        }else{


           $sql = "INSERT INTO `referencias` (`undren`,`rendimiento`,`moneda`,`costo_usd`,`max_desc`,`utilidad`,`dado`,`act_dolar`,`costo_fom`, `aumento`, `peso`, `grupo`, `referencia`, `descripcion`, `codigo`, `medida`, `costo_mt`, `und_medida`, `cantidad_e`, `modificado`)";
            $sql.= "VALUES ('".$undren."','".$ren."','".$moneda."','".$valor3."','".$max."','".$uti."','".$dado."','".$dolar."','".$_POST["valor2"]."', '".$aumento."', '".$peso."', '".$linea."', '".$ref."', '".$descripcion."', '".$codigo."',  '".$medida."',  '".$valor."',  '".$und_medida."',  '".$can."',  '".$_SESSION['k_username']."')";
            mysqli_query($conexion,$sql);

            $maxi = mysqli_fetch_array(mysqli_query($conexion,"select max(id_referencia) from referencias"));
            $max = $maxi['max(id_referencia)'];
            
            $consultar = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
            $pd = $consultar['precio_dolar'];
            $if = $consultar['id_dolar'];
            
            $sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
            $sql3.= "VALUES ('".$if."','".$max."','".$valor."','".$valor2."','".$codigo."')";
            mysqli_query($conexion,$sql3) ; 

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el Material");location.href="../vistas/?id=add_per"</script>'; 

        }

                   