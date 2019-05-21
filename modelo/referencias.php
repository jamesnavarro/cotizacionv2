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
            if(isset($_POST['dolar'])){
                $dolar = $_POST['dolar'];
            }else{
                $dolar = 1;
            }
            $id= $_POST["id"];
            
            
            if($linea=='Perfileria'){
                $sq = "SELECT precio_actual FROM `dolares` order by id_dolar desc limit 1 ";
                $dr =mysql_fetch_array(mysql_query($sq));
                $baseprecio = $dr[0];
                $valor2= $baseprecio;
            }else{
                $valor2= $_POST["valor"];
            }
        
        if($id!=''){

                $sql = "UPDATE `referencias` SET `max_desc`='".$max."',`utilidad`='".$uti."',`dado`='".$dado."',`act_dolar`='".$dolar."',`costo_fom`='".$valor2."', `aumento`='".$aumento."', `peso`='".$peso."',`grupo`='".$linea."', `referencia`='".$ref."',`descripcion`='".$descripcion."',`codigo`='".$codigo."',`costo_mt`='".$valor."',`medida`='".$medida."',`und_medida`='".$und_medida."',`cantidad_e`='".$can."' WHERE `id_referencia` = ".$id.";";
                 mysql_query($sql, $conexion);
                 
                 $sql = "UPDATE `dolar_relaciones` SET `precio_act_fom`='".$valor2."',`precio_actual`='".$valor."' WHERE `id_referencia` = ".$id."  order by id_dr desc limit 1;";
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del Material");location.href="../vistas/?id=add_per"</script>'; 

        }else{


           $sql = "INSERT INTO `referencias` (`max_desc`,`utilidad`,`dado`,`act_dolar`,`costo_fom`, `aumento`, `peso`, `grupo`, `referencia`, `descripcion`, `codigo`, `medida`, `costo_mt`, `und_medida`, `cantidad_e`)";
            $sql.= "VALUES ('".$max."','".$uti."','".$dado."','".$dolar."','".$valor2."', '".$aumento."', '".$peso."', '".$linea."', '".$ref."', '".$descripcion."', '".$codigo."',  '".$medida."',  '".$valor."',  '".$und_medida."',  '".$can."')";
            mysql_query($sql, $conexion);

            $maxi = mysql_fetch_array(mysql_query("select max(id_referencia) from referencias"));
            $max = $maxi['max(id_referencia)'];
            
            $consultar = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
            $pd = $consultar['precio_dolar'];
            $if = $consultar['id_dolar'];
            
            $sql3 = "INSERT INTO `dolar_relaciones` (`id_dolar`, `id_referencia`, `precio_actual`, `precio_act_fom`, `cod_ref`)";
            $sql3.= "VALUES ('".$if."','".$max."','".$valor."','".$valor2."','".$codigo."')";
            mysql_query($sql3, $conexion) or die(mysql_error()); 

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el Material");location.href="../vistas/?id=add_per"</script>'; 

        }

                   