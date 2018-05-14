<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require('includes/ConnDatabase.php');

	$tSql = $tPdo->prepare("SELECT ID_C from os_ordens WHERE Contador='1' ORDER BY ID_C DESC LIMIT 1");
	$tSql ->execute();

	$row  = $tSql->fetch(PDO::FETCH_ASSOC);
	$NumeroOS = $row['ID_C'];

	////////////////////////////////////////////////////////////////////////////////////////////////////

	if ($tModalidade === "urgencia" ) {

		require('PHPMailer_5.2.1/class.phpmailer.php');

		$mail = new PHPMailer(); //instancia a classe
			
		$mail->IsSMTP();
		$mail->SMTPAuth   	= true;
		$mail->SMTPSecure 	= "ssl";
		$mail->Host       	= "smtp.gmail.com";
		$mail->Port      	= 465;

		$mail->FromName 	= "SOS HD - Sistema de Ordens de Servico";
		$mail->Username 	= '';
		$mail->Password 	= '';
		$mail->CharSet 		= 'UTF-8';

		$message   = "<p>Prezado <b>".$tNomeResp."</b>,</p>

		<p>Identificamos a abertura da ordem de serviço Nº <b>".$NumeroOS."</b> a fim de realizar diagnóstico e análise para a tentativa da recuperação dos dados, na qual foi indicada através do formulário a seguinte opção:</p>
		<br>
		<p><li> Diagnóstico de <b>URGÊNCIA</b> (Diagnóstico com Prazo de 6 Horas Úteis).</li></p>
		<br>
		<p>Sendo assim, o valor a ser quitado para o inicio dos procedimentos de diagnóstico totaliza R$ 500,00 (Quinhentos Reais).</p>
		<br>
		<p>Seguem abaixo os dados para depósito:</p>
		<p><b>Banco Itaú</b></p>
		<p>AG: 3099</p>
		<p>C/C: 04241-2</p>
		<p><b>DRS Recuperação de dado – EIRELI</b></p>
		<p>CNPJ: 05.864.238/0001-89</p>

		<p>Guarde bem o número da sua ordem de serviço, pois o mesmo será solicitado sempre que você entrar em contato com nossos atendentes.</p>
		<br>
		<p>Findo o prazo estipulado no diagnóstico contratado, entre em contato através do telefone <a href='tel:1131818799'>(11) 3181 - 8799</a> para receber informações sobre o seu diagnóstico.</p>

		<p>Atenciosamente,</p>
		<br>
		<p>Equipe SOS HD | 2018</p>
		<a href='https://soshdrecuperacaodedados.com.br/'>https://soshdrecuperacaodedados.com.br/ </a>
		<br>
		<br>
		<p>Obs.: Não responda a este email. Gerado automáticamente pelo Sistema de OS.</p>";
		
		$mail->IsHTML(true);
		$mail->Subject 		= 'Agilize o seu diagnóstico e envie o comprovante do pagamento das taxas da OS - '.$NumeroOS.'';//assunto do email
		$mail->AltBody 		= "SOS HD | 2018";
		$mail->CharSet 		= 'UTF-8';

		$mail->Body 		= stripslashes($message);
		#$mail->AddAddress('ti@grupobras.com');//email do destinatario
		$mail->AddAddress($tEmailResp);//email do destinatario
		$mail->AddReplyTo('atendimento@soshd.com.br', 'Atendimento SOS HD');
		
		$mail->Send();

		$mail->IsHTML(true); // send as HTML
	 	
	} else {

		require('PHPMailer_5.2.1/class.phpmailer.php');

		$mail = new PHPMailer(); //instancia a classe
			
		$mail->IsSMTP();
		$mail->SMTPAuth   	= true;
		$mail->SMTPSecure 	= "ssl";
		$mail->Host       	= "smtp.gmail.com";
		$mail->Port      	= 465;

		$mail->FromName 	= "SOS HD - Sistema de Ordens de Servico";
		$mail->Username 	= '';
		$mail->Password 	= '';
		$mail->CharSet 		= 'UTF-8';

		$message   = "<p>Prezado <b>".$tNomeResp."</b>,</p>

		<p>Informamos o recebimento da sua mídia em nosso laboratório sob a ordem de serviço Nº <b>".$NumeroOS."</b>, a fim de realizar diagnóstico e análise para a tentativa da recuperação dos dados.</p>
		<p>Guarde bem o número da sua ordem de serviço, pois o mesmo será solicitado sempre que você entrar em contato com nossos atendentes.</p>
		<br>
		<p>Findo o prazo estipulado no diagnóstico contratado, entre em contato através do telefone <a href='tel:1131818799'>(11) 3181 - 8799</a> para receber informações sobre o seu diagnóstico.</p>
		<p>Atenciosamente,</p>
		<br>
		<p>Equipe SOS HD | 2018</p>
		<a href='https://soshdrecuperacaodedados.com.br/'>https://soshdrecuperacaodedados.com.br/ </a>
		<br>
		<br>
		<p>Obs.: Não responda a este email. Gerado automáticamente pelo Sistema de OS.</p>";
		
		$mail->IsHTML(true);
		$mail->Subject 		= 'Abertura Ordem de Serviço Nº '.$NumeroOS.'';//assunto do email
		$mail->AltBody 		= "SOS HD | 2018";
		$mail->CharSet 		= 'UTF-8';

		$mail->Body 		= stripslashes($message);
		#$mail->AddAddress('ti@grupobras.com');//email do destinatario
		$mail->AddAddress($tEmailResp);//email do destinatario
		$mail->AddReplyTo('atendimento@soshd.com.br', 'Atendimento SOS HD');
		
		$mail->Send();

		$mail->IsHTML(true); // send as HTML

	}

?>