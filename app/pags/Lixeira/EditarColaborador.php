<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	$tGet   = decodificarUrl($_GET['CodC']);
  	$tGetC  = $_GET['CodC'];
  	$tSqlEC = $tPdo->prepare("SELECT * FROM usuarios_colaboradores WHERE ID_USER ='{$tGet}'"); 
  	$tSqlEC ->execute();
  
  	$tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tID        = $_POST['hidID'];
  	$tIDC       = $_POST['hidIDC'];
	
	$tNome 		= $_POST['txtNomeCompletoC'];
	$tSocial 	= $_POST['txtNomeSocialC'];
	$tCpf 		= $_POST['txtCpfC'];
	$tEmail 	= $_POST['txtEmailC'];
	$tNivel 	= $_POST['txtNivelC'];
	$tStatus 	= $_POST['txtStatusC'];

		$tCampos = "NOME_U='{$tNome}',NOME_SOCIAL_U='{$tSocial}',CPF_U='{$tCpf}',EMAIL_U='{$tEmail}',Nivel_U='{$tNivel}',Status_U='{$tStatus}'";
				
		$tSql = $tPdo->prepare("UPDATE usuarios_colaboradores SET {$tCampos} WHERE ID_USER ='{$tID}'");
		$tSql ->execute();

		if($tSql == TRUE){ $tMensagem = EDITARATENDIMENTOSUCESSO;} else{ $tMensagem = EDITARATENDIMENTOSUCESSO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="card">

    <form method="post" action="?controle=EditarColaborador&CodC=<?=$tGetC;?>" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Editar dados do Colaborador <strong class="text-red"><?=$tMC['NOME_SOCIAL_U'];?></strong>
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
	                <label>Nome Completo:</label>
	                <input type="text" name="txtNomeCompletoC" id="txtNomeCompletoC" class="form-control" value="<?=$tMC['NOME_U'];?>">
	                <input type="hidden" name="hidIDC" id="hidIDC" value="<?=$tGetC;?>">
	                <input type="hidden" name="hidID" id="hidID" value="<?=$tGet;?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Nome Social (Usuário):</label>
	                <input type="text" name="txtNomeSocialC" id="txtNomeSocialC" class="form-control" value="<?=$tMC['NOME_SOCIAL_U'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>CPF:</label>
	                <input type="text" name="txtCpfC" id="txtCpfC" class="form-control" value="<?=$tMC['CPF_U'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>E-Mail:</label>
	                <input type="email" name="txtEmailC" id="txtEmailC" class="form-control" value="<?=$tMC['EMAIL_U'];?>">
	            </div>

	            <div class="form-group col-md-6">
	                <label>Nível do Usuário:</label>
	                <select type="text" name="txtNivelC" id="txtNivelC" class="form-control">
	                	<optgroup label="Administrativo"></optgroup>
	                	<option value="1"<?php echo selectBD( '1', @$tMC['Nivel_U'] ); ?>>Administrador</option>
	                	<optgroup label="Colaborador"></optgroup>
	                	<option value="0"<?php echo selectBD( '0', @$tMC['Nivel_U'] ); ?>>Colaborador</option>
	                </select>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Desativar Colaborador:</label>
	                <select type="text" name="txtStatusC" id="txtStatusC" class="form-control">
	                	<optgroup label="Manter Ativo"></optgroup>
	                	<option value="1" selected="">Manter Ativo</option>
	                	<optgroup label="Inativar Colaborador"></optgroup>
	                	<option value="0">Inativar</option>
	                </select>
	            </div>

	            <div class="form-group col-md-12">
	                <hr>
	            </div>

	        	<button type="submit" class="btn btn-default btn-fill btn-wd">Editar Colaborador</button>

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
function mcpf(v){
   v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
function id( el ){
return document.getElementById( el );
}
window.onload = function(){
id('txtCpfC').onkeyup = function(){
mascara( this, mcpf );
}
}
</script>