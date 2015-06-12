<html>
<head>
<title>Untitled 1</title>


<script type="text/javascript" src="js/jscal2.js"></script>
<script type="text/javascript" src="js/lang/es.js"></script>
<link  href="styles.css" rel="stylesheet" type="text/css">
<link href="css/date_pic/jscal2.css" rel="stylesheet" type="text/css">
<link href="css/date_pic/border-radius.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript" type="text/javascript">

function cambiaPais(){
		if (document.getElementById("pais").value == 1){
			document.getElementById("estado").value = 0;
			document.getElementById("estado").disabled = false;
		}
		else
		{
			document.getElementById("estado").disabled = true;
		}
}

function setPaisName(){
	var selectmenu=document.getElementById("pais");
	var val = selectmenu.options[selectmenu.selectedIndex].innerHTML;
	document.getElementById("paisDesc").value = val;
}

function setEstadoName(){
	var selectmenu=document.getElementById("estado");
	var val = selectmenu.options[selectmenu.selectedIndex].innerHTML;
	document.getElementById("estadoDesc").value = val;
}

function soloNumero(e){
	tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==8) return true; //Tecla de retroceso (para poder borrar) 
	if (tecla==0) return true; //Tecla de tab (para poder cambiar de campo) 
	patron = /[0-9.]/; // Solo acepta nÃƒÂºmeros
	te = String.fromCharCode(tecla);
	return patron.test(te);
}


function fguardar(){
	if (Validaciones()){
		
		setPaisName();
		setEstadoName();
		
		document.getElementById("accionW").value = 'G';
		document.getElementById("form1").submit();
	}
}

function soloNumero(e){
	tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==8) return true; //Tecla de retroceso (para poder borrar) 
	if (tecla==0) return true; //Tecla de tab (para poder cambiar de campo) 
	patron = /[0-9.]/; // Solo acepta nÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Âºmeros
	te = String.fromCharCode(tecla);
	return patron.test(te);
}

function valEmail(correo){ 
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
	if(!re.exec(correo.toLowerCase())){
        return false;
    }else{
        return true;
    }
}

function Validaciones(){
	var errores;
	var mensaje;
	
	mensaje= 'Existe informacion incompleta:\n';

	if (document.getElementById("nombre").value == ''){
	  	document.getElementById("nombre").focus();
		mensaje = 'Por favor, introduzca su NOMBRE.\n';
		alert(mensaje)
		return false;
	}
	
	if (document.getElementById("email").value == ''){
		document.getElementById("email").focus();
		mensaje = 'Por favor, introduzca su CORREO ELECTRONICO.\n';
		alert(mensaje)
		return false;
	}else if(valEmail(document.getElementById("email").value)==false){
		document.getElementById("email").focus();
		mensaje = 'El correo ingresado no es valido.';
		alert(mensaje)
		return false;
	}
	
	if (document.getElementById("telefono").value == ''){
		document.getElementById("telefono").focus();
		mensaje = 'Por favor, introduzca su TELEFONO.\n';
		alert(mensaje)
		return false;
	}

	if (document.getElementById("pais").value == 0){
			document.getElementById("pais").focus();
		mensaje = 'por favor, seleccione su PAIS.\n';
		alert(mensaje)
		return false;
	}

	if (document.getElementById("estado").value == 0  &&  document.getElementById("pais").value == 1 ){
			document.getElementById("estado").focus();
		mensaje = 'por favor, seleccione su ESTADO.\n';
		alert(mensaje)
		return false;
	}
	
		if (document.getElementById("ciudad").value == ''){
		document.getElementById("ciudad").focus();
		mensaje = 'Por favor, introduzca su CIUDAD.\n';
		alert(mensaje)
		return false;
	}
	
	if (document.getElementById("date").value == ''){	
		document.getElementById("date").focus();
		alert('Por favor, introduzca la fecha\n');
		return false;
	}

	if (document.getElementById("time").value == '0'){	
		document.getElementById("time").focus();
		alert('Por favor, introduzca la hora\n');
		return false;
	}
	/*
	if (document.getElementById("day_time").value == '0'){	
		document.getElementById("day_time").focus();
		alert('Por favor, seleccione a.m. o p.m\n');
		return false;
	}
	*/
	return true;
}

var patron = new Array(2,2,4)
var patron2 = new Array(3,3,4)

