<?php 
	
	$folio = $_GET['folio']; // NUMERO DE FOLIO 
	$patente = $_GET['patente'];

	// CONEXION ENTRE CLIENTES Y CONTRATOS DE ARRIENDOS
	if($folio)
	$r = mysql_query("select * from contratos_arriendos contrato, clientes cl where contrato.folio = $folio and contrato.clientes_rut_c = cl.rut_c");

	if($patente)
	$r = mysql_query("select * from contratos_arriendos contrato, detalle_de_contrato detalle, clientes cl
			where detalle.contratos_arriendos_folio = contrato.folio
			AND contrato.clientes_rut_c = cl.rut_c
			AND detalle.vehiculos_patente = '$patente'
			");

	
	$datos=mysql_fetch_array($r);
	$folio = $datos[folio]; // FOLIO ARRIENDO
	$fecha_inicio = $datos[f_inicio]; // FECHA INICIO ARRIENDO
	$fecha_fin = $datos[f_fin]; // FECHA FIN ARRIENDO
	$hora_inicio = $datos[h_inicio]; // HORA INICIO ARRIENDO
	$hora_fin = $datos[h_fin]; // HORA FIN ARRIENDO
	$nom_c = $datos[nom_c]; // NOMBRE CLIENTE ASOCIADO AL ARRIENDO
	$ape_c = $datos[ape_c]; // APELLIDO CLIENTE ASOCIADO AL ARRIENDO
	$estado = $datos[estado]; // ESTADO ACTUAL DEL ARRIENDO
	

	/* GENERAR CALENDARIO */
	list($i_ano, $i_mes, $i_dia) = split('-',$fecha_inicio);
	list($f_ano, $f_mes, $f_dia) = split('-',$fecha_fin);

	$trans = array("01" => "1", "02" => "2", "03" => "3", "04" => "4", "05" => "5", "06" => "6", "07" => "7", "08" => "8", "09" => "9");
	$i_mes = strtr($i_mes, $trans);

	$trans = array("01" => "1", "02" => "2", "03" => "3", "04" => "4", "05" => "5", "06" => "6", "07" => "7", "08" => "8", "09" => "9");
	$f_mes = strtr($f_mes, $trans);


	/* OBTENER TOTAL DE DIAS DE ARRIENDO */

	$dias_arriendo = diferenciaEntreFechas($fecha_inicio, $fecha_fin, "DIAS", "NO");
?>

<!-- COLUMNA DETALLE ARRIENDO -->
<div class="half_w half_left">
				<div class="h_title">Detalle Arriendo</div>
				<div class="stats">
					<div class="today">
						<h3>Folio</h3>
						<p class="count"><?php  echo $folio; ?></p>
						<br>
						<h3>Estado Actual</h3>
						<p class="type"><b><?php  echo Estado_Arriendo($estado); ?></b></p>

						<br>
						<h3>Cliente</h3>
						<p class="type"><?php  echo $nom_c." ".$ape_c; ?></p>

					</div>
					<div class="week">
						<h3>Fecha Inicio</h3>
						<p class="count"><?php  echo $fecha_inicio; ?></p>
						<p class="type"><?php  echo $hora_inicio; ?></p>
						<br>
						<h3>Fecha Termino</h3>
						<p class="count"><?php  echo $fecha_fin; ?></p>
						<p class="type"><?php  echo $hora_fin; ?></p>
						<h3>Total: <?php  echo $dias_arriendo." días"; ?></h3>
					</div>
				</div>
			</div>

<!-- COLUMNA CALENDARIO ARRIENDO  -->
	<div class="half_w half_right">
		<div class="h_title">Calendario</div>
		<div id="example" style="width:330px;"></div>
	</div>

<!-- COLUMNA DETALLE VEHICULOS EN ARRIENDO  -->
	<div class="half_w half_left">
		<div class="h_title">Vehiculos en Arriendo</div>

		
		<?php  $r = mysql_query("select * from detalle_de_contrato d, vehiculos v where contratos_arriendos_folio = $folio and v.patente = d.vehiculos_patente order by d.vehiculos_patente");

		echo '
			<table style="width:300px;">
			<thead>
				<tr>
				<th scope="col">Patente</th>
				<th scope="col">Modelo</th>
				<th scope="col">Valor Diario</th>
				<th scope="col">Total </th>
					</tr>
			</thead>
		';

		while($datos_v=mysql_fetch_array($r)){
			$patente = $datos[patente];
			// VALOR TOTAL VEHICULO POR TODOS SUS DIAS DE ARRIENDO
			$total_arriendo_auto = $datos_v[valor_por_auto]*$dias_arriendo;
			// VALOR TOTAL DE TODOS LOS VEHICULOS INCLUIDOS EN EL ARRIENDO
			$valor_total_arriendos += $datos_v[valor_por_auto]*$dias_arriendo;

			// CONVERTIR FORMATO A MONEADA LOCAL PARA REALIZAR CALCULOS			
			$total_arriendo_auto = money_format('%.3n', $total_arriendo_auto);
			$valor_total_arriendos = money_format('%.3n', $valor_total_arriendos);
// CAMBIAR
//			$total_arriendo_auto = toMoney($total_arriendo_auto*1000);
//			$valor_total_arriendos = toMoney($valor_total_arriendos*1000);

			echo '<tbody>
				<tr>
					<td><b>'.$datos_v[patente].'</b></td>
					<td>'.$datos_v[marca].' - '.$datos_v[modelo].'</td>
					<td>$'.$datos_v[valor_por_auto].'</td>
					<td>$'.$total_arriendo_auto.' </td>
				</tr>
			</tbody>
		';
			
			}

			// VALOR FINAL DE TODOS LOS ARRIENDOS DEL FOLIO

			echo '<tbody>
				<tr>
					<td></td>
					<td></td>
					<td><b>Total:<b></td>
					<td><b>$'.$valor_total_arriendos.'</b></td>
				</tr>
			</tbody>';
		?>
		</table>
	<?php  if($estado == "NO")
		echo '	<div class="n_warning"><p>Este Arriendo tiene pendiente el Pago.</p></div>';
	   if($estado == "SI")
		echo '	<div class="n_ok"><p>Este Arriendo ya ha registrado su Pago.</p></div>';		
	 ?>

	</div>

	<div class="half_w half_left">
		<div class="h_title">Acciones</div>
		<div class="element" style="margin-left:12px;">
				<form action="validar.php" method="post">		
				<input type="hidden" name="folio" value="<?php  echo $folio; ?>">
				<label>Modificar Estado Pago</label>
				<select name="estado">
					<option value="">Seleccione una Opcion</option>
					<option value="SI">PAGADO</option>
					<option value="NO">NO PAGADO</option>
				</select>
				<button type="submit" name="modificar_estado_pago">Modificar</button>
				</form>

				<form action="validar.php" method="post">
				<input type="hidden" name="folio" value="<?php  echo $folio; ?>">
				<?php
 				$r = mysql_query("select * from detalle_de_contrato d, vehiculos v where contratos_arriendos_folio = $folio and v.patente = d.vehiculos_patente order by d.vehiculos_patente");
				while($datos_s=mysql_fetch_array($r)){
				echo '<input type="hidden" name="patente[]" value="'.$datos_s[patente].'">';
				}
				?>
				<label>Registrar Post-Revisión</label>
				<select name="revision">
					<option>Seleccione una Opcion</option>						
						<option value="Normal">Normal: Sin Detalles</option>
						<option value="Minimo">Regular: Con Detalles minimos</option>
						<option value="Grave">Mal: Con Detalles Graves</option>
				</select>
				<button type="submit" name="registrar_post_revision">Modificar</button>
</form>
		</div>

<div class="h_title">Estado Revisiones</div>
		<div class="element" style="margin-left:12px;padding:10px;">
		<?php  $z = mysql_query("select * from revisiones where contratos_arriendos_folio= $folio"); 
		while($datos_r=mysql_fetch_array($z)){
			if($datos_r['rev_type']=="previa")
				echo '<b><img src="img/dot.gif"> Pre-Revisión : </b>'.$datos_r[estado_r].' ';
	
			echo "<br>";
			if($datos_r['rev_type']=="post")
				echo '<b><img src="img/dot.gif"> Post-Revisión : </b>'.$datos_r[estado_r].' ';
}
		 ?>

		</div>

	</div>




<!-- /* JQUERY FUNCION CALENDARIO  */ -->

<script type="text/javascript">
	var ano = (new Date).getFullYear();
	var mes = (new Date).getMonth();
	var dia = (new Date).getDate();


        $(window).load(function()
        {
$('#example').glDatePicker(
{

    showAlways: true,
    allowMonthSelect: false,
    allowYearSelect: false,
    prevArrow: '<',
    nextArrow: '>',
	selectableDateRange: [
        { from: new Date(ano-4, 1, 1 ),
            to: new Date(<?php  echo $i_ano; ?> , <?php  echo $i_mes-1;?>, <?php  echo $i_dia-1; ?>), },
	{ from: new Date(<?php  echo $i_ano; ?>, <?php  echo $i_mes-1; ?>, <?php  echo $f_dia+1; ?> ),
            to: new Date(ano+4 ,1 ,1 ), },
       
    ],


/*
	selectableDateRange: [
        { from: new Date(<?php  echo $i_ano;?> , <?php  echo $i_mes-1;?>, <?php  echo $i_dia;?>),
            to: new Date(<?php  echo $f_ano;?> , <?php  echo $f_mes-1;?>, <?php  echo $f_dia;?>) },
    ], */

   selectedDate: new Date(<?php  echo $f_ano;?> , <?php  echo $f_mes-1;?>, <?php  echo $f_dia;?>),
	specialDates: [
        {
            date: new Date(<?php  echo $i_ano;?> , <?php  echo $i_mes-1;?>, <?php  echo $i_dia;?>),
            data: { message: 'Inicio Arriendo' }
        },
        {
            date: new Date(<?php  echo $f_ano;?> , <?php  echo $f_mes-1;?>, <?php  echo $f_dia;?>),
            data: { message: 'Fin Arriendo' }
        },
	],



        });
   });
    </script>
