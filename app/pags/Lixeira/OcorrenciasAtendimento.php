<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");

	$tGet   = decodificarUrl($_GET['CodC']);
  	$tGetC  = $_GET['CodC'];

  	$tSqlEC = $tPdo->prepare("SELECT * FROM spa_atendimentos WHERE ID_C ='{$tGet}'"); 
	$tSqlEC ->execute();
  	
  	$tMC	= $tSqlEC->fetch(PDO::FETCH_ASSOC);

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tIDClienteC 	= $_POST['hidIDC'];
	$tAtendenteC   	= $_SESSION["LOGINUSER"];

	$tObservacaoC 	= $_POST['Observacao'];
	$tStatusC 		= $_POST['Status'];

	$tData      	= date("Y-m-d");
	$tHora      = date("H:i:s");

		$tCampos = "ID_Cliente,Atendente,Observacao,Status,Data,Hora";
		$tValues = "'$tIDClienteC','$tAtendenteC','$tObservacaoC','$tStatusC','$tData','$tHora'";
				
		$tSql = $tPdo->prepare("INSERT INTO spa_ocorrencias ({$tCampos}) VALUES ({$tValues})");

		$tUpdateCampos = "Status='{$tStatusC}'";
		$tUpdateSql = $tPdo->prepare("UPDATE spa_atendimentos SET {$tUpdateCampos} WHERE ID_C ='{$tIDClienteC}'");

		$tSql ->execute();
		$tUpdateSql ->execute();

		if($tSql == TRUE){ $tMensagem = CADASTROOCORRENCIAATENDIMENTOSUCESSO;} else{ $tMensagem = CADASTROOCORRENCIAATENDIMENTOERRO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="row">

<div class="col-md-6">

<div class="card">

    <form method="post" action="?controle=OcorrenciasAtendimento" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Inserir Nova Ocorrência
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        		<?php if(isset($tMensagem)){ echo $tMensagem;}?>

	            <div class="form-group col-md-12">
	                <label>Atendente</label>
	                <input type="text" tabindex="1" class="form-control" name="Nome" id="Nome" value="<?php echo $_SESSION["LOGINUSER"]; ?>" readonly>
    				<input type="hidden" name="hidIDC" id="hidIDC" value="<?=$tGet;?>">
	            </div>

				<div class="form-group col-md-12">
	                <label>Status da Ocorrência</label>
	                <select type="text" class="form-control" name="Status" id="Status">
	                	<option value=""<?php echo selectBD( '', @$tMC['Status'] ); ?>>Selecione uma Opção</option>
						<option value="Em Aberto"<?php echo selectBD( 'Em Aberto', @$tMC['Status'] ); ?>>Em Aberto</option>
	                	<option value="Em Analise"<?php echo selectBD( 'Em Analise', @$tMC['Status'] ); ?>>Em Analise</option>
	                	<option value="E-Mail Enviado"<?php echo selectBD( 'E-Mail Enviado', @$tMC['Status'] ); ?>>E-Mail Enviado</option>
	                	<option value="Sem Interesse"<?php echo selectBD( 'Sem Interesse', @$tMC['Status'] ); ?>>Sem Interesse</option>
	                	<option value="Sem Interesse para a Empresa"<?php echo selectBD( 'Sem Interesse para a Empresa', @$tMC['Status'] ); ?>>Sem Interesse para a Empresa</option>
	                	<option value="Sem Contato"<?php echo selectBD( 'Sem Contato', @$tMC['Status'] ); ?>>Sem Contato</option>
	                	<option value="Pede Urgência"<?php echo selectBD( 'Pede Urgência', @$tMC['Status'] ); ?>>Pede Urgência</option>
	                	<option value="Pretende Enviar"<?php echo selectBD( 'Pretende Enviar', @$tMC['Status'] ); ?>>Pretende Enviar</option>
	                	<option value="Ligar Novamente"<?php echo selectBD( 'Ligar Novamente', @$tMC['Status'] ); ?>>Ligar Novamente</option>
	                	<option value="Cliente não atende"<?php echo selectBD( 'Cliente não atende', @$tMC['Status'] ); ?>>Cliente não atende</option>
	                	<option value="Abriu OS"<?php echo selectBD( 'Abriu OS', @$tMC['Status'] ); ?>>Abriu OS</option>

	                </select>
	            </div>

	            <div class="form-group col-md-12">
	                <label>Observação da Ocorrência</label>
	                <textarea type="text" class="form-control" name="Observacao" id="Observacao" required></textarea>
	            </div>	            

	        <button type="submit" class="btn btn-success btn-fill btn-wd">Inserir Ocorrência</button>

        </div>

	</form>

</div>

</div>

<div class="col-md-6">

<div class="card">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Histórico de Ocorrências
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        	<table width="100%" class="table table-striped">
		    	<thead>
			        <tr>
			         	<th>Atendente</th>
			        	<th>Ocorrencias</th>
			        	<th>Status</th>
			        	<th>Data/Hora</th>
			        </tr>
		      	</thead>
		      	
		      	<tbody>
			
				<?php

					// Código que define os dados para exibição nas tabelas
					require_once("includes/ConnDatabase.php");
				   
					$tQuantidade = 50;
					$tPagina     = (isset ($_GET['pg'])) ? (int)$_GET['pg'] :1;
					$tIniciar    = ($tQuantidade * $tPagina) - $tQuantidade;

					$tGet   = decodificarUrl($_GET['CodC']);

					$tSql = $tPdo->prepare("SELECT * FROM spa_ocorrencias WHERE ID_Cliente='{$tGet}' ORDER BY ID_C DESC LIMIT $tIniciar, $tQuantidade");
					$tSql ->execute();

				  	while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

			            //Faz o explode da Data e transforma do formato US para o formato BR
			            $data = $tMC['Data'];
			            $data_nova = explode("-",$data);

						echo "
							<tr>
								<td>{$tMC['Atendente']}</td>
								<td>{$tMC['Observacao']}</td>
								<td>{$tMC['Status']}</td>
								<td>$data_nova[2]/$data_nova[1]/$data_nova[0] às {$tMC['Hora']}</td>
							</tr>
						";
					
					}

		        ?>
		      </tbody>
		    </table>

		</div>

