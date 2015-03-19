<?php 

/*
////////////////////////////////////////////////////////////////////////////////////////////
// #######################################
// LIBRERIAS PRINCIPALES
// #######################################
////////////////////////////////////////////////////////////////////////////////////////////
*/

require("db.inc.php");

require("funciones.inc.php");

require("auth.inc.php");

$fecha = date("d/m/y");


/*
@ Informe: CLIENTES
@
*/


if(isset($_POST['inf_clientes'])){

	$campo = $_POST['campo_busqueda'];
	$campo_order = $_POST['campo_order'];
	$texto_busqueda = $_POST['texto_busqueda'];
	$orden = $_POST['tipo_orden'];
	$estado = $_POST['estado'];

	if(!$campo)
		$campo = "rut_c";

	if(!$campo_order)
		$campo_order = "ape_c";

	if(!$orden)
		$orden = "desc";

	if ($texto_busqueda)
	        $r = mysql_query("select * from clientes where $campo LIKE '%$texto_busqueda%' order by $campo_order $orden");
	else if ($estado)
	        $r = mysql_query("select * from clientes cl, contratos_arriendos ca where cl.rut_c = ca.clientes_rut_c and ca.estado='$estado' order by $campo_order $orden");
	else if ($estado && $texto_busqueda)
	        $r = mysql_query("select * from clientes cl, contratos_arriendos ca where cl.rut_c = ca.clientes_rut_c and ca.estado='$estado' and $campo LIKE '%$texto_busqueda%'  order by $campo_order $orden");

	else
        $r = mysql_query("select * from clientes order by $campo_order $orden");
    	$n = 0; // CONTADOR DE REGISTROS
	$html = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Informe</title>
	<link rel="stylesheet" type="text/css" href="css/informes.css" />

	</head>
	<body>
		<div id="wrapper">
	           <div id="header">
			<H1>INFORME CLIENTES</H1>
			Elaborado el '.$fecha.' <br> Solicitado por '.$_SESSION['usuario_nombre'].' '.$_SESSION['usuario_apellido'].'
		   </div>
           <div id="content">
		<table class="gridtable" align="center">
			<thead>
				<tr>
				<th scope="col" align="left">N</th>
				<th scope="col" align="left">RUT</th>
	        		<th scope="col" align="left">Nombre</th>
				<th scope="col" align="left">Apellido</th>
				<th scope="col" align="left">Dirección</th>
				<th scope="col" align="left">Email</th>
				<th scope="col" align="left">Fono</th>
				<th scope="col" align="left">Edad</th>
				</tr>
			</thead>
		';
    while ($datos = mysql_fetch_array($r)){
	$n++;
        $html.= '<tbody>
			<tr>
				<td>' . $n . '</td>				
				<td>' . $datos[rut_c] . '</td>
				<td>' . $datos[nom_c] . '</td>
				<td>' . $datos[ape_c] . '</td>
				<td>' . $datos[dir_c] . '</td>
				<td>' . $datos[email_c] . '</td>
				<td>' . $datos[fono_c] . '</td>
				<td>' . $datos[edad_c] . '</td>
			</tr>
		</tbody>
		';
    }
    
    $html.= '</table>';
  
    if (!mysql_num_rows($r))
        $html.= "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";

	
   $html.='</div>
	 <div id="footer">Rent a Car esCARes </div>
	   </div>  
	</body>
	</html>
	';

	echo $html;

	}

/*
@ Informe: VEHICULOS
@
*/
if(isset($_POST['inf_vehiculos'])){

	$campo = $_POST['campo_busqueda'];
	$campo_order = $_POST['campo_order'];
	$texto_busqueda = $_POST['texto_busqueda'];
	$orden = $_POST['tipo_orden'];
	$estado = $_POST['estado'];

	if(!$campo)
		$campo = "patente";

	if(!$campo_order)
		$campo_order = "marca";

	if(!$orden)
		$orden = "desc";

	if ($texto_busqueda)
	        $r = mysql_query("select * from vehiculos where $campo LIKE '%$texto_busqueda%' order by $campo_order $orden");
	else if ($estado)
	        $r = mysql_query("select * from vehiculos where estado='$estado' order by $campo_order $orden");
	else if ($estado && $texto_busqueda)
	        $r = mysql_query("select * from vehiculos where estado='$estado' and $campo LIKE '%$texto_busqueda%' order by $campo_order $orden");

	else
        $r = mysql_query("select * from vehiculos order by $campo_order $orden");
    	$n = 0; // CONTADOR DE REGISTROS
	$html = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Informe</title>
	<link rel="stylesheet" type="text/css" href="css/informes.css" />

	</head>
	<body>
		<div id="wrapper">
	           <div id="header">
			<H1>INFORME VEHICULOS</H1>
			Elaborado el '.$fecha.' <br> Solicitado por '.$_SESSION['usuario_nombre'].' '.$_SESSION['usuario_apellido'].'
		   </div>
           <div id="content">
		<table class="gridtable" align="center">
			<thead>
				<tr>
				<th scope="col" align="left">N</th>
				<th scope="col" align="left">PATENTE</th>
	        		<th scope="col" align="left">Marca</th>
				<th scope="col" align="left">Modelo</th>
				<th scope="col" align="left">Cilindrada</th>
				<th scope="col" align="left">Pasajeros</th>
				<th scope="col" align="left">Color</th>
				<th scope="col" align="left">Valor</th>
				</tr>
			</thead>
		';
    while ($datos = mysql_fetch_array($r)){
	$n++;
        $html.= '<tbody>
			<tr>
				<td>' . $n . '</td>				
				<td>' . $datos[patente] . '</td>
				<td>' . $datos[marca] . '</td>
				<td>' . $datos[modelo] . '</td>
				<td>' . $datos[cilindrada] . '</td>
				<td>' . $datos[num_pasajeros] . '</td>
				<td>' . $datos[color] . '</td>
				<td>' . $datos[valor_arriendo] . '</td>
			</tr>
		</tbody>
		';
    }
    
    $html.= '</table>';
  
    if (!mysql_num_rows($r))
        $html.= "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";

	
   $html.='</div>
	 <div id="footer">Rent a Car esCARes</div>
	   </div>  
	</body>
	</html>
	';

	echo $html;

	}

