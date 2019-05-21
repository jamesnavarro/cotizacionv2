<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidd' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input type='text' placeholder='Lam 1/1 del  modulo 2' name='xxx' id='valor21'  required onclick='atenciond()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input placeholder='Lam 1/2 del  modulo 2' type='text' name='xxx' id='valor21'  required onclick='atenciond()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24'  required><input  placeholder='Lam 2/2 del  modulo 2' type='text' name='xxx2' id='valor23'  required onclick='atenciond2()'> ";
}
if($_POST["num"]==3){
        $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input  placeholder='Lam 1/3 del  modulo 2' type='text' name='xxx' id='valor21'  required onclick='atenciond()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24'  required><input type='text' placeholder='Lam 2/3 del  modulo 2' name='xxx' id='valor23'  required onclick='atenciond2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26'  required><input type='text' placeholder='Lam 3/3 del  modulo 2' name='xxx' id='valor25'  required onclick='atenciond3()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input placeholder='Lam 1/4 del  modulo 2' type='text' name='xxx' id='valor21'  required onclick='atenciond()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24'  required><input placeholder='Lam 2/4 del  modulo 2' type='text' name='xxx' id='valor23'  required onclick='atenciond2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26'  required><input placeholder='Lam 3/4 del  modulo 2' type='text' name='xxx' id='valor25'  required onclick='atenciond3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28'  required><input placeholder='Lam 4/4 del  modulo 2' type='text' name='xxx' id='valor27'  required onclick='atenciond4()'> ";
}
if($_POST["num"]==5){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input placeholder='Lam 1/5 del  modulo 2' type='text' name='xxx' id='valor21'  required onclick='atenciond()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor23'  required onclick='atenciond2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor25'  required onclick='atenciond3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor27'  required onclick='atenciond4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd5' id='valor210'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor29'  required onclick='atenciond5()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor21'  required onclick='atenciond()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor23'  required onclick='atenciond2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor25'  required onclick='atenciond3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor27'  required onclick='atenciond4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd5' id='valor210'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor29'  required onclick='atenciond5()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd6' id='valor212'  required><input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor211'  required onclick='atenciond6()'> ";
}
}
//}	
echo $rpta2;