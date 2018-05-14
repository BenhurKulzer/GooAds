<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require("includes/ConnDatabase.php");
	require("includes/LogSistema.php");

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$tAdicionadoPor 		= $_SESSION['LOGINUSER'];

		$tTipoCliente 			= $_POST['txtTipoClienteC'];
		$tFilial                = $_POST['txtFilialC'];
		$tModalidade            = $_POST['txtModalidadeC'];
	
		$tRazaoSocial           = $_POST['txtRazaoSocialC'];
		$tCnpj 		            = $_POST['txtCnpjC'];

		$tNomeResp              = $_POST['txtNomeRespC'];
	    $tCpfResp               = $_POST['txtCpfC'];
	    $tTelefone              = $_POST['Telefone'];
	    $tTelefone2             = $_POST['Telefone2'];
	    $tEmailResp             = $_POST['txtEmailRespC'];
	    $tDataNascimentoC       = $_POST['txtDataNascimentoC'];

		$tCEP                   = $_POST['cep'];
	    $tEstado                = $_POST['uf'];
	    $tCidade                = $_POST['cidade'];
	    $tBairro                = $_POST['bairro'];
	    $tEndereco             	= $_POST['rua'];
	    $tNumero             	= $_POST['txtNumeroC'];
	    $tComplemento           = $_POST['txtComplementoC'];
	    
	    $tMarcaEquip            = $_POST['txtMarcaEquipC'];
	    $tModeloEquip           = $_POST['txtModeloEquipC'];
	    $tSerialEquip           = $_POST['txtSerialEquipC'];
	    $tTamanhoEquip          = $_POST['txtTamanhoEquipC'];
	    $tInterfaceEquip        = $_POST['txtInterfaceEquipC'];

	    $tDefeitoEquip          = $_POST['txtDefeitoEquipC'];
	    $tPastasArquivos        = $_POST['txtPastasArquivosC'];

	    $tDataHoraC             = date("Y-m-d H:i:s");
	    $tDataC                 = date("Y-m-d");
	    $tHoraC                 = date("H:i:s");

    // Função faz o envio do código caso não possua Foto do Agente
        
        if(empty($tTipoCliente) && empty($tFilial) && empty($tModalidade) && empty($tNomeResp) && empty($tCpfResp) && empty($tTelefone) && empty($tEmailResp) && empty($tCEP) && empty($tNumero)){ $tMensagem = CAMPOSVAZIOSOS; } else{

            $tCampos = "AdicionadoPor_OS,Tipo_Pessoa_OS,Filial_OS,Modalidade_OS,Razao_Social_OS,CNPJ_Cliente_OS,Responsavel_OS,CPF_Resp_OS,Telefone_Resp_OS,Telefone2_Resp_OS,Email_Resp_OS,DataNasc_Resp_OS,CEP_Cliente_OS,Estado_Cliente_OS,Cidade_Cliente_OS,Bairro_Cliente_OS,Endereco_Cliente_OS,Numero_Cliente_OS,Complemento_Cliente_OS,Marca_Equip_OS,Modelo_Equip_OS,Serial_Equip_OS,Tamanho_Equip_OS,Interface_Equip_OS,Defeito_Equip_OS,Pastas_Arquivos_OS,Data_Hora_OS,Data_OS,Hora_OS";

            $tValues = "'$tAdicionadoPor','$tTipoCliente','$tFilial','$tModalidade','$tRazaoSocial','$tCnpj','$tNomeResp','$tCpfResp','$tTelefone','$tTelefone2','$tEmailResp','$tDataNascimentoC','$tCEP','$tEstado','$tCidade','$tBairro','$tEndereco','$tNumero','$tComplemento','$tMarcaEquip','$tModeloEquip','$tSerialEquip','$tTamanhoEquip','$tInterfaceEquip','$tDefeitoEquip','$tPastasArquivos','$tDataHoraC','$tDataC','$tHoraC'";

            $tSql = $tPdo->prepare("INSERT INTO os_ordens ({$tCampos}) VALUES ({$tValues})");
			$tSql ->execute();

		if($tSql == TRUE) {
			
			require('Email_AberturaOS.php');

			$tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";

            $tValuesOcorr = "'$NumeroOS','Abertura da Ordem de Serviço','Sistema (Automática)','Sistema DoctorByte','$tDataHoraC','$tDataC','$tHoraC'";

			$tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
			$tSqlOcorr ->execute();

			$tMensagem = CADASTROOSSUCESSO;
		} else { 
			$tMensagem = CADASTROOSERRO;
		}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////
}

