<button type='button' class='btn btn-success marbot10' data-toggle='modal' data-target='#ModalAdicionarFoto'>Adicionar Nova Foto</button>

<div class="well table-responsive">
   
   <table class="table table-striped backfotoos">
     
      <thead>
        
        <tr class="BackTable">

            <th>Foto</th>
                        
                <th>Descrição</th>
            
                    <th>ID</th>

                <th>Adicionado Por</th>
            
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

			  $tSql = $tPdo->prepare("SELECT * FROM os_fotos WHERE Numero_OS_Foto='{$tGet}' ORDER BY ID_Foto DESC LIMIT $tIniciar, $tQuantidade");
		  	  $tSql ->execute();

			while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

			  //Faz o explode da Data e transforma do formato US para o formato BR
	          $data = $tMC['Data_Foto'];
	          $data_nova = explode("-",$data);

				echo "

				<tr>

				<td><a href='up_arquivos/FotosOS/{$tMC['Imagem_Foto']}' target='_BLANK' rel='tooltip' title='Exibir Foto/Comprovante'><img class='img-circle' src='/images/foto.png'></img></a></td>

				<td><a style='color: blue;' rel='tooltip' title='Editar Foto/Comprovante'>{$tMC['Descricao_Foto']}</a></td>

				<td>{$tMC['ID_Foto']}</td>

				<td>{$tMC['Adicionado_Por']}</td>

				<td><div style='color:red;'>$data_nova[2]/$data_nova[1]/$data_nova[0]</div> às {$tMC['Hora_Foto']}</td>

				</tr>";
			
		  	}
			
			if (isset($_GET['Acao']) && isset($_GET['CodC'])) {

				$tGet	 = decodificarUrl($_GET['CodC']);
				$tSqlDel = $tPdo->prepare("DELETE FROM os_fotos WHERE ID_C ='{$tGet}'");
				$tSqlDel ->execute();
				
				if($tSqlDel == TRUE) { echo DELETESUCESSO . LogSistema(LOGEXCLUIRCONTA);} else{ echo DELETEERRO;}
			
			}

			$tSqlTotal = $tPdo->prepare("SELECT * FROM os_fotos");
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
        
        $tIDFoto            = $_POST['tIDFoto'];
	    $tDescricao         = $_POST['tDescricao'];
	    $tNumeroOS          = $_POST['tNumeroOS'];
	    $tConta             = $_FILES['filFoto']['name'];

	    $tAdicionadoPor     = $_SESSION["LOGINUSER"];

	    $tDataHoraC         = date("Y-m-d H:i:s");
	    $tDataC             = date("Y-m-d");
	    $tHoraC             = date("H:s:i");

	    // Define para Onde serão Upados os arquivos e o tipo de imagens aceitas pelo input file

        	$tDir    = 'up_arquivos/FotosOS/';
        	$tArray  = array("application/pdf","image/jpeg","image/jpg","image/gif","image/png","image/bmp");

    	// Função faz o envio do código caso possua somente uma foto

        $tPega1     = explode(".",$tConta);
        $tImagemCt  = md5(uniqid(time())) . $tPega1[0];
        $tImagemCt .= "." . $tPega1[1];
        $tUpload1   = $tDir . $tImagemCt;
        
        if(!in_array($_FILES['filFoto']['type'],$tArray)){echo ARQUIVOAVISO;    }
        
        move_uploaded_file($_FILES['filFoto']['tmp_name'], $tUpload1);
        
        $tCampos = "ID_Foto,Descricao_Foto,Numero_OS_Foto,Imagem_Foto,Adicionado_Por,Data_Hora_Foto,Data_Foto,Hora_Foto";
        $tValues = "'$tIDFoto','$tDescricao','$tNumeroOS','$tImagemCt','$tAdicionadoPor','$tDataHoraC','$tDataC','$tHoraC'";
            
        $tSql = $tPdo->prepare("INSERT INTO os_fotos ({$tCampos}) VALUES ({$tValues})");
        $tSql ->execute();

        if($tSql == TRUE) {

        	$tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";

            $tValuesOcorr = "'$tGet','Adicionado Anexo a OS: $tIDFoto','Sistema (Automática)','$tAdicionadoPor','$tDataHoraC','$tDataC','$tHoraC'";

            $tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
            $tSqlOcorr ->execute();

        	$tMensagem = CADASTROSUCESSO;
        	echo "<meta http-equiv='refresh' content='0'>";
        } else {
        	$tMensagem = CADASTROERRO;
        	echo "<meta http-equiv='refresh' content='0'>";
        }

	}// FIM DO MÉTODO POST

