<?php  
/*

MODULO PRINCIPAL VEHICULOS

*/
?>

<?php  
if(!$_GET['opcion']){
?>
<div class="h_title">Vechículos > </div>
<div id="box_home_icono">
			<ul>
			<li><a href="?modulo=vehiculos&opcion=agregar"><img src="img/iconos/add_vehiculo.png" width="128" hight="128"><h3>Agregar Vehiculo</h3></a></li>
			<li><a href="?modulo=vehiculos&opcion=buscar"><img src="img/iconos/buscar.png" width="128" hight="128"><h3>Buscar de Vehiculos</h3></a></li>
			<li><a href="?modulo=vehiculos&opcion=listar"><img src="img/iconos/todo.png" width="128" hight="128"><h3>Listar Vehiculos</h3></a></li>
			</ul>
		</div>
<?php 
}

/*

MODULO DETALLE VEHICULO

*/

if($_GET['opcion'] == "detalle_vehiculo")
	{ ?>
PATENTE

<?php  } ?>


<?php  

/*

SUB-MODULO: LISTAR CLIENTES

*/

if($_GET['opcion'] == "listar")
	{
?>
	<div class="h_title"><a href="?modulo=vehiculos"> Volver a Vehiculos </a> > Listado de Vehiculos </div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="vehiculos">
		<input type="hidden" name="opcion" value="listar">
		<input id="busqueda" name="v_busqueda" size="30">
		<button type="submit" class="entry">Buscar Vehiculo</button>					
	</form>
<?php  
	if($_GET['v_busqueda'])
		$busqueda = $_GET['v_busqueda'];
	if($_GET['c_item'])
		$item = $_GET['c_item'];
	Listar_Vehiculos("estado","asc",$busqueda,$item);
	
	}
?>



<?php 
/*

SUB-MODULO: AGREGAR CLIENTES

*/

 if($_GET['opcion'] == "agregar") { ?>


	<div class="h_title"><a href="?modulo=vehiculos"> Volver a Vehiculos </a> > Agregar Vehiculo </div>
				<form action="validar.php" method="post" enctype="multipart/form-data">
					<div class="element">
						<label for="name">Patente <span class="red">(requerido)</span></label>
						<input id="v_patente" name="v_patente" class="text ok"> Ejemplo: CRVD-43
					</div>
					<div class="element">
						<label for="name">Marca <span class="red">(requerido)</span></label>
						<?php  Listar_Marcas('Selecciona Una Marca'); ?></div>
					<div class="element">
						<label for="name">Modelo <span class="red">(requerido)</span></label>
						<input id="v_modelo" name="v_modelo" class="text ok">
					</div>
					<div class="element">
						<label for="name">Color <span class="red">(requerido)</span></label>
						<?php  Listar_Colores(); ?>
					</div>
					<div class="element">
						<label for="name">Combustible <span class="red">(requerido)</span></label>
						<select name="v_combustible">
		 			         <option value="Bencina">Bencina</option>
	   			        	<option value="Diesel">Diesel</option>
						<option value="Gas">Gas</option>
					            <option value="Hibrido">Hibrido</option>
				</select>
					</div>
					<div class="element">
						<label for="name">Cilindrada <span class="red">(requerido)</span></label>
						<input id="v_cilindrada" maxlength="3" name="v_cilindrada" class="text ok">Ejemplo 2.0
					</div>
					<div class="element">
						<label for="name">Numero de Pasajeros <span class="red">(requerido)</span></label>
						<select name="v_pasajeros">
					            <option value="2">2</option>
					            <option value="3">3</option>
		        			    <option value="4">4</option>
		        			    <option value="5">5</option>
					            <option value="6">6</option>
					            <option value="7">7</option>
						</select>
					</div>

					<div class="element">
						<label for="name">Valor Arriendo <span class="red">(requerido)</span></label>
						<input id="v_valor" name="v_valor" class="text ok">
					</div>

					<div class="element">
						<label for="name">Imagen <span>(opcional)</span></label>
						<input type="file" id="v_aimagen" name="v_imagen" class="text ok">
					</div>
					<div class="element">
						<label for="name">Otras Caracteristicas <span>(opcionales)</span></label>
 						<input name="v_otras[]" value="Aire Acondicionado" type="checkbox"> Aire Acondicionado / 
						<input name="v_otras[]" value="Full Equipo" type="checkbox"> Full Equipo / 
						<input name="v_otras[]" value="Climatizador" type="checkbox"> Climatizador /
						<input name="v_otras[]" value="Cierre Centralizado" type="checkbox"> Cierre Centralizado
						<input name="v_otras[]" value="Dirección Asistida" type="checkbox"> Dirección Asistida
						<input name="v_otras[]" value="Dirección Hidraulica" type="checkbox"> Dirección Hidraulica
						<input name="v_otras[]" value="Caja de Cambios Automatica" type="checkbox"> Caja de Cambios Automatica
						<input name="v_otras[]" value="Caja de Cambios Manual" type="checkbox"> Caja de Cambios Manual
					</div>


					<div class="entry">
						<button type="submit" name="vehiculos_ingreso" class="add">Agregar Vehiculo</button>
					</div>
				</form>


<?php 
}

