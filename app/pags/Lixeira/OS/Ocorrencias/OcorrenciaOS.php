<button type='button' class='btn btn-outline-info marbot10' data-toggle='modal' data-target='#ModalAdicionarOcorrencias'>Adicionar Nova Ocorrência</button>

<div class="well table-responsive">
   
   <table class="table table-striped backfotoos">
     
      <thead>
        
        <tr class="BackTable">

            <th>Adicionado Por</th>
			<th>Descrição</th>
            <th>Tipo</th>
            <th>Data</th>

        </tr>

      </thead>

      <tbody>

	<?php 

		// Código que define os dados para exibição nas tabelas

		require_once("includes/ConnDatabase.php");
			   
			$tQuantidade =20;
			$tPagina     = (isset ($_GET['pg'])) ? (int)$_GET['pg'] :1;
			$tIniciar    = ($tQuantidade * $tPagina) - $tQuantidade;

			  $tSql = $tPdo->prepare("SELECT * FROM os_ocorrencias WHERE ID_Identificacao='{$tGet}' ORDER BY ID_C DESC LIMIT $tIniciar, $tQuantidade");
		  	  $tSql ->execute();

			while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

			  //Faz o explode da Data e transforma do formato US para o formato BR
	          $data = $tMC['Data_Ocorrencia'];
	          $data_nova = explode("-",$data);

	          	switch ($tMC['Tipo_Ocorrencia']) {
                    case 'Sistema (Automática)':
                        $tTipoOcorrencia = 'style="color: red;font-weight: bolder;"';
                        break;
                    
                    default:
                        $tTipoOcorrencia = '';
                        break;
                }

				echo "

					<tr $tTipoOcorrencia>

						<td>{$tMC['Adicionado_Por']}</td>

						<td>{$tMC['Descricao_Ocorrencia']}</td>

						<td>{$tMC['Tipo_Ocorrencia']}</td>

						<td><div style='color:red;'>$data_nova[2]/$data_nova[1]/$data_nova[0]</div> às {$tMC['Hora_Ocorrencia']}</td>

					</tr>

				";
			
		  	}
			
			if (isset($_GET['Acao']) && isset($_GET['CodC'])) {

				$tGet	 = decodificarUrl($_GET['CodC']);
				$tSqlDel = $tPdo->prepare("DELETE FROM os_ocorrencias WHERE ID_C ='{$tGet}'");
				$tSqlDel ->execute();
				
				if($tSqlDel == TRUE) { echo DELETESUCESSO . LogSistema(LOGEXCLUIRCONTA);} else{ echo DELETEERRO;}
			
			}

			$tSqlTotal = $tPdo->prepare("SELECT * FROM os_ocorrencias");
			$tSqlTotal ->execute();
			$tNumTotal = $tSqlTotal->rowCount($tSqlTotal);
			$tTotalPag = ceil($tNumTotal/$tQuantidade);

        ?>
      	</tbody>

    </table>

</div>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!-- PopModal que faz o cadastro do segundo responsável -->
<?php

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];

    require_once("includes/ConnDatabase.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $tAdicionadoPor   = $_SESSION["LOGINUSER"];

	    $tTipo            = $_POST['Tipo'];
	    $tDescricao       = $_POST['Descricao'];

	    $tDataHoraC       = date("Y-m-d H:i:s");
	    $tDataC           = date("Y-m-d");
	    $tHoraC           = date("H:i:s");

            $tCampos = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";
            $tValues = "'$tGet','$tDescricao','$tTipo','$tAdicionadoPor','$tDataHoraC','$tDataC','$tHoraC'";
                
            $tSql = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCampos}) VALUES ({$tValues})");
            $tSql ->execute();
            
            if($tSql == TRUE) {
            	$tMensagem = CADASTROSUCESSO;
            	echo "<meta http-equiv='refresh' content='0'>";
            } else {
            	$tMensagem = CADASTROERRO;
            	echo "<meta http-equiv='refresh' content='0'>";
            }

	}// FIM DO MÉTODO POST