function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}
</script>

<body>

<? 
include_once "data/Objects.php";
include_once "data/db_inc.php";

$rsPaises = $Model->get_paises();
$rsEstados = $Model->get_estados(1);


//echo $_SESSION["pagina"];


if ( $_POST["accionW"])
{

	//die("simon2");


	if (($_POST["vercode"] != $_SESSION["vercode"]) || $_SESSION["vercode"]=='')  
	{ 
		$_SESSION['temp'] = $_POST;
   		echo '<script language="javascript">alert("El c&oacute;digo din&aacute;mico no coincide");window.location.href="' . $_SESSION["pagina"] . '"; </script>'; 
	}
	else
	{ 

	$nombre = $_POST["nombre"] ;
	$email = $_POST["email"] ;
	$telefono = $_POST["telefono"] ;
	$pais = $_POST["pais"] ;
	$estado = 0 + $_POST["estado"] ;
	$ciudad = $_POST["ciudad"] ;
	
	$paisDesc = $_POST["paisDesc"] ;
	$estadoDesc = $_POST["estadoDesc"] ;
	
	
	$fechaAux = explode("/",$_POST["date"]);
	$fecha=$fechaAux[2]."-".$fechaAux[1]."-".$fechaAux[0];
		
	$hora = $_POST["time"]; //. " " . $_POST["day_time"] ;

	$insertRecord = $Model->insertWebinar($nombre, $email, $telefono, $pais, $estado, $ciudad, $fecha, $hora);
	
	if($insertRecord){
		
		$cuerpo =	"Nuevo Cita agendada para Webinar Vstore! <br><br>";
		
		$cuerpo .= " Nombre :  $nombre <br>";
		$cuerpo .= " Email : $email <br>";
		$cuerpo .= " Telefono : $telefono <br>" ;
		$cuerpo .= " Pais : $paisDesc <br>";
		if ( $estado != "0" )
			{ $cuerpo .= " Estado : $estadoDesc<br>"; };
		$cuerpo .= " Ciudad : $ciudad<br>";
		$cuerpo .= " Fecha : $fecha<br>";
		$cuerpo .= " Hora : $hora<br>";
	
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From: Soporte Vstore <soporte@vstore.com.mx>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// send mail to client
		mail($email, "Nueva Agenda Webinar Vstore", $textUser.$cuerpo, $headers);
		
		// send mail to HelpDesk
		//mail("helpdesk@adsum.com.mx", "Nueva Agenda Webinar", $cuerpo, $headers);			
		mail("javier.bermudez@adsum.com.mx", "Nueva Agenda Webinar Vstore", $cuerpo, $headers);			
		mail("soporte@vstore.com.mx", "Nueva Agenda Webinar Vstorer", $cuerpo, $headers);
		mail("renata.ibarra@adsum.com.mx", "Nueva Agenda Webinar Vstorer", $cuerpo, $headers);			

		echo '<script language="javascript">window.location.href="http://vstore.com.mx/gracias_webinar.php"; </script>';
		
	}
	}
}

?>



<table style="width: 100%">
	<tr>
		<td style="width: 304px">
		<table cellpadding="0" cellspacing="0" style="width: 100%; height: 100%">
									<tr>
										<td valign="top">
											<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10"></td>
						<td valign="top">
						<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td height="56">
								<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50">
										<img border="0" src="images/icono1.jpg" width="39" height="56"/></td>
										<td class="subregistro"><span>Conozca todo lo necesario para implementar exitosamente su tienda en l&iacute;nea. Le decimos como!
