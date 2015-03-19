<?php  
/*

MODULO PRINCIPAL ARRIENDOS
*/

if(!$_GET['opcion']){
?>
<div class="h_title">Arriendos > </div>
<div id="box_home_icono">
			<ul>
			<li><a href="?modulo=arriendos&opcion=agregar"><img src="img/iconos/calendario.png" width="128" hight="128"><h3>Agregar Arriendo</h3></a></li>
			<li><a href="?modulo=arriendos&opcion=buscar"><img src="img/iconos/buscar.png" width="128" hight="128"><h3>Buscar Arriendo</h3></a></li>
			<li><a href="?modulo=arriendos&opcion=listar"><img src="img/iconos/todo.png" width="128" hight="128"><h3>Listar Arriendos</h3></a></li>
			</ul>
		</div>
<?php 
}
 /*

SUB-MODULO: BUSCAR VEHICULOS

*/
if($_GET['opcion'] == "buscar")
	{
?>

	<div class="h_title"><a href="?modulo=arriendos"> Volver a Arriendos </a> > Busqueda de Arriendos </div>
				
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="arriendos">
		<input type="hidden" name="opcion" value="listar">
		<div class="element">
			<label for="item">Seleccione Item <span class="red">(requerido)</span></label>
			<select name="arriendos_item" class="entry">
				<option value="folio">Numero Folio</option>
				<option value="clientes_rut_c">Rut Cliente</option>
				<option value="f_inicio">Fecha Inicio</option>
				<option value="f_fin">Fecha Fin</option>
			</select>					
		</div>
		<div class="element">
			<label for="name">Ingrese Busqueda <span class="red">(requerido)</span></label>
			<input name="arriendos_busqueda" size="50"><button type="submit" class="entry">Buscar</button>					
		</div>
	
	</form>

<?php  } ?>


<?php  
/*

SUB-MODULO: LISTAR ARRIENDOS

*/

if($_GET['opcion'] == "listar")
	{
?>
	<div class="h_title"><a href="?modulo=arriendos"> Volver a Arriendos </a> > Listado de Arriendos </div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="arriendos">
		<input type="hidden" name="opcion" value="listar">
		<input id="busqueda" name="arriendos_busqueda" size="30">
		<button type="submit" class="entry">Buscar Arriendo</button>					
	</form>
<?php  
	if($_GET['arriendos_busqueda'])
		$busqueda = $_GET['arriendos_busqueda'];
	if($_GET['arriendos_item'])
		$item = $_GET['arriendos_item'];
	Listar_Arriendos("folio","asc",$busqueda,$item);
	}
?>

<?php 
/*

SUB-MODULO: AGREGRAR ARRIENDO

VERIFICAR http://jonthornton.github.io/jquery-timepicker/

// PATENTES GUARDAR TODAS EN UN ARRAY

*/

 if($_GET['opcion'] == "agregar") { ?>

<script type="text/javascript">
$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
        
        $('#addScnt').live('click', function() {
                $('<p><label for="v_patente[]"><input type="text" size="30" name="v_patente[]" id="v_patente_' + i +'" value="" /></label> <a href="#" id="remScnt">Eliminar</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
});
</script>


<?php  $arreglo_php = AutoCompletar("clientes","rut_c"); ?>

<script>
    $(window).load(function(){
	var autocompletar = new Array();
   <?php  for($p = 0; $p < count($arreglo_php); $p++){ ?>
       autocompletar.push('<?php  echo $arreglo_php[$p]; ?>');
     <?php  } ?>
     $("#c_rut_text").autocomplete({ 
       source: autocompletar
     });
  });
</script>


<?php  $arreglo_php = AutoCompletar("vehiculos","patente"); ?>

<script>
    $(window).load(function(){
	var autocompletar = new Array();
   <?php  for($p = 0; $p < count($arreglo_php); $p++){ ?>
       autocompletar.push('<?php  echo $arreglo_php[$p]; ?>');
     <?php  } ?>
     $("#p_scnt").autocomplete({ 
       source: autocompletar
     });
  });
</script>


	<div class="h_title"><a href="?modulo=arriendos"> Volver a Arriendos </a> > Generar Arriendo </div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="name">Seleccione Cliente / Ingrese Rut  <span class="red">(*)</span></label>
						<input id="c_rut_text" name="c_rut" type="text" size="30" value="<?php  echo $_GET['c_rut']; ?>"></div>	

					<div class="element">
						<label for="name">Seleccione Patente / Ingrese Patente  <span class="red">(*)</span></label>
						<div id="p_scents"><label for="p_scnts"><input type="text" id="p_scnt" size="30" name="v_patente[]" value="<?php  echo $_GET['v_patente']; ?>" /></label><a href="#" id="addScnt"> + Otro Vehiculo</a></div>  

					

					</div>

					<div class="element">
						<label for="name">Fecha Inicial / Hora Inicial <span class="red">(*)</span></label>
						<input id="fecha_inicio" name="fecha_inicio" value="Fecha Inicial" type="text" size="40"><div class="gldp-default"></div> / 							<input id="hora_inicio" name="hora_inicio" value="Hora Inicial" type="text" size="40"><div class="gldp-default"></div> 
					</div>

					<div class="element">
						<label for="name">Fecha de Termino / Hora Termino <span class="red">(*)</span></label>
						<input id="fecha_fin" name="fecha_fin" value="Fecha Final" type="text" size="40"><div class="gldp-default"></div> / 							<input id="hora_fin" name="hora_fin" value="Hora Final" type="text" size="40"><div class="gldp-default"></div> 
					</div>						
					<div class="element">
						<label for="name">Revision Previa (Vehiculo)<span class="red">(*)</span></label>
						<select name="revision_previa">
						<option value="">Seleccione una Opcion</option>						
						<option value="Normal">Normal: Sin Detalles</option>
						<option value="Minimo">Regular: Con Detalles minimos</option>
						<option value="Grave">Mal: Con Detalles Graves</option>
				</select> 
					</div>	


					<div class="entry">
						<button type="submit" name="arriendos_ingreso" class="add">Generar Arriendo</button>
					</div>
				</form>


<?php 
}
?>
