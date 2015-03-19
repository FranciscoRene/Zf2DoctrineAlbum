<? require("config.inc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php  echo $titulo; ?></title>
<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
	<h1>Sistema de Gestión - Rent a Car esCARes</h1><br>
			<div class="full_w">
				<form action="home.php" method="post">
					<label for="login">Usuario:</label>
					<input id="login" name="login" class="text" />
					<label for="pass">Contraseña:</label>
					<input id="pass" name="password" type="password" class="text" />
					<div class="sep"></div>
					<button type="submit" class="ok">Login</button> <a class="button" href="">Salir</a>
				</form>
			</div>
			<div class="footer">Sistema de Administración</div>
		</div>
	</div>
</div>

</body>
</html>
