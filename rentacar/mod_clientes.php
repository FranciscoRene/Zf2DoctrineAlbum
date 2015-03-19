<?php 

/*
#######################################
MODULO: CLIENTES
#######################################
*/

if(!$_GET['opcion'])
	{		
?>
<div class="h_title">Clientes > </div>
<div id="box_home_icono">
			<ul>
			<li><a href="?modulo=clientes&opcion=agregar"><img src="img/iconos/add_cliente.png" width="128" hight="128"><h3>Agregar Cliente</h3></a></li>
			<li><a href="?modulo=clientes&opcion=buscar"><img src="img/iconos/buscar.png" width="128" hight="128"><h3>Buscar Clientes</h3></a></li>
			<li><a href="?modulo=clientes&opcion=listar"><img src="img/iconos/todo.png" width="128" hight="128"><h3>Listar Clientes</h3></a></li>
			</ul>
		</div>
<?php 
/*
#######################################
SUB-MODULO: LISTAR CLIENTES
#######################################
*/

}
if ($_GET['opcion'] == "listar") {
?>
	<div class="h_title"><a href="?modulo=clientes"> Volver a Clientes </a> > Listado de Clientes </div>
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="clientes">
		<input type="hidden" name="opcion" value="listar">
		<input id="busqueda" name="c_busqueda" size="30">
		<button type="submit" class="entry">Buscar Cliente</button>					
	</form>
<?php 
    if ($_GET['c_busqueda'])
        $busqueda = $_GET['c_busqueda'];
    if ($_GET['c_item'])
        $item = $_GET['c_item'];
    Listar_Clientes("nom_c", "asc", $busqueda, $item);
    
}
?>



<?php 
/*
#######################################
SUB-MODULO: AGREGAR CLIENTES
#######################################
*/

if ($_GET['opcion'] == "agregar") {
?>


	<div class="h_title"><a href="?modulo=clientes"> Volver a Clientes </a> > Agregar Nuevo Cliente </div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="name">Nombre <span class="red">(requerido)</span></label>
						<input id="c_nom" name="c_nom" class="text ok">
					</div>
					<div class="element">
						<label for="name">Apellido <span class="red">(requerido)</span></label>
						<input id="c_ape" name="c_ape" class="text ok">
					</div>
					<div class="element">
						<label for="name">RUT <span class="red">(requerido)</span></label>
						<input id="c_rut" name="c_rut" class="text ok">Ejemplo: 12.345.678-9
					</div>
					<div class="element">
						<label for="name">Correo Electronico <span class="red">(requerido)</span></label>
						<input id="c_email" type="email" name="c_email" class="text ok">Ejemplo: ana@hotmail.com
					</div>
					<div class="element">
						<label for="name">Edad <span class="red">(requerido)</span></label>
						<input id="c_edad" maxlength="2" name="c_edad" class="text ok">
					</div>
					<div class="element">
						<label for="name">Telefono <span class="red">(requerido)</span></label>
						<input id="c_tel" name="c_tel" class="text ok">
					</div>
					<div class="element">
						<label for="name">Direccion <span class="red">(requerido)</span></label>
						<input id="c_dir" name="c_dir" class="text ok">
					</div>

					<div class="entry">
						<button type="submit" name="clientes_ingreso" class="add">Agregar Cliente</button>
					</div>
				</form>


<?php 
}

/*
#######################################
SUB-MODULO: BUSQUEDA CLIENTES
#######################################
*/

if ($_GET['opcion'] == "buscar") {
?>

	<div class="h_title"><a href="?modulo=clientes"> Volver a Clientes </a> > Busqueda de Clientes </div>
				
	<form action="home.php" method="GET">
		<input type="hidden" name="modulo" value="clientes">
		<input type="hidden" name="opcion" value="listar">
		<div class="element">
			<label for="item">Seleccione Item <span class="red">(requerido)</span></label>
			<select name="c_item" class="entry">
				<option value="rut_c">RUT</option>
				<option value="nom_c">Nombre</option>
				<option value="ape_c">Apellido</option>
				<option value="email_c">Correo Electronico</option>
			</select>					
		</div>
		<div class="element">
			<label for="name">Ingrese Busqueda <span class="red">(requerido)</span></label>
			<input name="c_busqueda" size="50"><button type="submit" class="entry">Buscar</button>					
		</div>
	
	</form>

<?php 
}
?>


<?php 
/*
#######################################
SUB-MODULO: EDITAR CLIENTES
#######################################
*/

if ($_GET['opcion'] == "editar") {
    $c_rut = trim($_GET['rut_c']);
    $r = mysql_query("select * from clientes where rut_c = '$c_rut'");
    $datos = mysql_fetch_array($r);
    
?>
	<div class="h_title"><a href="?modulo=clientes"> Volver a Clientes </a> > Editar Cliente </div>
				<form action="validar.php" method="post">
				<input type="hidden" name="tipo" value="editar">

					<div class="element">
						<label for="name">RUT : <?php  echo $datos['rut_c']; ?></label>
						<input id="c_rut" type="hidden" name="c_rut" class="text ok" value="<?php  echo $datos['rut_c'];?>">
					</div>

					<div class="element">
						<label for="name">Nombre <span class="red">(requerido)</span></label>
						<input id="c_nom" name="c_nom" class="text ok" value="<?php  echo $datos['nom_c']; ?>">
					</div>
					<div class="element">
						<label for="name">Apellido <span class="red">(requerido)</span></label>
						<input id="c_ape" name="c_ape" class="text ok" value="<?php  echo $datos['ape_c']; ?>">
					</div>
					
					<div class="element">
						<label for="name">Correo Electronico <span class="red">(requerido)</span></label>
						<input id="c_email" type="email" name="c_email" class="text ok" value="<?php  echo $datos['email_c']; ?>">
					</div>
					<div class="element">
						<label for="name">Edad <span class="red">(requerido)</span></label>
						<input id="c_edad" name="c_edad" class="text ok" maxlength="2" value="<?php  echo $datos['edad_c']; ?>">
					</div>
					<div class="element">
						<label for="name">Telefono <span class="red">(requerido)</span></label>
						<input id="c_tel" name="c_tel" class="text ok" value="<?php  echo $datos['fono_c']; ?>">
					</div>
					<div class="element">
						<label for="name">Direccion <span class="red">(requerido)</span></label>
						<input id="c_dir" name="c_dir" class="text ok" value="<?php  echo $datos['dir_c']; ?>">
					</div>

					<div class="entry">
						<button type="submit" name="clientes_ingreso" class="add">Modificar Datos</button>
					</div>
				</form>

<?php 
}
?>
