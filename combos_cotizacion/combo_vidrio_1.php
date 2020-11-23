<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidd' id='valor22x' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
 . "<input type='text' placeholder='Lam 1/1 del  modulo 2' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
        . "<input placeholder='Lam 1/2 del  modulo 2' type='text' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24x'  required>"
        . "<input  placeholder='Lam 2/2 del  modulo 2' type='text' name='xxx2' id='valor23x'  required onclick='atenciond24()'> ";
}
if($_POST["num"]==3){
        $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
                . "<input  placeholder='Lam 1/3 del  modulo 2' type='text' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24x'  required>"
        . "<input type='text' placeholder='Lam 2/3 del  modulo 2' name='xxx' id='valor23x'  required onclick='atenciond24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26x'  required>"
        . "<input type='text' placeholder='Lam 3/3 del  modulo 2' name='xxx' id='valor25x'  required onclick='atenciond36()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
         . "<input placeholder='Lam 1/4 del  modulo 2' type='text' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24x'  required>"
        . "<input placeholder='Lam 2/4 del  modulo 2' type='text' name='xxx' id='valor23x'  required onclick='atenciond24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26x'  required>"
        . "<input placeholder='Lam 3/4 del  modulo 2' type='text' name='xxx' id='valor25x'  required onclick='atenciond36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28x'  required>"
        . "<input placeholder='Lam 4/4 del  modulo 2' type='text' name='xxx' id='valor27x'  required onclick='atenciond48()'> ";
}
if($_POST["num"]==5){
$rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
        . "<input placeholder='Lam 1/5 del  modulo 2' type='text' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor23x'  required onclick='atenciond24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor25x'  required onclick='atenciond36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor27x'  required onclick='atenciond48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd5' id='valor210x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor29x'  required onclick='atenciond510()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidd' id='valor22x'  required>"
         . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor21x'  required onclick='atenciond12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd2' id='valor24x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor23x'  required onclick='atenciond24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd3' id='valor26x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor25x'  required onclick='atenciond36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd4' id='valor28x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor27x'  required onclick='atenciond48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd5' id='valor210x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor29x'  required onclick='atenciond510()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidd6' id='valor212x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 2' type='text' name='xxx' id='valor211x'  required onclick='atenciond612()'> ";
}
}
//}	
echo $rpta2;