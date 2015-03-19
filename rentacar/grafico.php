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

require("config.inc.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php  echo $titulo; ?></title>

<!-- ESTILOS PRINCIPALES -->
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<!-- ESTILO MENU NAVEGACION -->
<link rel="stylesheet" type="text/css" href="css/navi.css" media="screen" />
<!-- ESTILO DATE PICKER INPUT -->
<link href="css/glDatePicker.default.css" rel="stylesheet" type="text/css">

<!-- LIBRERIAS JQUERY -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" media="screen" />

<script language="javascript" type="text/javascript" src="plot/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="plot/jquery.jqplot.css" />


<?

// Grafico Vehiculos arrendados
//$r = mysql_query("SELECT COUNT(d.vehiculos_patente) cantidad, v.marca as item FROM detalle_de_contrato d, vehiculos v where v.patente = d.vehiculos_patente group by d.vehiculos_patente");

// Grafico Clientes con mas Arriendos
$r = mysql_query("SELECT COUNT(a.clientes_rut_c) cantidad, c.rut_c as item FROM contratos_arriendos a, clientes c where c.rut_c = a.clientes_rut_c group by a.clientes_rut_c");



?>
<script type="text/javascript">
$(document).ready(function(){
    var plot1 = $.jqplot('chart1',
	[[
	<? while ($datos = mysql_fetch_array($r)){ ?>
	['<? echo $datos[item]; ?>',<? echo $datos[cantidad]; ?>],
	<? } ?>

	]],

	 {
        gridPadding: {top:0, bottom:0, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer,
            trendline:{ show:true },
            rendererOptions: { padding: 8, showDataLabels: true }
        },
	showLabel: true,
        legend:{
            show:true,
            placement: 'inside',
            rendererOptions: {
                numberRows: 1
            },
            location:'s',
            marginTop: '15px'
        }      
    });
});
	</script>

<script type="text/javascript" src="plot/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="plot/plugins/jqplot.donutRenderer.min.js"></script>

<!-- LIBRERIAS DATE PICKER -->
<script src="js/glDatePicker.js"></script>
<script type="text/javascript">
$(window).load(function()        {
$("#mant_fecha,#fecha_inicio,#fecha_fin").datepicker(
	{
	dateFormat: "yy-mm-dd",
	firstDay: 1,
	monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ]
	 });
});
    </script>

<!-- LIBRERIA TIME PICKER -->
<script type="text/javascript" src="js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

<script type="text/javascript">
$(function() {
	$('#hora_inicio,#hora_fin').timepicker();
  });
</script>

