<?php 

/*
#######################################
MODULO: USUARIOS
#######################################
*/

?>

<?php 

/*
#######################################
SUB-MODULO: LISTAR USUARIOS
#######################################
*/


if ($_GET['opcion'] == "listar") {
?>
	<div class="h_title"><a href="#"> Volver a Usuarios </a> > Listado Usuarios </div>
<?php 
    Listar_Usuarios();
    
}
?>



<?php 
/*
#######################################
SUB-MODULO: AGREGAR USUARIOS
#######################################
*/

if ($_GET['opcion'] == "agregar") {
?>


	<div class="h_title"><a href="?modulo=usuarios"> Volver a Usuarios </a> > Agregar Nuevo Usuario de Sistema </div>
				<form action="validar.php" method="post">
					<div class="element">
						<label for="name">Nivel de Acceso <span class="red">(requerido)</span></label>
					<select name="u_perfil">
						<option value="2">Vendedor</option>
						<option value="1">Administrador</option>
				</select>
					</div>
					<div class="element">
						<label for="name">Nombre <span class="red">(requerido)</span></label>
						<input id="c_nom" name="u_nom" class="text ok">
					</div>
					<div class="element">
						<label for="name">Apellido <span class="red">(requerido)</span></label>
						<input id="c_ape" name="u_ape" class="text ok">
					</div>
					<div class="element">
						<label for="name">RUT <span class="red">(requerido)</span></label>
						<input id="c_rut" name="u_rut" class="text ok">Ejemplo: 12.345.678-9
					</div>
					<div class="element">
						<label for="name">Password <span class="red">(requerido)</span></label>
						<input id="c_pass" name="u_pass" type="password" class="text ok">
					</div>
					<div class="element">
						<label for="name">Correo Electronico <span class="red">(requerido)</span></label>
						<input id="c_email" type="email" name="u_email" class="text ok">Ejemplo: ana@hotmail.com
					</div>
					<div class="element">
						<label for="name">Edad <span class="red">(requerido)</span></label>
						<input id="c_edad" maxlength="10" name="u_edad" class="text ok">
					</div>
					<div class="element">
						<label for="name">Telefono <span class="red">(requerido)</span></label>
						<input id="c_tel" name="u_tel" class="text ok">
					</div>
					<div class="element">
						<label for="name">Direccion <span class="red">(requerido)</span></label>
						<input id="c_dir" name="u_dir" class="text ok">
					</div>

					<div class="entry">
						<button type="submit" name="usuarios_ingreso" class="add">Agregar Usuario</button>
					</div>
				</form>


<?php 
}


