<?php
/*
///////////////////////////////////////////////////////////////////
// ###################################
// LIBRERIAS PRINCIPALES
// ###################################
////////////////////////////////////////////////////////////////////
*/ 
require("db.inc.php");

require("funciones.inc.php");

require("config.inc.php");

require("auth.inc.php");


// Verificamos que exista una sesion 

if ($_SESSION['usuario_login']) {

/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO CLIENTES #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: VALIDAR FORMULARIO CLIENTES / INGRESO, MODIFICACION
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if(isset($_POST['clientes_ingreso'])){

	$c_nom = trim(ucfirst($_POST['c_nom']));
	$c_ape = trim(ucfirst($_POST['c_ape']));
	$c_rut = trim($_POST['c_rut']);
	$c_email = trim($_POST['c_email']);
	$c_edad = trim($_POST['c_edad']);
	$c_tel = trim($_POST['c_tel']);
	$c_dir = trim($_POST['c_dir']);


	$r = mysql_query("select * from clientes where rut_c = '$c_rut'");
	$resultado = mysql_num_rows($r);
	if($resultado){
			Mensaje_Javascript("Error: El RUT ya se encuentra registrado.","home.php?modulo=clientes&opcion=agregar");
			exit();
	}

	if(!Validar_Rut($c_rut))
		{
		Mensaje_Javascript("Error: Rut Inválido","home.php?modulo=clientes&opcion=agregar");
		exit();
		}

	if(!Validar_Email($c_email))
		{
		Mensaje_Javascript("Error: Email Inválido","home.php?modulo=clientes&opcion=agregar");
		exit();
		}

	if(!$c_nom || !$c_ape || !$c_rut || !$c_email || !$c_tel || !$c_dir || !$c_edad)
		Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=clientes&opcion=agregar");
	else {
		if(!$_POST['tipo']) // SI NO EXISTE TIPO: INGRESO NORMAL DEL FORMULARIO
			{
			mysql_query("INSERT INTO clientes (nom_c,ape_c,rut_c,email_c,edad_c,fono_c,dir_c) values ('$c_nom','$c_ape','$c_rut','$c_email','$c_edad','$c_tel','$c_dir')");
			Mensaje_Javascript("Nuevo Cliente incorporado correctamente.","home.php?modulo=clientes&opcion=listar");
			} 
			else { // SI EXISTE TIPO: MODIFICACION DE LOS DATOS
			$rut_c = $_GET['rut_c'];
			mysql_query("UPDATE clientes SET nom_c='$c_nom' , ape_c ='$c_ape', email_c='$c_email', edad_c='$c_edad', fono_c ='$c_tel',dir_c='$c_dir' WHERE rut_c ='$c_rut'");
			Mensaje_Javascript("Datos del cliente modificados correctamente.","home.php?modulo=clientes&opcion=listar");
			}

		}

	}

/* 
////////////////////////////////////////////////////////////////////
// ##################################################
// SUB-MODULO: ELIMINAR CLIENTE
// ##################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="clientes" && $_GET['opcion']=="eliminar"){

	if($_GET['rut_c']){
		$rut_c = trim($_GET['rut_c']);
		mysql_query("DELETE from clientes where rut_c = '$rut_c'");
		$url = $_SERVER['HTTP_REFERER'];
		Mensaje_Javascript("Cliente eliminado correctamente",$url);
	} else {
		Mensaje_Javascript("Cliente NO eliminado.",$url);
			}

}


/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO VEHICULOS #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/


/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: VALIDAR FORMULARIO VEHICULOS / INGRESO, MODIFICACION
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if(isset($_POST['vehiculos_ingreso'])){
	
	$v_patente = trim(strtoupper($_POST['v_patente']));
	$v_marca = trim(ucfirst($_POST['v_marca']));
	$v_modelo = trim(ucfirst($_POST['v_modelo']));
	$v_color = trim($_POST['v_color']);
	$v_combustible = trim($_POST['v_combustible']);
	$v_cilindrada = trim($_POST['v_cilindrada']);
	$v_pasajeros = trim($_POST['v_pasajeros']);
	$v_valor = trim($_POST['v_valor']);
	$v_imagen = $_FILES["v_imagen"]["name"];

	foreach ($_POST['v_otras'] as $v_otras) // VERIFICAR
			$cadena .= $v_otras. " ";

	$r = mysql_query("select * from vehiculos where patente = '$v_patente'");
	$resultado = mysql_num_rows($r);
	if($resultado){
			Mensaje_Javascript("Error: Esta Patente ya se encuentra registrada.","home.php?modulo=vehiculos&opcion=agregar");
			exit();
	}

	if(!$v_patente || !$v_marca || !$v_modelo || !$v_valor || !$v_pasajeros || !$v_combustible)
			Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=vehiculos&opcion=agregar");
	else {
		if(!$_POST['tipo']) // SI NO EXISTE: INGRESO NORMAL POR FORMULARIO
			{
			move_uploaded_file($_FILES["v_imagen"]["tmp_name"],"img/vehiculos/".$_FILES["v_imagen"]["name"]);

			mysql_query("INSERT INTO vehiculos (patente,marca,modelo,color,combustible,cilindrada,num_pasajeros,valor_arriendo,imagen,otras,estado) values ('$v_patente','$v_marca','$v_modelo','$v_color','$v_combustible','$v_cilindrada','$v_pasajeros','$v_valor','$v_imagen','$cadena','NO')");
			Mensaje_Javascript("Nuevo Vehiculo incorporado correctamente.","home.php?modulo=vehiculos&opcion=listar");
			} 
			else { // SI EXISTE : MODIFICACION DE DATOS
			$rut_c = $_GET['rut_c'];
			mysql_query("UPDATE clientes SET nom_c='$c_nom' , ape_c ='$c_ape', email_c='$c_email', edad_c='$c_edad', fono_c ='$c_tel',dir_c='$c_dir' WHERE rut_c ='$c_rut'");
			Mensaje_Javascript("Datos del vehiculo modificados correctamente.","home.php?modulo=vehiculos&opcion=listar");
			}

		}

	}

/* 
////////////////////////////////////////////////////////////////////
// ##################################################
// SUB-MODULO: ELIMINAR VEHICULO
// ##################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="vehiculos" && $_GET['opcion']=="eliminar"){

	if($_GET['v_patente']){
		$patente = trim($_GET['v_patente']);
		mysql_query("DELETE from vehiculos where patente = '$patente'");
		$url = $_SERVER['HTTP_REFERER'];
		Mensaje_Javascript("Vehiculo eliminado correctamente",$url);
	} else {
		Mensaje_Javascript("Vehiculo NO eliminado.",$url);
			}

}

/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO SERVICIO TENICOS #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/


/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: VALIDAR FORMULARIO SERVICIOS TECNICOS / INGRESO
// #################################################################
////////////////////////////////////////////////////////////////////
*/


if(isset($_POST['proveedores_ingreso'])){
	
	$serv_nom = trim(ucfirst($_POST['serv_nom']));
	$serv_rut = trim($_POST['serv_rut']);
	$serv_email = trim($_POST['serv_email']);
	$serv_tel = trim($_POST['serv_tel']);
	$serv_dir = trim($_POST['serv_dir']);
	$serv_item = trim(ucfirst($_POST['serv_item']));
	$serv_representante = trim(ucfirst($_POST['serv_representante']));

	if(!$serv_nom|| !$serv_rut || !$serv_email || !$serv_tel || !$serv_dir)
		Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=serv_tecnico&opcion=agregar");
	else {
			mysql_query("INSERT INTO servicios_tecnicos (rut_st,nom_st,dir_st,email_st,fono_st,representante_st,item_st) values ('$serv_rut','$serv_nom','$serv_dir','$serv_email','$serv_tel','$serv_representante','$serv_item')");
		Mensaje_Javascript("Proveedor de Servicio Tecnico registrado correctamente.","home.php?modulo=serv_tecnico&opcion=listar");
			} 


	}
/* 
////////////////////////////////////////////////////////////////////
// ##################################################
// SUB-MODULO: ELIMINAR SERVICIO TECNICO
// ##################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="serv_tecnico" && $_GET['opcion']=="eliminar"){

	if($_GET['rut_st']){
		$rut = trim($_GET['rut_st']);


	$r = mysql_query("select * from mantenciones where servicios_tecnicos_rut_st = '$rut'");
	$resultado = mysql_num_rows($r);
	if($resultado){
			Mensaje_Javascript("Error: No se puede eliminar debido a que se encuentra asociado a una Mantencion.","home.php?modulo=serv_tecnico&opcion=listar");
			exit();
	}

		mysql_query("DELETE from servicios_tecnicos where rut_st = '$rut'");
		$url = $_SERVER['HTTP_REFERER'];
		Mensaje_Javascript("Proveedor de Servicio Tecnico eliminado correctamente",$url);
	} else {
		Mensaje_Javascript("Proveedor de Servicio Tecnico NO eliminado.",$url);
			}

}


/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO ARRIENDOS #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: VALIDAR FORMULARIO ARRIENDOS / INGRESO
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if(isset($_POST['arriendos_ingreso'])){
	
	$rut_cliente = trim($_POST['c_rut']);
	$patente = trim(strtoupper($_POST['v_patente']));
	$fecha_inicio = trim($_POST['fecha_inicio']);
	$hora_inicio = trim($_POST['hora_inicio']);
	$fecha_fin = trim($_POST['fecha_fin']);
	$hora_fin = trim($_POST['hora_fin']);
	$estado_revision = trim($_POST['revision_previa']);

	$rut_usuario = $_SESSION['usuario_login']; // RUT USUARIO SISTEMA

	

	if($rut_cliente && $_POST[v_patente][0] && $fecha_inicio && $fecha_fin && $hora_inicio && $hora_fin && $rut_usuario && $estado_revision)
	{

	// VERIFICAMOS LA EXISTENCIA DEL RUT
	$r = mysql_query("select * from clientes where rut_c = '$rut_cliente'");
	$resultado = mysql_num_rows($r);
	if(!$resultado){
			Mensaje_Javascript("Error: Este usuario no esta registrado en el sistema.","home.php?modulo=arriendos&opcion=agregar");
			exit();
	}


	// VERIFICAMOS QUE LOS VEHICULOS INGRESADOS NO SE ENCUENTREN ARRENDADOS EN LAS FECHAS SOLICITADAS
	foreach ($_POST['v_patente'] as $patente) {

	// VERIFICAMOS QUE LA PATENTE EXISTA EN LA DB	

	$rve = mysql_query("select * from vehiculos where patente = '$patente'");
	$res = mysql_num_rows($rve);
	if(!$res){
			Mensaje_Javascript("Error: Esta patente ($patente) no esta registrada en el sistema.","home.php?modulo=arriendos&opcion=agregar");
			exit();
	}

	// VERIFICAMOS SI EXISTE YA UN ARRIENDO DE LA PATENTE 
	$consulta=mysql_query("SELECT * FROM contratos_arriendos arriendos, detalle_de_contrato detalle WHERE detalle.vehiculos_patente='$patente' AND detalle.contratos_arriendos_folio = arriendos.folio AND arriendos.estado='NO' AND NOT((arriendos.f_inicio >'$fecha_inicio'  AND arriendos.f_inicio >'$fecha_fin') OR (arriendos.f_fin < '$fecha_inicio'  AND arriendos.f_fin < '$fecha_fin'))");

	$t = mysql_num_rows($consulta);
	if($t){
		Mensaje_Javascript("Error: El vehiculo $patente se encuentra reservado en esa fecha. Intente con otra.","javascript:history.back(1)");
		exit();
		}
	


	}


	// INSERTAR CONTRATOS_ARRIENDO
	mysql_query("INSERT INTO contratos_arriendos (estado,f_inicio,f_fin,h_inicio,h_fin,clientes_rut_c,usuarios_rut_u) values ('NO','$fecha_inicio','$fecha_fin','$hora_inicio','$hora_fin','$rut_cliente','$rut_usuario')");

	// OBTENER ULTIMO ID INSERTADO (FOLIO ARRIENDO)
	$folio=mysql_insert_id();

	// REGISTRAMOS REVISION PREVIA
	$tipo_revision = "previa";
	mysql_query("INSERT INTO revisiones (rev_type,estado_r,fecha,contratos_arriendos_folio) values ('$tipo_revision','$estado_revision','$fecha_inicio','$folio')");


	// RECORREMOS TODAS LAS PATENTES INGRESADAS
	foreach ($_POST['v_patente'] as $patente) {
		
		// OBTENEMOS EL VALOR ARRIENDO DEL VEHICULO
		$r = mysql_query("select valor_arriendo,patente from vehiculos where patente = '$patente'");	
		$datos=mysql_fetch_array($r);
		$valor_arriendo = $datos[valor_arriendo];
	
		// REGISTRAMOS ARRIENDOS
		mysql_query("INSERT INTO detalle_de_contrato (valor_por_auto,contratos_arriendos_folio,vehiculos_patente) values ('$valor_arriendo','$folio','$patente')");	
		mysql_query("UPDATE vehiculos SET estado='SI' where patente='$patente'");

		}
	// MENSAJE Y VAMOS AL DETALLE DE ARRIENDOS
	Mensaje_Javascript("Arriendo Generado correctamente.","home.php?modulo=detalle_arriendo&folio=$folio");

	} else 
		Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=arriendos&opcion=agregar");
	}

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: ELIMINAR ARRIENDO
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="arriendos" && $_GET['opcion']=="eliminar"){
	
	if($_GET['folio']){
		$folio = trim($_GET['folio']);
		mysql_query("DELETE from revisiones where contratos_arriendos_folio = '$folio'");
		mysql_query("DELETE from detalle_de_contrato where contratos_arriendos_folio = '$folio'");
		mysql_query("DELETE from contratos_arriendos where folio = '$folio'");
		Mensaje_Javascript("Arriendo Eliminado correctamente.","home.php?modulo=arriendos&opcion=listar");
		} else {
			Mensaje_Javascript("Arriendo NO eliminado.","home.php?modulo=arriendos?opcion=listar");
			}

}
/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: CAMBIAR ESTADO ARRIENDO (PAGADO | NO PAGADO)
// #################################################################
////////////////////////////////////////////////////////////////////
*/
if(isset($_POST['modificar_estado_pago'])){
// ES ABAJO EN REGISTRAR REVISIOn
	$estado = $_POST['estado'];
	$folio = $_POST['folio'];

	if(!$estado)
		Mensaje_Javascript("Error: Debe seleccionar una opcion valida.","home.php?modulo=detalle_arriendo&folio=$folio");		
	else {	
	mysql_query("UPDATE contratos_arriendos SET estado='$estado' where folio='$folio'");
	Mensaje_Javascript("Arriendo modificado correctamente","home.php?modulo=detalle_arriendo&folio=$folio");
	}
}

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: REGISTRAR POST REVISION
// #################################################################
////////////////////////////////////////////////////////////////////
*/
if(isset($_POST['registrar_post_revision'])){

	$estado_revision = $_POST['revision'];
	$patente = strtoupper($_POST['patente']);

	$folio = $_POST['folio'];
	$tipo_revision = "post";
	$fecha = date("Y-m-d");

	foreach ($_POST['patente'] as $patente) {
		mysql_query("UPDATE vehiculos SET estado='NO' where patente='$patente'");
		echo $patente;
	}

	if(!$estado_revision)
		Mensaje_Javascript("Error: Debe seleccionar una opcion valida.","home.php?modulo=detalle_arriendo&folio=$folio");		
	else {	
	mysql_query("INSERT INTO revisiones (rev_type,estado_r,fecha,contratos_arriendos_folio) values ('$tipo_revision','$estado_revision','$fecha','$folio')");

		

	Mensaje_Javascript("Post-Revision registrada correctamente.","home.php?modulo=detalle_arriendo&folio=$folio");
	}
}



/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO MANTENCIONES #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: INGRESAR MANTENCION VEHICULO
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if(isset($_POST['mantenciones_ingreso'])){

	$patente = trim(strtoupper($_POST['mant_patente']));
	$serv_rut = trim($_POST['serv_rut']);
	$fecha = trim($_POST['mant_fecha']);
	$valor = trim($_POST['mant_valor']);
	$desc = trim(ucfirst($_POST['mant_desc']));
	
	// VERIFICAMOS QUE EXISTA LA PATENTE
	$r = mysql_query("select * from vehiculos where patente = '$patente'");
	$resultado = mysql_num_rows($r);
		if(!$resultado){
				Mensaje_Javascript("Error: Esta Patente no se encuentra registrada.","home.php?modulo=mantenciones&opcion=agregar");
				exit();
		}

	// VERIFICAMOS QUE EXISTA EL RUT DEL SERVICIO TECNICO
	$r = mysql_query("select * from servicios_tecnicos where rut_st = '$serv_rut'");
	$resultado = mysql_num_rows($r);
		if(!$resultado){
				Mensaje_Javascript("Error: Este Proveedor de Servicio Tecnico no se encuentra registrado.","home.php?modulo=mantenciones&opcion=agregar");
				exit();
		}

	if($patente && $serv_rut && $fecha && $valor && $desc){
		Mensaje_Javascript("Mantencion registrada correctamente.","home.php?modulo=mantenciones&opcion=listar");
		mysql_query("INSERT INTO mantenciones (costo,fecha,descripcion,vehiculos_patente,servicios_tecnicos_rut_st) values ('$valor','$fecha','$desc','$patente','$serv_rut')");
	} else {
		Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=mantenciones&opcion=agregar");
		}

}

/* 
////////////////////////////////////////////////////////////////////
// ##################################################
// SUB-MODULO: ELIMINAR MANTENCION
// ##################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="mantenciones" && $_GET['opcion']=="eliminar"){

	if($_GET['id']){
		$id_mantencion = trim($_GET['id']);
		mysql_query("DELETE from mantenciones where id = '$id_mantencion'");
		$url = $_SERVER['HTTP_REFERER'];
		Mensaje_Javascript("Mantencion eliminada correctamente",$url);
	} else {
		Mensaje_Javascript("Mantencion NO eliminada.",$url);
			}

}

/* 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
// 
// #################### MODULO CLIENTES #####################
// 
// 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

/*
////////////////////////////////////////////////////////////////////
// #################################################################
// SUB-MODULO: VALIDAR FORMULARIO CLIENTES / INGRESO, MODIFICACION
// #################################################################
////////////////////////////////////////////////////////////////////
*/

if(isset($_POST['usuarios_ingreso'])){

	$u_nom = trim(ucfirst($_POST['u_nom']));
	$u_ape = trim(ucfirst($_POST['u_ape']));
	$u_pass = trim($_POST['u_pass']);
	$u_rut = trim($_POST['u_rut']);
	$u_email = trim($_POST['u_email']);
	$u_edad = trim($_POST['u_edad']);
	$u_tel = trim($_POST['u_tel']);
	$u_dir = trim($_POST['u_dir']);
	$u_perfil = trim($_POST['u_perfil']);


	$r = mysql_query("select * from usuarios where rut_u = '$u_rut'");
	$resultado = mysql_num_rows($r);
	if($resultado){
			Mensaje_Javascript("Error: El RUT ya se encuentra registrado.","home.php?modulo=usuarios&opcion=agregar");
			exit();
	}

	if(!Validar_Rut($u_rut))
		{
		Mensaje_Javascript("Error: Rut Inválido","home.php?modulo=usuarios&opcion=agregar");
		exit();
		}

	if(!Validar_Email($u_email))
		{
		Mensaje_Javascript("Error: Email Inválido","home.php?modulo=usuarios&opcion=agregar");
		exit();
		}

	if(!$u_nom || !$u_ape || !$u_rut || !$u_email || !$u_tel || !$u_dir || !$u_edad || !$u_pass)
		Mensaje_Javascript("Error: Debe completar todos los campos requeridos.","home.php?modulo=usuarios&opcion=agregar");
	else {

			mysql_query("INSERT INTO usuarios (nom_u,ape_u,rut_u,email_u,edad_u,fono_u,dir_u,perfil_u,pass_u) values ('$u_nom','$u_ape','$u_rut','$u_email','$u_edad','$u_tel','$u_dir','$u_perfil','$u_pass')");
			Mensaje_Javascript("Nuevo Usuario incorporado correctamente.","home.php?modulo=usuarios&opcion=listar");

		}

	}


/* 
////////////////////////////////////////////////////////////////////
// ##################################################
// SUB-MODULO: ELIMINAR USUARIO
// ##################################################
////////////////////////////////////////////////////////////////////
*/

if($_GET['modulo']=="usuarios" && $_GET['opcion']=="eliminar"){

	if($_GET['rut_u']){
		$rut_u = trim($_GET['rut_u']);
		mysql_query("DELETE * from usuarios where rut_u = '$rut_u'");
		$url = $_SERVER['HTTP_REFERER'];
		Mensaje_Javascript("Usuario eliminado correctamente",$url);
	} else {
		Mensaje_Javascript("Usuario NO eliminado.",$url);
			}

}

} else {

echo "Error: Debe iniciar sesion.";

}

?>
