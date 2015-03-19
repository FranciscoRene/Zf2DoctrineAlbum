<div id="informes">
<?php  
/*
SUB-MODULO: FILTRADO DE CLIENTES
*/



if($_GET['opcion'] == "clientes")
	{
?>

	<div class="h_title"><a href="?modulo=informes"> Volver a Informes </a> > Informes de Clientes</div>
				<form action="informe.php" method="POST" target="_blank">
					<div style="width:30%;float:left;position:relative;">
						<label for="mant_patente">Buscar Por</label>
						<select id="campo" name="campo_busqueda">
							<option value="rut_c">Rut</option>
							<option value="nom_c">Nombre</option>
							<option value="ape_c">Apellido</option>
						</select>
<br><br>
						<label for="">Ordenar Por</label>
						<select id="order" name="campo_order">
							<option value="rut_c">Rut</option>
							<option value="nom_c">Nombre</option>
							<option value="ape_c">Apellido</option>
						</select>
<br><br>
						<label for="">Otras Opciones</label>
						<select id="order" name="estado">
							<option value="">Seleccione</option>
							<option value="">Sin deuda actual</option>
							<option value="NO">Con Deuda actual</option>
						</select>
<br><br>					</div>

					<div style="margin-left:200px;float:right;position:absolute;">
						<label for="name">Texto Busqueda</label>
						<input id="busqueda" name="texto_busqueda" size="30">
						<label for="">Tipo de Orden</label>
						<select id="orden" name="tipo_orden">
							<option value="asc">Ascendente</option>
							<option value="desc">Descendente</option>

						</select>
<br><br>
					<button type="submit" name="inf_clientes" class="add">Mostrar</button>
					</div>
					</div>
				</form>

<?php 
}
?>


<?php  
/*

SUB-MODULO: FILTRADO DE VEHICULOS

*/

if($_GET['opcion'] == "vehiculos")
	{
?>

	<div class="h_title"><a href="?modulo=informes"> Volver a Informes </a> > Informes de Vehiculos</div>
				<form action="informe.php" method="POST" target="_blank">
					<div style="width:30%;float:left;position:relative;">
						<label for="mant_patente">Buscar Por</label>
						<select id="campo" name="campo_busqueda">
							<option value="patente">Patente</option>
							<option value="marca">Marca</option>
							<option value="modelo">Modelo</option>
							<option value="valor_arriendo">Valor Arriendo</option>
						</select>
<br><br>
						<label for="">Ordenar Por</label>
						<select id="order" name="campo_order">
							<option value="patente">Patente</option>
							<option value="marca">Marca</option>
							<option value="modelo">Modelo</option>
							<option value="valor_arriendo">Valor Arriendo</option>
						</select>
<br><br>
						<label for="">Otras Opciones</label>
						<select id="order" name="estado">
							<option value="">Seleccione</option>
							<option value="">En Arriendo Actualmente</option>
							<option value="NO">Disponible Actualmente</option>
						</select>
<br><br>					</div>

					<div style="margin-left:200px;float:right;position:absolute;">
						<label for="name">Texto Busqueda</label>
						<input id="busqueda" name="texto_busqueda" size="30">
						<label for="">Tipo de Orden</label>
						<select id="orden" name="tipo_orden">
							<option value="asc">Ascendente</option>
							<option value="desc">Descendente</option>

						</select>
<br><br>
					<button type="submit" name="inf_vehiculos" class="add">Mostrar</button>
					</div>
					</div>
				</form>
<?php 
}
?>
<?php  
/*

SUB-MODULO: FILTRADO DE ARRIENDOS

*/

if($_GET['opcion'] == "arriendos")
	{
?>

	<div class="h_title"><a href="?modulo=informes"> Volver a Informes </a> > Informes de Arriendos</div>
				<form action="informe.php" method="POST" target="_blank">
<table align="center" cellpadding="3" cellspacing="3" style="width: 80%;" class="ok">
			<tbody>
				<tr>
					<td valign="top">
						<label for="">Ordenar Resultados Por</label>
						<select id="order" name="campo_order">
							<option value="c.folio">Folio</option>
							<option value="c.f_inicio">Fecha Inicial</option>
							<option value="c.f_fin">Fecha Final</option>
						</select></td>
					<td valign="top">
						<label for="">Tipo de Orden</label>
						<select id="orden" name="tipo_orden">
							<option value="asc">Ascendente</option>
							<option value="desc">Descendente</option>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<div class="h_title">Rango de Fechas </div><br>
						<label for="">Fecha Inicial</label>
						<input id="fecha_inicio" name="fecha_inicio" size="30"> 
						<br><br>
						<label for="">Fecha Final</label>
						<input id="fecha_fin" name="fecha_fin" size="30"><br><br>
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
					</td>
					<td valign="top">
						<div class="h_title">Por Periodo </div><br>
						<label for="">Anualmente</label>
						<select id="order" name="campo_ano">
							<option value="">Seleccione Año</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
						</select> <br><br>
						<label for="">Mensualmente</label>
						<select id="order" name="campo_mes">
							<option value="">Seleccione Mes</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select><br><br>
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
					</td>
				</tr>

				<tr>
					<td valign="top">
						<div class="h_title">Por Cliente </div><br>
						<label for="name">RUT Cliente</label>
						<input id="rut" name="rut" size="25"><br><br>
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
					</td>
					<td valign="top">
						<div class="h_title">Por Vehiculo </div><br>
						<label for="name">Patente Vehiculo</label>
						<input id="patente" name="patente" size="25"><br><br>
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
						
					</td>
				</tr>
<tr>
					<td valign="top">
						<label for="">Estado de Pagos</label>
						<select id="estado_pago" name="estado_pago">
							<option value="">Seleccione</option>
							<option value="">Arriendos Pagados</option>
							<option value="NO">Arriendos NO Pagados</option>
						</select> 
					</td>
					<td valign="top">
						
					</td>
				</tr>

				<tr>
					<td valign="top">
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
					</td>
					<td valign="top">
					</td>
				</tr>

			</tbody>
		</table>

	<!--				<div style="width:30%;float:left;position:relative;">	
						<label for="">Ordenar Por</label>
						<select id="order" name="campo_order">
							<option value="folio">Folio</option>
							<option value="fecha_inicio">Fecha Inicial</option>
						</select>
<br><br>
						<label for="">Tipo de Orden</label>
						<select id="orden" name="tipo_orden">
							<option value="asc">Ascendente</option>
							<option value="desc">Descendente</option>
						</select>			

<br><br>
						<label for="">Otras Opciones</label>
						<select id="estado" name="estado">
							<option value="">Seleccione</option>
							<option value="">Arriendos Pagados</option>
							<option value="NO">Arriendos NO Pagados</option>
						</select>
<br><br>
						<label for="name">Patente Vehiculo</label>
						<input id="patente" name="patente" size="25">
<br><br>
						<label for="name">RUT Cliente</label>
						<input id="rut" name="rut" size="25">
<br><br>					</div>
					<div style="margin-left:200px;float:right;position:absolute;">
						<label for="name">Fecha Inicial</label>
						<input id="fecha_inicio" name="texto_busqueda" size="30">
<br><br>
						<label for="fecha_final">Fecha Final</label>
						<input id="fecha_fin" name="texto_busqueda" size="30">

<br><br>
					<button type="submit" name="inf_arriendos" class="add">Mostrar</button>
					</div>
					</div>
-->

				</form>
<?php  
}
?>
</div>
