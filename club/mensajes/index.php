<?php
if(isset($_GET['est'])){
    $sql = "UPDATE `mensajes` SET `visto` = '1' WHERE `id_receptor` = ".$_SESSION["id_user"]." and id_emisor=".$_GET["cod"]." ;";
    mysql_query($sql, $conexion);
    echo "<script language='javascript' type='text/javascript'>";     
echo "location.href='../club/?id=msg&cod=".$_GET['cod']."'";
echo "</script>";
}
?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.6.4.js"></script>
<style>
     .pre{
           border: 1px solid #ccc;
    width: 470px;
    height: 470px !important;
    padding: 10px;
  overflow-y:scroll;
     overflow-x:none;}
</style>
<div class="row-fluid">
<script src="mensajes/ajax.js"></script>
<script>

function mostrar()
{
	loadDoc(null,"mensajes/mensajes.php",function()
	  {
	  if (xmlhttp.readyState===4 && xmlhttp.status===200)
		{
		document.getElementById("historial").innerHTML=xmlhttp.responseText;
	
        
}
	  });$(".pre").animate({ scrollTop: "1000000px" });
}

setInterval(mostrar,3000);

function agregar()
{
	var u=document.getElementById('nombre').value;
	var c=document.getElementById('contenido').value;

	if(u!="" && c!=""){
		loadDoc("usuario="+u+"&cont="+c,"mensajes/proceso.php",function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{ 
                            document.getElementById('contenido').value="";
			document.getElementById("historial").innerHTML=xmlhttp.responseText;
                      
			}
		  });
		 
	}else{ alert("No deje campos vacios"); }
 $(".pre").animate({ scrollTop: "1000000px" });
}
function delx(id){
    
        $.ajax({
            post:'GET',
            data:'id='+id,
            url: '../club/mensajes/del_msg.php',
            success: function(d){
               $("#borrado").html('Se ha borrado el mensaje').show(200).delay(2000).hide(200);
            }
	   });
}
</script>
<script type="text/javascript">//<![CDATA[
$(window).load(function(){
$(".pre").animate({ scrollTop:"1000000px" });

});//]]> 
$(document).keyup(function(event){
    if(event.keyCode == 13){
        $("#enviar").click();
    }
});
</script>
</head>

    <div class="span6 widget stacked widget-message teal" >
                  
    <header>
                                <h4 class="title"><span class="icon icone-envelope-alt"></span> Estas Chateando con <?php 
                                $sql1 = "SELECT * FROM usuarios where id_user=".$_GET['cod']."  ";
                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                $name = $fila1["nombre"].' '. $fila1["apellido"];
                                echo $name; 
                                $_SESSION['rem']=$_GET['cod']; ?></h4>
                                <!-- START Toolbar -->
                               
                                <!--/ END Toolbar -->
    </header>
          <section class="body"> 
         
           <div class="form">            
 <div class="body-inner scrollable" id="demo2" style="height:500px;">       
     <div class="pre" >
                                    
                                        <ul id="historial">
<img src="mensajes/ajax-loader.gif" />

    </ul>   <div class="footer">

  </div>
                                  <!--/ END Message List -->
                                    </div>   
                   </div>
        <input type="hidden" id="nombre" value="<?php echo $_GET['cod'] ?>" placeholder="usuario" />
        <input type="text" class="span10"  id="contenido" placeholder="mensaje">
        <input type="button" class="btn btn-primary"value="enviar" onclick="agregar()" id="enviar"><span id="borrado" style="color:red"></span></div>    


    </section></div></div>


