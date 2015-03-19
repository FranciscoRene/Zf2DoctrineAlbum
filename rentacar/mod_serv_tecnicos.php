<?php  
/*

MODULO PRINCIPAL SERVICIOS TECNICOS
*/

if(!$_GET['opcion'])
{		
?>
<div class="h_title">Servicios Técnicos > </div>
<div id="box_home_icono">
			<ul>
			<li><a href="?modulo=serv_tecnico&opcion=agregar"><img src="img/iconos/add_serv.png" width="128" hight="128"><h3>Agregar Proveedor Serv.Técnico</h3></a></li>
			<li><a href="?modulo=serv_tecnico&opcion=listar"><img src="img/iconos/todo.png" width="128" hight="128"><h3>Listar Proveedor Serv.Técnico</h3></a></li>
			</ul>
		</div>


<?php  
/*

SUB-MODULO: LISTAR SERVICIOS TECNICOS

*/
}
if($_GET['opcion'] == "listar")
	{
?>
	<div class="h_title"><a href="?modulo=serv_tecnico"> Volver a Servicio Tecnico </a> > Listado de Proveedores Servicio Tecnico</div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="serv_tecnico">
		<input type="hidden" name="opcion" value="listar">
		<input id="busqueda" name="serv_busqueda" size="30">
		<button type="submit" class="entry">Buscar Proveedor</button>					
	</form>
<?php  
	if($_GET['serv_busqueda'])
		$busqueda = $_GET['serv_busqueda'];
	if($_GET['serv_item'])
		$item = $_GET['serv_item'];
	Listar_Servicios_Tecnicos("rut_st","asc",$busqueda,$item);
	
	}
?>



<?php 
/*

SUB-MODULO: AGREGAR PROVEEDORES

*/

 if($_GET['opcion'] == "agregar") { ?>


	<div class="h_title"><a href="?modulo=serv_tecnico"> Volver a Servicio Tecnico </a> > Agregar Proveedor Servicio Tecnico</div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="name">Nombre <span class="red">(requerido)</span></label>
						<input id="serv_nom" name="serv_nom" class="text ok">
					</div>
					<div class="element">
						<label for="name">RUT <span class="red">(requerido)</span></label>
						<input id="serv_rut" name="serv_rut" class="text ok">
					</div>
					<div class="element">
						<label for="name">Correo Electronico <span class="red">(requerido)</span></label>
						<input id="serv_email" name="serv_email" class="text ok">
					</div>
					<div class="element">
						<label for="name">Representante <span class="red">(requerido)</span></label>
						<input id="serv_representante" name="serv_representante" class="text ok">
					</div>
					<div class="element">
						<label for="name">Telefono <span class="red">(requerido)</span></label>
						<input id="serv_tel" name="serv_tel" class="text ok">
					</div>
					<div class="element">
						<label for="name">Direccion <span class="red">(requerido)</span></label>
						<input id="serv_dir" name="serv_dir" class="text ok">
					</div>
					<div class="element">
						<label for="name">Item <span class="red">(requerido)</span></label>
						<input id="serv_item" name="serv_item" class="text ok">
					</div>


					<div class="entry">
						<button type="submit" name="proveedores_ingreso" class="add">Agregar Proveedor</button>
					</div>
				</form>


<?php 
}
?>
