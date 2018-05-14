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
							<option value="5">** ATENÇÃO ESPECIAL **</option>
							<option value="20">APROVADO + DATA ENTREGA</option>
							<option value="33">ATENDIMENTO NA UNIDADE</option>
							<option value="45">AUDITORIA ROBERTO</option>
							<option value="1">Acompanhamento Técnico</option>
							<option value="39">CANCELAMENTO OS</option>
							<option value="34">COBRANÇA DE TAXAS</option>
							<option value="41">Cobrança Entrada</option>
							<option value="43">Cobrança Saldo</option>
							<option value="42">Comercial </option>
							<option value="21">Consultoria ATIVA</option>
							<option value="22">Consultoria RECEPTIVA</option>
							<option value="4">Consultoria e Acompanhamento</option>
							<option value="31">DADOS A RECUPERAR ATUALIZADOS</option>
							<option value="16">Email Enviado para Cliente</option>
							<option value="17">Email Recebido do Cliente</option>
							<option value="35">Gravação de Dados (Teste da Gravação)</option>
							<option value="19">Instrução  Diretoria</option>
							<option value="6">LOGISTICA</option>
							<option value="27">Movimentação Acessórios</option>
							<option value="30">Movimentação Acessórios Mídia Gravação</option>
							<option value="28">Movimentação Mídia Gravação</option>
							<option value="2">Movimentação Mídia OS</option>
							<option value="23">NOTA FISCAL ENTRADA ENVIADA AO CLIENTE</option>
							<option value="26">NOTA FISCAL OUTROS</option>
							<option value="24">NOTA FISCAL SALDO ENVIADA AO CLIENTE</option>
							<option value="25">NOTA FISCAL TAXAS</option>
							<option value="40">Negociação </option>
							<option value="0" selected="">Ocorrências Antigas</option>
							<option value="7">Ocorrências Técnicas</option>
							<option value="9">Orçamentos e Valores</option>
							<option value="13">Procedimento P3 Solicitado</option>
							<option value="8">Recebimentos e Financeiro</option>
							<option value="29">Registro Taxas</option>
							<option value="15">Revisão Técnica Finalizada</option>
							<option value="36">SEGURO - OPÇÃO DE ENVIO POR CORREIO</option>
							<option value="32">SENHA DOS DADOS GRAVADOS</option>
							<option value="3">SISTEMA (AUTOMÁTICA)</option>
							<option value="37">SISTEMA SAS (AUTOMATICA)</option>
							<option value="14">STATUS DA OS</option>
							<option value="38">Solicitação Revisão</option>
							<option value="12">Solicitação entre Departamentos</option>
							<option value="44">TESTE DE DADOS</option>
							<option value="18">Valor de devolução em caso de inviabilide</option>
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
                        <button type="submit" class="btn btn-default">Cadastrar Novo Responsável</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>