<?php  
/*

MODULO PRINCIPAL MANTENCIONES
*/
if(!$_GET['opcion'])
	{		
?>
<div class="h_title">Mantenciones > </div>
<div id="box_home_icono">
			<ul>
			<li><a href="?modulo=mantenciones&opcion=agregar"><img src="img/iconos/add_mantencion.png" width="128" hight="128"><h3>Agregar Mantención</h3></a></li>
			<li><a href="?modulo=mantenciones&opcion=listar"><img src="img/iconos/todo.png" width="128" hight="128"><h3>Listar Mantención</h3></a></li>
			</ul>
		</div>

<?php  
/*

SUB-MODULO: LISTAR MANTENCIONES

*/
}
if($_GET['opcion'] == "listar")
	{
?>
	<div class="h_title"><a href="?modulo=mantenciones"> Volver a Mantenciones </a> > Listado de Mantenciones</div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="mantenciones">
		<input type="hidden" name="opcion" value="listar">
		<input id="busqueda" name="mant_busqueda" size="30">
		<button type="submit" class="entry">Buscar Mantencion</button>					
	</form>
<?php  
	if($_GET['mant_busqueda'])
		$busqueda = $_GET['mant_busqueda'];
	if($_GET['mant_item'])
		$item = $_GET['mant_item'];
	Listar_Mantenciones("fecha","asc",$busqueda,$item);
	
	}
?>



<?php 
/*

SUB-MODULO: AGREGAR MANTENCIONES

*/

 if($_GET['opcion'] == "agregar") { ?>


<!--
AUTOCOMPLEMENTAR INPUT PATENTE
 -->

<?php  $arreglo_php = AutoCompletar("vehiculos","patente"); ?>

<script>
    $(window).load(function(){
	var autocompletar = new Array();
   <?php  for($p = 0; $p < count($arreglo_php); $p++){ ?>
       autocompletar.push('<?php  echo $arreglo_php[$p]; ?>');
     <?php  } ?>
     $("#mant_patente").autocomplete({ 
       source: autocompletar
     });
  });
</script>

<?php  $arreglo_php = AutoCompletar("servicios_tecnicos","rut_st"); ?>

<script>
    $(window).load(function(){
	var autocompletar = new Array();
   <?php  for($p = 0; $p < count($arreglo_php); $p++){ ?>
       autocompletar.push('<?php  echo $arreglo_php[$p]; ?>');
     <?php  } ?>
     $("#serv_rut").autocomplete({ 
       source: autocompletar
     });
  });
</script>



	<div class="h_title"><a href="?modulo=mantenciones"> Volver a Mantenciones </a> > Registrar Mantencion</div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="mant_patente">Patente Vehiculo <span class="red">(requerido)</span></label>
						<input id="mant_patente" name="mant_patente" class="text ok" value="<?php  echo $_GET['v_patente']; ?>">
					</div>
					<div class="element">
						<label for="name">RUT Servicio Tecnico <span class="red">(requerido)</span></label>
						<input id="serv_rut" name="serv_rut" class="text ok">
					</div>
					<div class="element">
						<label for="name">Fecha<span class="red">(requerido)</span></label>
						<input id="mant_fecha" name="mant_fecha" class="text ok">
					</div>
					<div class="element">
						<label for="name">Valor <span class="red">(requerido)</span></label>
						<input id="mant_valor" name="mant_valor" class="text ok" size="20">
						Ejemplo: 34.000
					</div>
					<div class="element">
						<label for="name">Descripcion <span class="red">(requerido)</span></label>
						<textarea id="mant_desc" name="mant_desc" class="text ok"></textarea>
					</div>
					<div class="entry">
						<button type="submit" name="mantenciones_ingreso" class="add">Agregar Mantencion</button>
					</div>
				</form>


<?php 
}
?>
