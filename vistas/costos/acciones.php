<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idcotn'];
            $desc=$_GET['desccosc'];
            $pocen=$_GET['porccosc'];
            $operad=$_GET['operunc'];
            $variab=$_GET['varunc'];
            $operadr=$_GET['opdosc'];
            $variabl=$_GET['vardosc'];
            $total=$_GET['totalsumc'];
            $variabls=$_GET['costvaric'];
            $categocc=$_GET['categoc'];
            $costsumac=$_GET['costosumac'];
            $veditar=$_GET['editarv'];
        
            
            if($id==''){
                $ver=mysql_query("insert into costos (`descripcion`,`porcentaje`,`operadoruno`,`variableuno`,`operadordos`,`variabledos`,`suma_toral`,`variabletres`,`categoria_costos`,`suma_porcentaje`,`edita_valor`) values ('$desc','$pocen','$operad','$variab','$operadr','$variabl','$total','$variabls','$categocc','$costsumac','$veditar')") or die(mysql_error());
                
                $query = mysql_query("select max(id_cos) from costos");
                $m = mysql_fetch_array($query);
                $ultimo = $m['max(id_cos)'];
                echo $ultimo;
            }
            else{
                mysql_query("update costos set descripcion='$desc',porcentaje='$pocen',operadoruno='$operad',variableuno='$variab',operadordos='$operadr',variabledos='$variabl',suma_toral='$total',variabletres='$variabls',categoria_costos='$categocc',suma_porcentaje='$costsumac',edita_valor='$veditar'  where id_cos='$id'");
                echo $id;
            }
          if($total==0){
             $k = 'No';
             
         }else{
             $k= 'Si';
             
         }
          
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysql_query("SELECT * FROM costos where id_cos='$id'"); //consultA modificada por navabla
                 $fila = mysql_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_cos']; 
                 $p[1]=$fila['categoria_costos'];
                 $p[2]=$fila['descripcion'];
                 $p[3]=$fila['porcentaje'];
                 $p[4]=$fila['operadoruno'];
                 $p[5]=$fila['variableuno'];
                 $p[6]=$fila['operadordos'];
                 $p[7]=$fila['variabledos'];
                 $p[8]=$fila['suma_toral'];
                 $p[9]=$fila['variabletres'];
                 $p[10]=$fila['suma_porcentaje'];
        
            echo json_encode($p); 
            exit();
            
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysql_query("delete from costos where id_cos='$id' ");
            break;
        case 4:
                 $id=$_GET['por'];
                 $query = mysql_query("SELECT incremento FROM comisiones where comision='$id'"); //consultA modificada por navabla
                 $fila = mysql_fetch_array($query);

                 echo $fila['incremento']; 

            exit();
            
            break;
        case 5:
            $venta = $_GET['venta'];
            $presu = $_GET['presu'];
            $dif = $venta - $presu;
            
            $pt = (($presu / $venta) - 1) * 100;
             $p = array();
                 $p[0]= number_format($venta); 
                 $p[1]=number_format($presu);
                 $p[2]=number_format($dif);
                 $p[3]=number_format($pt);
                
        
            echo json_encode($p); 
            exit();
            break;
        
}

