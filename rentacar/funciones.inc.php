<?php 

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR CLIENTES
// ###################################
//
// Variables recibidas
//
// $campo: Nombre del campo sobre la cual se  establece el orden de los resultados.
// $order: Tipo de orden: ascendente o descentente.
// $busqueda: Variable que recibe el texto de la busqueda en el caso que exista.
// $campo_busqueda : Nombre del campo sobre el cual se realiza la busqueda.
// $tipo : 0 = Listado ; 1 = Informes
////////////////////////////////////////////////////////////////////////////////////////////

*/

function Listar_Clientes($campo, $order, $busqueda, $campo_busqueda)
{

    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">RUT</th>
	        		<th scope="col">Nombre</th>
				<th scope="col">Apellido</th>
				<th scope="col">Dirección</th>
				<th scope="col">Email</th>
				<th scope="col">Fono</th>
				<th scope="col">Edad</th>
				<th scope="col" style="width: 65px;">Opciones</th>
				</tr>
			</thead>
		';
 
    if (!$order)
        $order = "desc";
    if (!$campo)
        $campo = "ape_c";
    if ($busqueda && !$campo_busqueda)
        $r = mysql_query("select * from clientes where nom_c LIKE '%$busqueda%' or ape_c LIKE '%$busqueda%' or rut_c LIKE '%$busqueda%' or email_c LIKE '%$busqueda%'");
    else if ($busqueda && $campo_busqueda)
        $r = mysql_query("select * from clientes where $campo_busqueda LIKE '%$busqueda%'");
    else
        $r = mysql_query("select * from clientes order by $campo $order");
    
    while ($datos = mysql_fetch_array($r)){
	
        echo '<tbody>
			<tr>
				<td><b>' . $datos[rut_c] . '</b></td>
				<td>' . $datos[nom_c] . '</td>
				<td>' . $datos[ape_c] . '</td>
				<td>' . $datos[dir_c] . '</td>
				<td>' . $datos[email_c] . '</td>
				<td>' . $datos[fono_c] . '</td>
				<td>' . $datos[edad_c] . '</td>

				<td><a href="?modulo=clientes&opcion=editar&rut_c=' . $datos[rut_c] . '" class="table-icon edit" title="Editar Cliente"></a>
					<a href="?modulo=arriendos&opcion=agregar&c_rut=' . $datos[rut_c] . '" class="table-icon archive" title="Generar Arriendo"></a>
					<a href="?modulo=arriendos&opcion=listar&arriendos_busqueda=' . $datos[rut_c] . '" class="table-icon search" title="Arriendos Asociados"></a>
					<a href="validar.php?modulo=clientes&opcion=eliminar&rut_c=' . $datos[rut_c] . '" class="table-icon delete" title="Borrar Cliente"></a>
				</td>

			</tr>
		</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";
    

    echo '<div class="entry">
			<div align="right" style="color:#ccc;font-size:10px;"><img src=img/i_archive.png width=10 height=10> Generar Arriendo / <img src=img/i_delete.png width=10 height=10> Borrar / <img src=img/i_edit.png width=10 height=10> Editar / <img src=img/i_search.png width=10 height=10> Arriendos Asociados</div>
			<div class="sep"></div>
		<a class="button add" href="home.php?modulo=clientes&opcion=agregar">Agregar Otro Cliente</a>
	</div>';
}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR VEHICULOS
// ###################################
//
// 
// 
// $campo: Nombre del campo sobre la cual se  establece el orden de los resultados.
// $order: Tipo de orden: ascendente o descentente.
// $busqueda: Variable que recibe el texto de la busqueda en el caso que exista.
// $campo_busqueda : Nombre del campo sobre el cual se realiza la busqueda.
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Listar_Vehiculos($campo, $order, $busqueda, $campo_busqueda)
{
    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">PATENTE</th>
				<th scope="col">Marca</th>
	        		<th scope="col">Modelo</th>
				<th scope="col">Combustible</th>
				<th scope="col">Cilindrada</th>
				<th scope="col">Estado</th>
				<th scope="col" style="width: 65px;">Modificar</th>
				</tr>
			</thead>
		';
    if (!$order)
        $order = "desc";
    if (!$campo)
        $campo = "ape_c";
    if ($busqueda && !$campo_busqueda)
        $r = mysql_query("select * from vehiculos where patente LIKE '%$busqueda%' or modelo LIKE '%$busqueda%' or marca LIKE '%$busqueda%' or patente LIKE '%$busqueda%'");
    else if ($busqueda && $campo_busqueda)
        $r = mysql_query("select * from vehiculos where $campo_busqueda LIKE '%$busqueda%'");
    else
        $r = mysql_query("select * from vehiculos order by $campo $order");
    
    while ($datos = mysql_fetch_array($r)) {
        echo '<tbody>
				<tr>
					<td><b><a href="detalle_vehiculo.php?patente=&patente='.$datos[patente].'" rel="superbox[iframe]">'. $datos[patente] . '</a></b></td>
					<td>' . $datos[marca] . '</td>
					<td>' . $datos[modelo] . '</td>
					<td>' . $datos[combustible] . '</td>
					<td>' . $datos[cilindrada] . '</td>
					<td>'.Estado_Vehiculo($datos[estado],$datos[patente]). '</td>
					<td><a href="?modulo=vehiculos&opcion=editar&v_patente=' . $datos[patente] . '" class="table-icon edit" title="Editar"></a>
						<a href="?modulo=arriendos&opcion=agregar&v_patente=' . $datos[patente] . '" class="table-icon archive" title="Generar Arriendo"></a>
						<a href="validar.php?modulo=vehiculos&opcion=eliminar&v_patente=' . $datos[patente] . '" class="table-icon delete" title="Eliminar"></a>
						<a href="?modulo=mantenciones&opcion=agregar&v_patente=' . $datos[patente] . '" class="table-icon config" title="Registrar Mantencion"></a>
					</td>
				</tr>
			</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";

    echo '<div class="entry">
		<div align="right" style="color:#ccc;font-size:10px;"><img src=img/i_archive.png width=10 height=10> Generar Arriendo / <img src=img/i_delete.png width=10 height=10> Borrar / <img src=img/i_edit.png width=10 height=10> Editar / <img src=img/i_config.png width=10 height=10> Registrar Mantención</div>
		<div class="sep"></div>
		<a class="button add" href="home.php?modulo=vehiculos&opcion=agregar">Agregar Otro Vehiculo</a>
	</div>';

}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR SERVICIOS TECNICOS
// ###################################
// 
// 
// 
// $campo: Nombre del campo sobre la cual se  establece el orden de los resultados.
// $order: Tipo de orden: ascendente o descentente.
// $busqueda: Variable que recibe el texto de la busqueda en el caso que exista.
// $campo_busqueda : Nombre del campo sobre el cual se realiza la busqueda.
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Listar_Servicios_Tecnicos($campo, $order, $busqueda, $campo_busqueda)
{
    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">RUT</th>
				<th scope="col">Nombre</th>
	        		<th scope="col">Direccion</th>
				<th scope="col">Email</th>
				<th scope="col">Telefono</th>
				<th scope="col">Representante</th>
				<th scope="col">Item</th>
				<th scope="col" style="width: 65px;">Modificar</th>
				</tr>
			</thead>
		';
    if (!$order)
        $order = "desc";
    if (!$campo)
        $campo = "ape_c";
    if ($busqueda && !$campo_busqueda)
        $r = mysql_query("select * from servicios_tecnicos where rut_st LIKE '%$busqueda%' or representante_st LIKE '%$busqueda%' or nom_st LIKE '%$busqueda%'");
    else if ($busqueda && $campo_busqueda)
        $r = mysql_query("select * from servicios_tecnicos where $campo_busqueda LIKE '%$busqueda%'");
    else
        $r = mysql_query("select * from servicios_tecnicos order by $campo $order");
    
    while ($datos = mysql_fetch_array($r)) {
        echo '<tbody>
				<tr>
					<td><b>' . $datos[rut_st] . '</b></td>
					<td>' . $datos[nom_st] . '</td>
					<td>' . $datos[dir_st] . '</td>
					<td>' . $datos[email_st] . '</td>
					<td>' . $datos[fono_st] . '</td>
					<td>' . $datos[representante_st] . '</td>
					<td>' . $datos[item_st] . '</td>
					<td><a href="validar.php?modulo=serv_tecnico&opcion=eliminar&rut_st=' . $datos[rut_st] . '" class="table-icon delete" title="Borrar"></a>
					</td>
				</tr>
			</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";

    echo '<div class="entry">
<div align="right" style="color:#ccc;font-size:10px;"> <img src=img/i_delete.png width=10 height=10> Borrar </div>
			<div class="sep"></div>
			<a class="button add" href="home.php?modulo=serv_tecnico&opcion=agregar">Agregar un Nuevo Proveedor Servicio Tecnico</a>
				</div>';
}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##########################################
// FUNCION SELECT: LISTAR MARCAS DE VEHICULOS
// #########################################
// 
// 
// 
// $seleccionada : Item recibido por el formulario que corresponde al seleccionado desde la base de datos del vehiculo
////////////////////////////////////////////////////////////////////////////////////////////
*/


function Listar_Marcas($seleccionada)
{
    
    echo '<select name="v_marca">';
    
    if ($seleccionada)
        echo '<option value="' . $seleccionada . '">' . $seleccionada . '</option>';
    
    echo '<option value="">Selecciona una Marca</option>    
	<option value="Alfa Romeo">Alfa Romeo</option>
        <option value="B.M.W.">B.M.W.</option>
        <option value="BYD">BYD</option>
       <option value="Changan">Changan</option>
		            <option value="Chery">Chery</option>
		            <option value="Chevrolet">Chevrolet</option>
		            <option value="Chrysler">Chrysler</option>
		            <option value="Citroen">Citroen</option>
		            <option value="DFSK">DFSK</option>
		            <option value="Dodge">Dodge</option>
		            <option value="Fiat">Fiat</option>
		            <option value="Ford">Ford</option>
		            <option value="Geely">Geely</option>
		            <option value="Great Wall">Great Wall</option>
		            <option value="Hafei">Hafei</option>
		            <option value="Hino">Hino</option>
		            <option value="Honda">Honda</option>
		            <option value="Hyundai">Hyundai</option>
		            <option value="Jac">Jac</option>
		            <option value="Jaguar">Jaguar</option>
		            <option value="Jeep">Jeep</option>
		            <option value="Jmc">JMC</option>
		            <option value="Kia Motors">Kia Motors</option>
		            <option value="Land Rover">Land Rover</option>
		            <option value="Mahindra">Mahindra</option>
		            <option value="Mazda">Mazda</option>
		            <option value="Mercedes Benz">Mercedes Benz</option>
		            <option value="Mg">MG</option>
		            <option value="Mini">Mini</option>
		            <option value="Mitsubishi">Mitsubishi</option>
		            <option value="Nissan">Nissan</option>
		            <option value="Peugeot">Peugeot</option>
		            <option value="Porsche">Porsche</option>
		            <option value="Renault">Renault</option>
		            <option value="SAAB">SAAB</option>
		            <option value="Samsung">Samsung</option>
		            <option value="Skoda">Skoda</option>
		            <option value="Ssangyong">Ssangyong</option>
		            <option value="Subaru">Subaru</option>
		            <option value="Suzuki">Suzuki</option>
		            <option value="Tata">Tata</option>
		            <option value="Toyota">Toyota</option>
		            <option value="Volkswagen">Volkswagen</option>
		            <option value="Volvo">Volvo</option>
		            <option value="Yuejin Motors">Yuejin Motors</option>
		            <option value="ZNA Dongfeng">ZNA Dongfeng</option>
		            <option value="Zotye">Zotye</option>
		            <option value="ZX Auto">ZX Auto</option>
		          </select>

';
}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION SELECT: LISTAR COLORES
// ###################################
// 
// Lista los colores disponibles para los vehiculos.
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Listar_Colores()
{
    
    echo '
<select name="v_color">
            <option value="Negro Perla">Negro Perla</option>
            <option value="Blanco Invierno">Blanco Invierno</option>
            <option value="Rojo">Rojo</option>
            <option value="Amarillo">Amarillo</option>
            <option value="Azul Electrico">Azul Electrico</option>
</select>

';
}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR ARRIENDOS
// ###################################
// 
// Variables recibidas
// 
// $campo: Nombre del campo sobre la cual se  establece el orden de los resultados.
// $order: Tipo de orden: ascendente o descentente.
// $busqueda: Variable que recibe el texto de la busqueda en el caso que exista.
// $campo_busqueda : Nombre del campo sobre el cual se realiza la busqueda.
////////////////////////////////////////////////////////////////////////////////////////////
*/



function Listar_Arriendos($campo, $order, $busqueda, $campo_busqueda)
{
    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">N° Folio</th>
				<th scope="col">Cliente</th>
				<th scope="col">Fecha Inicial</th>
				<th scope="col">Fecha Termino</th>
				<th scope="col">Estado Actual</th>

				<th scope="col" style="width: 65px;">Modificar</th>
				</tr>
			</thead>
		';
    if (!$order)
        $order = "asc";
    if (!$campo)
        $campo = "folio";
    if ($busqueda && !$campo_busqueda)
        $r = mysql_query("select * from contratos_arriendos where folio LIKE '%$busqueda%' or f_inicio LIKE '%$busqueda%' or f_fin LIKE '%$busqueda%' or clientes_rut_c LIKE '%$busqueda%'");
    else if ($busqueda && $campo_busqueda)
        $r = mysql_query("select * from contratos_arriendos where $campo_busqueda LIKE '%$busqueda%'");
    else
        $r = mysql_query("select * from contratos_arriendos order by $campo $order");
    
    while ($datos = mysql_fetch_array($r)) {
        echo '<tbody>
				<tr>
					<td><b><a href="?modulo=detalle_arriendo&folio=' . $datos[folio] . '">' . $datos[folio] . '</a></b></td>
					<td>' . $datos[clientes_rut_c] . '</td>
					<td>' . $datos[f_inicio] . ' ' . $datos[h_inicio] . ' </td>
					<td>' . $datos[f_fin] . ' ' . $datos[h_fin] . ' </td>
					<td>'.Estado_Arriendo($datos[estado]). ' </td>
					<td><a href="?modulo=detalle_arriendo&folio=' . $datos[folio] . '" class="table-icon archive" title="Detalles de Arriendo"></a>
						<a href="validar.php?modulo=arriendos&opcion=eliminar&folio=' . $datos[folio] . '" class="table-icon delete" title="Eliminar Arriendo"></a>
					</td>
				</tr>
			</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";



    echo '<div class="entry">
		<div align="right" style="color:#ccc;font-size:10px;"><img src=img/i_archive.png width=10 height=10> Ver Detalles / <img src=img/i_delete.png width=10 height=10> Borrar </div>
			<div class="sep"></div>
			<a class="button add" href="home.php?modulo=arriendos&opcion=agregar">Generar un Nuevo Arriendo</a>
				</div>';
}



/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR PATENTES
// ###################################
// 
// Info: Lista las patentes de todos los vehiculos
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Listar_Patentes()
{
    
    $r = mysql_query("select * from vehiculos order by patente asc");
    echo '<select name="v_patente">
		<option value="" selected>Selecciona Patente</option>';
    while ($datos = mysql_fetch_array($r)) {
        echo '<option name="' . $datos[patente] . '">' . $datos[patente] . '</option>';
    }
    echo '</select>';
}


/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR RUT
// ###################################
//
// Info: Lista los RUT de todos los clientes
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Listar_Rut()
{
    $r = mysql_query("select * from clientes order by nom_c asc");
    echo '<select name="c_rut">
		<option value="" selected>Seleccione Cliente</option>';
    while ($datos = mysql_fetch_array($r)) {
        echo '<option name="' . $datos[rut_c] . '">' . $datos[nom_c] . ' ' . $datos[ape_c] . ' </option>';
    }
    echo '</select>';
}

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: DIFERENCIAS ENTRE 2 FECHAS
// ###################################
// 
// $fecha_principal: Primera fecha.
// $fecha_secundaria: Segunda fecha.
// $obtener: Puede ser: [minutos,horas,dias,semanas]. En este caso se utilizan dias.
// $redondear: Reondea el resultado en caso que sea decimal.
////////////////////////////////////////////////////////////////////////////////////////////
*/

function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener, $redondear)
{
    $f0 = strtotime($fecha_principal);
    $f1 = strtotime($fecha_secundaria);
    if ($f0 && $f1) {
        $tmp = $f1;
        $f1  = $f0;
        $f0  = $tmp;
    }
    $resultado = ($f0 - $f1);
    switch ($obtener) {
        default:
            break;
        case "MINUTOS":
            $resultado = $resultado / 60;
            break;
        case "HORAS":
            $resultado = $resultado / 60 / 60;
            break;
        case "DIAS":
            $resultado = $resultado / 60 / 60 / 24;
            break;
        case "SEMANAS":
            $resultado = $resultado / 60 / 60 / 24 / 7;
            break;
    }
    if ($redondear)
        $resultado = round($resultado);

    if($resultado==0)
	$resultado = 1;

    return $resultado;

}
/*
////////////////////////////////////////////////////////////////////////////////////////////
// ######################################
// FUNCION: VERIFICAR EL ESTADO DEL PAGO
// ######################################
//
// VALORES (SI:PAGADO | NO: NO PAGADO)
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Estado_Arriendo($estado){
	if($estado =="SI")
		$r = "<img src=img/i_ok.png width=12 height=12> Pagado";
	if($estado=="NO")
		$r = "<img src=img/i_warning.png width=12 height=12> No Pagado";
	return($r);
	}

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ######################################
// FUNCION: VERIFICAR EL ESTADO DEL PAGO
// ######################################
// 
// VALORES (SI: EN ARRIENDO | NO: DISPONIBLE)
////////////////////////////////////////////////////////////////////////////////////////////
*/

function Estado_Vehiculo($estado,$patente){
	if($estado =="SI")
		$r = "<a href='home.php?modulo=detalle_arriendo&patente=$patente'>En Arriendo</a>";
	if($estado=="NO")
		$r="Disponible";
	return($r);
	}

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR MANTENCIONES
// ###################################
// 
// Variables recibidas
// 
// $campo: Nombre del campo sobre la cual se  establece el orden de los resultados.
// $order: Tipo de orden: ascendente o descentente.
// $busqueda: Variable que recibe el texto de la busqueda en el caso que exista.
// $campo_busqueda : Nombre del campo sobre el cual se realiza la busqueda.
////////////////////////////////////////////////////////////////////////////////////////////
*/


function Listar_Mantenciones($campo, $order, $busqueda, $campo_busqueda)
{
    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">Fecha</th>
	        		<th scope="col">Patente</th>
				<th scope="col">Servicio Tecnico</th>
	        		<th scope="col">Costo</th>
				<th scope="col">Descripcion</th>
				<th scope="col" style="width: 65px;">Opciones</th>
				</tr>
			</thead>
		';
    if (!$order)
        $order = "desc";
    if (!$campo)
        $campo = "ape_c";
    if ($busqueda && !$campo_busqueda)
        $r = mysql_query("select * from mantenciones where fecha LIKE '%$busqueda%' or vehiculos_patente LIKE '%$busqueda%' or descripcion LIKE '%$busqueda%' or servicios_tecnicos_rut_st LIKE '%$busqueda%'");
    else if ($busqueda && $campo_busqueda)
        $r = mysql_query("select * from mantenciones where $campo_busqueda LIKE '%$busqueda%'");
    else
        $r = mysql_query("select * from mantenciones order by $campo $order");
    
    while ($datos = mysql_fetch_array($r)) {
        echo '<tbody>
				<tr>
					<td><b>' . $datos[fecha] . '</b></td>
					<td>' . $datos[vehiculos_patente] . '</td>
					<td>' . $datos[servicios_tecnicos_rut_st] . '</td>
					<td>$' . $datos[costo] . '</td>
					<td>' . $datos[descripcion] . '</td>
					<td>
						<a href="validar.php?modulo=mantenciones&opcion=eliminar&id=' . $datos[id] . '" class="table-icon delete" title="Borrar"></a>
					</td>
				</tr>
			</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";

    echo '<div class="entry">
		<div align="right" style="color:#ccc;font-size:10px;"><img src=img/i_edit.png width=10 height=10> Editar / <img src=img/i_delete.png width=10 height=10> Borrar</div>
			<div class="sep"></div>
			<a class="button add" href="home.php?modulo=mantenciones&opcion=agregar">Registrar una nueva Mantencion</a>
				</div>';
}

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: AutoCompletar INPUT
// ###################################
// 
// $campo: Nombre del campo que se muestra despues de la busqueda.
// $tabla: Nombre de la tabla donde se realiza la busqueda.
////////////////////////////////////////////////////////////////////////////////////////////
*/

function AutoCompletar($tabla,$campo){

	$sql = "select * from $tabla order by $campo";
	$res = mysql_query($sql);
	$arreglo_php = array();
		if(mysql_num_rows($res)==0)
		   array_push($arreglo_php, "Sin Resultados");
		else{
		  while($palabras = mysql_fetch_array($res)){
			//ASIGNAMOS LOS VALORES DEL CAMPO A UN ARREGLO
		  array_push($arreglo_php, $palabras[$campo]);
		
		  }
	}
	return $arreglo_php;
}
/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: Mensaje JavaScript
// ###################################
// 
// $mensaje: Mensaje a mostrar en evento alert.
// $link: URL de destino.
////////////////////////////////////////////////////////////////////////////////////////////
*/


function Mensaje_Javascript($mensaje,$link){
	echo '
	  	<SCRIPT LANGUAGE="javascript">
		alert("'.$mensaje.'");
		location.href = "'.$link.'";
		</SCRIPT>
	  ';
}

/*
////////////////////////////////////////////////////////////////////////////////////////////
// ##################################
// FUNCION: LISTAR USUARIOS
// ###################################
//
////////////////////////////////////////////////////////////////////////////////////////////

*/

function Listar_Usuarios()
{

    echo '
			<table>
			<thead>
				<tr>
				<th scope="col">RUT</th>
	        		<th scope="col">Nombre</th>
				<th scope="col">Apellido</th>
				<th scope="col">Dirección</th>
				<th scope="col">Email</th>
				<th scope="col">Fono</th>
				<th scope="col">Nivel</th>
				<th scope="col" style="width: 65px;">Opciones</th>
				</tr>
			</thead>
		';
 
    $r = mysql_query("select * from usuarios order by ape_u asc");  
    while ($datos = mysql_fetch_array($r)){
	if($datos[perfil_u] == 1)
		$perfil = 'Administrador';
	else
		$perfil = 'Usuario';

        echo '<tbody>
			<tr>
				<td><b>' . $datos[rut_u] . '</b></td>
				<td>' . $datos[nom_u] . '</td>
				<td>' . $datos[ape_u] . '</td>
				<td>' . $datos[dir_u] . '</td>
				<td>' . $datos[email_u] . '</td>
				<td>' . $datos[fono_u] . '</td>
				<td>' . $perfil . '</td>
				<td><a href="validar.php?modulo=usuarios&opcion=eliminar&rut_u=' . $datos[rut_u] . '" class="table-icon delete" title="Borrar Usuario"></a>
				</td>

			</tr>
		</tbody>
		';
    }
    
    echo '</table>';
    
    if (!mysql_num_rows($r))
        echo "<div class=n_warning><p>Su busqueda no arrojo ningún resultado</p></div>";
    

    echo '<div class="entry">
		<div class="sep"></div>
		<a class="button add" href="home.php?modulo=usuarios&opcion=agregar">Agregar Otro Usuario</a>
	</div>';
}


/*
 * FUNCION: ALERTA DE ARRIENDOS
 * @return devuelve un mensaje de alerta para los arriendos que terminen en un rango de 2 dias.
 *	
 */

function Alerta_Arriendos(){
	
	$fecha_actual = date("Y-m-d");

	$r = mysql_query("SELECT DATEDIFF(f_fin,'$fecha_actual') as dias, folio, f_fin FROM contratos_arriendos WHERE (DATEDIFF(f_fin,'$fecha_actual') IN (0,1,2))");
	$alertas = mysql_num_rows($r);

	echo "$alertas Alerta(s) Encontrada(s)<br><br>";
	
	while($datos = mysql_fetch_array($r)){
		echo '<a href="home.php?modulo=detalle_arriendo&folio='.$datos[folio].'"><img src="img/i_warning.png"> Folio <b>'.$datos[folio].'</b>: Faltan '.$datos[dias].' días.</a> <br><br>';
	}
	if(!mysql_num_rows($r))
		echo "<b>0 Alertas</b>";
	
	}

/* 
 * FUNCION VERIFICAR RUT
 *
*/

function Validar_Rut($r = false){
    if((!$r) or (is_array($r)))
        return false; /* Hace falta el rut */
 
    if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
        return false; /* Era código basura */
 
    if(!((strlen($r) == 8) or (strlen($r) == 9)))
        return false; /* La cantidad de carácteres no es válida. */
 
    $v = strtoupper(substr($r, -1));
    if(!$r = substr($r, 0, -1))
        return false;
 
    if(!((int)$r > 0))
        return false; /* No es un valor numérico */
 
    $x = 2; $s = 0;
    for($i = (strlen($r) - 1); $i >= 0; $i--){
        if($x > 7)
            $x = 2;
        $s += ($r[$i] * $x);
        $x++;
    }
    $dv=11-($s % 11);
    if($dv == 10)
        $dv = 'K';
    if($dv == 11)
        $dv = '0';
    if($dv == $v)
        return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
    return false;
}

/* 
 * FUNCION VERIFICAR EMAIL
 *
*/
function Validar_Email($email){   
  if(eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))   
  return true;   
    else  
  return false;
}

function toMoney($val,$symbol='$',$r=0)
{


    $n = $val; 
    $c = is_float($n) ? 1 : number_format($n,$r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n=number_format(abs($n),$r); 
    $j = (($j = strlen($i)) > 3) ? $j % 3 : 0; 

   return  $symbol.$sign .($j ? substr($i,0, $j) + $t : '').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;

}
?>
