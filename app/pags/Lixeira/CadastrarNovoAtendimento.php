<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tAtendenteC   	= $_SESSION["LOGINUSER"];
	$tNomeC 	  	= $_POST['Nome'];
	$tEmailC      	= trim($_POST['Email']);
	$tTelefoneC 	= $_POST['Telefone'];
	$tTelefone2C 	= $_POST['Telefone2'];
	$tMidiaC 	  	= $_POST['Midia'];
	$tFilialC 	  	= $_POST['Filial'];
	$tMeioC 	  	= $_POST['MeioAtendimento'];
	$tEncontrouEmC 	= $_POST['OndeEncontrou'];
	$tObsC 			= addslashes($_POST['Observacao']);
	$tStatus 		= $_POST['Status'];

	$IDAtend 		= $_SESSION["IDUSER"];

	$tData      	= date("Y-m-d");
	$tDataHora      = date("Y-m-d H:i:s");

		$tCampos = "Atendente,Nome,Email,Telefone,Telefone2,Midia,Filial,MeioAtendimento,Encontrou_Em,Observacao,Status,ID_Atend,Data,DataHora";
		$tValues = "'$tAtendenteC','$tNomeC','$tEmailC','$tTelefoneC','$tTelefone2C','$tMidiaC','$tFilialC','$tMeioC','$tEncontrouEmC','$tObsC','$tStatus','$IDAtend','$tData','$tDataHora'";
				
		$tSql = $tPdo->prepare("INSERT INTO spa_atendimentos ({$tCampos}) VALUES ({$tValues})");
		$tSql ->execute();

		if($tSql == TRUE){ $tMensagem = CADASTROATENDIMENTOSUCESSO;} else{ $tMensagem = CADASTROATENDIMENTOERRO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="card">

    <form method="post" action="?controle=CadastrarNovoAtendimento" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
				Cadastrar Novo Atendimento
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        		<?php if(isset($tMensagem)){ echo $tMensagem;}?>

	            <div class="form-group col-md-6">
	                <label>Nome do Cliente</label>
	                <input type="text" tabindex="1" class="form-control" name="Nome" id="Nome" required>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Tipo de Mídia</label>
	                <select tabindex="4" class="form-control" name="Midia" id="Midia" required>
	                	<option value="b1">HD / SSD</option>
						<option value="b2">RAID / NAS / Storages / VM</option>
						<option value="b3">Cartões de Memória / Pen-Drive</option>
						<option value="b4">Cloud</option>
						<option value="b5">Outras Mídias</option>
						<option value="b6" selected="">Não Informado</option>
	                </select>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>E-Mail</label>
	                <input type="email" tabindex="2" placeholder="" class="form-control" name="Email" id="Email">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Origem do Atendimento</label>
	                <select tabindex="5" class="form-control" name="Filial" id="Filial" required>
	                	<option value="">Selecione uma Opção</option>
	                	<option value="São Paulo">São Paulo</option>
	                	<option value="Brasil">Brasil</option>
	                </select>
	        	</div>

	        	<div class="form-group col-md-6">
	                <label>Telefone</label>
	                <input type="text" tabindex="3" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" class="form-control" name="Telefone" id="Telefone">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Meio de Atendimento</label>
	                <select tabindex="6" class="form-control" name="MeioAtendimento" id="MeioAtendimento" required>
	                	<option value="Chat Online">Chat Online</option>
	                	<option value="Telefone" selected="">Telefone</option>
	                	<option value="Formulário do Site">Formulário do Site</option>
	                </select>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>Telefone 2</label>
	                <input type="text" tabindex="3" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" class="form-control" name="Telefone2" id="Telefone2">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Onde nos encontrou</label>
	                <select type="text" class="form-control" name="OndeEncontrou" id="OndeEncontrou">
	                	<option value="Google">Google</option>
	                	<option value="Facebook">Facebook</option>
	                	<option value="Indicação">Indicação</option>
	                	<option value="Não Informado" selected="">Não Informado</option>
	                </select>
	            </div>

	            <div class="form-group col-md-12">
	                <label>Status de Atendimento</label>
	                <select type="text" class="form-control" name="Status" id="Status">
	                	<option value="Em Aberto">Em Aberto</option>
	                	<option value="Em Analise">Em Analise</option>
	                	<option value="E-Mail Enviado">E-Mail Enviado</option>
	                	<option value="Sem Interesse">Sem Interesse</option>
	                	<option value="Sem Interesse para a Empresa">Sem Interesse para a Empresa</option>
	                	<option value="Sem Contato">Sem Contato</option>
	                	<option value="Pede Urgência">Pede Urgência</option>
	                	<option value="Pretende Enviar">Pretende Enviar</option>
	                	<option value="Ligar Novamente">Ligar Novamente</option>
	                	<option value="Cliente não atende">Cliente não atende</option>
	                	<option value="Abriu OS">Abriu OS</option>
	                </select>
	            </div>

	        	<div class="form-group col-md-12">
	                <label>Observação</label>
	                <textarea type="text" tabindex="7" placeholder="" class="form-control" name="Observacao" id="Observacao"></textarea>
	        	</div>

	        <button type="submit" class="btn btn-success btn-fill btn-wd">Cadastrar Atendimento</button>

        </div>

	</form>

</div>

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
</script>