<!-- LIBRERIA PRINCIPAL MENUS -->
<script type="text/javascript">
$(function(){
//	$("#bienvenida_sistema").hide("normal");	
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>

<!-- LIBRERIA SUPERBOX -->
<link rel="stylesheet" href="css/jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.superbox.js"></script>

</head>
<body>
<div class="wrap">
	<div id="header">
		<div id="top">
				<span style="font-size:30px;color:#fff;">SGA - Rent a Car</span>
			<div class="left">
<!-- <img src="img/i_warninasdg.png" border="0" width="100" height="100"> -->
			</div>
			<div class="right">
				<div class="align-right">
				Bienvenido, <strong><?php  echo $_SESSION['usuario_nombre']." ".$_SESSION['usuario_apellido'];?></strong> [ <a href="logout.php">Desconectar</a> ] <br>

				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="home.php">Pagina Principal</a></li>				
					<li class="upp"><a href="home.php?modulo=arriendos">Reservas / Arriendos</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=arriendos&opcion=agregar">Generar Arriendo</a></li>
						<li>&#8250; <a href="home.php?modulo=arriendos&opcion=listar">Listar Arriendos</a></li>
						<li>&#8250; <a href="home.php?modulo=arriendos&opcion=buscar">Buscar Arriendos</a></li>
					</ul>
				</li>
				<li class="upp"><a href="home.php?modulo=clientes">Clientes</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=clientes&opcion=agregar">Registrar Cliente</a></li>
						<li>&#8250; <a href="home.php?modulo=clientes&opcion=listar">Listar Clientes</a></li>
						<li>&#8250; <a href="home.php?modulo=clientes&opcion=buscar">Buscar Cliente</a></li>
					</ul>
				</li>
				<li class="upp"><a href="home.php?modulo=vehiculos">Vehiculos</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=vehiculos&opcion=agregar">Registrar Vehiculo</a></li>
						<li>&#8250; <a href="home.php?modulo=vehiculos&opcion=listar">Listar Vehiculos</a></li>
						<li>&#8250; <a href="home.php?modulo=vehiculos&opcion=buscar">Buscar Vehiculo</a></li>
					</ul>
				</li>
				<li class="upp"><a href="home.php?modulo=mantenciones">Mantenciones</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=mantenciones&opcion=agregar">Registrar Mantencion</a></li>
						<li>&#8250; <a href="home.php?modulo=mantenciones&opcion=listar">Listar Mantenciones</a></li>

					</ul>
				</li>
<?php  if ($_SESSION['usuario_perfil']==1) { ?>
					<li class="upp"><a href="home.php?modulo=serv_tecnico">Servicio Técnico</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=serv_tecnico&opcion=agregar">Registrar Proveedor</a></li>
						<li>&#8250; <a href="home.php?modulo=serv_tecnico&opcion=listar">Listar Proveedores</a></li>
					</ul>
				</li>
<?php  } ?>

					<li class="upp"><a href="#">Busquedas</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=clientes&opcion=buscar">Buscar Cliente</a></li>
						<li>&#8250; <a href="home.php?modulo=arriendos&opcion=buscar">Buscar Arriendo</a></li>
						<li>&#8250; <a href="home.php?modulo=vehiculos&opcion=buscar">Buscar Vehiculo</a></li>
					</ul>
				</li>
<?php  if ($_SESSION['usuario_perfil']==1) { ?>
					<li class="upp"><a href="#">Informes</a>
					<ul>
						<li>&#8250; <a href="home.php?modulo=informes&opcion=vehiculos">Informe Vehiculos</a></li>
						<li>&#8250; <a href="home.php?modulo=informes&opcion=arriendos">Informe Arriendos</a></li>
						<li>&#8250; <a href="home.php?modulo=informes&opcion=clientes">Informe Clientes</a></li>
					</ul>
				</li>
<?php  } ?>


			</ul>
		</div>
	</div>

	<div id="content">
		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; Alertas</div>
				<ul id="home">
				<li class="b1">
				<?php  echo Alerta_Arriendos(); ?>
				</li>
				</ul>
			</div>

			<div class="box">
				<div class="h_title">&#8250; Accesos Rápidos</div>
				<ul id="home">
					<li class="b1"><a class="icon view_page" href="home.php">Pagina Principal</a></li>
					<li class="b2"><a class="icon report" href="home.php?modulo=arriendos&opcion=buscar">Buscar Arriendo</a></li>
					<li class="b1"><a class="icon report" href="home.php?modulo=clientes&opcion=buscar">Buscar Clientes</a></li>
					<li class="b2"><a class="icon add_user" href="home.php?modulo=clientes&opcion=agregar">Registrar Cliente</a></li>
					<li class="b2"><a class="icon page" href="home.php?modulo=arriendos&opcion=agregar">Generar Arriendo</a></li>
				</ul>
			</div>
			
			<div class="box">
				<div class="h_title">&#8250; Busquedas</div>
				<ul>
					<li class="b1"><a class="icon page" href="home.php?modulo=arriendos&opcion=buscar">Por Folio</a></li>
					<li class="b2"><a class="icon page" href="home.php?modulo=clientes&opcion=buscar">Por Cliente</a></li>
					<li class="b1"><a class="icon page" href="home.php?modulo=vehiculos&opcion=buscar">Por Vehiculo</a></li>
				</ul>
			</div>
<?php  if ($_SESSION['usuario_perfil']==1) { ?>
			<div class="box">
				<div class="h_title">&#8250; Administrador General</div>
				<ul>
					<li class="b1"><a class="icon add_page" href="?modulo=usuarios&opcion=agregar">Agregar Usuario</a></li>
					<li class="b2"><a class="icon users" href="?modulo=usuarios&opcion=listar">Listar Usuarios</a></li>
				</ul>
			</div>
<?php  } ?>
		</div>

		<div id="main">

			
			<div class="clear"></div>
			
<?php  if(!$_GET) { ?>
<div class="full_w">	
	<div class="h_title">Accesos Directos</div>




<div id="chart1"></div>


</div>
<div class="clear"></div>

<?php  } ?>
<div class="clear"></div>
	</div>

	<div id="footer">
		<div class="left">
			<p>Sistema de Administracion - Rent a Car esCARes </p>
		</div>
		<div class="right">
			<p>Desarollado por <a href="">Sequia Project </a></p>
		</div>
	</div>
</div>

</body>
</html>

