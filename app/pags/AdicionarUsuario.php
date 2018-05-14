<script>
	function verifica(){
		
		senha = document.getElementById("passSenhaC").value;
		forca = 0;
		mostra = document.getElementById("mostra");
	
		if((senha.length >= 4) && (senha.length <= 7)) {
			forca += 10;
		} else if(senha.length>7) {
			forca += 25;
		}
		
		if(senha.match(/[a-z]+/)) {
			forca += 10;
		}
		
		if(senha.match(/[A-Z]+/)) {
			forca += 20;
		}
		
		if(senha.match(/\d+/)) {
			forca += 20;
		}
		
		if(senha.match(/\W+/)) {
			forca += 25;
		}
		return mostra_res();
	}

	function mostra_res(){

		if(forca < 30) {
			mostra.innerHTML = '<div class="alert alert-danger col-md-12" width="'+forca+'"> <b> Senha Fraca </b> </div>';
		} else if((forca >= 30) && (forca < 60)) {
			mostra.innerHTML = '<div class="alert alert-warning" width="'+forca+'"> <b> Senha Regular </b> </div>';;
		} else if((forca >= 60) && (forca < 85)) {
			mostra.innerHTML = '<div class="alert alert-info" width="'+forca+'"> <b> Senha Forte </b> </div>';
		} else {
			mostra.innerHTML = '<div class="alert alert-success" width="'+forca+'"> <b> Senha Excelente </b> </div>';
		}

	}
</script>

<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$tNome 		 = $_POST['txtNomeCompletoC'];
		$tSocial 	 = $_POST['txtNomeSocialC'];
		$tCpf 		 = $_POST['txtCpfC'];
		$tEmail 	 = $_POST['txtEmailC'];
		$tSenha 	 = criptografar($_POST['passSenhaC'],"k49fdk4030d");
		$tAdicionado = $_SESSION['LOGINUSER'];
		$tNivel 	 = $_POST['txtNivelC'];

		$tCampos = "NOME_U,NOME_SOCIAL_U,CPF_U,EMAIL_U,SENHA_U,Adicionado_Por,Nivel_U";
		$tValues = "'$tNome','$tSocial','$tCpf','$tEmail','$tSenha','$tAdicionado','$tNivel'";
				
		$tSql = $tPdo->prepare("INSERT INTO usuarios_colaboradores ({$tCampos}) VALUES ({$tValues})");
		$tSql ->execute();

		if($tSql == TRUE) {

			include('Email_CadastroUsuario.php');
			$tMensagem = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div><meta HTTP-EQUIV = 'Refresh' CONTENT = '0; URL =?controle=ListaDeUsuarios'>";

		} else {
			
			$tMensagem = "<div class='alert alert-success'>Infelizmente houve um erro ao cadastrar este usuário, tente novamente ou contato seu Desenvolvedor!</div><meta HTTP-EQUIV = 'Refresh' CONTENT = '0; URL =?controle=ListaDeUsuarios'>";
			
		}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="card">

    <form method="post" action="">
        
        <div class="card-header">
		    <h4 class="card-title">
				Cadastrar Novo Atendimento
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

    		<div class="form-group col-md-12">
    			<?php if(isset($tMensagem)){ echo $tMensagem;}?>
    		</div>

    		<div class="form-group col-md-6">
                <label>Nome Completo:</label>
                <input type="text" name="txtNomeCompletoC" id="txtNomeCompletoC" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>Nome Social (Usuário):</label>
                <input type="text" name="txtNomeSocialC" id="txtNomeSocialC" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>CPF:</label>
                <input type="text" name="txtCpfC" id="txtCpfC" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>E-Mail:</label>
                <input type="text" name="txtEmailC" id="txtEmailC" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label>Nova Senha</label>
                <input type="password" name="passSenhaC" id="passSenhaC" class="form-control" onkeyup="javascript:verifica()">
            </div>

            <div class="form-group col-md-6">
                <label>Nível do Usuário:</label>
                <select type="text" name="txtNivelC" id="txtNivelC" class="form-control">
                	<optgroup label="Administrativo"></optgroup>
                	<option value="1">Administrador</option>
                	<optgroup label="Colaborador"></optgroup>
                	<option value="0" selected>Colaborador</option>
                </select>
            </div>

			<div class="form-group col-md-12">
				<table id="mostra"></table>
                <hr>
            </div>

	        <button type="submit" class="btn btn-default btn-fill btn-wd">Cadastrar Novo Usuário</button>

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