<?php

session_destroy();

// Código de logoff do sistema
	require_once("includes/LogSistema.php");
		echo '<meta HTTP-EQUIV = "Refresh" CONTENT = "0; URL = index.php">';
	exit;

?>