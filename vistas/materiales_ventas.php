<!DOCTYPE html><!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--><!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>    <meta charset="utf-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    <link rel="shortcut icon" href="../traz.ico">    <title>Templado S.A</title>    <meta name="description" content="">    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">    <link rel="stylesheet" href="../css/style.css">     <link rel="stylesheet" href="../css/custom.css">    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script><!-- indispensable para cargar municipios-->    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>    <script src="../js/ajax.js" type="text/javascript"></script>    <script>        $(document).ready(function(){	 $('#tabla').dataTable();});                </script>        <script language="javascript" type="text/javascript">function pasar(des,id,ref,med,pre,max){     window.opener.datos_ventas(des,id,ref,med,pre,max);    window.close();}function act_ref(id){    var uti = $("#uti"+id).val();    var cos = $("#costo"+id).val();                $.ajax({                    type:'GET',                    data:'id='+id+'&uti='+uti+'&cos='+cos+'&sw=23',                    url:'ventas/acciones.php',                    success : function(t){                        if(t=='1'){                            alert("Se ha actualizado "+t);                        }else{                            alert("Ocurrio un problema, vuelva a intentarlo."+t);                        }                        var a = (100 - parseInt(uti)) / 100;                        var t = cos / a;                        $("#tot"+id).val(t);                    }                });}//des,id,ref,med</script>         </head><body>         <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Listado de Materiales</h4>                                <!-- START Toolbar -->                                <!--/ END Toolbar -->                            </header>                            <section id="collapse2" class="body collapse in">                                <div class="body-inner">                               <div class="tabbable" style="margin-bottom: 25px;">                                            <div class="tab-content">                                    <div class="tab-pane active" id="tab1">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                          <section class="body">                                <div class="body-inner no-padding"><form name="buscarA" action="../vistas/materiales.php?cot=<?php echo $_GET['cot'] ?>&add" method="post" enctype="multipart/form-data">                                    <?phpinclude '../modelo/conexion.php';session_start();$request=mysql_query("SELECT * FROM referencias group by descripcion");if($request){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';             $table = $table.'<thead >';              $table = $table.'<tr bgcolor="#D1EEF0">';              $table = $table.'<th width="5%">'.'Items'.'</th>';                  $table = $table.'<th width="5%">'.'Codigo'.'</th>';               $table = $table.'<th width="30%">'.'Descripcion'.'</th>';              $table = $table.'<th width="10%">'.'Referencia'.'</th>';              $table = $table.'<th width="10%">'.'Grupo'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Medida'.'</th>';              if($_SESSION['admin']=='Si'){               $table = $table.'<th class="hidden-phone">'.'Utilidad'.'</th>';                $table = $table.'<th class="hidden-phone">'.'Costo'.'</th>';               }              $table = $table.'<th class="hidden-phone">'.'Precio Ml'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;       $c=0;	while($row=mysql_fetch_array($request))	{                   $c = $c + 1;                $alum_por = "SELECT * FROM porcentajes where area_por='MP' and grupo='".$row["grupo"]."' ";                $fia =mysql_fetch_array(mysql_query($alum_por));                $p11= $fia["p1"]/100;                $p22= $fia["p2"]/100;                $p33= $fia["p3"]/100;                $putil= (100 - $row["utilidad"])/100;                              $p1 = $row["costo_fom"] / $p11 ;              $p2 = $row["costo_fom"] / $p22 ;              $p3 = $row["costo_fom"] / $p33 ;              $p4 = $row["costo_mt"] / $putil ;              $m = $row["medida"];              if($m == 0){                  $a = 1;              }else{                  $a= $m;              }              if($_SESSION['admin']=='Si'){                  $td = '<td><input type="number" id="uti'.$row["id_referencia"].'" value="'.$row["utilidad"].'" style="width:40px" onchange="act_ref('.$row["id_referencia"].')"> %</td>'                          . '<td><input type="number" id="costo'.$row["id_referencia"].'" value="'.number_format($row["costo_mt"],0,'','').'" style="width:60px" onchange="act_ref('.$row["id_referencia"].')"></td>';              }            //des,id,ref,med                $des = "'".$row['descripcion']."'";                $ref = "'".$row['referencia']."'";                $table = $table.'<tr><td width="5%">'.$row['id_referencia'].'</td>'                . '<td width="5%">'.$row['codigo'].'</font></td>'                . '<td width="30%"><a href="#pasar" onclick="pasar('.$des.', '.$row["id_referencia"].','.$ref.','.$a.','.$p4.', '.$row["max_desc"].')">'.$row['descripcion'].'</a></td>'                . '<td width="10%">'.$row["referencia"].'<font></a></td><td width="10%">'.$row["grupo"].'<font></a></td></td>                <td class="hidden-phone">'.$row["medida"].'</font></td>'                . ''.$td.'<td width="10%"><input type="text" id="tot'.$row["id_referencia"].'" value="'.number_format($p4,0,'','').'" style="width:60px" disabled></td>';   	} 	$table = $table.'</table>';	echo $table;}  ?>  </form>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane" id="tab2">                                        <div class="row-fluid">                                          <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div></body></html>        <?php require '../vistas/script.php';  ?><?php          include "../modelo/conexion.php";     if(isset($_GET['codigo'])){                          $request2=mysql_query('SELECT * FROM referencias WHERE id_referencia="'.$_GET['codigo'].'"');     while($row2=mysql_fetch_array($request2))	{                             $x = $row2["id_referencia"];              $y = $row2["descripcion"];              $z = $row2["referencia"];              $m = $row2["medida"];              if($m == 0){                  $a = 1;              }else{                  $a= $m;              }                         ?>    <input type="text" name="datos1" id="datos1" readonly value="<?php echo $y ?>" /><input type="text" name="datos2" id="datos2" readonly value="<?php echo $x ?>" /><input type="text" name="datos3" id="datos3" readonly value="<?php echo $z ?>" /><input type="text" name="datos4" id="datos4" readonly value="<?php echo $a ?>" /><a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>             <?php }} ?>                                                              