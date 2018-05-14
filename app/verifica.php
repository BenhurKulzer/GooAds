<?php

	// Código "PHP" de verificação de usuario ao fazer login na página
	session_start();

	if(!isset($_SESSION["IDUSER"]) || !isset($_SESSION["LOGINUSER"]) || !isset($_SESSION["NIVELUSER"]) || !isset($_SESSION["FOTOUSER"])) {

	    header("Location: index.php");
	    exit;
	}

?>