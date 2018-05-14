<?php

// Código "PHP" que faz a conexão do banco de dados ao sistema.datarecover.com.br/spa

try{
		$tPdo = new PDO("mysql:host=;dbname=","","");
		}catch(PDOExpection $tErro){
		echo $tErro->getCode();	
		}

?>