/*

SUB-MODULO: BUSCAR VEHICULOS

*/

if($_GET['opcion'] == "buscar")
	{
?>

	<div class="h_title"><a href="?modulo=vehiculos"> Volver a Vehiculos </a> > Buscar Vehiculos </div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="vehiculos">
		<input type="hidden" name="opcion" value="listar">
		<div class="element">
			<label for="item">Seleccione Item <span class="red">(requerido)</span></label>
			<select name="v_item" class="entry">
				<option value="patente">Patente</option>
				<option value="Marca">Marca</option>
				<option value="Modelo">Modelo</option>
			</select>					
		</div>
		<div class="element">
			<label for="name">Ingrese Busqueda <span class="red">(requerido)</span></label>
			<input name="v_busqueda" size="50"><button type="submit" class="entry">Buscar</button>					
		</div>
	
	</form>

<?php  } ?>


<?php  
/*

SUB-MODULO: EDITAR VEHICULOS

*/

if($_GET['opcion']=="editar")
	{
	$v_patente = trim($_GET['v_patente']);
	$r = mysql_query("select * from vehiculos where patente = '$v_patente'");
	$datos=mysql_fetch_array($r);
?>

	<div class="h_title"><a href="?modulo=vehiculos"> Volver a Vehiculos </a> > Modificar Vehiculo </div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="name">Patente <span class="red"></span></label>
						<input id="v_patente" name="v_patente" value="<?php  echo $datos[patente]; ?>" class="text ok" disabled>
					</div>
					<div class="element">
						<label for="name">Marca <span class="red">(requerido)</span></label>
						<?php  Listar_Marcas($datos['marca']); ?></div>
					<div class="element">
						<label for="name">Modelo <span class="red">(requerido)</span></label>
						<input id="v_modelo" name="v_modelo" class="text ok">
					</div>
					<div class="element">
						<label for="name">Color <span class="red">(requerido)</span></label>
						<?php  Listar_Colores(); ?>
					</div>
					<div class="element">
						<label for="name">Combustible <span class="red">(requerido)</span></label>
						<select name="v_combustible">
		 			         <option value="Bencina">Bencina</option>
	   			        	<option value="Diesel">Diesel</option>
						<option value="Gas">Gas</option>
					            <option value="Hibrido">Hibrido</option>
				</select>
					</div>
					<div class="element">
						<label for="name">Cilindrada <span class="red">(requerido)</span></label>
						<input id="v_cilindrada" maxlength="3" name="v_cilindrada" class="text ok">Ejemplo 2.0
					</div>
					<div class="element">
						<label for="name">Numero de Pasajeros <span class="red">(requerido)</span></label>
						<select name="v_pasajeros">
					            <option value="2">2</option>
					            <option value="3">3</option>
		        			    <option value="4">4</option>
		        			    <option value="5">5</option>
					            <option value="6">6</option>
					            <option value="7">7</option>
						</select>
					</div>

					<div class="element">
						<label for="name">Valor Arriendo <span class="red">(requerido)</span></label>
						<input id="v_valor" name="v_valor" class="text ok">
					</div>

					<div class="element">
						<label for="name">Imagen <span>(opcional)</span></label>
						<input type="file" id="v_imagen" name="v_imagen" class="text ok">
					</div>
					<div class="element">
						<label for="name">Otras Caracteristicas <span>(opcionales)</span></label>
 						<input name="v_otras[]" value="Aire Acondicionado" type="checkbox"> Aire Acondicionado / 
						<input name="v_otras[]" value="Full Equipo" type="checkbox"> Full Equipo / 
						<input name="v_otras[]" value="Climatizador" type="checkbox"> Climatizador /
						<input name="v_otras[]" value="Cierre Centralizado" type="checkbox"> Cierre Centralizado
						<input name="v_otras[]" value="Dirección Asistida" type="checkbox"> Dirección Asistida
						<input name="v_otras[]" value="Dirección Hidraulica" type="checkbox"> Dirección Hidraulica
						<input name="v_otras[]" value="Caja de Cambios Automatica" type="checkbox"> Caja de Cambios Automatica
						<input name="v_otras[]" value="Caja de Cambios Manual" type="checkbox"> Caja de Cambios Manual
					</div>


					<div class="entry">
						<button type="submit" name="vehiculos_ingreso" class="add">Agregar Vehiculo</button>
					</div>
				</form>

<?php  } ?>