?>
<div class="modal fade" id="ModalAdicionarOcorrencias" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarOcorrencias" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Ocorrência a Ordem de Serviço</h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">
                            
                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Tipo de Ocorrência:</label>
				        <select type="text" name="Tipo" id="Tipo" class="form-control" required>
				        	<optgroup label="*** Atenção Especial ***"></optgroup>
							<option value="Atenção Especial">** ATENÇÃO ESPECIAL **</option>
							<option value="Cancelamento da OS">CANCELAMENTO OS</option>
							<option value="Instrução Diretoria">Instrução  Diretoria</option>
							<option value="Solicitação em Departamentos">Solicitação entre Departamentos</option>

							<optgroup label="Financeiro"></optgroup>
							<option value="Cobrança de Taxas">COBRANÇA DE TAXAS</option>
							<option value="Cobrança Entrada">Cobrança Entrada</option>
							<option value="Cobrança Saldo">Cobrança Saldo</option>

							<optgroup label="Notas Fiscais"></optgroup>
							<option value="Nota Fiscal Entrada Enviada ao Cliente">NOTA FISCAL ENTRADA ENVIADA AO CLIENTE</option>
							<option value="Nota Fiscal Outros">NOTA FISCAL OUTROS</option>
							<option value="Nota Fiscal Saldo Enviado ao Cliente">NOTA FISCAL SALDO ENVIADA AO CLIENTE</option>
							<option value="Nota Fiscal Taxas">NOTA FISCAL TAXAS</option>

							<optgroup label="Comercial"></optgroup>
							<option value="Comercial">Comercial </option>
							<option value="Consultoria Ativa">Consultoria ATIVA</option>
							<option value="Consultoria Receptiva">Consultoria RECEPTIVA</option>
							<option value="Consultoria e Acompanhamento">Consultoria e Acompanhamento</option>
							<option value="E-Mail Enviado para Cliente">Email Enviado para Cliente</option>
							<option value="E-Mail Recebido pelo Cliente">Email Recebido do Cliente</option>
														
							<optgroup label="Laboratório"></optgroup>
							<option value="Ocorrência Técnica">Ocorrências Técnicas</option>
							<option value="Acompanhamento Técnico">Acompanhamento Técnico</option>
							<option value="Revisão Técnica Finalizada">Revisão Técnica Finalizada</option>
							<option value="Auditoria Roberto">AUDITORIA ROBERTO</option>

							<optgroup label="Outros"></optgroup>
							<option value="Logística">Logística</option>
							<option value="Movimentação Acessórios">Movimentação Acessórios</option>
							<option value="Movimentação Acessórios Mídia Gravação">Movimentação Acessórios Mídia Gravação</option>
							<option value="Movimentação Mídia Gravação">Movimentação Mídia Gravação</option>
							<option value="Movimentação Mídia OS">Movimentação Mídia OS</option>
							<option value="Dados a Recuperar">DADOS A RECUPERAR ATUALIZADOS</option>
							<option value="Gravação de Dados">Gravação de Dados (Teste da Gravação)</option>
							<option value="Negociação">Negociação </option>
							<option value="Ocorrência Antiga" selected="">Ocorrências Antigas</option>
							<option value="Aprovado + Data Entrega">APROVADO + DATA ENTREGA</option>
							<option value="Atendimento na Unidade">ATENDIMENTO NA UNIDADE</option>
							<option value="Orçamentos e Valores">Orçamentos e Valores</option>
							<option value="Procedimento P3 Solicitado">Procedimento P3 Solicitado</option>
							<option value="Recebimentos e Financeiro">Recebimentos e Financeiro</option>
							<option value="Registro Taxas">Registro Taxas</option>
							<option value="Seguro - Opção de Envio por Correio">SEGURO - OPÇÃO DE ENVIO POR CORREIO</option>
							<option value="Senha dos Dados Gravados">SENHA DOS DADOS GRAVADOS</option>
							<option value="Sistema (Automático)">SISTEMA (AUTOMÁTICA)</option>
							<option value="Sistema S.A.S (Automático)">SISTEMA SAS (AUTOMATICA)</option>
							<option value="Status da OS">STATUS DA OS</option>
							<option value="Solicitação de Revisão">Solicitação Revisão</option>
							<option value="Teste de Dados">TESTE DE DADOS</option>
							<option value="Valor de Devolução em Caso de Inviabilide">Valor de devolução em caso de inviabilide</option>
						</select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Observação:</label>
                        <textarea type="text" name="Descricao" id="Descricao" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Número da OS:</label>
                        <input type="text" class="form-control" value="<?=$tGet;?>" disabled>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Quem está adicionando?:</label>
                        <input type="text" class="form-control" value="<?=$_SESSION['LOGINUSER'];?>" disabled>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Ocorrência</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>