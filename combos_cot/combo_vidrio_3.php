<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidc' id='valor42x' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
        . "<input type='text' placeholder='Lam 1/1 del  modulo 4' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44x'  required>"
        . "<input  placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx2' id='valor43x'  required onclick='atencionc24()'> ";
}
if($_POST["num"]==3){
        $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
                . "<input  placeholder='Lam 1/3 del  modulo 4' type='text' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44x'  required>"
        . "<input type='text' placeholder='Lam 2/3 del  modulo 4' name='xxx' id='valor43x'  required onclick='atencionc24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46x'  required>"
        . "<input type='text' placeholder='Lam 3/3 del  modulo 4' name='xxx' id='valor45x'  required onclick='atencionc36()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
         . "<input placeholder='Lam 1/4 del  modulo 4' type='text' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44x'  required>"
        . "<input placeholder='Lam 2/4 del  modulo 4' type='text' name='xxx' id='valor43x'  required onclick='atencionc24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46x'  required>"
        . "<input placeholder='Lam 3/4 del  modulo 4' type='text' name='xxx' id='valor45x'  required onclick='atencionc36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48x'  required>"
        . "<input placeholder='Lam 4/4 del  modulo 4' type='text' name='xxx' id='valor47x'  required onclick='atencionc48()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
                       . "<input placeholder='Lamina 1' type='text' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor43x'  required onclick='atencionc24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor45x'  required onclick='atencionc36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor47x'  required onclick='atencionc48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc5' id='valor410x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor49x'  required onclick='atencionc510()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42x'  required>"
         . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor41x'  required onclick='atencionc12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor43x'  required onclick='atencionc24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor45x'  required onclick='atencionc36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor47x'  required onclick='atencionc48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc5' id='valor410x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor49x'  required onclick='atencionc510()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc6' id='valor412x'  required>"
        . "<input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor411x'  required onclick='atencionc612()'> ";
}
}
//}	
echo $rpta2;