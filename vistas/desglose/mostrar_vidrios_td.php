<?php
if($s[0]==0){
                     $check = '<input type="checkbox" id="'.$ci.'" name="item2" checked>';   
                   }else{
                     $check  = '<img src="../images/autorizacion.png">'; 
                   }
echo '<tr title="'.$tt.'">'
                          . '<td>'.$ci.$check.'</td>'
                          . '<td id="msg2'.$ci.'"><input type="text" id="item'.$ci.'" value="'.$rowp["id_cotizacion"].'" style="width:100%"></td>'
                          . '<td><input type="text" id="idvidrio'.$ci.'" onchange="buscarvid('.$ci.')" value="'.$idvidrio.'" style="width:100%"></td>'
                          . '<td><input type="text" id="it'.$ci.'" onchange="updatetipovid('.$ci.','.$rowp["id_cotizacion"].')" value="'.$tip.'" style="width:100%"></td>'
                          . '<td><input type="text" id="color'.$ci.'" disabled value="'.$color_vi.'" style="width:400px"></td>'
                          . '<td><input type="text" id="medi'.$ci.'" disabled value="'.$an2.'x'.$all.'" style="width:100%"> </td>'
                          
                          . '<td><input type="text" id="espesor'.$ci.'" disabled value="'.$espesor.'" style="width:100%"></td>'
                          . '<td><input type="text" id="catm'.$ci.'" value="'.$cant_item.'" style="width:100%"> </td>'
                          . '<td><input type="text" id="peso'.$ci.'" value="'.$gtpeso_vidrio.'" style="width:100%"></td>'
                          . '<td><input type="text" id="area'.$ci.'" value="'.$metro_total.'" style="width:100%"></td>';
