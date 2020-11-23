<?php
session_start();
require("conexion.php");
            $codigo = $_POST["codigo"];
            $nombre = strtoupper($_POST["nombre"]);
            $documento = $_POST["documento"];
            $verificacion = $_POST["verificacion"];
            $direccion = $_POST["direccion"];
            $fijo = $_POST["fijo"];
            $movil = $_POST["movil"];
            $departamento = $_POST["departamento"];
            $municipio = $_POST["municipio"];
            $pais = $_POST["pais"];
            $nacimiento = $_POST["nacimiento"];
            $correo = $_POST["correo"];
            $contacto = $_POST["contacto"];
            $id = $_POST["id"];
            $ciudad = $departamento.''.$municipio;
            if(isset($_POST['estado'])){ $estado = $_POST['estado'];}else{ $estado = 0;}
               if(isset($_POST['especial'])){ $especial = $_POST['especial'];}else{ $especial = 0;}
                  if(isset($_POST['fuente'])){ $fuente = $_POST['fuente'];}else{ $fuente = 0;}
                     if(isset($_POST['ica'])){ $ica = $_POST['ica'];}else{ $ica = 0;}
                        if(isset($_POST['iva'])){ $iva = $_POST['iva'];}else{ $iva = 0;}
                           if(isset($_POST['cree'])){ $cree = $_POST['cree'];}else{ $cree = 0;}

        if(isset($_POST['editar'])){
                $sql = "UPDATE `cont_terceros` SET `nom_ter`='".$nombre."',`digiver_ter`='".$verificacion."',`doc_ter`='".$documento."',`dir_ter`='".$direccion."',`telfijo_ter`='".$fijo."',`telmovil_ter`='".$movil."',`ciudad_ter`='".$ciudad."',`pais_ter`='".$pais."',`fecnac_ter`='".$nacimiento."',`correo_ter`='".$correo."',`cont_ter`='".$contacto."',`estado_ter`='".$estado."',`especial`='".$especial."',`fuente`='".$fuente."',`ica`='".$ica."',`iva`='".$iva."',`cree`='".$cree."' WHERE `id_ter`='".$id."';";
                 mysqli_query($conexion,$sql) or die (mysqli_error());
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion");location.href="../vistas/?id=terceros"</script>'; 

        }else{
            
            $query = "select cod_ter from cont_terceros where cod_ter = '$codigo'";
            $res = mysqli_query($conexion,$query);
            
            $datos = mysqli_fetch_array($res);
            $codigo_ter = $datos['cod_ter'];
            
            if ($codigo_ter == $codigo){
                echo '<script lanquage="javascript">alert("No Puede Duplicar El Codigo");location.href="../vistas/?id=terceros"</script>'; 

            }else{
                $sql = "INSERT INTO cont_terceros (especial,fuente,ica,iva,cree,cod_ter,nom_ter,doc_ter,digiver_ter,dir_ter,telfijo_ter,telmovil_ter,ciudad_ter,pais_ter,fecnac_ter,correo_ter,cont_ter)";
            $sql.= "VALUES ('".$especial."','".$fuente."','".$ica."','".$iva."','".$cree."','".$codigo."','".$nombre."','".$documento."','".$verificacion."','".$direccion."','".$fijo."','".$movil."','".$ciudad."','".$pais."','".$nacimiento."','".$correo."','".$contacto."') ";
            mysqli_query($conexion,$sql) or die (mysqli_error());

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=terceros"</script>'; 

            }

            
            }