?>

<div class="card">

    <form method="post" action="">
        
        <div class="card-header">
		    <h4 class="card-title">
				Cadastrar Nova Ordem Serviço
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        	<?php if(isset($tMensagem)){ echo $tMensagem;}?>

        		<div class="form-group">
        			<div class="row">
						<div class="col-md-3">
							<label>Tipo de Cliente:</label>
							<select type="text" name="txtTipoClienteC" id="txtTipoClienteC" class="form-control" required>
								<option value="">Selecione uma Opção</option>
								<option value="PJ">Pessoa Juridica</option>
								<option value="PF">Pessoa Física</option>
							</select>
						</div>

						<div class="col-md-3">
							<label>Filial:</label>
							<select type="text" name="txtFilialC" id="txtFilialC" class="form-control" required>
								<option value="">Selecione uma Opção</option>
								<option value="SP">São Paulo</option>
								<option value="BR">Brasil</option>
							</select>
						</div>

						<div class="col-md-6">
							<label>Modalidade:</label>
							<select type="text" name="txtModalidadeC" id="txtModalidadeC" class="form-control" required>
								<option value="">Selecione uma Opção</option>
								<option value="standard">Standard - 3 Dias Úteis - (R$ 0,00)</option>
								<option value="urgencia">Urgência - 6 Horas Úteis - (R$ 500,00)</option>
							</select>
						</div>
					</div>
        		</div>

				<!-- Este grupo aqui é exibido apenas se o Tipo de Cliente for = a PJ -->
				<div id="PJ" class="form-group TipoPessoa" style="display:none;">
				<hr>
				
					<div class="row">
						<div class="col-md-6">
							<label>Razão Social / Empresa:</label>
							<input type="text" name="txtRazaoSocialC" id="txtRazaoSocialC" class="form-control" placeholder="Razão Social da Empresa">	
						</div>

						<div class="col-md-6">
							<label>CNPJ:</label>
							<input type="text" name="txtCnpjC" id="txtCnpjC" class="form-control" onkeyup="mascara(this, mcnp);" placeholder="Ex. xx.xxx.xxx/0001-xx">	
						</div>
					</div>
				</div>

				<hr>

				<!-- Grupo de Campos Dados do Responsável pela Ordem de Serviço -->
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Responsável:</label>
							<input type="text" name="txtNomeRespC" id="txtNomeRespC" class="form-control" placeholder="Nome Responsável pela Ordem de Serviço" required>	
						</div>

						<div class="col-md-6">
							<label>CPF:</label>
							<input type="text" name="txtCpfC" id="txtCpfC" class="form-control" onkeyup="mascara(this, mcpf);" placeholder="CPF do Responsável pela Ordem de Serviço" required>	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" placeholder="Ex. (xx) xxxxx-xxxx" required>	
						</div>

						<div class="col-md-6">
							<label>Telefone 2:</label>
							<input type="text" name="Telefone2" id="Telefone2" class="form-control" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" placeholder="Ex. (xx) xxxxx-xxxx">	
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>E-Mail de Contato:</label>
							<input type="email" name="txtEmailRespC" id="txtEmailRespC" class="form-control" placeholder="Email do Responsável pela Ordem de Serviço" required>	
						</div>

						<div class="col-md-6">
							<label>Data de Nascimento:</label>
							<input type="text" name="txtDataNascimentoC" id="txtDataNascimentoC" class="form-control" minlength="10" maxlength="10" onkeyup="mascara(this, mdat);" placeholder="Ex. xx/xx/xxxx">	
						</div>
					</div>
				</div>

				<hr>

				<!-- Grupo de campos relacionado ao Endereço do Cliente -->
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" minlength="8" maxlength="9" onblur="pesquisacep(this.value);" placeholder="Ex. xxxxx-xxx" required>	
						</div>

						<div class="col-md-6">
							<label>Estado:</label>
							<input type="text" name="uf" id="uf" class="form-control" placeholder="Preenchido Automaticamente">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Cidade:</label>
							<input type="text" name="cidade" id="cidade" class="form-control" placeholder="Preenchido Automaticamente">
						</div>

						<div class="col-md-6">
							<label>Bairro:</label>
							<input type="text" name="bairro" id="bairro" class="form-control"  placeholder="Preenchido Automaticamente">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Endereço:</label>
							<input type="text" name="rua" id="rua" class="form-control"  placeholder="Preenchido Automaticamente">
						</div>

						<div class="col-md-6">
							<label>Numero:</label>
							<input type="text" name="Numero" id="Numero" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Complemento:</label>
							<input type="text" name="Complemento" id="Complemento" class="form-control">	
						</div>
					</div>
				</div>

				<hr>

				<!-- Grupo de campos relacionado aos dados da Mídia a ser enviada -->
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Marca:</label>
							<input type="text" name="txtMarcaEquipC" id="txtMarcaEquipC" class="form-control" placeholder="Ex. Samsung, Western Digital, Toshiba...">
						</div>

						<div class="col-md-6">
							<label>Modelo:</label>
							<input type="text" name="txtModeloEquipC" id="txtModeloEquipC" class="form-control">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Serial:</label>
							<input type="text" name="txtSerialEquipC" id="txtSerialEquipC" class="form-control">
						</div>

						<div class="col-md-6">
							<label>Tamanho:</label>
							<input type="text" name="txtTamanhoEquipC" id="txtTamanhoEquipC" class="form-control">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Interface:</label>
							<input type="text" name="txtInterfaceEquipC" id="txtInterfaceEquipC" class="form-control">
						</div>
					</div>
				</div>

				<div class="form-group text-center">
					<hr>
						<label>Defeito / Arquivos Importantes</label>
					<hr>
				</div>

				<!-- Grupo de campos relacionado ao Defeito e Dados a ser recuperados-->
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Defeito:</label>
							<textarea type="text" name="txtDefeitoEquipC" id="txtDefeitoEquipC" class="form-control" rows="3"></textarea>
						</div>

						<div class="col-md-6">
							<label>Pastas e Arquivos a Recuperar:</label>
							<textarea type="text" name="txtPastasArquivosC" id="txtPastasArquivosC" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>

        	</div>

        <div class="card-footer">
	        <div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-wd btn-default btn-fill pull-left">Cadastrar Nova Ordem de Serviço</button>
					</div>
				</div>
			</div>
		</div>

	</form>