</span></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td valign="top">
								<form method="POST" action="<?php echo $_SESSION["pagina"];?>" name="FrontPage_Form1" id="form1" language="JavaScript" ><!--  -->
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td><input type="hidden" name="accionW" id="accionW" />
												<input type="hidden" name="paisDesc" id="paisDesc" />
												<input type="hidden" name="estadoDesc" id="estadoDesc" />&nbsp;</td>
										</tr>
										<tr>
											<td>
											<span class="reg1">Nombre</span><br/>
											<input type="text" name="nombre" id="nombre" size="43" class="texbox"/></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td><span class="reg1">Correo Electr&oacute;nico</span><br/><input type="text" name="email" id="email" size="18" class="texbox"/></td>
													<td width="134"><span class="reg1">No. Telefono</span><br/>
													<span class="reg1">
													<font size="1" color="#008000">
													Solo n&uacute;meros sin espacios</font></span><br>
													<input type="text" name="telefono" id="telefono" size="18" class="texbox" onKeypress="return soloNumero(event);" ></td>
													<!-- onKeyUp="mascara(this,'-',patron2,true)" -->
												</tr>
											</table>
											<br></td>
										</tr>
										<tr>
											<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td><span class="reg1">Pa&iacute;s
													</span><br><select name="pais" style="width:100" id="pais" onChange="javascript:cambiaPais();">
													 <option value="0">Seleccione</option>
														 <? 
														 if(mysql_num_rows($rsPaises) != 0){
															while($pais=mysql_fetch_array($rsPaises)){
														 ?>
														 <option value="<?=$pais['id']?>" ><?=$pais['descripcion']?></option>
														 <?
															 }
														 }	 
														 ?>
													
													</select></td>
													<td><span class="reg1">Estado
													</span><br><select name="estado" id="estado">
														<option value="0">Seleccione</option>
														 <? 
														 if(mysql_num_rows($rsEstados) != 0){
															while($estado=mysql_fetch_array($rsEstados)){
														 ?>
														 <option value="<?=$estado['id']?>" ><?=$estado['descripcion']?></option>
														 <?
															 }
														 }	 
														 ?>
													
													</select></td>
													
													
<script>
	document.getElementById("pais").value = 1;
</script>
												</tr>
											</table></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td width="156"><span class="reg1">
													Ciudad </span><br><input type="text" name="ciudad" id="ciudad" size="18" class="texbox"></td>
													<td><span class="reg1">Fecha</span><br>
											<input type="text" name="date" id="date" size="11" maxlength="10"  readonly="readonly">&nbsp;
													<img border="0" src="images/icono_calendario.png" width="28" height="24" name="date_picker" id="date_picker" style="vertical-align:bottom">
											<script type="text/javascript">	
												var cal = Calendar.setup({
												onSelect: function(cal) { cal.hide() }
												});
												cal.manageFields("date_picker", "date", "%d/%m/%Y");
											</script></td>
												</tr>
											</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td>
											</td>
													<td><span class="reg1">Hora</span><br>
                                          <select size="1" name="time" id="time">
                                          	<option value="09:00">09:00</option>
											<option value="10:00">10:00</option>
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											<option value="13:00">13:00</option>
											<option value="14:00">14:00</option>
											<option value="15:00">15:00</option>
											<option value="16:00">16:00</option>
											<option value="17:00">17:00</option>
											<option value="18:00">18:00</option>
											<option value="19:00">19:00</option>
											<!--
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											-->
                                          </select></td>
										<td width="91" valign="bottom">
										<!--
										<select size="1" name="day_time" id="day_time">
                                            <option value="P.M.">P.M.</option>
                                            <option value="A.M.">A.M.</option>
                                          </select>
										  -->
										  </td>
										<td width="74">                                            
										<span class="reg1"> C&oacute;digo</span><br>
                                           <!--webbot b-value-required="TRUE" bot="Validation" i-maximum-length="5" i-minimum-length="5" --><input type="text" name="vercode" id="vercode" size="5" maxlength="5" class="texbox"></td>
</td>
										<td width="69" valign="bottom"><IMG SRC="image.php" width="71" height="28"></td>
												</tr>
											</table>
											
											</td>
										</tr>
										<tr>
											<td>
											<span class="subregistro">Horarios de atenci&oacute;n: 9:00 a 19:00 hrs. <br>[Am&eacute;rica/Mazatl&aacute;n (GMT-7)]</span>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td>&nbsp;</td>
													<td width="119"><div class="agendar"><a href="javascript:fguardar();" >  
</td>
												</tr>
											</table>
											</td>
										</tr>
									</table>
									<p>
									<!--
									<input type="submit" value="Submit" name="B1">
									<input type="reset" value="Reset" name="B2">
									--></p>
								</form>
								</td>
							</tr>
						</table>
						</td>
						<td width="10"></td>
					</tr>
				</table>

										</td>
									</tr>
								</table>

		</td>
		<td>&nbsp;</td>
	</tr>
</table>
<?php



?>
</body>

</html>
