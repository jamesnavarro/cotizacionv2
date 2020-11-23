<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidt' id='valor32x' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
        . "<input type='text' placeholder='Lam 1/1 del  modulo 3' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
        . "<input placeholder='Lam 1/2 del  modulo 3' type='text' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34x'  required>"
        . "<input  placeholder='Lam 2/2 del  modulo 3' type='text' name='xxx2' id='valor33x'  required onclick='atenciont24()'> ";
}
if($_POST["num"]==3){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
        . "<input  placeholder='Lam 1/3 del  modulo 3' type='text' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34x'  required>"
        . "<input type='text' placeholder='Lam 2/3 del  modulo 3' name='xxx' id='valor33x'  required onclick='atenciont24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36x'  required>"
        . "<input type='text' placeholder='Lam 3/3 del  modulo 3' name='xxx' id='valor35x'  required onclick='atenciont36()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
         . "<input placeholder='Lam 1/4 del  modulo 3' type='text' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34x'  required>"
        . "<input placeholder='Lam 2/4 del  modulo 3' type='text' name='xxx' id='valor33x'  required onclick='atenciont24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36x'  required>"
        . "<input placeholder='Lam 3/4 del  modulo 3' type='text' name='xxx' id='valor35x'  required onclick='atenciont36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38x'  required>"
        . "<input placeholder='Lam 4/4 del  modulo 3' type='text' name='xxx' id='valor37x'  required onclick='atenciont48()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
                       . "<input placeholder='Lamina 1' type='text' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor33x'  required onclick='atenciont24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor35x'  required onclick='atenciont36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor37x'  required onclick='atenciont48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt5' id='valor310x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor39x'  required onclick='atenciont510()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32x'  required>"
         . "<input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor31x'  required onclick='atenciont12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34x'  required>"
        . "<input placeholder='Lam 2/6 del  modulo 3' type='text' name='xxx' id='valor33x'  required onclick='atenciont24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36x'  required>"
        . "<input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor35x'  required onclick='atenciont36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38x'  required>"
        . "<input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor37x'  required onclick='atenciont48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt5' id='valor310x'  required>"
        . "<input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor39x'  required onclick='atenciont510()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt6' id='valor312x'  required>"
        . "<input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor311x'  required onclick='atenciont612()'> ";
}
}
//}	
echo $rpta2;