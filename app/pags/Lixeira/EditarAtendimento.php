<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	$tGet   = decodificarUrl($_GET['CodC']);
  	$tGetC  = $_GET['CodC'];
  	$tSqlEC = $tPdo->prepare("SELECT * FROM spa_atendimentos WHERE ID_C ='{$tGet}'"); 
  	$tSqlEC ->execute();
  
  	$tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);
  	$tArrS  = array("Nome"=>"{$tMC['Nome']}","Email"=>"{$tMC['Email']}","Telefone"=>"{$tMC['Telefone']}","Telefone2"=>"{$tMC['Telefone2']}","Midia"=>"{$tMC['Midia']}","Filial"=>"{$tMC['Filial']}","MeioAtendimento"=>"{$tMC['MeioAtendimento']}","Encontrou_Em"=>"{$tMC['Encontrou_Em']}","Observacao"=>"{$tMC['Observacao']}","Status"=>"{$tMC['Status']}");

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tID        	= $_POST['hidID'];
  	$tIDC       	= $_POST['hidIDC'];
	
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

		$tCampos = "Nome='{$tNomeC}',Email='{$tEmailC}',Telefone='{$tTelefoneC}',Telefone2='{$tTelefone2C}',Midia='{$tMidiaC}',Filial='{$tFilialC}',MeioAtendimento='{$tMeioC}',Encontrou_Em='{$tEncontrouEmC}',Observacao='{$tObsC}',Status='{$tStatus}'";
				
		$tSql = $tPdo->prepare("UPDATE spa_atendimentos SET {$tCampos} WHERE ID_C ='{$tID}'");
		$tSql ->execute();

		if($tSql == TRUE){ $tMensagem = EDITARATENDIMENTOSUCESSO;} else{ $tMensagem = EDITARATENDIMENTOSUCESSO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="card">

    <form method="post" action="?controle=EditarAtendimento&CodC=<?=$tGetC;?>" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Editar dados do Cliente <font color="#FF0000"><?=$tMC['Nome'];?></font>
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        	<?php if(isset($tMensagem)){ echo $tMensagem;}?>
        	
	            <div class="form-group col-md-6">
	                <label>Nome do Cliente</label>
	                <input type="text" class="form-control" name="Nome" id="Nome" value="<?=$tMC['Nome'];?>">
	                <input type="hidden" name="hidIDC" id="hidIDC" value="<?=$tGetC;?>">
	                <input type="hidden" name="hidID" id="hidID" value="<?=$tGet;?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Tipo de Mídia</label>
	                <select class="form-control" name="Midia" id="Midia">
	                	<option value="b1"<?php echo selectBD( 'b1', @$tMC['Midia'] ); ?>>HD / SSD</option>
						<option value="b2"<?php echo selectBD( 'b2', @$tMC['Midia'] ); ?>>RAID / NAS / Storages / VM</option>
						<option value="b3"<?php echo selectBD( 'b3', @$tMC['Midia'] ); ?>>Cartões de Memória / Pen-Drive</option>
						<option value="b4"<?php echo selectBD( 'b4', @$tMC['Midia'] ); ?>>Cloud</option>
						<option value="b5"<?php echo selectBD( 'b5', @$tMC['Midia'] ); ?>>Outras Mídias</option>
						<option value="b6"<?php echo selectBD( 'b6', @$tMC['Midia'] ); ?>>Não Informado</option>
	                </select>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>E-Mail</label>
	                <input type="email" class="form-control" name="Email" id="Email" value="<?=$tMC['Email'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Origem do Atendimento</label>
	                <select tabindex="5" class="form-control" name="Filial" id="Filial">
	                	<option value="São Paulo"<?php echo selectBD( 'São Paulo', @$tMC['Filial'] ); ?>>São Paulo</option>
	                	<option value="Brasil"<?php echo selectBD( 'Brasil', @$tMC['Filial'] ); ?>>Brasil</option>
	                </select>
	        	</div>

	        	<div class="form-group col-md-6">
	                <label>Telefone</label>
	                <input type="text" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" class="form-control" name="Telefone" id="Telefone" value="<?=$tMC['Telefone'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Meio de Atendimento</label>
	                <select class="form-control" name="MeioAtendimento" id="MeioAtendimento">
	                	<option value="Chat Online"<?php echo selectBD( 'Chat Online', @$tMC['MeioAtendimento'] ); ?>>Chat Online</option>
	                	<option value="Telefone"<?php echo selectBD( 'Telefone', @$tMC['MeioAtendimento'] ); ?>>Telefone</option>
	                	<option value="Formulário do Site"<?php echo selectBD( 'Formulário do Site', @$tMC['MeioAtendimento'] ); ?>>Formulário do Site</option>
	                </select>
	        	</div>

	            <div class="form-group col-md-6">
	                <label>Telefone 2</label>
	                <input type="text" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" class="form-control" name="Telefone2" id="Telefone2" value="<?=$tMC['Telefone2'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Onde nos encontrou</label>
	                <select type="text" class="form-control" name="OndeEncontrou" id="OndeEncontrou">
	                	<option value="Google"<?php echo selectBD( 'Google', @$tMC['Encontrou_Em'] ); ?>>Google</option>
	                	<option value="Facebook"<?php echo selectBD( 'Facebook', @$tMC['Encontrou_Em'] ); ?>>Facebook</option>
	                	<option value="Indicação"<?php echo selectBD( 'Indicação', @$tMC['Encontrou_Em'] ); ?>>Indicação</option>
	                	<option value="Não Informado"<?php echo selectBD( 'Não Informado', @$tMC['Encontrou_Em'] ); ?>>Não Informado</option>
	                </select>
	            </div>

	            <div class="form-group col-md-12">
	                <label>Status de Atendimento</label>
	                <select type="text" class="form-control" name="Status" id="Status">
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
	                <label>Observação</label>
	                <textarea type="text" style="height: 200px;" class="form-control" name="Observacao" id="Observacao"><?=$tMC['Observacao'];?></textarea>
	        	</div>

	        	<button type="submit" class="btn btn-success btn-fill btn-wd">Editar Atendimento</button>

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