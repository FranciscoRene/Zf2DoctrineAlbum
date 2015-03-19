<?php
## Identificacion de usuarios en el Sistema
$sesion_name="rentacar";

// Verificamos que los datos del formulario
if (isset($_POST['login']) && isset($_POST['password'])) 
	{
	// Verificamos que exista el Rut ingresado
	$usuario_consulta = mysql_query("SELECT rut_u, pass_u, nom_u,ape_u, perfil_u FROM usuarios WHERE rut_u='".$_POST['login']."'") or die(header ("Location:  $redir?error_login=1"));
	
	// Si existe el Rut
	 if (mysql_num_rows($usuario_consulta) != 0)
	 	 {
		 $login = stripslashes($_POST['login']);
		 $password= $_POST['password'];
		 $usuario_datos = mysql_fetch_array($usuario_consulta);
		 mysql_free_result($usuario_consulta);
	
			// Si el rut es invalido
			if ($login != $usuario_datos['rut_u']) {
			       	header("Location: index.php?id=login&error=1");
				exit;
				}
			// Si el password es invalido
			if ($password != $usuario_datos['pass_u']) {
			        header("Location: index.php?id=login&error=2");
				exit;
				}

	// Si todo está correcto, sigue su funcionamiento

	// Iniciamos sesion y sus variables
	session_start();
	$_SESSION['usuario_login']=$usuario_datos['rut_u'];
	$_SESSION['usuario_nombre']=$usuario_datos['nom_u'];
	$_SESSION['usuario_apellido']=$usuario_datos['ape_u'];
	$_SESSION['usuario_perfil']=$usuario_datos['perfil_u'];

	// Redireccionamos al Home Principal
	header("Location: home.php");
	exit;
    
	   } 
	   else {
	// Si el Rut no Existe
		header("Location: index.php?id=login&error=1");
	        exit;
		}
	} else {
	// Si no proviene del formulario de inicio
	session_start();

	// Si no existe variable destruimos sesion
	if (!$_SESSION['usuario_login'])
	{
		session_start();
		session_destroy();
	}
}
?>
