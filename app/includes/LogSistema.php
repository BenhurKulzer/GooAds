<?php

	// Código "PHP" que cria os log's de informação no sistema

	function LogSistema($tMsg,$tc) {
		$tMensagem = $tMsg;
		$tIp       = $_SERVER['REMOTE_ADDR']; 
		$tHora     = date('H:i:s'); 
		$tData     = date("d-m-Y"); 
		$tConta    = $tc;
		$tUsuario  = $_SESSION['LOGINUSER'];
		$tDepto    = $_SESSION['DEPTOUSER'];
		$tArquivo  = "logs/Logs_$tData.txt"; 				
		$tGravar   = "[$tIp][$tData][$tHora][$tUsuario]> $tMensagem > $tConta\r\n"; 

		$tAcao     = fopen("$tArquivo", "a+b"); 
		fwrite($tAcao, $tGravar); 
		fclose($tAcao);
	
	}
	
?>