<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	$tGet   = decodificarUrl($_GET['CodC']);
  	$tGetC  = $_GET['CodC'];
  	$tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'"); 
  	$tSqlEC ->execute();
  
  	$tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$tID        	= $_POST['hidID'];
	  	$tIDC       	= $_POST['hidIDC'];

	  	$tRazaoSocial   = $_POST['txtRazaoSocialC'];
        $tCnpj          = $_POST['txtCnpjC'];

        $tTipoPessoa   	= $_POST['txtTipoPessoaC'];
        $tFilial 		= $_POST['txtFilialC'];
        $tModalidade    = $_POST['txtModalidadeC'];
        
        $tNomeResp 		= $_POST['txtNomeC'];
        $tCPF			= $_POST['txtCPFC'];
        $tTelefone 		= $_POST['txtTelefoneC'];
        $tTelefone2		= $_POST['txtTelefone2C'];
        $tEmail 		= $_POST['txtEmailC'];
        $tDataNasc 		= $_POST['txtDataNascC'];

        $tCEP           = $_POST['cep'];
        $tEstado        = $_POST['uf'];
        $tCidade        = $_POST['cidade'];
        $tBairro        = $_POST['bairro'];
        $tEndereco      = $_POST['rua'];
        $tNumero        = $_POST['Numero'];
        $tComplemento   = $_POST['Complemento'];
        
        $tMarcaEquip    = $_POST['txtMarcaEquipC'];
        $tModeloEquip   = $_POST['txtModeloEquipC'];
        $tSerialEquip   = $_POST['txtSerialEquipC'];
        $tTamanhoEquip  = $_POST['txtTamanhoEquipC'];
        $tInterfaceEquip= $_POST['txtInterfaceEquipC'];

        $tDefeitoEquip  = $_POST['txtDefeitoEquipC'];
        $tPastasArquivos= $_POST['txtPastasArquivosC'];

            $tCampos = "Razao_Social_OS='{$tRazaoSocial}',CNPJ_Cliente_OS='{$tCnpj}',Tipo_Pessoa_OS='{$tTipoPessoa}',Filial_OS='{$tFilial}',Modalidade_OS='{$tModalidade}',Responsavel_OS='{$tNomeResp}',CPF_Resp_OS='{$tCPF}',Telefone_Resp_OS='{$tTelefone}',Telefone2_Resp_OS='{$tTelefone2}',Email_Resp_OS='{$tEmail}',DataNasc_Resp_OS='{$tDataNasc}',CEP_Cliente_OS='{$tCEP}',Estado_Cliente_OS='{$tEstado}',Cidade_Cliente_OS='{$tCidade}',Bairro_Cliente_OS='{$tBairro}',Endereco_Cliente_OS='{$tEndereco}',Numero_Cliente_OS='{$tNumero}',Complemento_Cliente_OS='{$tComplemento}',Marca_Equip_OS='{$tMarcaEquip}',Modelo_Equip_OS='{$tModeloEquip}',Serial_Equip_OS='{$tSerialEquip}',Tamanho_Equip_OS='{$tTamanhoEquip}',Interface_Equip_OS='{$tInterfaceEquip}',Defeito_Equip_OS='{$tDefeitoEquip}',Pastas_Arquivos_OS='{$tPastasArquivos}'";

            $tSql = $tPdo->prepare("UPDATE os_ordens SET {$tCampos} WHERE ID_C ='{$tID}'");
            $tSql ->execute();

		if($tSql == TRUE){ $tMensagem = EDITAROSSUCESSO;} else{ $tMensagem = EDITAROSERRO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<style type="text/css">
.TipoPessoa .Juridica {
	display: none;
}

.TipoPessoa input[value="PJ"]:checked ~ .Juridica {
	display: block;
}
</style>

<div class="card">

    <form method="post" action="?controle=EditarOS">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Editar dados da O.S. de <font color="#FF0000"><?=$tMC['Responsavel_OS'];?></font>
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

			<?php if(isset($tMensagem)){ echo $tMensagem;}?>

	    	<div class="TipoPessoa">

	            <input type="radio" name="txtTipoPessoaC" id="bt1" value="PF"<?php echo ($tMC['Tipo_Pessoa_OS'] == "PF") ? "checked" : null; ?>>
	            <label for="bt1"> Pessoa Física</label>

	            <input type="radio" name="txtTipoPessoaC" id="bt2" value="PJ"<?php echo ($tMC['Tipo_Pessoa_OS'] == "PJ") ? "checked" : null; ?>>
	            <label for="bt2"> Pessoa Jurídica</label>

	            <div class="Juridica">
	                <div class="form-row">

	                    <div class="col-md-6">
	                    	<div class="form-group">
		                        <label>Razão Social:</label>
		                        <input type="text" name="txtRazaoSocialC" id="txtRazaoSocialC" class="form-control" value="<?=$tMC['Razao_Social_OS'];?>">
		                    </div>
		                </div>

	                    <div class="col-md-6">
	                    	<div class="form-group">
		                        <label>CNPJ:</label>
		                        <input type="text" name="txtCnpjC" id="txtCnpjC" class="form-control" onkeyup="mascara(this, mcnp);" value="<?=$tMC['CNPJ_Cliente_OS'];?>">
		                    </div>
		                </div>
	                    
	                </div>
	            </div>

	        </div>

	        <div class="row">

	        	<div class="col-md-12">
		        	<div class="form-group">
			            <hr>
			    	</div>
			    </div>

	            <div class="col-md-6">
	                <div class="form-group">
	                    <label>Filial:</label>
						<select type="text" name="txtFilialC" id="txtFilialC" class="form-control" required>
							<option value="">Selecione uma Opção</option>
							<option value="SP"<?php echo selectBD( 'SP', @$tMC['Filial_OS'] ); ?>>São Paulo</option>
							<option value="BR"<?php echo selectBD( 'BR', @$tMC['Filial_OS'] ); ?>>Brasil</option>
						</select>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label>Modalidade</label>
		                <select type="text" class="form-control" name="txtModalidadeC" id="txtModalidadeC">
		                	<option value="urgencia"<?php echo selectBD( 'urgencia', @$tMC['Modalidade_OS'] ); ?>>Urgência</option>
		                	<option value="standard"<?php echo selectBD( 'standard', @$tMC['Modalidade_OS'] ); ?>>Standard</option>
		                </select>
	                </div>
	            </div>

	            <div class="col-md-6">
	                <div class="form-group">
	                    <label>Nome do Responsável</label>
		                <input type="text" class="form-control" name="txtNomeC" id="txtNomeC" value="<?=$tMC['Responsavel_OS'];?>">

		                <input type="hidden" name="hidIDC" id="hidIDC" value="<?=$tGetC;?>">
		                <input type="hidden" name="hidID" id="hidID" value="<?=$tGet;?>">
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label>CPF do Responsável</label>
	        			<input type="text" class="form-control" name="txtCPFC" id="txtCPFC" onkeyup="mascara(this, mcpf);" value="<?=$tMC['CPF_Resp_OS'];?>">
	                </div>
	            </div>

	            <div class="col-md-6">
	            	<div class="form-group">
		                <label>Telefone</label>
		                <input type="text" class="form-control" name="txtTelefoneC" id="txtTelefoneC" onkeyup="mascara(this, mtel);" value="<?=$tMC['Telefone_Resp_OS'];?>">
		            </div>
		        </div>

	            <div class="col-md-6">
	            	<div class="form-group">
		                <label>Telefone 2</label>
		                <input type="text" class="form-control" name="txtTelefone2C" id="txtTelefone2C" onkeyup="mascara(this, mtel);" value="<?=$tMC['Telefone2_Resp_OS'];?>">
		            </div>
	        	</div>

	            <div class="col-md-6">
	            	<div class="form-group">
		                <label>E-Mail</label>
		                <input type="email" class="form-control" name="txtEmailC" id="txtEmailC" value="<?=$tMC['Email_Resp_OS'];?>">
		            </div>
		        </div>

	            <div class="col-md-6">
	            	<div class="form-group">
		                <label>Data de Nascimento</label>
		                <input type="text" class="form-control" name="txtDataNascC" id="txtDataNascC" onkeyup="mascara(this, mdat);" value="<?=$tMC['DataNasc_Resp_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-12">
		        	<div class="form-group">
			            <hr>
			    	</div>
			    </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>CEP</label>
		                <input type="text" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);" value="<?=$tMC['CEP_Cliente_OS'];?>">
		        	</div>
		        </div>

		        <div class="col-md-6">
		        	<div class="form-group">
		        		<label>Estado</label>
		                <input type="text" class="form-control" name="uf" id="uf" value="<?=$tMC['Estado_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Cidade</label>
		                <input type="text" class="form-control" name="cidade" id="cidade" value="<?=$tMC['Cidade_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Bairro</label>
		                <input type="text" class="form-control" name="bairro" id="bairro" value="<?=$tMC['Bairro_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Endereço</label>
		                <input type="text" class="form-control" name="rua" id="rua" value="<?=$tMC['Endereco_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Numero</label>
		                <input type="text" class="form-control" name="Numero" id="Numero" value="<?=$tMC['Numero_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Complemento</label>
		                <input type="text" class="form-control" name="Complemento" id="Complemento" value="<?=$tMC['Complemento_Cliente_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-12">
		        	<div class="form-group">
			            <hr>
			    	</div>
			    </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Marca</label>
		                <input type="text" class="form-control" name="txtMarcaEquipC" id="txtMarcaEquipC" value="<?=$tMC['Marca_Equip_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Modelo</label>
		                <input type="text" class="form-control" name="txtModeloEquipC" id="txtModeloEquipC" value="<?=$tMC['Modelo_Equip_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Tamanho</label>
		                <input type="text" class="form-control" name="txtTamanhoEquipC" id="txtTamanhoEquipC" value="<?=$tMC['Tamanho_Equip_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Interface</label>
		                <input type="text" class="form-control" name="txtInterfaceEquipC" id="txtInterfaceEquipC" value="<?=$tMC['Interface_Equip_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Serial</label>
		                <input type="text" class="form-control" name="txtSerialEquipC" id="txtSerialEquipC" value="<?=$tMC['Serial_Equip_OS'];?>">
		        	</div>
		        </div>

	        	<div class="col-md-12">
		        	<div class="form-group">
			            <hr>
			    	</div>
			    </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Defeito</label>
		                <textarea type="text" class="form-control" name="txtDefeitoEquipC" id="txtDefeitoEquipC" rows="4"><?=$tMC['Defeito_Equip_OS'];?></textarea>
		        	</div>
		        </div>

	        	<div class="col-md-6">
	        		<div class="form-group">
		        		<label>Pastas e Arquivos a Recuperar</label>
		                <textarea type="text" class="form-control" name="txtPastasArquivosC" id="txtPastasArquivosC" rows="4"><?=$tMC['Pastas_Arquivos_OS'];?></textarea>
		        	</div>
	            </div>

	        	<div class="col-md-12">
	            	<button type="submit" class="btn btn-success btn-fill btn-wd">Editar Ordem de Serviço</button>
	            </div>
	            
	            <div class="clearfix"></div>

	    	</div>
    	</div>
	</form>

</div>


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