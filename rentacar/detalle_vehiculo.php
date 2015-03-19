<?php  
/*
#######################################
LIBRERIAS NECESARIOS
#######################################
*/

require("db.inc.php"); // CONEXION CON BASE DE DATOS
require("funciones.inc.php"); // FUNCIONES DEL SISTEMA

?>
<html>
<head>
<style type="text/css">
  body,td {
font-family: Verdana, "Times New Roman",
          Times, serif;
	font-size: 12px;
	line-height: 25px;
	 }
  </style>
</head>
<body>


<?php  
	$patente = trim($_GET['patente']);
	$r = mysql_query("select * from vehiculos where patente='$patente'");
	$datos = mysql_fetch_array($r);

	echo '
	<h2>DETALLE: '.$datos[patente].'</h2>
	
	<div style="float:left;width:200px;">';
	 if(!$datos[imagen])
		echo '<img src="img/vehiculos/sin_imagen.png" width="190" height="120"> ';
	else
		echo '<img src="img/vehiculos/'.$datos[imagen].'" width="190" height="120">';

	echo '
	</div>

	<div style="float:right;width:350px;">
		<table>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Marca</b></td><td>: '.$datos[marca].' </td></tr>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Modelo</b></td><td>: '.$datos[modelo].' </td></tr>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Motor</b></td><td>: '.$datos[cilindrada].' </td></tr>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Color</b></td><td>: '.$datos[color].' </td></tr>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Combustible</b></td><td>: '.$datos[combustible].' </td></tr>
			<tr><td valign="top"><img src="img/dot.gif"> <b>Pasajeros</b></td><td>: '.$datos[num_pasajeros].' </td></tr>
		</table>
		
		<img src="img/dot.gif"> <b>Otras Caracteristicas:</b><br> '.$datos[otras].' <br><br>

		<h3>Valor Arriendo </b>:  $'.$datos[valor_arriendo].'</h3>
		</div>
'; ?>

</body>
<html>
