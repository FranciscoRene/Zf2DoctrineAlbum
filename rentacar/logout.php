<?php 
require("db.inc.php");

require("funciones.inc.php");

require("auth.inc.php");

if($_SESSION['usuario_login']) { 

session_start();
session_unset();
session_destroy();

Header ("Location: index.php?id=login&close=1");

} else {
echo '
	  	<SCRIPT LANGUAGE="javascript">
		location.href = "index.php";
		</SCRIPT>
';
}
?>

