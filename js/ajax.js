//Desarrollado por Jesus Li��n
//webmaster@ribosomatic.com
//ribosomatic.com
//Puedes hacer lo que quieras con el c�digo
//pero visita la web cuando te acuerdes

function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function enviarDatosEmpleado(){
	//donde se mostrar� lo resultados
	divResultado = document.getElementById('resultado');
	divFormulario = document.getElementById('formulario');
	//valores de los inputs
	id=document.frmempleado.idempleado.value;
	nom=document.frmempleado.nombres.value;
	suel=document.frmempleado.sueldo.value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usando del medoto POST
	//archivo que realizar� la operacion
	//actualizacion.php
	ajax.open("POST", "../vistas/form/actualizacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==3) {
			//mostrar los nuevos registros en esta capa
			divResultado.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			divFormulario.innerHTML = "<p style=\"border:1px solid red; width:400px;\">La actualizaci&oacute;n se realiz&oacute; correctamente</p>";
		}
	}
	//muy importante este encabezado ya que hacemos uso de un formulario
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_referencia="+id+"&descripcion="+nom+"&costo_mt="+suel)
}

function pedirDatos(idempleado){
	//donde se mostrar� el formulario con los datos
	divFormulario = document.getElementById('formulario');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST", "../vistas/form/consulta_por_id.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idemp="+idempleado)
}