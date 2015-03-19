<?php  

if($_GET['opcion'] == 'vehiculos') {
	$r = mysql_query("SELECT COUNT(d.vehiculos_patente) cantidad, v.marca as item FROM detalle_de_contrato d, vehiculos v where v.patente = d.vehiculos_patente group by d.vehiculos_patente");
	
	echo "<div class=h_title>Gráfico Vehiculos más Arrendados > </div>";
}

if($_GET['opcion'] == 'clientes'){
$r = mysql_query("SELECT COUNT(a.clientes_rut_c) cantidad, CONCAT(nom_c,ape_c) as item FROM contratos_arriendos a, clientes c where c.rut_c = a.clientes_rut_c group by a.clientes_rut_c");
	echo "<div class=h_title>Gráfico Clientes con más Arriendos > </div>";
}

if($_GET['opcion'] == 'meses') {
	$r = mysql_query("SELECT COUNT(folio) cantidad, MONTHNAME(f_inicio) as item FROM contratos_arriendos group by item");
	
	echo "<div class=h_title>Gráfico Arriendos Por Meses > </div>";
}

if($_GET['opcion'] == 'dias') {
	$r = mysql_query("SELECT COUNT(folio) cantidad, DAYNAME(f_inicio) as item FROM contratos_arriendos group by item");
	
	echo "<div class=h_title>Gráfico Arriendos en Días > </div>";
}

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

<div id="chart1"></div>