</div>

</div>

</div>

<div class="row">
	<div class="col-md-12">

<div class="card">

		<?php

			require_once("includes/ConnDatabase.php");

			$tGet   = decodificarUrl($_GET['CodC']);
			$tGetC  = $_GET['CodC'];
			$tSqlEC = $tPdo->prepare("SELECT * FROM spa_atendimentos WHERE ID_C ='{$tGet}'"); 
			$tSqlEC ->execute();
			
			$tMC	= $tSqlEC->fetch(PDO::FETCH_ASSOC);

			switch($tMC['Midia']) {
	            case b1: $tTipo = "HD / SSD";                           break;  
	            case b2: $tTipo = "RAID / NAS / Storages / VM";         break;
	            case b3: $tTipo = "Cartões de Memória / Pen-Drive";     break;
	            case b4: $tTipo = "Cloud";                              break;
	            case b5: $tTipo = "Outras Mídias";                      break;
	            case b6: $tTipo = "Não Informado";                      break;
	        }

		?>

		<div class="card-header">
		    <h4 class="card-title">
				<div class="col-md-8">
		    		Visualização de Dados do Cliente <font color="#FF0000"><?=$tMC['Nome'];?></font>
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

	            <div class="form-group col-md-6">
	                <label>Nome do Cliente</label>
	                <input type="text" class="form-control" value="<?=$tMC['Nome'];?>" readonly>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Tipo de Mídia</label>
	                <input type="text" class="form-control" value="<?=$tTipo?>" readonly>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>E-Mail</label>
	                <input type="text" class="form-control" value="<?=$tMC['Email'];?>" readonly>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Origem do Atendimento</label>
	                <input type="text" class="form-control" value="<?=$tMC['Filial'];?>" readonly>
	        	</div>

	        	<div class="form-group col-md-6">
	                <label>Telefone</label>
	                <input type="text" class="form-control" value="<?=$tMC['Telefone'];?>" readonly>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Meio de Atendimento</label>
	                <input type="text" class="form-control" value="<?=$tMC['MeioAtendimento'];?>" readonly>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>Telefone 2</label>
	                <input type="text" class="form-control" value="<?=$tMC['Telefone2'];?>" readonly>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Onde nos encontrou</label>
	                <input type="text" class="form-control" value="<?=$tMC['Encontrou_Em'];?>" readonly>
	            </div>

	            <div class="form-group col-md-12">
	                <label>Status de Atendimento</label>
	                <input type="text" class="form-control" value="<?=$tMC['Status'];?>" readonly>
	            </div>

	        	<div class="form-group col-md-12">
	                <label>Observação</label>
	                <textarea type="text" class="form-control" style="height: 200px;" readonly><?=$tMC['Observacao'];?></textarea>
	        	</div>

	        	<a>.</a>

        </div>

	</div>
</div>

</div>