?>
<div class="modal fade" id="ModalAdicionarFoto" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarFoto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Anexo a Ordem de Serviço</h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">
                            
                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">ID da Foto:</label>
				        <select type="text" name="tIDFoto" id="tIDFoto" class="form-control" required>
				        
				        <optgroup label="Formulário de Envio de Mídia"></optgroup>
				        
				            <option value="Formulário">01 -  Formulário</option>
				            <option value="Formulário Assinado" selected>02 - Formulário Assinado</option>

				        <optgroup label="Mídia OS"></optgroup>

				            <option value="Chegada Mídia OS Frente">03 - Chegada Mídia OS Frente</option>
				            <option value="Chegada Mídia OS Verso">04 - Chegada Mídia OS Verso</option>
				            <option value="Saída Mídia OS Frente">05 - Saída Mídia OS Frente</option>
				            <option value="Saída Mídia OS Verso">06 - Saída Mídia OS Verso</option>

				        <optgroup label="Acessórios Mídia OS"></optgroup>

				            <option value="Chegada Acessórios Mídia OS Frente">07 - Chegada Acessórios Mídia OS Frente</option>
				            <option value="Chegada Acessórios Mídia OS Verso">08 - Chegada Acessórios Mídia OS Verso</option>
				            <option value="Saída Acessórios Mídia OS Frente">09 - Saída Acessórios Mídia OS Frente</option>
				            <option value="Saída Acessórios Mídia OS Verso">10 - Saída Acessórios Mídia OS Verso</option>

				        <optgroup label="Mídia Gravação OS"></optgroup>

				            <option value="Chegada Mídia Gravação Frente">11 - Chegada Mídia Gravação Frente</option>
				            <option value="Chegada Mídia Gravação Verso">12 - Chegada Mídia Gravação Verso</option>
				            <option value="Saída Mídia Gravação Frente">13 - Saída Mídia Gravação Frente</option>
				            <option value="Saída Mídia Gravação Verso">14 - Saída Mídia Gravação Verso</option>

				        <optgroup label="Acessórios Mídia Gravação OS"></optgroup>

				            <option value="Chegada Acessórios Mídia Gravação Frente">15 - Chegada Acessórios Mídia Gravação Frente</option>
				            <option value="Chegada Acessórios Mídia Gravação Verso">16 - Chegada Acessórios Mídia Gravação Verso</option>
				            <option value="Saída Acessórios Mídia Gravação Frente">17 - Saída Acessórios Mídia Gravação Frente</option>
				            <option value="Saída Acessórios Mídia Gravação Verso">18 - Saída Acessórios Mídia Gravação Verso</option>

				        <optgroup label="Dados Recuperados"></optgroup>

				            <option value="Dados 1">19 - Dados 1</option>
				            <option value="Dados 2">20 - Dados 2</option>

				        <optgroup label="Pagamentos"></optgroup>

				            <option value="Pagamento - Entrada">21 - Pagamento - Entrada</option>
				            <option value="Pagamento - Saldo">22 - Pagamento - Saldo</option>
				            <option value="Pagamento - Taxa Diagnóstico">23 - Pagamento - Taxa Diagnóstico</option>
				            <option value="Pagamento - Outros">24 - Pagamento - OUTROS</option>

				        <optgroup label="Contratos"></optgroup>

				            <option value="Contrato">25 - Contrato</option>
				            <option value="Contrato Assinado">26 - Contrato Assinado</option>
				            <option value="Contrato Extra 1">27 - Contrato Extra 1</option>
				            <option value="Contrato Extra 2">28 - Contrato Extra 2</option>
				        
				        <optgroup label="Pagamentos"></optgroup>
				            
				            <option value="Pagamento - Taxa Remontagem">29 - Pagamento - TAXA Remontagem</option>
				            <option value="Pagamento - Taxa FRETE Mídia OS">30 - Pagamento - TAXA FRETE Mídia OS</option>
				            <option value="Pagamento - Taxa FRETE Mídia Gravação">31 - Pagamento - TAXA FRETE Mídia Gravação</option>

				        <optgroup label="Notas Fiscais"></optgroup>

				            <option value="Nota Fiscal - Taxas">32 - Nota Fiscal - Taxas</option>
				            <option value="Nota Fiscal - Entrada">33 - Nota Fiscal - Entrada</option>
				            <option value="Nota Fiscal - Saldo">34 - Nota Fiscal - Saldo</option>
				            <option value="Nota Fiscal - Mídia Gravação">35 - Nota Fiscal - Mídia Gravação</option>
				            <option value="Nota Fiscal - Remontagem">36 - Nota Fiscal - Remontagem</option>

				        <optgroup label="Outros"></optgroup>

				            <option value="Outras Fotos">37 - Outras Fotos</option>
				            <option value="Orçamento">38 - Orçamento</option>
				            <option value="Autorização de Formatação">39 - Autorização de Formatação</option>

				        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Descrição:</label>
                        <textarea type="text" name="tDescricao" id="tDescricao" class="form-control" required></textarea>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Imagem em Anexo:</label>
                        <input type="file" name="filFoto" id="filFoto" class="form-control" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Número da OS:</label>
                        <input type="text" name="tNumeroOS" id="tNumeroOS" class="form-control" value="<?=$tGet;?>" readonly>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Novo Anexo/Foto</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>