/*
@ Informe: ARRIENDOS
@
*/
if(isset($_POST['inf_arriendos'])){

	// CAMPOS ORDEN
	$campo_order = $_POST['campo_order']; 	
	$orden = $_POST['tipo_orden'];		

	// DATOS FECHAS
	$ano = $_POST['campo_ano'];		
	$mes = $_POST['campo_mes'];

	// PATENTE VEHICULO
	$patente = $_POST['patente'];

	// RUT CLIENTE
	$rut = $_POST['rut'];

	// FECHAS ARRIENDO
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];

	// ESTADO DE PAGO
	$estado_pago = $_POST['estado_pago'];

	// CONSULTA PRINCIPAL
	$x = 'SELECT * FROM contratos_arriendos c, detalle_de_contrato d where c.folio = d.contratos_arriendos_folio ';

	if($ano && $mes)
		$x.= 'AND YEAR(c.f_inicio) = '.$ano.' AND MONTH(c.f_inicio) = '.$mes.' ';
	if($mes && !$ano)
		$x.= "AND MONTH(c.f_inicio) = '$mes' ";

	if($ano && !$mes)
		$x.= "AND YEAR(c.f_inicio) = '$ano' ";

	if($patente)
		$x.= "AND d.vehiculos_patente = '$patente' ";

	if($rut)
		$x.= "AND c.clientes_rut_c = '$rut' ";

	if($fecha_inicio && $fecha_fin)
	$x.= "AND c.f_inicio between '$fecha_inicio' and '$fecha_fin'	 ";

	if($fecha_inicio && !$fecha_fin)
		$x.= "AND c.f_inicio = '$fecha_inicio'";

	if($fecha_fin && !$fecha_inicio)
		$x.= "AND c.f_fin = '$fecha_fin' ";

	if($estado_pago)
		$x.= "AND c.estado = '$estado_pago' ";

	$x.=" order by $campo_order $orden ";

	$r = mysql_query($x);

    	$n = 0; // CONTADOR DE REGISTROS
	$html = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Informe</title>
	<link rel="stylesheet" type="text/css" href="css/informes.css" />

	</head>
	<body>
		<div id="wrapper">
	           <div id="header">
			<H1>INFORME ARRIENDOS</H1>
			Elaborado el '.$fecha.' <br> Solicitado por '.$_SESSION['usuario_nombre'].' '.$_SESSION['usuario_apellido'].'
		   </div>
           <div id="content">
		<table class="gridtable" align="center">
			<thead>
				<tr>
				<th scope="col" align="left">N</th>
				<th scope="col" align="left">Folio</th>
	        		<th scope="col" align="left">Fecha Inicio</th>
				<th scope="col" align="left">Fecha Fin</th>
				<th scope="col" align="left">Rut Cliente</th>
				<th scope="col" align="left">Vehiculo(s)</th>
				<th scope="col" align="left">Estado Pago</th>
				</tr>
			</thead>
		';
    while ($datos = mysql_fetch_array($r)){
	$n++;
	$estado_arriendo = Estado_Arriendo($datos[estado]);
	
        $html.= '<tbody>
			<tr>
				<td>' . $n . '</td>				
				<td>' . $datos[folio] . '</td>
				<td>' . $datos[f_inicio] . '</td>
				<td>' . $datos[f_fin] . '</td>
				<td>' . $datos[clientes_rut_c] . '</td>
				<td>' . $datos[vehiculos_patente] . '</td>
				<td>' . $estado_arriendo . '</td>
			</tr>
		</tbody>
		';
    }
    
    $html.= '</table>';
  
    if (!mysql_num_rows($r))
        $html.= "<div class=n_warning><p>0 Resultados.</p></div>";

	
   $html.='</div>
	 <div id="footer">Rent a Car esCARes</div>
	   </div>  
	</body>
	</html>
	';

	echo $html;
	echo '<div style="margin-left:180px;"><button name="imprimir" value="Imprimir" onclick="window.print();">Imprimir </button></div>';
	}
?>

 