</div>

<script type="text/javascript">
var select = document.getElementById("txtTipoClienteC");
var tipopessoa = document.querySelectorAll('.TipoPessoa');

select.onchange = function () {
    for (var i = 0; i < tipopessoa.length; i++) tipopessoa[i].style.display = 'none';
    var divID = select.options[select.selectedIndex].value;
    var div = document.getElementById(divID);
    div.style.display = 'block';
};
</script>

<script type="text/javascript" >

function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value=("");
        document.getElementById('bairro').value=("");
        document.getElementById('cidade').value=("");
        document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('cidade').value=(conteudo.localidade);
        document.getElementById('uf').value=(conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}
    
function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('cidade').value="...";
            document.getElementById('uf').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};

</script>

<script type="text/javascript">
	/* Máscaras ER */
	function mascara(o,f){
	    v_obj=o
	    v_fun=f
	    setTimeout("execmascara()",1)
	}
	function execmascara(){
	    v_obj.value=v_fun(v_obj.value)
	}
	
	function mtel(v){
	    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
	    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
	    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
	    return v;
	}

	function mdat(v){
	    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
	    v=v.replace(/^(\d{2})(\d)/g,"$1/$2"); //Coloca parênteses em volta dos dois primeiros dígitos
	    v=v.replace(/(\d)(\d{4})$/,"$1/$2");    //Coloca hífen entre o quarto e o quinto dígitos
	    return v;
	}

	function mcpf(v){
		v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
	    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
	    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
	    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
	    return v
	}

	function mcnp(v){
	    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
	    v=v.replace(/(\d{2})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
	    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
	    v=v.replace(/(\d{4})(\d{1,2})$/,"/$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
	    return v
	}
</script>