<?php
	
	$endereco 	= $_SERVER ['REQUEST_URI'];

	$Controle 	= explode("=", $endereco);
	$Arquivo 	= explode("&", $Controle[1]);

	if ($Arquivo[0]=='OrdemDeServicoGeral') {
		echo '

			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li class="active"><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>

		';
	} elseif ($Arquivo[0]=='OrdemDeServicoFotos') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoFinanceiro') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoOcorrencias') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoComercial') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoTecnica') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoLogistica') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} elseif ($Arquivo[0]=='OrdemDeServicoSolicitacoes') {
		echo '
		
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

				<li><a href="?controle=OrdemDeServicoGeral&CodC='.$_GET['CodC'].'">Informações</a></li>
				<li><a href="?controle=OrdemDeServicoFotos&CodC='.$_GET['CodC'].'">Fotos</a></li>
				<li><a href="?controle=OrdemDeServicoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a></li>
				<li><a href="?controle=OrdemDeServicoOcorrencias&CodC='.$_GET['CodC'].'">Ocorrências</a></li>
				<li><a href="?controle=OrdemDeServicoComercial&CodC='.$_GET['CodC'].'">Comercial</a></li>
				<li><a href="?controle=OrdemDeServicoTecnica&CodC='.$_GET['CodC'].'">Técnica</a></li>
				<li><a href="?controle=OrdemDeServicoLogistica&CodC='.$_GET['CodC'].'">Logística</a></li>
				<li class="active"><a href="?controle=OrdemDeServicoSolicitacoes&CodC='.$_GET['CodC'].'">Solicitações</a></li>

			</ul>
		';
	} else {
		echo '
			<ul class="nav nav-tabs" id="myTab" role="tablist">
  
			  	<li class="nav-item">
			    	<a class="nav-link active" href="?controle=MinhaSolicitacaoGeral&CodC='.$_GET['CodC'].'">Informações</a>
			  	</li>
			  
			  	<li class="nav-item">
			    	<a class="nav-link" href="?controle=MinhaSolicitacaoFinanceiro&CodC='.$_GET['CodC'].'">Financeiro</a>
			  	</li>
			  
			  	<li class="nav-item">
			    	<a class="nav-link" href="?controle=MinhaSolicitacaoMensagens&CodC='.$_GET['CodC'].'">Solicitações</a>
			  	</li>
			  
			</ul>
		';
	}

?>